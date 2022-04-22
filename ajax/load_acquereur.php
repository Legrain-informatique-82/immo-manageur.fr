<?php
session_start();
require_once dirname(__FILE__).'/../libs/php_functions_missing.php';
require_once dirname(__FILE__).'/../const/config.php';
require_once dirname(__FILE__).'/../class/interfaceController.php';
require_once dirname(__FILE__).'/../class/CoreController.class.php';
require_once dirname(__FILE__).'/../class/Tools.php';
require_once dirname(__FILE__).'/../modules/user/model/requires.php';
require_once dirname(__FILE__).'/../modules/acquereur/model/requires.php';

$pdo = new PDO('mysql:dbname='.Constant::DATABASE_NAME.';host='.Constant::DATABASE_SERVER.';',Constant::DATABASE_USER,Constant::DATABASE_PASSWORD);
$acq = $_GET['toogle']==0?Acquereur::loadAllAsset($pdo):Acquereur::loadAll($pdo);
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
foreach($acq as $a){
	$ret.='<tr>
				<td>'.$a->getName().' '.$a->getFirstname().'</td>
				<td>'.$a->getTitreAcquereur()->getName().'</td>
				<td>'.$a->getUser()->getFirstname().' '.$a->getUser()->getName().'</td>
				<td>';

	if( $a->getPhone()) $ret.='<p>'.Lang::LABEL_SELLER_ADD_PHONE.$a->getPhone().'</p>';
	if( $a->getMobilPhone()) $ret.='<p>'.Lang::LABEL_SELLER_ADD_MOBIL_PHONE.$a->getMobilPhone().'</p>';
	if( $a->getWorkPhone()) $ret.='<p>'.Lang::LABEL_SELLER_ADD_WORK_PHONE.$a->getWorkPhone().'</p>';
	$ret.='</td>
				<td>'.$a->getEmail().'</td>';

	$ret.=$a->getUser()->getIdUser() == $user->getIdUser() || $user->getLevelMember()->getIdLevelMember() < 3?'<td><a href="'.Tools::create_url($user,'acquereur','update',$a->getIdAcquereur()).'" title="'.lang::LABEL_UPDATE.'"><img src="'.Constant::DEFAULT_URL_PICTURE_DIRECTORY.'update.png" alt="'.lang::LABEL_UPDATE.'" /></td>':'<td>-</td>';

	$ret.=$a->getUser()->getIdUser() == $user->getIdUser() || $user->getLevelMember()->getIdLevelMember() < 3?'<td><a class="jsDelAcquereur" rel="'.$a->getIdAcquereur().'" href="'.Tools::create_url($user,'acquereur','delete',$a->getIdAcquereur()).' title="'.lang::LABEL_DELETE.'"><img src="'.Constant::DEFAULT_URL_PICTURE_DIRECTORY.'delete.png" alt="'.lang::LABEL_DELETE.'" /></a></td>':'<td>-</td>';
	$ret.='<td><a href="'.Tools::create_url($user,'acquereur','see',$a->getIdAcquereur()).'" title="'.lang::LABEL_SEE.'"><img src="'.Constant::DEFAULT_URL_PICTURE_DIRECTORY.'see.png" alt="'.lang::LABEL_SEE.'" /></a></td>';
	$ret.='</tr>';
}
$ret .='</tbody>
</table>';
echo $ret;