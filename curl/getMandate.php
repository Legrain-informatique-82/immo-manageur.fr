<?php
session_start();
ini_set('display_errors','off');

require_once dirname(__FILE__).'/../libs/php_functions_missing.php';
require_once dirname(__FILE__).'/../const/config.php';
require_once dirname(__FILE__).'/../class/interfaceController.php';
require_once dirname(__FILE__).'/../class/CoreController.class.php';
require_once dirname(__FILE__).'/../class/Tools.php';
require_once dirname(__FILE__).'/../modules/user/model/requires.php';
require_once dirname(__FILE__).'/../modules/biens/model/requires.php';
require_once dirname(__FILE__).'/../modules/seller/model/requires.php';
require_once dirname(__FILE__).'/../modules/mandate_features/model/requires.php';
require_once dirname(__FILE__).'/../modules/mandate_type/model/requires.php';
require_once dirname(__FILE__).'/../modules/export/model/requires.php';
require_once dirname(__FILE__).'/../modules/rapprochement/model/requires.php';
$pdo = new PDO('mysql:dbname='.Constant::DATABASE_NAME.';host='.Constant::DATABASE_SERVER.';',Constant::DATABASE_USER,Constant::DATABASE_PASSWORD);



$idseller= $_POST['idseller'];

// $type=$_POST['type'];

// $idseller= 782;
// $idseller= 832;
// $type='mandate';


$seller = Seller::load($pdo,$idseller );
$res=array();


if($seller!=null){
	foreach( Mandate::listMandateBySeller($pdo,$seller) as $m){
		if($m->getEtap()->getId() == Constant::ID_ETAP_TO_SELL ){
			$objAfficheEnVitrine = OtherComplementMandate::loadByMandate($pdo,$m);
			$partage = array();
			$visites = array();
			foreach( Passerelle::loadAllAsset($pdo) as $p){
				if($p->isLinked( $m )){
					$partage[]=$p->getName();
				}
			}
			foreach(BddRapprochement::loadByMandate($pdo, $m) as $vi){
				// on ne garde que les visites réalisées
				if($vi->getResultatVisite()!=0){
					$visites[]=array(
										'dateVisite'=>date('d/m/Y',$vi->getDateVisite()),
										'resultatVisite'=>$vi->getResultatVisite()==1?'Ne correspond pas':'Correspond',
										'pointsPositifs'=>$vi->getPointsPositifs(),
										'pointsNegatifs'=>$vi->getPointsNegatifs()
					);
				}
			}


			$res[]=array(
							'id'=>$m->getId(),
							'numberMandate' =>$m->getNumberMandate(),
							'typeMandat'=>$m->getMandateType()->getName(),
							'pubInternet'=>$m->getPubInternet(),
							'enVitrine' =>$objAfficheEnVitrine?'Oui':'Non',
							'partage' =>$partage,
							'nomCommercial'=>$m->getUser()->getName(),
							'prenomCommercial'=>$m->getUser()->getFirstname(),
							'emailCommercial'=>$m->getUser()->getEmail(),
							'visites'=>$visites
			);
		}



		// 			$res[]=$m;
	}


}


echo json_encode($res);

// var_dump($res[0]['visites']);
