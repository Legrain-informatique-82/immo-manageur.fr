<?php /* Smarty version Smarty-3.0.6, created on 2014-09-22 11:01:27
         compiled from "/var/www/aptana/immo-manageur.fr/modules/rapprochement/views/add_rapprochement_acq.tpl" */ ?>
<?php /*%%SmartyHeaderCode:53163638541fe567bce8e3-02097210%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '2497e0b11e931147df7145b38d3cfe9854a6e6af' => 
    array (
      0 => '/var/www/aptana/immo-manageur.fr/modules/rapprochement/views/add_rapprochement_acq.tpl',
      1 => 1410517932,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '53163638541fe567bce8e3-02097210',
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
            <h1 class="h2">Rapprocher <?php echo $_smarty_tpl->getVariable('acq')->value->getFirstname();?>
 <?php echo $_smarty_tpl->getVariable('acq')->value->getName();?>
 du mandat
                <?php echo $_smarty_tpl->getVariable('mandate')->value->getNumberMandate();?>
</h1>
        </div>

        <div class="col-md-6">
            <p class="h4 text-right ">

                <button type="submit" value="valider" name="send" class="btn btn-success" title="Enregistrer">
                    <i class="fa fa-save fa-2x"></i>
                </button>
                <a class="btn btn-default" href="<?php echo $_smarty_tpl->getVariable('redirectC')->value;?>
" title="<?php echo $_smarty_tpl->getVariable('labelRedirectC')->value;?>
">
                    <i class="fa fa-close fa-2x"></i>
                </a>

            </p>
        </div>
    </div>

    <?php $_template = new Smarty_Internal_Template("tpl_default/viewsErrors.tpl", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate();?><?php $_template->updateParentVariables(0);?><?php unset($_template);?>

    <fieldset>
        <legend>Général : </legend>
        <?php if ($_smarty_tpl->getVariable('listUser')->value){?>
            <div class="form-group">
                <label class="col-sm-2 control-label" for="utilisateurAssocie">Utilisateur associé :</label>
                <div class="col-sm-8">
                    <select name="utilisateurAssocie" id="utilisateurAssocie" class="form-control">
                        <?php  $_smarty_tpl->tpl_vars['u'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('listUser')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['u']->key => $_smarty_tpl->tpl_vars['u']->value){
?>
                            <option <?php if ($_smarty_tpl->getVariable('u')->value->getIdUser()==$_smarty_tpl->getVariable('utilisateurAssocie')->value){?> selected="selected" <?php }?> value="<?php echo $_smarty_tpl->getVariable('u')->value->getIdUser();?>
"><?php echo $_smarty_tpl->getVariable('u')->value->getFirstname();?>
 <?php echo $_smarty_tpl->getVariable('u')->value->getName();?>
</option>
                        <?php }} ?>
                    </select>
                </div>
            </div>
        <?php }else{ ?>
            <div class="col-sm-offset-2 col-sm-8">
                <p class="help-block">
                    Utilisateur associé :
                    <?php echo $_smarty_tpl->getVariable('user')->value->getFirstname();?>
 <?php echo $_smarty_tpl->getVariable('user')->value->getName();?>

                </p>
            </div>
        <?php }?>
        <div class="col-sm-offset-2 col-sm-8">
            <p class="help-block">
                Numéro du mandat associé : <?php echo $_smarty_tpl->getVariable('mandate')->value->getNumberMandate();?>

            </p>
            <p class="help-block">
                Acquereur associé : <?php echo $_smarty_tpl->getVariable('acq')->value->getFirstname();?>
 <?php echo $_smarty_tpl->getVariable('acq')->value->getName();?>

            </p>
        </div>
    </fieldset>
    <fieldset>
        <legend>Visite : </legend>

        <div class="form-group">
            <label class="col-sm-2 control-label" for="dateVisite">Date de la visite :</label>
            <div class="col-sm-8">
                <input type="text" name="dateVisite" value="<?php echo $_smarty_tpl->getVariable('dateVisite')->value;?>
" id="dateVisite" class="dateTimepicker form-control" />
            </div>
        </div>

        <div class="form-group">
            <label class="col-sm-2 control-label" for="dateCompteRendu">Compte rendu le :</label>
            <div class="col-sm-8">
                <input type="text" name="dateCompteRendu" value="<?php echo $_smarty_tpl->getVariable('dateCompteRendu')->value;?>
" id="dateCompteRendu" class="dateTimepicker form-control" />
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label" for="resultat">Resultat : </label>
            <div class="col-sm-8">
                <input type="text" name="resultat" value="<?php echo $_smarty_tpl->getVariable('resultat')->value;?>
" id="resultat" class="form-control"/>
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label" for="ptPositifs">Points positifs :</label>

            <div class="col-sm-8">
                <textarea class="form-control" name="ptPositifs" id="ptPositifs" cols="30" rows="10"><?php echo $_smarty_tpl->getVariable('ptPositifs')->value;?>
</textarea>
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label" for="ptNegatifs">points negatifs : </label>
            <div class="col-sm-8">
                <textarea name="ptNegatifs" id="ptNegatifs" cols="30" rows="10" class="form-control"><?php echo $_smarty_tpl->getVariable('ptNegatifs')->value;?>
</textarea>
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label" for="resultatVisite">Résultat de la visite :  </label>
            <div class="col-sm-8">
                <select name="resultatVisite" id="resultatVisite" class="form-control">
                    <option <?php if ($_smarty_tpl->getVariable('resultatVisite')->value==0){?> selected="selected" <?php }?> value="0">-------</option>
                    <option <?php if ($_smarty_tpl->getVariable('resultatVisite')->value==1){?> selected="selected" <?php }?>  value="1">Ne correspond pas</option>
                    <option <?php if ($_smarty_tpl->getVariable('resultatVisite')->value==2){?> selected="selected" <?php }?> value="2">Ok</option>
                </select>
            </div>
        </div>
    </fieldset>
    <div class="form-group">
        <div class="col-sm-offset-2 col-sm-8">
            <button type="submit" value="valider" name="send" class="btn btn-success">
                <i class="fa fa-save"></i> Enregistrer
            </button>
            <a class="btn btn-default" href="<?php echo $_smarty_tpl->getVariable('redirectC')->value;?>
">
                <i class="fa fa-close "></i> <?php echo $_smarty_tpl->getVariable('labelRedirectC')->value;?>

            </a>
        </div>
    </div>
</form>
</div>
