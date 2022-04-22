<?php /* Smarty version Smarty-3.0.6, created on 2013-07-23 11:39:12
         compiled from "/var/www/aptana/extra-immo/modules/export/views/preList.tpl" */ ?>
<?php /*%%SmartyHeaderCode:31469672151ee4f409e9d58-87969177%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'a4f7d5a0553e3339e1d532f8bd5d6f82813fbb9a' => 
    array (
      0 => '/var/www/aptana/extra-immo/modules/export/views/preList.tpl',
      1 => 1369380621,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '31469672151ee4f409e9d58-87969177',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<?php $_template = new Smarty_Internal_Template('tpl_default/entete.tpl', $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate();?><?php $_template->updateParentVariables(0);?><?php unset($_template);?>
<h1>Choix de la passerelle</h1>
<table class="standard">
	<thead>
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
			<td><a
				href="<?php echo Tools::create_url($_smarty_tpl->getVariable('user')->value,$_GET['module'],'list',$_smarty_tpl->getVariable('p')->value->getIdPasserelle());?>
" title="Afficher"><img src="<?php echo Constant::DEFAULT_URL_PICTURE_DIRECTORY;?>
use.png" alt="Afficher" /></a>
			</td>
		</tr>

		<?php }} ?>
	</tbody>
</table>
</div>
