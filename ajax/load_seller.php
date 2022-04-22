<?php
session_start();
require_once dirname(__FILE__).'/../libs/php_functions_missing.php';
require_once dirname(__FILE__).'/../const/config.php';
require_once dirname(__FILE__).'/../class/interfaceController.php';
require_once dirname(__FILE__).'/../class/CoreController.class.php';
require_once dirname(__FILE__).'/../class/Tools.php';
require_once dirname(__FILE__).'/../modules/user/model/requires.php';
require_once dirname(__FILE__).'/../modules/seller/model/requires.php';

$pdo = new PDO('mysql:dbname='.Constant::DATABASE_NAME.';host='.Constant::DATABASE_SERVER.';',Constant::DATABASE_USER,Constant::DATABASE_PASSWORD);
$sell = $_GET['toogle']==0?Seller::loadAllAsset($pdo):Seller::loadAll($pdo);
$user = User::unserialize($pdo,$_SESSION['user']);

$ret ='<table class="standard">
	<thead>
		<tr>
			<th>Nom &amp; prénom</th>
			<th>Titre</th>
			<th>Opérateur lié</th>
			<th>téléphones</th>
			<th>email</th>
			<th>Modifier</th>
			<th>Supprimer</th>
			<th>Voir</th>
		</tr>
	</thead>
	<tbody>';
foreach($sell as $s){
	$ret.='<tr>
				<td>'.$s->getName().' '.$s->getFirstname().'</td>
				<td>'.$s->getSellerTitle()->getLibel().'</td>
				<td>'.$s->getUser()->getFirstname().' '.$s->getUser()->getName().'</td>
				<td>';

	if( $s->getPhone()) $ret.='<p>'.Lang::LABEL_SELLER_ADD_PHONE.$s->getPhone().'</p>';
	if( $s->getMobilPhone()) $ret.='<p>'.Lang::LABEL_SELLER_ADD_MOBIL_PHONE.$s->getMobilPhone().'</p>';
	if( $s->getWorkPhone()) $ret.='<p>'.Lang::LABEL_SELLER_ADD_WORK_PHONE.$s->getWorkPhone().'</p>';
	$ret.='</td>
				<td>'.$s->getEmail().'</td>';

	$ret.=$s->getUser()->getIdUser() == $user->getIdUser() || $user->getLevelMember()->getIdLevelMember() < 3?'<td><a href="'.Tools::create_url($user,'seller','updates',$s->getIdSeller()).'" title="'.lang::LABEL_UPDATE.'"><img src="'.Constant::DEFAULT_URL_PICTURE_DIRECTORY.'update.png" alt="'.lang::LABEL_UPDATE.'" /></a></td>':'<td>-</td>';

	$ret.=$s->getUser()->getIdUser() == $user->getIdUser() || $user->getLevelMember()->getIdLevelMember() < 3?'<td><a class="jsdelSeller" rel="'.$s->getIdSeller().'" href="'.Tools::create_url($user,'seller','deletes',$s->getIdSeller()).'" title="'.lang::LABEL_DELETE.'"><img src="'.Constant::DEFAULT_URL_PICTURE_DIRECTORY.'delete.png" alt="'.lang::LABEL_DELETE.'" /></a></td>':'<td>-</td>';
	$ret.='<td><a href="'.Tools::create_url($user,'seller','sees',$s->getIdSeller()).'" title="'.lang::LABEL_SEE.'"><img src="'.Constant::DEFAULT_URL_PICTURE_DIRECTORY.'see.png" alt="'.lang::LABEL_SEE.'" /></a></td>';
	$ret.='</tr>';
}
$ret .='</tbody>
</table>';
echo $ret;