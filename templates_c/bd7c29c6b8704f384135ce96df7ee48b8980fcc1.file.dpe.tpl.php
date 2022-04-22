<?php /* Smarty version Smarty-3.0.6, created on 2013-05-24 09:52:47
         compiled from "/var/www/aptana/extra-immo/modules/mandat/modules/dpe/views/dpe.tpl" */ ?>
<?php /*%%SmartyHeaderCode:132638213519f1c4f0832c3-48420752%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'bd7c29c6b8704f384135ce96df7ee48b8980fcc1' => 
    array (
      0 => '/var/www/aptana/extra-immo/modules/mandat/modules/dpe/views/dpe.tpl',
      1 => 1369380340,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '132638213519f1c4f0832c3-48420752',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<p id="blocImgDpe">
	<?php if ($_smarty_tpl->getVariable('ces')->value){?> <img src="<?php echo $_smarty_tpl->getVariable('ces')->value;?>
" alt="ces" /> <?php }?> <?php if ($_smarty_tpl->getVariable('ges')->value){?> <img
		src="<?php echo $_smarty_tpl->getVariable('ges')->value;?>
" alt="ges" /> <?php }?>
</p>
