<?php /* Smarty version Smarty-3.0.6, created on 2014-09-19 13:24:59
         compiled from "/var/www/aptana/immo-manageur.fr/modules/documents/views/listDocuments.tpl" */ ?>
<?php /*%%SmartyHeaderCode:1071910605541c128b9d4d89-67429962%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'b48b8235be0a4b9747d5ac715282f1e073d3c715' => 
    array (
      0 => '/var/www/aptana/immo-manageur.fr/modules/documents/views/listDocuments.tpl',
      1 => 1411125892,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1071910605541c128b9d4d89-67429962',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<?php $_template = new Smarty_Internal_Template("tpl_default/entete.tpl", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate();?><?php $_template->updateParentVariables(0);?><?php unset($_template);?>
<div class="row bg-success bannerTitle">
    <div class="col-md-6">
        <h1 class="h2">Liste des documents</h1>
    </div>
    <div class="col-md-6">
        <p class="h4 text-right ">
            <a class="btn btn-success" href="<?php echo Tools::create_url($_smarty_tpl->getVariable('user')->value,'documents','addDocument');?>
" title="Ajouter un document">
                <i class="fa fa-plus-circle fa-2x"></i>
            </a>
        </p>
    </div>
</div>
<table class="dataTableDefault table table-striped table-bordered">
<thead>
<tr class="tri">
    <th></th>
    <th></th>
    <th class="jshide"></th>
</tr>
<tr>

<th>Nom</th>
<th>Catégorie</th>
<th>Actions</th>

</tr>
</thead>
<tbody>
<?php  $_smarty_tpl->tpl_vars['document'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('documents')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['document']->key => $_smarty_tpl->tpl_vars['document']->value){
?>
<tr>
    <td><?php echo $_smarty_tpl->getVariable('document')->value->getName();?>
</td>
    <td><?php echo $_smarty_tpl->getVariable('document')->value->getCategoryDocument()->getName();?>
</td>


    <td>
        <!-- Split button -->
        <div class="btn-group">
            <a href="<?php echo Tools::create_url($_smarty_tpl->getVariable('user')->value,'documents','addDocument',$_smarty_tpl->getVariable('document')->value->getId());?>
" class="btn btn-default"><i class="fa fa-pencil-square-o"></i> <?php echo lang::LABEL_UPDATE;?>
</a>
            <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
                <span class="caret"></span>
                <span class="sr-only">Toggle Dropdown</span>
            </button>
            <ul class="dropdown-menu" role="menu">
                <li>
                    <a href="<?php echo tools::create_url($_smarty_tpl->getVariable('user')->value,'documents','delDocument',$_smarty_tpl->getVariable('document')->value->getId());?>
" title="<?php echo Lang::LABEL_DELETE;?>
"><i class="fa fa-trash"></i> <?php echo Lang::LABEL_DELETE;?>
</a>
                </li>
                <li>
                    <a href="<?php echo tools::create_url($_smarty_tpl->getVariable('user')->value,'documents','printDoc',$_smarty_tpl->getVariable('document')->value->getId());?>
" target="_blank">
                        <i class="fa fa-print"></i> Imprimer le document
                    </a>
                </li>
            </ul>
        </div>


    </td>


</tr>
<?php }} ?>
</tbody>
</table>
</div>
