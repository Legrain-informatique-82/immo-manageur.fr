<?php /* Smarty version Smarty-3.0.6, created on 2014-09-22 11:54:30
         compiled from "/var/www/aptana/immo-manageur.fr/modules/mandat/views/updateGen.tpl" */ ?>
<?php /*%%SmartyHeaderCode:1366488021541ff1d60891f5-77253675%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '661f7e687868ef236fed9a03ac29562c590b2a0c' => 
    array (
      0 => '/var/www/aptana/immo-manageur.fr/modules/mandat/views/updateGen.tpl',
      1 => 1411379589,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1366488021541ff1d60891f5-77253675',
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
        <h1 class="h2">Modification générales</h1>
    </div>
    <div class="col-md-6">
        <p class="h4 text-right ">
            <button type="submit" name="valid" value="Valider" class="btn btn-warning" >
                <i class="fa fa-save fa-2x"></i>
            </button>
            <button type="submit" name="cancel" value="Annuler" class="btn btn-default" >
                <i class="fa fa-close fa-2x"></i>
            </button>
        </p>
    </div>
</div>
<?php $_template = new Smarty_Internal_Template("tpl_default/error.tpl", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate();?><?php $_template->updateParentVariables(0);?><?php unset($_template);?>

<fieldset>
    <legend>Localisation</legend>
    <div class="form-group">


        <label class="col-sm-2 control-label"  for="address">Addresse : </label>

        <div class="col-sm-8">
            <input type="text" name="address" id="address" class="form-control" value="<?php echo $_smarty_tpl->getVariable('address')->value;?>
"/>
        </div>
    </div>
    <div class="form-group">

        <label class="col-sm-2 control-label"  for="city">Ville : </label>

        <div class="col-sm-8">
            <select name="city" id="city" class="form-control">
                <?php  $_smarty_tpl->tpl_vars['ci'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('listcity')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['ci']->key => $_smarty_tpl->tpl_vars['ci']->value){
?>
                    <option <?php if ($_smarty_tpl->getVariable('ci')->value->getIdCity()==$_smarty_tpl->getVariable('city')->value){?> selected="selected"
                                                           <?php }?>value="<?php echo $_smarty_tpl->getVariable('ci')->value->getIdCity();?>
"> <?php echo $_smarty_tpl->getVariable('ci')->value->getZipCode();?>

                        <?php echo $_smarty_tpl->getVariable('ci')->value->getName();?>
</option>
                <?php }} ?>
            </select>
        </div>
    </div>
</fieldset>
<fieldset>
    <legend>Général</legend>




        <div class="form-group">
            <label class="col-sm-2 control-label"  for="nature">Nature du bien : </label>

            <div class="col-sm-8">
                <select name="nature" class="form-control"
                        id="nature"> <?php  $_smarty_tpl->tpl_vars['it'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('listNature')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['it']->key => $_smarty_tpl->tpl_vars['it']->value){
?>
                        <option <?php if ($_smarty_tpl->getVariable('it')->value->getIdMandateNature()==$_smarty_tpl->getVariable('nature')->value){?>
                                selected="selected" <?php }?>value="<?php echo $_smarty_tpl->getVariable('it')->value->getIdMandateNature();?>
">
                            <?php echo $_smarty_tpl->getVariable('it')->value->getName();?>
</option>
                    <?php }} ?>
                </select></div>
        </div>
        <?php if ($_smarty_tpl->getVariable('user')->value->getLevelMember()->getIdLevelMember()<3){?>
            <div class="form-group">
                <label class="col-sm-2 control-label"  for="userSe">Utilisateur affecté
                    : </label>

                <div class="col-sm-8"><select class="form-control"
                                              name="userSe" id="userSe"> <?php  $_smarty_tpl->tpl_vars['i'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('listUser')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['i']->key => $_smarty_tpl->tpl_vars['i']->value){
?>
                            <option <?php if ($_smarty_tpl->getVariable('i')->value->getIdUser()==$_smarty_tpl->getVariable('userSe')->value){?> selected="selected"
                                                                    <?php }?>value="<?php echo $_smarty_tpl->getVariable('i')->value->getIdUser();?>
"><?php echo $_smarty_tpl->getVariable('i')->value->getFirstName();?>
 <?php echo $_smarty_tpl->getVariable('i')->value->getName();?>
</option>
                        <?php }} ?>
                    </select></div>
            </div>
        <?php }?>
        <?php if (!empty($_smarty_tpl->getVariable('listNotary',null,true,false)->value)){?>
            <div class="form-group">
                <label class="col-sm-2 control-label" for="notary">Notaire vendeur
                    : </label>

                <div class="col-sm-8"><select name="notary" class="form-control"
                                              id="notary"> <?php  $_smarty_tpl->tpl_vars['i'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('listNotary')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['i']->key => $_smarty_tpl->tpl_vars['i']->value){
?>
                            <option <?php if ($_smarty_tpl->getVariable('i')->value->getIdNotary()==$_smarty_tpl->getVariable('notary')->value){?> selected="selected"
                                                                      <?php }?>value="<?php echo $_smarty_tpl->getVariable('i')->value->getIdNotary();?>
"> <?php echo $_smarty_tpl->getVariable('i')->value->getName();?>
</option>
                        <?php }} ?>
                    </select></div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label"  for="notaryAcq">Notaire acquereur
                    :</label>

                <div class="col-sm-8">
                    <select name="notaryAcq" id="notaryAcq" class="form-control">
                        <option value="">NC</option>
                        <?php  $_smarty_tpl->tpl_vars['item'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('listNotary')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['item']->key => $_smarty_tpl->tpl_vars['item']->value){
?>
                            <option <?php if ($_smarty_tpl->getVariable('item')->value->getIdNotary()==$_smarty_tpl->getVariable('notaryAcq')->value){?>selected="selected"
                                    <?php }?>value="<?php echo $_smarty_tpl->getVariable('item')->value->getIdNotary();?>
"> <?php echo $_smarty_tpl->getVariable('item')->value->getName();?>
</option>
                        <?php }} ?>
                    </select>
                </div>
            </div>
        <?php }?>
        <div class="form-group">
            <label class="col-sm-2 control-label"  for="typeTransaction">Type de
                transaction : </label>

            <div class="col-sm-8"><select class="form-control"
                                          name="transactionType" id="typeTransaction"> <?php  $_smarty_tpl->tpl_vars['i'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('listTransactionType')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['i']->key => $_smarty_tpl->tpl_vars['i']->value){
?>
                        <option <?php if ($_smarty_tpl->getVariable('i')->value->getIdTransactionType()==$_smarty_tpl->getVariable('transactionType')->value){?>
                                selected="selected" <?php }?>value="<?php echo $_smarty_tpl->getVariable('i')->value->getIdTransactionType();?>
">
                            <?php echo $_smarty_tpl->getVariable('i')->value->getName();?>
</option>
                    <?php }} ?>
                </select></div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label"  for="typeBien">Type de bien : </label>

            <div class="col-sm-8"><select name="typeBien" class="form-control"
                                          id="typeBien"> <?php  $_smarty_tpl->tpl_vars['i'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('listMandateType')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['i']->key => $_smarty_tpl->tpl_vars['i']->value){
?>
                        <?php if ($_smarty_tpl->getVariable('i')->value->getIdMandateType()!=Constant::ID_PLOT_OF_LAND){?>
                            <option <?php if ($_smarty_tpl->getVariable('i')->value->getIdMandateType()==$_smarty_tpl->getVariable('typeBien')->value){?> selected="selected"
                                                                             <?php }?>value="<?php echo $_smarty_tpl->getVariable('i')->value->getIdMandateType();?>
"> <?php echo $_smarty_tpl->getVariable('i')->value->getName();?>
</option>
                        <?php }?>
                    <?php }} ?>
                </select>
            </div>
        </div>


</fieldset>

<fieldset>
    <legend>
        Mandat
    </legend>


    <div class="form-group">
        <label class="col-sm-2 control-label"  for="numMandat">Numéro de mandat : </label>

        <div class="col-sm-8">
            <input type="text" name="numMandat" id="numMandat" value="<?php echo $_smarty_tpl->getVariable('numMandat')->value;?>
" class="form-control"/>
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-2 control-label"  for="debutMandat">Début : </label>

        <div class="col-sm-8">
            <input type="text" class="datepicker form-control" name="debutMandat" id="debutMandat"
                   value="<?php echo $_smarty_tpl->getVariable('debutMandat')->value;?>
"/>
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-2 control-label"  for="finMandat">Fin : </label>

        <div class="col-sm-8"><input type="text"
                                     class="datepicker form-control" name="finMandat" id="finMandat"
                                     value="<?php echo $_smarty_tpl->getVariable('finMandat')->value;?>
"/>
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-2 control-label"  for="libreMandat">libre le : </label>

        <div class="col-sm-8"><input type="text"
                                     class="datepicker form-control" name="libreMandat" id="libreMandat"
                                     value="<?php echo $_smarty_tpl->getVariable('libreMandat')->value;?>
"/>
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-2 control-label"  for="numberlot">Numéro de lot : </label>

        <div class="col-sm-8">
            <input type="text" name="numberlot" id="numberlot" value="<?php echo $_smarty_tpl->getVariable('numberlot')->value;?>
" class="form-control"/>
        </div>
    </div>
</fieldset>

<fieldset>
    <legend>Prix</legend>

    <div class="form-group">
        <label class="col-sm-2 control-label"  for="prixFai">Prix FAI : </label>

        <div class="col-sm-8">
            <input type="text" class="form-control" name="prixFAI" id="prixFai" value="<?php echo $_smarty_tpl->getVariable('prixFAI')->value;?>
"/>
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-2 control-label"  for="prixNetVendeur">Prix net vendeur
            : </label><div class="col-sm-8">
            <input type="text" name="prixNetVendeur" id="prixNetVendeur" value="<?php echo $_smarty_tpl->getVariable('prixNetVendeur')->value;?>
" class="form-control"/>
        </div></div>
    <div class="form-group" id="jsCommission">
        <label class="col-sm-2 control-label"  for="commissionMandat">Commission
            : </label><div class="col-sm-8"><input type="text"
                             name="commission" id="commissionMandat" value="<?php echo $_smarty_tpl->getVariable('commission')->value;?>
" class="form-control"/>
    </div></div>
    <div class="form-group" id="jsEstim">
        <label class="col-sm-2 control-label"  for="estimationMini">Estimation Mini
            : </label><div class="col-sm-8"><input
                type="text" name="estimationMini" id="estimationMini"
                value="<?php echo $_smarty_tpl->getVariable('estimationMini')->value;?>
" class="form-control"/>
    </div></div>
    <div class="form-group" id="jsEstimMaxi">
        <label class="col-sm-2 control-label"  for="estimationMaxi">
            Estimation Maxi : </label>
        <div class="col-sm-8">
            <input type="text" name="estimationMaxi" id="estimationMaxi" value="<?php echo $_smarty_tpl->getVariable('estimationMaxi')->value;?>
" class="form-control"/>
        </div>
    </div>
    <div class="form-group" id="jsMargeNegoce">
        <label class="col-sm-2 control-label"  for="margeNegoce">
            Marge negoce:
        </label>
        <div class="col-sm-8">
            <input type="text" name="margeNegoce" id="margeNegoce" value="<?php echo $_smarty_tpl->getVariable('margeNegoce')->value;?>
" class="form-control"/>
        </div>
    </div>

    <div class="form-group" id="jsRental">

        <label class="col-sm-2 control-label"  for="rental">
            Loyer actuel (si locataires ) :</label><div class="col-sm-8"><input class="form-control" type="text" name="rental" id="rental" value="<?php echo $_smarty_tpl->getVariable('rental')->value;?>
"/>
    </div></div>

    <div class="form-group">
        <label class="col-sm-2 control-label"  for="pricegarage">Prix
            garage : </label>
        <div class="col-sm-8">
            <input type="text" name="pricegarage" id="pricegarage" value="<?php echo $_smarty_tpl->getVariable('pricegarage')->value;?>
" class="form-control"/>
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-2 control-label"  for="pricecellar">Prix
            Cave : </label>
        <div class="col-sm-8">
        <input class="form-control" type="text" name="pricecellar" id="pricecellar" value="<?php echo $_smarty_tpl->getVariable('pricecellar')->value;?>
"/>
        </div>
        </div>
    <div class="form-group">
        <label class="col-sm-2 control-label"  for="profitability">Rentabilité
            en % :</label>
        <div class="col-sm-8">
        <input class="form-control" type="text" name="profitability" id="profitability" value="<?php echo $_smarty_tpl->getVariable('profitability')->value;?>
"/>
        </div>
        </div>

</fieldset>

<fieldset>
    <legend>
        Géolocalisation
    </legend>

        <div class="form-group">

            <p class="help-block col-sm-offset-2">En degrès sexagésimaux :</p>
            <label class="col-sm-2 control-label"  for="latitude">Latitude
                : </label><div class="col-sm-8"><input type="text"
                                 id="latitude" name="latitude" value="<?php echo $_smarty_tpl->getVariable('latitude')->value;?>
" class="form-control"/>
        </div></div>
        <div class="form-group">
            <label class="col-sm-2 control-label"  for="longitude"> Longitude : </label>
            <div class="col-sm-8"><input type="text"
                   id="longitude" name="longitude" value="<?php echo $_smarty_tpl->getVariable('longitude')->value;?>
" class="form-control"/>
        </div>
        </div>


</fieldset>


<div class="form-group">
    <div class="col-sm-offset-2 col-sm-8">
        <button type="submit" name="valid" value="Valider" class="btn btn-warning" >
            <i class="fa fa-save"></i> Mettre à jour
            </button>
        <button type="submit" name="cancel" value="Annuler" class="btn btn-default" >
            <i class="fa fa-close"></i> Annuler et fermer
            </button>
    </div>
</div>
</form>
</div>
