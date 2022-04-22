<?php /* Smarty version Smarty-3.0.6, created on 2014-09-18 10:41:44
         compiled from "/var/www/aptana/immo-manageur.fr/modules/export/views/preList.tpl" */ ?>
<?php /*%%SmartyHeaderCode:1573306769541a9ac804a110-27841319%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '5e9fe209882d7fcf49c0dfb1cf022f13f470addb' => 
    array (
      0 => '/var/www/aptana/immo-manageur.fr/modules/export/views/preList.tpl',
      1 => 1411029702,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1573306769541a9ac804a110-27841319',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<?php $_template = new Smarty_Internal_Template('tpl_default/entete.tpl', $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate();?><?php $_template->updateParentVariables(0);?><?php unset($_template);?>
<div class="row bg-success bannerTitle">
    <div class="col-md-12">
        <h1 class="h2">Choix de la passerelle</h1>
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
			 <th>Etat de la passerelle</th> 
			<th>Afficher les annonces pour cette passerelle</th>
			
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
			 <td><?php if ($_smarty_tpl->getVariable('p')->value->getAsset()){?>Active<?php }else{ ?>Inactive<?php }?></td> 
			<td>
                <a href="<?php echo Tools::create_url($_smarty_tpl->getVariable('user')->value,$_GET['module'],'list',$_smarty_tpl->getVariable('p')->value->getIdPasserelle());?>
" title="Choisir" class="btn btn-default"><i class="fa fa-check-square-o"></i> Choisir</a>
			</td>
		</tr>

		<?php }} ?>
	</tbody>
</table>
</div>
