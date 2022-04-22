<?php /* Smarty version Smarty-3.0.6, created on 2013-05-24 09:52:35
         compiled from "/var/www/aptana/extra-immo/modules/tpl_default/menuVertical.tpl" */ ?>
<?php /*%%SmartyHeaderCode:817884893519f1c4371caa0-27620825%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'b41644468fc38f621f4ffac81f07d0a02984452a' => 
    array (
      0 => '/var/www/aptana/extra-immo/modules/tpl_default/menuVertical.tpl',
      1 => 1369380374,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '817884893519f1c4371caa0-27620825',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>


<?php if ($_smarty_tpl->getVariable('menu')->value){?> 
<ul id="menuVertical" class="<?php if ($_smarty_tpl->getVariable('classMenu')->value){?><?php echo $_smarty_tpl->getVariable('classMenu')->value;?>
 <?php }?><?php if ($_SESSION['etatMenuVertical']!='repli'){?>depli<?php }else{ ?>repli<?php }?>">
	<?php  $_smarty_tpl->tpl_vars['item'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('menu')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
 $_smarty_tpl->tpl_vars['item']->total= $_smarty_tpl->_count($_from);
 $_smarty_tpl->tpl_vars['item']->iteration=0;
 $_smarty_tpl->tpl_vars['item']->index=-1;
 $_smarty_tpl->tpl_vars['smarty']->value['foreach']["monMenu"]['iteration']=0;
if ($_smarty_tpl->tpl_vars['item']->total > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['item']->key => $_smarty_tpl->tpl_vars['item']->value){
 $_smarty_tpl->tpl_vars['item']->iteration++;
 $_smarty_tpl->tpl_vars['item']->index++;
 $_smarty_tpl->tpl_vars['item']->first = $_smarty_tpl->tpl_vars['item']->index === 0;
 $_smarty_tpl->tpl_vars['item']->last = $_smarty_tpl->tpl_vars['item']->iteration === $_smarty_tpl->tpl_vars['item']->total;
 $_smarty_tpl->tpl_vars['smarty']->value['foreach']["monMenu"]['first'] = $_smarty_tpl->tpl_vars['item']->first;
 $_smarty_tpl->tpl_vars['smarty']->value['foreach']["monMenu"]['iteration']++;
 $_smarty_tpl->tpl_vars['smarty']->value['foreach']["monMenu"]['last'] = $_smarty_tpl->tpl_vars['item']->last;
?>
	<li><a id="menuPrincipal_lien_<?php echo $_smarty_tpl->getVariable('smarty')->value['foreach']['monMenu']['iteration'];?>
"
		class="<?php if ($_smarty_tpl->tpl_vars['item']->value['url']==Tools::create_url($_smarty_tpl->getVariable('user')->value,$_GET['module'],$_GET['page'],$_GET['action'])){?>actif<?php }?><?php if ($_smarty_tpl->tpl_vars['item']->value['moduleName']==$_GET['module']){?> actifM<?php }?> <?php if ($_smarty_tpl->getVariable('smarty')->value['foreach']['monMenu']['first']){?> first<?php }?><?php if ($_smarty_tpl->getVariable('smarty')->value['foreach']['monMenu']['last']){?> last<?php }?>"
		href="<?php echo $_smarty_tpl->tpl_vars['item']->value['url'];?>
" title="<?php echo $_smarty_tpl->tpl_vars['item']->value['libelle'];?>
">
		<?php if ($_smarty_tpl->tpl_vars['item']->value['logo']){?><img src="<?php echo $_smarty_tpl->tpl_vars['item']->value['logo'];?>
" alt="<?php echo $_smarty_tpl->tpl_vars['item']->value['libelle'];?>
" /><?php }else{ ?><img src="<?php echo Constant::DEFAULT_URL_LOGO_MODULES;?>
" alt="<?php echo $_smarty_tpl->tpl_vars['item']->value['libelle'];?>
" /><?php }?>

</a></li> <?php }} ?>
</ul>

<?php }?>