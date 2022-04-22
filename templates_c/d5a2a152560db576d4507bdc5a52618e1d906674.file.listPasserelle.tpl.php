<?php /* Smarty version Smarty-3.0.6, created on 2014-09-18 10:28:54
         compiled from "/var/www/aptana/immo-manageur.fr/modules/export/views/listPasserelle.tpl" */ ?>
<?php /*%%SmartyHeaderCode:1306680208541a97c6d1f1b0-49701465%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'd5a2a152560db576d4507bdc5a52618e1d906674' => 
    array (
      0 => '/var/www/aptana/immo-manageur.fr/modules/export/views/listPasserelle.tpl',
      1 => 1411028933,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1306680208541a97c6d1f1b0-49701465',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<?php $_template = new Smarty_Internal_Template('tpl_default/entete.tpl', $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate();?><?php $_template->updateParentVariables(0);?><?php unset($_template);?>

<div class="row bg-success bannerTitle">
    <div class="col-md-12">
        <h1 class="h2">Liste des passerelles</h1>
    </div>

</div>
<table class="dataTableDefault table table-striped table-bordered">
	<thead>
    <tr class="tri">
        <th class="jshide"></th>
        <th></th>
        <th class="jshide"></th>
    </tr>
		<tr>
			<th>Nom de la passerelle</th>
            <th>Etat</th>
			<th>Actions</th>

		</tr>
	</thead>
	<tbody>

		<?php  $_smarty_tpl->tpl_vars['p'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('listPasserelle')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['p']->key => $_smarty_tpl->tpl_vars['p']->value){
?>
		<tr>
			<td><?php echo $_smarty_tpl->getVariable('p')->value->getName();?>
</td>
            <td>
                <?php if ($_smarty_tpl->getVariable('p')->value->getAsset()){?>Active<?php }else{ ?>Inactive<?php }?>
            </td>
            <td>
                <div class="btn-group">
                    <a class="btn btn-default" href="<?php echo Tools::create_url($_smarty_tpl->getVariable('user')->value,$_GET['module'],'updatePasserelle',$_smarty_tpl->getVariable('p')->value->getIdPasserelle());?>
" <?php if ($_smarty_tpl->getVariable('user')->value->getOpenInNewTab()){?> target="_blank"<?php }?>><i class="fa fa-pencil-square-o"></i> Modifier </a>
                    <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
                        <span class="caret"></span>
                        <span class="sr-only">Toggle Dropdown</span>
                    </button>
                    <ul class="dropdown-menu" role="menu">

                        <li>

                            <a href="<?php echo Tools::create_url($_smarty_tpl->getVariable('user')->value,$_GET['module'],'deletePasserelle',$_smarty_tpl->getVariable('p')->value->getIdPasserelle());?>
" title="Supprimer">
                                <i class="fa fa-trash"></i> Supprimer
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
