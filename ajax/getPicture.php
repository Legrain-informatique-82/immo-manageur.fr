<?php
session_start();
require_once dirname(__FILE__) . '/../libs/php_functions_missing.php';
require_once dirname(__FILE__) . '/../const/config.php';
require_once dirname(__FILE__) . '/../class/interfaceController.php';
require_once dirname(__FILE__) . '/../class/CoreController.class.php';
require_once dirname(__FILE__) . '/../class/Tools.php';
require_once dirname(__FILE__) . '/../modules/biens/model/requires.php';
require_once dirname(__FILE__) . '/../modules/mandate_features/model/requires.php';
require_once dirname(__FILE__) . '/../modules/mandate_type/model/requires.php';
$pdo = new PDO('mysql:dbname=' . Constant::DATABASE_NAME . ';host=' . Constant::DATABASE_SERVER . ';', Constant::DATABASE_USER, Constant::DATABASE_PASSWORD);
// recuperation de l'image par defaut
$idMandate = $_GET['idMandate'];
$m = Mandate::load($pdo, $idMandate);
$mod = $m -> getMandateType() -> getName() == 'Terrain' ? 'terrain' : 'mandat';
$pict = $m -> getPictureByDefault();
$return ='<div class="row">';
if($pict)
    $return .= '<div class="col-md-4 text-center"><img src="' . Constant::DEFAULT_URL_PICTURE_MODULE_DIRECTORY . $mod . '/thumb/' . $pict -> getName() . '" alt="" class="img-thumbnail" /></div>';
else
//$return = '<p style="height:143px;>Aucun aperçu pour ce mandat<p>';
    $return .= '<div class="col-md-4 text-center" id="emptyMiniatureLeftColumn" ><img src="' . Constant::DEFAULT_URL_PICTURE_MODULE_DIRECTORY . $mod . '/no-picture.jpg" alt="" class="img-thumbnail" /></div>';
 
//Affichage du prix
// $return .= '<p class="gras">Prix FAI : ' .Tools::grosNombre( round($m -> getPriceFAI(),0)) . ' €</p>';
// if($mod == 'terrain') {
// 	$tmp = $m->getSuperficieTotale()==0?'NC':$m->getSuperficieTotale().' m²';
// 	$return .= '<p>Surface terrain : '.$tmp.'</p>';
// } else {
// 	$tmp = $m->getNbPiece()==0?'NC':$m->getNbPiece();
// 	$return .= '<p>Nb Pièces : '.$tmp.'</p>';
// 	$tmp = $m->getSurfaceHabitable()==0?'NC':$m->getSurfaceHabitable().' m²';
// 	$return .= '<p>Surface hab. : '.$tmp.'</p>';
// 	$tmp = $m->getSuperficieTotale()==0?'NC':$m->getSuperficieTotale().' m²';
// 	$return .= '<p>Surface terrain : '.$tmp.'</p>';
// 	$tmp = $m->getNbChambre()==0?'NC':$m->getNbChambre();
// 	$return .= '<p>Nb chambres : '.$tmp.'</p>';
// 	$tmp = $m->getSurfacePieceVie()==0?'NC':$m->getSurfacePieceVie().' m²';
// 	$return .= '<p>Surface pièces vie : '.$tmp.' </p>';
// 	$tmp = $m->getNiveau()==0?'NC':$m->getNiveau( );
// 	$return .= '<p>Niveau : '.$tmp.'</p>';
// 	$tmp = $m->getPlainPied()==0?'Non':'Oui';
// 	$return .= '<p>Plain pied : '.$tmp.'</p>';
// 	$tmp = $m->getGarage()==0?'Non':'Oui';
// 	$return .= '<p>Garage : '.$tmp.'</p>';
// 	$tmp = $m->getParking()==0?'Non':'Oui';
// 	$return .= '<p>Parking : '.$tmp.'</p>';
// 	$tmp = $m->getCheminee()==0?'Non':'Oui';
// 	$return .= '<p>Cheminée : '.$tmp.'</p>';
// 	$tmp = $m->getPiscine()==0?'Non':'Oui';
// 	$return .= '<p>Piscine : '.$tmp.'</p>';
// }

$return .= '<div class="col-md-4"><dl class="dl-horizontal">
<dt>Prix FAI : </dt><dd>' .Tools::grosNombre( round($m -> getPriceFAI(),0)) . ' €</dd>';
if($mod == 'terrain') {
	$tmp = $m->getSuperficieTotale()==0?'NC':$m->getSuperficieTotale().' m²';
	$return .= '<dt>Surface terrain : </dt><dd>'.$tmp.'</dd>';
} else {
	$tmp = $m->getNbPiece()==0?'NC':$m->getNbPiece();
	$return .= '<dt>Nb Pièces : </dt><dd>'.$tmp.'</dd>';
	$tmp = $m->getSurfaceHabitable()==0?'NC':$m->getSurfaceHabitable().' m²';
	$return .= '<dt>Surface hab. : </dt><dd>'.$tmp.'</dd>';
	$tmp = $m->getSuperficieTotale()==0?'NC':$m->getSuperficieTotale().' m²';
	$return .= '<dt>Surface terrain : </dt><dd>'.$tmp.'</td>';
	$tmp = $m->getNbChambre()==0?'NC':$m->getNbChambre();
	$return .= '<dt>Nb chambres : </dt><dd>'.$tmp.'</dd>';
	$tmp = $m->getSurfacePieceVie()==0?'NC':$m->getSurfacePieceVie().' m²';
	$return .= '<dt>Surface pièces vie : </td><dd>'.$tmp.' </dd>';
	$tmp = $m->getNiveau()==0?'NC':$m->getNiveau( );
    $return.='</dl></div><div class="col-md-4"><dl class="dl-horizontal">';
	$return .= '<dt>Niveau : </dt><dd>'.$tmp.'</dd>';
	$tmp = $m->getPlainPied()==0?'Non':'Oui';
	$return .= '<dt>Plain pied : </dt><dd>'.$tmp.'</dd>';
	$tmp = $m->getGarage()==0?'Non':'Oui';
	$return .= '<dt>Garage : </dt><dd>'.$tmp.'</dd>';
	$tmp = $m->getParking()==0?'Non':'Oui';
	$return .= '<dt>Parking : </dt><dd>'.$tmp.'</dd>';
	$tmp = $m->getCheminee()==0?'Non':'Oui';
	$return .= '<dt>Cheminée : </dt><dd>'.$tmp.'</dd>';
	$tmp = $m->getPiscine()==0?'Non':'Oui';
	$return .= '<dt>Piscine : </dt><dd>'.$tmp.'</dd>';
}
$return.='</dl></div></div>';
echo $return;