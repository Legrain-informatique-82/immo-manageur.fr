<?php /* Smarty version Smarty-3.0.6, created on 2012-10-16 11:40:07
         compiled from "/var/www/aptana/extra-immo/modules/contacts/views/listC.tpl" */ ?>
<?php /*%%SmartyHeaderCode:816393470507d2b77e56a29-67610722%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '196ebed2513ab152341389650b2be58eb1941715' => 
    array (
      0 => '/var/www/aptana/extra-immo/modules/contacts/views/listC.tpl',
      1 => 1350380405,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '816393470507d2b77e56a29-67610722',
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
			<th>Modifier</th>
			<th>Supprimer</th> 
			
		</tr>
	</thead>

	<tbody>
		<?php  $_smarty_tpl->tpl_vars['i'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('lc')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['i']->key => $_smarty_tpl->tpl_vars['i']->value){
?>
		<tr>
			<td><?php echo $_smarty_tpl->getVariable('i')->value->getName();?>
</td>
			<td><a
				href="<?php echo Tools::create_url($_smarty_tpl->getVariable('user')->value,'contacts','updC',$_smarty_tpl->getVariable('i')->value->getIdcategorycontact());?>
"><img src="<?php echo Constant::DEFAULT_URL_PICTURE_DIRECTORY;?>
update.png" alt="<?php echo Lang::LABEL_UPDATE;?>
" /></a>
			</td>
			<td><a
				href="<?php echo Tools::create_url($_smarty_tpl->getVariable('user')->value,'contacts','delC',$_smarty_tpl->getVariable('i')->value->getIdcategorycontact());?>
"><img src="<?php echo Constant::DEFAULT_URL_PICTURE_DIRECTORY;?>
delete.png" alt="<?php echo Lang::LABEL_DELETE;?>
" /></a>
			</td> 
		</tr>
		<?php }} ?>
	</tbody>
</table>
</div>
