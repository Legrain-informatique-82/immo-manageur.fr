<?php /* Smarty version Smarty-3.0.6, created on 2014-09-18 12:07:12
         compiled from "/var/www/aptana/immo-manageur.fr/modules/user/views/update.tpl" */ ?>
<?php /*%%SmartyHeaderCode:2073626935541aaed06a3713-05880286%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '9b0a3e74f1707226b486c54f098142914c4d35ea' => 
    array (
      0 => '/var/www/aptana/immo-manageur.fr/modules/user/views/update.tpl',
      1 => 1411034828,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '2073626935541aaed06a3713-05880286',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<?php $_template = new Smarty_Internal_Template("tpl_default/entete.tpl", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate();?><?php $_template->updateParentVariables(0);?><?php unset($_template);?>
<form action="" method="post" role="form" class="form-horizontal">
<div class="row bg-success bannerTitle">
    <div class="col-md-6">
        <h1 class="h2"> Modifier un utilisateur</h1>
    </div>
    <div class="col-md-6">
        <p class="h4 text-right ">
            <button type="submit" value="<?php echo Lang::LABEL_USER_UPDATE_SUBMIT;?>
" id="user_update_submit2" name="user_update_submit" class="btn btn-warning">
                <i class="fa fa-save fa-2x"></i>
            </button>
            <a class="btn btn-default" href="<?php echo Tools::create_url($_smarty_tpl->getVariable('user')->value,'user','list');?>
">
                <i class="fa fa-close fa-2x"></i>
            </a>
        </p>
    </div>

</div>

<?php $_template = new Smarty_Internal_Template("tpl_default/error.tpl", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate();?><?php $_template->updateParentVariables(0);?><?php unset($_template);?>


    <fieldset>
        <legend>Identifiants :</legend>
        <?php if ($_smarty_tpl->getVariable('user')->value->getLevelMember()->getIdLevelMember()==1){?>
            <div class="form-group">
                <label class="col-sm-2 control-label" for="user_update_identifiant"><?php echo Lang::LABEL_USER_ADD_IDENTIFIANT;?>
</label>
                <div class="col-sm-8">
                    <input class="form-control" type="text" name="user_update_identifiant" id="user_update_identifiant" value="<?php echo $_smarty_tpl->getVariable('user_update_identifiant')->value;?>
" />
                    <input type="hidden" name="user_update_old_identifiant" id="user_update_old_identifiant" value="<?php echo $_smarty_tpl->getVariable('user_update_old_identifiant')->value;?>
" />
                </div>
            </div>
        <?php }else{ ?>
            <div class="form-group">
                <?php echo Lang::LABEL_USER_ADD_IDENTIFIANT;?>
<?php echo $_smarty_tpl->getVariable('user_update_identifiant')->value;?>

                <input type="hidden" name="user_update_identifiant"  value="<?php echo $_smarty_tpl->getVariable('user_update_identifiant')->value;?>
" />
                <input type="hidden" name="user_update_old_identifiant" id="user_update_old_identifiant" value="<?php echo $_smarty_tpl->getVariable('user_update_old_identifiant')->value;?>
" />
            </div>
        <?php }?>
        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
                <p class="help-block"><?php echo Lang::LABEL_EDITO_PASSWORD;?>
</p>
            </div>
            <label class="col-sm-2 control-label" for="user_update_password"><?php echo Lang::LABEL_USER_ADD_PASSWORD;?>
 </label>
            <div class="col-sm-8">
                <input class="form-control" type="password" name="user_update_password" id="user_update_password" value="<?php echo $_smarty_tpl->getVariable('user_update_password')->value;?>
" />
            </div>
        </div>

        <div class="form-group">

            <label class="col-sm-2 control-label" for="user_update_confirm_password"><?php echo Lang::LABEL_USER_ADD_CONFIRM_PASSWORD;?>
</label>
            <div class="col-sm-8">
                <input class="form-control" type="password" name="user_update_confirm_password" id="user_update_confirm_password" value="<?php echo $_smarty_tpl->getVariable('user_update_confirm_password')->value;?>
" />
            </div>
        </div>
    </fieldset>
    <fieldset>
        <legend>Général :</legend>
        <div class="form-group">
            <label class="col-sm-2 control-label" for ="user_update_name"><?php echo Lang::LABEL_USER_ADD_NAME;?>
</label>
            <div class="col-sm-8">
                <input class="form-control" type="text" name="user_update_name" id="user_update_name" value="<?php echo $_smarty_tpl->getVariable('user_update_name')->value;?>
" />
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label" for ="user_update_firstname"><?php echo Lang::LABEL_USER_ADD_FIRSTNAME;?>
</label>
            <div class="col-sm-8">
                <input class="form-control" type="text" name="user_update_firstname" id="user_update_firstname" value="<?php echo $_smarty_tpl->getVariable('user_update_firstname')->value;?>
" />
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label" for ="user_update_email"><?php echo Lang::LABEL_USER_ADD_EMAIL;?>
</label>
            <div class="col-sm-8">
                <input class="form-control" type="text" name="user_update_email" id="user_update_email" value="<?php echo $_smarty_tpl->getVariable('user_update_email')->value;?>
" />
            </div>
        </div>

        <div class="form-group">
            <label class="col-sm-2 control-label" for ="user_update_cellphone"> Téléphone portable : </label>
            <div class="col-sm-8">
                <input class="form-control" type="text" name="user_update_cellphone" id="user_update_cellphone" value="<?php echo $_smarty_tpl->getVariable('user_update_cellphone')->value;?>
"/>
            </div>
        </div>

        <?php if ($_smarty_tpl->getVariable('user')->value->getLevelMember()->getIdLevelMember()==1){?>
            <div class="form-group">
                <label class="col-sm-2 control-label" for ="user_update_agency"> <?php echo Lang::LABEL_USER_ADD_AGENCY_NAME;?>
</label>
                <div class="col-sm-8">
                    <select class="form-control" name="user_update_agency" id="user_update_agency"> <?php  $_smarty_tpl->tpl_vars["ag"] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('listOfAgency')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars["ag"]->key => $_smarty_tpl->tpl_vars["ag"]->value){
?>
                            <option <?php if ($_smarty_tpl->getVariable('ag')->value->getIdAgency()==$_smarty_tpl->getVariable('user_update_agency')->value){?>
                                selected="selected" <?php }?>
                                    value="<?php echo $_smarty_tpl->getVariable('ag')->value->getIdAgency();?>
"><?php echo $_smarty_tpl->getVariable('ag')->value->getName();?>
</option> <?php }} ?>
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label" for ="user_update_level"> <?php echo Lang::LABEL_USER_ADD_LEVEL;?>
</label>
                <div class="col-sm-8">
                    <select class="form-control" name="user_update_level" id="user_update_level"> <?php  $_smarty_tpl->tpl_vars["lv"] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('listOfLevel')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars["lv"]->key => $_smarty_tpl->tpl_vars["lv"]->value){
?>
                            <option <?php if ($_smarty_tpl->getVariable('lv')->value->getIdLevelMember()==$_smarty_tpl->getVariable('user_update_level')->value){?>
                                selected="selected" <?php }?>
                                    value="<?php echo $_smarty_tpl->getVariable('lv')->value->getIdLevelMember();?>
"><?php echo $_smarty_tpl->getVariable('lv')->value->getName();?>
</option>
                        <?php }} ?>
                    </select>
                </div>
            </div>
        <?php }?>
        <div class="form-group">
            <label class="col-sm-2 control-label" for ="theme">Thème : </label>
            <div class="col-sm-8">
                <select class="form-control" name="theme" id="theme">
                    <?php  $_smarty_tpl->tpl_vars['th'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('listOfThemes')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['th']->key => $_smarty_tpl->tpl_vars['th']->value){
?>

                        <option <?php if ($_smarty_tpl->tpl_vars['th']->value==$_smarty_tpl->getVariable('user_update_theme')->value||($_smarty_tpl->getVariable('user_update_theme')->value==''&&$_smarty_tpl->tpl_vars['th']->value==Constant::THEME)){?> selected="selected"<?php }?> value="<?php echo $_smarty_tpl->tpl_vars['th']->value;?>
"><?php echo $_smarty_tpl->tpl_vars['th']->value;?>
</option>
                    <?php }} ?>
                </select>
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label" for ="user_openInNewTab">Ouverture des pages dans de nouveaux onglets :</label>
            <div class="col-sm-8">
                <select name="user_openInNewTab" id="user_openInNewTab" class="form-control">
                    <option value="0" <?php if ($_smarty_tpl->getVariable('user_openInNewTab')->value==0){?> selected="selected"<?php }?>>Non</option>
                    <option value="1" <?php if ($_smarty_tpl->getVariable('user_openInNewTab')->value==1){?> selected="selected"<?php }?>>Oui</option>
                </select>
            </div>
        </div>

        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-8">

                <button type="submit" value="<?php echo Lang::LABEL_USER_UPDATE_SUBMIT;?>
" id="user_update_submit" name="user_update_submit" class="btn btn-warning">
                    <i class="fa fa-save"></i> Mettre à jour
                </button>
                <a class="btn btn-default" href="<?php echo Tools::create_url($_smarty_tpl->getVariable('user')->value,'user','list');?>
">
                    <i class="fa fa-close"></i> Annuler
                </a>
            </div>
        </div>
    </fieldset>


</form>
</div>

