<?php /* Smarty version Smarty-3.0.6, created on 2012-10-16 16:01:36
         compiled from "/var/www/aptana/extra-immo/modules/contacts/views/listContact.tpl" */ ?>
<?php /*%%SmartyHeaderCode:212859414507d68c0a49359-27065076%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '02278c7d0fc5ce1d47c4d587101e4862156af149' => 
    array (
      0 => '/var/www/aptana/extra-immo/modules/contacts/views/listContact.tpl',
      1 => 1350396095,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '212859414507d68c0a49359-27065076',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<?php $_template = new Smarty_Internal_Template("tpl_default/entete.tpl", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate();?><?php $_template->updateParentVariables(0);?><?php unset($_template);?>
<h1><?php echo $_smarty_tpl->getVariable('title')->value;?>
</h1>
<table class="standard">

	<thead>
		<tr>
			<th>Nom</th>  
			<th>Catégories</th>
			<th>Voir</th>
		</tr>
	</thead>

	<tbody>
		<?php  $_smarty_tpl->tpl_vars['i'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('listContact')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['i']->key => $_smarty_tpl->tpl_vars['i']->value){
?>
		<tr>
			<td><?php echo $_smarty_tpl->tpl_vars['i']->value['name'];?>
</td>
			 
			<td>
			<?php  $_smarty_tpl->tpl_vars['item'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('i')->value['obj']->listCategories(); if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['item']->key => $_smarty_tpl->tpl_vars['item']->value){
?>
				<p class="inlineBlock bulle"><?php echo $_smarty_tpl->getVariable('item')->value->getName();?>
</p>
			<?php }} ?>

</td>
			<td><a
				href="<?php echo Tools::create_url($_smarty_tpl->getVariable('user')->value,'contacts','see',$_smarty_tpl->getVariable('i')->value['obj']->getIdContact());?>
" title="<?php echo Lang::LABEL_SEE;?>
"><img src="<?php echo Constant::DEFAULT_URL_PICTURE_DIRECTORY;?>
see.png" alt="<?php echo Lang::LABEL_SEE;?>
" /></a>
			</td>
		</tr>
		<?php }} ?>
	</tbody>
</table>
</div>
