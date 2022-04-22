<?php /* Smarty version Smarty-3.0.6, created on 2014-09-19 13:22:39
         compiled from "/var/www/aptana/immo-manageur.fr/modules/documents/views/addDocument.tpl" */ ?>
<?php /*%%SmartyHeaderCode:2018420326541c11ffac6e24-24030996%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'bb37dcc5791ed1d054ccac3c1ae56224f6ed1d4d' => 
    array (
      0 => '/var/www/aptana/immo-manageur.fr/modules/documents/views/addDocument.tpl',
      1 => 1411125758,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '2018420326541c11ffac6e24-24030996',
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
            <h1 class="h2"><?php echo $_smarty_tpl->getVariable('h1')->value;?>
</h1>
        </div>

        <div class="col-md-6">
            <p class="h4 text-right ">
                <button type="submit" value="Enregistrer" name="save" class="btn <?php if ($_GET['action']){?>btn-warning<?php }else{ ?>btn-success<?php }?>" title="Enregistrer">
                    <i class="fa fa-save fa-2x"></i>
                </button>
                <button type="submit" value="Enregistrer et fermer" name="save_and_quit" class="btn btn-info" title="Enregistrer et fermer">
                    <i class="fa fa-save fa-2x"></i>
                </button>
                <button type="submit" name="cancel" value="Annuler" class="btn btn-default" title="Fermer">
                    <i class="fa fa-close fa-2x"></i>
                </button>
            </p>
        </div>
    </div>
    <?php $_template = new Smarty_Internal_Template("tpl_default/viewsErrors.tpl", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate();?><?php $_template->updateParentVariables(0);?><?php unset($_template);?>



    <fieldset>
        <legend>Type de biens : </legend>
        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-8">
                <p class="help-block">Sélectionner les types de biens pour lesquels le document sera disponible</p>
                <?php  $_smarty_tpl->tpl_vars['t'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('mandateType')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['t']->key => $_smarty_tpl->tpl_vars['t']->value){
?>
                    <label class="checkbox-inline"><input <?php if (in_array($_smarty_tpl->getVariable('t')->value->getId(),$_smarty_tpl->getVariable('listIdTypeBiensSelected')->value)){?>checked="checked"<?php }?> type="checkbox" name="type[]" value="<?php echo $_smarty_tpl->getVariable('t')->value->getId();?>
"/><?php echo $_smarty_tpl->getVariable('t')->value->getName();?>
</label>
                <?php }} ?>
            </div>
        </div>
    </fieldset>
    <fieldset>
        <legend>Etape du bien : </legend>
        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-8">
                <p class="help-block">Sélectionner les étapes de biens pour lesquels le document sera disponible</p>
                <?php  $_smarty_tpl->tpl_vars['e'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('mandateEtap')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['e']->key => $_smarty_tpl->tpl_vars['e']->value){
?>
                    <label class="checkbox-inline"><input  <?php if (in_array($_smarty_tpl->getVariable('e')->value->getId(),$_smarty_tpl->getVariable('listIdEtapSelected')->value)){?>checked="checked"<?php }?> type="checkbox" name="etap[]" value="<?php echo $_smarty_tpl->getVariable('e')->value->getId();?>
"/><?php echo $_smarty_tpl->getVariable('e')->value->getName();?>
</label>
                <?php }} ?>
            </div>
        </div>

    </fieldset>

    <fieldset >
        <legend>Désignation : </legend>

        <div class="form-group">
            <label class="col-sm-2 control-label" for="category">Catégorie : </label>
            <div class="col-sm-8">
                <select class="form-control" name="category" id="category">
                    <?php  $_smarty_tpl->tpl_vars['cat'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('categories')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['cat']->key => $_smarty_tpl->tpl_vars['cat']->value){
?>
                        <option <?php if ($_smarty_tpl->getVariable('category')->value==$_smarty_tpl->getVariable('cat')->value->getIdCategoryDocument()){?> selected="selected"<?php }?> value="<?php echo $_smarty_tpl->getVariable('cat')->value->getIdCategoryDocument();?>
"><?php echo $_smarty_tpl->getVariable('cat')->value->getName();?>
</option>
                    <?php }} ?>
                </select>
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label" for="name">Nom : </label>
            <div class="col-sm-8">
                <input class="form-control" type="text" name="name" id="name" value="<?php echo $_smarty_tpl->getVariable('name')->value;?>
"/>
            </div>
        </div>
    </fieldset>

    <fieldset>
        <legend>Contenu du courrier : </legend>
        <div>
            <?php if ($_GET['action']){?>
                <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-8">
                        <p class="help-block">
                            Vous devez enregistrez le document avant de l'imprimer :
                            <a class="btn btn-default" href="<?php echo Tools::create_url($_smarty_tpl->getVariable('user')->value,'documents','printDoc',$_GET['action']);?>
" target="_blank">
                                <i class="fa fa-print"></i> Imprimer le document
                            </a>
                        </p>
                    </div>
                </div>
            <?php }?>
        </div>
        <?php $_template = new Smarty_Internal_Template("documents/views/editor.tpl", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate();?><?php $_template->updateParentVariables(0);?><?php unset($_template);?>


    </fieldset>



    <div class="form-group">
        <div class="col-sm-offset-2 col-sm-8">
            <button type="submit" value="Enregistrer" name="save" class="btn <?php if ($_GET['action']){?>btn-warning<?php }else{ ?>btn-success<?php }?>">
                <i class="fa fa-save"></i> Enregistrer
            </button>
            <button type="submit" value="Enregistrer et fermer" name="save_and_quit" class="btn btn-info" >
                <i class="fa fa-save"></i> Enregistrer et fermer
            </button>
            <button type="submit" name="cancel" value="Annuler" class="btn btn-default">
                <i class="fa fa-close"></i> Fermer
            </button>
        </div>
    </div>


</form>
</div>
