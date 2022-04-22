<?php
session_start();
require_once dirname(__FILE__).'/../libs/php_functions_missing.php';
require_once dirname(__FILE__).'/../const/config.php';
require_once dirname(__FILE__).'/../class/interfaceController.php';
require_once dirname(__FILE__).'/../class/CoreController.class.php';
require_once dirname(__FILE__).'/../class/Tools.php';


foreach( glob(dirname(__FILE__).'/../modules/*/model/requires.php') as $require){
	require_once $require;
}
$pdo = new PDO('mysql:dbname='.Constant::DATABASE_NAME.';host='.Constant::DATABASE_SERVER.';',Constant::DATABASE_USER,Constant::DATABASE_PASSWORD);



$classModel = $_GET['class'];

$return = '<select name="val1[]" class="form-control" >';
if($classModel=='User'){
	foreach( User::loadAll($pdo) as $it ){
		$return.='<option value="'.$it->getIdUser().'">'.$it->getFirstname().' '.$it->getName().'</option>';
	}
}
elseif( $classModel=='MandateType' ){
	foreach( MandateType::loadAll($pdo) as $it ){
		$return.='<option value="'.$it->getIdMandateType().'">'.$it->getName().'</option>';
	}
}
elseif( $classModel=='TransactionType' ){
	foreach( TransactionType::loadAll($pdo) as $it ){
		$return.='<option value="'.$it->getIdTransactionType().'">'.$it->getName().'</option>';
	}
}
elseif( $classModel=='City' ){
	foreach( City::loadAll($pdo) as $it ){
		$return.='<option value="'.$it->getIdCity().'">'.$it->getZipCode().' '.$it->getName().'</option>';
	}
}
elseif( $classModel=='Sector' ){
	foreach( Sector::loadAll($pdo) as $it ){
		$return.='<option value="'.$it->getIdSector().'">'.$it->getName().'</option>';
	}
}
elseif( $classModel=='MandateNature' ){
	foreach( MandateNature::loadAll($pdo) as $it ){
		$return.='<option value="'.$it->getIdMandateNature().'">'.$it->getName().'</option>';
	}
}
elseif( $classModel=='MandateEtap' ){
	foreach( MandateEtap::loadAll($pdo) as $it ){
		$return.='<option value="'.$it->getIdMandateEtap().'">'.$it->getName().'</option>';
	}
}





$return.='</select>
<input type="hidden" name="val2[]" value=""/><input type="hidden" name="type[]" value="list"/><input type="hidden" name="table[]" value="'.$classModel.'"/>';


/******************************
 * CAS PARTICULIER
 *******************************/
if($classModel=='Critere_mandate'){

	$return ='<p class="lineCritere bulle">
		<select name="critere[]" class="chooseCritereMandate form-control">
			<option value="" class="empty">_____</option>';
	foreach( Critere_mandate::loadAll($pdo) as $it ){
		$return.='<option value="'.$it->getChampsCorrespondant().'" class="';
		if( $it->getType()!='list')
			
		$return.=$it->getType();
		else
		$return.=$it->getNameTable();
		$return.='">'.$it->getNom().'</option>';
	}
	$return.='</select>
		<span class="complementWithJs"></span>
		<a href="#" class="delLineRecherche btn btn-danger" title="Supprimer"><i class="fa fa-trash"></i></a>
	</p>';
}elseif($classModel =='Critere_acquereur'){
$return ='<p class="lineCritere bulle">
		<select name="critere[]" class="chooseCritereMandate form-control">
			<option value="" class="empty">_____</option>';
	foreach( Critere_acquereur::loadAll($pdo) as $it ){
		$return.='<option value="'.$it->getChampsCorrespondant().'" class="';
		if( $it->getType()!='list')
			
		$return.=$it->getType();
		else
		$return.=$it->getNameTable();
		$return.='">'.$it->getNom().'</option>';
	}
	$return.='</select>
		<span class="complementWithJs"></span>
		<a href="#" class="delLineRecherche btn btn-danger" title="Supprimer"><i class="fa fa-trash"></i></a>
	</p>';
}
echo $return;