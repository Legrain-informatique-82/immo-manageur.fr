<?php
require_once 'modelExport.php';
if(!class_exists(Export_annonces_jaunes)) {
	class Export_annonces_jaunes implements modelExport {

		private $_passerelle;
		private $_pdo;
		private $_liaisons;
		private $_h_generate;
		private $_param;
		private $_tmpFolder;
		public function __construct(PDO$pdo, Passerelle$passerelle) {

			// creation du repertoire tmp
			$this -> _tmpFolder = Constant::DEFAULT_TMP_DIRECTORY . 'export_annonces_jaunes/';
			if(!is_dir($this -> _tmpFolder)) {
				mkdir($this -> _tmpFolder, 0777);
				chmod($this -> _tmpFolder, 0777);
			}
			$this -> _passerelle = $passerelle;
			$this -> _param = unserialize($this -> _passerelle -> getParam());
			$this -> _pdo = $pdo;


			//$test2=array('codeAgence'=>array('Moissac'=>'51447773VH0002','Auvillar'=>'51447773VH0001','La ville Dieu du Temple'=>'51906824VH0003'),'ftp'=> array( 'host'=>'monftp-1.net', 'user'=>'immofrance1','password'=>'immofrance1'));
			//echo serialize( $test2 );


			//$this -> _h_generate = date('YmdHis');
			$this -> getListToExport();
			if($this -> generateTmpFiles()) {
				// go upload ftp
				$this -> sendOnFtp();

			}
		}

		public function __destruct() {

			foreach(glob($this->_tmpFolder.'*') as $fi) {
				if(is_file($fi)) {
					@unlink($fi);
				}
			}
			@rmdir($this -> _tmpFolder);

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

				return rmdir($dirname);
			} else {
				throw new Exception(sprintf('Directory %s does not exist!', $dirname));
			}
		}

		// on récupere la liste des liaisons.
		private function getListToExport() {
			$this -> _liaisons = LiasonPasserelleMandat::loadByPasserelle($this -> _pdo, $this -> _passerelle);
		}

		private function generateTmpFiles() {
			$filenameZipArchive = $this -> _tmpFolder .'annoncesJaunes.zip';
			if(!is_file($filenameZipArchive)) {
				touch($filenameZipArchive);
				chmod($filenameZipArchive, 0777);
			}
			$zip = new ZipArchive();
			$zip -> open($filenameZipArchive, ZIPARCHIVE::CREATE);

			// Creer les divers fichiers csv
			if(!is_file($this -> _tmpFolder . 'Annonces.csv')) {
				touch($this -> _tmpFolder . 'Annonces.csv');
				chmod($this -> _tmpFolder . 'Annonces.csv', 0777);
			}

			// On boucle sur l'annonce
			// ligne 1
			$l1 = '"Code agence";"Reference annonce";"Type transaction";"Type bien";"Mandat en exclusivite";"Titre annonce";"Description bien";"Date disponibilite";"Adresse";"Code postal";"Commune";"Pays";"Quartier proximite";"Url";"Description Url";"Nom contact";"Contact telephone fixe";"Contact telephone mobile";"Contact Email";"Anciennete";"Etat general";"Refait a neuf";"Chauffage";"Situation location vacances";"Loyer avec charges";"Loyer sans charges";"Charges";"Depot de garantie";"Taxe habitation";"Prix vente";"Rente";"Taxe fonciere";"Frais d\'agence";"Annee construction";"Meuble";"Duplex";"Triplex";"Loft";"Sans vis-a-vis";"Vue sur mer";"Etage";"Nombre etages immeuble";"Surface habitable";"Surface totale";"Surface Carrez";"Surface sejour";"Surface salle  manger";"Surface terrasses balcons";"Surface cave";"Nombre salles bain";"Nombre salles eau";"Nombre toilettes";"Nombre pieces";"Nombre chambres";"Nombre bureaux";"Double sejour";"Dernier etage";"Mitoyenne";"Plain pied";"Avec etages";"Avec sous-sol";"Orientation sud";"Orientation ouest";"Orientation nord";"Orientation est";"Interphone";"Digicode";"Alarme";"Ascenseur";"Gardien";"Cheminee";"Parquet";"Terrasse";"Climatisation";"Balcon";"Jardin";"Piscine";"Tennis";"Garage";"Parking";"Grenier";"Cave";"Placards";"Cuisine equipee";"Cuisine americaine";"Surface terrain";"Terrain constructible";"Capacite accueil";"Loyer haute saison semaine";"Loyer haute saison quinzaine";"Loyer haute saison mois";"Loyer basse saison semaine";"Loyer basse saison quinzaine";"Loyer basse saison mois";"Date debut location";"Date fin location";"Internet";"Telephone";"Television";"Cable satellite";"Lave linge";"Lave vaisselle";"Congelateur";"Linge maison";"Four";"Microonde";"Barbecue";"Equipement bebe";"Femme menage";"Animaux autorises";"Non fumeur";"Cheques vacances";"Proche pistes ski";"Amenagement handicapes";"Duree minimale jours";"Photo1";"Photo2";"Photo3";"Photo4";"Photo5";"Photo6";"consommation énergie";"bilan consommation (classification)";"emission GES";"Bilan emission GES (classification)";"ville internet";"CP internet"';
			$fh = fopen($this -> _tmpFolder . 'Annonces.csv', "w");
			fputs($fh, $l1."\n");
			fclose($fh);
			foreach($this->_liaisons as $l) {
				// On récupere le mandat
				$m = $l -> getMandate();
				// si le mandat est en etat à louer/a vendre
				if($m->getEtap()->getId() == Constant::ID_ETAP_TO_SELL){
					$ag = $m -> getUser() -> getAgency();
					//var_dump( $ag );
					$line=array();

					// Mise en place dans les parametres ...
						
					// code agence.
					$line[0]=null;
					foreach($this->_param['codeAgence'] as $name => $code){
						if($name==$ag->getName())
						$line[0]=$code;
					}
					if($line[0]!=null){
						$codeAgence =$line[0];
						$line[1]=$m->getNumberMandate();// référence annonce
						$line[2]=$m->getTransactionType()->getIdTransactionType()==Constant::ID_TRANSACTION_TYPE_SELLER?'Vente':'Location'; // type d'annonce (vente ou location
						$typeBien ='A FAIRE';
						switch($m->getMandateType()->getExportCode() ){
							case 'TE':
								$typeBien = 'Terrain';
								break;
							case 'AP':
								$typeBien = 'Appartement';
								break;

							case 'MA':
								$typeBien = 'Maison - villa';
								break;
							case 'PA':
								$typeBien = 'Parking';
								break;
							case 'BO':
								$typeBien = 'Parking';
								break;
							case 'CH':
								$typeBien = 'Château - propriété';
								break;
							case 'CO':
								$typeBien = 'Local Commercial';
								break;
							case 'FE':
								$typeBien = 'Ferme';
								break;
							case 'HA':
								$typeBien = 'Autres';
								break;
							case 'IM':
								$typeBien = 'Immeuble';
								break;
							case 'MAN':
								$typeBien = 'Château - propriété';
								break;
							case 'PRO':
								$typeBien = 'Château - propriété';
								break;
							case 'MO':
								$typeBien = 'Autres';
								break;
							case 'RE':
								$typeBien = 'Autres';
								break;
						}
						$line[3]=$typeBien;// type de bien
						$line[4]='';// Mandat en exlusivité
						if( $m->getMandateType()->getIdMandateType() == Constant::ID_PLOT_OF_LAND){
							$line[5]=$m->getMandateType()->getName().' '.$m->getSuperficieTotale().' m²';// titre annonce
						}else{
							$line[5]=$m->getMandateType()->getName().' '.$m->getNbPiece().' pièces';// titre annonce
						}
						$line[6]=preg_replace("(\r\n|\n|\r)",'',str_replace('"', "'",preg_replace("%\n%", "<BR>", str_replace(';','.',$m->getPubInternet()))));// publicité (limité à 4000 carac)
						$line[7]= $m->getFreeDate()?date('d/m/Y',$m->getFreeDate()):'';// date de disponibilité
						$line[8]='';// adresse du bien
						$line[9]=$m->getCity()->getZipCode();// Cp du bien
						$line[10]=$m->getCity()->getName();// ville du bien
						$line[11]='';//pays
						$line[12]='';//quartier proximité
						$line[13]='';//url
						$line[14]='';// description url
						$line[15]='';//nom contact
						$line[16]='';// contact tel fixe
						$line[17]='';// contact tel mobile
						$line[18]='';//contact email
						$line[19]='';// ancienneté
						$line[20]='';// etat general
						$line[21]='';// refait à neuf
						$line[22]='';// chauffage
						$line[23]='';// Situation location vacances

						$line[24]=$m->getTransactionType()->getIdTransactionType()==Constant::ID_TRANSACTION_TYPE_SELLER?'':$m->getPriceFai();// Loyer moyen avec charges
						$line[25]='';// Loyer moyen sans charge
						$line[26]='';//charges mensuelle
						$line[27]='';//dépot de garantie
						$line[28]= $m->getTaxeHabitation();// Taxe habitation
						$line[29]=$m->getTransactionType()->getIdTransactionType()==Constant::ID_TRANSACTION_TYPE_SELLER?$m->getPriceFai():'';// Prix de vente
						$line[30]='';// rente (viager)
						$line[31]='';// taxe fonciere
						$line[32]=$m->getCommission();// honoraire de l'agence
						$line[33]=$m->getAnneeConstruction()=='0'?'':$m->getAnneeConstruction();
						$line[34]='';//meublé
						$line[35]='';//Duplex
						$line[36]='';//Triplex
						$line[37]='';// loft
						$line[38]='';// sans vis à vis
						$line[39]='';// vue sur la mer
						$line[40]='';// etage
						$line[41]='';// etage immeubles
						$line[42]=$m->getSurfaceHabitable();// surface hab
						$line[43]=$m->getSuperficieTotale(); // superficie totale
						$line[44]='';// surface carrez

						$line[45]='';//surface sejour
						$line[46]='';// surface salle à manger
						$line[47]='';// surface terrasse balcon
						$line[48]='';//surface cave
						$line[49]='';// nb salle de bain
						$line[50]='';// nb salle d'eau
						$line[51]='';// nb Wc
						$line[52]=$m->getNbPiece();// nb piece
						$line[53]=$m->getNbChambre();// nb chambre
						$line[54]='';// nb bureaux
						$line[55]='';// double sejour
						$line[56]='';// dernier etage
						$line[57]='';// mitoyenne
						$line[58]=$m->getPlainPied()?'O':'N'; // plain pied
						$line[59]='';//avec etage
						$line[60]=$m->getSousSol()?'O':'N';// sous sol

						$orientation = $m->getOrientation() ;
						$sud='N';$est='N';$ouest='N';$nord='N';
						if($orientation){
							switch($orientation->getCode()){
								case 'N':
									$nord='O';
									break;
								case 'E':
									$est='O';
									break;
								case 'S':
									$sud='O';
									break;
								case 'O':
									$ouest='O';
									break;
								case 'NE':
									$nord='O';$est='O';
									break;
								case 'NO':
									$nord='O';$ouest='O';
									break;
								case 'SE':
									$sud='O';$est='O';
									break;
								case 'SO':
									$sud='O';$ouest='O';
									break;
							}
						}
						$line[61]=$sud;// orientation sud
						$line[62]=$ouest;// orientation ouest
						$line[63]=$nord;// orientation nord
						$line[64]=$est;// orientation est




						$line[65]='';// Interphone
						$line[66]='';// digicode
						$line[67]='';// alarme
						$line[68]='';// ascenseur
						$line[69]='';// gardien
						$line[70]=$m->getCheminee()?'O':'N';// cheminee
						$line[71]='';// parquet
						$line[72]=$m->getTerrasse()?'O':'N';// terrasse
						$line[73]='';// clim
						$line[74]='';// balcon
						$line[75]='';// jardin
						$line[76]=$m->getPiscine()?'O':'N';// piscine
						$line[77]='';// tennis
						$line[78]=$m->getGarage()?'O':'N';// garage
						$line[79]=$m->getParking()?'O':'N';//parking
						$line[80]='';// grenier
						$line[81]=$m->getCave()?'O':'N';//cave
						$line[82]='';// placard
						$line[83]=$m->getCuisineEquipee()?'O':'N';// cuisine equuipee
						$line[84]='';// cuisine américaine
						$line[85]=$m->getSuperficieTotale();// surface terrain
						$line[86]='';// terrain constructible
						$line[87]='';//capacité accueil
						$line[88]='';// loyer haute saison/semaine
						$line[89]='';// loyer hte saison quinzaine
						$line[90]='';// loyer hte saison mois
						$line[91]='';// loyer basse saison/semaine
						$line[92]='';//loyer basse saison quinzaine
						$line[93]='';//loyer basse saison mois
						$line[94]='';// date début location
						$line[95]='';//date fin location
						$line[96]='';// Internet
						$line[97]='';// telephone
						$line[98]='';// télévision
						$line[99]='';// cable satellite
						$line[100]='';// lave linge
						$line[101]='';// lave vaisselle
						$line[102]='';// congelateur
						$line[103]='';// linge maison
						$line[104]='';// four
						$line[105]='';// micro onde
						$line[106]='';// barbecue
						$line[107]='';// equipement bb
						$line[108]='';// femme menage
						$line[109]='';// animaux autorisés
						$line[110]='';// non fumeur
						$line[111]='';// cheques vacances
						$line[112]='';// proche piste ski
						$line[113]='';// équipement handicapés
						$line[114]='';// durée minimale jr

						$pictures = array();
						$i=1;
						foreach( PhotosExports::loadByMandate($this->_pdo,$m) as $pict){
							// nombre de photo maxi = 6
							if($i<7){
								$module = $m->getMandateType()->getIdMandateType() == Constant::ID_PLOT_OF_LAND?'terrain':'mandat';

								if (is_file( Constant::DEFAULT_PICTURE_MODULE_DIRECTORY.$module.'/'.$pict->getName() )) {
									copy(
									Constant::DEFAULT_PICTURE_MODULE_DIRECTORY.$module.'/'.$pict->getName(),

									$this->_tmpFolder.$codeAgence.'-'.$m->getIdMandate().'_'.$i.'.jpg'
									);
									chmod($this->_tmpFolder.$codeAgence.'-'.$m->getIdMandate().'_'.$i.'.jpg', 0777);
									$zip->addFile($this->_tmpFolder.$codeAgence.'-'.$m->getIdMandate().'_'.$i.'.jpg',$codeAgence.'-'.$m->getIdMandate().'_'.$i.'.jpg');

									// champs des photos
									//
									$pictures[]=$codeAgence.'-'.$m->getIdMandate().'_'.$i.'.jpg';
								}
								$i++;
							}
						}
						$line[115]=$pictures[0]?$pictures[0]:'';// photo 1
						$line[116]=$pictures[1]?$pictures[1]:'';//photo 2
						$line[117]=$pictures[2]?$pictures[2]:'';//photo 3
						$line[118]=$pictures[3]?$pictures[3]:'';//photo 4
						$line[119]=$pictures[4]?$pictures[4]:'';//photo 5
						$line[120]=$pictures[5]?$pictures[5]:'';//photo 6

						// dpe récupération des valeurs
						$dpe = ValDpe::loadByMandate($this->_pdo, $m);
						if($dpe){
							// mise à jr dans le tableau.
							if($dpe->getConsoEner( )){
								$line[121]=$dpe->getConsoEner( ); // consomation energetique
								$line[122]=DpeConsoEner::loadByValue($this->_pdo, $dpe->getConsoEner( ))->getName(); // lettre conso ener
							}else{
								$line[121]=''; // consomation energetique
								$line[122]=''; // letre conso ener
							}


							if( $dpe->getEmissionGaz( ) ){
								$line[123]=$dpe->getEmissionGaz( );// emission GES
								$line[124]= DpeEmissionGaz::loadByValue($this->_pdo, $dpe->getEmissionGaz( ))->getName();// lettre GES
							}else{
								$line[123]='';// emission GES
								$line[124]='';// lettre GES
							}

						}else{
							$line[121]=''; // consomation energetique
							$line[122]=''; // letre conso ener
							$line[123]='';// emission GES
							$line[124]='';// lettre GES
						}

						$line[125]='';// ville Internet
						$line[126]='';// Cp internet
						// sauvegarde
						ksort($line);
						$line = implode('";"',$line);
						// Supprimer le dernier caractere ';)
							
						$fh = fopen($this->_tmpFolder.'Annonces.csv', "a");
						fwrite($fh, '"'.$line.'"'."\n");
						fclose ($fh);
						unset($line);
					}
					// Mettre l'archive dans le zip
				}
			}
			$zip->addFile($this->_tmpFolder.'Annonces.csv','Annonces.csv');
			$zip->close();
			chmod($filenameZipArchive, 0777);
			return true;


		}

		private function sendOnFtp() {
			// déplace les fichiers de bdd et les photos
			$ftp = new ftp($this -> _param['ftp']['host'], $this -> _param['ftp']['user'], $this -> _param['ftp']['password']);
			$ftp -> connexion();

			foreach($ftp->ls() as $file) {
				// suppression des fichiers présent sur le ftp
				if(!@$ftp -> rm($file))
				@$ftp -> rmdir($file);
			}
			// on uploade le zip
			$ftp -> upload('annoncesJaunes.zip', $this -> _tmpFolder . 'annoncesJaunes.zip', FTP_BINARY);
			foreach(glob($this->_tmpFolder.'/*') as $fileToUpload) {
			 $name = explode('/', $fileToUpload);
			 $name = $name[count($name) - 1];
			 $ftp -> upload($name, $fileToUpload, FTP_BINARY);
			}
			unset($ftp);
		}

	}

}
$objExport = new Export_annonces_jaunes($pdo, $passerelle);
//unset($objExport);
