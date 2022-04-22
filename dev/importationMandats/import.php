<?php
require_once dirname(__FILE__).'/../../libs/php_functions_missing.php';
require_once dirname(__FILE__).'/../../const/config.php';
require_once dirname(__FILE__).'/../../class/interfaceController.php';
require_once dirname(__FILE__).'/../../class/CoreController.class.php';
require_once dirname(__FILE__).'/../../class/Tools.php';

foreach( glob(  dirname(__FILE__).'/../../modules/*/model/requires.php' )   as $filename){
	require_once $filename;
}
$flux="causes;N° de mandat;Nom du vendeur;Adresse du vendeur;CP vendeur;Ville VEndeur;Adresse du bien;Cp bien;Ville bien;Demarcheur;Prix du mandat;Net vendeur;Id PUB;Nature mandat;Type de transaction;Début mandat;Type de bien;Date visite\n";
$export = fopen('sources/errors/erreurs '.$name, 'w');
fwrite($export, $flux);

$pdo = new PDO('mysql:dbname='.Constant::DATABASE_NAME.';host='.Constant::DATABASE_SERVER.';',Constant::DATABASE_USER,Constant::DATABASE_PASSWORD);
$idSectorMoissac = 1;
$idNotaryDefault = 12;
$idSectorAutre = 6;
/*
 N° de mandat		$l[0]
 Nom du vendeur		$l[1]
 Adresse du vendeur	$l[2]

 CP vendeur 		$l[3]
 ville vendeur		$l[4]

 Adresse du bien	$l[5]
 Cp bien			$l[6]
 Ville bien			$l[7]
 Demarcheur			$l[8]
 Prix du mandat		$l[9]
 Net vendeur		$l[10]
 Id PUB				$l[11]
 Nature mandat		$l[12]
 Type de transaction$l[13]
 Début mandat		$l[14]
 Type de bien		$l[15]
 Date visite 		$l[16]
 */

/*
 *
 Daniel Calvi = Escal'Terrains id=33
 Marie-Line Dupré = Escal'immo Moissac id=35
 Véronique Dupré = Escal'immo Moissac id=36
 Alexandre Lafon = Escal'Immo Moissac id=1
 David Couzy = Escal'Immo La Ville Dieu id=37
 Marine Raffy = Escal'immo La Ville Dieu id=38
 Faderne Bruno = Escal'immo Auvillar id=39
 Lemaitre Axelle Moissac id=34
 */
//				}

//}

