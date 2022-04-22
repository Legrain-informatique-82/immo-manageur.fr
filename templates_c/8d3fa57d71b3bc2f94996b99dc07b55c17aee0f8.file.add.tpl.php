<?php /* Smarty version Smarty-3.0.6, created on 2014-09-18 16:53:03
         compiled from "/var/www/aptana/immo-manageur.fr/modules/acquereur/views/add.tpl" */ ?>
<?php /*%%SmartyHeaderCode:260434158541af1cf9c6334-74554060%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '8d3fa57d71b3bc2f94996b99dc07b55c17aee0f8' => 
    array (
      0 => '/var/www/aptana/immo-manageur.fr/modules/acquereur/views/add.tpl',
      1 => 1411033724,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '260434158541af1cf9c6334-74554060',
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
        <h1 class="h2"><?php echo $_smarty_tpl->getVariable('h1')->value;?>
</h1>
    </div>

    <div class="col-md-6">
        <p class="h4 text-right ">
            <button type="submit" class="btn <?php if ($_smarty_tpl->getVariable('add')->value){?>btn-success<?php }else{ ?>btn-warning<?php }?>" name="valid">
                <i class="fa fa-save fa-2x"></i>
            </button>
            <a title="Annuler et fermer" class="btn btn-default" href="<?php echo Tools::create_url($_smarty_tpl->getVariable('user')->value,"acquereur","list");?>
">
                <i class="fa fa-close fa-2x"></i>
            </a>
        </p>
    </div>
</div>


<?php $_template = new Smarty_Internal_Template("tpl_default/error.tpl", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate();?><?php $_template->updateParentVariables(0);?><?php unset($_template);?>




<?php if ($_smarty_tpl->getVariable('listUser')->value){?>

    <fieldset>
        <legend>Utilisateur affecté </legend>
        <div class="form-group">
            <label class="col-sm-2 control-label" for="userSelected">Utilisateur affecté : </label>
            <div class="col-sm-8">
                <select class="form-control" name="userSelected" id="userSelected">
                    <?php  $_smarty_tpl->tpl_vars['u'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('listUser')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['u']->key => $_smarty_tpl->tpl_vars['u']->value){
?>
                        <option <?php if ($_smarty_tpl->getVariable('userSelected')->value==$_smarty_tpl->getVariable('u')->value->getIdUser()){?> selected="selected"
                        <?php }?> value="<?php echo $_smarty_tpl->getVariable('u')->value->getIdUser();?>
"><?php echo $_smarty_tpl->getVariable('u')->value->getName();?>
 <?php echo $_smarty_tpl->getVariable('u')->value->getFirstname();?>
</option>
                    <?php }} ?>
                </select>
            </div>
        </div>
    </fieldset>
<?php }?>
<fieldset>
    <legend>Acquereur</legend>
    <div class="form-group">
        <label class="col-sm-2 control-label" for="titreAcquereur">Titre acquereur</label>
        <div class="col-sm-8">
            <select class="form-control" name="titreAcquereur" id="titreAcquereur">
                <?php  $_smarty_tpl->tpl_vars['c'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('listTitre')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['c']->key => $_smarty_tpl->tpl_vars['c']->value){
?>
                    <option <?php if ($_smarty_tpl->getVariable('titreAcquereur')->value==$_smarty_tpl->getVariable('c')->value->getIdTitreAcquereur()){?>
                        selected="selected" <?php }?> value="<?php echo $_smarty_tpl->getVariable('c')->value->getIdTitreAcquereur();?>
">
                        <?php echo $_smarty_tpl->getVariable('c')->value->getName();?>
</option> <?php }} ?>
            </select>
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-2 control-label" for="name">Nom : </label>
        <div class="col-sm-8">
            <input class="form-control" type="text" name="name" value="<?php echo $_smarty_tpl->getVariable('name')->value;?>
" id="name" />
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-2 control-label" for="maidenName">Nom de jeune fille : </label>
        <div class="col-sm-8">
            <input class="form-control" type="text" name="maidenName" value="<?php echo $_smarty_tpl->getVariable('maidenName')->value;?>
" id="maidenName" />
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-2 control-label" for="firstname">Prénom :</label>
        <div class="col-sm-8">
            <input class="form-control" type="text" name="firstname" value="<?php echo $_smarty_tpl->getVariable('firstname')->value;?>
" id="firstname" />
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-2 control-label" for="address">Adresse :</label>
        <div class="col-sm-8">
            <input type="text" name="address" value="<?php echo $_smarty_tpl->getVariable('address')->value;?>
" id="address" class="form-control"/>
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-2 control-label" for="city">Ville : </label>
        <div class="col-sm-8">
            <select class="form-control" name="city" id="city">
                <?php  $_smarty_tpl->tpl_vars['c'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('listCity')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['c']->key => $_smarty_tpl->tpl_vars['c']->value){
?>
                    <option <?php if ($_smarty_tpl->getVariable('city')->value==$_smarty_tpl->getVariable('c')->value->getIdCity()){?> selected="selected" <?php }?>
                            value="<?php echo $_smarty_tpl->getVariable('c')->value->getIdCity();?>
"> <?php echo $_smarty_tpl->getVariable('c')->value->getZipCode();?>
 <?php echo $_smarty_tpl->getVariable('c')->value->getName();?>
</option>
                <?php }} ?>
            </select>
        </div>
    </div>

    <div class="form-group">
        <label class="col-sm-2 control-label" for="phone">Téléphone :</label>
        <div class="col-sm-8">
            <input class="form-control" type="text" name="phone" value="<?php echo $_smarty_tpl->getVariable('phone')->value;?>
" id="phone" />
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-2 control-label" for="mobilPhone">Téléphone portable :</label>
        <div class="col-sm-8">
            <input type="text" class="form-control" name="mobilPhone" value="<?php echo $_smarty_tpl->getVariable('mobilPhone')->value;?>
" id="mobilPhone" />
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-2 control-label" for="workPhone">Téléphone ( travail) :</label>
        <div class="col-sm-8">
            <input type="text" class="form-control" name="workPhone" value="<?php echo $_smarty_tpl->getVariable('workPhone')->value;?>
" id="workPhone" />
        </div>
    </div>

    <div class="form-group">
        <label class="col-sm-2 control-label" for="fax">Fax :</label>
        <div class="col-sm-8">
            <input type="text" name="fax" value="<?php echo $_smarty_tpl->getVariable('fax')->value;?>
" id="fax" class="form-control"/>
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-2 control-label" for="email">Email :</label>
        <div class="col-sm-8">
            <input class="form-control" type="text" name="email" value="<?php echo $_smarty_tpl->getVariable('email')->value;?>
" id="email" />
        </div>
    </div>


    <div class="form-group">
        <label class="col-sm-2 control-label" for="birthdate">Date de naissance :</label>
        <div class="col-sm-8">
            <input type="text" name="birthdate" value="<?php echo $_smarty_tpl->getVariable('birthdate')->value;?>
" id="birthdate" class="datepicker form-control"/>
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-2 control-label" for="birthLocation">Lieu de naissance :</label>
        <div class="col-sm-8">
            <input type="text" name="birthLocation" value="<?php echo $_smarty_tpl->getVariable('birthLocation')->value;?>
" id="birthLocation" class="form-control"/>
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-2 control-label" for="nationality">Nationalité :</label>
        <div class="col-sm-8">
            <input class="form-control" type="text" name="nationality" value="<?php echo $_smarty_tpl->getVariable('nationality')->value;?>
" id="nationality" />
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-2 control-label" for="job">Profession :</label>
        <div class="col-sm-8">
            <input type="text" class="form-control" name="job" value="<?php echo $_smarty_tpl->getVariable('job')->value;?>
" id="job" />
        </div>
    </div>
</fieldset>

<?php if ($_smarty_tpl->getVariable('listSituation')->value){?>
    <fieldset>
        <legend>Situation de famille : </legend>
        <?php  $_smarty_tpl->tpl_vars["itemSit"] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('listSituation')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
 $_smarty_tpl->tpl_vars['smarty']->value['foreach']["boucle"]['iteration']=0;
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars["itemSit"]->key => $_smarty_tpl->tpl_vars["itemSit"]->value){
 $_smarty_tpl->tpl_vars['smarty']->value['foreach']["boucle"]['iteration']++;
?>
            <?php if ($_smarty_tpl->getVariable('situation')->value==$_smarty_tpl->getVariable('itemSit')->value->getId()){?>
                <?php $_smarty_tpl->tpl_vars["valueOk"] = new Smarty_variable("1", null, null);?>
            <?php }else{ ?>
                <?php $_smarty_tpl->tpl_vars["valueOk"] = new Smarty_variable("0", null, null);?>
            <?php }?>

            <div class="form-group ">
                <span class="col-sm-2 control-label"></span>
                <div class="col-sm-8">

                    <div class="form-group row">

                        <div class="checkbox col-sm-3">
                        <label for="situation_<?php echo $_smarty_tpl->getVariable('smarty')->value['foreach']['boucle']['iteration'];?>
">
                            <input type="radio" name="situation" id="situation_<?php echo $_smarty_tpl->getVariable('smarty')->value['foreach']['boucle']['iteration'];?>
" value="<?php echo $_smarty_tpl->getVariable('itemSit')->value->getId();?>
" <?php if ($_smarty_tpl->getVariable('situation')->value==$_smarty_tpl->getVariable('itemSit')->value->getId()){?> checked="checked"<?php }?>/>
                            <?php echo $_smarty_tpl->getVariable('itemSit')->value->getName();?>

                        </label>
                        </div>
                        <input type="hidden" name="id[]" value="<?php echo $_smarty_tpl->getVariable('itemSit')->value->getId();?>
"/>

                        <?php if ($_smarty_tpl->getVariable('itemSit')->value->getIfEventDate()){?>
                            <label for="date_<?php echo $_smarty_tpl->getVariable('smarty')->value['foreach']['boucle']['iteration'];?>
" class="col-sm-1 control-label">  Le :</label><div class="col-sm-2"> <input id="date_<?php echo $_smarty_tpl->getVariable('smarty')->value['foreach']['boucle']['iteration'];?>
" type="text" name="eventDate[]"  class="datepicker form-control" value="<?php if ($_smarty_tpl->getVariable('valueOk')->value==1){?><?php echo $_smarty_tpl->getVariable('situationDate')->value;?>
<?php }?>"/></div>
                        <?php }else{ ?>
                            <input type="hidden" name="eventDate[]" value="" />
                        <?php }?>

                        <?php if ($_smarty_tpl->getVariable('itemSit')->value->getIfEventLocation()){?>
                        <label for="location_<?php echo $_smarty_tpl->getVariable('smarty')->value['foreach']['boucle']['iteration'];?>
" class="col-sm-1 control-label">À :</label> <div class="col-sm-5"><input id="location_<?php echo $_smarty_tpl->getVariable('smarty')->value['foreach']['boucle']['iteration'];?>
" type="text" name="eventLocation[]"  class="form-control" value="<?php if ($_smarty_tpl->getVariable('valueOk')->value==1){?><?php echo $_smarty_tpl->getVariable('situationLocation')->value;?>
<?php }?>" /></div>
                        <?php }else{ ?>
                            <input type="hidden" name="eventLocation[]" value="" />
                        <?php }?>
                    </div>
                </div>
            </div>


        <?php }} ?>

    </fieldset>
<?php }?>
<fieldset>
    <legend>Critères de recherche : </legend>
    <div class="form-group">
        <label class="col-sm-2 control-label" for="typeTransaction">	Type transaction :</label>
        <div class="col-sm-8">
            <select class="form-control" name="typeTransaction" id="typeTransaction">
                <?php  $_smarty_tpl->tpl_vars['c'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('listTypeTransaction')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['c']->key => $_smarty_tpl->tpl_vars['c']->value){
?>
                    <option <?php if ($_smarty_tpl->getVariable('typeTransaction')->value==$_smarty_tpl->getVariable('c')->value->getIdTransactionType()){?>
                        selected="selected" <?php }?> value="<?php echo $_smarty_tpl->getVariable('c')->value->getIdTransactionType();?>
">
                        <?php echo str_replace('Vente','Achat',$_smarty_tpl->getVariable('c')->value->getName());?>
</option> <?php }} ?>
            </select>
        </div>
    </div>

    <div class="form-group">
        <label class="col-sm-2 control-label" for="typeBien">Type de bien : </label>
        <div class="col-sm-8">
            <select class="form-control" name="typeBien" id="typeBien">
                <option value="0">Indifférent</option>
                <?php  $_smarty_tpl->tpl_vars['c'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('listTypeBien')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['c']->key => $_smarty_tpl->tpl_vars['c']->value){
?>
                    <option <?php if ($_smarty_tpl->getVariable('typeBien')->value==$_smarty_tpl->getVariable('c')->value->getIdMandateType()){?> selected="selected"
                    <?php }?> value="<?php echo $_smarty_tpl->getVariable('c')->value->getIdMandateType();?>
"> <?php echo $_smarty_tpl->getVariable('c')->value->getName();?>
</option>
                <?php }} ?>
            </select>
        </div>
    </div>
    <div class="form-group" id="pStyle">
        <label class="col-sm-2 control-label" for="style">Style :</label>
        <div class="col-sm-8">
            <select class="form-control" name="style" id="style">
                <option value="undefined" <?php if ($_smarty_tpl->getVariable('style')->value=='undefined'){?> selected="selected"<?php }?>>Indifférent</option>
                <?php  $_smarty_tpl->tpl_vars['c'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('listStyle')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['c']->key => $_smarty_tpl->tpl_vars['c']->value){
?>
                    <option <?php if ($_smarty_tpl->getVariable('style')->value==$_smarty_tpl->getVariable('c')->value->getIdMandateStyle()){?> selected="selected"
                    <?php }?> value="<?php echo $_smarty_tpl->getVariable('c')->value->getIdMandateStyle();?>
"> <?php echo $_smarty_tpl->getVariable('c')->value->getName();?>
</option>
                <?php }} ?>
            </select>
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-2 control-label" for="prixMin">Prix minimum : </label>
        <div class="col-sm-8">
            <input type="text" name="prixMin" id="prixMin" value="<?php echo $_smarty_tpl->getVariable('prixMin')->value;?>
" class="form-control" />
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-2 control-label" for="prixMax">Prix maximum : </label>
        <div class="col-sm-8">
            <input class="form-control" type="text" name="prixMax" id="prixMax" value="<?php echo $_smarty_tpl->getVariable('prixMax')->value;?>
" />
        </div>
    </div>

    <div class="form-group">
        <label class="col-sm-2 control-label" for="surfaceTmin">Surface terrain minimum : </label>
        <div class="col-sm-8">
            <input class="form-control" type="text" name="surfaceTmin" id="surfaceTmin" value="<?php echo $_smarty_tpl->getVariable('surfaceTmin')->value;?>
" />
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-2 control-label" for="surfaceTmax">Surface terrain Maximum :</label>
        <div class="col-sm-8">
            <input type="text" class="form-control" name="surfaceTmax" id="surfaceTmax" value="<?php echo $_smarty_tpl->getVariable('surfaceTmax')->value;?>
" />
        </div>
    </div>

    <div class="form-group">
        <label class="col-sm-2 control-label" for="surfaceHmin">Surface habitable minimum :</label>
        <div class="col-sm-8">
            <input type="text" name="surfaceHmin" id="surfaceHmin" value="<?php echo $_smarty_tpl->getVariable('surfaceHmin')->value;?>
" class="form-control" />
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-2 control-label" for="surfaceHmax">Surface habitable Maximum :</label>
        <div class="col-sm-8">
        <input class="form-control" type="text" name="surfaceHmax" id="surfaceHmax" value="<?php echo $_smarty_tpl->getVariable('surfaceHmax')->value;?>
" />
            </div>
    </div>

    <div class="form-group">
        <label class="col-sm-2 control-label" for="sector">Secteur : </label>
        <div class="col-sm-8">
        <select class="form-control" name="sector" id="sector">
            <option value="undefined" <?php if ($_smarty_tpl->getVariable('sector')->value=='undefined'){?> selected="selected"<?php }?>>Indifférent</option>
            <?php  $_smarty_tpl->tpl_vars['c'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('listSector')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['c']->key => $_smarty_tpl->tpl_vars['c']->value){
?>
                <option <?php if ($_smarty_tpl->getVariable('sector')->value==$_smarty_tpl->getVariable('c')->value->getIdSector()){?> selected="selected" <?php }?>
                        value="<?php echo $_smarty_tpl->getVariable('c')->value->getIdSector();?>
"> <?php echo $_smarty_tpl->getVariable('c')->value->getName();?>
</option> <?php }} ?>
        </select>
            </div>
    </div>
    <div class="form-group">
        <label class="col-sm-2 control-label" for="rCity"> Ville :</label>
        <div class="col-sm-8">
        <select class="form-control" name="rCity" id="rCity">
            <option value="undefined" <?php if ($_smarty_tpl->getVariable('rCity')->value=='undefined'){?> selected="selected"<?php }?>>Indifférent</option>
            <?php  $_smarty_tpl->tpl_vars['c'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('listCity')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['c']->key => $_smarty_tpl->tpl_vars['c']->value){
?>
                <option <?php if ($_smarty_tpl->getVariable('rCity')->value==$_smarty_tpl->getVariable('c')->value->getIdCity()){?> selected="selected" <?php }?>
                        value="<?php echo $_smarty_tpl->getVariable('c')->value->getIdCity();?>
"> <?php echo $_smarty_tpl->getVariable('c')->value->getZipCode();?>
 <?php echo $_smarty_tpl->getVariable('c')->value->getName();?>
</option>
            <?php }} ?>
        </select>
            </div>
    </div>
</fieldset>
<fieldset>
    <legend>Commentaire :</legend>
    <div class="form-group">
        <label class="col-sm-2 control-label" for="commentAcq">Commentaire sur l'acquereur :</label>
        <div class="col-sm-8">
        <textarea class="form-control" name="comment" id="commentAcq" cols="30" rows="10"><?php echo $_smarty_tpl->getVariable('comment')->value;?>
</textarea>
            </div>
    </div>
</fieldset>
<div class="form-group">
    <div class="col-sm-offset-2 col-sm-8">
        <button class="btn <?php if ($_smarty_tpl->getVariable('add')->value){?>btn-success<?php }else{ ?>btn-warning<?php }?>" type="submit"  name="valid" value="Valider">
            <i class="fa fa-save"></i> <?php if ($_smarty_tpl->getVariable('add')->value){?>Ajouter<?php }else{ ?>Mettre à jour<?php }?>
        </button>
        <a class="btn btn-default" href="<?php echo Tools::create_url($_smarty_tpl->getVariable('user')->value,"acquereur","list");?>
">
            <i class="fa-fa-cancel"></i> Annuler
        </a>

    </div>
</div>
</form>

