<?php /* Smarty version Smarty-3.0.6, created on 2012-10-16 16:48:46
         compiled from "/var/www/aptana/extra-immo/modules/contacts/views/delC.tpl" */ ?>
<?php /*%%SmartyHeaderCode:674500632507d73ce3dc026-77412678%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'b499da6acc61e090b0fd9dfb13aaf67f6673d5b6' => 
    array (
      0 => '/var/www/aptana/extra-immo/modules/contacts/views/delC.tpl',
      1 => 1350398923,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '674500632507d73ce3dc026-77412678',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<?php $_template = new Smarty_Internal_Template("tpl_default/entete.tpl", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate();?><?php $_template->updateParentVariables(0);?><?php unset($_template);?>
<h1><?php echo $_smarty_tpl->getVariable('title')->value;?>
</h1>
<div class="bulle">
<p>Êtes-vous certain de vouloir supprimer la catégorie <?php echo $_smarty_tpl->getVariable('cat')->value->getNAme();?>
</p>
<?php if ($_smarty_tpl->getVariable('listContact')->value){?>
<p>Elle est actuellement utilisée par : </p>
<ul>
<?php  $_smarty_tpl->tpl_vars['c'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('listContact')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['c']->key => $_smarty_tpl->tpl_vars['c']->value){
?>
<li><?php echo $_smarty_tpl->tpl_vars['c']->value;?>
</li>
<?php }} ?> 
</ul>
<?php }else{ ?>
<p>Cette catégorie n'est pas utilisée</p>
<?php }?>

<form action="" method="post">
<p><input type="submit" value="Confirmer" name="submit"/> <input type="submit" value="Annuler" name="cancel"/></p>
</form>
</div>
</div>