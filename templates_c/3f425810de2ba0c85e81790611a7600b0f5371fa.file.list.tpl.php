<?php /* Smarty version Smarty-3.0.6, created on 2012-08-16 12:28:13
         compiled from "/var/www/aptana/extra-immo/modules/acquereur/views/list.tpl" */ ?>
<?php /*%%SmartyHeaderCode:2080778834502ccb3d079691-11610361%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '3f425810de2ba0c85e81790611a7600b0f5371fa' => 
    array (
      0 => '/var/www/aptana/extra-immo/modules/acquereur/views/list.tpl',
      1 => 1325604291,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '2080778834502ccb3d079691-11610361',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<?php $_template = new Smarty_Internal_Template("tpl_default/entete.tpl", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate();?><?php $_template->updateParentVariables(0);?><?php unset($_template);?>
<h1>Liste des acquereurs</h1>

<form action="" method="post">
	<p>
		<label for="seeAssetAc">Afficher les inactifs : <input
			<?php if ($_POST['seeAssetAc']=='on'){?> checked="checked"
			<?php }?>type="checkbox" value="on" name="seeAssetAc" id="seeAssetAc" />
		</label> <input type="submit" name="actSeeAsset" value="actualiser"
			class="jsNone" />
	</p>

</form>
<table class="standard">
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
	<tbody>
		<?php  $_smarty_tpl->tpl_vars['item'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('listAcq')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['item']->key => $_smarty_tpl->tpl_vars['item']->value){
?>
		<tr>
			<td><?php echo $_smarty_tpl->getVariable('item')->value->getName();?>
 <?php echo $_smarty_tpl->getVariable('item')->value->getFirstname();?>
</td>
			<td><?php echo $_smarty_tpl->getVariable('item')->value->getTitreAcquereur()->getName();?>
</td>
			<td><?php echo $_smarty_tpl->getVariable('item')->value->getUser()->getFirstname();?>
 <?php echo $_smarty_tpl->getVariable('item')->value->getUser()->getName();?>

			</td>
			<td><?php if ($_smarty_tpl->getVariable('item')->value->getPhone()){?>
				<p><?php echo Lang::LABEL_SELLER_ADD_PHONE;?>
<?php echo $_smarty_tpl->getVariable('item')->value->getPhone();?>
</p><?php }?> <?php if ($_smarty_tpl->getVariable('item')->value->getMobilPhone()){?>
				<p><?php echo Lang::LABEL_SELLER_ADD_MOBIL_PHONE;?>
<?php echo $_smarty_tpl->getVariable('item')->value->getMobilPhone();?>
</p><?php }?>
				<?php if ($_smarty_tpl->getVariable('item')->value->getWorkPhone()){?>
				<p><?php echo Lang::LABEL_SELLER_ADD_WORK_PHONE;?>
<?php echo $_smarty_tpl->getVariable('item')->value->getWorkPhone();?>
</p><?php }?>
			</td>
			<td><?php echo $_smarty_tpl->getVariable('item')->value->getEmail();?>
</td>
			<td><?php if ($_smarty_tpl->getVariable('item')->value->getUser()->getIdUser()==$_smarty_tpl->getVariable('user')->value->getIdUser()||$_smarty_tpl->getVariable('user')->value->getLevelMember()->getIdLevelMember()<3){?> <a
				href="<?php echo Tools::create_url($_smarty_tpl->getVariable('user')->value,'acquereur','update',$_smarty_tpl->getVariable('item')->value->getIdAcquereur());?>
" title="<?php echo Lang::LABEL_UPDATE;?>
"><img src="<?php echo Constant::DEFAULT_URL_PICTURE_DIRECTORY;?>
update.png" alt="<?php echo Lang::LABEL_UPDATE;?>
" /></a>
				<?php }else{ ?> _ <?php }?></td>
			<td><?php if ($_smarty_tpl->getVariable('item')->value->getUser()->getIdUser()==$_smarty_tpl->getVariable('user')->value->getIdUser()||$_smarty_tpl->getVariable('user')->value->getLevelMember()->getIdLevelMember()<3){?> <a
				class="jsDelAcquereur" rel="<?php echo $_smarty_tpl->getVariable('item')->value->getIdAcquereur();?>
"
				href="<?php echo Tools::create_url($_smarty_tpl->getVariable('user')->value,'acquereur','delete',$_smarty_tpl->getVariable('item')->value->getIdAcquereur());?>
" title="<?php echo Lang::LABEL_DELETE;?>
"><img src="<?php echo Constant::DEFAULT_URL_PICTURE_DIRECTORY;?>
delete.png" alt="<?php echo Lang::LABEL_DELETE;?>
" /></a>
				<?php }else{ ?> _ <?php }?></td>
			<td><a
				href="<?php echo Tools::create_url($_smarty_tpl->getVariable('user')->value,'acquereur','see',$_smarty_tpl->getVariable('item')->value->getIdAcquereur());?>
" title="<?php echo Lang::LABEL_SEE;?>
" <?php if ($_smarty_tpl->getVariable('user')->value->getOpenInNewTab()){?> target="_blank"<?php }?>><img src="<?php echo Constant::DEFAULT_URL_PICTURE_DIRECTORY;?>
see.png" alt="<?php echo Lang::LABEL_SEE;?>
" /></a>

			</td>
		</tr>
		<?php }} ?>
	</tbody>
</table>
</div>
