<?php
require_once dirname(__FILE__).'/../../libs/php_functions_missing.php';
require_once dirname(__FILE__).'/../../const/config.php';
require_once dirname(__FILE__).'/../../class/interfaceController.php';
require_once dirname(__FILE__).'/../../class/CoreController.class.php';
require_once dirname(__FILE__).'/../../class/Tools.php';

foreach( glob(  dirname(__FILE__).'/../../modules/*/model/requires.php' )   as $filename){
	require_once $filename;
}
$pdo = new PDO('mysql:dbname='.Constant::DATABASE_NAME.';host='.Constant::DATABASE_SERVER.';',Constant::DATABASE_USER,Constant::DATABASE_PASSWORD);

/***********************************
 * 				PARAM              *
 ***********************************/

$flux = "causes;nom;prenom;adresse;cp;ville;tel perso;tel pro; portable;autre;email;transaction;type;prix de; prix à;commercial;date visite;visite\n";
$idTypeTransaction = null;
$idSectorAutre = 6; // secteur à definir pour les nouvelles villes
/**
 * @param Int $price
 * @return Int
 */
function convertFEuro($price){
	return round(str_replace(' ','',$price)/6.55957,0);
}

/***********************************
 * 			Traitement 			   *
 ***********************************/

$name='ALEXANDRE_LAFON.csv';
$name='AXELLE_LEMAITRE.csv';
$name='BRUNO_FADERNE.csv';
$name='DANIEL_CALVI.csv';
$name='DAVID_COUZY.csv';
$name='MARINE_RAFFY.csv';