//$handle = fopen('sources/auvillarVDT.csv', 'r');
//$isMoissac = false;
//$handle = fopen('sources/MOISSAC.csv', 'r');
//$handle = fopen('sources/moissac2.csv', 'r');
$handle = fopen('sources/mandats.csv', 'r');
$isMoissac = false;
/*Si on a réussi à ouvrir le fichier*/
if ($handle)
{
	/*Tant que l'on est pas à la fin du fichier*/
	while (!feof($handle))
	{
		/*On lit la ligne courante*/
		$buffer = fgets($handle);
		$line = explode(';',$buffer);
		$error= array();

		/**
		 * Nature de bien
		 */
		if(trim($line[11])!=''){
			$nature =trim($line[11]);
			//		echo $nature.'<br>';
			switch ($nature){
				case 'SIMPLE':
					$nature = MandateNature::load($pdo,1);
					break;
				case 'ACCORD':
					$nature = MandateNature::load($pdo,2);
					break;
				case 'EXCLUSIF':
					$nature = MandateNature::load($pdo,3);
					break;
				case 'MANDAT DE RECHERCHE':
					$nature = MandateNature::load($pdo,4);
					break;
				default:
					$nature=null;
					break;
			}

		}

		/**
		 * Type de bien
		 */
		if(trim($line[14])!=''){
			$typeBien =trim($line[14]);
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
		/**
		 * Numéro de mandat
		 */
		if(trim($line[0])!=''&&is_int((INT)$line[0])){
			$numeroMandat =trim($line[0]);
		}else{
			$error[]="Numéro de mandat manquant";
		}

		/**
		 * Adresse du bien
		 */
		if(trim($line[5])!=''){
			$adresseDuBien =trim($line[5]);
		}else{
			$error[]="adresse du bien manquante";
		}

		/**
		 *	Ville du bien...
		 */

		if(trim($line[7])!=''){

			//			echo '<hr>';
			//			$adresseDuBien =trim($line[]);
			$v =  str_replace('SECTEUR','',trim($line[7]));

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
			$cityMandate=null;
			foreach($listCity as $ci){

				//				echo $ci->getName()=='AUVILLAR'?$ci->getName():'none';
				if(trim(strToUpper($ci->getName())) == trim(strToUpper($v))){

					$cityMandate = $ci;

				}
			}
			if($cityMandate==null){
				// Si la ville est manquante, on l'ajoute (secteur moissac pour moissac, à définir pour auvillar ou LVD du temple )
				if(trim(strtoupper($line[7]))!='ZZ'){
					$n = trim(strtoupper($v));
					if($isMoissac){
						$s = Sector::load($pdo,$idSectorMoissac);
					}else{
						$s = Sector::load($pdo,$idSectorAutre);
					}

					$cityMandate = City::create($pdo,$n,$line[6],0,$s);
				}else
				$error[]="La ville du mandat est introuvable";
			}if($cityMandate==null){
				//			echo '<hr><h1>MEGABUG</h1>'.$line[7].'=='.$line[6].'<hr>';
			}
		}else{

			$error[]="ville du bien manquante";


		}

		/**
		 * Date début mandat
		 */
		if(trim($line[13])!=''){
			$debutMandat =Tools::dateFrToTime( trim($line[13]));
		}else{
			$error[]="Date initiale vide";
		}


		/**
		 * PRIX
		 */
		$prixMandat = trim(str_replace('€','',$line[9]))==''?0:trim(str_replace('€','',$line[9]));
		$netVendeur = trim(str_replace('€','',$line[10]))==0?0:trim(str_replace('€','',$line[10]));
		$commission = $prixMandat - $netVendeur;







		/**
		 *  Type Transaction
		 */
		if(trim($line[12])!=''){
			$ty = trim($line[12])=='Location'?1:2;
			$transactionType = TransactionType::load($pdo,$ty);
		}else{
			$error[]="Type de transaction vide";
		}


		/**
		 * USER
		 */
		if((trim($line[8])!='')){
			switch(trim($line[8])){
				case'Véronique Rispe':
					$idUser = 36;
					break;
				case'Véronique RISPE':
					$idUser = 36;
					break;
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

				case 'Marie VALENTIE':
					$idUser=42;
					break;
				case'Agence':
					$idUser = 47;
					break;
				default:
					//					$idUser = 1;
					$error[] = "utilisateur inconnu";
					break;
			}
			// utilisateur à associer.
			$user = User::load($pdo,$idUser);
		}else{
			$error[]='Le champ utilisateur est vide';
		}

			
		// vendeur ....
		// voir si le nom, prenom et adresse coïncide, si oui, on loade, sinon on ajoute un vendeur.
		// (rqt sql)
		$sql = "SELECT s.idSeller
			FROM Seller s  
			WHERE  UPPER(s.name)=? AND UPPER(s.address)=?";
		$pdoStatement = $pdo->prepare($sql);
		if (!$pdoStatement->execute(array(strtoupper( trim($line[1])),strtoupper(trim($line[2]))))) {
			$error[]="Erreur lors de la requete sur le vendeur";
		}
		$value = $pdoStatement->fetch();
		//		var_dump( $value ) ;
		//		echo $sql.' = '.strtoupper( trim($line[1])).' '.strtoupper( trim($line[2]));
		//		echo '<hr>';
		if($value){
			$seller = Seller::load($pdo,(INT)$value['idSeller']);
			//		var_dump($seller);
		}else{
			// verif de la ville, si elle n'y est pas, on la sauve, si elle est inexistante on stoppe la creation du vendeur
			// ville vendeur = $line 4

			/**
			 * DEB
			 */
			if(trim($line[4])!=''){

				$v =  str_replace('SECTEUR','',trim($line[4]));

				$v = 'LA MONTBETON'==trim($v)?"MONTBETON":$v;
				$v = 'VALENCE'==trim($v)?"VALENCE D'AGEN":$v;
				$v = 'VALENCE D AGEN'==trim($v)?"VALENCE D'AGEN":$v;
				$v = 'BARRY ISLEMADE'==trim($v)?"BARRY D'ISLEMADE":$v;
				$v = 'CASTELSARASIN'==trim($v)?"CASTELSARRASIN":$v;
				$v = 'Secteur La ville dieu du T'==trim($v)?"LA VILLE DIEU DU TEMPLE":$v;

				//			echo strToUpper($v).' == ';
				// recherche ds la base ...
				$listCity = City::loadAll($pdo);
				//			var_dump($listCity[41]);
				$citySeller=null;
				foreach($listCity as $ci){

					//				echo $ci->getName()=='AUVILLAR'?$ci->getName():'none';
					if(trim(strToUpper($ci->getName())) == trim(strToUpper($v))){
							
						$citySeller = $ci;
							
					}
				}
				if($citySeller==null){
					// Si la ville est manquante, on l'ajoute (secteur moissac pour moissac, à définir pour auvillar ou LVD du temple )
					if(trim(strtoupper($line[4]))!='ZZ'){
						$n = trim(strtoupper($v));
						if($isMoissac){
							$s = Sector::load($pdo,$idSectorMoissac);
						}else{
							$s = Sector::load($pdo,$idSectorAutre);
						}
						//						echo $n.'=='.$line[4].'=='.$line[3].'<hr>';
						//var_dump($s);
						$citySeller = City::create($pdo,$n,$line[3],0,$s);
						//					var_dump($citySeller);
					}else
					$error[]="La ville du vendeur est introuvable";
				}
				if($citySeller){
					//				var_dump($citySeller);
					// Ajout du vendeur.
					//			create(PDO $pdo,$name,$firstname,$address,$phone,$mobilPhone,$workPhone,$fax,$email,$comments,$numberUsed,City $city,SellerTitle $sellerTitle,User $user,$asset=true,$easyload=true)

					$seller = Seller::create($pdo,strtoupper( trim($line[1])),'',strtoupper( trim($line[2])),'','','','','','',0,$citySeller,SellerTitle::load($pdo,1),$user);

					$citySeller->setNumberUsed( $citySeller->getNumberUsed( )+1);

					$user->setNumberUsed($user->getNumberUsed()+1);
				}
					
			}else{
				$error[]="ville du vendeur manquante";
			}



		}

		/**
		 *  FIN
		 */
		if(empty($error)){
			// save
			//echo 'done<br/>';
			//			mandate::create($pdo,$line[0],)
			/*
			N° de mandat		$l[0]
			Nom du vendeur		$l[1]
			Adresse du vendeur	$l[2]

			CP vendeur 		$l[3]
			ville vendeur		$l[4]

			Adresse du bien	$l[5]
			Cp bien			$l[6]
			Ville bien			$l[7]
			Demarcheur			$l[8]
			Prix du mandat		$l[9]
			Net vendeur		$l[10]
			Id PUB				$l[11]
			Nature mandat		$l[12]
			Type de transaction$l[13]
			Début mandat		$l[14]
			Type de bien		$l[15]
			Date visite 		$l[16]
			*/















			/*
			 Mandate::create($pdo,$line[0],$line[14],'',trim($line[5]),$prixMandat,$netVendeur,$commission,0,0,'','','','',
			 '','','','','','','','',0,'','','','','','','','','','','','','','','','','','','','','','','',
			 $user,$sector,$cityMandate,null,$typeMandate,$transactionType,'','','',
			 '','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','',
			 '','','','','','','','','','','','','','','','','','','','','','','',''
			 );
			 */
			//				var_dump($cityMandate);
			$mandat= Mandate::create($pdo,$line[0],$debutMandat,null,
			trim($line[5]),$prixMandat,$netVendeur,$commission,
				'','','','',
				'','','','','','','','','','','',
				'','','','','','','','','','','','','','','','','','','','','','','',$user,$cityMandate->getSector(),
			$cityMandate,Notary::load($pdo,$idNotaryDefault),$typeMandate,
			$transactionType,MandateEtap::load($pdo,Constant::ID_ETAP_TO_SELL),null
			);
			$mandat->addSeller($seller,1);
			$mandat->setNature($nature);
			$user->setNumberUsed($user->getNumberUsed()+1);
			$cityMandate->setNumberUsed($cityMandate->getNumberUsed()+1);
			$seller->setNumberUsed($seller->getNumberUsed() +1);

			/*
			 echo 'DONE mandat concerné : ';
			 echo '<pre>';
			 print_r($line);
			 echo '</pre>';
			 echo '<pre>';
			 print_r($cityMandate);
			 echo '</pre>';
			 echo '<hr/>';
			 */
		}
		else{
			$flux='';
			foreach($error as $e){
				$flux.='- '.$e;
			}
			$flux.=";$line[0];$line[1];$line[2];$line[3];$line[4];$line[5];$line[6];$line[7];$line[8];$line[9];$line[10];$line[11];$line[12];$line[13];$line[14];$line[15]";
			if($flux!='')
			fwrite($export, $flux);
				
			echo '<pre>';
			print_r($error);
			echo '</pre>';
			echo 'mandat concerné : ';
			echo '<pre>';
			print_r($line);
			echo '</pre>';
			echo '<hr/>';

		}
	}
	/*On ferme le fichier*/
	fclose($handle);
}
