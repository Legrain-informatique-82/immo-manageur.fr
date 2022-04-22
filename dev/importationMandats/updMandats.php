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
$error = array();
$name='110905auvillar.csv';
$name='110905lvd.csv';
//$name='110905moissac.csv';



$flux ="causes;type transaction;type bien;code affaire;no mandat;NOM VENDEUR;PRENOM VENDEUR;cp;ville;Prix mandat euro;secteur;pub;nb de pieces;nb de chambres;surface habitable;surface terrain;niveaux;etage;annee construction;jardin;digicode;jardin;balcon;terrasse;cave;acsenceur;garage;parking;chauffage;nb salle de bains;nb WC;orientation;DateModif;categorieinternet;TexteInternet1;TexteInternet2;TexteInternet3;Stationnement;URLVisiteVirtuelle1;URLVisiteVirtuelle2;URLVisiteVirtuelle3;CritN1;CritN2;CritN3;CritN4;CritC1;CritC2;CritC3;CritC4;CritD1;CritD2;CritD3;CritD4;DPE (valeur);DPE (lettre);GES (valeur);GES (lettre);Type affaire\n";
$handle = fopen('sources/complement/'.$name, 'r');
$export = fopen('sources/errors/complement/erreurs '.$name, 'w');
fwrite($export, $flux);

if ($handle)
{
	/*Tant que l'on est pas à la fin du fichier*/
	while (!feof($handle))
	{
		$error=array();
		/*On lit la ligne courante*/
		$buffer = fgets($handle);
		$itemList = explode(';',$buffer);


		//var_dump($itemList);
		// traitement des erreurs possible
		// choix possible parmi une liste ... Faire comme ville, = ajouter l'attribut si besoin est
		$numeroMandat = $itemList[3];




		// load du mandat /!\
		$pdoStatement = Mandate::selectByNumberMandate($pdo,$numeroMandat);
		$mandats = array();
		while($mandat = Mandate::fetch($pdo,$pdoStatement )){
			$mandats[]=$mandat;
		}
		$mandat=null;
		if(count($mandats)==0){
			$error[]="Mandat introuvable";
		}elseif(count($mandats)==1){
			$mandat = $mandats[0];
		}else{
			$error[]="Numéro de mandat en plusieurs exemplaires";
		}
			
		if($mandat!=null){
			// chauffage

			if($itemList[27]!=''){
				$heating=null;
				$listHeating = MandateHeating::loadAll($pdo);
				foreach($listHeating as $i){
					if(strtoupper($i->getName()) == strtoupper($itemList[27]) ) {
						$heating = MandateHeating::load($pdo, $i->getId());
					}
				}
				if($heating==null)
				$heating = MandateHeating::create($pdo,$itemList[27] , $itemList[27] );
				$mandat->setHeating($heating,false);

					
			}

			// Orientation
			if($itemList[30]!=''){
				$orientation=null;
				$listOrientation = MandateOrientation::loadAll($pdo);
				foreach($listOrientation as $i){
					if(strtoupper($i->getName()) == strtoupper($itemList[30]) ) {
						$orientation = MandateOrientation::load($pdo, $i->getId());
					}
				}
				if($orientation==null)
				$orientation = MandateOrientation::create($pdo,$itemList[30] , $itemList[30] );
					
				$mandat->setOrientation($orientation,false);
			}

		}

		if(!empty($error)){
			// fichier log
			$ligne='';
			foreach($error as $e){
				$ligne.='- '.$e;
			}
			foreach($itemList as $i ){
				$ligne.=';'.$i.' ';
			}
			fwrite($export, $ligne);
		}else{
			$mandat->setPubInternet($itemList[10],false);

			if(	$itemList[11]!=''&&$itemList[11]!=0)
			$mandat->setNbPiece($itemList[11],false);

			if(	$itemList[12]!=''&&$itemList[12]!=0)
			$mandat->setNbChambre($itemList[12],false);

			if(	$itemList[13]!=''&&$itemList[13]!=0)
			$mandat->setSurfaceHabitable($itemList[13],false);

			if(	$itemList[14]!=''&&$itemList[14]!=0)
			$mandat->setSuperficieTotale($itemList[14],false);
			if(	$itemList[15]!='')
			$mandat->setNiveau($itemList[15],false);
			// Manque etage sur mes mandats (itemList16)
			if(	$itemList[17]!=''&&$itemList[17]!=0)
			$mandat->setAnneeConstruction($itemList[17],false);


			if(	$itemList[22]!=''&&$itemList[22]!=0)
			$mandat->setTerrasse($itemList[22]=='N'?0:1,false);
			if(	$itemList[23]!=''&&$itemList[23]!=0)
			$mandat->setCave($itemList[23]=='N'?0:1,false);
			if(	$itemList[25]!=''&&$itemList[25]!=0)
			$mandat->setGarage($itemList[25]=='N'?0:1,false);
			if(	$itemList[26]!=''&&$itemList[26]!=0)
			$mandat->setParking($itemList[26]=='N'?0:1,false);

			if($itemList[52]!=0 || $itemList[54]!=0){
				$valDpe = ValDpe::loadByMandate($pdo, $mandat);

				if($valDpe!=null){
					if($itemList[52]!=0)
					$valDpe->setConsoEner($itemList[52],false);
					if($itemList[54]!=0)
					$valDpe->setEmissionGaz($itemList[54],false);
					$valDpe->update();
					//set
				}else{
					// create
					$consoEner = $itemList[52]!=0?$itemList[52]:null;
					$emiGaz = $itemList[54]!=0?$itemList[54]:null;
					ValDpe::create($pdo,$consoEner ,$emiGaz , $mandat);
				}
			}
			// chauffage et orientation.
			$mandat->update();
var_dump($itemList);
			// save BDD
			//var_dump($mandat);

		}
	}
}

echo 'done';

//    type transaction 	    type bien 	    code affaire	 no mandat	NOM VENDEUR	PRENOM VENDEUR	cp	ville	    Prix mandat euro	secteur	pub	    nb de pieces	    nb de chambres	surface habitable	    surface terrain	niveaux	etage	    annee construction	    jardin : B(O/N) 	digicode	jardin	balcon	terrasse	cave	acsenceur	garage	parking	chauffage	    nb salle de bains	   nb WC	orientation	DateModif	categorieinternet	TexteInternet1	TexteInternet2	TexteInternet3	Stationnement	URLVisiteVirtuelle1	URLVisiteVirtuelle2	URLVisiteVirtuelle3	CritN1	CritN2	CritN3	CritN4	CritC1	CritC2	CritC3	CritC4	CritD1	CritD2	CritD3	CritD4	DPE (valeur)	DPE (lettre)	- GES (valeur)	- GES (lettre)	Type affaire.
