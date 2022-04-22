<?php /* Smarty version Smarty-3.0.6, created on 2014-09-12 11:48:47
         compiled from "/var/www/aptana/immo-manageur.fr/modules/tpl_default/viewsErrors.tpl" */ ?>
<?php /*%%SmartyHeaderCode:19879737545412c17fcfff78-31356375%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '9f43610fe1045c1b6a68d0b0df8b9c290021b201' => 
    array (
      0 => '/var/www/aptana/immo-manageur.fr/modules/tpl_default/viewsErrors.tpl',
      1 => 1410515319,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '19879737545412c17fcfff78-31356375',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_smarty_tpl->getVariable('error')->value){?>
    <?php  $_smarty_tpl->tpl_vars['item'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('error')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
 $_smarty_tpl->tpl_vars['item']->total= $_smarty_tpl->_count($_from);
 $_smarty_tpl->tpl_vars['item']->iteration=0;
 $_smarty_tpl->tpl_vars['item']->index=-1;
if ($_smarty_tpl->tpl_vars['item']->total > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['item']->key => $_smarty_tpl->tpl_vars['item']->value){
 $_smarty_tpl->tpl_vars['item']->iteration++;
 $_smarty_tpl->tpl_vars['item']->index++;
 $_smarty_tpl->tpl_vars['item']->first = $_smarty_tpl->tpl_vars['item']->index === 0;
 $_smarty_tpl->tpl_vars['item']->last = $_smarty_tpl->tpl_vars['item']->iteration === $_smarty_tpl->tpl_vars['item']->total;
 $_smarty_tpl->tpl_vars['smarty']->value['foreach']['e']['first'] = $_smarty_tpl->tpl_vars['item']->first;
 $_smarty_tpl->tpl_vars['smarty']->value['foreach']['e']['last'] = $_smarty_tpl->tpl_vars['item']->last;
?>
        <?php if ($_smarty_tpl->getVariable('smarty')->value['foreach']['e']['first']){?>
            <div class="alert alert-danger" role="alert">
            <ul>
        <?php }?>
        <li class="error"><?php echo $_smarty_tpl->tpl_vars['item']->value;?>
</li>
        <?php if ($_smarty_tpl->getVariable('smarty')->value['foreach']['e']['last']){?>
            </ul>
        <?php }?>
    <?php }} ?>
    </div>
<?php }?>