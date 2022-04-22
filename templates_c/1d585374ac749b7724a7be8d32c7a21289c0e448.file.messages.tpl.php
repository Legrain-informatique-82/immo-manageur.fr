<?php /* Smarty version Smarty-3.0.6, created on 2014-09-23 15:23:16
         compiled from "/var/www/aptana/immo-manageur.fr/modules/export_site/views/messages.tpl" */ ?>
<?php /*%%SmartyHeaderCode:106721294542174442ef4b5-86064465%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '1d585374ac749b7724a7be8d32c7a21289c0e448' => 
    array (
      0 => '/var/www/aptana/immo-manageur.fr/modules/export_site/views/messages.tpl',
      1 => 1411478594,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '106721294542174442ef4b5-86064465',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<?php $_template = new Smarty_Internal_Template("tpl_default/entete.tpl", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate();?><?php $_template->updateParentVariables(0);?><?php unset($_template);?>


<form action="" method="post" class="form-horizontal" role="form">

    <div class="row bg-success bannerTitle">
        <div class="col-md-6">
            <h1 class="h2">Gestion des messages</h1>
        </div>

        <div class="col-md-6">

            <p class="h4 text-right ">

                <button type="submit" name="send" value="Valider" class="btn btn-success" title="Sauvegarder">
                    <i class="fa-save fa fa-2x"></i>
                </button>


            </p>
        </div>
    </div>




    <?php  $_smarty_tpl->tpl_vars['var'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('variables')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['var']->key => $_smarty_tpl->tpl_vars['var']->value){
?>
        <?php if ($_smarty_tpl->getVariable('var')->value->getType()=='text'){?>
            <div class="form-group">
                <label class="col-sm-2 control-label" for="v_<?php echo $_smarty_tpl->getVariable('var')->value->getId();?>
"><?php echo $_smarty_tpl->getVariable('var')->value->getLabel();?>
</label>
                <div class="col-sm-8">
                    <input type="text" class="form-control" name="v_<?php echo $_smarty_tpl->getVariable('var')->value->getId();?>
" id="v_<?php echo $_smarty_tpl->getVariable('var')->value->getId();?>
" value="<?php echo $_smarty_tpl->getVariable('var')->value->getValue();?>
"/>
                </div>
            </div>
        <?php }elseif($_smarty_tpl->getVariable('var')->value->getType()=='textarea'){?>
            <div class="form-group">
                <label class="col-sm-2 control-label" for="v_<?php echo $_smarty_tpl->getVariable('var')->value->getId();?>
"><?php echo $_smarty_tpl->getVariable('var')->value->getLabel();?>
</label>
                <div class="col-sm-8">
                    <textarea class="form-control" name="v_<?php echo $_smarty_tpl->getVariable('var')->value->getId();?>
" id="v_<?php echo $_smarty_tpl->getVariable('var')->value->getId();?>
" cols="30" rows="10"><?php echo $_smarty_tpl->getVariable('var')->value->getValue();?>
</textarea>
                </div>
            </div>
        <?php }elseif($_smarty_tpl->getVariable('var')->value->getType()=='serialize'){?>
            <?php if ($_smarty_tpl->getVariable('var')->value->getExportName()=='TYPES_VENTE_LOCATION'){?>

                <?php $_smarty_tpl->tpl_vars['typesSelected'] = new Smarty_variable(unserialize($_smarty_tpl->getVariable('var')->value->getValue()), null, null);?>





                <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                        <p class="help-block"><?php echo $_smarty_tpl->getVariable('var')->value->getLabel();?>
 : </p>
                    <?php  $_smarty_tpl->tpl_vars['i'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('types')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
 $_smarty_tpl->tpl_vars['i']->index=-1;
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['i']->key => $_smarty_tpl->tpl_vars['i']->value){
 $_smarty_tpl->tpl_vars['i']->index++;
 $_smarty_tpl->tpl_vars['i']->first = $_smarty_tpl->tpl_vars['i']->index === 0;
 $_smarty_tpl->tpl_vars['smarty']->value['foreach']["boucle"]['first'] = $_smarty_tpl->tpl_vars['i']->first;
?>
                        <?php if ($_smarty_tpl->getVariable('smarty')->value['foreach']['boucle']['first']){?>
                            <label for="che_0" class="checkbox-inline">
                                <input <?php if ($_smarty_tpl->getVariable('typesSelected')->value){?><?php if (array_key_exists(0,$_smarty_tpl->getVariable('typesSelected')->value)){?> checked="checked"<?php }?><?php }?> type="checkbox" name="che_<?php echo $_smarty_tpl->getVariable('var')->value->getId();?>
[]" id="che_0" value="0" /> <?php echo ucfirst(strtolower(Lang::TYPE_EXPORT_SITE_DEFAULT));?>

                            </label>

                        <?php }?>
                        <label for="che_<?php echo $_smarty_tpl->getVariable('i')->value->getIdMandateType();?>
" class="checkbox-inline">
                            <input <?php if ($_smarty_tpl->getVariable('typesSelected')->value){?><?php if (array_key_exists($_smarty_tpl->getVariable('i')->value->getIdMandateType(),$_smarty_tpl->getVariable('typesSelected')->value)){?> checked="checked"<?php }?><?php }?>  type="checkbox" name="che_<?php echo $_smarty_tpl->getVariable('var')->value->getId();?>
[]" id="che_<?php echo $_smarty_tpl->getVariable('i')->value->getIdMandateType();?>
" value="<?php echo $_smarty_tpl->getVariable('i')->value->getIdMandateType();?>
"/>
                            <?php echo ucfirst(strtolower($_smarty_tpl->getVariable('i')->value->getName()));?>

                        </label>
                    <?php }} ?>
                        </div>
                </div>
            <?php }?>
        <?php }?>
    <?php }} ?>
    <div class="form-group">
        <div class="col-sm-offset-2 col-sm-10">
            <button type="submit" name="send" value="Valider" class="btn btn-success">
                <i class="fa fa-save"></i> Sauvegarder
            </button>

        </div>
    </div>
</form>
</div>
