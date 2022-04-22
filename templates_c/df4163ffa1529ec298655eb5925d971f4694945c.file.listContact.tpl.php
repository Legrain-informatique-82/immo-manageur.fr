<?php /* Smarty version Smarty-3.0.6, created on 2014-05-20 08:50:28
         compiled from "/var/www/aptana/immo-manageur.fr/modules/contacts/views/listContact.tpl" */ ?>
<?php /*%%SmartyHeaderCode:357858327537afb34a7b0c2-21257073%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'df4163ffa1529ec298655eb5925d971f4694945c' => 
    array (
      0 => '/var/www/aptana/immo-manageur.fr/modules/contacts/views/listContact.tpl',
      1 => 1369380509,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '357858327537afb34a7b0c2-21257073',
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
