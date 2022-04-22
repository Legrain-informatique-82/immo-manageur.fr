<?php
require_once 'modelExport.php';
if (!class_exists(Export_top_Annonces)) {
	class Export_top_Annonces implements modelExport {

		private $_passerelle;
		private $_pdo;
		private $_liaisons;
		private $_h_generate;
		private $_param;
		private $_tmpFolder;
		public function __construct(PDO $pdo, Passerelle $passerelle) {
			// creation du repertoire tmp
			$this -> _tmpFolder = Constant::DEFAULT_TMP_DIRECTORY . 'export_top_annonces/';
			if (!is_dir($this -> _tmpFolder)) {
				mkdir($this -> _tmpFolder, 0777);
				chmod($this -> _tmpFolder, 0777);
			}
			$this -> _passerelle = $passerelle;
			$this -> _param = unserialize($this -> _passerelle -> getParam());
			$this -> _pdo = $pdo;

			/*
			 $test2=array('codeAgence'=>'212a','ftp'=> array( 'host'=>'monftp-1.net', 'user'=>'immofrance1','password'=>'immofrance1'));
			echo serialize( $test2 );
			*/

			//$this -> _h_generate = date('YmdHis');
			$this -> getListToExport();
			if ($this -> generateTmpFiles()) {
				// go upload ftp
				$this -> sendOnFtp();

			}
		}

		public function __destruct() {

			foreach (glob($this->_tmpFolder.'*') as $fi) {
				if (is_file($fi)) {
					@unlink($fi);
				}
			}
			@rmdir($this -> _tmpFolder);

		}

		private function _recursive_rmdir($dirname, $followLinks = false) {
			if (is_dir($dirname) && !is_link($dirname)) {
				if (!is_writable($dirname))
				throw new Exception('You do not have renaming permissions!');

				$iterator = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($dirname), RecursiveIteratorIterator::CHILD_FIRST);

				while ($iterator -> valid()) {
					if (!$iterator -> isDot()) {
						if (!$iterator -> isWritable()) {
							throw new Exception(sprintf('Permission Denied: %s.', $iterator -> getPathName()));
						}
						if ($iterator -> isLink() && false === (boolean)$followLinks) {
							$iterator -> next();
						}
						if ($iterator -> isFile()) {
							unlink($iterator -> getPathName());
						} else if ($iterator -> isDir()) {
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
			$xml = new SimpleXMLElement("<?xml version=\"1.0\" encoding=\"utf-8\" ?><listepa></listepa>");
			//$body = $xml -> addChild("Body");
			//$addAdverts = $body -> addChild('add_adverts');

			$codeAgence = $this -> _param['codeAgence'];

			$filenameZipArchive = $this -> _tmpFolder . $codeAgence . '.zip';
			if (!is_file($filenameZipArchive)) {
				touch($filenameZipArchive);
				chmod($filenameZipArchive, 0777);
			}

			$zip = new ZipArchive();
			$zip -> open($filenameZipArchive, ZIPARCHIVE::CREATE);

			foreach ($this->_liaisons as $l) {
				// On récupere le mandat
				$m = $l -> getMandate();
				// si le mandat est en etat à louer/a vendre
				if($m->getEtap()->getId() == Constant::ID_ETAP_TO_SELL){
					$ag = $m -> getUser() -> getAgency();

					// dpe récupération des valeurs
					$dpe = ValDpe::loadByMandate($this -> _pdo, $m);

					// S'il manque des infos on passe à la ligne suivante.
					$ok =true;
					// dpe
					/*
					if(!$dpe)
					$ok=false;
					elseif($dpe->getConsoEner()==0||$dpe->getConsoEner()=='')
					$ok =false;
					if($m->getSuperficieTotale()==''||$m->getSuperficieTotale()==0)
					$ok =false;
					if($m->getNbPiece()==0||$m->getNbPiece()=='')
					$ok=false;
					if($m -> getPubInternet()=='')
					$ok=false;
					*/
					if($ok){
						if (!is_file($this -> _tmpFolder . $codeAgence . '.xml')) {
							touch($this -> _tmpFolder . $codeAgence . '.xml');
							chmod($this -> _tmpFolder . $codeAgence . '.xml', 0777);
						}

						//	$codeAgence = 'moissac';

						// une fois fixé avec les autres exports, voir si on ajoute le code ds la Bdd

						$advert = $xml -> addChild('annonce');
						//$advert->addChild('owner', $ag->getName() );
						//				$advert -> addChild('contrat', $m -> getIdMandate());
						$advert -> addChild('contrat', $codeAgence );
						$advert -> addChild('reference', $codeAgence . '-' . $m -> getIdMandate());

						$advert -> addChild('pays', 'France');
						$advert -> addChild('ville', $m -> getCity() -> getName());
						$advert -> addChild('postal', $m -> getCity() -> getZipCode());
						$advert -> addChild('prix', round($m -> getPriceFai(), 0));

						$advert -> addChild('texte', $m -> getPubInternet());
						$advert -> addChild('tel_agence', $m -> getUser() -> getAgency() -> getTel1());

						$advert -> addChild('raison_sociale', 'Agence de ' . $m -> getUser() -> getAgency() -> getName());
						$advert -> addChild('accroche_url', 'Escalimmo - Les clés de votre réussite');
						//$advert -> addChild('url', 'escalimmo.com');
						$advert -> addChild('url', $m -> getUser() -> getAgency()->getUrl() );
						switch( $m->getMandateType()->getIdMandateType() ) {
							// terrain
							case 1 :
								$habitat = 'terrain';
								break;
								//Appartement
							case 2 :
								$habitat = 'appartement';
								break;
								// maison
							case 3 :
								$habitat = 'maison';
								break;
								// parking
							case 4 :
								$habitat = 'parking';
								break;
								// box
							case 5 :
								$habitat = 'fond de commerce';
								break;
								// cheateau
							case 6 :
								$habitat = 'maison';
								break;
								// commerce
							case 7 :
								$habitat = 'fond de commerce';
								break;
								// ferme
							case 8 :
								$habitat = 'maison';
								break;
								// hangar
							case 9 :
								$habitat = 'local';
								break;
								// imeuble
							case 10 :
								$habitat = 'immeuble';
								break;
								// manoir
							case 11 :
								$habitat = 'maison';
								break;
								// propriete
							case 12 :
								$habitat = 'maison';
								break;
								// moulin
							case 13 :
								$habitat = 'fond de commerce';
								break;
								// remise
							case 14 :
								$habitat = 'local';
								break;

							default :
								$habitat = '';
							break;
						}
						$advert -> addChild('type_bien', $habitat);

						$type = $m -> getTransactionType() -> getIdTransactionType() == Constant::ID_TRANSACTION_TYPE_SELLER ? 'V' : 'L';

						$advert -> addChild('type_transaction', $type);

						/*Facultatifs*
						 *
						*/
						$complements = $advert -> addChild('complements');
						$it = $complements -> addChild('complement', $m -> getNbPiece());
						$it -> addAttribute('type', 'B');

						$it = $complements -> addChild('complement', $m -> getSuperficieTotale());
						$it -> addAttribute('type', 'SU');

						if ($dpe) {
							// mise à jr dans le tableau.
							if ($dpe -> getConsoEner()) {
								// récuperation de la lettre correspondante
								$it = $complements -> addChild('complement', DpeConsoEner::loadByValue($this -> _pdo, $dpe -> getConsoEner()) -> getName());
								$it -> addAttribute('type', 'bilan_energie');
								$it = $complements -> addChild('complement', $dpe -> getConsoEner());
								$it -> addAttribute('type', 'valeur_energie');
							} else {
								$it = $complements -> addChild('complement', 'NC');
								$it -> addAttribute('type', 'bilan_energie');
							}

							if ($dpe -> getEmissionGaz()) {

								//DpeEmissionGaz::loadAll($this->_pdo);
								$it = $complements -> addChild('complement', DpeEmissionGaz::loadByValue($this -> _pdo, $dpe -> getEmissionGaz()) -> getName());
								$it -> addAttribute('type', 'bilan_ges');
								$it = $complements -> addChild('complement', $dpe -> getEmissionGaz());
								$it -> addAttribute('type', 'valeur_ges');
							}

						} else {
							$it = $complements -> addChild('complement', 'NC');
							$it -> addAttribute('type', 'bilan_energie');
						}

						// année de construction
						if ($m -> getAnneeConstruction()) {
							$it = $complements -> addChild('complement', $m -> getAnneeConstruction());
							$it -> addAttribute('type', 'A');
						}
						if ($m -> getCuisineEquipee() != null) {
							$it = $complements -> addChild('complement', 'true');
							$it -> addAttribute('type', 'EQ');
						}

						if ($m -> getNiveau()) {
							$it = $complements -> addChild('complement', $m -> getNiveau());
							$it -> addAttribute('type', 'NI');
						}

						if ($m -> getOrientation()) {
							$it = $complements -> addChild('complement', $m -> getOrientation() -> getName());
							$it -> addAttribute('type', 'EX');
						}

						if ($m -> getCommission()) {
							$it = $complements -> addChild('complement', round($m -> getCommission(), 0));
							$it -> addAttribute('type', 'F');
						}

						if ($m -> getHeating()) {
							$it = $complements -> addChild('complement', $m -> getHeating() -> getName());
							$it -> addAttribute('type', 'TC');
						}
						if ($m -> getNbChambre()) {
							$it = $complements -> addChild('complement', $m -> getNbChambre());
							$it -> addAttribute('type', 'CH');
						}

						if ($m -> getPiscine() || $m -> getPoolHouse()) {
							$it = $complements -> addChild('complement', 'true');
							$it -> addAttribute('type', 'PI');
						}

						// enregistrement des photos
						$i = 1;
						$listP = $advert -> addChild('liste_photos');
						foreach (PhotosExports::loadByMandate($this->_pdo,$m) as $pict) {

							//var_dump($listPhotos);
							$module = $m -> getMandateType() -> getIdMandateType() == Constant::ID_PLOT_OF_LAND ? 'terrain' : 'mandat';

							if (is_file(Constant::DEFAULT_PICTURE_MODULE_DIRECTORY . $module . '/' . $pict -> getName())) {
								copy(Constant::DEFAULT_PICTURE_MODULE_DIRECTORY . $module . '/' . $pict -> getName(), $this -> _tmpFolder . time('ymdHis') . '-' . $m -> getIdMandate() . '_' . $i . '.jpg');
								chmod($this -> _tmpFolder . time('ymdHis') . '-' . $m -> getIdMandate() . '_' . $i . '.jpg', 0777);
								$zip -> addFile($this -> _tmpFolder . time('ymdHis') . '-' . $m -> getIdMandate() . '_' . $i . '.jpg', time('ymdHis') . '-' . $m -> getIdMandate() . '_' . $i . '.jpg');
								$listP -> addChild('photo', time('ymdHis') . '-' . $m -> getIdMandate() . '_' . $i . '.jpg');

							}

							$i++;
						}
						// complements
					}
				}
			}
			$xml -> asXml($this -> _tmpFolder . $codeAgence . '.xml');

			// ajout du xml dans le zip.
			$zip -> addFile($this -> _tmpFolder . $codeAgence . '.xml', $codeAgence . '.xml');
			$zip -> close();
			chmod($filenameZipArchive, 0777);
			return true;

		}

		private function sendOnFtp() {

			// déplace les fichiers de bdd et les photos
			$ftp = new ftp($this -> _param['ftp']['host'], $this -> _param['ftp']['user'], $this -> _param['ftp']['password']);
			$ftp -> connexion();
			// suppression du zip
			@$ftp -> rm($this -> _param['codeAgence'] . '.zip');
			// on uploade le zip
			$ftp -> upload($this -> _param['codeAgence'] . '.zip', $this -> _tmpFolder . $this -> _param['codeAgence'] . '.zip', FTP_BINARY);

			unset($ftp);
			
		}

	}

}
$objExport = new Export_top_Annonces($pdo, $passerelle);
//unset($objExport);
