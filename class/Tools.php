<?php
class Tools {
	static public function convertSexadecimalInDecimal($float) {
		$tmp = explode('.', $float);
		// On le coupe par paquet de 2
		$cent = array();

		$rev = (strval($tmp[1]));
		$nombre = '';
		for ($i = 0; $i < strlen($rev); $i = $i + 2) {
			$cent[] = $rev[$i] . $rev[$i + 1];
			//$nombre .= $rev[$i];
		}

		/*$max =  Tools::strlen($tmp[1]);
		 $ecart = 0;
		echo substr($tmp[1], 0,2 ).'<hr>';
		while( $ecart<=$max ){
		echo $ecart.'<hr>';
		$cent[]=substr($tmp[1],$ecart,$ecart+2);
		$ecart=$ecart+2;
		}
		*/
		//var_dump( $cent);

		return round($tmp[0] + ($cent[0] / 60) + ($cent[1] / 3600) + ($cent[2] / 216000), 5);

		//echo substr($tmp[1],0,2);
		//return $tmp[0];
		//return $float;
	}
	static public function moduleIsLoad($module){
		return is_file(Constant::DEFAULT_MODULE_DIRECTORY.$module.'/configuration.xml');
	}
	static public function replaceSpecialCharByIso($string) {
		//utf8_encode(chr(128))
		return str_replace(
		array(
		'"', '&', '€','ƒ', '"', '…',
		'+', '#', '^', '‰', 'Š', 
		'Œ', "'", "'", '"', '"', '*',
		'--', '~', '™', 'š',  'œ',
		'¢', '£', '¤', '¥', '¦', '§',
		'¨', '©', 'ª', '«', '¬', '®',
		'¯', '°', '±', '²', '³', "'",
		'µ', '¶', '·', '¸', '¹', 'º',
		'»', '¼', '½', '¾', '¿', 'Æ',
		'Ð', 'æ', '÷', 'ø', 'þ', '–'
		), array(
		utf8_encode(chr(34)), utf8_encode(chr(38)), utf8_encode(chr(128)), utf8_encode(chr(131)), utf8_encode(chr(132)), utf8_encode(chr(133)),
		utf8_encode(chr(134)), utf8_encode(chr(135)), utf8_encode(chr(136)), utf8_encode(chr(137)), utf8_encode(chr(138)),
		utf8_encode(chr(140)), utf8_encode(chr(145)), utf8_encode(chr(146)), utf8_encode(chr(147)), utf8_encode(chr(148)), utf8_encode(chr(149)),
		utf8_encode(chr(151)), utf8_encode(chr(152)), utf8_encode(chr(153)), utf8_encode(chr(154)),  utf8_encode(chr(156)),
		utf8_encode(chr(162)), utf8_encode(chr(163)), utf8_encode(chr(164)), utf8_encode(chr(165)), utf8_encode(chr(166)), utf8_encode(chr(167)),
		utf8_encode(chr(168)), utf8_encode(chr(169)), utf8_encode(chr(170)), utf8_encode(chr(171)), utf8_encode(chr(172)), utf8_encode(chr(174)),
		utf8_encode(chr(175)), utf8_encode(chr(176)), utf8_encode(chr(177)), utf8_encode(chr(178)), utf8_encode(chr(179)), utf8_encode(chr(180)),
		utf8_encode(chr(181)), utf8_encode(chr(182)), utf8_encode(chr(183)), utf8_encode(chr(184)), utf8_encode(chr(185)), utf8_encode(chr(186)),
		utf8_encode(chr(187)), utf8_encode(chr(188)), utf8_encode(chr(189)), utf8_encode(chr(190)), utf8_encode(chr(191)), utf8_encode(chr(198)),
		utf8_encode(chr(208)), utf8_encode(chr(230)), utf8_encode(chr(247)), utf8_encode(chr(248)), utf8_encode(chr(254)), utf8_encode(chr(150))
		), $string);

	}

