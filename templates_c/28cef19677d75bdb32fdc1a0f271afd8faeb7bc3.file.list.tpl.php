<?php /* Smarty version Smarty-3.0.6, created on 2014-05-20 08:52:24
         compiled from "/var/www/aptana/immo-manageur.fr/modules/notary/views/list.tpl" */ ?>
<?php /*%%SmartyHeaderCode:426962800537afba845e2b5-37305068%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '28cef19677d75bdb32fdc1a0f271afd8faeb7bc3' => 
    array (
      0 => '/var/www/aptana/immo-manageur.fr/modules/notary/views/list.tpl',
      1 => 1369380662,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '426962800537afba845e2b5-37305068',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<?php $_template = new Smarty_Internal_Template("tpl_default/entete.tpl", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate();?><?php $_template->updateParentVariables(0);?><?php unset($_template);?>
<h1><?php echo Lang::LABEL_NOTARY_LIST_H1;?>
</h1>



<table class="standard">
	<thead>
		<tr>
			<th>Nom &amp; prénom</th>
			<th>Téléphones</th>
			<th>Email</th>
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
			<td><?php if ($_smarty_tpl->tpl_vars['item']->value['number'][0]){?>
				<p><?php echo Lang::LABEL_NOTARY_ADD_PHONE;?>
<?php echo $_smarty_tpl->tpl_vars['item']->value['number'][0];?>
</p><?php }?> <?php if ($_smarty_tpl->tpl_vars['item']->value['number'][1]){?>
				<p><?php echo Lang::LABEL_NOTARY_ADD_MOBIL_PHONE;?>
<?php echo $_smarty_tpl->tpl_vars['item']->value['number'][1];?>
</p><?php }?>
				<?php if ($_smarty_tpl->tpl_vars['item']->value['number'][2]){?>
				<p><?php echo Lang::LABEL_NOTARY_ADD_JOB_PHONE;?>
<?php echo $_smarty_tpl->tpl_vars['item']->value['number'][2];?>
</p><?php }?></td>
			<td><?php echo $_smarty_tpl->tpl_vars['item']->value['email'];?>
</td>
			<td><a href="<?php echo $_smarty_tpl->tpl_vars['item']->value['urlUpdate'];?>
" title="<?php echo Lang::LABEL_UPDATE;?>
"><img src="<?php echo Constant::DEFAULT_URL_PICTURE_DIRECTORY;?>
update.png" alt="<?php echo Lang::LABEL_UPDATE;?>
" /></a></td>
			<td><a class="jsDelNotary" rel="<?php echo $_smarty_tpl->tpl_vars['item']->value['id'];?>
" href="<?php echo $_smarty_tpl->tpl_vars['item']->value['urlDelete'];?>
" title="<?php echo Lang::LABEL_DELETE;?>
"><img src="<?php echo Constant::DEFAULT_URL_PICTURE_DIRECTORY;?>
delete.png" alt="<?php echo Lang::LABEL_DELETE;?>
" /></a>
			</td>
			<td><a href="<?php echo $_smarty_tpl->tpl_vars['item']->value['urlSee'];?>
" title="<?php echo Lang::LABEL_SEE;?>
" <?php if ($_smarty_tpl->getVariable('user')->value->getOpenInNewTab()){?> target="_blank"<?php }?>><img src="<?php echo Constant::DEFAULT_URL_PICTURE_DIRECTORY;?>
see.png" alt="<?php echo Lang::LABEL_SEE;?>
" /></a></td>
		</tr>
		<?php }} ?>
	</tbody>

</table>
</div>
