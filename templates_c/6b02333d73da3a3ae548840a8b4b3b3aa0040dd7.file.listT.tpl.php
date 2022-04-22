<?php /* Smarty version Smarty-3.0.6, created on 2012-10-15 09:00:54
         compiled from "/var/www/aptana/extra-immo/modules/acquereur/views/listT.tpl" */ ?>
<?php /*%%SmartyHeaderCode:560569784507bb4a6c19d66-39716548%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '6b02333d73da3a3ae548840a8b4b3b3aa0040dd7' => 
    array (
      0 => '/var/www/aptana/extra-immo/modules/acquereur/views/listT.tpl',
      1 => 1320316081,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '560569784507bb4a6c19d66-39716548',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<?php $_template = new Smarty_Internal_Template("tpl_default/entete.tpl", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate();?><?php $_template->updateParentVariables(0);?><?php unset($_template);?>
<h1>Liste des titres</h1>
<table class="standard">
	<thead>
		<tr>
			<th>Nom</th>
			<th>Modifier</th>
			<th>Supprimer</th>
		</tr>
	</thead>
	<tbody>
		<?php  $_smarty_tpl->tpl_vars['titre'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('listTitre')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['titre']->key => $_smarty_tpl->tpl_vars['titre']->value){
?>
		<tr>
			<td><?php echo $_smarty_tpl->getVariable('titre')->value->getName();?>
</td>
			<td><a
				href="<?php echo Tools::create_url($_smarty_tpl->getVariable('user')->value,$_GET['module'],'updateT',$_smarty_tpl->getVariable('titre')->value->getIdTitreAcquereur());?>
"title="<?php echo Lang::LABEL_UPDATE;?>
"><img src="<?php echo Constant::DEFAULT_URL_PICTURE_DIRECTORY;?>
update.png" alt="<?php echo Lang::LABEL_UPDATE;?>
" /></a>
			</td>
			<td><a
				href="<?php echo Tools::create_url($_smarty_tpl->getVariable('user')->value,$_GET['module'],'delT',$_smarty_tpl->getVariable('titre')->value->getIdTitreAcquereur());?>
" title="<?php echo Lang::LABEL_DELETE;?>
"><img src="<?php echo Constant::DEFAULT_URL_PICTURE_DIRECTORY;?>
delete.png" alt="<?php echo Lang::LABEL_DELETE;?>
" /></a>
			</td>
		</tr>

		<?php }} ?>
	</tbody>
</table>
</div>
