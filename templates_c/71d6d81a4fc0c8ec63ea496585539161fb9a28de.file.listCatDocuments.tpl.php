<?php /* Smarty version Smarty-3.0.6, created on 2014-09-19 11:27:09
         compiled from "/var/www/aptana/immo-manageur.fr/modules/documents/views/listCatDocuments.tpl" */ ?>
<?php /*%%SmartyHeaderCode:1406522965541bf6ede326f7-28895827%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '71d6d81a4fc0c8ec63ea496585539161fb9a28de' => 
    array (
      0 => '/var/www/aptana/immo-manageur.fr/modules/documents/views/listCatDocuments.tpl',
      1 => 1411118827,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1406522965541bf6ede326f7-28895827',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<?php $_template = new Smarty_Internal_Template("tpl_default/entete.tpl", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate();?><?php $_template->updateParentVariables(0);?><?php unset($_template);?>

<div class="row bg-success bannerTitle">
    <div class="col-md-6">
        <h1 class="h2"><?php echo $_smarty_tpl->getVariable('h1')->value;?>
</h1>
    </div>
    <div class="col-md-6">
        <p class="h4 text-right ">
            <a class="btn btn-success" href="<?php echo Tools::create_url($_smarty_tpl->getVariable('user')->value,'documents','addCatDocuments');?>
" title="Ajouter une categorie">
                <i class="fa fa-plus-circle fa-2x"></i>
            </a>
        </p>
    </div>
</div>

<table class="dataTableDefault table table-striped table-bordered">

    <thead>
    <tr>
        <th>Nom</th>
        <th>Actions</th>

    </tr>
    </thead>
    <tbody>
    <?php  $_smarty_tpl->tpl_vars['cat'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('categories')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['cat']->key => $_smarty_tpl->tpl_vars['cat']->value){
?>
        <tr>
            <td><?php echo $_smarty_tpl->getVariable('cat')->value->getName();?>
</td>
            <td>
                <!-- Split button -->
                <div class="btn-group">
                    <a href="<?php echo Tools::create_url($_smarty_tpl->getVariable('user')->value,'documents','updCatDocument',$_smarty_tpl->getVariable('cat')->value->getIdCategoryDocument());?>
" class="btn btn-default"><i class="fa fa-pencil-square-o"></i> <?php echo lang::LABEL_UPDATE;?>
</a>
                    <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
                        <span class="caret"></span>
                        <span class="sr-only">Toggle Dropdown</span>
                    </button>
                    <ul class="dropdown-menu" role="menu">

                        <li>
                            <a href="<?php echo tools::create_url($_smarty_tpl->getVariable('user')->value,'documents','delCatDocument',$_smarty_tpl->getVariable('cat')->value->getIdCategoryDocument());?>
" title="<?php echo Lang::LABEL_DELETE;?>
"><i class="fa fa-trash"></i> <?php echo Lang::LABEL_DELETE;?>
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
