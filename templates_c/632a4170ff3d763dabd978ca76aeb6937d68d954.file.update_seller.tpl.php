<?php /* Smarty version Smarty-3.0.6, created on 2014-09-12 10:23:23
         compiled from "/var/www/aptana/immo-manageur.fr/modules/seller/views/update_seller.tpl" */ ?>
<?php /*%%SmartyHeaderCode:6246926345412ad7bdf0d54-19957650%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '632a4170ff3d763dabd978ca76aeb6937d68d954' => 
    array (
      0 => '/var/www/aptana/immo-manageur.fr/modules/seller/views/update_seller.tpl',
      1 => 1410510202,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '6246926345412ad7bdf0d54-19957650',
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
            <h1 class="h2">Modifier le vendeur</h1>
        </div>

        <div class="col-md-6">
            <p class="h4 text-right ">


                <button type="submit" name="seller_update_submit_send" class="btn btn-warning">
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
    <div id="blocSeller" class="bulle">


        <?php if ($_smarty_tpl->getVariable('user')->value->getLevelMember()->getIdLevelMember()<3){?>
            <div class="form-group">
                <label class="col-sm-2 control-label" for="seller_update_user"> Utilisateur : </label>
                <div class="col-sm-8">
                    <select class="form-control" name="seller_update_user" id="seller_update_user"> <?php  $_smarty_tpl->tpl_vars['item'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('listUser')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['item']->key => $_smarty_tpl->tpl_vars['item']->value){
?>
                            <option <?php if (($_smarty_tpl->getVariable('item')->value->getIdUser()==$_smarty_tpl->getVariable('seller_update_user')->value&&!empty($_smarty_tpl->getVariable('seller_update_user',null,true,false)->value))||($_smarty_tpl->getVariable('user')->value->getIdUser()==$_smarty_tpl->getVariable('item')->value->getIdUser()&&empty($_smarty_tpl->getVariable('seller_update_user',null,true,false)->value))){?>
                                    selected="selected"
                                    <?php }?>value="<?php echo $_smarty_tpl->getVariable('item')->value->getIdUser();?>
"><?php echo $_smarty_tpl->getVariable('item')->value->getFirstname();?>

                                <?php echo $_smarty_tpl->getVariable('item')->value->getName();?>
</option> <?php }} ?>

                    </select>
                </div>
            </div>
        <?php }?>
        <div class="form-group">
            <label class="col-sm-2 control-label" for="seller_update_list_title"> <?php echo Lang::LABEL_SELLER_ADD_TITLE;?>
</label>
            <div class="col-sm-8">
                <select class="form-control" name="seller_update_list_title" id="seller_update_list_title">
                    <?php  $_smarty_tpl->tpl_vars['item'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('listTitle')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['item']->key => $_smarty_tpl->tpl_vars['item']->value){
?>
                        <option <?php if ($_smarty_tpl->getVariable('seller_update_list_title')->value==$_smarty_tpl->getVariable('item')->value->getIdSellerTitle()){?>
                                selected="selected"
                                <?php }?>value="<?php echo $_smarty_tpl->getVariable('item')->value->getIdSellerTitle();?>
"><?php echo $_smarty_tpl->getVariable('item')->value->getLibel();?>
</option>
                    <?php }} ?>
                </select>
            </div>
        </div>

        <div class="form-group">
            <label class="col-sm-2 control-label" for="seller_update_name"><?php echo Lang::LABEL_SELLER_ADD_NAME;?>
</label>
            <div class="col-sm-8">
                <input class="form-control" type="text" name="seller_update_name" value="<?php echo $_smarty_tpl->getVariable('seller_update_name')->value;?>
" id="seller_update_name" />
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label" for="seller_update_firstname"><?php echo Lang::LABEL_SELLER_ADD_FIRSTNAME;?>
</label>
            <div class="col-sm-8">
                <input class="form-control" type="text" name="seller_update_firstname" value="<?php echo $_smarty_tpl->getVariable('seller_update_firstname')->value;?>
" id="seller_update_firstname" />
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label" for="seller_update_address"><?php echo Lang::LABEL_SELLER_ADD_ADDRESS;?>
</label>
            <div class="col-sm-8">
                <input class="form-control" type="text" name="seller_update_address" value="<?php echo $_smarty_tpl->getVariable('seller_update_address')->value;?>
" id="seller_update_address" />
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label" for="seller_update_list_city"> <?php echo Lang::LABEL_SELLER_ADD_CITY;?>
</label>
            <div class="col-sm-8">
                <select class="form-control" name="seller_update_list_city" id="seller_update_list_city"> <?php  $_smarty_tpl->tpl_vars['item'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('listCity')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['item']->key => $_smarty_tpl->tpl_vars['item']->value){
?>
                        <option <?php if ($_smarty_tpl->getVariable('seller_update_list_city')->value==$_smarty_tpl->getVariable('item')->value->getIdCity()){?>
                                selected="selected"
                                <?php }?>value="<?php echo $_smarty_tpl->getVariable('item')->value->getIdCity();?>
"><?php echo $_smarty_tpl->getVariable('item')->value->getZipCode();?>
 -
                            <?php echo $_smarty_tpl->getVariable('item')->value->getName();?>
</option> <?php }} ?>
                </select>
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label" for="seller_update_phone"><?php echo Lang::LABEL_SELLER_ADD_PHONE;?>
</label>
            <div class="col-sm-8">
                <input class="form-control" type="text" name="seller_update_phone" value="<?php echo $_smarty_tpl->getVariable('seller_update_phone')->value;?>
" id="seller_update_phone" />
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label" for="seller_update_mobil_phone"><?php echo Lang::LABEL_SELLER_ADD_MOBIL_PHONE;?>
</label>
            <div class="col-sm-8">
                <input class="form-control" type="text" name="seller_update_mobil_phone" value="<?php echo $_smarty_tpl->getVariable('seller_update_mobil_phone')->value;?>
" id="seller_update_mobil_phone" />
            </div>

        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label" for="seller_update_work_phone"><?php echo Lang::LABEL_SELLER_ADD_WORK_PHONE;?>
</label>
            <div class="col-sm-8">
                <input class="form-control" type="text" name="seller_update_work_phone" value="<?php echo $_smarty_tpl->getVariable('seller_update_work_phone')->value;?>
" id="seller_update_work_phone" />
            </div>

        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label" for="seller_update_fax"><?php echo Lang::LABEL_SELLER_ADD_FAX;?>
</label>
            <div class="col-sm-8">
                <input class="form-control" type="text" name="seller_update_fax" value="<?php echo $_smarty_tpl->getVariable('seller_update_fax')->value;?>
" id="seller_update_fax" />
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label" for="seller_update_email"><?php echo Lang::LABEL_SELLER_ADD_EMAIL;?>
</label>
            <div class="col-sm-8">
                <input class="form-control" type="text" name="seller_update_email" value="<?php echo $_smarty_tpl->getVariable('seller_update_email')->value;?>
" id="seller_update_email" />
            </div>
        </div>
        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
                <div class="checkbox">
                    <label for="vitrine">
                        <input type="checkbox" name="vitrine" id="vitrine" value="1" <?php if ($_POST['vitrine']==1||$_smarty_tpl->getVariable('vitrine')->value==1){?> checked="checked" <?php }?>/>
                        Possède un compte client sur votre site vitrine.
                    </label>
                </div>
            </div>
        </div>

        <div class="form-group">
            <label class="col-sm-2 control-label" for="seller_update_comment"><?php echo Lang::LABEL_SELLER_ADD_COMMENT;?>
</label>
            <div class="col-sm-8">
                <textarea  class="form-control" name="seller_update_comment" id="seller_update_comment" cols="30" rows="10"><?php echo $_smarty_tpl->getVariable('seller_update_comment')->value;?>
</textarea>
            </div>
        </div>

        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
                <button class="btn btn-warning" type="submit" value="<?php echo Lang::LABEL_SAVE;?>
" id="seller_update_submit_send" name="seller_update_submit_send" >
                    <i class="fa fa-save"></i> Mettre à jour
                    </button>
                <a title="annuler et fermer" class="btn btn-default" href="<?php echo Tools::create_url($_smarty_tpl->getVariable('user')->value,"seller","lists");?>
">
                    <i class="fa fa-close"></i> Annuler et fermer
                </a>
            </div>
        </div>

</form>
</div>
</div>