	static public function passwdGen($length = 8) {
		$str = 'abcdefghijkmnopqrstuvwxyz0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
		for ($i = 0, $passwd = ''; $i < $length; $i++)
		$passwd .= Tools::substr($str, mt_rand(0, Tools::strlen($str) - 1), 1);
		return $passwd;
	}

	static function strlen($str) {
		if (is_array($str))
		return false;
		if (function_exists('mb_strlen'))
		return mb_strlen($str, 'utf-8');
		return strlen($str);
	}

	static function substr($str, $start, $length = false, $encoding = 'utf-8') {
		if (is_array($str))
		return false;
		if (function_exists('mb_substr'))
		return mb_substr($str, intval($start), ($length === false ? Tools::strlen($str) : intval($length)), $encoding);
		return substr($str, $start, $length);
	}

	static function dateEnToTime($date) {
		$dateTest = explode('-', $date);
		return empty($dateTest[1]) ? false : strtotime($date);
	}

	static function dateFrToTime($date) {
		$date = explode('/', $date);
		return empty($date[1]) ? false : Tools::dateEnToTime($date[2] . '-' . $date[1] . '-' . $date[0]);
	}

	static function dateTimeFrToTime($date) {
		$explo = explode(' ', $date);
		list($day, $month, $year) = explode('/', $explo[0]);
		return strtotime($year . $month . $day . ' ' . $explo[1]);
	}

	static function is_date_fr($date) {
		return preg_match('`^\d{1,2}/\d{1,2}/\d{4}$`', $date);

	}

	static function is_date_time_fr($date) {
		return preg_match("/\d{2}\/\d{2}\/\d{4}\s\d{2}:\d{2}/i", $date);

	}

	/**
	 *
	 * @param String $date1
	 * @param String $date2
	 * @return Bool return true if date1 > date2
	 */
	static function date1_is_superior_to_date2_date_time_fr($date1, $date2) {
		$explo = explode(' ', $date1);
		list($day, $month, $year) = explode('/', $explo[0]);
		$date1 = strtotime($year . $month . $day . ' ' . $explo[1]);

		$explo = explode(' ', $date2);
		list($day, $month, $year) = explode('/', $explo[0]);
		$date2 = strtotime($year . $month . $day . ' ' . $explo[1]);
		return $date1 > $date2 ? true : false;
	}

	/**
	 *
	 * @param String $str
	 * @return Bool
	 */
	static function characters_allowed($str) {
		return (!preg_match('/^[ÀÁÂÃÄÅÇÈÉÊËÌÍÎÏÒÓÔÕÖÙÚÛÜÝàáâãäåçèéêëìíîïðòóôõöùúûüýÿa-zA-Z0-9_-]+$/', $str)) ? true : false;
	}

	/**
	 *
	 * @param String $str
	 * @return Int
	 */
	static function strlenWithAccentedCharacters($str) {
		return strlen(str_replace(array('À', 'Á', 'Â', 'Ã', 'Ä', 'Å', 'Ç', 'È', 'É', 'Ê', 'Ë', 'Ì', 'Í', 'Î', 'Ï', 'Ò', 'Ó', 'Ô', 'Õ', 'Ö', 'Ù', 'Ú', 'Û', 'Ü', 'Ý', 'à', 'á', 'â', 'ã', 'ä', 'å', 'ç', 'è', 'é', 'ê', 'ë', 'ì', 'í', 'î', 'ï', 'ð', 'ò', 'ó', 'ô', 'õ', 'ö', 'ù', 'ú', 'û', 'ü', 'ý', 'ÿ'), array('a', 'a', 'a', 'a', 'a', 'a', 'c', 'e', 'e', 'e', 'e', 'i', 'i', 'i', 'i', 'o', 'o', 'o', 'o', 'o', 'u', 'u', 'u', 'u', 'y', 'a', 'a', 'a', 'a', 'a', 'a', 'c', 'e', 'e', 'e', 'e', 'i', 'i', 'i', 'i', 'o', 'o', 'o', 'o', 'o', 'o', 'u', 'u', 'u', 'u', 'y', 'y'), $str));
	}

