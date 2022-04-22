<?php
require_once 'modelExport.php';
if(!class_exists( Export_immo_france )){
	class Export_immo_france implements modelExport {

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
			$this -> _tmpFolder = Constant::DEFAULT_TMP_DIRECTORY . 'export_immo_france_'.$this -> _param['codeAgence'].'/';
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




			//$this->array2XML($array,'Envelope',$this -> _tmpFolder . 'base/users.xml' );
			$xml = new SimpleXMLElement("<?xml version=\"1.0\" encoding=\"utf-8\" ?><Envelope></Envelope>");
			$body = $xml -> addChild("Body");
			$addAdverts = $body -> addChild('add_adverts');

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

					$advert = $addAdverts -> addChild('advert');
					//$advert->addChild('owner', $ag->getName() );
					$advert->addChild('owner', $codeAgence );
					$advert->addChild('reference', $codeAgence.'-'.$m -> getIdMandate());
					$advert->addChild('currency','EUR');
					$advert->addChild('price',$m->getPriceFai() );
					$advert->addChild('postal_code',$m->getCity()->getZipCode( ) );
					$advert->addChild('commune',$m->getCity()->getName( ) );
					$advert->addChild('country_code','fr');
						
						
						
					/*
					 'old', 'recent', 'luxury', '', '', '', 'new', 'mobile_home', '', 'bed_breakfast', 'gite'
				 */
					switch( $m->getMandateType()->getIdMandateType() ){
						// terrain
						case 1:
							$habitat = 'land';
							break;
							//Appartement
						case 2:
							$habitat = 'appartement';
							break;
							// maison
						case 3:
							// old ,recent, new ...
							if( $m->getAnneeConstruction() < (date('Y')-14)){
								$habitat = 'old';
							}elseif( ($m->getAnneeConstruction() > (date('Y')-14)) &&( $m->getAnneeConstruction() < (date('Y')-3)) ){
								$habitat = 'recent';
							}else{
								$habitat = 'new';
							}
							break;
							// parking
						case 4:
							$habitat = 'parking';
							break;
							// box
						case 5:
							$habitat = 'business';
							break;
							// cheateau
						case 6:
							$habitat = 'luxury';
							break;
							// commerce
						case 7:
							$habitat = 'business';
							break;
							// ferme
						case 8:
							$habitat = 'business';
							break;
							// hangar
						case 9:
							$habitat = 'business';
							break;
							// imeuble
						case 10:
							$habitat = 'business';
							break;
							// manoir
						case 11:
							$habitat = 'luxury';
							break;
							// propriete
						case 12:
							$habitat = 'luxury';
							break;
							// moulin
						case 13:
							$habitat = 'business';
							break;
							// remise
						case 14:
							$habitat = 'business';
							break;

						default:
							$habitat='';
						break;
					}
					$advert->addChild('habitat', $habitat );
						
						
						
					/*
					 'properties (vente)', 'rentals (location)
				 */
					// type de transaction : 1= location ; 2= vente ;
					$type= $m->getTransactionType()->getIdTransactionType()==Constant::ID_TRANSACTION_TYPE_SELLER?'properties':'rentals';
					$advert -> addChild('type', $type);
						
						
						
					/*Facultatifs*/

					$advert -> addChild('mandate_number', $m->getNumberMandate());

					if($m->getPubInternet()!='')
					$advert -> addChild('summary_fr', $m->getPubInternet() );
					if($m->getSurfaceHabitable()!=0)
					$advert -> addChild('h_surface', $m->getSurfaceHabitable() );
					if($m->getSuperficieParcelle1()!=0)
					$advert -> addChild('l_surface', $m->getSuperficieParcelle1() );
					if($m->getNbPiece()!=0)
					$advert -> addChild('n_rooms', $m->getNbPiece() );
					if($m->getNbChambre()!=0)
					$advert -> addChild('n_beds', $m->getNbChambre() );

					// dpe récupération des valeurs
					$dpe = ValDpe::loadByMandate($this->_pdo, $m);
					if($dpe){
						// mise à jr dans le tableau.
						if($dpe->getConsoEner( )){
							// récuperation de la lettre correspondante
							$advert->addChild( 'dpe_type' , DpeConsoEner::loadByValue($this->_pdo, $dpe->getConsoEner( ))->getName()  );
							$advert->addChild( 'dpe_value' , $dpe->getConsoEner( ) );
						}


						if($dpe->getEmissionGaz( )){
								
							//DpeEmissionGaz::loadAll($this->_pdo);
							$advert->addChild( 'ges_type' , DpeEmissionGaz::loadByValue($this->_pdo, $dpe->getEmissionGaz( ))->getName()  );
							$advert->addChild( 'ges_value' , $dpe->getEmissionGaz( ) );
						}

					}
					/*
					 if($m->getHeating()){

				 switch( strtoupper( $m->getHeating()->getCode()) ){
				 case 'NO':
				 $heating='none';
				 break;
				 case 'FU':
				 $heating='fuel';
				 break;
				 case 'GA':
				 $heating='gas';
				 break;
				 case 'EL':
				 $heating='electric';
				 break;
				 case 'WO':
				 $heating='wood';
				 break;
				 case 'GE':
				 $heating='geo';
				 break;
				 case 'AE':
				 $heating='aero';
				 break;
				 case 'SO':
				 $heating='sol';
				 break;
				 case 'CO':
				 $heating='col';
				 break;
				 default:
				 $heating=null;
				 break;
					}
					if($heating!=null)
					$advert->addChild( 'heating' , $heating );
					}
					*/

					// enregistrement des photos
					$i =1;
					foreach( PhotosExports::loadByMandate($this->_pdo,$m) as $pict){
						// nombre de photo maxi = 25
						if($i < 26 ){
							//var_dump($listPhotos);
							$module = $m->getMandateType()->getIdMandateType() == Constant::ID_PLOT_OF_LAND?'terrain':'mandat';

							if (is_file( Constant::DEFAULT_PICTURE_MODULE_DIRECTORY.$module.'/'.$pict->getName() )) {
								copy(
								Constant::DEFAULT_PICTURE_MODULE_DIRECTORY.$module.'/'.$pict->getName(),

								$this->_tmpFolder.$codeAgence.'-'.$m->getIdMandate().'_'.$i.'.jpg'
								);
								chmod($this->_tmpFolder.$codeAgence.'-'.$m->getIdMandate().'_'.$i.'.jpg', 0777);
								$zip->addFile($this->_tmpFolder.$codeAgence.'-'.$m->getIdMandate().'_'.$i.'.jpg',$codeAgence.'-'.$m->getIdMandate().'_'.$i.'.jpg');


							}
						}
						$i++;
					}
						

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
				mail('julien@legrain.fr', 'escal82.com', 'Erreur lors d\'un export ( Immo france)');
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
			if(!is_dir( Constant::DEFAULT_LOGS_DIRECTORY.'exports/'.date('Ymd').'/export_immo_france_'.$this -> _param['codeAgence']) ){
				mkdir(Constant::DEFAULT_LOGS_DIRECTORY.'exports/'.date('Ymd').'/export_immo_france_'.$this -> _param['codeAgence']);
				chmod(Constant::DEFAULT_LOGS_DIRECTORY.'exports/'.date('Ymd').'/export_immo_france_'.$this -> _param['codeAgence'], 0777);
			}
			copy($this -> _tmpFolder.'log.txt', Constant::DEFAULT_LOGS_DIRECTORY.'exports/'.date('Ymd').'/export_immo_france_'.$this -> _param['codeAgence'].'/log.txt');
			copy($this -> _tmpFolder . $this -> _param['codeAgence'] . '.zip', Constant::DEFAULT_LOGS_DIRECTORY.'exports/'.date('Ymd').'/export_immo_france_'.$this -> _param['codeAgence'].'/'.$this -> _param['codeAgence'] . '.zip');
		}

	}
}
$objExport = new Export_immo_france($pdo, $passerelle);
//unset($objExport);
