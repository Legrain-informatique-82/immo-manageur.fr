<?php /* Smarty version Smarty-3.0.6, created on 2013-07-22 15:04:12
         compiled from "/var/www/aptana/extra-immo/modules/seller/views/list_seller.tpl" */ ?>
<?php /*%%SmartyHeaderCode:152631404251ed2dcc018f28-44421258%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '339081390db1ccb34e5a417f763e6ef04dc75112' => 
    array (
      0 => '/var/www/aptana/extra-immo/modules/seller/views/list_seller.tpl',
      1 => 1369380721,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '152631404251ed2dcc018f28-44421258',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<?php $_template = new Smarty_Internal_Template("tpl_default/entete.tpl", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate();?><?php $_template->updateParentVariables(0);?><?php unset($_template);?>
<h1><?php echo Lang::LABEL_SELLER_LIST_H1;?>
</h1>

<form action="" method="post">
	<p>
		<label for="seeAsset">Afficher les inactifs : <input
			<?php if ($_POST['seeAsset']=='on'){?> checked="checked"
			<?php }?>type="checkbox" value="on" name="seeAsset" id="seeAsset" /> </label>
		<input type="submit" name="actSeeAsset" value="actualiser"
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
 $_from = $_smarty_tpl->getVariable('list')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['item']->key => $_smarty_tpl->tpl_vars['item']->value){
?>
		<tr>
			<td><?php echo $_smarty_tpl->tpl_vars['item']->value['name'];?>
</td>
			<td><?php echo $_smarty_tpl->tpl_vars['item']->value['title'];?>
</td>
			<td><?php echo $_smarty_tpl->tpl_vars['item']->value['user'];?>
</td>
			<td><?php if ($_smarty_tpl->tpl_vars['item']->value['phone']['phone']){?>
				<p><?php echo Lang::LABEL_SELLER_ADD_PHONE;?>
<?php echo $_smarty_tpl->tpl_vars['item']->value['phone']['phone'];?>
</p><?php }?> <?php if ($_smarty_tpl->tpl_vars['item']->value['phone']['mobilPhone']){?>
				<p><?php echo Lang::LABEL_SELLER_ADD_MOBIL_PHONE;?>
<?php echo $_smarty_tpl->tpl_vars['item']->value['phone']['mobilPhone'];?>
</p><?php }?>
				<?php if ($_smarty_tpl->tpl_vars['item']->value['phone']['workPhone']){?>
				<p><?php echo Lang::LABEL_SELLER_ADD_WORK_PHONE;?>
<?php echo $_smarty_tpl->tpl_vars['item']->value['phone']['workPhone'];?>
</p><?php }?>
			</td>
			<td><?php echo $_smarty_tpl->tpl_vars['item']->value['email'];?>
</td>
			<td><?php if ($_smarty_tpl->tpl_vars['item']->value['idUser']==$_smarty_tpl->getVariable('user')->value->getIdUser()||$_smarty_tpl->getVariable('user')->value->getLevelMember()->getIdLevelMember()<3){?> <a
				href="<?php echo $_smarty_tpl->tpl_vars['item']->value['urlUpdate'];?>
" title="<?php echo lang::LABEL_UPDATE;?>
"><img src="<?php echo Constant::DEFAULT_URL_PICTURE_DIRECTORY;?>
update.png" alt="<?php echo lang::LABEL_UPDATE;?>
" /></a> <?php }else{ ?> _ <?php }?></td>
			<td><?php if ($_smarty_tpl->tpl_vars['item']->value['idUser']==$_smarty_tpl->getVariable('user')->value->getIdUser()||$_smarty_tpl->getVariable('user')->value->getLevelMember()->getIdLevelMember()<3){?> <a
				class="jsdelSeller" rel="<?php echo $_smarty_tpl->tpl_vars['item']->value['id'];?>
" href="<?php echo $_smarty_tpl->tpl_vars['item']->value['urlDelete'];?>
" title="<?php echo Lang::LABEL_DELETE;?>
"><img src="<?php echo Constant::DEFAULT_URL_PICTURE_DIRECTORY;?>
delete.png" alt="<?php echo Lang::LABEL_DELETE;?>
" /></a>
				<?php }else{ ?> _ <?php }?></td>
			<td><?php if ($_smarty_tpl->tpl_vars['item']->value['idUser']==$_smarty_tpl->getVariable('user')->value->getIdUser()||$_smarty_tpl->getVariable('user')->value->getLevelMember()->getIdLevelMember()<3){?> <a
				href="<?php echo $_smarty_tpl->tpl_vars['item']->value['urlSee'];?>
" <?php if ($_smarty_tpl->getVariable('user')->value->getOpenInNewTab()){?> target="_blank"<?php }?>><img src="<?php echo Constant::DEFAULT_URL_PICTURE_DIRECTORY;?>
see.png" alt="<?php echo Lang::LABEL_SEE;?>
" /></a> <?php }else{ ?> _ <?php }?></td>
		</tr>
		<?php }} ?>
	</tbody>
</table>
</div>
