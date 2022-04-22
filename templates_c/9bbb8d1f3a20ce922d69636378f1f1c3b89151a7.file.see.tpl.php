<?php /* Smarty version Smarty-3.0.6, created on 2013-03-29 13:47:47
         compiled from "/var/www/aptana/extra-immo/modules/rapprochement/views/see.tpl" */ ?>
<?php /*%%SmartyHeaderCode:28654186351558d73a488b6-84114821%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '9bbb8d1f3a20ce922d69636378f1f1c3b89151a7' => 
    array (
      0 => '/var/www/aptana/extra-immo/modules/rapprochement/views/see.tpl',
      1 => 1325174373,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '28654186351558d73a488b6-84114821',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<?php $_template = new Smarty_Internal_Template("tpl_default/entete.tpl", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate();?><?php $_template->updateParentVariables(0);?><?php unset($_template);?> <?php $_smarty_tpl->tpl_vars['acq'] = new Smarty_variable($_smarty_tpl->getVariable('rapprochement')->value->getAcquereur(), null, null);?> <?php $_smarty_tpl->tpl_vars['mandate'] = new Smarty_variable($_smarty_tpl->getVariable('rapprochement')->value->getMandate(), null, null);?>
<h1>Fiche de rapprochement entre <?php echo $_smarty_tpl->getVariable('acq')->value->getFirstName();?>

	<?php echo $_smarty_tpl->getVariable('acq')->value->getName();?>
 et le mandat numéro :
	<?php echo $_smarty_tpl->getVariable('rapprochement')->value->getMandate()->getNumberMandate();?>
</h1>
<p>
	<a href="<?php echo $_smarty_tpl->getVariable('redirect')->value;?>
"><?php echo $_smarty_tpl->getVariable('labelRedirect')->value;?>
</a>
</p>

<?php if ($_smarty_tpl->getVariable('user')->value->getLevelMember()->getIdLevelMember()<3||$_smarty_tpl->getVariable('user')->value->getIdUser()==$_smarty_tpl->getVariable('rapprochement')->value->getUser()->getIdUser()){?>
<p>
	<a href="<?php echo $_smarty_tpl->getVariable('linkToUpdate')->value;?>
">Modifier</a> - <a href="<?php echo $_smarty_tpl->getVariable('linkToDelete')->value;?>
">Supprimer</a>
</p>
<?php }?>


<h2>Général :</h2>
<div class="bulle">
	<p>Utilisateur associé : <?php echo $_smarty_tpl->getVariable('rapprochement')->value->getUser()->getFirstname();?>

		<?php echo $_smarty_tpl->getVariable('rapprochement')->value->getUser()->getName();?>
</p>
	<h3>Acquereur :</h3>
	<p>Nom : <?php echo $_smarty_tpl->getVariable('acq')->value->getName();?>
</p>
	<p>Prénom : <?php echo $_smarty_tpl->getVariable('acq')->value->getFirstname();?>
</p>
	<p>
		Adresse : <?php echo $_smarty_tpl->getVariable('acq')->value->getAddress();?>
 <br />
		<?php echo $_smarty_tpl->getVariable('acq')->value->getVilleAcquereur()->getZipCode();?>

		<?php echo $_smarty_tpl->getVariable('acq')->value->getVilleAcquereur()->getName();?>

	</p>
	<p><a href="<?php echo Tools::create_url($_smarty_tpl->getVariable('user')->value,'acquereur','see',$_smarty_tpl->getVariable('acq')->value->getIdAcquereur());?>
" <?php if ($_smarty_tpl->getVariable('user')->value->getOpenInNewTab()){?> target="_blank"<?php }?>>Voir la fiche acquereur</a></p>
	<p>Téléphones :</p>
	<ul>
		<li>Principal : <?php echo $_smarty_tpl->getVariable('acq')->value->getPhone();?>
</li>
		<li>Mobile : <?php echo $_smarty_tpl->getVariable('acq')->value->getMobilPhone();?>
</li>
		<li>Du travail : <?php echo $_smarty_tpl->getVariable('acq')->value->getWorkPhone();?>
</li>
		<li>Fax : <?php echo $_smarty_tpl->getVariable('acq')->value->getFax();?>
</li>
	</ul>
	<p>Email : <?php echo $_smarty_tpl->getVariable('acq')->value->getEmail();?>
</p>
	<h3>Mandat :</h3>
	<p>Numéro de mandat : <?php echo $_smarty_tpl->getVariable('mandate')->value->getNumberMandate();?>
</p>
	
	<?php if ($_smarty_tpl->getVariable('mandate')->value->getMandateType()->getIdMandateType()==Constant::ID_PLOT_OF_LAND){?>
	<?php $_smarty_tpl->tpl_vars["module"] = new Smarty_variable('terrain', null, null);?>
	<?php }else{ ?>
	<?php $_smarty_tpl->tpl_vars["module"] = new Smarty_variable('mandat', null, null);?>
	<?php }?>
	<p><a href="<?php echo Tools::create_url($_smarty_tpl->getVariable('user')->value,$_smarty_tpl->getVariable('module')->value,'see',$_smarty_tpl->getVariable('mandate')->value->getIdMandate());?>
" <?php if ($_smarty_tpl->getVariable('user')->value->getOpenInNewTab()){?> target="_blank"<?php }?>>Voir la fiche <?php echo $_smarty_tpl->getVariable('module')->value;?>
</a></p>

</div>
<h2>Infos rapprochement :</h2>
<div class="bulle">
	<p>Date de la visite : <?php if ($_smarty_tpl->getVariable('rapprochement')->value->getDateVisite()){?><?php echo date(Constant::DATE_FORMAT,$_smarty_tpl->getVariable('rapprochement')->value->getDateVisite());?>
<?php }else{ ?>NC<?php }?></p>
	<p>Compte rendu le : <?php if ($_smarty_tpl->getVariable('rapprochement')->value->getCompteRenduLe()){?><?php echo date(Constant::DATE_FORMAT,$_smarty_tpl->getVariable('rapprochement')->value->getCompteRenduLe());?>
<?php }else{ ?>NC<?php }?></p>
	<p>Visitée ? <?php if ($_smarty_tpl->getVariable('rapprochement')->value->getResultatVisite()!=0){?>Oui<?php }else{ ?>Non<?php }?></p>
	<?php if ($_smarty_tpl->getVariable('rapprochement')->value->getResultatVisite()!=0){?>
	<p>Points positifs : <?php echo $_smarty_tpl->getVariable('rapprochement')->value->getPointsPositifs();?>
</p>
	<p>Points negatifs : <?php echo $_smarty_tpl->getVariable('rapprochement')->value->getPointsNegatifs();?>
</p>
	<p>Resultat de la visite ? <?php if ($_smarty_tpl->getVariable('rapprochement')->value->getResultatVisite()==1){?>Ne correspond pas<?php }else{ ?>OK<?php }?></p>
	<?php }?>


</div>
 <?php if ($_smarty_tpl->getVariable('user')->value->getLevelMember()->getIdLevelMember()<3||$_smarty_tpl->getVariable('user')->value->getIdUser()==$_smarty_tpl->getVariable('rapprochement')->value->getUser()->getIdUser()){?>
<form action="" method="post">
	<p>
		<input type="submit" value="Mettre en etat compromis" id="goCompromis"
			name="goCompromis" />
	</p>
</form>
<?php }?>


</div>
