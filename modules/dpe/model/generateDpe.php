<?php

class GenerateDpe{

	static public function generateCes($value, $nameOfPicture){
		// fichiers de bases :
		$base = Constant::DEFAULT_MODULE_DIRECTORY.'/dpe/picture/ces.png';
		$fleche = Constant::DEFAULT_MODULE_DIRECTORY.'/dpe/picture/diage-fleche.gif';
		$dest = Constant::DEFAULT_PICTURE_MODULE_DIRECTORY.'dpe/'.$nameOfPicture.'.png';
		$base = imagecreatefrompng($base);
		$largeur_base = imagesx($base);
		$hauteur_base = imagesy($base);
		$fleche = imagecreatefromgif($fleche);
		$blanc = imagecolorallocate($fleche, 255, 255, 255);
		$largeur_fleche = imagesx($fleche);
		$hauteur_fleche = imagesy($fleche);
		imagestring($fleche, 2, $largeur_fleche/2, $hauteur_fleche/8, $value, $blanc);
		$base_x = $largeur_base - $largeur_fleche;
		$base_y =  $hauteur_base - $hauteur_fleche;
		switch ($value){

			case $value <= 50:
				//a
				$yf = $base_y*.07;
				break;
			case $value >= 51 &&$value <= 90:
				//b
				$yf = $base_y*.2;
				break;
			case $value >= 91 &&$value <= 150:
				//c
				$yf = $base_y*.33;
				break;
			case $value >= 151 &&$value <= 230:
				//d
				$yf = $base_y*.47;
				break;

			case $value >= 231 &&$value <= 330:
				//e
				$yf = $base_y*.63;
				break;

			case $value >= 331 &&$value <= 450:
				//f
				$yf = $base_y*.77;
				break;

			case $value >450:
				//g
				$yf = $base_y*.92;
				break;
		}


		// pause de la fleche au bon endroit.
		imagecopymerge($base, $fleche, $base_x, $yf, 0, 0, $largeur_fleche, $hauteur_fleche, 60);

		imagepng($base,$dest);
	}
	static public function generateGes($value, $nameOfPicture){
		// fichiers de bases :
		$base = Constant::DEFAULT_MODULE_DIRECTORY.'/dpe/picture/ges.png';
		$fleche = Constant::DEFAULT_MODULE_DIRECTORY.'/dpe/picture/diage-fleche.gif';
		$dest = Constant::DEFAULT_PICTURE_MODULE_DIRECTORY.'dpe/'.$nameOfPicture.'.png';
		$base = imagecreatefrompng($base);
		$largeur_base = imagesx($base);
		$hauteur_base = imagesy($base);
		$fleche = imagecreatefromgif($fleche);
		$blanc = imagecolorallocate($fleche, 255, 255, 255);
		$largeur_fleche = imagesx($fleche);
		$hauteur_fleche = imagesy($fleche);
		imagestring($fleche, 2, $largeur_fleche/2, $hauteur_fleche/8, $value, $blanc);
		$base_x = $largeur_base - $largeur_fleche;
		$base_y =  $hauteur_base - $hauteur_fleche;
		switch ($value){

			case $value <= 5:
				//a
				$yf = $base_y*.07;
				break;
			case $value >= 6 &&$value <= 10:
				//b
				$yf = $base_y*.2;
				break;
			case $value >= 11 &&$value <= 20:
				//c
				$yf = $base_y*.33;
				break;
			case $value >= 21 &&$value <= 35:
				//d
				$yf = $base_y*.47;
				break;

			case $value >= 36 &&$value <= 55:
				//e
				$yf = $base_y*.63;
				break;

			case $value >= 56 &&$value <= 80:
				//f
				$yf = $base_y*.77;
				break;

			case $value >80:
				//g
				$yf = $base_y*.92;
				break;
		}


		// pause de la fleche au bon endroit.
		imagecopymerge($base, $fleche, $base_x, $yf, 0, 0, $largeur_fleche, $hauteur_fleche, 60);

		imagepng($base,$dest);
	}
}