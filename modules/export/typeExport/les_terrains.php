<?php
require_once 'modelExport.php';
if(!class_exists( Export_les_terrains )){
	class Export_les_terrains implements modelExport {

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
			$this -> _tmpFolder = Constant::DEFAULT_TMP_DIRECTORY . 'export_les_terrains_'.$this -> _param['codeAgence'].'/';
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


			// génération du bon xml ( voir modèle );
			//$this->array2XML($array,'Envelope',$this -> _tmpFolder . 'base/users.xml' );
			$xml = new SimpleXMLElement("<?xml version=\"1.0\" encoding=\"utf-8\" ?><Agences></Agences>");




			$codeAgence = $this->_param['codeAgence'];

			$filenameZipArchive = $this->_tmpFolder.$codeAgence.'.zip';
			if(!is_file($filenameZipArchive))
			{
				touch($filenameZipArchive);
				chmod($filenameZipArchive, 0777);
			}


			$zip = new ZipArchive();
			$zip->open($filenameZipArchive, ZIPARCHIVE::CREATE);




			foreach($this->_liaisons as $l) {
				// On récupere le mandat
				$m = $l -> getMandate();
				// si le mandat est en etat à louer/a vendre
				if($m->getEtap()->getId() == Constant::ID_ETAP_TO_SELL){
					$ag = $m -> getUser() -> getAgency();

					if(!is_file($this -> _tmpFolder .$codeAgence.'.xml')){
						touch($this -> _tmpFolder .$codeAgence.'.xml');
						chmod($this -> _tmpFolder .$codeAgence.'.xml', 0777);
					}



					//	$codeAgence = 'moissac';

					// une fois fixé avec les autres exports, voir si on ajoute le code ds la Bdd

					//$advert = $addAdverts -> addChild('advert');
					$body = $xml -> addChild("Agence");
					$body -> addChild('Contact_Agence',$m->getUser()->getName().' '.$m->getUser()->getFirstname() );
					$body -> addChild('Adresse_Agence',$m->getUser()->getAgency()->getAddress() );
					$body -> addChild('CodePostal_Agence',$m->getUser()->getAgency()->getZipCode() );
					$body -> addChild('Ville_Agence',$m->getUser()->getAgency()->getCity() );
					$body -> addChild('Telephone_Agence',$m->getUser()->getAgency()->getTel1() );
					$body -> addChild('Email_Agence',$m->getUser()->getAgency()->getEmail() );
					$body -> addChild('URL_Agence', $m->getUser()->getAgency()->getUrl());
					$advert = $body -> addChild('Annonce');

					// new Contenu de la balise annonce.
					$advert -> addChild('Reference', $m->getIdMandate() );

					$type= $m->getTransactionType()->getIdTransactionType()==Constant::ID_TRANSACTION_TYPE_SELLER?'VENTE':'LOCATION';
					$advert -> addChild('TypeAnnonce', $type);

					switch( $m->getMandateType()->getIdMandateType() ){
						// terrain
						case 1:
							$habitat = 'TERRAIN';
							break;
							//Appartement
						case 2:
							$habitat = 'APPARTEMENT';
							break;
							// maison
						case 3:
							// old ,recent, new ...
							$habitat = 'MAISON';
							break;
							// parking
						case 4:
							$habitat = 'PARKING';
							break;
							// box
						case 5:
							$habitat = 'BOX';
							break;
							// cheateau
						case 6:
							$habitat = 'CHATEAU';
							break;
							// commerce
						case 7:
							$habitat = 'COMMERCE';
							break;
							// ferme
						case 8:
							$habitat = 'FERME';
							break;
							// hangar
						case 9:
							$habitat = 'HANGAR';
							break;
							// imeuble
						case 10:
							$habitat = 'IMMEUBLE';
							break;
							// manoir
						case 11:
							$habitat = 'MANOIR';
							break;
							// propriete
						case 12:
							$habitat = 'PROPRIETE';
							break;
							// moulin
						case 13:
							$habitat = 'MOULIN';
							break;
							// remise
						case 14:
							$habitat = 'REMISE';
							break;

						default:
							$habitat='';
						break;
					}
					$advert->addChild('TypeBien', $habitat );
					switch ($m->getSituationTerrain()){
						case 1:
							$situationTerrain = 'LOTISSEMENT';
							break;
						case 2:
							$situationTerrain = 'DIFFUS';
							break;
						default:
							$situationTerrain = 'NC';
						break;
					}
					$advert->addChild('SousTypeBien', $situationTerrain );



					$advert->addChild('CodePostal', $m->getCity()->getZipCode() );
					$advert->addChild('Ville', $m->getCity()->getName() );
					$advert->addChild('Titre', $type.' '.$habitat.' - '.$m->getCity()->getName() );
					$advert->addChild('Texte', $m->getPubInternet() );
					$advert->addChild('PositionGps', $m->getGeolocalisation() );
					$advert->addChild('Gaz', $m->getGaz()?'OUI':'NON' );
					$advert->addChild('Viabilise', $m->getTerrainVenduViabilise()?'OUI':'NON' );
					$lot = $advert->addChild('lot');
					$lot->addChild('numero', $m->getNumberLot() );
					$lot->addChild('Prix', round($m->getPriceFai(),0) );
					$lot->addChild('Surface', $m->getSuperficieTotale() );
					$lot->addChild('COS', $m->getCos()?$m->getCos()->getName():null );
					$lot->addChild('SHON', $m->getSHONAccordee()==0?null:$m->getSHONAccordee() );
					$lot->addChild('Facade', $m->getTailleFacade()==0?null:$m->getTailleFacade() );
					$i =1;
					foreach( PhotosExports::loadByMandate($this->_pdo,$m) as $pict){
						// nombre de photos maxi = 5
						if($i < 6 ){
							//var_dump($listPhotos);
							$module = $m->getMandateType()->getIdMandateType() == Constant::ID_PLOT_OF_LAND?'terrain':'mandat';

							if (is_file( Constant::DEFAULT_PICTURE_MODULE_DIRECTORY.$module.'/'.$pict->getName() )) {
								copy(
								Constant::DEFAULT_PICTURE_MODULE_DIRECTORY.$module.'/'.$pict->getName(),

								$this->_tmpFolder.$codeAgence.'-'.$m->getIdMandate().'_'.$i.'.jpg'
								);
								chmod($this->_tmpFolder.$codeAgence.'-'.$m->getIdMandate().'_'.$i.'.jpg', 0777);
								$zip->addFile($this->_tmpFolder.$codeAgence.'-'.$m->getIdMandate().'_'.$i.'.jpg',$codeAgence.'-'.$m->getIdMandate().'_'.$i.'.jpg');
								$advert->addChild('Photo',  $codeAgence.'-'.$m->getIdMandate().'_'.$i.'.jpg' );

							}
						}
						$i++;
					}

					// plan...
					foreach ($m->listPlan() as $plan) {
						$module = $m->getMandateType()->getIdMandateType() == Constant::ID_PLOT_OF_LAND?'terrain':'mandat';
							
							
						if (is_file( Constant::DEFAULT_PICTURE_MODULE_DIRECTORY.$module.'/'.$plan->getName() )) {
							copy(
							Constant::DEFAULT_PICTURE_MODULE_DIRECTORY.$module.'/'.$plan->getName(),

							$this->_tmpFolder.$codeAgence.'-'.$plan->getName()
							);
							chmod($this->_tmpFolder.$codeAgence.'-'.$plan->getName(), 0777);
							$zip->addFile($this->_tmpFolder.$codeAgence.'-'.$plan->getName(), $codeAgence.'-'.$plan->getName());
							$advert->addChild('Plan',  $codeAgence.'-'.$plan->getName() );

						}
					}
					$advert->addChild('ReglementLotissement',  $m->getReglementDeLotissement() );
				}
					
			}
			$xml -> asXml($this -> _tmpFolder .$codeAgence.'.xml');




			// ajout du xml dans le zip.
			$zip->addFile($this -> _tmpFolder .$codeAgence.'.xml',$codeAgence.'.xml');
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
				mail('julien@legrain.fr', 'escal82.com', 'Erreur lors d\'un export ( les terrains)');
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
			if(!is_dir( Constant::DEFAULT_LOGS_DIRECTORY.'exports/'.date('Ymd').'/export_les_terrains_'.$this -> _param['codeAgence']) ){
				mkdir(Constant::DEFAULT_LOGS_DIRECTORY.'exports/'.date('Ymd').'/export_les_terrains_'.$this -> _param['codeAgence']);
				chmod(Constant::DEFAULT_LOGS_DIRECTORY.'exports/'.date('Ymd').'/export_les_terrains_'.$this -> _param['codeAgence'], 0777);
			}
			copy($this -> _tmpFolder.'log.txt', Constant::DEFAULT_LOGS_DIRECTORY.'exports/'.date('Ymd').'/export_les_terrains_'.$this -> _param['codeAgence'].'/log.txt');
			copy($this -> _tmpFolder . $this -> _param['codeAgence'] . '.zip', Constant::DEFAULT_LOGS_DIRECTORY.'exports/'.date('Ymd').'/export_les_terrains_'.$this -> _param['codeAgence'].'/'.$this -> _param['codeAgence'] . '.zip');
		}

	}
}
$objExport = new Export_les_terrains($pdo, $passerelle);
//unset($objExport);
