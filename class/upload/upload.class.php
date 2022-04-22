<?php
/**
 * Description of upload.class
 *
 * @author julien Vernet
 */
class upload {

	// variables de classe :
	private $extension;  // table contenant toutes les extensions
	private $taille;
	private $fichier;
	private $Temp;
	private $Nom;
	private $Type;
	private $cheminUpload;



	// Constructeur
	function __construct() {
		$this->init();

	}
	// destructeur
	function __destruct() {
		unset($this->extension);
		unset($this->taille);
		unset($this->fichier);
		unset($this->Temp);
		unset($this->Nom);
		unset($this->Type);
		unset($this->cheminUpload);


	}
	// initialisation de la classe
	private function init() {
		$this->extension= array('jpg');
		$this->taille= '1000000';
	}
	private function error() {
		$erreur= "";
		switch ($this->fichier['error']) {
			case 1:
				$erreur = "Votre image doit faire moins de $this->taille Ko !";
				break;
			case 2:
				$erreur = "Votre image doit faire moins de $this->taille Ko !";
				break;
			case 3:
				$erreur= "L'image n'a &eacute;t&eacute; que partiellement t&eacute;l&eacute;charg&eacute;.";
				break;
			case 4:
				$erreur = "Aucun fichier n'a &eacute;t&eacute; t&eacute;l&eacute;charg&eacute;.";
				break;
			case 6:
				$erreur = "Un dossier temporaire est manquant.";
				break;
			case 7:
				$erreur = "&eacute;chec de l'&eacute;criture du fichier sur le disque.";
				break;
			case 8:
				$erreur = "Echec lors de l'upload.";
				break;
			case 9:
				$erreur = "Impossible de changer les droits du document import&eacute;.";
				break;
			case 10:
				$erreur = "l'extention n'est pas correcte (celle(s) utilis&eacute;e(s) est/sont : ";
				foreach($this->extension as $ext) {
					$erreur.=" ".$ext;
				}
				$erreur .=").";
				break;
		}
		return $erreur;
	}

	private function upload($zip=false,$all_extension=false) {
		$this->Temp = $this->fichier['tmp_name'];
		$this->Nom  = $this->fichier['name'];
		$this->Type = $this->fichier['type'];
		if($this->error()!='') {
			return false;
		}
		else {
			if(!$all_extension) {
				if(!$this->verifExtention()) {
					$this->fichier['error'] = 10;
					return false;
				}
			}
			//            }else {
			if($zip) {
				// Zip du fichier
			}
			if($this->copieFichier()) {
				// Changement de droits
				if($this->changeDroits())
				return true;
				else {
					// Ajout d'une erreur
					$this->fichier['error'] = 9;
					return false;
				}
			}
			else {
				// Ajout d'une erreur
				$this->fichier['error'] = 8;
				return false;
			}
		}

		//        }

	}
	public function copy($newLocation){
		return !copy($this->getFichier(), $newLocation.$this->getNomFichier())?false:true;
	}
	public function create_miniature($chemin_destination,$x,$y) {
		if (!copy($this->getFichier(), $chemin_destination.$this->getNomFichier()))
		return false;
		else
		return $this->redimentionne($chemin_destination.$this->getNomFichier(), $x, $y);
	}
	private function redimentionne($file,$x,$y) {

		$size = getimagesize($file);

		if ( $size) {
			//echo 'Image en cours de redimensionnement...
			//';

			if ($size['mime']=='image/jpeg' ) {
				$img_big = imagecreatefromjpeg($file); # On ouvre l'image d'origine
				$img_new = imagecreate($x, $y);
				# création de la miniature
				$img_mini = imagecreatetruecolor($x, $y)
				or   $img_mini = imagecreate($x, $y);

				// copie de l'image, avec le redimensionnement.
				imagecopyresized($img_mini,$img_big,0,0,0,0,$x,$y,$size[0],$size[1]);

				imagejpeg($img_mini,$file );

			}
			elseif ($size['mime']=='image/png' ) {
				$img_big = imagecreatefrompng($file); # On ouvre l'image d'origine
				$img_new = imagecreate($x, $y);
				# création de la miniature
				$img_mini = imagecreatetruecolor($x, $y)
				or   $img_mini = imagecreate($x, $y);

				// copie de l'image, avec le redimensionnement.
				imagecopyresized($img_mini,$img_big,0,0,0,0,$x,$y,$size[0],$size[1]);

				imagepng($img_mini,$file );

			}
			elseif ($size['mime']=='image/gif' ) {
				$img_big = imagecreatefromgif($file); # On ouvre l'image d'origine
				$img_new = imagecreate($x, $y);
				# création de la miniature
				$img_mini = imagecreatetruecolor($x, $y)
				or   $img_mini = imagecreate($x, $y);
				// copie de l'image, avec le redimensionnement.
				imagecopyresized($img_mini,$img_big,0,0,0,0,$x,$y,$size[0],$size[1]);

				imagegif($img_mini,$file );
			}
			return true;
		}else {
			return false;
		}
	}

	private function changeDroits($droit = 0777) {
		return(chmod($this->getFichier(), $droit))?true:false;
	}
	// retourne true si l'extention est correcte
	private function verifExtention() {
		$ext=strtolower(substr(strrchr($this->Nom,'.'),1));
		for($i=0;$i<count($this->extension);$i++) {
			if($this->extension[$i]==$ext) {
				return true;
			}
		}
		return false;
	}

	private function copieFichier() {
		return (move_uploaded_file($this->Temp, $this->cheminUpload . $this->Nom))?true:false;
	}

	// fonction principale de traitement
	public function goUpload($zip=false,$all_extension=false) {
		return $this->upload($zip,$all_extension);
	}
	public function goRedimension($file,$x,$y) {
		return $this->redimentionne($file, $x, $y);
	}
	public function rename($newName,$file = null) {
		if($file ==null) $file = $this->getFichier();
		rename($file, $this->cheminUpload.$newName);
		$this->Nom = $newName;
	}
	// Accèsseurs
	public function setExtension() {
		$numargs = func_num_args();
		for($i=0; $numargs!=$i;$i++) {
			$this->extension[$i]= func_get_arg($i);
		}
		return $this;
	}
	public function getExtension() {
		return $this->extension;
	}
	public function setTaille($taille) {
		$this->taille=$taille;
		return $this;
	}
	public function getTaille() {
		return $this->taille;
	}
	public function setFichier($fichier) {
		$this->fichier= $fichier;
		return $this;
	}
	public function getFichier() {
		return $this->cheminUpload.$this->Nom;
	}
	public function getNomFichier() {
		return $this->Nom;
	}
	public function setCheminUpload($chemin) {
		$this->cheminUpload= $chemin;
		return $this;
	}
	public function getCheminUpload() {
		return $this->cheminUpload;
	}
	public function afficheError() {
		return $this->error();
	}


}

?>
