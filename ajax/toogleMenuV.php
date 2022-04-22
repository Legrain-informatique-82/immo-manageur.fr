<?php 
session_start();
require_once dirname(__FILE__).'/../libs/php_functions_missing.php';
require_once dirname(__FILE__).'/../const/config.php';
require_once dirname(__FILE__).'/../class/interfaceController.php';
require_once dirname(__FILE__).'/../class/CoreController.class.php';
require_once dirname(__FILE__).'/../class/Tools.php';
// charge les models des modules
foreach (glob(dirname(__FILE__).'/../modules/*/model/requires.php') as $filename) {
	require_once $filename;
}
// récup de l'état du menu
// $_SESSION['etatMenuVertical'] contient repli s'il est replié et depli s'il est déplié.


// met à jour l'etat du menu
$_SESSION['etatMenuVertical'] = $_SESSION['etatMenuVertical']=='repli'?'depli':'repli';
//$url='<ul id="menuVertical" class="'.$_SESSION['etatMenuVertical'].'" >';
$i=0;
foreach($_SESSION['mainMenu'] as $item){
	
	$url.='<li> ';

	
	$url.='<a href="'.$item['url'].'" title="'.$item['libelle'].'" ';
	
	if($_GET['module']==$item['moduleName']){
		$url.='class="actifM actif ';
	}
	if($i==0)$url.='first';
	
	$url.='">';
	
	if($item['logo']!=''){
		$url.=' <img src="'.$item['logo'].'" alt="'.$item['libelle'].'"/>';
	}else{
		$url.=' <img src="'.Constant::DEFAULT_URL_LOGO_MODULES.'" alt="'.$item['libelle'].'"/>';
	}
	
	if($_SESSION['etatMenuVertical']=='depli'){
		$url.='<span class="libel">'.$item['libelle'].'</span>';
	}
	$url.='</a></li>';
$i++;	
}
$valueBtnMenuVertical= $_SESSION['etatMenuVertical']=='repli'?'>>':'<<';
$url.='<li><a id="jsToogleMenuP" href="#" class="last"> '.$valueBtnMenuVertical.' </a></li>';



echo json_encode(array('url'=>$url,'etatMenuVertical'=>  $_SESSION['etatMenuVertical']   ));


