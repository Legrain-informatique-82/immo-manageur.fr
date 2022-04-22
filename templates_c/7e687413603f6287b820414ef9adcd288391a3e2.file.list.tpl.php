<?php /* Smarty version Smarty-3.0.6, created on 2013-10-30 11:45:17
         compiled from "/var/www/aptana/extra-immo/modules/user/views/list.tpl" */ ?>
<?php /*%%SmartyHeaderCode:100594735270e33d99c594-14598388%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '7e687413603f6287b820414ef9adcd288391a3e2' => 
    array (
      0 => '/var/www/aptana/extra-immo/modules/user/views/list.tpl',
      1 => 1369380412,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '100594735270e33d99c594-14598388',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<?php $_template = new Smarty_Internal_Template("tpl_default/entete.tpl", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate();?><?php $_template->updateParentVariables(0);?><?php unset($_template);?>
<h1>Liste des utilisateurs</h1>
<div class="containtTbl">
	<table class="standard">
		<thead>
			<tr>
				<th>Identifiant</th>
				<th>Nom &amp; prénom</th>
				<th>Agence</th>
				<th>Niveau de membre</th>
				<th>Modifier</th>
				<th>Supprimer</th>
				<th>Voir</th>
			</tr>
		</thead>
		<tbody>
			<?php  $_smarty_tpl->tpl_vars['u'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('listUsers')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['u']->key => $_smarty_tpl->tpl_vars['u']->value){
?>
			<tr>
				<td><?php echo $_smarty_tpl->tpl_vars['u']->value['identifiant'];?>
</td>
				<td><?php echo $_smarty_tpl->tpl_vars['u']->value['name'];?>
</td>
				<td><?php echo $_smarty_tpl->tpl_vars['u']->value['agency'];?>
</td>
				<td><?php echo $_smarty_tpl->tpl_vars['u']->value['levelMember'];?>
</td>
				<td><?php if ($_smarty_tpl->getVariable('user')->value->getLevelMember()->getIdLevelMember()==1||$_smarty_tpl->getVariable('user')->value->getIdUser()==$_smarty_tpl->tpl_vars['u']->value['idUser']){?><a href="<?php echo $_smarty_tpl->tpl_vars['u']->value['urlUpdate'];?>
" title="Modifier"><img src="<?php echo Constant::DEFAULT_URL_PICTURE_DIRECTORY;?>
update.png" alt="Modifier" /></a><?php }else{ ?>_<?php }?></td>
				<td><?php if ($_smarty_tpl->getVariable('user')->value->getLevelMember()->getIdLevelMember()==1&&$_smarty_tpl->getVariable('user')->value->getIdUser()!=$_smarty_tpl->tpl_vars['u']->value['idUser']){?><a class="jsdelUser"
					rel="<?php echo $_smarty_tpl->tpl_vars['u']->value['idUser'];?>
" href="<?php echo $_smarty_tpl->tpl_vars['u']->value['urlDelete'];?>
" Title="Supprimer"><img src="<?php echo Constant::DEFAULT_URL_PICTURE_DIRECTORY;?>
delete.png" alt="Supprimer" /></a><?php }else{ ?>_<?php }?></td>
				<td><a href="<?php echo $_smarty_tpl->tpl_vars['u']->value['urlSee'];?>
" title="Voir" <?php if ($_smarty_tpl->getVariable('user')->value->getOpenInNewTab()){?> target="_blank"<?php }?>> <img src="<?php echo Constant::DEFAULT_URL_PICTURE_DIRECTORY;?>
see.png" alt="Voir" /></a></td>
			</tr>
			<?php }} ?>
		</tbody>
	</table>
</div>
</div>
