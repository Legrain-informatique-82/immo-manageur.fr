<?php /* Smarty version Smarty-3.0.6, created on 2014-09-23 16:44:59
         compiled from "/var/www/aptana/immo-manageur.fr/modules/export_site/views/fourchettes.tpl" */ ?>
<?php /*%%SmartyHeaderCode:4750628525421876b36ff24-71649435%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'b96f33e4119ffdb66812885aad25402ccd241804' => 
    array (
      0 => '/var/www/aptana/immo-manageur.fr/modules/export_site/views/fourchettes.tpl',
      1 => 1411483498,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '4750628525421876b36ff24-71649435',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<?php $_template = new Smarty_Internal_Template("tpl_default/entete.tpl", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate();?><?php $_template->updateParentVariables(0);?><?php unset($_template);?>
<div class="row bg-success bannerTitle">
    <div class="col-md-12">
        <h1 class="h2">Gestion des fourchettes</h1>
    </div>
</div>
<div id="tabs">
    <ul>
        <li><a href="#prix">Fourchettes de prix</a></li>
        <li><a href="#surfaces">Fourchettes de surfaces</a></li>

    </ul>
    <div id="prix">
        <p>
        <a href="<?php echo Tools::create_url($_smarty_tpl->getVariable('user')->value,'export_site','addFp');?>
" class="btn btn-default"><i class="fa fa-plus-circle"></i> Ajouter une tranche</a>
        </p>
        <?php $_smarty_tpl->tpl_vars["tt"] = new Smarty_variable('', null, null);?>
        <?php $_smarty_tpl->tpl_vars["tb"] = new Smarty_variable('', null, null);?>


        <?php $_smarty_tpl->tpl_vars['count'] = new Smarty_variable(0, null, null);?>
        <?php  $_smarty_tpl->tpl_vars["fo"] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('fourchettesPrix')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
 $_smarty_tpl->tpl_vars["fo"]->index=-1;
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars["fo"]->key => $_smarty_tpl->tpl_vars["fo"]->value){
 $_smarty_tpl->tpl_vars["fo"]->index++;
 $_smarty_tpl->tpl_vars["fo"]->first = $_smarty_tpl->tpl_vars["fo"]->index === 0;
 $_smarty_tpl->tpl_vars['smarty']->value['foreach']["boucle"]['first'] = $_smarty_tpl->tpl_vars["fo"]->first;
?>
        <?php if ($_smarty_tpl->getVariable('tt')->value!=$_smarty_tpl->getVariable('fo')->value->getTransactionType()->getId()||$_smarty_tpl->getVariable('fo')->value->getMandateType()->getId()!=$_smarty_tpl->getVariable('tb')->value){?>

            <?php if (!$_smarty_tpl->getVariable('smarty')->value['foreach']['boucle']['first']){?>
                </tbody>
                </table>
                </div>
                </div>
                </div>
                <?php if ($_smarty_tpl->getVariable('count')->value==1){?>
                     </div> <!-- fin row -->
                     <?php $_smarty_tpl->tpl_vars['count'] = new Smarty_variable(0, null, null);?>
                <?php }?>
            <?php }?>

                <?php if ($_smarty_tpl->getVariable('count')->value==0){?>
                <div class="row">
                <?php }?>
                    <!-- <?php echo $_smarty_tpl->getVariable('count')->value++;?>
-->
                <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title"><?php echo $_smarty_tpl->getVariable('fo')->value->getTransactionType()->getName();?>
 <?php echo $_smarty_tpl->getVariable('fo')->value->getMandateType()->getName();?>
</h3>
                    </div>
                    <div class="panel-body">


                <table class="dataTablewithoutTri table table-striped table-condensed table-bordered">
                    <thead>
                    <tr>
                        <th>Nom</th>
                        <th>min</th>
                        <th>Max</th>
                        <th>Actions</th>
                    </tr>
                    </thead>
                    <tbody>
            <?php }?>
            <tr>
                <td><?php echo $_smarty_tpl->getVariable('fo')->value->getName();?>
</td>
                <td><?php echo $_smarty_tpl->getVariable('fo')->value->getValMin();?>
</td>
                <td><?php echo $_smarty_tpl->getVariable('fo')->value->getValMax();?>
</td>
                <td>

                    <!-- Split button -->
                    <div class="btn-group">
                        <a href="<?php echo Tools::create_url($_smarty_tpl->getVariable('user')->value,'export_site','updFp',$_smarty_tpl->getVariable('fo')->value->getId());?>
"  class="btn btn-default btn-xs"><i class="fa fa-pencil-square-o"></i> <?php echo Lang::LABEL_UPDATE;?>
</a>
                        <button type="button" class="btn btn-default btn-xs dropdown-toggle" data-toggle="dropdown">
                            <span class="caret"></span>
                            <span class="sr-only">Toggle Dropdown</span>
                        </button>
                        <ul class="dropdown-menu" role="menu">
                            <li><a href="<?php echo Tools::create_url($_smarty_tpl->getVariable('user')->value,'export_site','delFp',$_smarty_tpl->getVariable('fo')->value->getId());?>
"><i class="fa fa-trash"></i> Supprimer</a></li>

                        </ul>
                    </div>
                </td>
            </tr>



            <?php $_smarty_tpl->tpl_vars["tt"] = new Smarty_variable($_smarty_tpl->getVariable('fo')->value->getTransactionType()->getId(), null, null);?>
            <?php $_smarty_tpl->tpl_vars["tb"] = new Smarty_variable($_smarty_tpl->getVariable('fo')->value->getMandateType()->getId(), null, null);?>


            <?php }} ?>


            </tbody>
        </table>
            </div>
        </div>

        </div>
        </div><!-- Fin row -->

        <!-- Fin onglet prix -->
    </div>
    <div id="surfaces">
<p>
        <a href="<?php echo Tools::create_url($_smarty_tpl->getVariable('user')->value,'export_site','addFt');?>
" class="btn btn-default"><i class="fa fa-plus-circle"></i> Ajouter une tranche</a>
</p>
        <?php $_smarty_tpl->tpl_vars["tt"] = new Smarty_variable('', null, null);?>
        <?php $_smarty_tpl->tpl_vars["tb"] = new Smarty_variable('', null, null);?>



        <?php $_smarty_tpl->tpl_vars['count'] = new Smarty_variable(0, null, null);?>
        <?php  $_smarty_tpl->tpl_vars["fo"] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('fourchettesSurface')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
 $_smarty_tpl->tpl_vars["fo"]->index=-1;
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars["fo"]->key => $_smarty_tpl->tpl_vars["fo"]->value){
 $_smarty_tpl->tpl_vars["fo"]->index++;
 $_smarty_tpl->tpl_vars["fo"]->first = $_smarty_tpl->tpl_vars["fo"]->index === 0;
 $_smarty_tpl->tpl_vars['smarty']->value['foreach']["boucle"]['first'] = $_smarty_tpl->tpl_vars["fo"]->first;
?>


        <?php if ($_smarty_tpl->getVariable('tt')->value!=$_smarty_tpl->getVariable('fo')->value->getTransactionType()->getId()||$_smarty_tpl->getVariable('fo')->value->getMandateType()->getId()!=$_smarty_tpl->getVariable('tb')->value){?>

        <?php if (!$_smarty_tpl->getVariable('smarty')->value['foreach']['boucle']['first']){?>
            </tbody>
            </table>
    </div>
    </div>
    </div>
    <?php if ($_smarty_tpl->getVariable('count')->value==1){?>
        </div> <!-- fin row -->
        <?php $_smarty_tpl->tpl_vars['count'] = new Smarty_variable(0, null, null);?>
    <?php }?>
        <?php }?>
<?php if ($_smarty_tpl->getVariable('count')->value==0){?>
<div class="row">
    <?php }?>
    <!-- <?php echo $_smarty_tpl->getVariable('count')->value++;?>
-->
    <div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title"><?php echo $_smarty_tpl->getVariable('fo')->value->getTransactionType()->getName();?>
 <?php echo $_smarty_tpl->getVariable('fo')->value->getMandateType()->getName();?>
</h3>
            </div>
            <div class="panel-body">
                <table class="dataTablewithoutTri table table-striped table-condensed table-bordered">
            <thead>
            <tr>
                <th>Nom</th>
                <th>min</th>
                <th>Max</th>
                <th>actions</th>

            </tr>
            </thead>
            <tbody>
            <?php }?>
            <tr>
                <td><?php echo $_smarty_tpl->getVariable('fo')->value->getName();?>
</td>
                <td><?php echo $_smarty_tpl->getVariable('fo')->value->getValMin();?>
</td>
                <td><?php echo $_smarty_tpl->getVariable('fo')->value->getValMax();?>
</td>
                <td>
                    <!-- Split button -->
                    <div class="btn-group">
                        <a href="<?php echo Tools::create_url($_smarty_tpl->getVariable('user')->value,'export_site','updFt',$_smarty_tpl->getVariable('fo')->value->getId());?>
"  class="btn btn-default btn-xs"><i class="fa fa-pencil-square-o"></i> <?php echo Lang::LABEL_UPDATE;?>
</a>
                        <button type="button" class="btn btn-default btn-xs dropdown-toggle" data-toggle="dropdown">
                            <span class="caret"></span>
                            <span class="sr-only">Toggle Dropdown</span>
                        </button>
                        <ul class="dropdown-menu" role="menu">
                            <li><a href="<?php echo Tools::create_url($_smarty_tpl->getVariable('user')->value,'export_site','delFt',$_smarty_tpl->getVariable('fo')->value->getId());?>
"><i class="fa fa-trash"></i> Supprimer</a></li>

                        </ul>
                    </div>
                </td>

            </tr>



            <?php $_smarty_tpl->tpl_vars["tt"] = new Smarty_variable($_smarty_tpl->getVariable('fo')->value->getTransactionType()->getId(), null, null);?>
            <?php $_smarty_tpl->tpl_vars["tb"] = new Smarty_variable($_smarty_tpl->getVariable('fo')->value->getMandateType()->getId(), null, null);?>


            <?php }} ?>

            </tbody>
        </table>
</div>
</div>

</div>
</div><!-- Fin row -->

    </div> <!-- Fin onglet prix -->

</div>

</div>
