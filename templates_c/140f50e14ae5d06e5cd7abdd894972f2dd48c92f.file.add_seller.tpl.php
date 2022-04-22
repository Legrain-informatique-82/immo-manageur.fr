<?php /* Smarty version Smarty-3.0.6, created on 2014-09-15 11:20:19
         compiled from "/var/www/aptana/immo-manageur.fr/modules/seller/views/add_seller.tpl" */ ?>
<?php /*%%SmartyHeaderCode:20923123055416af5383e1b8-33901362%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '140f50e14ae5d06e5cd7abdd894972f2dd48c92f' => 
    array (
      0 => '/var/www/aptana/immo-manageur.fr/modules/seller/views/add_seller.tpl',
      1 => 1410514632,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '20923123055416af5383e1b8-33901362',
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
        <h1 class="h2">Ajouter un vendeur</h1>
    </div>

    <div class="col-md-6">
        <p class="h4 text-right ">


            <button type="submit" name="seller_add_submit_send" class="btn btn-success">
                <i class="fa fa-save fa-2x"></i>
            </button>
            <a title="annuler et fermer" class="btn btn-default" href="<?php echo Tools::create_url($_smarty_tpl->getVariable('user')->value,"seller","lists");?>
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




    <?php if ($_smarty_tpl->getVariable('user')->value->getLevelMember()->getIdLevelMember()<3){?>
        <div class="form-group">
            <label class="col-sm-2 control-label" for="seller_add_user">Utilisateur : </label>
            <div class="col-sm-8">
            <select class="form-control" name="seller_add_user" id="seller_add_user">
                <?php  $_smarty_tpl->tpl_vars['item'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('listUser')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['item']->key => $_smarty_tpl->tpl_vars['item']->value){
?>
                    <option <?php if (($_smarty_tpl->getVariable('item')->value->getIdUser()==$_POST['seller_add_user']&&!empty($_POST['seller_add_user']))||($_smarty_tpl->getVariable('user')->value->getIdUser()==$_smarty_tpl->getVariable('item')->value->getIdUser()&&empty($_POST['seller_add_user']))){?> selected="selected" <?php }?>value="<?php echo $_smarty_tpl->getVariable('item')->value->getIdUser();?>
"><?php echo $_smarty_tpl->getVariable('item')->value->getFirstname();?>
 <?php echo $_smarty_tpl->getVariable('item')->value->getName();?>
</option>
                <?php }} ?>
            </select>
            </div>
        </div>
    <?php }?> <?php $_template = new Smarty_Internal_Template('seller/views/frm_add_seller.tpl', $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate();?><?php $_template->updateParentVariables(0);?><?php unset($_template);?>
    <div class="form-group">
        <label class="col-sm-2 control-label" for="seller_add_comment"><?php echo Lang::LABEL_SELLER_ADD_COMMENT;?>
</label>
        <div class="col-sm-8">
        <textarea class="form-control" name="seller_add_comment" id="seller_add_comment" cols="30" rows="10"><?php echo $_POST['seller_add_comment'];?>
</textarea>
        </div>
    </div>

    <div class="form-group">
        <div class="col-sm-offset-2 col-sm-8">
            <button class="btn btn-success" type="submit" value="<?php echo Lang::LABEL_SAVE;?>
" id="seller_add_submit_send" name="seller_add_submit_send" >
                <i class="fa fa-save"></i> <?php echo Lang::LABEL_SAVE;?>

            </button>

            <a class="btn btn-default" href="<?php echo Tools::create_url($_smarty_tpl->getVariable('user')->value,"seller","lists");?>
">
                <i class="fa fa-close"></i> Annuler et fermer
            </a>
        </div>

    </div>
</form>
</div>

