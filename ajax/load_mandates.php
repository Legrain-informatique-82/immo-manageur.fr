<?php
session_start();
require_once dirname(__FILE__).'/../libs/php_functions_missing.php';
require_once dirname(__FILE__).'/../const/config.php';
require_once dirname(__FILE__).'/../class/interfaceController.php';
require_once dirname(__FILE__).'/../class/CoreController.class.php';
require_once dirname(__FILE__).'/../class/Tools.php';
require_once dirname(__FILE__).'/../modules/user/model/requires.php';
require_once dirname(__FILE__).'/../modules/acquereur/model/requires.php';
require_once dirname(__FILE__).'/../modules/sector/model/requires.php';
require_once dirname(__FILE__).'/../modules/rapprochement/model/requires.php';
require_once dirname(__FILE__).'/../modules/biens/model/requires.php';
require_once dirname(__FILE__).'/../modules/transaction_type/model/requires.php';
require_once dirname(__FILE__).'/../modules/mandate_features/model/requires.php';
require_once dirname(__FILE__).'/../modules/mandate_type/model/requires.php';
$pdo = new PDO('mysql:dbname='.Constant::DATABASE_NAME.';host='.Constant::DATABASE_SERVER.';',Constant::DATABASE_USER,Constant::DATABASE_PASSWORD);
$userToTakeAction = User::unserialize($pdo,$_SESSION['user']);
$error = array();
$ret = array();
$html = '';
$acq = Acquereur::load($pdo,$_GET['acq']);
$listMandats = ( $_GET['toogle'] ==0 )?Rapprochement::listMandateForAcq($pdo,$acq):Mandate::loadByEtap($pdo,MandateEtap::load($pdo,Constant::ID_ETAP_TO_SELL));



$html='
<table class="dataTableDefault table table-striped table-bordered">
    <thead>
            <tr class="tri">
                <th></th>
                <th></th>
                <th></th>
                <th></th>
                <th></th>
                <th></th>
                <th></th>
                <th></th>
                <th></th>
                <th class="jshide"></th>
                <th class="jshide"></th>
            </tr>
            <tr>
                <th>Prix fai</th>
                <th>Numéro du mandat</th>
                <th>Type de bien</th>
                <th>Type de transaction</th>
                <th>Style du bien</th>
                <th>Surface terrain</th>
                <th>Surface habitable</th>
                <th>Code postal</th>
                <th>ville</th>
                <th>Photo</th>
                <th>Actions</th>
            </tr>
            </thead>
	
	<tbody>';
