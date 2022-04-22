<?php
require_once 'modelExport.php';
if(!class_exists( Export_poliris )){
	class Export_poliris implements modelExport {

		private $_passerelle;
		private $_pdo;
		private $_liaisons;
		private $_h_generate;
		private $_param;
		private $_tmpFolder;
		public function __construct(PDO$pdo, Passerelle $passerelle) {
			$this -> _passerelle = $passerelle;
			$this -> _param = unserialize($this -> _passerelle -> getParam());
			$this -> _pdo = $pdo;
			
			// creation du repertoire tmp
			$this -> _tmpFolder = Constant::DEFAULT_TMP_DIRECTORY . 'export_poliris_'.$this -> _param['codeAgence'].'/';
			if(!is_dir($this -> _tmpFolder)) {
				mkdir($this -> _tmpFolder, 0777);
				chmod($this -> _tmpFolder, 0777);
			}
	



			/*
			 $test2=array('codeAgence'=>'212a','ftp'=> array( 'host'=>'monftp-1.net', 'user'=>'immofrance1','password'=>'immofrance1'));
			echo serialize( $test2 );
			*/

			//$this -> _h_generate = date('YmdHis');
			$this -> getListToExport();
			if($this -> generateTmpFiles()) {
				// go upload ftp
				$this->sendOnFtp();

			}
		}
		private function setLog($log){
			$fp = fopen($this -> _tmpFolder.'log.txt', 'a');
			fwrite($fp, $log);
			fclose($fp);
		}
		public function __destruct() {

			foreach( glob($this->_tmpFolder.'*') as $fi){
				if(is_file($fi)){
					@unlink($fi);
				}
			}
			@rmdir( $this->_tmpFolder );


		}

		private function _recursive_rmdir($dirname, $followLinks =false) {
			if(is_dir($dirname) && !is_link($dirname)) {
				if(!is_writable($dirname))
				throw new Exception('You do not have renaming permissions!');

				$iterator = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($dirname), RecursiveIteratorIterator::CHILD_FIRST);

				while($iterator -> valid()) {
					if(!$iterator -> isDot()) {
						if(!$iterator -> isWritable()) {
							throw new Exception(sprintf('Permission Denied: %s.', $iterator -> getPathName()));
						}
						if($iterator -> isLink() && false === (boolean)$followLinks) {
							$iterator -> next();
						}
						if($iterator -> isFile()) {
							unlink($iterator -> getPathName());
						} else if($iterator -> isDir()) {
							@rmdir($iterator -> getPathName());
						}
					}

					$iterator -> next();
				}
				unset($iterator);
				// Fix for Windows.

				return    rmdir($dirname);
			} else {
				throw new Exception(sprintf('Directory %s does not exist!', $dirname));
			}
		}

		// on récupere la liste des liaisons.
		private function getListToExport() {
			$this -> _liaisons = LiasonPasserelleMandat::loadByPasserelle($this -> _pdo, $this -> _passerelle);
		}

		private function generateTmpFiles() {


			$codeAgence = $this->_param['codeAgence'];
			

			$filenameZipArchive = $this->_tmpFolder.$codeAgence.'.zip';

			if(!is_file($filenameZipArchive))
			{
				touch($filenameZipArchive);
				chmod($filenameZipArchive, 0777);
			}
			$zip = new ZipArchive();
			$zip->open($filenameZipArchive, ZIPARCHIVE::CREATE);

			// Creer les divers fichiers csv
			if(!is_file($this->_tmpFolder.'Annonces.csv'))
			{
				touch($this->_tmpFolder.'Annonces.csv');
				chmod($this->_tmpFolder.'Annonces.csv', 0777);
			}

			if(!is_file($this->_tmpFolder.'Config.txt'))
			{
				touch($this->_tmpFolder.'Config.txt');
				chmod($this->_tmpFolder.'Config.txt', 0777);
			}
			$fh = fopen($this->_tmpFolder.'Config.txt', "w");
			fputs ($fh, "Version=4.07\n");
			fputs ($fh, "Application= Immo Manageur / 1\n");
			fputs ($fh, "Devise=Euro");
			fclose ($fh);
			$zip->addFile($this->_tmpFolder.'Config.txt','Config.txt');

			if(!is_file($this->_tmpFolder.'Photos.cfg'))
			{
				touch($this->_tmpFolder.'Photos.cfg');
				chmod($this->_tmpFolder.'Photos.cfg', 0777);
			}
			$fh = fopen($this->_tmpFolder.'Photos.cfg', "w");
			fputs ($fh, 'Mode=FULL');
			fclose ($fh);
			$zip->addFile($this->_tmpFolder.'Photos.cfg','Photos.cfg');





			foreach($this->_liaisons as $l) {
				// On récupere le mandat
				$m = $l -> getMandate();
				// si le mandat est en etat à louer/a vendre
				if($m->getEtap()->getId() == Constant::ID_ETAP_TO_SELL){
					$ag = $m -> getUser() -> getAgency();
						

					// lignes fputs ($fh, 'Mode=FULL');
					// mettre ici toute les lignes.
					$separator = '"!#"';
					$line=array();
					$line[0]=$this->_param['codeAgence']; // rang 1 Identifiant agence
					$line[1]=$m->getNumberMandate(); // reference annonce
						
					$line[2]=$m->getTransactionType()->getIdTransactionType()==Constant::ID_TRANSACTION_TYPE_SELLER?'vente':'location'; // type d'annonce (vente ou location
					$typeBien ='A FAIRE';
					switch($m->getMandateType()->getExportCode() ){
						case 'TE':
							$typeBien = 'terrain';
							break;
						case 'AP':
							$typeBien = 'Appartement';
							break;
								
						case 'MA':
							$typeBien = 'maison/villa';
							break;
						case 'PA':
							$typeBien = 'parking/box';
							break;
						case 'BO':
							$typeBien = 'parking/box';
							break;
						case 'CH':
							$typeBien = 'château';
							break;
						case 'CO':
							$typeBien = 'boutique';
							break;
						case 'FE':
							$typeBien = 'maison/villa';
							break;
						case 'HA':
							$typeBien = 'batiment';
							break;
						case 'IM':
							$typeBien = 'bâtiment';
							break;
						case 'MAN':
							$typeBien = 'château';
							break;
						case 'PRO':
							$typeBien = 'loft/atelier/surface';
							break;
						case 'MO':
							$typeBien = 'loft/atelier/surface';
							break;
						case 'RE':
							$typeBien = 'loft/atelier/surface';
							break;
					}
					$line[3]=$typeBien;// type de bien
					$line[4]=$m->getCity()->getZipCode();
					$line[5]=$m->getCity()->getName() ;
					$line[6]='';// Pays
					$line[7]='';// adresse
					$line[8]='';// quartier, proximité
					$line[9]='';//Activité commerciale
					$line[10]=round($m->getPriceFai(),0);//prix FAI
					$line[11]='';// mois mur
					$line[12]='';// loyer charche comprise (oui, non, '')
					$line[13]='';// loyer ht (oui, non, '')
					$line[14]=$m->getCommission();// honoraire pour une location
					$line[15]=$m->getSurfaceHabitable();// Surface habitable
					$line[16] = $m->getSuperficieTotale();// Superficie terrain
					$line[17]=$m->getNbPiece(); // nombre de pièce
					$line[18]=$m->getNbChambre();// nombre de chambre
					if( $m->getMandateType()->getIdMandateType() == Constant::ID_PLOT_OF_LAND){
						$line[19]=$m->getMandateType()->getName().' '.$m->getSuperficieTotale().' m²';// bibellé (manque à l'heure actuelle) (ou alors on prend le type + nb pièce)
					}else{
						$line[19]=$m->getMandateType()->getName().' '.$m->getNbPiece().' pièces';
					}
					$line[20] = preg_replace("(\r\n|\n|\r)",'',str_replace('"', "'",preg_replace("%\n%", "<BR>", $m->getPubInternet())));// publicité (limité à 4000 carac)
					$line[20]=$line[20]==''?'Lorem ipsum set init dolor':$line[20];
					$line[21]= $m->getFreeDate()?date('d/m/Y',$m->getFreeDate()):'';// date de disponibilité
					$line[22]=$m->getChargesMensuelle();// charges
					$line[23]='';// etage
					$line[24]='';// nb etage
					$line[25]='';// meublé
					$line[26]=$m->getAnneeConstruction();// année construction.
					$line[27]='';// refait à neuf
					$line[28]='';// nb salles de bain
					$line[29]='';// nb salles d'eau
					$line[30]='';// nb Wc
					$line[31]='';// Wc séparés

					$line[32]='';//chauffage

					$line[33]='';//type de cuisine
					$orientation = $m->getOrientation() ;
					$sud='NON';$est='NON';$ouest='NON';$nord='NON';
					if($orientation){
						switch($orientation->getCode()){
							case 'N':
								$nord='OUI';
								break;
							case 'E':
								$est='OUI';
								break;
							case 'S':
								$sud='OUI';
								break;
							case 'O':
								$ouest='OUI';
								break;
							case 'NE':
								$nord='OUI';$est='OUI';
								break;
							case 'NO':
								$nord='OUI';$ouest='OUI';
								break;
							case 'SE':
								$sud='OUI';$est='OUI';
								break;
							case 'SO':
								$sud='OUI';$ouest='OUI';
								break;
						}
					}
					$line[34]=$sud;// orientation sud
					$line[35]=$est;// orientation est
					$line[36]=$ouest;// orientation ouest
					$line[37]=$nord;// orientation nord

					$line[38]='';// nb balcon
					$line[39]='';// SF balcon
					$line[40]='';// ascenseur
					$line[41]=$m->getCave()?'OUI':'NON';// cave
					$line[42]='';//nb parking
					$line[43]='';//nb boxes
					$line[44]='';// digicode
					$line[45]='';// interphone
					$line[46]='';// gardien
					$line[47]=$m->getTerrasse()?'OUI':'NON';// terrasse
					$line[48]='';// prix semaine/ saison basse
					$line[49]='';// prix 15ene / basse saison
					$line[50]='';// prix mois / basse saison
					$line[51]='';// prix semaine/ saison haute
					$line[52]='';// prix 15ene/ saison haute
					$line[53]='';// prix mois/ saison haute
					$line[54]='';// Nb personne
					$line[55]='';// type residence
					$line[56]='';// situation (mer, montagne, campagne, ville)
					$line[57]='';// nb couvert
					$line[58]='';// nb lits double
					$line[59]='';// nb lits simple
					$line[60]='';// alarmes
					$line[61]='';// cable tv
					$line[62]='';// calme
					$line[63]='';// clim
					$line[64]=$m->getPiscine()?'OUI':'NON';// piscine
					$line[65]='';// ammenagement pour handicapés
					$line[66]='';// Animaux acceptés
					$line[67]=$m->getCheminee()?'OUI':'NON';//cheminée
					$line[68]='';// congelateur
					$line[69]='';// four
					$line[70]='';// lave vaiselle
					$line[71]='';//micro onde
					$line[72]='';// placards
					$line[73]='';// telephone
					$line[74]='';// proche lac
					$line[75]='';//proche tennis
					$line[76]='';// proche piste de ski
					$line[77]='';// vue dégagée
					$line[78]='';//chiffre affaire
					$line[79]='';//longueur façade
					$line[80]='';//duplex
					$line[81]='';//publications
					$line[82]='';// mandats excusivité
					$line[83]='';//coup de coeur (si site développé par se loger)





					// enregistrement des photos
					$i =1;
					$comptePicture=84;
					foreach( PhotosExports::loadByMandate($this->_pdo,$m) as $pict){
						// nombre de photo maxi = 25
						if($i < 21 ){
							//var_dump($listPhotos);
							$module = $m->getMandateType()->getIdMandateType() == Constant::ID_PLOT_OF_LAND?'terrain':'mandat';

							if (is_file( Constant::DEFAULT_PICTURE_MODULE_DIRECTORY.$module.'/'.$pict->getName() )) {
								copy(
								Constant::DEFAULT_PICTURE_MODULE_DIRECTORY.$module.'/'.$pict->getName(),

								$this->_tmpFolder.$codeAgence.'-'.$m->getIdMandate().'_'.$i.'.jpg'
								);
								chmod($this->_tmpFolder.$codeAgence.'-'.$m->getIdMandate().'_'.$i.'.jpg', 0777);
								$zip->addFile($this->_tmpFolder.$codeAgence.'-'.$m->getIdMandate().'_'.$i.'.jpg',$codeAgence.'-'.$m->getIdMandate().'_'.$i.'.jpg');

								// champs des photos
								$line[$comptePicture]=$codeAgence.'-'.$m->getIdMandate().'_'.$i.'.jpg';
								//echo $codeAgence.'-'.$m->getIdMandate().'_'.$i.'.jpg';
							}
						}
						$i++;
						if($comptePicture!=92)
						$comptePicture++;
						else
						$comptePicture=163;
					}
					// Complete les images si le mandat ne dispose pas de 20 photos
					if($comptePicture<173){
						for($i=84; $i<174;$i++){
							if($line[$i]=='')
							$line[$i]='';// photo manquante
							if($i==92)
							$i=162;
						}
					}
					$line[93]='';// titre photo 1
					$line[94]='';// titre photo 2
					$line[95]='';// titre photo 3
					$line[96]='';// titre photo 4
					$line[97]='';// titre photo 5
					$line[98]='';// titre photo 6
					$line[99]='';// titre photo 7
					$line[100]='';// titre photo 8
					$line[101]='';// titre photo 9
					$line[102]='';//  photo panoramique
					$line[103]='';// url visite virtuelle

					// telephone, tout ça en fct de l'agence de l'utilisateur

					$line[104]=$ag->getTel1();// telephone à afficher
					$line[105]=$ag->getContact();// contact à afficher
					$line[106]=$ag->getEmail();//email à afficher

					$line[107]=$m->getCity()->getZipCode();//cp reel du bien
					$line[108]=$m->getCity()->getName();// ville réelle du bien
					$line[109]='';//intercabinet
					$line[110]='';// intercabine prive
					$line[111]=$m->getNumberMandate();//num mandat
					$line[112]=date('d/m/Y',$m->getInitDate() );//
					$line[113]='';// nom mandataire
					$line[114]='';//prenom mandataire
					$line[115]='';//raison sociale mandataire
					$line[116]='';//adresse mandataire
					$line[117]='';//cp mabndataire
					$line[118]='';//ville mandataire
					$line[119]='';//tel mandataire
					$line[120]='';//commentaire mendataire
					$line[121]='';//commetaire privé
					$line[122]='';// code ou nom négociateur
					$line[123]='';//code langue 1
					$line[124]='';// proximité langue 1
					$line[125]='';// libellé langue 1
					$line[126]='';// descriptif langue 1
					$line[127]='';//code langue 2
					$line[128]='';//proximité langue 2
					$line[129]='';//libellé langue 2
					$line[130]='';//descriptif langue 2
					$line[131]='';//code langue 3
					$line[132]='';//proximité langue 2
					$line[133]='';//libellé langue 3
					$line[134]='';//descriptif langue 3
					$line[135]='';// champ personalisé 1
					$line[136]='';// champ personalisé 2
					$line[137]='';// champ personalisé 3
					$line[138]='';// champ personalisé 4
					$line[139]='';// champ personalisé 5
					$line[140]='';// champ personalisé 6
					$line[141]='';// champ personalisé 7
					$line[142]='';// champ personalisé 8
					$line[143]='';// champ personalisé 9
					$line[144]='';// champ personalisé 10
					$line[145]='';// champ personalisé 11
					$line[146]='';// champ personalisé 12
					$line[147]='';// champ personalisé 13
					$line[148]='';// champ personalisé 14
					$line[149]='';// champ personalisé 15
					$line[150]='';// champ personalisé 16
					$line[151]='';// champ personalisé 17
					$line[152]='';// champ personalisé 18
					$line[153]='';// champ personalisé 19
					$line[154]='';// champ personalisé 20
					$line[155]='';// champ personalisé 21
					$line[156]='';// champ personalisé 22
					$line[157]='';// champ personalisé 23
					$line[158]='';// champ personalisé 24
					$line[159]='';// champ personalisé 25
					$line[160]='';// dépot de garantie
					$line[161]='';// recent
					$line[162]='';// travaux à prevoir


					// Photos déjà renseignées de 163 à 173

					$line[174]=$m->getIdmandate();// identifiant technique
					// dpe récupération des valeurs
					$dpe = ValDpe::loadByMandate($this->_pdo, $m);
					if($dpe){
						// mise à jr dans le tableau.
						if($dpe->getConsoEner( )){
							$line[175]=$dpe->getConsoEner( ); // consomation energetique
							$line[176]=DpeConsoEner::loadByValue($this->_pdo, $dpe->getConsoEner( ))->getName(); // lettre conso ener
						}else{
							$line[175]=''; // consomation energetique
							$line[176]=''; // letre conso ener
						}


						if($dpe->getEmissionGaz( )){
							$line[177]=$dpe->getEmissionGaz( );// emission GES
							$line[178]=DpeEmissionGaz::loadByValue($this->_pdo, $dpe->getEmissionGaz( ))->getName();// lettre GES
						}else{
							$line[177]='';// emission GES
							$line[178]='';// lettre GES
						}

					}else{
						$line[175]=''; // consomation energetique
						$line[176]=''; // letre conso ener
						$line[177]='';// emission GES
						$line[178]='';// lettre GES
					}
					$line[179]='';// identifiant quartier
					$line[180]='';// sous type de bien
					$line[181]='';// periode de disponibilité
					$line[182]='';//periode basse saison
					$line[183]='';//periode haute saison
					$line[184]='';// prix du bouquet
					$line[185]='';// rente mensuelle
					$line[186]='';// age de l'homme
					$line[187]='';//age de la femme
					$line[188]='';//entrée
					$line[189]='';//residence
					$line[190]='';//parquet
					$line[191]='';// vis à vis
					$line[192]='';//transport ligne
					$line[193]='';// transport station
					$line[194]='';// durée du bail
					$line[195]='';// place en salles
					$line[196]='';//monte charge
					$line[197]='';//quai
					$line[198]='';//nb de bureau
					$line[199]='';//prix droit entrée
					$line[200]='';//prix masqué
					$line[201]='';// loyer annuel global
					$line[202]='';//charges annuelles globales
					$line[203]='';// loyer annuel au m²
					$line[204]='';// charges annuelles au m²

					$line[205]='';// charges mensuelles HT
					$line[206]='';// loyer annuel cc
					$line[207]='';//loyer annuel HT
					$line[208]='';//charges annuelles HT
					$line[209]='';// loyer annuel au m² cc
					$line[210]='';//loyer annuel au m² HT

					$line[211]='';//Charges annuelles au m² HT
					$line[212]='';// Divisible
					$line[213]='';// Surface divisible minimale
					$line[214]='';// Surface divisible maximale
					$line[215]='';//Surface sejour
					$line[216]='';// nb véhicule
					$line[217]='';// prix du droit au bail
					$line[218]='';// valeur à l'achat
					$line[219]='';// répartition du chiffre d'affaire
					$line[220]='';// terrain agricole
					$line[221]='';// equipement bébé
					//$line[222]=$m->getTerrainConstructible()?'OUI':'NON';// terrain constructible
					$line[222]='';//terrain constructible
					$line[223]='';// Résultat année n-2
					$line[224]='';// Résultat année n-1
					$line[225]='';// Résultat actuel
					$line[226]='';// immeuble de parking
					$line[227]='';//parking isolé
					$line[228]='';// Si viager, vendu libre
					$line[229]='';// logement à disposition

					// terrain en pente.
					$line[230]=$m->getSlope()?'OUI':'NON'; // terrain en pente
					$line[231]=$m->getPointEau()?'OUI':'NON';// plan d'eau ?
					$line[232]='';// lave linge
					$line[233]='';// Seche linge
					$line[234]='';// Connexion Internet
					$line[235]='';// Chiffre affaire N-2
					$line[236]='';// Chiffre affaire N-1
					$line[237]='';// Conditions financieres
					$line[238]='';// Prestation diverses
					$line[239]='';// longueur façade
					$line[240]='';// montant du rapport
					$line[241]='';// Nature du bail
					$line[242]='';// Nature bail commercial
					$line[243]='';// Nb terasse
					$line[244]='';// Prix HT
					$line[245]='';// Si salle à manger
					$line[246]='';// Si séjour
					$line[247]='';// Terrain donne sur la rue
					$line[248]='';// Immeuble de type bureau

					$line[249]=$m->getTerrainVenduViabilise()?'OUI':'NON';//terrain viabilisé // uniquement si terrain
					$line[250]='';// equipement vidéo
					$line[251]='';// Surface de la cave
					$line[252]='';// Surface de la salle à manger
					$line[253]='';// Situation commerciale
					$line[254]='';// Surface maximale du bureau

					ksort($line);
					$line = implode($separator,$line);
					$fh = fopen($this->_tmpFolder.'Annonces.csv', "a");
					fwrite($fh, '"'.$line.'"'."\n");
					fclose ($fh);
					unset($line);



				}
			}

			$zip->addFile($this->_tmpFolder.'Annonces.csv','Annonces.csv');
			$zip->close();
			chmod($filenameZipArchive, 0777);
			$this->setLog(date('Y-m-d H:i:s')." - Archive créée \n");
			$this->setLog(date('Y-m-d H:i:s')." - Taille de l'archive ......... ".filesize($filenameZipArchive )."\n");
			return true;
		}


		private function sendOnFtp() {
			// déplace les fichiers de bdd et les photos
			$ftp = new ftp($this -> _param['ftp']['host'], $this -> _param['ftp']['user'], $this -> _param['ftp']['password']);
			$ftp -> connexion();
			$this->setLog(date('Y-m-d H:i:s')." - Connexion ftp \n");
			/*
			 foreach($ftp->ls() as $file) {
			// suppression des fichiers présent sur le ftp
			if(!@$ftp -> rm($file))
			@$ftp -> rmdir($file);
			}
			*/
			// suppression du zip précédant

			@$ftp->rm( $this->_param['codeAgence'].'.zip' );
			$this->setLog(date('Y-m-d H:i:s')." - Début du transfert \n");
			// on uploade le zip
			if($ftp -> upload($this->_param['codeAgence'].'.zip', $this->_tmpFolder.$this->_param['codeAgence'].'.zip', FTP_BINARY)){
			$this->setLog(date('Y-m-d H:i:s')." - Fin du transfert ftp \n");
			$this->setLog(date('Y-m-d H:i:s')." - Taille des éléments présents sur le ftp \n");
			foreach ($ftp->ls() as $l){
				if( $l== $this -> _param['codeAgence'] . '.zip')
					$this->setLog(date('Y-m-d H:i:s')." - ".$l.' ..... '.$ftp->ftp_size($l)."\n");
			}
			}else{
				$this->setLog(date('Y-m-d H:i:s')." - Echec du transfert ftp \n");
				mail('julien@legrain.fr', 'escal82.com', 'Erreur lors d\'un export ( top poliris)');
			}
			
			/*
			 *
			foreach(glob($this->_tmpFolder.'/*') as $fileToUpload) {
			$name = explode('/', $fileToUpload);
			$name = $name[count($name) - 1];
			$ftp -> upload($name, $fileToUpload, FTP_BINARY);
			}
			*/
			unset($ftp);
			$this->setLog(date('Y-m-d H:i:s')." - fin de connexion ftp \n");
			// Copie du zip et des log puis suppression....
			if(!is_dir( Constant::DEFAULT_LOGS_DIRECTORY.'exports/'.date('Ymd') )){
				mkdir(Constant::DEFAULT_LOGS_DIRECTORY.'exports/'.date('Ymd'));
				chmod(Constant::DEFAULT_LOGS_DIRECTORY.'exports/'.date('Ymd'), 0777);
			}
			if(!is_dir( Constant::DEFAULT_LOGS_DIRECTORY.'exports/'.date('Ymd').'/export_poliris_'.$this -> _param['codeAgence']) ){
				mkdir(Constant::DEFAULT_LOGS_DIRECTORY.'exports/'.date('Ymd').'/export_poliris_'.$this -> _param['codeAgence']);
				chmod(Constant::DEFAULT_LOGS_DIRECTORY.'exports/'.date('Ymd').'/export_poliris_'.$this -> _param['codeAgence'], 0777);
			}
			copy($this -> _tmpFolder.'log.txt', Constant::DEFAULT_LOGS_DIRECTORY.'exports/'.date('Ymd').'/export_poliris_'.$this -> _param['codeAgence'].'/log.txt');
			copy($this -> _tmpFolder . $this -> _param['codeAgence'] . '.zip', Constant::DEFAULT_LOGS_DIRECTORY.'exports/'.date('Ymd').'/export_poliris_'.$this -> _param['codeAgence'].'/'.$this -> _param['codeAgence'] . '.zip');
		}

	}
}
$objExport = new Export_poliris($pdo, $passerelle);
//unset($objExport);
