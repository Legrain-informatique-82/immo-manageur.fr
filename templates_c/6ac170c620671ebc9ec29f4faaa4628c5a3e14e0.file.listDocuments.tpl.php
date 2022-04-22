<?php /* Smarty version Smarty-3.0.6, created on 2013-04-11 09:26:41
         compiled from "/var/www/aptana/extra-immo/modules/documents/views/listDocuments.tpl" */ ?>
<?php /*%%SmartyHeaderCode:1401468486516665b105cc52-95704541%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '6ac170c620671ebc9ec29f4faaa4628c5a3e14e0' => 
    array (
      0 => '/var/www/aptana/extra-immo/modules/documents/views/listDocuments.tpl',
      1 => 1328712170,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1401468486516665b105cc52-95704541',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<?php $_template = new Smarty_Internal_Template("tpl_default/entete.tpl", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate();?><?php $_template->updateParentVariables(0);?><?php unset($_template);?>

<table class="standard">
<thead>
<tr>
<th>Nom</th>
<th>Modifier</th>
</tr>
</thead>
<tbody>
<?php  $_smarty_tpl->tpl_vars['document'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('documents')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['document']->key => $_smarty_tpl->tpl_vars['document']->value){
?>
<tr>
	<td><?php echo substr($_smarty_tpl->getVariable('document')->value->getCorps(),0,350);?>
 ...</td>
	<td><a
				href="<?php echo Tools::create_url($_smarty_tpl->getVariable('user')->value,$_GET['module'],'updDoc',$_smarty_tpl->getVariable('document')->value->getId());?>
"title="<?php echo Lang::LABEL_UPDATE;?>
"><img src="<?php echo Constant::DEFAULT_URL_PICTURE_DIRECTORY;?>
update.png" alt="<?php echo Lang::LABEL_UPDATE;?>
" /></a></td>
</tr>
<?php }} ?>
</tbody>
</table>
</div>