	static function is_int($mixed) {
		return (preg_match('/^\d*$/', $mixed) == 1);
	}

	/**
	 * Check for e-mail validity
	 *
	 * @param string $email e-mail address to validate
	 * @return boolean Validity is ok or not
	 */
	static public function isEmail($email) {
		return preg_match('/^[a-z0-9!#$%&\'*+\/=?^`{}|~_-]+[.a-z0-9!#$%&\'*+\/=?^`{}|~_-]*@[a-z0-9]+[._a-z0-9-]*\.[a-z0-9]+$/ui', $email);
	}

	/**
	 *
	 * @param Array $array
	 * @param String $index
	 * @return Array Retourne le tableau trié selon le paramètre index. (tableaux multi dimensions).
	 */
	static public function sort_by_key($array, $index) {
		$sort = array();
		//préparation d'un nouveau tableau basé sur la clé à trier
		foreach ($array as $key => $val) {
			$sort[$key] = $val[$index];
		}
		//tri par ordre naturel et insensible à la casse
		natcasesort($sort);
		//formation du nouveau tableau trié selon la clé
		$output = array();
		foreach ($sort as $key => $val) {
			$output[] = $array[$key];
		}
		return $output;
	}

	static public function create_url(User $user, $module = null, $page = null, $action = null, $othersAction = array()) {
		$url = '';
		$action = str_replace('{myId}', $user -> getIdUser(), $action);
		if (Constant::USE_URL_REWRITING) {
			if (null != $module)
			$url .= '/mod-' . $module;
			if (null != $page & !empty($page) && '' != $page)
			$url .= '/' . $page;
			if (null != $action && !empty($action) && '' != $action) {
				$url .= '/' . $action;
				if (!empty($othersAction)) {
					foreach ($othersAction as $act) {
						$url .= '/' . $act;
					}
				}
			}
		} else {
			if (null != $module && !empty($module) && '' != $module) {
				$url .= ($url == '') ? '/?' : '&';
				$url .= 'module=' . $module;
			}
			if (null != $page && !empty($page) && '' != $page) {
				$url .= ($url == '') ? '/?' : '&';
				$url .= 'page=' . $page;
			}
			if (null != $action && !empty($action) && '' != $action) {
				$url .= ($url == '') ? '/?' : '&';
				$url .= 'action=' . $action;
			}
			if (!empty($othersAction)) {
				$i = 2;
				$url .= ($url == '') ? '/?' : '&';
				foreach ($othersAction as $act) {
					$url .= 'action' . $i . '=' . $act;
					$i++;
				}
			}
		}

		return Constant::DEFAULT_URL . $url;
	}
    static public function create_url_whith_other_parameters(User $user, $module = null, $page = null, $action = null, $othersAction = array()) {
        $url = '';
        $action = str_replace('{myId}', $user -> getIdUser(), $action);
        if (Constant::USE_URL_REWRITING) {
            if (null != $module)
                $url .= '/mod-' . $module;
            if (null != $page & !empty($page) && '' != $page)
                $url .= '/' . $page;
            if (null != $action && !empty($action) && '' != $action) {
                $url .= '/' . $action;
                if (!empty($othersAction)) {
                    $url .='/';
                    $i=0;
                    foreach ($othersAction as $key =>$value) {
                        if($i!=0)$url.='_';
                        $url .=  $key.'-'.$value;
                        $i++;
                    }
                }
            }
        } else {
            if (null != $module && !empty($module) && '' != $module) {
                $url .= ($url == '') ? '/?' : '&';
                $url .= 'module=' . $module;
            }
            if (null != $page && !empty($page) && '' != $page) {
                $url .= ($url == '') ? '/?' : '&';
                $url .= 'page=' . $page;
            }
            if (null != $action && !empty($action) && '' != $action) {
                $url .= ($url == '') ? '/?' : '&';
                $url .= 'action=' . $action;
            }
            if (!empty($othersAction)) {
                $url .= ($url == '') ? '/?' : '&';
                $url.='action2=';
                $i=0;
                foreach ($othersAction as  $key=>$value) {
                    if($i!=0)$url.='_';
                    $url .=  $key.'-'.$value;
                    $i++;
                }
            }
        }

        return Constant::DEFAULT_URL . $url;
    }

