<?php /* Smarty version Smarty-3.0.6, created on 2013-07-23 11:39:14
         compiled from "/var/www/aptana/extra-immo/modules/export/views/list.tpl" */ ?>
<?php /*%%SmartyHeaderCode:59481098551ee4f42823310-24732889%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '3554af9dfff7d96191263e4d6b6e07e443f38bc5' => 
    array (
      0 => '/var/www/aptana/extra-immo/modules/export/views/list.tpl',
      1 => 1369380621,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '59481098551ee4f42823310-24732889',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<?php $_template = new Smarty_Internal_Template('tpl_default/entete.tpl', $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate();?><?php $_template->updateParentVariables(0);?><?php unset($_template);?>
<h1>Mandats et exports</h1>
<p><a href="<?php echo Tools::create_url($_smarty_tpl->getVariable('user')->value,'export','preList');?>
">Revenir à la liste de choix des passerelles</a></p>
<form action="" method="post">
	<p>
		<input type="submit" value="Mettre à jour" name="send" />
	</p>
	<div class="alignR">
		<label for="agency">Voir les mandats de : <select name="agency"
			id="agency">
				<option value="ALL" <?php if ($_smarty_tpl->getVariable('agency')->value=='ALL'){?> selected="selected"<?php }?>>Toute
					les agences</option> <?php  $_smarty_tpl->tpl_vars['a'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('listAgency')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['a']->key => $_smarty_tpl->tpl_vars['a']->value){
?>
				<option value="<?php echo $_smarty_tpl->getVariable('a')->value->getIdAgency();?>
" <?php if ($_smarty_tpl->getVariable('agency')->value==$_smarty_tpl->getVariable('a')->value->getIdAgency()){?>
					selected="selected" <?php }?>>l'agence de <?php echo $_smarty_tpl->getVariable('a')->value->getName();?>
</option>
				<?php }} ?>
		</select> </label> <input type="submit" name="toogleConfidentialMode"
			value="Ok" />

	</div>
	<hr class="invi clear" />
	<table class="standardWithoutPagination">
		<thead>
			<tr>

				<th><p>Numéro de mandat</p></th>
				<th><p>Prénom et<br/>nom du vendeur</p></th>
				<th><p>Adresse du bien</p></th>
				<th>
					<p>Voir la fiche</p>
				</th>
				<th><p>Image du mandat</p></th> <?php  $_smarty_tpl->tpl_vars['pa'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('listPasserelle')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['pa']->key => $_smarty_tpl->tpl_vars['pa']->value){
?> 
				<th><p><?php echo $_smarty_tpl->getVariable('pa')->value->getName();?>
</p>
					<p class="JsVisible">
						Tout cocher : <input type="checkbox" name="checkAll"
							class="jsCheckAll" rel="<?php echo $_smarty_tpl->getVariable('pa')->value->getIdPasserelle();?>
" />
					</p>
				</th> <?php }} ?>

			</tr>
		</thead>
		<tbody>
			<?php  $_smarty_tpl->tpl_vars['m'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('listMandate')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['m']->key => $_smarty_tpl->tpl_vars['m']->value){
?>
			<tr>
				<td><p><?php echo $_smarty_tpl->getVariable('m')->value->getNumberMandate();?>
</p></td>
				<td><p><?php if ($_smarty_tpl->getVariable('m')->value->getDefaultSeller()){?><?php echo $_smarty_tpl->getVariable('m')->value->getDefaultSeller()->getFirstname();?>
<br/>
						<?php echo $_smarty_tpl->getVariable('m')->value->getDefaultSeller()->getName();?>
<?php }else{ ?>NC<?php }?></p></td>
				<td><p>
						Secteur : <?php echo $_smarty_tpl->getVariable('m')->value->getCity()->getSector()->getName();?>
<br /><?php echo $_smarty_tpl->getVariable('m')->value->getAddress();?>
<br /><?php echo $_smarty_tpl->getVariable('m')->value->getCity()->getZipCode();?>

						<?php echo $_smarty_tpl->getVariable('m')->value->getCity()->getName();?>

					</p></td>
				<td><?php if ($_smarty_tpl->getVariable('m')->value->getMandateType()->getIdMandateType()==Constant::ID_PLOT_OF_LAND){?> <?php $_smarty_tpl->tpl_vars["mod"] = new Smarty_variable("terrain", null, null);?>
					<?php }else{ ?> <?php $_smarty_tpl->tpl_vars["mod"] = new Smarty_variable("mandat", null, null);?> <?php }?>
					<p>
						<a href="<?php echo tools::create_url($_smarty_tpl->getVariable('user')->value,$_smarty_tpl->getVariable('mod')->value,'see',$_smarty_tpl->getVariable('m')->value->getIdMandate());?>
">Voir</a>
					</p>
				</td>
				<td><p>
						<?php if ($_smarty_tpl->getVariable('m')->value->getPictureByDefault()){?> <img
							src="<?php echo Constant::DEFAULT_URL_PICTURE_MODULE_DIRECTORY;?>
<?php if ($_smarty_tpl->getVariable('m')->value->getMandateType()->getIdMandateType()==Constant::ID_PLOT_OF_LAND){?>terrain<?php }else{ ?>mandat<?php }?>/thumb/<?php echo $_smarty_tpl->getVariable('m')->value->getPictureByDefault()->getName();?>
"
							alt=""  /><?php }else{ ?>NC<?php }?>
					</p></td> <?php  $_smarty_tpl->tpl_vars['pa'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('listPasserelle')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['pa']->key => $_smarty_tpl->tpl_vars['pa']->value){
?>
				<td> 
					<p>
						<input type="hidden"
							name="hidden_<?php echo $_smarty_tpl->getVariable('pa')->value->getIdPasserelle();?>
_<?php echo $_smarty_tpl->getVariable('m')->value->getIdMandate();?>
"
							value="" /> <input type="checkbox" rel="<?php echo $_smarty_tpl->getVariable('pa')->value->getIdPasserelle();?>
"
							name="export_<?php echo $_smarty_tpl->getVariable('pa')->value->getIdPasserelle();?>
_<?php echo $_smarty_tpl->getVariable('m')->value->getIdMandate();?>
"
							<?php if ($_smarty_tpl->getVariable('pa')->value->isLinked($_smarty_tpl->tpl_vars['m']->value)){?> checked="checked" <?php }?> value="1"/>
					</p> </td> <?php }} ?>
			</tr>
			<?php }} ?>
		</tbody>
	</table>

</form>
</div>
