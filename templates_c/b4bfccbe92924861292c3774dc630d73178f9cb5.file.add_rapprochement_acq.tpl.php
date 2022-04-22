<?php /* Smarty version Smarty-3.0.6, created on 2013-03-29 13:47:31
         compiled from "/var/www/aptana/extra-immo/modules/rapprochement/views/add_rapprochement_acq.tpl" */ ?>
<?php /*%%SmartyHeaderCode:181641933851558d63180213-42247834%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'b4bfccbe92924861292c3774dc630d73178f9cb5' => 
    array (
      0 => '/var/www/aptana/extra-immo/modules/rapprochement/views/add_rapprochement_acq.tpl',
      1 => 1313670560,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '181641933851558d63180213-42247834',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<?php $_template = new Smarty_Internal_Template("tpl_default/entete.tpl", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate();?><?php $_template->updateParentVariables(0);?><?php unset($_template);?>
<h1>Rapprocher <?php echo $_smarty_tpl->getVariable('acq')->value->getFirstname();?>
 <?php echo $_smarty_tpl->getVariable('acq')->value->getName();?>
 du mandat
	<?php echo $_smarty_tpl->getVariable('mandate')->value->getNumberMandate();?>
</h1>
<p>
	<a href="<?php echo $_smarty_tpl->getVariable('redirectC')->value;?>
"><?php echo $_smarty_tpl->getVariable('labelRedirectC')->value;?>
</a>
</p>
<form action="" method="post">
	<?php $_template = new Smarty_Internal_Template("tpl_default/viewsErrors.tpl", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate();?><?php $_template->updateParentVariables(0);?><?php unset($_template);?>
	<fieldset>
		<legend>Général : </legend>
		<?php if ($_smarty_tpl->getVariable('listUser')->value){?>
		<p>
			<label for="utilisateurAssocie">Utilisateur associé : <select
				name="utilisateurAssocie" id="utilisateurAssocie"> <?php  $_smarty_tpl->tpl_vars['u'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('listUser')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['u']->key => $_smarty_tpl->tpl_vars['u']->value){
?>
					<option <?php if ($_smarty_tpl->getVariable('u')->value->getIdUser()==$_smarty_tpl->getVariable('utilisateurAssocie')->value){?>
						selected="selected" <?php }?>
						value="<?php echo $_smarty_tpl->getVariable('u')->value->getIdUser();?>
"><?php echo $_smarty_tpl->getVariable('u')->value->getFirstname();?>
 <?php echo $_smarty_tpl->getVariable('u')->value->getName();?>
</option>
					<?php }} ?>
			</select> </label>
		</p>
		<?php }else{ ?>
		<p>Utilisateur associé : <?php echo $_smarty_tpl->getVariable('user')->value->getFirstname();?>
 <?php echo $_smarty_tpl->getVariable('user')->value->getName();?>
</p>
		<?php }?>
		<p>Numéro du mandat associé : <?php echo $_smarty_tpl->getVariable('mandate')->value->getNumberMandate();?>
</p>
		<p>Acquereur associé : <?php echo $_smarty_tpl->getVariable('acq')->value->getFirstname();?>
 <?php echo $_smarty_tpl->getVariable('acq')->value->getName();?>
</p>
	</fieldset>
	<fieldset>
		<legend>Visite : </legend>

		<p>
			<label for="dateVisite">Date de la visite : <input type="text"
				name="dateVisite" value="<?php echo $_smarty_tpl->getVariable('dateVisite')->value;?>
" id="dateVisite"
				class="dateTimepicker" /> </label>
		</p>

		<p>
			<label for="dateCompteRendu">Compte rendu le : <input type="text"
				name="dateCompteRendu" value="<?php echo $_smarty_tpl->getVariable('dateCompteRendu')->value;?>
"
				id="dateCompteRendu" class="dateTimepicker" /> </label>
		</p>
		<p>
			<label for="resultat">Resultat : <input type="text" name="resultat"
				value="<?php echo $_smarty_tpl->getVariable('resultat')->value;?>
" id="resultat" /> </label>
		</p>
		<p>
			<label for="ptPositifs">Points positifs : <textarea name="ptPositifs"
					id="ptPositifs" cols="30" rows="10"><?php echo $_smarty_tpl->getVariable('ptPositifs')->value;?>
</textarea> </label>
		</p>
		<p>
			<label for="ptNegatifs">points negatifs : <textarea name="ptNegatifs"
					id="ptNegatifs" cols="30" rows="10"><?php echo $_smarty_tpl->getVariable('ptNegatifs')->value;?>
</textarea> </label>
		</p>
		<p>
			<label for="resultatVisite">Résultat de la visite : <select
				name="resultatVisite" id="resultatVisite">
					<option <?php if ($_smarty_tpl->getVariable('resultatVisite')->value==0){?> selected="selected"
						<?php }?> value="0">-------</option>
					<option <?php if ($_smarty_tpl->getVariable('resultatVisite')->value==1){?> selected="selected"
						<?php }?>  value="1">Ne correspond pas</option>
					<option <?php if ($_smarty_tpl->getVariable('resultatVisite')->value==2){?> selected="selected"
						<?php }?> value="2">Ok</option>

			</select> </label>
		</p>
	</fieldset>
	<p>
		<input type="submit" value="valider" name="send" />
	</p>
</form>
</div>
