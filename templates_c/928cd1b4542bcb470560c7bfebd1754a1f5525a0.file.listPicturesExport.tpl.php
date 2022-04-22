<?php /* Smarty version Smarty-3.0.6, created on 2013-05-24 09:52:47
         compiled from "/var/www/aptana/extra-immo/modules/mandat/modules/export/views/listPicturesExport.tpl" */ ?>
<?php /*%%SmartyHeaderCode:1923856972519f1c4f054001-08182795%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '928cd1b4542bcb470560c7bfebd1754a1f5525a0' => 
    array (
      0 => '/var/www/aptana/extra-immo/modules/mandat/modules/export/views/listPicturesExport.tpl',
      1 => 1369380362,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1923856972519f1c4f054001-08182795',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<div>
	<?php  $_smarty_tpl->tpl_vars['i'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('photosExportees')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['i']->key => $_smarty_tpl->tpl_vars['i']->value){
?>
	<p class="miniExport">
		<img
			src="<?php echo Constant::DEFAULT_URL_PICTURE_MODULE_DIRECTORY;?>
<?php echo $_GET['module'];?>
/thumb/<?php echo $_smarty_tpl->getVariable('i')->value->getName();?>
"
			alt="" /> <br /> <?php echo $_smarty_tpl->getVariable('i')->value->getPosition();?>

	</p>
	<?php }} else { ?>
	<p>Aucune photo exportée.</p>
	<?php } ?>
	<hr class="clear invi" />
</div>
