<?php /* Smarty version Smarty-3.0.6, created on 2014-09-12 10:24:59
         compiled from "/var/www/aptana/immo-manageur.fr/modules/seller/views/add_title.tpl" */ ?>
<?php /*%%SmartyHeaderCode:13389353225412addb8083c8-10110429%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'a336e8275363fb644a025292a380caff1886b5bc' => 
    array (
      0 => '/var/www/aptana/immo-manageur.fr/modules/seller/views/add_title.tpl',
      1 => 1410510298,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '13389353225412addb8083c8-10110429',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<?php $_template = new Smarty_Internal_Template("tpl_default/entete.tpl", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate();?><?php $_template->updateParentVariables(0);?><?php unset($_template);?>
<form action="" method="post"  role="form" class="form-horizontal">
<div class="row bg-success bannerTitle">
    <div class="col-md-6">
        <h1 class="h2"><?php echo lang::LABEL_SELLER_ADD_TITLE_h1;?>
</h1>
    </div>
    <div class="col-md-6">
        <p class="h4 text-right ">
            <button type="submit" class="btn btn-success" name="seller_add_title_submit">
                <i class="fa fa-save fa-2x"></i>
            </button>
            <a title="annuler et fermer" class="btn btn-default" href="<?php echo Tools::create_url($_smarty_tpl->getVariable('user')->value,"seller","list");?>
">
                <i class="fa fa-close fa-2x"></i>
            </a>
        </p>
    </div>

</div>
<?php if ($_smarty_tpl->getVariable('error')->value){?> <?php  $_smarty_tpl->tpl_vars['item'] = new Smarty_Variable;
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
?> <?php if ($_smarty_tpl->getVariable('smarty')->value['foreach']['e']['first']){?>
    <div class="alert alert-danger" role="alert">
    <ul>
<?php }?>
    <li class="error"><?php echo $_smarty_tpl->tpl_vars['item']->value;?>
</li> <?php if ($_smarty_tpl->getVariable('smarty')->value['foreach']['e']['last']){?>
        </ul>
    <?php }?> <?php }} ?>
    </div>
<?php }?>


    <div class="form-group">
        <label class="col-sm-2 control-label" for="seller_add_title_name"><?php echo lang::LABEL_SELLER_ADD_TITLE_NAME;?>
</label>
        <div class="col-sm-8">
        <input class="form-control" type="text" name="seller_add_title_name" id="seller_add_title_name">
            </div>

    </div>
    <div class="form-group">
        <div class="col-sm-offset-2 col-sm-8">
        <button class="btn btn-success" type="submit" name="seller_add_title_submit" value="<?php echo lang::LABEL_SAVE;?>
">
            <i class="fa fa-save"></i> <?php echo lang::LABEL_SAVE;?>

        </button>
            <a class="btn btn-default" href="<?php echo Tools::create_url($_smarty_tpl->getVariable('user')->value,"seller","list");?>
">
                <i class="fa fa-close"></i> Annuler et fermer
            </a>
            </div>
    </div>
</form>
</div>
