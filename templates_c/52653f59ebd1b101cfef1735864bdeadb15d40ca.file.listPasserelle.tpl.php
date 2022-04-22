<?php /* Smarty version Smarty-3.0.6, created on 2013-02-04 15:54:52
         compiled from "/var/www/aptana/extra-immo/modules/export/views/listPasserelle.tpl" */ ?>
<?php /*%%SmartyHeaderCode:1854744904510fcbbca21bb6-51542305%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '52653f59ebd1b101cfef1735864bdeadb15d40ca' => 
    array (
      0 => '/var/www/aptana/extra-immo/modules/export/views/listPasserelle.tpl',
      1 => 1320317507,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1854744904510fcbbca21bb6-51542305',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<?php $_template = new Smarty_Internal_Template('tpl_default/entete.tpl', $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate();?><?php $_template->updateParentVariables(0);?><?php unset($_template);?>
<table class="standard">
	<thead>
		<tr>
			<th>Nom de la passerelle</th>
			<th>Modifier</th>
			<th>Supprimer</th>
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
			<td><a
				href="<?php echo Tools::create_url($_smarty_tpl->getVariable('user')->value,$_GET['module'],'updatePasserelle',$_smarty_tpl->getVariable('p')->value->getIdPasserelle());?>
" title="Modifier"><img src="<?php echo Constant::DEFAULT_URL_PICTURE_DIRECTORY;?>
update.png" alt="Modifier" /></a>
			</td>
			<td><a
				href="<?php echo Tools::create_url($_smarty_tpl->getVariable('user')->value,$_GET['module'],'deletePasserelle',$_smarty_tpl->getVariable('p')->value->getIdPasserelle());?>
" title="Supprimer"><img src="<?php echo Constant::DEFAULT_URL_PICTURE_DIRECTORY;?>
delete.png" alt="Supprimer" /></a>
			</td>
		</tr>

		<?php }} ?>
	</tbody>
</table>
</div>