	static public function format_bytes($bytes) {
		if ($bytes < 1024)
		return $bytes . ' o';
		elseif ($bytes < 1048576)
		return round($bytes / 1024, 2) . ' Ko';
		elseif ($bytes < 1073741824)
		return round($bytes / 1048576, 2) . ' Mo';
		elseif ($bytes < 1099511627776)
		return round($bytes / 1073741824, 2) . ' Go';
		else
		return round($bytes / 1099511627776, 2) . ' To';
	}

	static public function grosNombre($nombre) {
		if (intval($nombre) >= 1000) {
			$rev = strrev(strval($nombre));
			$nombre = '';
			for ($i = 0; $i < strlen($rev); $i++) {
				if ($i > 0 and $i % 3 == 0)
				$nombre .= ' ';
				$nombre .= $rev[$i];
			}
			$nombre = strrev($nombre);
		}
		return $nombre;
	}

	/*
	 static public function redimentionne($file,$x,$y) {

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
	*/

	/**
	 *
	*/
	static public function redimentionne($file, $W_max, $H_max) {
		$total = explode('/',$file);
		$nbMax = count($total);
		$rep_Dst = '';
		$img_Dst = '';
		$i=1;
		foreach( $total as $item){
				
			if($i == $nbMax){
				$img_Dst= $item;
			}else{
				$rep_Dst.=$item.'/';
			}
			$i++;
		}


		$rep_Src = $rep_Dst;
		$img_Src = $img_Dst;
		// ----------------------------------------------------
		$condition = 0;
		// Si certains parametres ont pour valeur '' :
		if ($rep_Dst == '') {
			$rep_Dst = $rep_Src;
		}// (meme repertoire)
		if ($img_Dst == '') {
			$img_Dst = $img_Src;
		}// (meme nom)
		// ----------------------------------------------------
		// si le fichier existe dans le répertoire, on continue...
		if (file_exists($rep_Src . $img_Src) && ($W_max != 0 || $H_max != 0)) {
			// --------------------------------------------------
			// extensions acceptees :
			$ExtfichierOK = '" jpg jpeg png"';
			// (l espace avant jpg est important)
			// extension fichier Source
			$tabimage = explode('.', $img_Src);
			$extension = $tabimage[sizeof($tabimage) - 1];
			// dernier element
			$extension = strtolower($extension);
			// on met en minuscule
			// --------------------------------------------------
			// extension OK ? on continue ...
			if (strpos($ExtfichierOK, $extension) != '') {
				// -----------------------------------------------
				// recuperation des dimensions de l image Src
				$img_size = getimagesize($rep_Src . $img_Src);
				$W_Src = $img_size[0];
				// largeur
				$H_Src = $img_size[1];
				// hauteur
				// -----------------------------------------------
				// condition de redimensionnement et dimensions de l image finale
				// -----------------------------------------------
				// A- LARGEUR ET HAUTEUR maxi fixes
				if ($W_max != 0 && $H_max != 0) {
					$ratiox = $W_Src / $W_max;
					// ratio en largeur
					$ratioy = $H_Src / $H_max;
					// ratio en hauteur
					$ratio = max($ratiox, $ratioy);
					// le plus grand
					$W = $W_Src / $ratio;
					$H = $H_Src / $ratio;
					$condition = ($W_Src > $W) || ($W_Src > $H);
					// 1 si vrai (true)
				}
				// -----------------------------------------------
				// B- HAUTEUR maxi fixe
				if ($W_max == 0 && $H_max != 0) {
					$H = $H_max;
					$W = $H * ($W_Src / $H_Src);
					$condition = ($H_Src > $H_max);
					// 1 si vrai (true)
				}
				// -----------------------------------------------
				// C- LARGEUR maxi fixe
				if ($W_max != 0 && $H_max == 0) {
					$W = $W_max;
					$H = $W * ($H_Src / $W_Src);
					$condition = ($W_Src > $W_max);
					// 1 si vrai (true)
				}
				// -----------------------------------------------
				// REDIMENSIONNEMENT si la condition est vraie
				// -----------------------------------------------
				// Si l'image Source est plus petite que les dimensions indiquees :
				// Par defaut : PAS de redimensionnement.
				// Mais on peut "forcer" le redimensionnement en ajoutant ici :
				// $condition = 1; (risque de perte de qualite)
				// -----------------------------------------------
				if ($condition == 1) {
					// --------------------------------------------
					// creation de la ressource-image "Src" en fonction de l extension
					switch($extension) {
						case 'jpg' :
						case 'jpeg' :
							$Ress_Src = imagecreatefromjpeg($rep_Src . $img_Src);
							break;
						case 'png' :
							$Ress_Src = imagecreatefrompng($rep_Src . $img_Src);
							break;
					}
					// --------------------------------------------
					// creation d une ressource-image "Dst" aux dimensions finales
					// fond noir (par defaut)
					switch($extension) {
						case 'jpg' :
						case 'jpeg' :
							$Ress_Dst = imagecreatetruecolor($W, $H);
							break;
						case 'png' :
							$Ress_Dst = imagecreatetruecolor($W, $H);
							// fond transparent (pour les png avec transparence)
							imagesavealpha($Ress_Dst, true);
							$trans_color = imagecolorallocatealpha($Ress_Dst, 0, 0, 0, 127);
							imagefill($Ress_Dst, 0, 0, $trans_color);
							break;
					}
					// --------------------------------------------
					// REDIMENSIONNEMENT (copie, redimensionne, re-echantillonne)
					imagecopyresampled($Ress_Dst, $Ress_Src, 0, 0, 0, 0, $W, $H, $W_Src, $H_Src);
					// --------------------------------------------
					// ENREGISTREMENT dans le repertoire (avec la fonction appropriee)
					switch ($extension) {
						case 'jpg' :
						case 'jpeg' :
							imagejpeg($Ress_Dst, $rep_Dst . $img_Dst);
							break;
						case 'png' :
							imagepng($Ress_Dst, $rep_Dst . $img_Dst);
							break;
					}
					// --------------------------------------------
					// liberation des ressources-image
					imagedestroy($Ress_Src);
					imagedestroy($Ress_Dst);
				}
				// -----------------------------------------------
			}
		}
		// ---------------------------------------------------------------------------------------
		// si le fichier a bien ete cree
		if ($condition == 1 && file_exists($rep_Dst . $img_Dst)) {
			return true;
		} else {
			return false;
		}
			

	}

	// copie le contenu du repertoire $orig vers le repertoire $dest en le créant
	// copie tous les sous-reps de manière récursive
	// sous-entend qu'on a les droits d'écriture, bien sûr!
	public static function CopieRep ($orig,$dest) {
		 
		mkdir ($dest,0777); // à modifier si le rep cible existe déjà
		$dir = dir($orig);
		while ($entry=$dir->read()) {
			$pathOrig = "$orig/$entry";
			$pathDest = "$dest/$entry";
			// repertoire ->copie récursive
			if (is_dir($pathOrig) and (substr($entry,0,1)<>'.')) Tools::CopieRep ($pathOrig,$pathDest);
			// fichier -> copie simple
			if (is_file($pathOrig) and ($pathDest<>'') and ($fp=fopen($pathOrig,'rb'))) {
	      $buf = fread($fp,filesize($pathOrig)); 
			$cop = fopen($pathDest,'ab+');
			fputs ($cop,$buf);
			fclose ($cop);
			fclose ($fp);
			}
			}
			$dir->close();
			}
}
?>