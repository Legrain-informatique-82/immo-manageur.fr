<?php /* Smarty version Smarty-3.0.6, created on 2013-05-24 09:52:35
         compiled from "/var/www/aptana/extra-immo/modules/accueil/views/accueil.tpl" */ ?>
<?php /*%%SmartyHeaderCode:497769123519f1c43859cf2-73343837%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '0f9c925e5272919aab089f10aae4d0eb27426cfc' => 
    array (
      0 => '/var/www/aptana/extra-immo/modules/accueil/views/accueil.tpl',
      1 => 1369380402,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '497769123519f1c43859cf2-73343837',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>

<div id="content">
	<div id="blocAccueil">
	<?php $_smarty_tpl->tpl_vars['init'] = new Smarty_variable('true', null, null);?>
	
	<div id="accueilB5">
	
		<?php  $_smarty_tpl->tpl_vars['item'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('menuAccueil')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
 $_smarty_tpl->tpl_vars['item']->total= $_smarty_tpl->_count($_from);
 $_smarty_tpl->tpl_vars['item']->iteration=0;
 $_smarty_tpl->tpl_vars['smarty']->value['foreach']["boucle"]['index']=-1;
if ($_smarty_tpl->tpl_vars['item']->total > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['item']->key => $_smarty_tpl->tpl_vars['item']->value){
 $_smarty_tpl->tpl_vars['item']->iteration++;
 $_smarty_tpl->tpl_vars['item']->last = $_smarty_tpl->tpl_vars['item']->iteration === $_smarty_tpl->tpl_vars['item']->total;
 $_smarty_tpl->tpl_vars['smarty']->value['foreach']["boucle"]['index']++;
 $_smarty_tpl->tpl_vars['smarty']->value['foreach']["boucle"]['last'] = $_smarty_tpl->tpl_vars['item']->last;
?>	
		<a href="<?php echo $_smarty_tpl->tpl_vars['item']->value['url'];?>
" rel="<?php echo $_smarty_tpl->tpl_vars['item']->value['module'];?>
"> <?php if ($_smarty_tpl->tpl_vars['item']->value['logo']){?> <img src="<?php echo $_smarty_tpl->tpl_vars['item']->value['logo'];?>
" title="<?php echo $_smarty_tpl->tpl_vars['item']->value['libelle'];?>
" /> <?php }?><span> <?php if (empty($_smarty_tpl->tpl_vars['item']->value['short_libel'])){?><?php echo $_smarty_tpl->tpl_vars['item']->value['libelle'];?>
<?php }else{ ?><?php echo $_smarty_tpl->tpl_vars['item']->value['short_libel'];?>
<?php }?></span> </a>
		 <?php }} ?>
		 
		 </div><!-- Fin de B5 -->
		 

 
</div>

		<?php $_template = new Smarty_Internal_Template("tpl_default/hook.tpl", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
$_template->assign('position',"hook_header"); echo $_template->getRenderedTemplate();?><?php $_template->updateParentVariables(0);?><?php unset($_template);?>
	
</div>





