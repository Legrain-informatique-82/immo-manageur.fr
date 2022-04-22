<?php /* Smarty version Smarty-3.0.6, created on 2014-09-18 11:40:25
         compiled from "/var/www/aptana/immo-manageur.fr/modules/export/views/list.tpl" */ ?>
<?php /*%%SmartyHeaderCode:1544053519541aa8897661c3-75550902%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'bbe72d6744f502a7a611ccb50c6231dc8b0c1fec' => 
    array (
      0 => '/var/www/aptana/immo-manageur.fr/modules/export/views/list.tpl',
      1 => 1411033222,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1544053519541aa8897661c3-75550902',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<?php $_template = new Smarty_Internal_Template('tpl_default/entete.tpl', $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate();?><?php $_template->updateParentVariables(0);?><?php unset($_template);?>

<form action="" method="post" class="form-horizontal" role="form">
    <div class="row bg-success bannerTitle">
        <div class="col-md-6">
            <h1 class="h2">Mandats et exports</h1>
        </div>

        <div class="col-md-6">
            <p class="h4 text-right ">
                <button type="submit" class="btn btn-warning" name="send" title="Mettre à jour" value="Mettre à jour">
                    <i class="fa fa-save fa-2x"></i>
                </button>
                <a title="Revenir à la liste de choix des passerelles" class="btn btn-default" href="<?php echo Tools::create_url($_smarty_tpl->getVariable('user')->value,'export','preList');?>
">
                    <i class="fa fa-close fa-2x"></i>
                </a>
        </div>
    </div>




    <div class="form-inline" role="form">
        <div class="col-md-12">
        <div class="form-group">
            <label for="agency">Afficher les mandats de :  </label>
            <div class="input-group">
                <select name="agency" id="agency" class="form-control">
                    <option value="ALL" <?php if ($_smarty_tpl->getVariable('agency')->value=='ALL'){?> selected="selected"<?php }?>>Toute
                        les agences</option> <?php  $_smarty_tpl->tpl_vars['a'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('listAgency')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['a']->key => $_smarty_tpl->tpl_vars['a']->value){
?>
                        <option value="<?php echo $_smarty_tpl->getVariable('a')->value->getIdAgency();?>
" <?php if ($_smarty_tpl->getVariable('agency')->value==$_smarty_tpl->getVariable('a')->value->getIdAgency()){?>
                            selected="selected" <?php }?>>l'agence de <?php echo $_smarty_tpl->getVariable('a')->value->getName();?>
</option>
                    <?php }} ?>
                </select>
                 <span class="input-group-btn">
                <button type="submit" name="toogleConfidentialMode" value="Ok"  class="btn btn-default" >Valider</button>
                     </span>
            </div>


        </div>
        </div>
    </div>

    <table class="dataTableDefaultWithoutPagination table table-striped table-bordered">
        <thead>
        <tr class="tri">
            <th></th>
            <th></th>
            <th></th>
            <th class="jshide"></th>
            <th></th>
            <th></th>
            <th></th>
            <th class="jshide"></th>
            <th class="jshide"></th>
            <th class="jshide"></th>
        </tr>
        <tr>

            <th><p>Numéro de mandat</p></th>
            <th><p>Type du bien</p></th>
            <th><p>Prénom et<br/>nom du vendeur</p></th>
            <th><p>Adresse<br/> du bien</p></th>
            <th><p>Code postal</p></th>
            <th><p>Ville</p></th>
            <th><p>Secteur</p></th>
            <th>
                <p>Voir la fiche</p>
            </th>
            <th><p>Image du mandat</p></th>

            <?php  $_smarty_tpl->tpl_vars['pa'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('listPasserelle')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['pa']->key => $_smarty_tpl->tpl_vars['pa']->value){
?> 
                <th><p><?php echo $_smarty_tpl->getVariable('pa')->value->getName();?>
</p>
                    <p class="JsVisible">
                        Tout cocher : <input type="checkbox" name="checkAll" class="jsCheckAll" rel="<?php echo $_smarty_tpl->getVariable('pa')->value->getIdPasserelle();?>
" />
                    </p>
                </th> <?php }} ?>

        </tr>
        </thead>
        <tbody>
        <?php  $_smarty_tpl->tpl_vars['m'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('listMandate')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['m']->key => $_smarty_tpl->tpl_vars['m']->value){
?>
            <tr>
                <td><?php echo $_smarty_tpl->getVariable('m')->value->getNumberMandate();?>
</td>
                <td>
                    <?php echo $_smarty_tpl->getVariable('m')->value->getMandateType()->getName();?>



                </td>
                <td> <?php if ($_smarty_tpl->getVariable('m')->value->getDefaultSeller()){?>
                        <?php echo $_smarty_tpl->getVariable('m')->value->getDefaultSeller()->getFirstname();?>
 <?php echo $_smarty_tpl->getVariable('m')->value->getDefaultSeller()->getName();?>

                    <?php }else{ ?>
                        NC
                    <?php }?>
                </td>
                <td><p>
                        <?php echo $_smarty_tpl->getVariable('m')->value->getAddress();?>
<br /><?php echo $_smarty_tpl->getVariable('m')->value->getCity()->getZipCode();?>

                        <?php echo $_smarty_tpl->getVariable('m')->value->getCity()->getName();?>

                    </p></td>
                <td><?php echo $_smarty_tpl->getVariable('m')->value->getCity()->getZipCode();?>
</td>
                <td><?php echo $_smarty_tpl->getVariable('m')->value->getCity()->getName();?>
</td>
                <td><?php echo $_smarty_tpl->getVariable('m')->value->getCity()->getSector()->getName();?>
</td>
                <td><?php if ($_smarty_tpl->getVariable('m')->value->getMandateType()->getIdMandateType()==Constant::ID_PLOT_OF_LAND){?>
                        <?php $_smarty_tpl->tpl_vars["mod"] = new Smarty_variable("terrain", null, null);?>
                    <?php }else{ ?>
                        <?php $_smarty_tpl->tpl_vars["mod"] = new Smarty_variable("mandat", null, null);?>
                    <?php }?>

                    <a href="<?php echo tools::create_url($_smarty_tpl->getVariable('user')->value,$_smarty_tpl->getVariable('mod')->value,'see',$_smarty_tpl->getVariable('m')->value->getIdMandate());?>
" class="btn btn-default">Fiche du bien</a>

                </td>
                <td><p>
                        <?php if ($_smarty_tpl->getVariable('m')->value->getPictureByDefault()){?>
                            <a class="fancybox" href="<?php echo Constant::DEFAULT_URL_PICTURE_MODULE_DIRECTORY;?>
<?php if ($_smarty_tpl->getVariable('m')->value->getMandateType()->getIdMandateType()==Constant::ID_PLOT_OF_LAND){?>terrain<?php }else{ ?>mandat<?php }?>/big/<?php echo $_smarty_tpl->getVariable('m')->value->getPictureByDefault()->getName();?>
">
                                <img src="<?php echo Constant::DEFAULT_URL_PICTURE_MODULE_DIRECTORY;?>
<?php if ($_smarty_tpl->getVariable('m')->value->getMandateType()->getIdMandateType()==Constant::ID_PLOT_OF_LAND){?>terrain<?php }else{ ?>mandat<?php }?>/thumb/<?php echo $_smarty_tpl->getVariable('m')->value->getPictureByDefault()->getName();?>
" alt=""  class="img-thumbnail img-responsive"/>
                            </a>
                        <?php }else{ ?>
                            NC
                        <?php }?>
                    </p></td>
                <?php  $_smarty_tpl->tpl_vars['pa'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('listPasserelle')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['pa']->key => $_smarty_tpl->tpl_vars['pa']->value){
?>
                    <td data-order="<?php if ($_smarty_tpl->getVariable('pa')->value->isLinked($_smarty_tpl->tpl_vars['m']->value)){?>1<?php }else{ ?>0<?php }?>">

                        <p>
                            <input type="hidden" name="hidden_<?php echo $_smarty_tpl->getVariable('pa')->value->getIdPasserelle();?>
_<?php echo $_smarty_tpl->getVariable('m')->value->getIdMandate();?>
" value="" />
                            <input type="checkbox" rel="<?php echo $_smarty_tpl->getVariable('pa')->value->getIdPasserelle();?>
" name="export_<?php echo $_smarty_tpl->getVariable('pa')->value->getIdPasserelle();?>
_<?php echo $_smarty_tpl->getVariable('m')->value->getIdMandate();?>
" <?php if ($_smarty_tpl->getVariable('pa')->value->isLinked($_smarty_tpl->tpl_vars['m']->value)){?> checked="checked" <?php }?> value="1"/>
                        </p>
                    </td>
                <?php }} ?>
            </tr>
        <?php }} ?>
        </tbody>
    </table>

</form>
</div>
