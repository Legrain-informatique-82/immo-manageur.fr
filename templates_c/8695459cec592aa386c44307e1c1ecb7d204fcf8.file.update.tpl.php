<?php /* Smarty version Smarty-3.0.6, created on 2014-09-23 12:02:02
         compiled from "/var/www/aptana/immo-manageur.fr/modules/rapprochement/views/update.tpl" */ ?>
<?php /*%%SmartyHeaderCode:10764794655421451acc3137-07603969%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '8695459cec592aa386c44307e1c1ecb7d204fcf8' => 
    array (
      0 => '/var/www/aptana/immo-manageur.fr/modules/rapprochement/views/update.tpl',
      1 => 1411466522,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '10764794655421451acc3137-07603969',
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
            <h1 class="h2">Mise à jour du rapprochement</h1>
        </div>

        <div class="col-md-6">
            <p class="h4 text-right ">
                <button type="submit" value="Sauvegarder" name="send" id="send" class="btn btn-warning" title="Mettre à jour">
                    <i class="fa fa-save fa-2x"></i>
                </button>
                <button type="submit" value="Annuler" name="cancel" id="cancel" class="btn btn-default" title="Annuler et fermer">
                    <i class="fa fa-close fa-2x"></i>
                </button>
            </p>
        </div>
    </div>
    <?php $_template = new Smarty_Internal_Template("tpl_default/viewsErrors.tpl", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate();?><?php $_template->updateParentVariables(0);?><?php unset($_template);?>

    <fieldset>
        <legend>Général : </legend>
        <?php if ($_smarty_tpl->getVariable('listUser')->value){?>
            <div class="form-group">
            <label class="col-sm-2 control-label"for="utilisateurLie"> Utilisateur lié : </label>
            <div class="col-sm-8">
                <select name="utilisateurLie" id="utilisateurLie" class="form-control">
                    <?php  $_smarty_tpl->tpl_vars['u'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('listUser')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['u']->key => $_smarty_tpl->tpl_vars['u']->value){
?>
                        <option value="<?php echo $_smarty_tpl->getVariable('u')->value->getIdUser();?>
" <?php if ($_smarty_tpl->getVariable('u')->value->getIdUser()==$_smarty_tpl->getVariable('utilisateurLie')->value){?> selected="selected"<?php }?>><?php echo $_smarty_tpl->getVariable('u')->value->getFirstname();?>
 <?php echo $_smarty_tpl->getVariable('u')->value->getName();?>
</option> <?php }} ?>
                </select>
            </div>
            </div><?php }?>

        <div class="form-group">

            <label class="col-sm-2 control-label"for="mandate"> Mandat lié :</label>
            <div class="col-sm-8">
                <select name="mandate" id="mandate" class="form-control">
                    <?php  $_smarty_tpl->tpl_vars['m'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('listMandate')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['m']->key => $_smarty_tpl->tpl_vars['m']->value){
?>
                        <option value="<?php echo $_smarty_tpl->getVariable('m')->value->getIdMandate();?>
" <?php if ($_smarty_tpl->getVariable('m')->value->getIdMandate()==$_smarty_tpl->getVariable('mandate')->value){?> selected="selected"<?php }?>><?php echo $_smarty_tpl->getVariable('m')->value->getNumberMandate();?>
 prix Fai : <?php echo $_smarty_tpl->getVariable('m')->value->getPriceFai();?>
 €</option> <?php }} ?>
                </select>
            </div>
        </div>

        <div class="form-group">
            <label class="col-sm-2 control-label"for="mandate"> Acquereur associé :</label>
            <div class="col-sm-8">
                <select name="acq" id="acq" class="form-control">
                    <?php  $_smarty_tpl->tpl_vars['a'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('listAcq')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['a']->key => $_smarty_tpl->tpl_vars['a']->value){
?>
                        <option value="<?php echo $_smarty_tpl->getVariable('a')->value->getIdAcquereur();?>
" <?php if ($_smarty_tpl->getVariable('a')->value->getIdAcquereur()==$_smarty_tpl->getVariable('acq')->value){?> selected="selected"<?php }?>><?php echo $_smarty_tpl->getVariable('a')->value->getFirstname();?>
 <?php echo $_smarty_tpl->getVariable('a')->value->getName();?>
 Budget : de <?php echo $_smarty_tpl->getVariable('a')->value->getPriceMin();?>
 à <?php echo $_smarty_tpl->getVariable('a')->value->getPriceMax();?>
 €</option>
                    <?php }} ?>
                </select>
            </div>
        </div>
    </fieldset>
    <fieldset>
        <legend>Visite : </legend>

        <div class="form-group">
            <label class="col-sm-2 control-label"for="dateVisite">Date de la visite :</label>
            <div class="col-sm-8">
                <input type="text"  name="dateVisite" value="<?php echo $_smarty_tpl->getVariable('dateVisite')->value;?>
" id="dateVisite" class="dateTimepicker form-control" />
            </div>
        </div>

        <div class="form-group">
            <label class="col-sm-2 control-label"for="dateCompteRendu">Compte rendu le :</label>
            <div class="col-sm-8">
                <input type="text" name="dateCompteRendu" value="<?php echo $_smarty_tpl->getVariable('dateCompteRendu')->value;?>
" id="dateCompteRendu" class="dateTimepicker form-control" />
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label"for="resultat">Resultat :</label>
            <div class="col-sm-8">
                <input type="text" name="resultat" value="<?php echo $_smarty_tpl->getVariable('resultat')->value;?>
" id="resultat" class="form-control"/>
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label"for="ptPositifs">Points positifs : </label>
            <div class="col-sm-8">
                <textarea name="ptPositifs" id="ptPositifs" cols="30" rows="10" class="form-control"><?php echo $_smarty_tpl->getVariable('ptPositifs')->value;?>
</textarea>
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label"for="ptNegatifs">points negatifs : </label>
            <div class="col-sm-8">
                <textarea name="ptNegatifs" id="ptNegatifs" cols="30" rows="10" class="form-control"><?php echo $_smarty_tpl->getVariable('ptNegatifs')->value;?>
</textarea>
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label"for="resultatVisite">Résultat de la visite : </label>
            <div class="col-sm-8">
                <select name="resultatVisite" id="resultatVisite" class="form-control">

                    <option <?php if ($_smarty_tpl->getVariable('resultatVisite')->value==0){?> selected="selected"<?php }?> value="0">-------</option>
                    <option <?php if ($_smarty_tpl->getVariable('resultatVisite')->value==1){?> selected="selected"<?php }?>  value="1">Ne correspond pas</option>
                    <option <?php if ($_smarty_tpl->getVariable('resultatVisite')->value==2){?> selected="selected"<?php }?> value="2">Ok</option>

                </select>
            </div>
        </div>
    </fieldset>

    <div class="form-group">
        <div class="col-sm-offset-2 col-sm-8">
            <button type="submit" value="Sauvegarder" name="send" id="send" class="btn btn-warning">
                <i class="fa fa-save"></i> Mettre à jour
            </button>
            <button type="submit" value="Annuler" name="cancel" id="cancel" class="btn btn-default">
                <i class="fa fa-close"></i> Annuler et fermer
            </button>
        </div>
    </div>
</form>
</div>
