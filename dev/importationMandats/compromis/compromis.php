<?php
require_once dirname(__FILE__).'/../../../libs/php_functions_missing.php';
require_once dirname(__FILE__).'/../../../const/config.php';
require_once dirname(__FILE__).'/../../../class/interfaceController.php';
require_once dirname(__FILE__).'/../../../class/CoreController.class.php';
require_once dirname(__FILE__).'/../../../class/Tools.php';

foreach( glob(  dirname(__FILE__).'/../../../modules/*/model/requires.php' )   as $filename){
	require_once $filename;
}
$pdo = new PDO('mysql:dbname='.Constant::DATABASE_NAME.';host='.Constant::DATABASE_SERVER.';',Constant::DATABASE_USER,Constant::DATABASE_PASSWORD);

/***********************************
 * 				PARAM              *
***********************************/

$filename =  dirname(__FILE__).'/compromis.csv';
$idSectorAutre = 6;
$sellerTitle = SellerTitle::load($pdo, 1);
$titreAcquereur = TitreAcquereur::load($pdo, 1);
// On lit le fichier de comprimis ( csv)
if (($handle = fopen($filename, "r")) !== FALSE) {
	while (($data = fgetcsv($handle, 10000, ";")) !== FALSE) {
		
		var_dump($data);
		$user=null;
		if((trim($data[21])!='')){
			switch($data[21]){
				case 'David COUZY':
					$idUser = 37;
					break;
					// il faut creer tous les utilisateurs inconnu.
				case 'Christelle PEDELMAS':
					$idUser = 40;
					break;
				case 'Alexandre LAFON':
					$idUser = 1;
				
					break;
				case 'Bruno FADERNE':
					$idUser = 39;
				
					break;
				case 'Axelle LEMAITRE':
					$idUser = 34;
			
					break;
				case 'Daniel CALVI':
					$idUser = 33;
				
					break;
				case 'Marie-line DUPRE':
					$idUser = 35;
				
					break;
				case 'Marine RAFFY':
					$idUser = 38;
		
					break;
				case 'Patricia HEBRARD':
					$idUser=41;
					break;
				case 'Véronique Rispe':
					$idUser=36;
				
					break;
				case 'Marie VALENTIE':
					$idUser=42;
					break;
				default:
					//					$idUser = 1;
					$error[] = "utilisateur inconnu";
				break;
			}
		}
			// utilisateur à associer.
			$user = User::load($pdo,$idUser);
	
		// vendeur
		$citySeller = loadCity($pdo,$data[5],$data[4]);
	
		// $seller = Seller::create($pdo, $data[0], $data[1], $data[2], $data[6], '', '', '', '', '', $citySeller, $sellerTitle, $user);
		
		// $acq = Acquereur::create($pdo, $data[7], $data[8], $data[9], $data[13], '', '', '', '', 0, '', '', '', '', '', '', '', $titreAcquereur, '', $user);
		
		// $mandate = Mandate::create($pdo, $data[14], '', '', $data[16], $priceFai, $priceSeller, $commission, $estimationFai, $margeNegociation, $referenceCadastreParcelle1, $referenceCadastreParcelle2, $referenceCadastreParcelle3, $autreReferenceParcelle, $superficieParcelle1, $superficieParcelle2, $superficieParcelle3, $superficieAutreParcelle, $superficieConstructible, $superficieNonConstructible, $superficieTotale, $numberLot, $sHONAccordee, $reglementDeLotissement, $eRNT, $passageEau, $passageElectricite, $passageGaz, $voirie, $tailleFacade, $profondeurTerrain, $commentaire, $geolocalisation, $proximiteEcole, $proximiteCommerce, $proximiteTransport, $commentaireApparent, $nbPiece, $surfaceHabitable, $nbChambre, $surfacePieceVie, $niveau, $anneeConstruction, $chargesMensuelle, $taxesFonciere, $taxeHabitation, $user, $sector, $city, $notary, $mandateType, $transactionType, $etap)
	}
	fclose($handle);
}

function loadCity(PDO $pdo,$ville,$cp,$idSectorAutre = 6){
	
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
				$n = trim(strtoupper($ville));
	
				$s = Sector::load($pdo,$idSectorAutre);
	
				//echo "lorem .".$n.' '.$cp.' '.$s;
				$city = City::create($pdo,$n,$cp,0,$s);
			}else
			return false;
		}if($city==null){
			//			echo '<hr><h1>MEGABUG</h1>'.$line[7].'=='.$line[6].'<hr>';
		}
	}else{
		//$error[]="ville du bien manquante";
		return false;
	
	}
	return $city;
}

