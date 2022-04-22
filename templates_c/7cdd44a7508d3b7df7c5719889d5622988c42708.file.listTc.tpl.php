<?php /* Smarty version Smarty-3.0.6, created on 2012-10-15 12:44:19
         compiled from "/var/www/aptana/extra-immo/modules/contacts/views/listTc.tpl" */ ?>
<?php /*%%SmartyHeaderCode:1394275722507be903992fe7-99082274%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '7cdd44a7508d3b7df7c5719889d5622988c42708' => 
    array (
      0 => '/var/www/aptana/extra-immo/modules/contacts/views/listTc.tpl',
      1 => 1320742146,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1394275722507be903992fe7-99082274',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<?php $_template = new Smarty_Internal_Template("tpl_default/entete.tpl", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate();?><?php $_template->updateParentVariables(0);?><?php unset($_template);?>
<h1><?php echo $_smarty_tpl->getVariable('title')->value;?>
</h1>
<div class="bulle">
<table class="tableSJs">
	<thead>
		<tr>
			<th>Libellé</th>
			<th>Position</th>
			<th>Modifier</th>
			<th>Supprimer</th>
		</tr>
	</thead>
	<tbody>
		<?php  $_smarty_tpl->tpl_vars['typeChampContact'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('listTypeChampsContact')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
 $_smarty_tpl->tpl_vars['typeChampContact']->total= $_smarty_tpl->_count($_from);
 $_smarty_tpl->tpl_vars['typeChampContact']->iteration=0;
 $_smarty_tpl->tpl_vars['typeChampContact']->index=-1;
if ($_smarty_tpl->tpl_vars['typeChampContact']->total > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['typeChampContact']->key => $_smarty_tpl->tpl_vars['typeChampContact']->value){
 $_smarty_tpl->tpl_vars['typeChampContact']->iteration++;
 $_smarty_tpl->tpl_vars['typeChampContact']->index++;
 $_smarty_tpl->tpl_vars['typeChampContact']->first = $_smarty_tpl->tpl_vars['typeChampContact']->index === 0;
 $_smarty_tpl->tpl_vars['typeChampContact']->last = $_smarty_tpl->tpl_vars['typeChampContact']->iteration === $_smarty_tpl->tpl_vars['typeChampContact']->total;
 $_smarty_tpl->tpl_vars['smarty']->value['foreach']['foreach']['first'] = $_smarty_tpl->tpl_vars['typeChampContact']->first;
 $_smarty_tpl->tpl_vars['smarty']->value['foreach']['foreach']['last'] = $_smarty_tpl->tpl_vars['typeChampContact']->last;
?>
		<tr>
			<td><?php echo $_smarty_tpl->getVariable('typeChampContact')->value->getLibel();?>
</td>
			<td> <?php if (!$_smarty_tpl->getVariable('smarty')->value['foreach']['foreach']['first']){?> <a
				href="<?php echo Tools::create_url($_smarty_tpl->getVariable('user')->value,'contacts','updPosTC',$_smarty_tpl->getVariable('typeChampContact')->value->getIdTypeChampsContact(),array('up'));?>
"><img
					src="<?php echo Constant::DEFAULT_URL_PICTURE_DIRECTORY;?>
sort_asc.png"
					alt="monter" /> </a> <?php }?> <?php if (!$_smarty_tpl->getVariable('smarty')->value['foreach']['foreach']['last']){?> <a
				href="<?php echo Tools::create_url($_smarty_tpl->getVariable('user')->value,'contacts','updPosTC',$_smarty_tpl->getVariable('typeChampContact')->value->getIdTypeChampsContact(),array('down'));?>
"><img
					src="<?php echo Constant::DEFAULT_URL_PICTURE_DIRECTORY;?>
sort_desc.png"
					alt="descendre" /> </a> <?php }?></td>
			<td><a
				href="<?php echo Tools::create_url($_smarty_tpl->getVariable('user')->value,'contacts','updTC',$_smarty_tpl->getVariable('typeChampContact')->value->getIdTypeChampsContact());?>
" title="<?php echo Lang::LABEL_UPDATE;?>
"><img src="<?php echo Constant::DEFAULT_URL_PICTURE_DIRECTORY;?>
update.png" alt="<?php echo Lang::LABEL_UPDATE;?>
" /></a>
			</td>
			<td><?php if ($_smarty_tpl->getVariable('typeChampContact')->value->getNumberUsed()==0&&$_smarty_tpl->getVariable('typeChampContact')->value->getIdTypeChampsContact()!=1){?> <a
				href="<?php echo Tools::create_url($_smarty_tpl->getVariable('user')->value,'contacts','delTC',$_smarty_tpl->getVariable('typeChampContact')->value->getIdTypeChampsContact());?>
" title="<?php echo Lang::LABEL_DELETE;?>
"><img src="<?php echo Constant::DEFAULT_URL_PICTURE_DIRECTORY;?>
delete.png" alt="<?php echo Lang::LABEL_DELETE;?>
" /></a>
				<?php }else{ ?> - <?php }?></td>
		</tr>
		<?php }} else { ?>
		<tr>
			<td colspan=4>Aucun type de champ</td>
		</tr>
		<?php } ?>
	</tbody>
</table>
</div>
</div>