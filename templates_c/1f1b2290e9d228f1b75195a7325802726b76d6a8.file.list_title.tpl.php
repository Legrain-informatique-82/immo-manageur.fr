<?php /* Smarty version Smarty-3.0.6, created on 2014-09-11 12:09:46
         compiled from "/var/www/aptana/immo-manageur.fr/modules/seller/views/list_title.tpl" */ ?>
<?php /*%%SmartyHeaderCode:519421057541174ea401568-87395029%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '1f1b2290e9d228f1b75195a7325802726b76d6a8' => 
    array (
      0 => '/var/www/aptana/immo-manageur.fr/modules/seller/views/list_title.tpl',
      1 => 1410430186,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '519421057541174ea401568-87395029',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<?php $_template = new Smarty_Internal_Template("tpl_default/entete.tpl", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate();?><?php $_template->updateParentVariables(0);?><?php unset($_template);?>
<div class="row bg-success bannerTitle">
    <div class="col-md-6">
        <h1 class="h2"><?php echo Lang::LABEL_SELLER_LIST_TITLE_H1;?>
</h1>
    </div>

    <div class="col-md-6">
        <p class="h4 text-right ">
            <a title="Ajouter un titre de vendeur" class="btn btn-success" href="<?php echo Tools::create_url($_smarty_tpl->getVariable('user')->value,"seller","add");?>
">
                <i class="fa fa-plus-circle fa-2x"></i>
            </a>
        </p>
    </div>
</div>
<table class="dataTableDefault table table-bordered table-striped">
	<thead>
		<tr>
			<th>Titre</th>
			<th>Actions</th>

		</tr>
	</thead>
	<tbody>
		<?php  $_smarty_tpl->tpl_vars['item'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('list')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['item']->key => $_smarty_tpl->tpl_vars['item']->value){
?>
		<tr>
			<td><?php echo $_smarty_tpl->tpl_vars['item']->value['libel'];?>
</td>
			<td>




                <div class="btn-group">
                    <a class="btn btn-default" href="<?php echo $_smarty_tpl->tpl_vars['item']->value['urlUpdate'];?>
" <?php if ($_smarty_tpl->getVariable('user')->value->getOpenInNewTab()){?> target="_blank"<?php }?>><i class="fa fa-pencil-square-o"></i> Modifier </a>
                    <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
                        <span class="caret"></span>
                        <span class="sr-only">Toggle Dropdown</span>
                    </button>
                    <ul class="dropdown-menu" role="menu">
                        <li>
                            <a class="jsdelTitleSeller" rel="<?php echo $_smarty_tpl->tpl_vars['item']->value['idSellerTitle'];?>
" href="<?php echo $_smarty_tpl->tpl_vars['item']->value['urlDelete'];?>
" title="<?php echo Lang::LABEL_DELETE;?>
">
                                <i class="fa fa-trash"></i> <?php echo Lang::LABEL_DELETE;?>

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
