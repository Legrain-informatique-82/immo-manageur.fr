<?php /* Smarty version Smarty-3.0.6, created on 2014-09-18 14:33:04
         compiled from "/var/www/aptana/immo-manageur.fr/modules/user/views/add.tpl" */ ?>
<?php /*%%SmartyHeaderCode:1905933264541ad100aebce2-85399819%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'c2cec94ef2a0e7743c37db49dc554ba42a63f6ee' => 
    array (
      0 => '/var/www/aptana/immo-manageur.fr/modules/user/views/add.tpl',
      1 => 1411042094,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1905933264541ad100aebce2-85399819',
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
            <h1 class="h2"> Ajouter un utilisateur</h1>
        </div>

        <div class="col-md-6">
            <p class="h4 text-right ">

                <button type="submit" value="<?php echo Lang::LABEL_USER_ADD_SUBMIT;?>
" id="user_add_submit" name="user_add_submit" class="btn btn-success" title="Enregistrer">
                    <i class="fa fa-save fa-2x"></i>
                </button>
                <a class="btn btn-default" href="<?php echo Tools::create_url($_smarty_tpl->getVariable('user')->value,'user','list');?>
" title="Annuler et retourner à la fiste">
                    <i class="fa fa-close fa-2x"></i>
                </a>
            </p>
        </div>
    </div>

    <?php $_template = new Smarty_Internal_Template("tpl_default/error.tpl", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate();?><?php $_template->updateParentVariables(0);?><?php unset($_template);?>


    <fieldset>
        <legend>Identifiants :</legend>
        <div class="form-group">
            <label class="col-sm-2 control-label"  for="user_add_identifiant"><?php echo Lang::LABEL_USER_ADD_IDENTIFIANT;?>
</label>
            <div class="col-sm-8">
                <input class="form-control" type="text" name="user_add_identifiant" id="user_add_identifiant" value="<?php echo $_POST['user_add_identifiant'];?>
" />
            </div>
        </div>
        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
                <p class="help-block"><?php echo Lang::LABEL_EDITO_PASSWORD;?>
</p>
            </div>
            <label class="col-sm-2 control-label"  for="user_add_password"><?php echo Lang::LABEL_USER_ADD_PASSWORD;?>
</label>
            <div class="col-sm-8">
                <input class="form-control" type="password" name="user_add_password" id="user_add_password" value="<?php echo $_POST['user_add_password'];?>
" />
            </div>
        </div>

        <div class="form-group">
            <label class="col-sm-2 control-label"  for="user_add_confirm_password"><?php echo Lang::LABEL_USER_ADD_CONFIRM_PASSWORD;?>
 </label>
            <div class="col-sm-8">
                <input class="form-control" type="password" name="user_add_confirm_password" id="user_add_confirm_password" value="<?php echo $_POST['user_add_confirm_password'];?>
" />
            </div>
        </div>
    </fieldset>
    <fieldset>
        <legend>Général :</legend>
        <div class="form-group">
            <label class="col-sm-2 control-label"  for="user_add_name"><?php echo Lang::LABEL_USER_ADD_NAME;?>
</label>
            <div class="col-sm-8">
                <input class="form-control" type="text" name="user_add_name" id="user_add_name" value="<?php echo $_POST['user_add_name'];?>
" />
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label"  for="user_add_firstname"><?php echo Lang::LABEL_USER_ADD_FIRSTNAME;?>
 </label>
            <div class="col-sm-8">
                <input  class="form-control" type="text" name="user_add_firstname" id="user_add_firstname" value="<?php echo $_POST['user_add_firstname'];?>
" />
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label"  for="user_add_email"><?php echo Lang::LABEL_USER_ADD_EMAIL;?>
</label>
            <div class="col-sm-8">
                <input  class="form-control" type="text" name="user_add_email" id="user_add_email" value="<?php echo $_POST['user_add_email'];?>
" />
            </div>
        </div>


        <div class="form-group">
            <label class="col-sm-2 control-label"  for="user_add_cellphone"> Téléphone portable : </label>
            <div class="col-sm-8">
                <input  class="form-control" type="text" name="user_add_cellphone" id="user_add_cellphone" value="<?php echo $_smarty_tpl->getVariable('user_add_cellphone')->value;?>
"/>
            </div>
        </div>

        <div class="form-group">
            <label class="col-sm-2 control-label"  for="user_add_agency"> <?php echo Lang::LABEL_USER_ADD_AGENCY_NAME;?>
 </label>
            <div class="col-sm-8">
                <select  class="form-control" name="user_add_agency" id="user_add_agency"> <?php  $_smarty_tpl->tpl_vars["ag"] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('listOfAgency')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars["ag"]->key => $_smarty_tpl->tpl_vars["ag"]->value){
?>
                        <option <?php if ($_smarty_tpl->getVariable('ag')->value->getIdAgency()==$_POST['user_add_agency']){?>
                            selected="selected" <?php }?>
                                value="<?php echo $_smarty_tpl->getVariable('ag')->value->getIdAgency();?>
"><?php echo $_smarty_tpl->getVariable('ag')->value->getName();?>
</option> <?php }} ?>
                </select>
            </div>
        </div>




        <div class="form-group">
            <label class="col-sm-2 control-label"  for="user_add_level"> <?php echo Lang::LABEL_USER_ADD_LEVEL;?>
</label>
            <div class="col-sm-8">
                <select  class="form-control" name="user_add_level" id="user_add_level"> <?php  $_smarty_tpl->tpl_vars["lv"] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('listOfLevel')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars["lv"]->key => $_smarty_tpl->tpl_vars["lv"]->value){
?>
                        <option <?php if ($_smarty_tpl->getVariable('lv')->value->getIdLevelMember()==$_POST['user_add_level']){?> selected="selected" <?php }?>
                                value="<?php echo $_smarty_tpl->getVariable('lv')->value->getIdLevelMember();?>
"><?php echo $_smarty_tpl->getVariable('lv')->value->getName();?>
</option>
                    <?php }} ?>
                </select>
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label"  for="theme">Thème : </label>
            <div class="col-sm-8">
                <select  class="form-control"  name="theme" id="theme">
                    <?php  $_smarty_tpl->tpl_vars['th'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('listOfThemes')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['th']->key => $_smarty_tpl->tpl_vars['th']->value){
?>

                        <option <?php if ($_smarty_tpl->tpl_vars['th']->value==$_smarty_tpl->getVariable('user_add_theme')->value||($_smarty_tpl->getVariable('user_add_theme')->value==''&&$_smarty_tpl->tpl_vars['th']->value==Constant::THEME)){?> selected="selected"<?php }?> value="<?php echo $_smarty_tpl->tpl_vars['th']->value;?>
"><?php echo $_smarty_tpl->tpl_vars['th']->value;?>
</option>
                    <?php }} ?>
                </select>
            </div>
        </div>

        <div class="form-group">
            <label class="col-sm-2 control-label"  for="user_openInNewTab">Ouverture des pages dans de nouveaux onglets :</label>
            <div class="col-sm-8">
                <select name="user_openInNewTab" id="user_openInNewTab"  class="form-control" >
                    <option value="0" <?php if ($_POST['user_openInNewTab']==0){?> selected="selected"<?php }?>>Non</option>
                    <option value="1" <?php if ($_POST['user_openInNewTab']==1){?> selected="selected"<?php }?>>Oui</option>
                </select>
            </div>
        </div>

        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-8">
                <button type="submit" value="<?php echo Lang::LABEL_USER_ADD_SUBMIT;?>
" id="user_add_submit" name="user_add_submit" class="btn btn-success" >
                    <i class="fa fa-save"></i> Enregistrer
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


