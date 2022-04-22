<?php /* Smarty version Smarty-3.0.6, created on 2014-07-17 16:12:22
         compiled from "/var/www/aptana/immo-manageur.fr/modules/terrain/views/see.tpl" */ ?>
<?php /*%%SmartyHeaderCode:38594249053c7d9c6293b55-22682414%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '701a08309cfec4938c1a7d5f833d44c242de0330' => 
    array (
      0 => '/var/www/aptana/immo-manageur.fr/modules/terrain/views/see.tpl',
      1 => 1405606055,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '38594249053c7d9c6293b55-22682414',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<?php $_template = new Smarty_Internal_Template("tpl_default/entete.tpl", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate();?><?php $_template->updateParentVariables(0);?><?php unset($_template);?>

<p id="arrowsNextPreview">
	<?php if ($_smarty_tpl->getVariable('mandatPrecedent')->value){?> <a
		href="<?php echo Tools::create_url($_smarty_tpl->getVariable('user')->value,$_GET['module'],$_GET['page'],$_smarty_tpl->getVariable('premierMandat')->value->getIdMAndate());?>
"><img
		src="<?php echo Constant::DEFAULT_URL_PICTURE_DIRECTORY;?>
finalBack.png"
		alt="Premier Mandat" /> </a> <a
		href="<?php echo Tools::create_url($_smarty_tpl->getVariable('user')->value,$_GET['module'],$_GET['page'],$_smarty_tpl->getVariable('mandatPrecedent')->value->getIdMAndate());?>
"><img
		src="<?php echo Constant::DEFAULT_URL_PICTURE_DIRECTORY;?>
back.png"
		alt="Mandat précédent" /> </a> <?php }?> <?php if ($_smarty_tpl->getVariable('mandatSuivant')->value){?> <a
		href="<?php echo Tools::create_url($_smarty_tpl->getVariable('user')->value,$_GET['module'],$_GET['page'],$_smarty_tpl->getVariable('mandatSuivant')->value->getIdMAndate());?>
"><img
		src="<?php echo Constant::DEFAULT_URL_PICTURE_DIRECTORY;?>
forward.png"
		alt="Mandat suivant" /> </a> <a
		href="<?php echo Tools::create_url($_smarty_tpl->getVariable('user')->value,$_GET['module'],$_GET['page'],$_smarty_tpl->getVariable('dernierMandat')->value->getIdMAndate());?>
"><img
		src="<?php echo Constant::DEFAULT_URL_PICTURE_DIRECTORY;?>
finalForward.png"
		alt="Dernier mandat" /> </a> <?php }?>
</p>
<hr class="clear invi" />
<?php $_template = new Smarty_Internal_Template("tpl_default/hook.tpl", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
$_template->assign('position',"hook_action"); echo $_template->getRenderedTemplate();?><?php $_template->updateParentVariables(0);?><?php unset($_template);?>
<div class="blocEnteteMandat">


	<h1>Etape en cours :</h1>
	<p>etape : <?php echo $_smarty_tpl->getVariable('mandate')->value->getEtap()->getName();?>
</p>
	<?php if ($_smarty_tpl->getVariable('mandate')->value->getCommentaire()){?><?php echo $_smarty_tpl->getVariable('mandate')->value->getCommentaire();?>
<?php }?> <?php if (($_smarty_tpl->getVariable('user')->value->getLevelMember()->getIdLevelMember()<3||$_smarty_tpl->getVariable('user')->value->getIdUser()==$_smarty_tpl->getVariable('mandate')->value->getUser()->getIdUser())&&$_smarty_tpl->getVariable('mandate')->value->getEtap()->getIdMandateEtap()==Constant::ID_ETAP_TO_SELL){?>
	<p>
		<a
			href="<?php echo Tools::create_url($_smarty_tpl->getVariable('user')->value,$_GET['module'],'cancel',$_GET['action']);?>
">Annuler le mandat.</a>
	</p>
	<?php }?>  <?php if (($_smarty_tpl->getVariable('user')->value->getLevelMember()->getIdLevelMember()<3||$_smarty_tpl->getVariable('user')->value->getIdUser()==$_smarty_tpl->getVariable('mandate')->value->getUser()->getIdUser())&&$_smarty_tpl->getVariable('mandate')->value->getEtap()->getIdMandateEtap()!=Constant::ID_ETAP_TO_SELL){?>
	<p>
		<a
			href="<?php echo Tools::create_url($_smarty_tpl->getVariable('user')->value,$_GET['module'],'renew',$_GET['action']);?>
">Reaffecter
			le mandat</a>
	</p>
	<?php }?>  <?php if (($_smarty_tpl->getVariable('user')->value->getLevelMember()->getIdLevelMember()<3||$_smarty_tpl->getVariable('user')->value->getIdUser()==$_smarty_tpl->getVariable('mandate')->value->getUser()->getIdUser())&&$_smarty_tpl->getVariable('mandate')->value->getEtap()->getIdMandateEtap()==CONSTANT::ID_ETAP_COMPROMIS){?>
	<p>
		<a
			href="<?php echo Tools::create_url($_smarty_tpl->getVariable('user')->value,'terrain','endSell',$_smarty_tpl->getVariable('mandate')->value->getIdMandate());?>
">Finaliser
			la vente</a>
	</p>
	<?php }?> 
</div>
<?php if ($_smarty_tpl->getVariable('mandate')->value->getPubInternet()!=''){?>
<div class="blocEnteteMandat">
	<h1>Pub :</h1>

	<p><?php echo Tools::substr($_smarty_tpl->getVariable('mandate')->value->getPubInternet(),0,250);?>
 <?php if (Tools::strlen($_smarty_tpl->getVariable('mandate')->value->getPubInternet())>250){?> [...] <?php }?></p>
</div>
<?php }?>  <?php $_template = new Smarty_Internal_Template("tpl_default/hook.tpl", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
$_template->assign('position',"hook_elemMandateCom_see"); echo $_template->getRenderedTemplate();?><?php $_template->updateParentVariables(0);?><?php unset($_template);?>  <?php if ($_smarty_tpl->getVariable('mandate')->value->getPictureByDefault()){?>
<img
	src="<?php echo Constant::DEFAULT_URL_PICTURE_MODULE_DIRECTORY;?>
/<?php echo $_GET['module'];?>
/thumb/<?php echo $_smarty_tpl->getVariable('mandate')->value->getPictureByDefault()->getName();?>
"
	alt="" id="miniature2" />
<?php }?>
<hr class="clear invi" />
<p id="prixHaut" class="bulle"><?php echo Tools::grosNombre(round($_smarty_tpl->getVariable('mandate')->value->getPriceFAI(),0));?>
 € - FAI</p>
<hr class="clear invi" />
	<?php if ($_smarty_tpl->getVariable('errorPlan')->value){?>
					
				<ul class="contError">
					<?php  $_smarty_tpl->tpl_vars['e'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('errorPlan')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['e']->key => $_smarty_tpl->tpl_vars['e']->value){
?>
					<li class="error"><?php echo $_smarty_tpl->tpl_vars['e']->value;?>
</li> <?php }} ?>
				</ul>
				<?php }?>
<div id="tabs">
	<ul>
		<li><a href="#biens">Bien</a>
		</li>
		<li><a href="#vendeur">Vendeur</a>
		</li>
		<li><a href="#plans">Plans</a>
		</li>
		<li><a href="#fichiers">Fichiers</a>
		</li>
		<li><a href="#impressions">Impressions</a>
		</li> <?php $_template = new Smarty_Internal_Template("tpl_default/hook.tpl", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
$_template->assign('position',"hook_acqTitle"); echo $_template->getRenderedTemplate();?><?php $_template->updateParentVariables(0);?><?php unset($_template);?>
	</ul>
	<div id="biens">
		<div class="accordion" rel="1">
			<h2 rel="gen">
				<a href="#" rel="gen">Général</a>
			</h2>
			<div>
				<?php if (($_smarty_tpl->getVariable('user')->value->getLevelMember()->getIdLevelMember()<3||$_smarty_tpl->getVariable('user')->value->getIdUser()==$_smarty_tpl->getVariable('mandate')->value->getUser()->getIdUser())&&$_smarty_tpl->getVariable('mandate')->value->getEtap()->getIdMandateEtap()==Constant::ID_ETAP_TO_SELL){?>
				<p>
					<a
						href="<?php echo Tools::create_url($_smarty_tpl->getVariable('user')->value,$_GET['module'],'updateGen',$_GET['action']);?>
">Modifier
						les informations</a>
				</p>
				<?php }?>
				<div class="mSep">
					<h3>Localisation</h3>
					<p><?php echo $_smarty_tpl->getVariable('mandate')->value->getAddress();?>
</p>
					<p><?php echo $_smarty_tpl->getVariable('mandate')->value->getCity()->getZipCode();?>

						<?php echo $_smarty_tpl->getVariable('mandate')->value->getCity()->getName();?>
</p>

				</div>
				<div class="mSep">
					<h3>Général</h3>
					<p>Nature du bien : <?php if ($_smarty_tpl->getVariable('mandate')->value->getNature()==null){?>NC<?php }else{ ?><?php echo $_smarty_tpl->getVariable('mandate')->value->getNature()->getName();?>
<?php }?></p>
					<p>Utilisateur affecté : <?php echo $_smarty_tpl->getVariable('mandate')->value->getUser()->getName();?>

						<?php echo $_smarty_tpl->getVariable('mandate')->value->getUser()->getFirstname();?>
</p>
					<p>Notaire vendeur : <?php if ($_smarty_tpl->getVariable('mandate')->value->getNotary()){?><?php echo $_smarty_tpl->getVariable('mandate')->value->getNotary()->getName();?>
<?php }else{ ?>NC<?php }?></p>
					<p>Notaire acquereur : <?php if ($_smarty_tpl->getVariable('mandate')->value->getNotaryAcq()){?><?php echo $_smarty_tpl->getVariable('mandate')->value->getNotaryAcq()->getName();?>
<?php }else{ ?>NC<?php }?></p>
					<p>Type transaction : <?php echo $_smarty_tpl->getVariable('mandate')->value->getTransactionType()->getName();?>
</p>
					<p>Type de terrain : <?php if ($_smarty_tpl->getVariable('mandate')->value->getTypeTerrain()==0){?> NC <?php }elseif($_smarty_tpl->getVariable('mandate')->value->getTypeTerrain()==1){?> À batir <?php }else{ ?> À lotir<?php }?></p>
					<p>Situation du terrain : <?php if ($_smarty_tpl->getVariable('mandate')->value->getSituationTerrain()==0){?> NC <?php }elseif($_smarty_tpl->getVariable('mandate')->value->getSituationTerrain()==1){?> Lotissement <?php }else{ ?> Diffus ( hors lotissement)<?php }?></p>
					
				</div>
				<hr class="invi clear" />
				<div class="mSep">
					<h3>Mandat</h3>
					<p>N° Mandat : <?php echo $_smarty_tpl->getVariable('mandate')->value->getNumberMandate();?>
</p>
					<p>Début : <?php echo date(Constant::DATE_FORMAT2,$_smarty_tpl->getVariable('mandate')->value->getInitDate());?>
</p>
					<p>Fin : <?php if (date(Constant::DATE_FORMAT2,$_smarty_tpl->getVariable('mandate')->value->getDeadDate())=='01/01/1970'){?> NC
						<?php }else{ ?><?php echo date(Constant::DATE_FORMAT2,$_smarty_tpl->getVariable('mandate')->value->getDeadDate());?>
<?php }?></p>
					<p>libre le : <?php if ($_smarty_tpl->getVariable('mandate')->value->getFreeDate()==null){?> NC
						<?php }else{ ?><?php echo date(Constant::DATE_FORMAT2,$_smarty_tpl->getVariable('mandate')->value->getFreeDate());?>
<?php }?></p>

				</div>
				<div class="mSep">
					<h3>Prix</h3>
					 <?php if (Constant::ID_TRANSACTION_TYPE_SELLER==$_smarty_tpl->getVariable('mandate')->value->getTransactionType()->getIdTransactionType()){?>
					<p>Prix FAI : <?php echo Tools::grosNombre(round($_smarty_tpl->getVariable('mandate')->value->getPriceFAI(),0));?>

						&euro;</p>
					<p>Prix net vendeur :
						<?php echo Tools::grosNombre(round($_smarty_tpl->getVariable('mandate')->value->getPriceSeller(),0));?>
 &euro;</p>
					<p>Commission :
						<?php echo Tools::grosNombre(round($_smarty_tpl->getVariable('mandate')->value->getCommission(),0));?>
 &euro;</p>

					<?php if (Tools::grosNombre(round($_smarty_tpl->getVariable('mandate')->value->getEstimationMaxi(),0))==0){?>
					<?php if (Tools::grosNombre(round($_smarty_tpl->getVariable('mandate')->value->getEstimationFai(),0))!=0){?>
					<p>Estimation FAI :
						<?php echo Tools::grosNombre(round($_smarty_tpl->getVariable('mandate')->value->getEstimationFai(),0));?>
 &euro;</p>
					<?php }?> <?php }else{ ?>
					<p>Estimation FAI entre
						<?php echo Tools::grosNombre(round($_smarty_tpl->getVariable('mandate')->value->getEstimationFai(),0));?>
 &euro;
						et <?php echo Tools::grosNombre(round($_smarty_tpl->getVariable('mandate')->value->getEstimationMaxi(),0));?>

						&euro;</p>
					<?php }?> <?php if (Tools::grosNombre(round($_smarty_tpl->getVariable('mandate')->value->getMargeNegociation(),0))!=0){?>
					<p>Marge negoce :
						<?php echo Tools::grosNombre(round($_smarty_tpl->getVariable('mandate')->value->getMargeNegociation(),0));?>

						&euro;</p>
					<?php }?> <?php }else{ ?>
					<p>Loyer + frais d'agence :
						<?php echo Tools::grosNombre(round($_smarty_tpl->getVariable('mandate')->value->getPriceFAI(),0));?>
 &euro;</p>
					<p>Loyer : <?php echo Tools::grosNombre(round($_smarty_tpl->getVariable('mandate')->value->getPriceSeller(),0));?>

						&euro;</p>
					<p>Commission :
						<?php echo Tools::grosNombre(round($_smarty_tpl->getVariable('mandate')->value->getCommission(),0));?>
 &euro;</p>
					<?php }?>
				</div>
				<hr class="invi clear" />
				<?php if ($_smarty_tpl->getVariable('mandate')->value->getGeolocalisation()){?> <?php $_smarty_tpl->tpl_vars["geo"] = new Smarty_variable(explode(',',$_smarty_tpl->getVariable('mandate')->value->getGeolocalisation()), null, null);?>
				<h3>Géolocalisation</h3>
				<div id="map"></div>
				<p>
					Latitude : en degrès sexagésimaux : <?php echo $_smarty_tpl->getVariable('geo')->value[0];?>
 - en degrès décimaux :
					<span id="latitude"><?php echo Tools::convertSexadecimalInDecimal($_smarty_tpl->getVariable('geo')->value[0]);?>
</span>
					<br />Longitude : en degrès sexagésimaux : <?php echo $_smarty_tpl->getVariable('geo')->value[1];?>
 - en degrès
					décimaux : <span id="longitude"><?php echo Tools::convertSexadecimalInDecimal($_smarty_tpl->getVariable('geo')->value[1]);?>
</span>
				</p>
				<?php }else{ ?>
				<div id="map2" data-address="<?php echo $_smarty_tpl->getVariable('mandate')->value->getAddress();?>
, <?php echo $_smarty_tpl->getVariable('mandate')->value->getCity()->getZipCode();?>
 <?php echo $_smarty_tpl->getVariable('mandate')->value->getCity()->getName();?>
"></div>
				<?php }?>
			</div>

			<h3>
				<a href="#">Infos/Descriptions</a>
			</h3>
			<div>
				<?php if (($_smarty_tpl->getVariable('user')->value->getLevelMember()->getIdLevelMember()<3||$_smarty_tpl->getVariable('user')->value->getIdUser()==$_smarty_tpl->getVariable('mandate')->value->getUser()->getIdUser())&&$_smarty_tpl->getVariable('mandate')->value->getEtap()->getIdMandateEtap()==Constant::ID_ETAP_TO_SELL){?>
				<p>
					<a
						href="<?php echo Tools::create_url($_smarty_tpl->getVariable('user')->value,$_GET['module'],'updateDesc',$_GET['action']);?>
">Modifier
						les infos/descriptions</a>
				</p>
				<?php }?>
				<div class="tiers bulle">
					<table>
						<tr>
							<td colspan="2"><h3>Superficie</h3></td>
						</tr>
						<tr>
							<td class="gauche">Superficie parcelle 1</td>
							<td class="droite"><?php if ($_smarty_tpl->getVariable('mandate')->value->getSuperficieParcelle1()==0){?>NC<?php }else{ ?> <?php echo $_smarty_tpl->getVariable('mandate')->value->getSuperficieParcelle1();?>
<?php }?></td>
						</tr>
						<tr>
							<td class="gauche">Superficie parcelle 2</td>
							<td class="droite"><?php if ($_smarty_tpl->getVariable('mandate')->value->getSuperficieParcelle2()==0){?>NC<?php }else{ ?> <?php echo $_smarty_tpl->getVariable('mandate')->value->getSuperficieParcelle2();?>
<?php }?></td>
						</tr>
						<tr>
							<td class="gauche">Superficie parcelle 3</td>
							<td class="droite"><?php if ($_smarty_tpl->getVariable('mandate')->value->getSuperficieParcelle3()==0){?>NC<?php }else{ ?><?php echo $_smarty_tpl->getVariable('mandate')->value->getSuperficieParcelle3();?>
<?php }?></td>
						</tr>
						<tr>
							<td class="gauche">Superficie autres parcelle</td>
							<td class="droite"><?php if ($_smarty_tpl->getVariable('mandate')->value->getSuperficieAutreParcelle()==0){?>NC<?php }else{ ?><?php echo $_smarty_tpl->getVariable('mandate')->value->getSuperficieAutreParcelle();?>
<?php }?></td>
						</tr>
						<tr>
							<td class="gauche">Superficie constructible</td>
							<td class="droite"><?php if ($_smarty_tpl->getVariable('mandate')->value->getSuperficieConstructible()==0){?>NC<?php }else{ ?><?php echo $_smarty_tpl->getVariable('mandate')->value->getSuperficieConstructible();?>
<?php }?></td>
						</tr>
						<tr>
							<td class="gauche">Superficie non constructible</td>
							<td class="droite"><?php if ($_smarty_tpl->getVariable('mandate')->value->getSuperficieNonConstructible()==0){?>NC<?php }else{ ?><?php echo $_smarty_tpl->getVariable('mandate')->value->getSuperficieNonConstructible();?>
<?php }?></td>
						</tr>
						<tr>
							<td class="gauche">Superficie totale</td>
							<td class="droite"><?php if ($_smarty_tpl->getVariable('mandate')->value->getSuperficieTotale()==0){?>NC<?php }else{ ?><?php echo $_smarty_tpl->getVariable('mandate')->value->getSuperficieTotale();?>
<?php }?></td>
						</tr>
						<tr>
							<td class="gauche">géometre</td>
							<td class="droite"><?php if ($_smarty_tpl->getVariable('mandate')->value->getGeometer()){?><?php echo $_smarty_tpl->getVariable('mandate')->value->getGeometer()->getName();?>
<?php }else{ ?>NC<?php }?>
							</td>
						</tr>
						<tr>
							<td class="gauche">Bornage</td>
							<td class="droite"><?php if ($_smarty_tpl->getVariable('mandate')->value->getBornageTerrain()){?><?php echo $_smarty_tpl->getVariable('mandate')->value->getBornageTerrain()->getName();?>
<?php }else{ ?>NC<?php }?></td>
						</tr>
					</table>
				</div>

				<div class="tiers bulle">
					<table>
						<tr>
							<td colspan="2"><h3>Réglementation</h3></td>
						</tr>
						<tr>
							<td class="gauche">Zonage PLU</td>
							<td class="droite"><?php if ($_smarty_tpl->getVariable('mandate')->value->getZonagePlu()){?><?php echo $_smarty_tpl->getVariable('mandate')->value->getZonagePlu()->getName();?>
<?php }else{ ?>NC<?php }?></td>
						</tr>
						<tr>
							<td class="gauche">Zonage RNU</td>
							<td class="droite"><?php if ($_smarty_tpl->getVariable('mandate')->value->getZonageRnu()){?><?php echo $_smarty_tpl->getVariable('mandate')->value->getZonageRnu()->getName();?>
<?php }else{ ?>NC<?php }?></td>
						</tr>
						<tr>
							<td class="gauche">COS</td>
							<td class="droite"><?php if ($_smarty_tpl->getVariable('mandate')->value->getCOS()){?><?php echo $_smarty_tpl->getVariable('mandate')->value->getCOS()->getName();?>
<?php }else{ ?>NC<?php }?></td>
						</tr>
						<tr>
							<td class="gauche">Shon accordée</td>
							<td class="droite"><?php echo $_smarty_tpl->getVariable('mandate')->value->getsHONAccordee();?>
</td>
						</tr>
						<tr>
							<td class="gauche">Zone BDF</td>
							<td class="droite"><?php if ($_smarty_tpl->getVariable('mandate')->value->getZoneBDF()==0){?>NON<?php }else{ ?>OUI<?php }?></td>
						</tr>
						<tr>
							<td class="gauche">Ligne de crete</td>
							<td class="droite"><?php if ($_smarty_tpl->getVariable('mandate')->value->getLigneDeCrete()==0){?>NON<?php }else{ ?>OUI<?php }?></td>
						</tr>
						<tr>
							<td class="gauche">zone inondable</td>
							<td class="droite"><?php if ($_smarty_tpl->getVariable('mandate')->value->getZoneInondable()==0){?>NON<?php }else{ ?>OUI<?php }?></td>
						</tr>
						<tr>
							<td class="gauche">Réglement lotissement</td>
							<td class="droite"><?php if ($_smarty_tpl->getVariable('mandate')->value->getReglementDeLotissement()){?> <br /><?php echo $_smarty_tpl->getVariable('mandate')->value->getReglementDeLotissement();?>
<?php }?>
							</td>
						</tr>
						<tr>
							<td class="gauche">ERNT</td>
							<td class="droite"><?php if ($_smarty_tpl->getVariable('mandate')->value->getERNT()){?><br /><?php echo $_smarty_tpl->getVariable('mandate')->value->getERNT();?>
<?php }?>
							</td>
						</tr>
					</table>
				</div>

				<div class="tiers bulle">
					<table>
						<tr>
							<td colspan="2"><h3>Autorisation</h3></td>
						</tr>
						<tr>
							<td class="gauche">DP valide</td>
							<td class="droite"><?php if ($_smarty_tpl->getVariable('mandate')->value->getDPValide()){?>Oui<?php }else{ ?>Non<?php }?></td>
						</tr>
						<tr>
							<td class="gauche">Date déclaration préalable</td>
							<td class="droite"><?php if ($_smarty_tpl->getVariable('mandate')->value->getDateDeclarationPrealable()){?><?php echo date(Constant::DATE_FORMAT2,$_smarty_tpl->getVariable('mandate')->value->getDateDeclarationPrealable());?>
<?php }else{ ?>NC<?php }?></td>
						</tr>
						<tr>
							<td class="gauche">Prorogation DP jusqu'au</td>
							<td class="droite"><?php if ($_smarty_tpl->getVariable('mandate')->value->getProrogationDPJusquau()){?><?php echo date(Constant::DATE_FORMAT2,$_smarty_tpl->getVariable('mandate')->value->getProrogationDPJusquau());?>
<?php }else{ ?>NC<?php }?></td>
						</tr>
						<tr>
							<td class="gauche">CU valide</td>
							<td class="droite"><?php if ($_smarty_tpl->getVariable('mandate')->value->getCuValide()){?>Oui<?php }else{ ?>Non<?php }?></td>
						</tr>
						<tr>
							<td class="gauche">Date déclaration préalable</td>
							<td class="droite"><?php if ($_smarty_tpl->getVariable('mandate')->value->getDateCu()){?><?php echo date(Constant::DATE_FORMAT2,$_smarty_tpl->getVariable('mandate')->value->getDateCu());?>
<?php }else{ ?>NC<?php }?></td>
						</tr>
						<tr>
							<td class="gauche">Prorogation CU jusqu'au</td>
							<td class="droite"><?php if ($_smarty_tpl->getVariable('mandate')->value->getProrogationCUJusquau()){?><?php echo date(Constant::DATE_FORMAT2,$_smarty_tpl->getVariable('mandate')->value->getProrogationCUJusquau());?>
<?php }else{ ?>NC<?php }?></td>
						</tr>
						<tr>
							<td class="gauche">CU Ops valide</td>
							<td class="droite"><?php if ($_smarty_tpl->getVariable('mandate')->value->getCuOpsValide()){?>Oui<?php }else{ ?>Non<?php }?></td>
						</tr>
						<tr>
							<td class="gauche">Date déclaration préalable</td>
							<td class="droite"><?php if ($_smarty_tpl->getVariable('mandate')->value->getDateCuOps()){?><?php echo date(Constant::DATE_FORMAT2,$_smarty_tpl->getVariable('mandate')->value->getDateCuOps());?>
<?php }else{ ?>NC<?php }?></td>
						</tr>
						<tr>
							<td class="gauche">Prorogation CU Ops jusqu'au</td>
							<td class="droite"><?php if ($_smarty_tpl->getVariable('mandate')->value->getProrogationCUOpsJusquau()){?><?php echo date(Constant::DATE_FORMAT2,$_smarty_tpl->getVariable('mandate')->value->getProrogationCUOpsJusquau());?>
<?php }else{ ?>NC<?php }?></td>
						</tr>
						<tr>
							<td class="gauche">Permis d'amenager valide</td>
							<td class="droite"><?php if ($_smarty_tpl->getVariable('mandate')->value->getPermisDamenagerValide()){?>Oui<?php }else{ ?>Non<?php }?></td>
						</tr>
						<tr>
							<td class="gauche">Date de permis d'amenager</td>
							<td class="droite"><?php if ($_smarty_tpl->getVariable('mandate')->value->getDatePermisDamenager()){?><?php echo date(Constant::DATE_FORMAT2,$_smarty_tpl->getVariable('mandate')->value->getDatePermisDamenager());?>
<?php }else{ ?>NC<?php }?></td>
						</tr>
					</table>
				</div>
				<hr class="invi clear" />
				<div class="tiers bulle">
					<table>
						<tr>
							<td colspan="2"><h3>Viabilisation</h3></td>
						</tr>
						<tr>
							<td class="gauche">Terrain vendu</td>
							<td class="droite"><?php if ($_smarty_tpl->getVariable('mandate')->value->getTerrainVenduViabilise()){?>viabilisé<?php }elseif($_smarty_tpl->getVariable('mandate')->value->getTerrainVenduSemiViabilise()){?>Semi viabilisé<?php }elseif($_smarty_tpl->getVariable('mandate')->value->getTerrainVenduNonViabilise()){?>Non
								viabilisé<?php }else{ ?>NC<?php }?></td>
						</tr>
						<tr>
							<td class="gauche">Passage eau</td>
							<td class="droite"><?php if ($_smarty_tpl->getVariable('mandate')->value->getPassageEau()){?><br /><?php echo $_smarty_tpl->getVariable('mandate')->value->getPassageEau();?>
<?php }?>
							</td>
						</tr>
						<tr>
							<td class="gauche">Correspondant eau</td>
							<td class="droite"><?php if ($_smarty_tpl->getVariable('mandate')->value->getWaterCorresponding()){?><?php echo $_smarty_tpl->getVariable('mandate')->value->getWaterCorresponding()->getName();?>
<?php }else{ ?>NC<?php }?></td>
						</tr>
						<tr>
							<td class="gauche">Passage éléctricité</td>
							<td class="droite"><?php if ($_smarty_tpl->getVariable('mandate')->value->getPassageElectricite()){?><br /><?php echo $_smarty_tpl->getVariable('mandate')->value->getPassageEau();?>
<?php }?>
							</td>
						</tr>
						<tr>
							<td class="gauche">Correspondant electrique</td>
							<td class="droite"><?php if ($_smarty_tpl->getVariable('mandate')->value->getElectricCorresponding()){?><?php echo $_smarty_tpl->getVariable('mandate')->value->getElectricCorresponding()->getName();?>
<?php }else{ ?>NC<?php }?></td>
						</tr>
						<tr>
							<td class="gauche">Passage gaz</td>
							<td class="droite"><?php if ($_smarty_tpl->getVariable('mandate')->value->getPassageGaz()){?><br /><?php echo $_smarty_tpl->getVariable('mandate')->value->getPassageGaz();?>
<?php }?>
							</td>
						</tr>
						<tr>
							<td class="gauche">Correspondant gaz</td>
							<td class="droite"><?php if ($_smarty_tpl->getVariable('mandate')->value->getGazCorresponding()){?><?php echo $_smarty_tpl->getVariable('mandate')->value->getGazCorresponding()->getName();?>
<?php }else{ ?>NC<?php }?></td>
						</tr>

						<tr>
							<td class="gauche">Assainissement</td>
							<td class="droite"><?php if ($_smarty_tpl->getVariable('mandate')->value->getToutALegout()){?>Tout à l'égout
								<?php }elseif($_smarty_tpl->getVariable('mandate')->value->getAssainissementParFosseSceptique()){?>Par fosse
								sceptique<?php }else{ ?>NC<?php }?></td>
						</tr>

						<tr>
							<td class="gauche">Correspondant sanitaire</td>
							<td class="droite"><?php if ($_smarty_tpl->getVariable('mandate')->value->getSanitationCorresponding()){?><?php echo $_smarty_tpl->getVariable('mandate')->value->getSanitationCorresponding()->getName();?>
<?php }else{ ?>NC<?php }?></td>
						</tr>
						<tr>
							<td class="gauche">Voirie</td>
							<td class="droite"><?php if ($_smarty_tpl->getVariable('mandate')->value->getVoirie()){?><br /><?php echo $_smarty_tpl->getVariable('mandate')->value->getVoirie();?>
<?php }?>
							</td>
						</tr>
					</table>
				</div>

				<div class="tiers bulle">
					<table>
						<tr>
							<td colspan="2"><h3>Description</h3></td>
						</tr>
						<tr>
							<td class="gauche">Orientation</td>
							<td class="droite"><?php if ($_smarty_tpl->getVariable('mandate')->value->getOrientation()){?><?php echo $_smarty_tpl->getVariable('mandate')->value->getOrientation()->getName();?>
<?php }else{ ?>NC<?php }?></td>
						</tr>
						<tr>
							<td class="gauche">Pente</td>
							<td class="droite"><?php if ($_smarty_tpl->getVariable('mandate')->value->getSlope()){?><?php echo $_smarty_tpl->getVariable('mandate')->value->getSlope()->getName();?>
<?php }else{ ?>NC<?php }?></td>
						</tr>

						<tr>
							<td class="gauche">Taille de la façade</td>
							<td class="droite"><?php if ($_smarty_tpl->getVariable('mandate')->value->getTailleFacade()){?><?php echo $_smarty_tpl->getVariable('mandate')->value->getTailleFacade();?>
<?php }else{ ?>NC<?php }?></td>
						</tr>
						<tr>
							<td class="gauche">Profondeur du terrain</td>
							<td class="droite"><?php if ($_smarty_tpl->getVariable('mandate')->value->getProfondeurTerrain()){?><?php echo $_smarty_tpl->getVariable('mandate')->value->getProfondeurTerrain();?>
<?php }else{ ?>NC<?php }?></td>
						</tr>

						<?php if ($_smarty_tpl->getVariable('mandate')->value->getCommentaire()){?>
						<tr>
							<td class="gauche">Commentaires</td>
							<td class="droite"><?php echo $_smarty_tpl->getVariable('mandate')->value->getCommentaire();?>
</td>
						</tr>
						<?php }?>

						<tr>
							<td class="gauche">Proximité école</td>
							<td class="droite"><?php if ($_smarty_tpl->getVariable('mandate')->value->getProximiteEcole()==0){?>NC<?php }else{ ?><?php echo $_smarty_tpl->getVariable('mandate')->value->getProximiteEcole();?>
 <?php }?></td>
						</tr>
						<tr>
							<td class="gauche">Proximité commerce</td>
							<td class="droite"><?php if ($_smarty_tpl->getVariable('mandate')->value->getProximiteCommerce()==0){?>NC<?php }else{ ?><?php echo $_smarty_tpl->getVariable('mandate')->value->getProximiteCommerce();?>
 <?php }?></td>
						</tr>
						<tr>
							<td class="gauche">Proximité transport</td>
							<td class="droite"><?php if ($_smarty_tpl->getVariable('mandate')->value->getProximiteTransport()==0){?>NC<?php }else{ ?><?php echo $_smarty_tpl->getVariable('mandate')->value->getProximiteTransport();?>
 <?php }?></td>
						</tr>
					</table>
				</div>
				<div class="tiers bulle">

					<table>
						<tr>
							<td colspan="2"><h3>Cadastre</h3></td>
						</tr>
						<tr>
							<td class="gauche">Ref cadastre parcelle 1</td>
							<td class="droite"><?php echo $_smarty_tpl->getVariable('mandate')->value->getReferenceCadastreParcelle1();?>
</td>
						</tr>
						<tr>
							<td class="gauche">Ref cadastre parcelle 2</td>
							<td class="droite"><?php echo $_smarty_tpl->getVariable('mandate')->value->getReferenceCadastreParcelle2();?>
</td>
						</tr>
						<tr>
							<td class="gauche">Ref cadastre parcelle 3</td>
							<td class="droite"><?php echo $_smarty_tpl->getVariable('mandate')->value->getReferenceCadastreParcelle3();?>
</td>
						</tr>
						<tr>
							<td class="gauche">Autre ref cadastre</td>
							<td class="droite"><?php echo $_smarty_tpl->getVariable('mandate')->value->getAutreReferenceParcelle();?>
</td>
						</tr>
						<tr>
							<td class="gauche">Numéro de lot</td>
							<td class="droite"><?php echo $_smarty_tpl->getVariable('mandate')->value->getNumberLot();?>
</td>
						</tr>
					</table>
				</div>
				<hr class="invi clear" />
			</div>

			<?php $_template = new Smarty_Internal_Template("tpl_default/hook.tpl", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
$_template->assign('position',"hook_see_mandateDescription"); echo $_template->getRenderedTemplate();?><?php $_template->updateParentVariables(0);?><?php unset($_template);?>

			<h3>
				<a href="#">Pub</a>
			</h3>
			<div>
				<?php if (($_smarty_tpl->getVariable('user')->value->getLevelMember()->getIdLevelMember()<3||$_smarty_tpl->getVariable('user')->value->getIdUser()==$_smarty_tpl->getVariable('mandate')->value->getUser()->getIdUser())&&$_smarty_tpl->getVariable('mandate')->value->getEtap()->getIdMandateEtap()==Constant::ID_ETAP_TO_SELL){?>
				<p>
					<a
						href="<?php echo Tools::create_url($_smarty_tpl->getVariable('user')->value,$_GET['module'],'updatePub',$_GET['action']);?>
">Modifier
						les pubs</a>
				</p>
				<?php }?>
				
				
								<div class="mSep">
					<h3>Coup de coeur</h3>
					<p>Coup de coeur : <?php if ($_smarty_tpl->getVariable('mandate')->value->getCoupCoeur()){?>Oui<?php }else{ ?>Non<?php }?></p>
				</div>
				<div class="mSep">
					<h3>Vitrine</h3>
					<p>Affiché en vitrine : <?php if ($_smarty_tpl->getVariable('afficheEnVitrine')->value){?>Oui<?php }else{ ?>Non<?php }?></p>
				</div>
				<hr class="clear invi" />
				
				<div class="bulle">
					<h3>Texte utilisé dans les affiches</h3>
					<?php if ($_smarty_tpl->getVariable('mandate')->value->getCommentaireApparent()==''){?>
					<p>Aucun texte saisi.</p>
					<?php }else{ ?>
					<p><?php echo $_smarty_tpl->getVariable('mandate')->value->getCommentaireApparent();?>
</p>
					<?php }?>
				</div>
				
				
				<div class="bulle">
					<h3>Passerelles utilisées</h3>
					<?php $_template = new Smarty_Internal_Template("tpl_default/hook.tpl", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
$_template->assign('position',"hook_site"); echo $_template->getRenderedTemplate();?><?php $_template->updateParentVariables(0);?><?php unset($_template);?>
				</div>
				
				<div class="bulle">
					<h3>Texte utilisé avec les passerelles.</h3>
					<?php if ($_smarty_tpl->getVariable('mandate')->value->getPubInternet()==''){?>
					<p>Aucun texte saisi.</p>
					<?php }else{ ?>
					<p><?php echo $_smarty_tpl->getVariable('mandate')->value->getPubInternet();?>
</p>
					<?php }?>
				</div>
				<div class="bulle">
					<h3>Photos utilisées avec les passerelles.</h3>
					<?php $_template = new Smarty_Internal_Template("tpl_default/hook.tpl", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
$_template->assign('position',"hook_ExportsList"); echo $_template->getRenderedTemplate();?><?php $_template->updateParentVariables(0);?><?php unset($_template);?>
				</div>
				

			</div>


			<h3>
				<a href="#photos">Photos</a>
			</h3>
			<div>

				<?php if ($_smarty_tpl->getVariable('errorPicture')->value){?>
				<ul>
					<?php  $_smarty_tpl->tpl_vars['e'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('errorPicture')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['e']->key => $_smarty_tpl->tpl_vars['e']->value){
?>
					<li class="error"><?php echo $_smarty_tpl->tpl_vars['e']->value;?>
</li> <?php }} ?>
				</ul>
				<?php }?> <?php if (($_smarty_tpl->getVariable('user')->value->getLevelMember()->getIdLevelMember()<3||$_smarty_tpl->getVariable('user')->value->getIdUser()==$_smarty_tpl->getVariable('mandate')->value->getUser()->getIdUser())&&$_smarty_tpl->getVariable('mandate')->value->getEtap()->getIdMandateEtap()==Constant::ID_ETAP_TO_SELL){?>
				<form
					action="<?php echo Tools::create_url($_smarty_tpl->getVariable('user')->value,$_GET['module'],$_GET['page'],$_smarty_tpl->getVariable('mandate')->value->getIdMandate());?>
"
					method="post" enctype="multipart/form-data">
					<input type="hidden" id="idMandate" name="idMandate"
						value="<?php echo $_smarty_tpl->getVariable('mandate')->value->getIdmandate();?>
" /> <input type="hidden"
						id="idSess" name="idSess" value="<?php echo str_rot13(session_id());?>
" />
					<p class="uploadMultiple">
						<label for="newPicture">Ajouter une photo : <input type="file"
							name="newPicture" id="newPicture" /> </label> <label
							for="isDefaultPicture">Image par defaut ?<input type="checkbox"
							name="isDefaultPicture" id="isDefaultPicture" /> </label> <input
							type="submit" value="Envoyer" id="sendPictureForMandate"
							name="sendPictureForMandate" />
					</p>
				</form>
				<?php }?>

				<div id="listVignettes">


					<?php  $_smarty_tpl->tpl_vars['item'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('mandate')->value->listPictures(); if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['item']->key => $_smarty_tpl->tpl_vars['item']->value){
?>
					<div>

						<img
							src="<?php echo Constant::DEFAULT_URL_PICTURE_MODULE_DIRECTORY;?>
/<?php echo $_GET['module'];?>
/thumb/<?php echo $_smarty_tpl->getVariable('item')->value->getName();?>
"
							rel="<?php echo $_smarty_tpl->getVariable('item')->value->getIdMandatePicture();?>
" alt="" /> <?php if ($_smarty_tpl->getVariable('item')->value->getIsDefault()){?>
						<p class="jsNone">Image principale</p>
						<?php }else{ ?> <?php if ($_smarty_tpl->getVariable('user')->value->getLevelMember()->getIdLevelMember()<3||$_smarty_tpl->getVariable('user')->value->getIdUser()==$_smarty_tpl->getVariable('mandate')->value->getUser()->getIdUser()){?>
						<form class="jsNone" action="" method="post">
							<p>
								<input type="hidden" name="idMandate"
									value="<?php echo $_smarty_tpl->getVariable('mandate')->value->getIdMandate();?>
" /> <input type="hidden"
									name="idPicture" value="<?php echo $_smarty_tpl->getVariable('item')->value->getIdMandatePicture();?>
" /> <input
									type="submit" name="sendPictureByDefault"
									value="Définir comme principale" />
							</p>
						</form>
						<?php }?> <?php }?>
						<p><?php if (($_smarty_tpl->getVariable('user')->value->getLevelMember()->getIdLevelMember()<3||$_smarty_tpl->getVariable('user')->value->getIdUser()==$_smarty_tpl->getVariable('mandate')->value->getUser()->getIdUser())&&$_smarty_tpl->getVariable('mandate')->value->getEtap()->getIdMandateEtap()==Constant::ID_ETAP_TO_SELL){?></p>
						<form action="" class="jsNone" method="post">
							<p>
								<input type="hidden" name="idMandate"
									value="<?php echo $_smarty_tpl->getVariable('mandate')->value->getIdMandate();?>
" /> <input type="hidden"
									name="idPicture" value="<?php echo $_smarty_tpl->getVariable('item')->value->getIdMandatePicture();?>
" /> <input
									type="submit" value="Supprimer l'image" name="delete_picture" />
							</p>
						</form>
						<?php }else{ ?> - <?php }?>

					</div>
					<hr class="jsNone" />
					<?php }} ?>


				</div>
				<div class="quatreVingt" id="contentBigPicture">
					 <?php if ($_smarty_tpl->getVariable('mandate')->value->getPictureByDefault()){?> <img
						src="<?php echo Constant::DEFAULT_URL_PICTURE_MODULE_DIRECTORY;?>
/<?php echo $_GET['module'];?>
/<?php echo $_smarty_tpl->getVariable('mandate')->value->getPictureByDefault()->getName();?>
"
						alt="" id="grdF" /> <?php $_smarty_tpl->tpl_vars["item"] = new Smarty_variable($_smarty_tpl->getVariable('mandate')->value->getPictureByDefault(), null, null);?> <?php if ($_smarty_tpl->getVariable('item')->value->getIsDefault()){?>
					<p class="jsIndic">Image principale</p>
					<?php }else{ ?> <?php if ($_smarty_tpl->getVariable('user')->value->getLevelMember()->getIdLevelMember()<3||$_smarty_tpl->getVariable('user')->value->getIdUser()==$_smarty_tpl->getVariable('mandate')->value->getUser()->getIdUser()){?>
					<form action="" method="post" class="jsIndic">
						<p>
							<input type="hidden" name="idMandate"
								value="<?php echo $_smarty_tpl->getVariable('mandate')->value->getIdMandate();?>
" /> <input type="hidden"
								name="idPicture" value="<?php echo $_smarty_tpl->getVariable('item')->value->getIdMandatePicture();?>
" /> <input
								type="submit" name="sendPictureByDefault"
								value="Définir comme principale" />
						</p>
					</form>
					<?php }?> <?php }?>
					<p><?php if (($_smarty_tpl->getVariable('user')->value->getLevelMember()->getIdLevelMember()<3||$_smarty_tpl->getVariable('user')->value->getIdUser()==$_smarty_tpl->getVariable('mandate')->value->getUser()->getIdUser())&&$_smarty_tpl->getVariable('mandate')->value->getEtap()->getIdMandateEtap()==Constant::ID_ETAP_TO_SELL){?></p>
					<form action="" method="post" class="jsIndic">
						<p>
							<input type="hidden" name="idMandate"
								value="<?php echo $_smarty_tpl->getVariable('mandate')->value->getIdMandate();?>
" /> <input type="hidden"
								name="idPicture" value="<?php echo $_smarty_tpl->getVariable('item')->value->getIdMandatePicture();?>
" /> <input
								type="submit" value="Supprimer l'image" name="delete_picture" />
						</p>
					</form>
					<?php }else{ ?> - <?php }?> <?php }?>
				</div>
			</div>
		</div>
		<!--  Fin accordion -->
	</div>
	<div id="vendeur">
		<?php if (($_smarty_tpl->getVariable('user')->value->getLevelMember()->getIdLevelMember()<3||$_smarty_tpl->getVariable('user')->value->getIdUser()==$_smarty_tpl->getVariable('mandate')->value->getUser()->getIdUser())&&$_smarty_tpl->getVariable('mandate')->value->getEtap()->getIdMandateEtap()==Constant::ID_ETAP_TO_SELL){?>
		<p>
			<a
				href="<?php echo Tools::create_url($_smarty_tpl->getVariable('user')->value,$_GET['module'],'add_new_seller_for_mandate',$_smarty_tpl->getVariable('mandate')->value->getIdMandate());?>
">Affecter
				un autre vendeur</a>
		</p>
		<?php }?>

		<table class="standard">
			<thead>
				<tr>
					<th>Nom</th>
					<th>Adresse</th>
					<th>Coordonnées</th>
					<th>Principal</th>
					<th>Voir la fiche</th>
					<th>Supprimer l'affectation</th>
				</tr>
			</thead>
			<tbody>
				<?php  $_smarty_tpl->tpl_vars['item'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('mandate')->value->listSellers(); if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['item']->key => $_smarty_tpl->tpl_vars['item']->value){
?>
				<tr>
					<td><?php echo $_smarty_tpl->getVariable('item')->value->getName();?>
 <?php echo $_smarty_tpl->getVariable('item')->value->getFirstname();?>
</td>
					<td>
						<p><?php if ($_smarty_tpl->getVariable('item')->value->getCity()){?> <?php if ($_smarty_tpl->getVariable('item')->value->getCity()->getSector()){?>
							<?php echo $_smarty_tpl->getVariable('item')->value->getCity()->getSector()->getName();?>
 <?php }?> <?php }?></p>
						<p><?php echo $_smarty_tpl->getVariable('item')->value->getAddress();?>
</p>

						<p><?php if ($_smarty_tpl->getVariable('item')->value->getCity()){?> <?php echo $_smarty_tpl->getVariable('item')->value->getCity()->getZipCode();?>

							<?php echo $_smarty_tpl->getVariable('item')->value->getCity()->getName();?>
 <?php }?></p>
					</td>
					<td><?php if ($_smarty_tpl->getVariable('item')->value->getPhone()){?>
						<p>Téléphone : <?php echo $_smarty_tpl->getVariable('item')->value->getPhone();?>
</p><?php }?> <?php if ($_smarty_tpl->getVariable('item')->value->getMobilPhone()){?>
						<p>Téléphone portable: <?php echo $_smarty_tpl->getVariable('item')->value->getMobilPhone();?>
</p><?php }?> <?php if ($_smarty_tpl->getVariable('item')->value->getWorkPhone()){?>
						<p>Téléphone travail: <?php echo $_smarty_tpl->getVariable('item')->value->getWorkPhone();?>
</p><?php }?> <?php if ($_smarty_tpl->getVariable('item')->value->getFax()){?>
						<p>Fax : <?php echo $_smarty_tpl->getVariable('item')->value->getFax();?>
</p><?php }?> <?php if ($_smarty_tpl->getVariable('item')->value->getEmail()){?>
						<p>Email : <?php echo $_smarty_tpl->getVariable('item')->value->getEmail();?>
</p><?php }?></td>
					<td><?php if ($_smarty_tpl->getVariable('item')->value->getIsDefault()){?>OUI<?php }else{ ?>NON <?php if ($_smarty_tpl->getVariable('user')->value->getLevelMember()->getIdLevelMember()<3||$_smarty_tpl->getVariable('user')->value->getIdUser()==$_smarty_tpl->getVariable('mandate')->value->getUser()->getIdUser()){?>
						<form action="" method="post">
							<p>
								<input type="hidden" name="idMandate"
									value="<?php echo $_smarty_tpl->getVariable('mandate')->value->getIdMandate();?>
" /> <input type="hidden"
									name="idSeller" value="<?php echo $_smarty_tpl->getVariable('item')->value->getIdSeller();?>
" /> <input
									type="submit" name="sendSellerByDefault"
									value="Définir comme principal" />
							</p>
						</form> <?php }?> <?php }?></td>
					<td><a
						href="<?php echo Tools::create_url($_smarty_tpl->getVariable('user')->value,'seller','sees',$_smarty_tpl->getVariable('item')->value->getIdSeller());?>
" title="<?php echo Lang::LABEL_SEE;?>
"><img src="<?php echo Constant::DEFAULT_URL_PICTURE_DIRECTORY;?>
see.png" alt="<?php echo Lang::LABEL_SEE;?>
" /></a>
					</td>
					<td><?php if ($_smarty_tpl->getVariable('user')->value->getLevelMember()->getIdLevelMember()<3||$_smarty_tpl->getVariable('user')->value->getIdUser()==$_smarty_tpl->getVariable('mandate')->value->getUser()->getIdUser()){?>
						<form action="" method="post">
							<p>
								<input type="hidden" name="idMandate"
									value="<?php echo $_smarty_tpl->getVariable('mandate')->value->getIdMandate();?>
" /> <input type="hidden"
									name="idSeller" value="<?php echo $_smarty_tpl->getVariable('item')->value->getIdSeller();?>
" /> <input
									type="submit" value="Supprimer l'affectation"
									name="delete_affectation_seller" />
							</p>
						</form> <?php }else{ ?> - <?php }?></td>
				</tr>
				<?php }} ?>

			</tbody>
		</table>
		<hr class="invi clear" />
	</div>
	<div id="plans">
	<?php if ($_smarty_tpl->getVariable('errorPlan')->value){?>
					
				<ul class="contError">
					<?php  $_smarty_tpl->tpl_vars['e'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('errorPlan')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['e']->key => $_smarty_tpl->tpl_vars['e']->value){
?>
					<li><?php echo $_smarty_tpl->tpl_vars['e']->value;?>
</li> <?php }} ?>
				</ul>
				<?php }?>
		<?php if (($_smarty_tpl->getVariable('user')->value->getLevelMember()->getIdLevelMember()<3||$_smarty_tpl->getVariable('user')->value->getIdUser()==$_smarty_tpl->getVariable('mandate')->value->getUser()->getIdUser())&&$_smarty_tpl->getVariable('mandate')->value->getEtap()->getIdMandateEtap()==Constant::ID_ETAP_TO_SELL){?>
		<form
			action="<?php echo Tools::create_url($_smarty_tpl->getVariable('user')->value,$_GET['module'],$_GET['page'],$_smarty_tpl->getVariable('mandate')->value->getIdMandate());?>
"
			method="post" enctype="multipart/form-data">
			<p>
				<label for="newPlan">Ajouter un plan : <input type="file"
					name="newPlan" id="newPlan" /> </label> <input type="submit"
					value="Envoyer" id="sendPlanForMandate" name="sendPlanForMandate" />
			</p>
		</form>
		<?php }?>
		<table class="standard">
			<thead>
				<tr>
					<th>Aperçu</th>
					<th>Lien</th>
					<th>Supprimer</th>
				</tr>
			</thead>
			<tbody>
				<?php  $_smarty_tpl->tpl_vars['item'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('mandate')->value->listPlan(); if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['item']->key => $_smarty_tpl->tpl_vars['item']->value){
?>
				<tr>
					<td><img src="<?php if (!strpos($_smarty_tpl->getVariable('item')->value->getName(),'.pdf')){?> <?php echo Constant::DEFAULT_URL_PICTURE_MODULE_DIRECTORY;?>
/<?php echo $_GET['module'];?>
/thumb/<?php echo $_smarty_tpl->getVariable('item')->value->getName();?>
<?php }else{ ?><?php echo Constant::DEFAULT_URL_PICTURE_DIRECTORY;?>
logoPdf.png<?php }?>" alt="" /></td>
					<td><a
						href="<?php echo Constant::DEFAULT_URL_PICTURE_MODULE_DIRECTORY;?>
/<?php echo $_GET['module'];?>
/<?php echo $_smarty_tpl->getVariable('item')->value->getName();?>
"
						target="_blank">Télécharger ( <?php echo $_smarty_tpl->getVariable('item')->value->getCode();?>
 )</a></td>
					<td><?php if ($_smarty_tpl->getVariable('user')->value->getLevelMember()->getIdLevelMember()<3||$_smarty_tpl->getVariable('user')->value->getIdUser()==$_smarty_tpl->getVariable('mandate')->value->getUser()->getIdUser()){?>
						<form action="" method="post">
							<p>
								<input type="hidden" name="idMandate"
									value="<?php echo $_smarty_tpl->getVariable('mandate')->value->getIdMandate();?>
" /> <input type="hidden"
									name="idPlan" value="<?php echo $_smarty_tpl->getVariable('item')->value->getIdMandateScan();?>
" /> <input
									type="submit" value="Supprimer le plan" name="delete_plan" />
							</p>
						</form> <?php }else{ ?> - <?php }?></td>
				</tr>
				<?php }} ?>
			</tbody>
		</table>
	</div>
	<div id="fichiers"><?php $_template = new Smarty_Internal_Template("tpl_default/hook.tpl", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
$_template->assign('position',"hook_files"); echo $_template->getRenderedTemplate();?><?php $_template->updateParentVariables(0);?><?php unset($_template);?></div>
	<div id="impressions"><?php $_template = new Smarty_Internal_Template("tpl_default/hook.tpl", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
$_template->assign('position',"hook_imp"); echo $_template->getRenderedTemplate();?><?php $_template->updateParentVariables(0);?><?php unset($_template);?></div>
	<?php $_template = new Smarty_Internal_Template("tpl_default/hook.tpl", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
$_template->assign('position',"hook_acq"); echo $_template->getRenderedTemplate();?><?php $_template->updateParentVariables(0);?><?php unset($_template);?>
</div>
<!--  fin tabs -->



<!-- 
	<div id="tabs">
	<ul>
		<li><a href="#tabs-2">Localisation</a></li>
		<li><a href="#tabs-1">Général</a></li>
		<li><a href="#tabs-3">Prix</a></li>
		<li><a href="#tabs-4">Superficie</a></li>
		<li><a href="#tabs-5">Réglementation</a></li>
		<li><a href="#tabs-6">Autorisation</a></li>
		<li><a href="#tabs-7">Viabilisation</a></li>
		<li><a href="#tabs-8">Description</a></li>
		<li><a href="#tabs-9">Cadastre</a></li>
	</ul>
	
<div id="tabs-2">
	<div class="mSep">
<p>Secteur : <?php echo $_smarty_tpl->getVariable('mandate')->value->getCity()->getSector()->getName();?>
</p>
<p>Adresse : <?php echo $_smarty_tpl->getVariable('mandate')->value->getAddress();?>
</p>
<p>Ville : <?php echo $_smarty_tpl->getVariable('mandate')->value->getCity()->getName();?>
</p>
<p>Code Postal : <?php echo $_smarty_tpl->getVariable('mandate')->value->getCity()->getZipCode();?>
</p>
<?php if ($_smarty_tpl->getVariable('mandate')->value->getGeolocalisation()){?>
	<?php $_smarty_tpl->tpl_vars["geo"] = new Smarty_variable(explode(',',$_smarty_tpl->getVariable('mandate')->value->getGeolocalisation()), null, null);?>
<p>Latitude : <span id="latitude"><?php echo $_smarty_tpl->getVariable('geo')->value[0];?>
</span> </p>
<p>Longitude : <span id="longitude"><?php echo $_smarty_tpl->getVariable('geo')->value[1];?>
</span></p>
	<?php }?>
</div>

<?php if ($_smarty_tpl->getVariable('mandate')->value->getGeolocalisation()){?>
	<div class="mSep">
	<p>Geoloc : </p>
	
	<div id="map">
	</div>

</div>

	<?php }?>
<hr class="invi clear" />
</div>
<div id="tabs-1">
<p>Utilisateur affecté : <?php echo $_smarty_tpl->getVariable('mandate')->value->getUser()->getName();?>
 <?php echo $_smarty_tpl->getVariable('mandate')->value->getUser()->getFirstname();?>
</p>
<p>Nature du bien : <?php if ($_smarty_tpl->getVariable('mandate')->value->getNature()==null){?>NC<?php }else{ ?><?php echo $_smarty_tpl->getVariable('mandate')->value->getNature()->getName();?>
<?php }?></p>
<p>Notaire : <?php echo $_smarty_tpl->getVariable('mandate')->value->getNotary()->getName();?>
</p>
<p>N° Mandat : <?php echo $_smarty_tpl->getVariable('mandate')->value->getNumberMandate();?>
</p>
<p>Début : <?php echo date(Constant::DATE_FORMAT2,$_smarty_tpl->getVariable('mandate')->value->getInitDate());?>
</p>
<p>Fin : <?php if (date(Constant::DATE_FORMAT2,$_smarty_tpl->getVariable('mandate')->value->getDeadDate())=='01/01/1970'){?> NC <?php }else{ ?><?php echo date(Constant::DATE_FORMAT2,$_smarty_tpl->getVariable('mandate')->value->getDeadDate());?>
<?php }?></p>
<p>libre le : <?php if ($_smarty_tpl->getVariable('mandate')->value->getFreeDate()==null){?> NC <?php }else{ ?><?php echo date(Constant::DATE_FORMAT2,$_smarty_tpl->getVariable('mandate')->value->getFreeDate());?>
<?php }?></p>
</div>

<div id="tabs-3">
	
<p>Prix FAI : <?php echo Tools::grosNombre(round($_smarty_tpl->getVariable('mandate')->value->getPriceFAI(),0));?>
 &euro;</p>
<p>Prix net vendeur : <?php echo Tools::grosNombre(round($_smarty_tpl->getVariable('mandate')->value->getPriceSeller(),0));?>
 &euro;</p>
<p>Commission : <?php echo Tools::grosNombre(round($_smarty_tpl->getVariable('mandate')->value->getCommission(),0));?>
 &euro;</p>
<p>Estimation FAI : <?php echo Tools::grosNombre(round($_smarty_tpl->getVariable('mandate')->value->getEstimationFai(),0));?>
 &euro;</p>
<p>Marge negoce : <?php echo Tools::grosNombre(round($_smarty_tpl->getVariable('mandate')->value->getMargeNegociation(),0));?>
 &euro;</p>
</div>
<div id="tabs-4">
			<p>Superficie parcelle 1 :<?php if ($_smarty_tpl->getVariable('mandate')->value->getSuperficieParcelle1()==0){?>NC<?php }else{ ?> <?php echo $_smarty_tpl->getVariable('mandate')->value->getSuperficieParcelle1();?>
<?php }?></p>
			<p>Superficie parcelle 2 :<?php if ($_smarty_tpl->getVariable('mandate')->value->getSuperficieParcelle2()==0){?>NC<?php }else{ ?> <?php echo $_smarty_tpl->getVariable('mandate')->value->getSuperficieParcelle2();?>
<?php }?></p>
			<p>Superficie parcelle 3 : <?php if ($_smarty_tpl->getVariable('mandate')->value->getSuperficieParcelle3()==0){?>NC<?php }else{ ?><?php echo $_smarty_tpl->getVariable('mandate')->value->getSuperficieParcelle3();?>
<?php }?></p>
			<p>Superficie autres parcelle : <?php if ($_smarty_tpl->getVariable('mandate')->value->getSuperficieAutreParcelle()==0){?>NC<?php }else{ ?><?php echo $_smarty_tpl->getVariable('mandate')->value->getSuperficieAutreParcelle();?>
<?php }?></p>
			<p>Superficie constructible : <?php if ($_smarty_tpl->getVariable('mandate')->value->getSuperficieConstructible()==0){?>NC<?php }else{ ?><?php echo $_smarty_tpl->getVariable('mandate')->value->getSuperficieConstructible();?>
<?php }?>  </p>
			<p>Superficie non constructible :  <?php if ($_smarty_tpl->getVariable('mandate')->value->getSuperficieNonConstructible()==0){?>NC<?php }else{ ?><?php echo $_smarty_tpl->getVariable('mandate')->value->getSuperficieNonConstructible();?>
<?php }?></p>
			<p>Superficie totale : <?php if ($_smarty_tpl->getVariable('mandate')->value->getSuperficieTotale()==0){?>NC<?php }else{ ?><?php echo $_smarty_tpl->getVariable('mandate')->value->getSuperficieTotale();?>
<?php }?></p>
			<p>géometre : <?php if ($_smarty_tpl->getVariable('mandate')->value->getGeometer()){?><?php echo $_smarty_tpl->getVariable('mandate')->value->getGeometer()->getName();?>
<?php }else{ ?>NC<?php }?> </p>
			<p>Bornage : <?php if ($_smarty_tpl->getVariable('mandate')->value->getBornageTerrain()){?><?php echo $_smarty_tpl->getVariable('mandate')->value->getBornageTerrain()->getName();?>
<?php }else{ ?>NC<?php }?></p>
</div>
		<div id="tabs-5">
			<p>Zonage PLU : <?php if ($_smarty_tpl->getVariable('mandate')->value->getZonagePlu()){?><?php echo $_smarty_tpl->getVariable('mandate')->value->getZonagePlu()->getName();?>
<?php }else{ ?>NC<?php }?></p>
			<p>Zonage RNU : <?php if ($_smarty_tpl->getVariable('mandate')->value->getZonageRnu()){?><?php echo $_smarty_tpl->getVariable('mandate')->value->getZonageRnu()->getName();?>
<?php }else{ ?>NC<?php }?></p> 
			<p>COS : <?php if ($_smarty_tpl->getVariable('mandate')->value->getCOS()){?><?php echo $_smarty_tpl->getVariable('mandate')->value->getCOS()->getName();?>
<?php }else{ ?>NC<?php }?></p>
			<p>Shon accordée : <?php echo $_smarty_tpl->getVariable('mandate')->value->getsHONAccordee();?>
   </p>
			<p>Zone BDF : <?php if ($_smarty_tpl->getVariable('mandate')->value->getZoneBDF()==0){?>NON<?php }else{ ?>OUI<?php }?></p>
			<p>Ligne de crete : <?php if ($_smarty_tpl->getVariable('mandate')->value->getLigneDeCrete()==0){?>NON<?php }else{ ?>OUI<?php }?></p>
			<p>zone inondable : <?php if ($_smarty_tpl->getVariable('mandate')->value->getZoneInondable()==0){?>NON<?php }else{ ?>OUI<?php }?></p>
			<p>Réglement lotissement : <?php if ($_smarty_tpl->getVariable('mandate')->value->getReglementDeLotissement()){?> <br/><?php echo $_smarty_tpl->getVariable('mandate')->value->getReglementDeLotissement();?>
<?php }?></p>
			<p>ERNT : <?php if ($_smarty_tpl->getVariable('mandate')->value->getERNT()){?><br/><?php echo $_smarty_tpl->getVariable('mandate')->value->getERNT();?>
<?php }?></p>
			</div>
		<div id="tabs-6">
			<p>DP valide :  <?php if ($_smarty_tpl->getVariable('mandate')->value->getDPValide()){?>Oui<?php }else{ ?>Non<?php }?></p>
			<p>Date déclaration préalable : <?php if ($_smarty_tpl->getVariable('mandate')->value->getDateDeclarationPrealable()){?><?php echo date(Constant::DATE_FORMAT2,$_smarty_tpl->getVariable('mandate')->value->getDateDeclarationPrealable());?>
<?php }else{ ?>NC<?php }?></p>
			<p>Prorogation DP jusqu'au :<?php if ($_smarty_tpl->getVariable('mandate')->value->getProrogationDPJusquau()){?><?php echo date(Constant::DATE_FORMAT2,$_smarty_tpl->getVariable('mandate')->value->getProrogationDPJusquau());?>
<?php }else{ ?>NC<?php }?></p>
			<p>CU valide :  <?php if ($_smarty_tpl->getVariable('mandate')->value->getCuValide()){?>Oui<?php }else{ ?>Non<?php }?></p>
			<p>Date déclaration préalable :  <?php if ($_smarty_tpl->getVariable('mandate')->value->getDateCu()){?><?php echo date(Constant::DATE_FORMAT2,$_smarty_tpl->getVariable('mandate')->value->getDateCu());?>
<?php }else{ ?>NC<?php }?></p>
			<p>Prorogation CU jusqu'au : <?php if ($_smarty_tpl->getVariable('mandate')->value->getProrogationCUJusquau()){?><?php echo date(Constant::DATE_FORMAT2,$_smarty_tpl->getVariable('mandate')->value->getProrogationCUJusquau());?>
<?php }else{ ?>NC<?php }?></p>
			<p>CU Ops valide : <?php if ($_smarty_tpl->getVariable('mandate')->value->getCuOpsValide()){?>Oui<?php }else{ ?>Non<?php }?></p>
			<p>Date déclaration préalable : <?php if ($_smarty_tpl->getVariable('mandate')->value->getDateCuOps()){?><?php echo date(Constant::DATE_FORMAT2,$_smarty_tpl->getVariable('mandate')->value->getDateCuOps());?>
<?php }else{ ?>NC<?php }?></p>
			<p>Prorogation CU Ops jusqu'au : <?php if ($_smarty_tpl->getVariable('mandate')->value->getProrogationCUOpsJusquau()){?><?php echo date(Constant::DATE_FORMAT2,$_smarty_tpl->getVariable('mandate')->value->getProrogationCUOpsJusquau());?>
<?php }else{ ?>NC<?php }?></p>
			<p>Permis d'amenager valide : <?php if ($_smarty_tpl->getVariable('mandate')->value->getPermisDamenagerValide()){?>Oui<?php }else{ ?>Non<?php }?></p>
			<p>Date de permis d'amenager : <?php if ($_smarty_tpl->getVariable('mandate')->value->getDatePermisDamenager()){?><?php echo date(Constant::DATE_FORMAT2,$_smarty_tpl->getVariable('mandate')->value->getDatePermisDamenager());?>
<?php }else{ ?>NC<?php }?></p>
			</div>
		<div id="tabs-7">
			<p>Terrain vendu viabilisé : <?php if ($_smarty_tpl->getVariable('mandate')->value->getTerrainVenduViabilise()){?>Oui<?php }else{ ?>Non<?php }?></p>
			<p>Terrain vendu semi viabilisé : <?php if ($_smarty_tpl->getVariable('mandate')->value->getTerrainVenduSemiViabilise()){?>Oui<?php }else{ ?>Non<?php }?></p>
			<p>Terrain vendu non viabilisé :   <?php if ($_smarty_tpl->getVariable('mandate')->value->getTerrainVenduNonViabilise()){?>Oui<?php }else{ ?>Non<?php }?></p>
			<p>Passage eau : <?php if ($_smarty_tpl->getVariable('mandate')->value->getPassageEau()){?><br/><?php echo $_smarty_tpl->getVariable('mandate')->value->getPassageEau();?>
<?php }?></p>
			<p>Correspondant eau : <?php if ($_smarty_tpl->getVariable('mandate')->value->getWaterCorresponding()){?><?php echo $_smarty_tpl->getVariable('mandate')->value->getWaterCorresponding()->getName();?>
<?php }else{ ?>NC<?php }?></p>
			<p>Passage éléctricité : <?php if ($_smarty_tpl->getVariable('mandate')->value->getPassageElectricite()){?><br/><?php echo $_smarty_tpl->getVariable('mandate')->value->getPassageEau();?>
<?php }?></p>
			<p>Correspondant electrique : <?php if ($_smarty_tpl->getVariable('mandate')->value->getElectricCorresponding()){?><?php echo $_smarty_tpl->getVariable('mandate')->value->getElectricCorresponding()->getName();?>
<?php }else{ ?>NC<?php }?></p>
			<p>Passage gaz : <?php if ($_smarty_tpl->getVariable('mandate')->value->getPassageGaz()){?><br/><?php echo $_smarty_tpl->getVariable('mandate')->value->getPassageGaz();?>
<?php }?></p>
			<p>Correspondant gaz :  <?php if ($_smarty_tpl->getVariable('mandate')->value->getGazCorresponding()){?><?php echo $_smarty_tpl->getVariable('mandate')->value->getGazCorresponding()->getName();?>
<?php }else{ ?>NC<?php }?></p>
			<p>Tout à l'égout :  <?php if ($_smarty_tpl->getVariable('mandate')->value->getToutALegout()){?>Oui<?php }else{ ?>Non<?php }?></p>
			<p>Assainissement par fosse sceptique : <?php if ($_smarty_tpl->getVariable('mandate')->value->getAssainissementParFosseSceptique()){?>Oui<?php }else{ ?>Non<?php }?></p> 
			<p>Correspondant sanitaire :   <?php if ($_smarty_tpl->getVariable('mandate')->value->getSanitationCorresponding()){?><?php echo $_smarty_tpl->getVariable('mandate')->value->getSanitationCorresponding()->getName();?>
<?php }else{ ?>NC<?php }?></p>
			<p>Voirie :  <?php if ($_smarty_tpl->getVariable('mandate')->value->getVoirie()){?><br/><?php echo $_smarty_tpl->getVariable('mandate')->value->getVoirie();?>
<?php }?></p>
				</div>
		<div id="tabs-8">
			<p>Orientation : <?php if ($_smarty_tpl->getVariable('mandate')->value->getOrientation()){?><?php echo $_smarty_tpl->getVariable('mandate')->value->getOrientation()->getName();?>
<?php }else{ ?>NC<?php }?></p> 
			<p>Pente :  <?php if ($_smarty_tpl->getVariable('mandate')->value->getSlope()){?><?php echo $_smarty_tpl->getVariable('mandate')->value->getSlope()->getName();?>
<?php }else{ ?>NC<?php }?></p>
			
	<p>Taille de la façade : <?php if ($_smarty_tpl->getVariable('mandate')->value->getTailleFacade()){?><?php echo $_smarty_tpl->getVariable('mandate')->value->getTailleFacade();?>
<?php }else{ ?>NC<?php }?></p>
	<p>Profondeur du terrain : <?php if ($_smarty_tpl->getVariable('mandate')->value->getProfondeurTerrain()){?><?php echo $_smarty_tpl->getVariable('mandate')->value->getProfondeurTerrain();?>
<?php }else{ ?>NC<?php }?></p>
	
	<?php if ($_smarty_tpl->getVariable('mandate')->value->getCommentaire()){?><p>Commentaires : <br/><?php echo $_smarty_tpl->getVariable('mandate')->value->getCommentaire();?>
</p><?php }?>
	
	<p>Proximité école : <?php if ($_smarty_tpl->getVariable('mandate')->value->getProximiteEcole()==0){?>NC<?php }else{ ?><?php echo $_smarty_tpl->getVariable('mandate')->value->getProximiteEcole();?>
 <?php }?></p>
	<p>Proximité commerce : <?php if ($_smarty_tpl->getVariable('mandate')->value->getProximiteCommerce()==0){?>NC<?php }else{ ?><?php echo $_smarty_tpl->getVariable('mandate')->value->getProximiteCommerce();?>
 <?php }?></p>
	<p>Proximité transport :<?php if ($_smarty_tpl->getVariable('mandate')->value->getProximiteTransport()==0){?>NC<?php }else{ ?><?php echo $_smarty_tpl->getVariable('mandate')->value->getProximiteTransport();?>
 <?php }?></p>
	<?php if ($_smarty_tpl->getVariable('mandate')->value->getCommentaireApparent()){?><p>Texte vitrine (et Internet)  : <?php echo $_smarty_tpl->getVariable('mandate')->value->getCommentaireApparent();?>
</p><?php }?>
	</div>
	<div id="tabs-9">	
		<p>Ref cadastre parcelle 1 : <?php echo $_smarty_tpl->getVariable('mandate')->value->getReferenceCadastreParcelle1();?>
</p>
		<p>Ref cadastre parcelle 2 : <?php echo $_smarty_tpl->getVariable('mandate')->value->getReferenceCadastreParcelle2();?>
 </p>
		<p>Ref cadastre parcelle 3 : <?php echo $_smarty_tpl->getVariable('mandate')->value->getReferenceCadastreParcelle3();?>
 </p>
		<p>Autre ref cadastre :  <?php echo $_smarty_tpl->getVariable('mandate')->value->getAutreReferenceParcelle();?>
</p>
		<p>Numéro de lot : <?php echo $_smarty_tpl->getVariable('mandate')->value->getNumberLot();?>
</p>
	</div>
	
</div>
<h1>Vendeurs : </h1>
<?php if (($_smarty_tpl->getVariable('user')->value->getLevelMember()->getIdLevelMember()<3||$_smarty_tpl->getVariable('user')->value->getIdUser()==$_smarty_tpl->getVariable('mandate')->value->getUser()->getIdUser())&&$_smarty_tpl->getVariable('mandate')->value->getEtap()->getIdMandateEtap()==Constant::ID_ETAP_TO_SELL){?>
	<p><a href="<?php echo Tools::create_url($_smarty_tpl->getVariable('user')->value,$_GET['module'],'add_new_seller_for_mandate',$_smarty_tpl->getVariable('mandate')->value->getIdMandate());?>
">Affecter un autre vendeur</a></p>
	<?php }?>

<table class="standard">
	<thead>
		<tr>
			<th>Nom</th>
			<th>Adresse</th>
			<th>Coordonnées</th>
			<th>Principal</th>
			<th>Supprimer l'affectation</th>
		</tr>
	</thead>
	<tbody>
		<?php  $_smarty_tpl->tpl_vars['item'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('mandate')->value->listSellers(); if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['item']->key => $_smarty_tpl->tpl_vars['item']->value){
?>
			<tr>
				<td><?php echo $_smarty_tpl->getVariable('item')->value->getName();?>
 <?php echo $_smarty_tpl->getVariable('item')->value->getFirstname();?>
</td>
				<td>
					<p><?php if ($_smarty_tpl->getVariable('item')->value->getCity()){?>
						<?php if ($_smarty_tpl->getVariable('item')->value->getCity()->getSector()){?>
						<?php echo $_smarty_tpl->getVariable('item')->value->getCity()->getSector()->getName();?>

						<?php }?>
						<?php }?>
						</p>
					<p><?php echo $_smarty_tpl->getVariable('item')->value->getAddress();?>
</p>
					
					<p>
						<?php if ($_smarty_tpl->getVariable('item')->value->getCity()){?>
						<?php echo $_smarty_tpl->getVariable('item')->value->getCity()->getZipCode();?>
 <?php echo $_smarty_tpl->getVariable('item')->value->getCity()->getName();?>

						<?php }?>
						</p>
					</td>
				<td>
					<?php if ($_smarty_tpl->getVariable('item')->value->getPhone()){?><p>Téléphone : <?php echo $_smarty_tpl->getVariable('item')->value->getPhone();?>
</p><?php }?>
					<?php if ($_smarty_tpl->getVariable('item')->value->getMobilPhone()){?><p>Téléphone portable: <?php echo $_smarty_tpl->getVariable('item')->value->getMobilPhone();?>
</p><?php }?>
					<?php if ($_smarty_tpl->getVariable('item')->value->getWorkPhone()){?><p>Téléphone travail: <?php echo $_smarty_tpl->getVariable('item')->value->getWorkPhone();?>
</p><?php }?>
					<?php if ($_smarty_tpl->getVariable('item')->value->getFax()){?><p>Fax : <?php echo $_smarty_tpl->getVariable('item')->value->getFax();?>
</p><?php }?>
					<?php if ($_smarty_tpl->getVariable('item')->value->getEmail()){?><p>Email : <?php echo $_smarty_tpl->getVariable('item')->value->getEmail();?>
</p><?php }?>
				</td>
				<td>
					<?php if ($_smarty_tpl->getVariable('item')->value->getIsDefault()){?>OUI<?php }else{ ?>NON
						<?php if ($_smarty_tpl->getVariable('user')->value->getLevelMember()->getIdLevelMember()<3||$_smarty_tpl->getVariable('user')->value->getIdUser()==$_smarty_tpl->getVariable('mandate')->value->getUser()->getIdUser()){?>
							<form action="" method="post">
							<p>
							<input type="hidden" name="idMandate" value="<?php echo $_smarty_tpl->getVariable('mandate')->value->getIdMandate();?>
"/>
							<input type="hidden" name="idSeller" value="<?php echo $_smarty_tpl->getVariable('item')->value->getIdSeller();?>
"/>
							<input type="submit" name="sendSellerByDefault" value="Définir comme principal"/>
							</p>
						</form>
	<?php }?>
					<?php }?>  
					</td>
				<td>
				<?php if ($_smarty_tpl->getVariable('user')->value->getLevelMember()->getIdLevelMember()<3||$_smarty_tpl->getVariable('user')->value->getIdUser()==$_smarty_tpl->getVariable('mandate')->value->getUser()->getIdUser()){?>	
				<form action="" method="post">
					<p>
					<input type="hidden" name="idMandate" value="<?php echo $_smarty_tpl->getVariable('mandate')->value->getIdMandate();?>
"/>
					<input type="hidden" name="idSeller" value="<?php echo $_smarty_tpl->getVariable('item')->value->getIdSeller();?>
"/>
					<input type="submit" value="Supprimer l'affectation" name="delete_affectation_seller"/>
					</p>
				</form>
					<?php }else{ ?>
					-
					<?php }?>
				</td>
			</tr>
			<?php }} ?>
		
	</tbody>
</table>
<h1>Photos : </h1>
<?php if ($_smarty_tpl->getVariable('errorPicture')->value){?>
	<ul>
		<?php  $_smarty_tpl->tpl_vars['e'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('errorPicture')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['e']->key => $_smarty_tpl->tpl_vars['e']->value){
?>
				<li class="error"><?php echo $_smarty_tpl->tpl_vars['e']->value;?>
</li>
		<?php }} ?>
	</ul>
	<?php }?>
<?php if (($_smarty_tpl->getVariable('user')->value->getLevelMember()->getIdLevelMember()<3||$_smarty_tpl->getVariable('user')->value->getIdUser()==$_smarty_tpl->getVariable('mandate')->value->getUser()->getIdUser())&&$_smarty_tpl->getVariable('mandate')->value->getEtap()->getIdMandateEtap()==Constant::ID_ETAP_TO_SELL){?>
	<form action="<?php echo Tools::create_url($_smarty_tpl->getVariable('user')->value,$_GET['module'],$_GET['page'],$_smarty_tpl->getVariable('mandate')->value->getIdMandate());?>
" method="post"  enctype="multipart/form-data">
		<input type="hidden" id="idMandate" name="idMandate" value="<?php echo $_smarty_tpl->getVariable('mandate')->value->getIdmandate();?>
"/>
		<input type="hidden" id="idSess" name="idSess" value="<?php echo str_rot13(session_id());?>
"/>
		<p class="uploadMultiple">
			<label for="newPicture">Ajouter une photo : <input type="file" name="newPicture" id="newPicture"/></label>
			<label for="isDefaultPicture">Image par defaut ?<input type="checkbox" name="isDefaultPicture" id="isDefaultPicture"/></label>
			<input type="submit" value="Envoyer" id="sendPictureForMandate" name="sendPictureForMandate" />
		</p>
	</form>	
<?php }?>
<table class="standard">
	<thead>
		<tr>
			<th>Image</th>
			<th>Principale</th>
			<th>Supprimer</th>
		</tr>
	</thead>
	<tbody>
<?php  $_smarty_tpl->tpl_vars['item'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('mandate')->value->listPictures(); if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['item']->key => $_smarty_tpl->tpl_vars['item']->value){
?>
<tr>
	<td><img src="<?php echo Constant::DEFAULT_URL_PICTURE_MODULE_DIRECTORY;?>
/<?php echo $_GET['module'];?>
/thumb/<?php echo $_smarty_tpl->getVariable('item')->value->getName();?>
" alt=""/></td>
	<td>	<?php if ($_smarty_tpl->getVariable('item')->value->getIsDefault()){?>OUI<?php }else{ ?><p>NON</p>
	<?php if ($_smarty_tpl->getVariable('user')->value->getLevelMember()->getIdLevelMember()<3||$_smarty_tpl->getVariable('user')->value->getIdUser()==$_smarty_tpl->getVariable('mandate')->value->getUser()->getIdUser()){?>
	<form action="" method="post">
		<p>
		<input type="hidden" name="idMandate" value="<?php echo $_smarty_tpl->getVariable('mandate')->value->getIdMandate();?>
"/>
		<input type="hidden" name="idPicture" value="<?php echo $_smarty_tpl->getVariable('item')->value->getIdMandatePicture();?>
"/>
		<input type="submit" name="sendPictureByDefault" value="Définir comme principale"/>
		</p>
	</form>
	<?php }?>
	<?php }?> 
	 </td>
	<td>
						<?php if (($_smarty_tpl->getVariable('user')->value->getLevelMember()->getIdLevelMember()<3||$_smarty_tpl->getVariable('user')->value->getIdUser()==$_smarty_tpl->getVariable('mandate')->value->getUser()->getIdUser())&&$_smarty_tpl->getVariable('mandate')->value->getEtap()->getIdMandateEtap()==Constant::ID_ETAP_TO_SELL){?>	
				<form action="" method="post">
					<p>
					<input type="hidden" name="idMandate" value="<?php echo $_smarty_tpl->getVariable('mandate')->value->getIdMandate();?>
"/>
					<input type="hidden" name="idPicture" value="<?php echo $_smarty_tpl->getVariable('item')->value->getIdMandatePicture();?>
"/>
					<input type="submit" value="Supprimer l'image" name="delete_picture"/>
					</p>
				</form>
					<?php }else{ ?>
					-
					<?php }?>
	</td>
</tr>
<?php }} ?>
</tbody>
</table>
<h1>Liste des plans</h1>
<?php if (($_smarty_tpl->getVariable('user')->value->getLevelMember()->getIdLevelMember()<3||$_smarty_tpl->getVariable('user')->value->getIdUser()==$_smarty_tpl->getVariable('mandate')->value->getUser()->getIdUser())&&$_smarty_tpl->getVariable('mandate')->value->getEtap()->getIdMandateEtap()==Constant::ID_ETAP_TO_SELL){?>
	<form action="<?php echo Tools::create_url($_smarty_tpl->getVariable('user')->value,$_GET['module'],$_GET['page'],$_smarty_tpl->getVariable('mandate')->value->getIdMandate());?>
" method="post"  enctype="multipart/form-data">
		<p>
			<label for="newPlan">Ajouter un plan : <input type="file" name="newPlan" id="newPlan"/></label>
			<input type="submit" value="Envoyer" id="sendPlanForMandate" name="sendPlanForMandate" />
		</p>
	</form>	
<?php }?>
<table class="standard">
	<thead>
		<tr>
			<th>Aperçu</th>
			<th>Lien</th>
			<th>Supprimer</th>
		</tr>
	</thead>
	<tbody>
		<?php  $_smarty_tpl->tpl_vars['item'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('mandate')->value->listPlan(); if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['item']->key => $_smarty_tpl->tpl_vars['item']->value){
?>
			<tr>
				<td><img src="<?php echo Constant::DEFAULT_URL_PICTURE_MODULE_DIRECTORY;?>
/<?php echo $_GET['module'];?>
/thumb/<?php echo $_smarty_tpl->getVariable('item')->value->getName();?>
" alt=""/></td>
				<td><a href="<?php echo Constant::DEFAULT_URL_PICTURE_MODULE_DIRECTORY;?>
/<?php echo $_GET['module'];?>
/<?php echo $_smarty_tpl->getVariable('item')->value->getName();?>
" target="_blank">Télécharger ( <?php echo $_smarty_tpl->getVariable('item')->value->getCode();?>
 )</a></td>
					<td>
						<?php if ($_smarty_tpl->getVariable('user')->value->getLevelMember()->getIdLevelMember()<3||$_smarty_tpl->getVariable('user')->value->getIdUser()==$_smarty_tpl->getVariable('mandate')->value->getUser()->getIdUser()){?>	
				<form action="" method="post">
					<p>
					<input type="hidden" name="idMandate" value="<?php echo $_smarty_tpl->getVariable('mandate')->value->getIdMandate();?>
"/>
					<input type="hidden" name="idPlan" value="<?php echo $_smarty_tpl->getVariable('item')->value->getIdMandateScan();?>
"/>
					<input type="submit" value="Supprimer le plan" name="delete_plan"/>
					</p>
				</form>
					<?php }else{ ?>
					-
					<?php }?>
	</td>
			</tr>
			<?php }} ?>
		
	</tbody>
</table>

<?php $_template = new Smarty_Internal_Template("tpl_default/hook.tpl", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
$_template->assign('position',"hook_bottom"); echo $_template->getRenderedTemplate();?><?php $_template->updateParentVariables(0);?><?php unset($_template);?>
 -->
</div>