$handle = fopen('sources/acq/'.$name, 'r');
$export = fopen('sources/errors/erreurs '.$name, 'w');
fwrite($export, $flux);
if ($handle)
{
	/*Tant que l'on est pas à la fin du fichier*/
	while (!feof($handle))
	{
		$error=array();
		/*On lit la ligne courante*/
		$buffer = fgets($handle);
		$line = explode(';',$buffer);

		/**
		 * Ne pas oublier de faire un trim() sur tt les champs.
		 */
		/*
		 0 => string '  ABOUA samira' (length=14)
		 1 => string ' samira' (length=7)
		 2 => string ' 9 square jules keillier' (length=24)
		 3 => string '82200' (length=5)
		 4 => string ' MOISSAC' (length=8)
		 5 => string ' ' (length=1)
		 6 => string ' ' (length=1)
		 7 => string ' 06.20.75.07.08' (length=15)
		 8 => string ' ' (length=1)
		 9 => string ' samira046@hotmail.fr' (length=21)
		 10 => string '' (length=0)
		 11 => string ' ' (length=1)
		 12 => string ' ' (length=1)
		 13 => string ' ' (length=1)
		 14 => string ' Marie-line DUPRE' (length=17)
		 15 => string ' ' (length=1)
		 16 => string ' ListeVisite
		 */
		$nom = trim($line[0]);
		$prenom= trim($line[1]);
		$adresse= trim($line[2]);
		$cp= trim($line[3]);
		$ville= trim($line[4]);
		$telPerso= trim($line[5]);
		$telPro= trim($line[6]);
		$telPortable= trim($line[7]);
		$autre= trim($line[8]);
		$email = trim($line[9]);
		$transaction= trim($line[10]);
		$type= trim($line[11]);

		//$prixDe= convertFEuro(str_replace('F','',trim($line[12])))==0?0:convertFEuro(str_replace('F','',trim($line[12])));
		//$prixA= convertFEuro(str_replace('F','',trim($line[13])))==0?0:convertFEuro(str_replace('F','',trim($line[13])));

		$prixDe= convertFEuro(str_replace('€','',trim($line[12])))==0?0:(str_replace('€','',trim($line[12])));
		$prixA= convertFEuro(str_replace('€','',trim($line[13])))==0?0:(str_replace('€','',trim($line[13])));

		$commercial= trim($line[14]);
		$dateVisite= trim($line[15]);
		$visite= trim($line[16]);

		//		echo $line[12].'=='.$prixDe.'<br>';

		/*
		 axelle = location
		 mariline,daniel,alex,vero= vente
		 marine,david = panaché
		 */

		// type ...
		/**
		* Type de bien
		*/
		if($type!=''){
			$typeBien =$type;
			// MAISON
			// BOX ?
			// PROPRIETE ?
			// APPARTEMENT
			// TERRAIN
			// IMMEUBLE ?
			$typeMandate=null;
			$listType = MandateType::loadAll($pdo);
			foreach($listType as $ci){
				if(strtoupper($ci->getName()) == $typeBien){
					$typeMandate = $ci;
					break;
				}
			}
			if($typeMandate==null)$error[]="Le type du mandat est introuvable";
			//			var_dump($typeMandate);
			//			echo $typeBien.'<br>';
		}else{
			$error[]="type de bien manquant";
		}

		// 2 vente -- 1 location
		//$idTypeTransaction = 2;
		$user=null;
		if((trim($commercial)!='')){
			switch($commercial){
				case 'David COUZY':
					$idUser = 37;
					$idTypeTransaction = 2;
					break;
					// il faut creer tous les utilisateurs inconnu.
				case 'Christelle PEDELMAS':
					$idUser = 40;
					break;
				case 'Alexandre LAFON':
					$idUser = 1;
					$idTypeTransaction = 2;
					break;
				case 'Bruno FADERNE':
					$idUser = 39;
					$idTypeTransaction = 2;
					break;
				case 'Axelle LEMAITRE':
					$idUser = 34;
					$idTypeTransaction = 1;
					break;
				case 'Daniel CALVI':
					$idUser = 33;
					$idTypeTransaction = 2;
					break;
				case 'Marie-line DUPRE':
					$idUser = 35;
					$idTypeTransaction = 2;
					break;
				case 'Marine RAFFY':
					$idUser = 38;
					$idTypeTransaction = 2;
					break;
				case 'Patricia HEBRARD':
					$idUser=41;
					break;
				case 'Véronique Rispe':
					$idUser=36;
					$idTypeTransaction = 2;
					break;
				case 'Marie VALENTIE':
					$idUser=42;
					break;
				default:
					//					$idUser = 1;
					$error[] = "utilisateur inconnu";
					break;
			}
			// utilisateur à associer.
			$user = User::load($pdo,$idUser);
			$transactionType = TransactionType::load($pdo,$idTypeTransaction);
		}else{
			$error[]='Le champ utilisateur est vide';
		}

		//		var_dump($user);
		// tester les villes (en strToUpper() )
		if(trim($ville)!=''){

			//			echo '<hr>';
			//			$adresseDuBien =trim($line[]);
			$v =  str_replace('SECTEUR','',$ville);

			$v = 'LA MONTBETON'==trim($v)?"MONTBETON":$v;
			$v = 'VALENCE'==trim($v)?"VALENCE D'AGEN":$v;
			$v = 'VALENCE D AGEN'==trim($v)?"VALENCE D'AGEN":$v;
			$v = 'BARRY ISLEMADE'==trim($v)?"BARRY D'ISLEMADE":$v;
			$v = 'CASTELSARASIN'==trim($v)?"CASTELSARRASIN":$v;
			$v = 'Secteur La ville dieu du T'==trim($v)?"LA VILLE DIEU DU TEMPLE":$v;
			$v =  str_replace('Secteur','',$v);


			//			echo strToUpper($v).' == ';
			// recherche ds la base ...
			$listCity = City::loadAll($pdo);
			//			var_dump($listCity[41]);
			$city=null;
			foreach($listCity as $ci){

				//				echo $ci->getName()=='AUVILLAR'?$ci->getName():'none';
				if(trim(strToUpper($ci->getName())) == trim(strToUpper($v))){

					$city = $ci;

				}
			}
			if($city==null){
				// Si la ville est manquante, on l'ajoute (secteur moissac pour moissac, à définir pour auvillar ou LVD du temple )
				if(trim(strtoupper($ville))!='ZZ'){
					$n = trim(strtoupper($v));

					$s = Sector::load($pdo,$idSectorAutre);


					$city = City::create($pdo,$n,$cp,0,$s);
				}else
				$error[]="La ville du mandat est introuvable";
			}if($city==null){
				//			echo '<hr><h1>MEGABUG</h1>'.$line[7].'=='.$line[6].'<hr>';
			}
		}else{
			$error[]="ville du bien manquante";

		}
		if(!empty($error)){

			//echo '<pre>';
			//print_r($error);
			//echo '</pre>';
			//var_dump($line);
			//echo '<hr/>';
			// creer fichier .csv (flux...).
			$flux='';
			foreach($error as $e){
				$flux.='- '.$e;
			}
			$flux.=";$line[0];$line[1];$line[2];$line[3];$line[4];$line[5];$line[6];$line[7];$line[8];$line[9];$line[10];$line[11];$line[12];$line[13];$line[14];$line[15];$line[16]";
			if($flux!='')
			fwrite($export, $flux);
		}else{
			// sauvegarder l'acq
			//$transactionType
			// 	$user
			// $city


			Acquereur::create(
			$pdo, // $pdo
			$nom, //$name
			$prenom, //$firstname
			$adresse,//$address
			$telPerso,//$phone
			$telPortable,//$mobilPhone
			$telPro,//$workPhone
			$autre,//$fax
			$email,//$email
			0,//$numberUsed
			$prixDe,//$priceMin
			$prixA,//$priceMax
			'',//$surfaceTerrainMin
			'',//$surfaceTerrainMax
			'',//$surfaceHabitableMin
			'',//$surfaceHabitableMax
			$city,//$villeAcquereur
			TitreAcquereur::load($pdo,1),//$titreAcquereur
			$transactionType, //$transactionType
			$user,//$user
			'',
			null,//$mandateStyle
			1, //$actif
			null,//$rechercheCity
			null,//$rechercheSector
			$typeMandate //$mandateType
			);

		}
		//
	}

}
