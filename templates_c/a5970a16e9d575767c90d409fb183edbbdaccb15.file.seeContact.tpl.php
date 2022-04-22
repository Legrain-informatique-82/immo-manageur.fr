<?php /* Smarty version Smarty-3.0.6, created on 2012-10-16 15:56:05
         compiled from "/var/www/aptana/extra-immo/modules/contacts/views/seeContact.tpl" */ ?>
<?php /*%%SmartyHeaderCode:2043875223507d677521ceb0-73986812%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'a5970a16e9d575767c90d409fb183edbbdaccb15' => 
    array (
      0 => '/var/www/aptana/extra-immo/modules/contacts/views/seeContact.tpl',
      1 => 1350395763,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '2043875223507d677521ceb0-73986812',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<?php $_template = new Smarty_Internal_Template("tpl_default/entete.tpl", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate();?><?php $_template->updateParentVariables(0);?><?php unset($_template);?>
<h1><?php echo $_smarty_tpl->getVariable('title')->value;?>
</h1>
<form action="" method="post">
	<div class="quatreVingt">
		<div class="accordion">
		<h2><a href="#">Catégories</a></h2>
		<div>
		<?php  $_smarty_tpl->tpl_vars['cat'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('categories')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
 $_smarty_tpl->tpl_vars['cat']->index=-1;
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['cat']->key => $_smarty_tpl->tpl_vars['cat']->value){
 $_smarty_tpl->tpl_vars['cat']->index++;
 $_smarty_tpl->tpl_vars['cat']->first = $_smarty_tpl->tpl_vars['cat']->index === 0;
 $_smarty_tpl->tpl_vars['smarty']->value['foreach']['boucle']['first'] = $_smarty_tpl->tpl_vars['cat']->first;
?>
			<?php if ($_smarty_tpl->getVariable('smarty')->value['foreach']['boucle']['first']){?> <p>Catégorie(s) associée(s) au contact :  </p> <?php }?>
		<p class="inlineBlock bulle"><?php echo $_smarty_tpl->getVariable('cat')->value->getName();?>
</p>
		<?php }} else { ?>
		<p>Aucune catégorie associée à ce contact</p>
		<?php } ?>

</div>
			<?php  $_smarty_tpl->tpl_vars['tc'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('listTC')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['tc']->key => $_smarty_tpl->tpl_vars['tc']->value){
?>
			<h2>
				<a href="#"><?php echo $_smarty_tpl->getVariable('tc')->value->getLibel();?>
</a>
			</h2>
			<div>

				<?php  $_smarty_tpl->tpl_vars['cc'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('listCC')->value[$_smarty_tpl->getVariable('tc')->value->getIdTypeChampsContact()]; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
 $_smarty_tpl->tpl_vars['cc']->index=-1;
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['cc']->key => $_smarty_tpl->tpl_vars['cc']->value){
 $_smarty_tpl->tpl_vars['cc']->index++;
 $_smarty_tpl->tpl_vars['cc']->first = $_smarty_tpl->tpl_vars['cc']->index === 0;
 $_smarty_tpl->tpl_vars['smarty']->value['foreach']['boucle']['first'] = $_smarty_tpl->tpl_vars['cc']->first;
?>
				<p><?php echo $_smarty_tpl->getVariable('cc')->value->getLibel();?>
 : <?php echo $_smarty_tpl->getVariable('cc')->value->getVal();?>
</p>
				<?php }} ?>
			</div>
			<?php }} ?>

		</div>
	</div>
	<div class="colDte">
		<p>
			<a 
				href="<?php echo Tools::create_url($_smarty_tpl->getVariable('user')->value,'contacts','upd',$_GET['action']);?>
">Modifier
				le contact</a>
		</p>
		<p>
			<a
				href="<?php echo Tools::create_url($_smarty_tpl->getVariable('user')->value,'contacts','del',$_GET['action']);?>
">supprimer
				le contact</a>
		</p>
		<p>
			<a href="<?php echo Tools::create_url($_smarty_tpl->getVariable('user')->value,'contacts','list');?>
">Revenir à la
				liste</a>
		</p>

	</div>
</form>
</div>
