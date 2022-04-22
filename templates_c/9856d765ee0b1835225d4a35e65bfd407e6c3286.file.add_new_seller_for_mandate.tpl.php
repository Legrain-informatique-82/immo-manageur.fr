<?php /* Smarty version Smarty-3.0.6, created on 2014-09-12 11:39:12
         compiled from "/var/www/aptana/immo-manageur.fr/modules/mandat/views/add_new_seller_for_mandate.tpl" */ ?>
<?php /*%%SmartyHeaderCode:20349420855412bf400d3cb2-04046612%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '9856d765ee0b1835225d4a35e65bfd407e6c3286' => 
    array (
      0 => '/var/www/aptana/immo-manageur.fr/modules/mandat/views/add_new_seller_for_mandate.tpl',
      1 => 1410514750,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '20349420855412bf400d3cb2-04046612',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<?php $_template = new Smarty_Internal_Template("tpl_default/entete.tpl", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate();?><?php $_template->updateParentVariables(0);?><?php unset($_template);?>


<div class="row bg-success bannerTitle">
    <div class="col-md-6">
        <h1 class="h2">Ajouter un vendeur au mandat : <?php echo $_smarty_tpl->getVariable('mandate')->value->getNumberMandate();?>
</h1>
    </div>

    <div class="col-md-6">
        <p class="h4 text-right ">

            <a title="annuler et fermer" class="btn btn-default" href="<?php echo Tools::create_url($_smarty_tpl->getVariable('user')->value,"mandat","see",$_GET['action']);?>
">
                <i class="fa fa-close fa-2x"></i>
            </a>
        </p>
    </div>
</div>
<div class="row">

    <div class="col-md-5">
        <h2>A partir d'un nouveau vendeur</h2>
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
</li>
            <?php if ($_smarty_tpl->getVariable('smarty')->value['foreach']['e']['last']){?>
                </ul>
            <?php }?> <?php }} ?>
            </div>
        <?php }?>
        <div class="bulle" id="blocMandate">
            <form action="" method="post" role="form" class="form-horizontal">
                <?php $_template = new Smarty_Internal_Template('seller/views/frm_add_seller.tpl', $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate();?><?php $_template->updateParentVariables(0);?><?php unset($_template);?>

                <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-8">
                        <div class="checkbox">
                            <label>
                                <input type="checkbox" name="sellerByDefault" id="sellerByDefault" value="on"  /> Définir comme vendeur par defaut.
                            </label>
                        </div>
                    </div>
                </div>





                <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-8">
                        <button class="btn btn-success" type="submit" value="<?php echo Lang::LABEL_SAVE;?>
" id="seller_add_submit_send" name="seller_add_submit_send" >
                            <i class="fa fa-save"></i> <?php echo Lang::LABEL_SAVE;?>

                        </button>


                    </div>

                </div>
            </form>
        </div>
    </div>

    <div class="col-md-7">
        <h2>D'un vendeur de la liste ci-dessous</h2>
        <table class="dataTableDefault table table-striped table-bordered" data-display_length="10">
            <thead>
            <tr class="tri">
                <th class="jshide"></th>
                <th></th>
                <th></th>
                <th class="jshide"></th>
                <th class="jshide"></th>
                <th></th>
                <th class="jshide"></th>
            </tr>
            <tr>

                <th>Nom &amp; prénom</th>
                <th>Titre</th>
                <th>Opérateur lié</th>
                <th>Téléphones</th>
                <th>Email</th>
                <th>Etat</th>
                <th>De ce vendeur</th>
            </tr>
            </thead>
            <tbody>
            <?php  $_smarty_tpl->tpl_vars['item'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('listSeller')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
 $_smarty_tpl->tpl_vars['smarty']->value['foreach']["frm"]['iteration']=0;
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['item']->key => $_smarty_tpl->tpl_vars['item']->value){
 $_smarty_tpl->tpl_vars['smarty']->value['foreach']["frm"]['iteration']++;
?>
                <tr>

                    <td><?php echo $_smarty_tpl->getVariable('item')->value->getName();?>
 <?php echo $_smarty_tpl->getVariable('item')->value->getFirstname();?>
</td>
                    <td><?php echo $_smarty_tpl->getVariable('item')->value->getSellerTitle()->getLibel();?>
</td>
                    <td><?php echo $_smarty_tpl->getVariable('item')->value->getUser()->getFirstname();?>
 <?php echo $_smarty_tpl->getVariable('item')->value->getUser()->getName();?>
</td>
                    <td><?php if ($_smarty_tpl->getVariable('item')->value->getPhone()){?>
                            <p><?php echo Lang::LABEL_SELLER_ADD_PHONE;?>
<?php echo $_smarty_tpl->getVariable('item')->value->getPhone();?>
</p><?php }?> <?php if ($_smarty_tpl->getVariable('item')->value->getMobilPhone()){?>
                            <p><?php echo Lang::LABEL_SELLER_ADD_MOBIL_PHONE;?>
<?php echo $_smarty_tpl->getVariable('item')->value->getMobilPhone();?>
</p><?php }?>
                        <?php if ($_smarty_tpl->getVariable('item')->value->getWorkPhone()){?>
                            <p><?php echo Lang::LABEL_SELLER_ADD_WORK_PHONE;?>
<?php echo $_smarty_tpl->getVariable('item')->value->getWorkPhone();?>
</p><?php }?>
                    </td>
                    <td><?php echo $_smarty_tpl->getVariable('item')->value->getEmail();?>
</td>
                    <td><?php if ($_smarty_tpl->getVariable('item')->value->getAsset()==1){?>Actif<?php }else{ ?>Inactif<?php }?></td>
                    <td>
                        <form action="" method="post">
                            <p>
                                <input type="hidden" name="idSeller"
                                       value="<?php echo $_smarty_tpl->getVariable('item')->value->getIdSeller();?>
" /> <label
                                        for="sellerByDefault<?php echo $_smarty_tpl->getVariable('smarty')->value['foreach']['frm']['iteration'];?>
">Définir
                                    comme vendeur par defaut : <input value="on" type="checkbox"
                                                                      name="sellerByDefault"
                                                                      id="sellerByDefault<?php echo $_smarty_tpl->getVariable('smarty')->value['foreach']['frm']['iteration'];?>
" /> </label>
                            </p>
                            <p>
                                <input class="btn btn-default" type="submit" name="used" value="Affecter ce vendeur" />
                            </p>
                        </form>
                    </td>
                </tr>
            <?php }} ?>
            </tbody>
        </table>
    </div>

</div>
