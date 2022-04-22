<?php /* Smarty version Smarty-3.0.6, created on 2013-05-24 09:52:38
         compiled from "/var/www/aptana/extra-immo/modules/tpl_default/entete.tpl" */ ?>
<?php /*%%SmartyHeaderCode:139164462519f1c46c37143-00671366%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '6b3b809a1768497114ae61972ec5da1785b7d9f1' => 
    array (
      0 => '/var/www/aptana/extra-immo/modules/tpl_default/entete.tpl',
      1 => 1369380374,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '139164462519f1c46c37143-00671366',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>

<div id="left"><?php $_template = new Smarty_Internal_Template('tpl_default/menu.tpl', $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
$_template->assign('h1','');$_template->assign('menu',$_smarty_tpl->getVariable('menu')->value);$_template->assign('idMenu',"menu"); echo $_template->getRenderedTemplate();?><?php $_template->updateParentVariables(0);?><?php unset($_template);?>
<?php if ($_smarty_tpl->getVariable('hook')->value['hook_leftList']){?>  
	<ul>
		<?php $_template = new Smarty_Internal_Template("tpl_default/hook.tpl", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
$_template->assign('position',"hook_leftList"); echo $_template->getRenderedTemplate();?><?php $_template->updateParentVariables(0);?><?php unset($_template);?>
	</ul>
	<?php }?>
<?php if ($_smarty_tpl->getVariable('hook')->value['hook_left']){?>	
	<?php $_template = new Smarty_Internal_Template("tpl_default/hook.tpl", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
$_template->assign('position',"hook_left"); echo $_template->getRenderedTemplate();?><?php $_template->updateParentVariables(0);?><?php unset($_template);?>
<?php }?>
	</div>
<div id="right"><?php $_template = new Smarty_Internal_Template("tpl_default/hook.tpl", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
$_template->assign('position',"hook_header"); echo $_template->getRenderedTemplate();?><?php $_template->updateParentVariables(0);?><?php unset($_template);?>