foreach ($listMandats as $mandate){
	$rapproche = ( BddRapprochement::relMandateAcquereurExist($pdo,$mandate,$acq) ) ?1:0;
	$module=$mandate->getMandateType()->getName()=='Terrain'?'terrain':'mandat';
	$html.='<tr>
			<td class="gras';
	if (($mandate->getPriceFai() >= $acq->getPriceMax() ||$mandate->getPriceFai() <= $acq->getPriceMin())&& $acq->getPriceMax() !=0){

		$html.=' red';
	}
		
	$html.= '" data-order="'.$mandate->getPriceFai().'">'.Tools::grosNombre(round($mandate->getPriceFai(),0)).' €</td>';

	$html.= '<td class="gras">'.$mandate->getNumberMandate().'</td>';
		
		
	$html.= '<td class="gras';
    if($acq->getMandateType()) {
        if ($mandate->getMandateType()->getIdMandateType() != $acq->getMandateType()->getIdMandateType())
            $html .= ' red';
    }
	$html.='">'.$mandate->getMandateType()->getName().'</td>';

	$html.='<td ';
    if($acq->getMandateType()) {
        if ($mandate->getMandateType()->getIdMandateType() != $acq->getMandateType()->getIdMandateType())
            $html .= 'class="red"';
    }
	$html.='>'.$mandate->getTransactionType()->getName().'</td>';
		
		
		
	$html.='<td ';
	if ($mandate->getStyle()&&$acq->getMandateStyle()){
		if ($mandate->getStyle()->getIdMandateStyle() != $acq->getMandateStyle()->getIdMandateStyle())
		$html.=' class="red"';
		$html.='>'.$mandate->getStyle()->getName();
			
	}else  {
		if($mandate->getStyle())
		$html.='>'.$mandate->getStyle()->getName();
		else
		$html.='>NC';
	}
	$html.='</td>';

	$html.='<td>'.$mandate->getSuperficieTotale().'</td>';
	$html.='<td>'.$mandate->getSurfaceHabitable().'</td>';
	$html.='<td>'.$mandate->getCity()->getZipCode().'</td>';
	$html.='<td>'.$mandate->getCity()->getName().'</td>';


	$html.='<td>';
	if ($mandate->getPictureByDefault())
	$html.='<a href="'.Constant::DEFAULT_URL_PICTURE_MODULE_DIRECTORY.'/'.$module.'/big/'.$mandate->getPictureByDefault()->getName().'" class="fancybox"><img src="'.Constant::DEFAULT_URL_PICTURE_MODULE_DIRECTORY.'/'.$module.'/thumb/'.$mandate->getPictureByDefault()->getName().'" alt="" class="img-thumbnail"/></a>';
	else
	$html.='NC';

	$html.='</td>';

		
//	$html.='<td><a href="'.Tools::create_url($userToTakeAction,$module,'see',$mandate->getIdMandate()).'" title="Voir"><img src="'.Constant::DEFAULT_URL_PICTURE_DIRECTORY.'see.png" alt="Voir" /></a></td>';
	$html.='<td>';
    /*
	if(!$rapproche){
		$html.='<a href="'.Tools::create_url($userToTakeAction,'rapprochement','add_rapprochement_chooseM',$acq->getIdAcquereur(),array($mandate->getIdMandate())).'" title="Rapprocher"><img src="'.Constant::DEFAULT_URL_PICTURE_DIRECTORY.'rapprocher.png" alt="Rapprocher" /></a>';
	}else
	$html.='<a	href="'.Tools::create_url($userToTakeAction,'rapprochement','seeByChooseM',BddRapprochement::loadByMandateAndAcquereur($pdo,$mandate,$acq)->getIdRapprochement(),array($acq->getIdAcquereur())).'" title="Voir la fiche rapprochement"><img src="'.Constant::DEFAULT_URL_PICTURE_DIRECTORY.'see.png" alt="Voir la fiche rapprochement" /></a>';
    */
    $html.='<div class="btn-group">';

                            if (!$rapproche) {
                                $html.='<a class="btn btn-default" href = "'.Tools::create_url($userToTakeAction,'rapprochement','add_rapprochement_chooseM',$acq->getIdAcquereur(),array($mandate->getIdMandate())).'" title = "Rapprocher" >
                                    <i class="fa fa-crosshairs" ></i > Rapprocher
                                </a >';
                            }else{
                                $html.='<a class="btn btn-default" href="'.Tools::create_url($userToTakeAction,'rapprochement','seeByChooseM',BddRapprochement::loadByMandateAndAcquereur($pdo,$mandate,$acq)->getIdRapprochement(),array($acq->getIdAcquereur())).'" title="Fiche rapprochement"><i class="fa fa-chevron-circle-right"></i> Fiche rapprochement</a>';
                            }
    $html.=' <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
                                <span class="caret"></span>
                                <span class="sr-only">Toggle Dropdown</span>
                            </button>
                            <ul class="dropdown-menu" role="menu">
                                <li><a href="'.Tools::create_url($userToTakeAction,$module,'see',$mandate->getIdMandate()).'" title="Voir"><i class="fa fa-chevron-circle-right"></i> Voir la fiche du bien </a></li>
                            </ul>

                        </div>';
	$html.='</td>';

		
		
	$html.='</tr>';





















}

$html.='</tbody>
		</table>';

$ret['h2'] =($_GET['toogle'] ==0)?'Liste des rapprochements possible':'Tous les mandats';
$ret['html'] = $html;
echo json_encode($ret);
