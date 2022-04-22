<?php /* Smarty version Smarty-3.0.6, created on 2013-05-24 09:52:38
         compiled from "/var/www/aptana/extra-immo/modules/tpl_default/menu.tpl" */ ?>
<?php /*%%SmartyHeaderCode:1909702836519f1c46c741c5-29873409%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'd691a3aa08bec64bed29c4b03c1e19e5360989ab' => 
    array (
      0 => '/var/www/aptana/extra-immo/modules/tpl_default/menu.tpl',
      1 => 1369380374,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1909702836519f1c46c741c5-29873409',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_smarty_tpl->getVariable('menu')->value){?> <?php if ($_smarty_tpl->getVariable('h1')->value){?>
<h1><?php echo $_smarty_tpl->getVariable('h1')->value;?>
</h1>
<?php }?>
<ul <?php if ($_smarty_tpl->getVariable('idMenu')->value){?>id="<?php echo $_smarty_tpl->getVariable('idMenu')->value;?>
" <?php }?> <?php if ($_smarty_tpl->getVariable('classMenu')->value){?>class="<?php echo $_smarty_tpl->getVariable('classMenu')->value;?>
"<?php }?>>
	<?php  $_smarty_tpl->tpl_vars['item'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('menu')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['item']->key => $_smarty_tpl->tpl_vars['item']->value){
?>
	<li><a
		class="<?php if ($_smarty_tpl->tpl_vars['item']->value['url']==Tools::create_url($_smarty_tpl->getVariable('user')->value,$_GET['module'],$_GET['page'],$_GET['action'])){?>actif<?php }?><?php if ($_smarty_tpl->tpl_vars['item']->value['moduleName']==$_GET['module']){?> actifM<?php }?>"
		href="<?php echo $_smarty_tpl->tpl_vars['item']->value['url'];?>
"><?php if ($_smarty_tpl->tpl_vars['item']->value['logo']){?><img src="<?php echo $_smarty_tpl->tpl_vars['item']->value['logo'];?>
" alt="" /> <?php }?><span><?php echo $_smarty_tpl->tpl_vars['item']->value['libelle'];?>
</span></a></li> <?php }} ?>
</ul>
<hr class="invi clear" />
<?php }?>
