<?php /* Smarty version Smarty-3.0.6, created on 2014-05-14 09:13:34
         compiled from "/var/www/aptana/extra-immo/modules/mandat/views/see.tpl" */ ?>
<?php /*%%SmartyHeaderCode:18617264385373179e672392-69712287%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'b99c7df3aa639235f5a722e0443c75f773bbdaff' => 
    array (
      0 => '/var/www/aptana/extra-immo/modules/mandat/views/see.tpl',
      1 => 1374569362,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '18617264385373179e672392-69712287',
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
			href="<?php echo Tools::create_url($_smarty_tpl->getVariable('user')->value,'mandat','endSell',$_smarty_tpl->getVariable('mandate')->value->getIdMandate());?>
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
		<div class="accordion" rel="2">
			<h2 rel="gen">
				<a href="#" rel="gen">Général</a>
			</h2>
			<div>
				<?php if (($_smarty_tpl->getVariable('user')->value->getLevelMember()->getIdLevelMember()<3||$_smarty_tpl->getVariable('user')->value->getIdUser()==$_smarty_tpl->getVariable('mandate')->value->getUser()->getIdUser())){?>
				<p>
					<a
						href="<?php echo Tools::create_url($_smarty_tpl->getVariable('user')->value,$_GET['module'],'updateGen',$_GET['action']);?>
">Modifier
						les informations</a>
				</p>
				<?php }?>
				<div class="mSep">
				<h3>Localisation</h3>
<!-- 					<div class="bulle"> -->
					
					<p><?php echo $_smarty_tpl->getVariable('mandate')->value->getAddress();?>
</p>
					<p><?php echo $_smarty_tpl->getVariable('mandate')->value->getCity()->getZipCode();?>

						<?php echo $_smarty_tpl->getVariable('mandate')->value->getCity()->getName();?>
</p>
<!-- 					</div> -->
				</div>
				<div class="mSep">
				<h3>Général</h3>
<!-- 				<div class="bulle"> -->
					
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
					<p>Type de bien : <?php echo $_smarty_tpl->getVariable('mandate')->value->getMandateType()->getName();?>
</p>
					</div>
<!-- 				</div> -->
				<hr class="invi clear" />
				<div class="mSep">
				<h3>Mandat</h3>
<!-- 				<div class="bulle"> -->
					
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
<!-- 					</div> -->

					<p>Numéro lot :<?php if ($_smarty_tpl->getVariable('mandate')->value->getNumberLot()){?> <?php echo $_smarty_tpl->getVariable('mandate')->value->getNumberLot();?>
<?php }else{ ?>NC<?php }?></p>
				</div>
				<div class="mSep">
					<h3>Prix</h3>
<!-- 					<div class="bulle"> -->
					
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

					<?php }?>
					
					
					
					 <?php if (Tools::grosNombre(round($_smarty_tpl->getVariable('mandate')->value->getMargeNegociation(),0))!=0){?>
					<p>Marge negoce :
						<?php echo Tools::grosNombre(round($_smarty_tpl->getVariable('mandate')->value->getMargeNegociation(),0));?>

						&euro;</p>
					<?php }?> 
					<p>Loyer (si locataires) : <?php if ($_smarty_tpl->getVariable('mandate')->value->getRental()==null){?>NC<?php }else{ ?><?php echo round($_smarty_tpl->getVariable('mandate')->value->getRental());?>
 &euro;<?php }?></p>
					<?php }else{ ?>
					<p>Loyer + frais d'agence :
						<?php echo Tools::grosNombre(round($_smarty_tpl->getVariable('mandate')->value->getPriceFAI(),0));?>
 &euro;</p>
					<p>Loyer : <?php echo Tools::grosNombre(round($_smarty_tpl->getVariable('mandate')->value->getPriceSeller(),0));?>

						&euro;</p>
					<p>Commission :
						<?php echo Tools::grosNombre(round($_smarty_tpl->getVariable('mandate')->value->getCommission(),0));?>
 &euro;</p>
					<?php }?>
					<p>Rentabilité : <?php if ($_smarty_tpl->getVariable('mandate')->value->getProfitability()==null){?>NC<?php }else{ ?><?php echo $_smarty_tpl->getVariable('mandate')->value->getProfitability();?>
 %<?php }?></p>
					<p>Prix garage : <?php if ($_smarty_tpl->getVariable('mandate')->value->getPriceGarage()==null){?>NC<?php }else{ ?><?php echo round($_smarty_tpl->getVariable('mandate')->value->getPriceGarage());?>
<?php }?></p>
					<p>Prix cave : <?php if ($_smarty_tpl->getVariable('mandate')->value->getPriceCellar()==null){?>NC<?php }else{ ?><?php echo round($_smarty_tpl->getVariable('mandate')->value->getPriceCellar());?>
<?php }?></p>
<!-- 					</div> -->
				</div>
				<hr class="invi clear" />
				<?php if ($_smarty_tpl->getVariable('mandate')->value->getGeolocalisation()){?> <?php $_smarty_tpl->tpl_vars["geo"] = new Smarty_variable(explode(',',$_smarty_tpl->getVariable('mandate')->value->getGeolocalisation()), null, null);?>
				<h3>Géolocalisation</h3>
				<div class="bulle">
				
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
				</div>
				<?php }else{ ?>
				<div id="map2" data-address="<?php echo $_smarty_tpl->getVariable('mandate')->value->getAddress();?>
, <?php echo $_smarty_tpl->getVariable('mandate')->value->getCity()->getZipCode();?>
 <?php echo $_smarty_tpl->getVariable('mandate')->value->getCity()->getName();?>
"></div>
	
				<?php }?>
			</div>
			<h3>
				<a href="#desc">Infos</a>
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
							<td class="gauche">Numéro garage</td>
							<td class="droite"><?php if ($_smarty_tpl->getVariable('mandate')->value->getNumberGarage()==null||$_smarty_tpl->getVariable('mandate')->value->getNumberGarage()==''){?>NC<?php }else{ ?><?php echo $_smarty_tpl->getVariable('mandate')->value->getNumberGarage();?>
<?php }?></td>
						</tr>
						<tr>
							<td class="gauche">Numéro  cave</td>
							<td class="droite"><?php if ($_smarty_tpl->getVariable('mandate')->value->getNumberCellar()==null||$_smarty_tpl->getVariable('mandate')->value->getNumberCellar()==''){?>NC<?php }else{ ?><?php echo $_smarty_tpl->getVariable('mandate')->value->getNumberCellar();?>
<?php }?></td>
						</tr>
						<tr>
							<td class="gauche">Numéro parking</td>
							<td class="droite"><?php if ($_smarty_tpl->getVariable('mandate')->value->getNumberParking()==null||$_smarty_tpl->getVariable('mandate')->value->getNumberParking()==''){?>NC<?php }else{ ?><?php echo $_smarty_tpl->getVariable('mandate')->value->getNumberParking();?>
<?php }?></td>
						</tr>
						<tr>
							<td class="gauche">Numéro grenier</td>
							<td class="droite"><?php if ($_smarty_tpl->getVariable('mandate')->value->getNumberAttic()==null||$_smarty_tpl->getVariable('mandate')->value->getNumberAttic()==''){?>NC<?php }else{ ?><?php echo $_smarty_tpl->getVariable('mandate')->value->getNumberAttic();?>
<?php }?></td>
						</tr>
					
					
					
					
					
						<tr>
							<td class="gauche">Nombre de pièces</td>
							<td class="droite"><?php echo $_smarty_tpl->getVariable('mandate')->value->getNbPiece();?>
</td>
						</tr>
						<tr>
							<td class="gauche">Nombre de chambres</td>
							<td class="droite"><?php echo $_smarty_tpl->getVariable('mandate')->value->getNbChambre();?>
</td>
						</tr>
						<tr>
							<td class="gauche">Superficie terrain</td>
							<td class="droite"><?php if ($_smarty_tpl->getVariable('mandate')->value->getSuperficieTotale()==0){?>NC<?php }else{ ?><?php echo $_smarty_tpl->getVariable('mandate')->value->getSuperficieTotale();?>
<?php }?></td>
						</tr>
						<tr>
							<td class="gauche">Surface habitable</td>
							<td class="droite"><?php echo $_smarty_tpl->getVariable('mandate')->value->getSurfaceHabitable();?>
</td>
						</tr>
						<tr>
							<td class="gauche">Surface pièce vie</td>
							<td class="droite"><?php echo $_smarty_tpl->getVariable('mandate')->value->getSurfacePieceVie();?>
</td>
						</tr>
						<tr>
							<td class="gauche">Niveau</td>
							<td class="droite"><?php echo $_smarty_tpl->getVariable('mandate')->value->getNiveau();?>
</td>
						</tr>
						<tr>
							<td class="gauche">Année construction</td>
							<td class="droite"><?php if ($_smarty_tpl->getVariable('mandate')->value->getAnneeConstruction()==0){?>NC<?php }else{ ?><?php echo $_smarty_tpl->getVariable('mandate')->value->getAnneeConstruction();?>
<?php }?></td>
						</tr>
						<tr>
							<td class="gauche">Charges mensuelles</td>
							<td class="droite"><?php echo $_smarty_tpl->getVariable('mandate')->value->getChargesMensuelle();?>
</td>
						</tr>
						<tr>
							<td class="gauche">Taxes foncières</td>
							<td class="droite"><?php echo $_smarty_tpl->getVariable('mandate')->value->getTaxesFonciere();?>
</td>
						</tr>
						<tr>
							<td class="gauche">Taxes Habitation</td>
							<td class="droite"><?php echo $_smarty_tpl->getVariable('mandate')->value->getTaxeHabitation();?>
</td>
						</tr>

					</table>
					
				</div>
				<div class="tiers bulle">
				
					<table>
											<tr>
							<td class="gauche">Cheminée</td>
							<td class="droite"><?php if ($_smarty_tpl->getVariable('mandate')->value->getCheminee()==1){?>Oui<?php }else{ ?>Non<?php }?></td>
						</tr>
						<tr>
							<td class="gauche">Cuisine équipée</td>
							<td class="droite"><?php if ($_smarty_tpl->getVariable('mandate')->value->getCuisineEquipee()==1){?>Oui<?php }else{ ?>Non<?php }?></td>
						</tr>
						<tr>
							<td class="gauche">Cuisine amenagée</td>
							<td class="droite"><?php if ($_smarty_tpl->getVariable('mandate')->value->getCuisineAmenagee()==1){?>Oui<?php }else{ ?>Non<?php }?></td>
						</tr>
						<tr>
							<td class="gauche">Piscine</td>
							<td class="droite"><?php if ($_smarty_tpl->getVariable('mandate')->value->getPiscine()==1){?>Oui<?php }else{ ?>Non<?php }?></td>
						</tr>
						<tr>
							<td class="gauche">Piscine intérieure</td>
							<td class="droite"><?php if ($_smarty_tpl->getVariable('mandate')->value->getPoolHouse()==1){?>Oui<?php }else{ ?>Non<?php }?></td>
						</tr>
						<tr>
							<td class="gauche">Terrasse</td>
							<td class="droite"><?php if ($_smarty_tpl->getVariable('mandate')->value->getTerrasse()==1){?>Oui<?php }else{ ?>Non<?php }?></td>
						</tr>
						<tr>
							<td class="gauche">Mezzanine</td>
							<td class="droite"><?php if ($_smarty_tpl->getVariable('mandate')->value->getMezzanine()==1){?>Oui<?php }else{ ?>Non<?php }?></td>
						</tr>
						<tr>
							<td class="gauche">Dépendance</td>
							<td class="droite"><?php if ($_smarty_tpl->getVariable('mandate')->value->getDependance()==1){?>Oui<?php }else{ ?>Non<?php }?></td>
						</tr>
						<tr>
							<td class="gauche">Gaz</td>
							<td class="droite"><?php if ($_smarty_tpl->getVariable('mandate')->value->getGaz()==1){?>Oui<?php }else{ ?>Non<?php }?></td>
						</tr>

						<tr>
							<td class="gauche">Cave</td>
							<td class="droite"><?php if ($_smarty_tpl->getVariable('mandate')->value->getCave()==1){?>Oui<?php }else{ ?>Non<?php }?></td>
						</tr>
						<tr>
							<td class="gauche">Sous sol</td>
							<td class="droite"><?php if ($_smarty_tpl->getVariable('mandate')->value->getSousSol()==1){?>Oui<?php }else{ ?>Non<?php }?></td>
						</tr>
						<tr>
							<td class="gauche">Garage</td>
							<td class="droite"><?php if ($_smarty_tpl->getVariable('mandate')->value->getGarage()==1){?>Oui<?php }else{ ?>Non<?php }?></td>
						</tr>
						<tr>
							<td class="gauche">Parking</td>
							<td class="droite"><?php if ($_smarty_tpl->getVariable('mandate')->value->getParking()==1){?>Oui<?php }else{ ?>Non<?php }?></td>
						</tr>
						<tr>
							<td class="gauche">Rez de jardin</td>
							<td class="droite"><?php if ($_smarty_tpl->getVariable('mandate')->value->getRezDeJardin()==1){?>Oui<?php }else{ ?>Non<?php }?></td>
						</tr>
					</table>
				</div>
				<div class="tiers bulle">
					<table>
						<td class="gauche">Tout à l'égout</td>
							<td class="droite"><?php if ($_smarty_tpl->getVariable('mandate')->value->getToutALegout()==1){?>Oui<?php }else{ ?>Non<?php }?></td>
						</tr>
						<tr>
							<td class="gauche">Plain pied</td>
							<td class="droite"><?php if ($_smarty_tpl->getVariable('mandate')->value->getPlainPied()==1){?>Oui<?php }else{ ?>Non<?php }?></td>
						</tr>
						<tr>
							<td class="gauche">Carrière</td>
							<td class="droite"><?php if ($_smarty_tpl->getVariable('mandate')->value->getCarriere()==1){?>Oui<?php }else{ ?>Non<?php }?></td>
						</tr>
						<tr>
							<td class="gauche">Point eau</td>
							<td class="droite"><?php if ($_smarty_tpl->getVariable('mandate')->value->getPointEau()==1){?>Oui<?php }else{ ?>Non<?php }?></td>
						</tr>
						<tr>
							<td class="gauche">Isolation</td>
							<td class="droite"><?php if ($_smarty_tpl->getVariable('mandate')->value->getInsulation()){?><?php echo $_smarty_tpl->getVariable('mandate')->value->getInsulation()->getName();?>
<?php }else{ ?>Non
								spécifié<?php }?></td>
						</tr>
						<tr>
							<td class="gauche">Toiture</td>
							<td class="droite"><?php if ($_smarty_tpl->getVariable('mandate')->value->getRoof()){?><?php echo $_smarty_tpl->getVariable('mandate')->value->getRoof()->getName();?>
<?php }else{ ?>Non
								spécifié<?php }?></td>
						</tr>
						<tr>
							<td class="gauche">Chauffage</td>
							<td class="droite"><?php if ($_smarty_tpl->getVariable('mandate')->value->getHeating()){?><?php echo $_smarty_tpl->getVariable('mandate')->value->getHeating()->getName();?>
<?php }else{ ?>Non
								spécifié<?php }?></td>
						</tr>
						<tr>
							<td class="gauche">Parties communes</td>
							<td class="droite"><?php if ($_smarty_tpl->getVariable('mandate')->value->getCommonOwnership()){?><?php echo $_smarty_tpl->getVariable('mandate')->value->getCommonOwnership()->getName();?>
<?php }else{ ?>Non
								spécifié<?php }?></td>
						</tr>
						
						<tr>
							<td class="gauche">Type de construction</td>
							<td class="droite"><?php if ($_smarty_tpl->getVariable('mandate')->value->getConstruction()){?><?php echo $_smarty_tpl->getVariable('mandate')->value->getConstruction()->getName();?>
<?php }else{ ?>Non
								spécifié<?php }?></td>
						</tr>
						<tr>
							<td class="gauche">Style</td>
							<td class="droite"><?php if ($_smarty_tpl->getVariable('mandate')->value->getStyle()){?><?php echo $_smarty_tpl->getVariable('mandate')->value->getStyle()->getName();?>
<?php }else{ ?>Non
								spécifié<?php }?></td>
						</tr>
						<tr>
							<td class="gauche">Nouveautés</td>
							<td class="droite"><?php if ($_smarty_tpl->getVariable('mandate')->value->getNews()){?><?php echo $_smarty_tpl->getVariable('mandate')->value->getNews()->getName();?>
<?php }else{ ?>Non
								spécifié<?php }?></td>
						</tr>
						<tr>
							<td class="gauche">Conditions</td>
							<td class="droite"><?php if ($_smarty_tpl->getVariable('mandate')->value->getCondition()){?><?php echo $_smarty_tpl->getVariable('mandate')->value->getCondition()->getName();?>
<?php }else{ ?>Non
								spécifié<?php }?></td>
						</tr>
						<tr>
							<td class="gauche">Mitoyenneté : </td>
							<td class="droite"><?php if ($_smarty_tpl->getVariable('mandate')->value->getMandateAdjoining()){?><?php echo $_smarty_tpl->getVariable('mandate')->value->getMandateAdjoining()->getName();?>
<?php }else{ ?>Non
								spécifié<?php }?></td>
						</tr>
					</table>
				</div>
				<hr class="clear invi" />
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
					<h3>Coup de coeur : </h3>
					<p>Coup de coeur : <?php if ($_smarty_tpl->getVariable('mandate')->value->getCoupCoeur()){?>Oui<?php }else{ ?>Non<?php }?></p>
				</div>
				<div class="mSep">
					<h3>Vitrine : </h3>
					<p>Affiché en vitrine : <?php if ($_smarty_tpl->getVariable('afficheEnVitrine')->value){?>Oui<?php }else{ ?>Non<?php }?></p>
				</div>
				<hr class="clear invi" />
				<div class="bulle">
					<h3>Texte utilisé dans les affiches :</h3>
						<?php if ($_smarty_tpl->getVariable('mandate')->value->getCommentaireApparent()==''){?>
					<p>Aucun texte saisi.</p>
					<?php }else{ ?>
					<p><?php echo $_smarty_tpl->getVariable('mandate')->value->getCommentaireApparent();?>
</p>
					<?php }?>
				</div>

				<div class="bulle">
					<h3>Passerelles utilisées :</h3>
					<?php $_template = new Smarty_Internal_Template("tpl_default/hook.tpl", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
$_template->assign('position',"hook_site"); echo $_template->getRenderedTemplate();?><?php $_template->updateParentVariables(0);?><?php unset($_template);?>
				</div>
								<div class="bulle">
					<h3>Texte utilisé avec les passerelles :</h3>
						<?php if ($_smarty_tpl->getVariable('mandate')->value->getPubInternet()==''){?>
					<p>Aucun texte saisi.</p>
					<?php }else{ ?>
					<p><?php echo $_smarty_tpl->getVariable('mandate')->value->getPubInternet();?>
</p>
					<?php }?>
				</div>
				
				
				<div class="bulle">
					<h3>Photos utilisées avec les passerelles :</h3>
					<?php $_template = new Smarty_Internal_Template("tpl_default/hook.tpl", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
$_template->assign('position',"hook_ExportsList"); echo $_template->getRenderedTemplate();?><?php $_template->updateParentVariables(0);?><?php unset($_template);?>
				</div>
				
	
				
			</div>
			<h3>
				<a href="#dpe">DPE</a>
			</h3>
			<div>
				<?php $_template = new Smarty_Internal_Template("tpl_default/hook.tpl", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
$_template->assign('position',"hook_center"); echo $_template->getRenderedTemplate();?><?php $_template->updateParentVariables(0);?><?php unset($_template);?> <?php if (($_smarty_tpl->getVariable('user')->value->getLevelMember()->getIdLevelMember()<3||$_smarty_tpl->getVariable('user')->value->getIdUser()==$_smarty_tpl->getVariable('mandate')->value->getUser()->getIdUser())&&$_smarty_tpl->getVariable('mandate')->value->getEtap()->getIdMandateEtap()==Constant::ID_ETAP_TO_SELL){?>
				<p>
					<a
						href="<?php echo Tools::create_url($_smarty_tpl->getVariable('user')->value,$_GET['module'],'updateDpe',$_GET['action']);?>
">Modifier
						les infos DPE</a>
				</p>
				<?php }?>
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
					<li class=""><?php echo $_smarty_tpl->tpl_vars['e']->value;?>
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
<?php $_template = new Smarty_Internal_Template("tpl_default/hook.tpl", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
$_template->assign('position',"hook_bottom"); echo $_template->getRenderedTemplate();?><?php $_template->updateParentVariables(0);?><?php unset($_template);?>
</div>
