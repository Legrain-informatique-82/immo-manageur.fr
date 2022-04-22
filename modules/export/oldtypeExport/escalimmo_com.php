<?php
require_once 'modelExport.php';
if(!class_exists( Export_escalimmo_com )){
	class Export_escalimmo_com implements modelExport{

		private $_passerelle;
		private $_pdo;
		private $_liaisons;
		private $_h_generate;
		private $_param;
		private $_tmpFolder;
		public function __construct(PDO $pdo, Passerelle $passerelle){
			// creation du repertoire tmp
			$this->_tmpFolder = Constant::DEFAULT_TMP_DIRECTORY.'export_escalimmo_com/';
			if(!is_dir($this->_tmpFolder)){
				mkdir($this->_tmpFolder,0777);chmod($this->_tmpFolder,0777);
			}
			$this->_passerelle =  $passerelle;
			$this->_param = unserialize($this->_passerelle->getParam());
			$this->_pdo = $pdo;

			$this->_h_generate = date('YmdHis');
			$this->getListToExport();
			if($this->generateTmpFiles()){
				// go upload ftp
				$this->sendOnFtp();
			}
		}

		public function __destruct(){
			$this->_recursive_rmdir($this->_tmpFolder);
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
			foreach($this->_liaisons as $l){
				// On récupere le mandat
				$m = $l->getMandate();
				// si le mandat est en etat à louer/a vendre
				if($m->getEtap()->getId() == Constant::ID_ETAP_TO_SELL){

					$ag = $m->getUser()->getAgency();
					// une fois fixé avec les autres exports, voir si on ajoute le code ds la Bdd
					switch( $ag->getIdAgency()  ){
						case 1:
							$idAg = 'escal8202-p';
							break;
						case 2:
							$idAg = 'escal8201-p';
							break;
						case 3:
							$idAg = 'escal8203-p';
							break;
						case 4:
							$idAg = 'escal8204-p';
							break;
					}
					// déplacement des photos vers tmp // nom de l'agence.
					$i=1;
					if(!is_dir($this->_tmpFolder.'pictures')){
						mkdir($this->_tmpFolder.'pictures',0777);chmod($this->_tmpFolder.'pictures',0777);
					}
					//		if(!is_dir($this->_tmpFolder.'pictures/'.$idAg)){mkdir($this->_tmpFolder.'pictures/'.$idAg,0777);chmod($this->_tmpFolder.'pictures/'.$idAg,0777);}
					// utilisation de la table des imports

					// lister les pictures partagés uniquement
					$picts = PhotosExports::loadByMandate( $this->_pdo,$m );
					//foreach( $m->listPictures() as $pict ){
					foreach($picts as $pict ){
						$module = $m->getMandateType()->getIdMandateType() == Constant::ID_PLOT_OF_LAND?'terrain':'mandat';
						if (is_file( Constant::DEFAULT_PICTURE_MODULE_DIRECTORY.$module.'/'.$pict->getName() )) {
							copy(
							Constant::DEFAULT_PICTURE_MODULE_DIRECTORY.$module.'/'.$pict->getName(),
							$this->_tmpFolder.'pictures/'.$this->_h_generate.'_'.$idAg.'_'.$m->getIdMandate().'-'.$i.'.jpg'
							);
						}
						$i++;
					}
					// creation des fichiers bases
					$base = $this->_tmpFolder.'base';
					if(!is_dir($this->_tmpFolder.'base')){
						mkdir($this->_tmpFolder.'base',0777);chmod($this->_tmpFolder.'base',0777);
					}
					$valDpe = ValDpe::loadByMandate($this->_pdo,$m);
					$filename = $base.'/'.$this->_h_generate.'_'.$idAg.'.aff';
					$line = '';

					$line.=$m->getTransactionType()->getExportCode().';'; // 1
					$line.=$m->getMandateType()->getExportCode().';'; // 2
					$line.=$m->getIdMandate().';'; //  code affaire : AN(11) 3
					$line.=$m->getNumberMandate().';';//    no mandat : AN(15)4
					$line.=$m->getCity()->getZipCode().';';//    cp : AN(5)
					$line.=$m->getCity()->getName().';';//    ville : AN(40)
					$line.=';';//    Prix mandat : F
					$line.=$m->getPriceFai().';';//    Prix mandat euro : F
					$line.=$m->getCity()->getSector()->getName().';';//    secteur : AN(30)
					$line.=preg_replace("(\r\n|\n|\r)",'',str_replace('"', "'",preg_replace("%\n%", "<BR>", $m->getPubInternet()))).';'; //    pub : AN(512) voir pour echaper le caractere ;
					$line.=$m->getNbPiece()==0?';':$m->getNbPiece().';';
					$line.=$m->getNbChambre()==0?';':$m->getNbChambre().';';//    nb de chambres : I
					$line.=$m->getSurfaceHabitable()==0?';':$m->getSurfaceHabitable().';';//    surface habitable : I
					$line.=$m->getSuperficieTotale()==0?';':$m->getSuperficieTotale().';';//    surface terrain : I
					$line.=$m->getNiveau()==0?';':$m->getNiveau().';';//    niveaux : I
					$line.=str_replace(0,'','').';';//    etage : I VIDE
					$line.=$m->getAnneeConstruction()==0?';':$m->getAnneeConstruction().';';//    annee construction : I
					$line.='N'.';';//    jardin : B(O/N)
					$line.='N;';//    digicode : B(O/N)
					$line.='N'.';';//    jardin : B(O/N)
					$line.='N'.';';//    balcon : B(O/N)
					$line.=$m->getTerrasse()?'O;':'N;';//    terrasse : B(O/N)
					$line.=$m->getCave()?'O;':'N;';//    cave : B(O/N)
					$line.='N;';//    acsenceur : B(O/N)
					$line.=$m->getGarage()?'O;':'N;';//    garage : B(O/N)
					$line.=$m->getParking()?'O;':'N;';//    parking : B(O/N)
					$line.=$m->getHeating()?$m->getHeating()->getName().';':';';//    chauffage : AN(50)
					$line.=';';//    nb salle de bains : I OU PAS
					$line.=';';//    nb WC : I OU PAS
					$line.=$m->getOrientation()?$m->getOrientation()->getCode().';':';';//    orientation : AN(50)
					$line.=date('Y-m-d H:i:s',$m->getInitDate() ).';';//    DateModif :D
					$line.=$m->getCoupCoeur()==1?'COUP-DE-COEUR;':';';		//    categorieinternet  : AN(50)
					$line.=$m->getTypeTerrain().';';//    TexteInternet1  : AN(512) // type terrain ( 0 = NC, 1 = batir, 2 = lotir)
					$line.=$m->getCity()->getSector()->getName().';';//    TexteInternet2   : AN(512) // secteur ?
					$line.=';';//    TexteInternet3   : AN(512)
					$line.=';';//    Stationnement    : AN(50)
					$line.=';';//    URLVisiteVirtuelle1 : AN(512)
					$line.=';';//    URLVisiteVirtuelle2 : AN(512)
					$line.=';';//    URLVisiteVirtuelle3 : AN(512)
					$line.=';';//    CritN1  : F
					$line.=';';//    CritN2  : F
					$line.=';';//    CritN3  : F
					$line.=';';//    CritN4  : F
					$line.=';';//    CritC1  : AN(250)
					$line.=';';//    CritC2  : AN(250)
					$line.=';';//    CritC3  : AN(250)
					$line.=';';//    CritC4  : AN(250)
					$line.=';';//    CritD1  : D
					$line.=';';//    CritD2  : D
					$line.=';';//    CritD3  : D
					$line.=';';//    CritD4  : D
					// other

					$line.=$m->getNouveaute()==null?';':date('Y-m-d',$m->getNouveaute()).';'; // nouveauté
					$line.=$valDpe==null?'0;':$valDpe->getConsoEner().';'; // DPE consomation energetique
					$line.=$valDpe==null?'0':$valDpe->getEmissionGaz(); // Dpe emission de gaz

					//$line.=';';//    Fin de fichier
					$fh = fopen($filename, 'a');
					fwrite($fh, "$line\n");
					fclose($fh);
					// ajout de la ligne dans l'historique du mandat
					LogTransfert::create($this->_pdo,$this->_passerelle,$m,time());
				}
			}
			return true;
		}
		private function sendOnFtp(){
			// déplace les fichiers de bdd et les photos
			$ftp = new ftp($this->_param['ftp']['host'],$this->_param['ftp']['user'],$this->_param['ftp']['password']);
			$ftp->connexion();
			$ftp->cd('Perso');
			foreach($ftp->ls() as $file){
				// suppression des fichiers présent dans le dossier Perso (bdd)
				if(!@$ftp->rm($file))@$ftp->rmdir($file);
			}
			// on boucle sur le contenu de tmp Base et on l'uploade
			foreach( glob($this->_tmpFolder.'base/*') as $fileToUpload){
				$name = explode('/',$fileToUpload);
				$name = $name[count($name)-1];
				$ftp->upload($name,$fileToUpload,FTP_BINARY);
			}
			// idem pour les images
			$ftp->cd('../Photos');
			foreach($ftp->ls() as $file){
				// suppression des fichiers présent dans le dossier Pictures (img)
				if(!@$ftp->rm($file))@$ftp->rmdir($file);
			}
			// on boucle sur le contenu de tmp Base et on l'uploade
			foreach( glob($this->_tmpFolder.'pictures/*') as $fileToUpload){
				$name = explode('/',$fileToUpload);
				$name = $name[count($name)-1];
				$ftp->upload($name,$fileToUpload,FTP_BINARY);
			}
			unset($ftp);
		}
	}
}
$objExport = new Export_escalimmo_com($pdo, $passerelle);
unset($objExport);