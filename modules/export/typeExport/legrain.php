<?php
require_once 'modelExport.php';
require_once Constant::DEFAULT_MODULE_DIRECTORY.'export_site/model/requires.php' ;
if(!class_exists( Export_legrain )){

	class Export_legrain implements modelExport{

		private $_passerelle;
		private $_pdo;
		private $_liaisons;
		private $_h_generate;
		private $_param;
		private $_tmpFolder;
		private $_dateFichier;
		private $_nameOfZip;

		public function __construct(PDO $pdo, Passerelle $passerelle){
			$this->_dateFichier = time();
			// creation du repertoire tmp
				
			$this->_tmpFolder = Constant::DEFAULT_TMP_DIRECTORY.'export_legrain_'.$this->_dateFichier.'/';
			if(!is_dir($this->_tmpFolder)){
				mkdir($this->_tmpFolder,0777);chmod($this->_tmpFolder,0777);
			}
			$this->_passerelle =  $passerelle;
			$this->_param = unserialize($this->_passerelle->getParam());
			$this->_pdo = $pdo;

			$this->_h_generate = date('YmdHis');
			$this->getListToExport();
			$this->_nameOfZip = "legrain";
			if($this->generateTmpFiles()){
				// go upload ftp
				$this->sendOnFtp();
			}
		}

		public function __destruct(){
			// copie des autres
			// 			$this->_recursive_rmdir($this->_tmpFolder);
			foreach (glob($this->_tmpFolder.'*') as $fi) {
				if (is_file($fi)) {
					@unlink($fi);
				}
			}
			@rmdir($this -> _tmpFolder);
		}
		private function setLog($log){
			$fp = fopen($this -> _tmpFolder.'log.txt', 'a');
			fwrite($fp, $log);
			fclose($fp);
		}
		private function _recursive_rmdir($dirname, $followLinks = false)
		{
			if (is_dir($dirname) && !is_link($dirname))
			{
				if (!is_writable($dirname))
				throw new Exception('You do not have renaming permissions!');

				$iterator = new RecursiveIteratorIterator(
				new RecursiveDirectoryIterator($dirname),
				RecursiveIteratorIterator::CHILD_FIRST
				);

				while ($iterator->valid())
				{
					if (!$iterator->isDot())
					{
						if (!$iterator->isWritable())
						{
							throw new Exception(sprintf(
                        'Permission Denied: %s.',
							$iterator->getPathName()
							));
						}
						if ($iterator->isLink() && false === (boolean) $followLinks)
						{
							$iterator->next();
						}
						if ($iterator->isFile())
						{
							unlink($iterator->getPathName());
						}
						else if ($iterator->isDir())
						{
							@rmdir($iterator->getPathName());
						}
					}

					$iterator->next();
				}
				unset($iterator); // Fix for Windows.

				return rmdir($dirname);
			}
			else
			{
				throw new Exception(sprintf('Directory %s does not exist!', $dirname));
			}
		}
		// on récupere la liste des liaisons.
		private function getListToExport(){
			$this->_liaisons =  LiasonPasserelleMandat::loadByPasserelle($this->_pdo,$this->_passerelle);
		}

		private function generateTmpFiles(){
			// creation du xml; du zip et touti cointi
			$xml = new SimpleXMLElement("<?xml version=\"1.0\" encoding=\"utf-8\" ?><lgr></lgr>");
			//$body = $xml -> addChild("Body");
			//$addAdverts = $body -> addChild('add_adverts');
				
			// 			$codeAgence = $this -> _param['codeAgence'];
			$nameOfZip = $this->_nameOfZip;
			$filenameZipArchive = $this -> _tmpFolder . $nameOfZip . '.zip';
			if (!is_file($filenameZipArchive)) {
				touch($filenameZipArchive);
				chmod($filenameZipArchive, 0777);
			}
				
			$zip = new ZipArchive();
			$zip -> open($filenameZipArchive, ZIPARCHIVE::CREATE);




			// répertoire de log
			if(!is_dir( Constant::DEFAULT_LOGS_DIRECTORY.'exports/'.date('Ymd') )){
				mkdir(Constant::DEFAULT_LOGS_DIRECTORY.'exports/'.date('Ymd'));
				chmod(Constant::DEFAULT_LOGS_DIRECTORY.'exports/'.date('Ymd'), 0777);
			}
			if(!is_dir( Constant::DEFAULT_LOGS_DIRECTORY.'exports/'.date('Ymd').'/export_legrain_'.$this->_dateFichier.'/') ){
				mkdir(Constant::DEFAULT_LOGS_DIRECTORY.'exports/'.date('Ymd').'/export_legrain_'.$this->_dateFichier.'/');
				chmod(Constant::DEFAULT_LOGS_DIRECTORY.'exports/'.date('Ymd').'/export_legrain_'.$this->_dateFichier.'/', 0777);
			}
				
			$se = SiteExport::load($this->_pdo, 1);
			$constants = $xml->addChild('constants');
				
			
			// Autres éléments
			$imagesAgences = $xml->addChild('imgAgences');
			
			
			
			
			
			// + copie des images dans la base...
			if(!is_dir( Constant::DEFAULT_PICTURE_MODULE_DIRECTORY.'export_site/images')){
				mkdir(Constant::DEFAULT_PICTURE_MODULE_DIRECTORY.'export_site/images',0777);
				chmod(Constant::DEFAULT_PICTURE_MODULE_DIRECTORY.'export_site/images', 0777);
			}
			// copie des 2 images dans le zip
			if(is_file(Constant::DEFAULT_PICTURE_MODULE_DIRECTORY.'export_site/images/'.$se->getLogo() )){
			$zip -> addFile(Constant::DEFAULT_PICTURE_MODULE_DIRECTORY.'export_site/images/'.$se->getLogo(),'logo.png');
			$imagesAgences->addChild('img','logo.png');
			}
			
			if(is_file(Constant::DEFAULT_PICTURE_MODULE_DIRECTORY.'export_site/images/'.$se->getHeader() )){
			$zip -> addFile(Constant::DEFAULT_PICTURE_MODULE_DIRECTORY.'export_site/images/'.$se->getHeader(),'header.jpg');
			$imagesAgences->addChild('img','header.jpg' );
			}
			
			
			
			// images dans : images/modules/export/site_export/logo.png et images/modules/export/site_export/header.jpg
			
			
			$constants->addChild('ROBOTS_FOLLOW',$se->getRobots());
				
			$constants->addChild('THEME',$se->getTheme()->getName());
			$constants->addChild('NB_ANNONCES_BY_PAGE',$se->getNbAnnoncesParPage());




				
			$txtAccueil = $se->getTxtIndex();
			// conversion
			
			$pattern = '!src="'.Constant::DEFAULT_URL.'/[^?#]+\.(?:jpe?g|png|gif)"!Ui';		
			// application du filtre
			preg_match_all($pattern, $txtAccueil, $matches);
			foreach($matches[0] as $elem){
				
				// elem contient le chemin ( commençant par /chemin
				$elem = str_replace(array('src="','"') , array('','') , $elem);
				
				$nomImg = explode('/', $elem);
				$nomImg = $nomImg[count($nomImg)-1];
				$nomImg = time().$nomImg;
				
				$imagesAgences->addChild('img',$nomImg);
				

					$imgLocal = str_replace(Constant::DEFAULT_URL, Constant::DEFAULT_DIRECTORY, $elem);

				$zip->addFile($imgLocal,$nomImg);
				
				// remplace l'image dans le texte
				$txtAccueil = str_replace($elem, 'images/'.$nomImg, $txtAccueil);

			}
			
			$txtAccueil = str_replace(array('<','>','&nbsp;',"'","&#39;","&euro;","&sect;","&pound;"),array('[',']',' ',"\'","\'","€","§","£"),  $txtAccueil);
			$txtAccueil = html_entity_decode($txtAccueil, ENT_COMPAT, 'UTF-8');

			$constants->addChild('TXT_INDEX',$txtAccueil);
			$constants->addChild('META_DESCRIPTION_INDEX',str_replace(array('<','>','&nbsp;',"'","&#39;"),array('[',']',' ',"\'","\'"),$se->getMetaDescriptionAccueil()));
			$constants->addChild('EMAIL_CONTACT',str_replace(array('<','>','&nbsp;',"'","&#39;"),array('[',']',' ',"\'","\'"),$se->getEmailContact()));
			$constants->addChild('NB_NOUVEAUTE_PAR_AGENCE',$se->getNbNouveauteParAgence());
			$constants->addChild('NOM_SITE',str_replace(array('<','>','&nbsp;',"'","&#39;"),array('[',']',' ',"\'","\'"),$se->getNomSite()));
			$constants->addChild('TITRE_ACCUEIL',str_replace(array('<','>','&nbsp;',"'","&#39;"),array('[',']',' ',"\'","\'"),$se->getTitreAccueil()));
			$constants->addChild('META_DESCRIPTION_ACCUEIL',str_replace(array('<','>','&nbsp;',"'","&#39;"),array('[',']',' ',"\'","\'"),$se->getMetaDescriptionAccueil() ));
			
			
			$constants->addChild('NAME_AGENCY',str_replace(array('<','>','&nbsp;',"'","&#39;"),array('[',']',' ',"\'","\'"),$se->getNameAgency() ));
			$constants->addChild('ADDRESS_AGENCY',str_replace(array('<','>','&nbsp;',"'","&#39;"),array('[',']',' ',"\'","\'"),$se->getAddressAgency() ));
			$constants->addChild('ZIP_CODE_AGENCY',str_replace(array('<','>','&nbsp;',"'","&#39;"),array('[',']',' ',"\'","\'"),$se->getZipCodeAgency() ));
			$constants->addChild('CITY_AGENCY',str_replace(array('<','>','&nbsp;',"'","&#39;"),array('[',']',' ',"\'","\'"),$se->getCityAgency() ));
			$constants->addChild('TEL_AGENCY',str_replace(array('<','>','&nbsp;',"'","&#39;"),array('[',']',' ',"\'","\'"),$se->getPhoneAgency() ));
			$constants->addChild('FAX_AGENCY',str_replace(array('<','>','&nbsp;',"'","&#39;"),array('[',']',' ',"\'","\'"),$se->getFaxAgency() ));




            $constants->addChild('URL_IMMO_MANAGEUR', Constant::DEFAULT_URL  );

            $constants->addChild('SUBJECT_EMAIL_WELCOME_CLIENT_ACCOUNT',str_replace(array('<','>','&nbsp;',"'","&#39;"),array('[',']',' ',"\'","\'"),$se->getSubjectEmailWelcomeClientAccount() ));
            $constants->addChild('EMAIL_WELCOME_CLIENT_ACCOUNT',str_replace(array('<','>','&nbsp;',"'","&#39;"),array('[',']',' ',"\'","\'"),$se->getEmailWelcomeClientAccount() ));
            $constants->addChild('SUBJECT_RESET_PASSWORD_CLIENT_ACCOUNT',str_replace(array('<','>','&nbsp;',"'","&#39;"),array('[',']',' ',"\'","\'"),$se->getSubjectEmailResetPasswordClientAccount() ));
            $constants->addChild('RESET_PASSWORD_CLIENT_ACCOUNT',str_replace(array('<','>','&nbsp;',"'","&#39;"),array('[',']',' ',"\'","\'"),$se->getEmailResetPasswordClientAccount() ));
            $constants->addChild('SUBJECT_EMAIL_CONTACT_AGENCY',str_replace(array('<','>','&nbsp;',"'","&#39;"),array('[',']',' ',"\'","\'"),$se->getSubjectEmailContactCommercial() ));

			
			foreach(SiteExportVariable::loadAll($this->_pdo) as $elem){
				$constants->addChild($elem->getExportName()  , str_replace(array('<','>','&nbsp;',"'","&#39;"),array('[',']',' ',"\'","\'"),$elem->getValue() )) ;
			}
				
				
			$cms = $xml->addChild('cms');
			// BUG
			
			foreach (Cms::loadAll($this->_pdo) as $elem){
				$page = $cms->addChild('page');
				$page->addAttribute('nameOfMenu', $elem->getCmsMenu()->getName() );
				
				$page->addChild('labelOfMenu',str_replace(array('<','>','&nbsp;',"'","&#39;"),array('[',']',' ',"\'","\'"),$elem->getPublicName()));
				$page->addChild('url',str_replace(array('<','>','&nbsp;',"'","&#39;"),array('[',']','-',"\'","\'"),$elem->getUrl()));
				$page->addChild('title',str_replace(array('<','>','&nbsp;',"'","&#39;"),array('[',']',' ',"\'","\'"),$elem->getTitle()));
				$page->addChild('description',str_replace(array('<','>','&nbsp;',),array('[',']',' '),$elem->getDescription()));
// 				$page->addChild('content',str_replace(array('<','>','&nbsp;',"'","&#39;"),array('[',']',' ',"\'","\'"),$elem->getContent()));

				
				
			
// 				$pattern = '!src="/[^?#]+\.(?:jpe?g|png|gif)"!Ui';
				// application du filtre
				$txtAccueil = $elem->getContent();
				preg_match_all($pattern, $txtAccueil, $matches);
			foreach($matches[0] as $elem){
				
				// elem contient le chemin ( commençant par /chemin
				$elem = str_replace(array('src="','"') , array('','') , $elem);
				
				$nomImg = explode('/', $elem);
				$nomImg = $nomImg[count($nomImg)-1];
				$nomImg = time().$nomImg;
				$imagesAgences->addChild('img',$nomImg);
					$imgLocal = str_replace(Constant::DEFAULT_URL, Constant::DEFAULT_DIRECTORY, $elem);
				$zip->addFile($imgLocal,$nomImg);
				// remplace l'image dans le texte
				$txtAccueil = str_replace($elem, 'images/'.$nomImg, $txtAccueil);
			}
					
				$txtAccueil = str_replace(array('<','>','&nbsp;',"&euro;","&sect;","&pound;"),array('[',']',' ',"€","§","£"),  $txtAccueil);
				$txtAccueil = html_entity_decode($txtAccueil, ENT_COMPAT, 'UTF-8');
				$page->addChild('content',$txtAccueil );
				
			}
				
			$fourchetteP = $xml->addChild('fourchettesPrix');
			foreach (SiteExportFourchettePrix::loadAll($this->_pdo) as $elem){
				$fp = $fourchetteP->addChild('fourchettePrix',$elem->getName());
				$fp->addAttribute('typeTransaction', $elem->getTransactionType()->getId() );
				$fp->addAttribute('typeBien', $elem->getMandateType()->getId());
				$fp->addAttribute('min', $elem->getValMin());
				$fp->addAttribute('max', $elem->getValMax());
			}
				
			$fourchetteT = $xml->addChild('fourchettesTaille');
			foreach (SiteExportFourchetteTaille::loadAll($this->_pdo) as $elem){
				$fp = $fourchetteT->addChild('fourchetteTaille',$elem->getName());
				$fp->addAttribute('typeTransaction', $elem->getTransactionType()->getId() );
				$fp->addAttribute('typeBien', $elem->getMandateType()->getId());
				$fp->addAttribute('min', $elem->getValMin());
				$fp->addAttribute('max', $elem->getValMax());
			}
				
			// contient les annonces
			$annonces = $xml->addChild('annonces');
			foreach ($this->_liaisons as $l) {
				// On récupere le mandat
				$m = $l -> getMandate();
				$user = $m->getUser();
				$ag = $user->getAgency();
				// si le mandat est en etat à louer/a vendre
				if($m->getEtap()->getId() == Constant::ID_ETAP_TO_SELL){
					// annonce en cours
					$annonce = $annonces->addChild('annonce');
					$tb = $annonce->addChild('typeBien',$m->getMandateType()->getName());
					$tb->addAttribute('id', $m->getMandateType()->getId());
					$tt = $annonce->addChild('typeTransaction',$m->getTransactionType()->getName());
					$tt->addAttribute('id', $m->getTransactionType()->getId());
					$ref = $annonce->addChild('numMandat',$m->getNumberMandate());
					$ref->addAttribute('id', $m->getId() );
					$se = $annonce->addChild('secteur',$m->getCity()->getSector()->getName() );
					$se->addAttribute('id', $m->getCity()->getSector()->getId());
					$ville = $annonce->addChild('ville',$m->getCity()->getName() );
					$ville->addAttribute('id', $m->getCity()->getId());
					$ville->addAttribute('sector', $m->getCity()->getSector()->getId());
					$annonce->addChild('cp',$m->getCity()->getZipCode());
					$annonce->addChild('prixFAI', round($m->getPriceFai(),0) );
					$annonce->addChild('description',$m->getPubInternet());
					$annonce->addChild('chauffage',$m->getHeating()?$m->getHeating()->getName():'' );
					$annonce->addChild('orientation',$m->getOrientation()?$m->getOrientation()->getName():'');
					$annonce->addChild('anneeConstruction',$m->getAnneeConstruction()==0?$m->getAnneeConstruction():'');

						
					$a = $annonce->addChild('agence',$ag->getGeneralName());
					$a->addAttribute('id', $ag->getId());
					$annonce->addChild('tel1Agence',$ag->getTel1());
					$annonce->addChild('tel2Agence',$ag->getTel2());
					$annonce->addChild('tel3Agence',$ag->getTel3());
					$annonce->addChild('mailAgence',$ag->getEmail());
						
					$annonce->addChild('emailCommercial',$user->getEmail());
					$valDpe =ValDpe::loadByMandate($this->_pdo, $m);
						
					$annonce->addChild('CES',$valDpe?$valDpe->getConsoEner():'' );
					$annonce->addChild('GES',$valDpe?$valDpe->getEmissionGaz():'' );
						
					$annonce->addChild('typeTerrain',$m->getMandateType()->getId()==Constant::ID_PLOT_OF_LAND?$m->getTypeTerrain():'');
						
					$annonce->addChild('superficieConstructible',$m->getSuperficieConstructible());
					$annonce->addChild('superficieNonConstructible',$m->getSuperficieNonConstructible());
					$annonce->addChild('superficieTotale',$m->getSuperficieTotale());
					if($m->getMandateType()->getId()==Constant::ID_PLOT_OF_LAND){

						if($m->getTerrainVenduNonViabilise()==1){
								
							$terrainVendu = 'Non viabilisé';
						}elseif($m->getTerrainVenduSemiViabilise()==1){
							$terrainVendu = 'Semi viabilisé';
						}elseif( $m->getTerrainVenduViabilise()==1 ){
							$terrainVendu = 'Viabilisé';
						}else{
							$terrainVendu = 'NC';
						}
					}else{
						$terrainVendu = '';
					}
					$annonce->addChild('terrainVendu',$terrainVendu);
					$annonce->addChild('toutAEgout',$m->getToutALegout());
					$annonce->addChild('fosseSceptique',$m->getAssainissementParFosseSceptique());
					$annonce->addChild('proximiteEcole',$m->getProximiteEcole());
					$annonce->addChild('proximiteCommerce',$m->getProximiteCommerce());
					$annonce->addChild('proximiteTransport',$m->getProximiteTransport());
					$annonce->addChild('nbPiece',$m->getNbPiece());
					$annonce->addChild('surfaceHabitable',$m->getSurfaceHabitable() );
					$annonce->addChild('nbChambre',$m->getNbChambre() );
					$annonce->addChild('surfacePieceVie',$m->getSurfacePieceVie() );
					$annonce->addChild('niveau',$m->getNiveau() );
					$annonce->addChild('coupCoeur',$m->getCoupCoeur() );
					$annonce->addChild('nouveaute',date(Constant::DATE_FORMAT2,$m->getNouveaute()) );
					$annonce->addChild('cheminee',$m->getCheminee() );
					$annonce->addChild('cuisineEquipee',$m->getCuisineEquipee() );
					$annonce->addChild('cuisineAmenagee',$m->getCuisineAmenagee() );
					$annonce->addChild('piscine',$m->getPiscine() );
					$annonce->addChild('poolHouse',$m->getPoolHouse() );
					$annonce->addChild('terrasse',$m->getTerrasse() );
					$annonce->addChild('mezzanine',$m->getMezzanine() );
					$annonce->addChild('dependance',$m->getDependance() );
					$annonce->addChild('gaz',$m->getGaz() );
					$annonce->addChild('cave',$m->getCave() );
					$annonce->addChild('sousSol',$m->getSousSol() );
					$annonce->addChild('garage',$m->getGarage() );
					$annonce->addChild('parking',$m->getParking() );
					$annonce->addChild('rezDeJardin',$m->getRezDeJardin() );
					$annonce->addChild('plainPied',$m->getPlainPied() );
					$annonce->addChild('carriere',$m->getCarriere() );
					$annonce->addChild('ptEau',$m->getPointEau() );
					$annonce->addChild('style',$m->getStyle()?$m->getStyle()->getName():'' );
					$annonce->addChild('constructionType',$m->getConstruction()?$m->getConstruction()->getName():'' );
					$listP = $annonce -> addChild('photos');
					$annonce->addChild('situationTerrain',$m->getSituationTerrain() );
					$i=1;
					foreach (PhotosExports::loadByMandate($this->_pdo,$m) as $pict) {
							
						//var_dump($listPhotos);
						$module = $m -> getMandateType() -> getIdMandateType() == Constant::ID_PLOT_OF_LAND ? 'terrain' : 'mandat';
							
						if (is_file(Constant::DEFAULT_PICTURE_MODULE_DIRECTORY . $module . '/' . $pict -> getName())) {
							$time = $this->_h_generate;
							copy(Constant::DEFAULT_PICTURE_MODULE_DIRECTORY . $module . '/' . $pict -> getName(), $this -> _tmpFolder . $time . '-' . $m -> getIdMandate() . '_' . $i . '.jpg');
							chmod($this -> _tmpFolder . $time . '-' . $m -> getIdMandate() . '_' . $i . '.jpg', 0777);
								
							if(!$zip -> addFile($this -> _tmpFolder . $time . '-' . $m -> getIdMandate() . '_' . $i . '.jpg', $time . '-' . $m -> getIdMandate() . '_' . $i . '.jpg')){
								$this->setLog(date('Y-m-d H:i:s')." - Photo non incluse (".time('ymdHis') . '-' . $m -> getIdMandate() . '_' . $i . '.jpg'.") dans le zip \n");
								mail('julien@legrain.fr','escal82.com','Erreur lors de l\'export de top annonce ( Photo non incluse ('.$time . '-' . $m -> getIdMandate() . '_' . $i . '.jpg'.') dans le zip)');
							}
								
							$listP -> addChild('photo', $time . '-' . $m -> getIdMandate() . '_' . $i . '.jpg');
								
						}
						// Copie des images dans les logs.
						copy($this -> _tmpFolder. $time . '-' . $m -> getIdMandate() . '_' . $i . '.jpg', Constant::DEFAULT_LOGS_DIRECTORY.'exports/'.date('Ymd').'/export_legrain_'.$this->_dateFichier.'/'. $time . '-' . $m -> getIdMandate() . '_' . $i . '.jpg');
						$i++;
					}
				}
			}
				
			
			

				

				
			if(!$xml -> asXml($this -> _tmpFolder . $nameOfZip . '.xml')){
				$this->setLog(date('Y-m-d H:i:s')." - Fichier xml non renseigné \n");
				mail('julien@legrain.fr','escal82.com','Erreur lors de l\'export de legrain ( xml vide)');
			}

			// Copie du xml ( dans les logs).
			copy($this -> _tmpFolder.$nameOfZip . '.xml', Constant::DEFAULT_LOGS_DIRECTORY.'exports/'.date('Ymd').'/export_legrain_'.$this->_dateFichier.'/'.$nameOfZip . '.xml');

				



			// ajout du xml dans le zip.
			if(!$zip -> addFile($this -> _tmpFolder . $nameOfZip . '.xml', $nameOfZip . '.xml')){
				$this->setLog(date('Y-m-d H:i:s')." - Fichier xml non inclus dans le zip \n");
				mail('julien@legrain.fr','escal82.com','Erreur lors de l\'export de top annonce ( xml non inclus dans le zip)');
			}
			$zip -> close();
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
			// suppression du zip
			@$ftp -> rm($this -> _nameOfZip . '.zip');
			// on uploade le zip
			$this->setLog(date('Y-m-d H:i:s')." - Début du transfert \n");
			if($ftp -> upload($this ->_nameOfZip . '.zip', $this -> _tmpFolder . $this -> _nameOfZip . '.zip', FTP_BINARY)){
				$this->setLog(date('Y-m-d H:i:s')." - Fin du transfert ftp \n");
				$this->setLog(date('Y-m-d H:i:s')." - Taille des éléments présents sur le ftp \n");
				foreach ($ftp->ls() as $l){
					if( $l== $this -> _nameOfZip . '.zip')
					$this->setLog(date('Y-m-d H:i:s')." - ".$l.' ..... '.$ftp->ftp_size($l)."\n");
				}

			}else{
				$this->setLog(date('Y-m-d H:i:s')." - Echec du transfert ftp \n");
				mail('julien@legrain.fr', 'escal82.com', 'Erreur lors d\'un export ( type legrain)');
			}

			unset($ftp);
			$this->setLog(date('Y-m-d H:i:s')." - fin de connexion ftp \n");

				

			// Copie du zip et des log puis suppression....
			if(!is_dir( Constant::DEFAULT_LOGS_DIRECTORY.'exports/'.date('Ymd') )){
				mkdir(Constant::DEFAULT_LOGS_DIRECTORY.'exports/'.date('Ymd'));
				chmod(Constant::DEFAULT_LOGS_DIRECTORY.'exports/'.date('Ymd'), 0777);
			}
			if(!is_dir( Constant::DEFAULT_LOGS_DIRECTORY.'exports/'.date('Ymd').'/export_legrain_'.$this ->_h_generate) ){
				mkdir(Constant::DEFAULT_LOGS_DIRECTORY.'exports/'.date('Ymd').'/export_legrain_'.$this ->_h_generate);
				chmod(Constant::DEFAULT_LOGS_DIRECTORY.'exports/'.date('Ymd').'/export_legrain_'.$this -> _h_generate, 0777);
			}
			copy($this -> _tmpFolder.'log.txt', Constant::DEFAULT_LOGS_DIRECTORY.'exports/'.date('Ymd').'/export_legrain_'.$this -> _h_generate.'/log.txt');
			copy($this -> _tmpFolder . $this ->_nameOfZip . '.zip', Constant::DEFAULT_LOGS_DIRECTORY.'exports/'.date('Ymd').'/export_legrain_'.$this -> _h_generate.'/'.$this -> _nameOfZip . '.zip');

		}
	}


}
$objExport = new Export_legrain($pdo, $passerelle);
unset($objExport);