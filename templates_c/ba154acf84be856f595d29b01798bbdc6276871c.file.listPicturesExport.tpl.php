<?php /* Smarty version Smarty-3.0.6, created on 2012-07-19 09:43:52
         compiled from "/var/www/aptana/extra-immo/modules/terrain/modules/export/views/listPicturesExport.tpl" */ ?>
<?php /*%%SmartyHeaderCode:10340947955007bab85fd776-09040344%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'ba154acf84be856f595d29b01798bbdc6276871c' => 
    array (
      0 => '/var/www/aptana/extra-immo/modules/terrain/modules/export/views/listPicturesExport.tpl',
      1 => 1320918805,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '10340947955007bab85fd776-09040344',
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
