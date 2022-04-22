<?php /* Smarty version Smarty-3.0.6, created on 2013-04-11 16:12:23
         compiled from "/var/www/aptana/extra-immo/modules/sector/views/list_sector.tpl" */ ?>
<?php /*%%SmartyHeaderCode:14899536195166c4c7bd10b0-30272095%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'ad87fd0e0373123d8e42b5e7484d6a79ca7261ef' => 
    array (
      0 => '/var/www/aptana/extra-immo/modules/sector/views/list_sector.tpl',
      1 => 1320319263,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '14899536195166c4c7bd10b0-30272095',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<?php $_template = new Smarty_Internal_Template("tpl_default/entete.tpl", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate();?><?php $_template->updateParentVariables(0);?><?php unset($_template);?>
<h1><?php echo LANG::LABEL_SECTOR_LIST;?>
</h1>
<?php  $_smarty_tpl->tpl_vars['item'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('list')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
 $_smarty_tpl->tpl_vars['item']->total= $_smarty_tpl->_count($_from);
 $_smarty_tpl->tpl_vars['item']->iteration=0;
 $_smarty_tpl->tpl_vars['item']->index=-1;
if ($_smarty_tpl->tpl_vars['item']->total > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['item']->key => $_smarty_tpl->tpl_vars['item']->value){
 $_smarty_tpl->tpl_vars['item']->iteration++;
 $_smarty_tpl->tpl_vars['item']->index++;
 $_smarty_tpl->tpl_vars['item']->first = $_smarty_tpl->tpl_vars['item']->index === 0;
 $_smarty_tpl->tpl_vars['item']->last = $_smarty_tpl->tpl_vars['item']->iteration === $_smarty_tpl->tpl_vars['item']->total;
 $_smarty_tpl->tpl_vars['smarty']->value['foreach']["list"]['first'] = $_smarty_tpl->tpl_vars['item']->first;
 $_smarty_tpl->tpl_vars['smarty']->value['foreach']["list"]['last'] = $_smarty_tpl->tpl_vars['item']->last;
?> <?php if ($_smarty_tpl->getVariable('smarty')->value['foreach']['list']['first']){?>
<table class="standard">
	<thead>
		<tr>
			<th><?php echo Lang::LABEL_SECTOR_NAME;?>
</th>
			<th><?php echo Lang::LABEL_UPDATE;?>
</th>
			<th><?php echo Lang::LABEL_DELETE;?>
</th>
		</tr>
	</thead>
	<tbody>
		<?php }?>
		<tr>
			<td><?php echo $_smarty_tpl->tpl_vars['item']->value['name'];?>
</td>
			<td><a href="<?php echo $_smarty_tpl->tpl_vars['item']->value['urlUpdate'];?>
" title="<?php echo Lang::LABEL_UPDATE;?>
"><img src="<?php echo Constant::DEFAULT_URL_PICTURE_DIRECTORY;?>
update.png" alt="<?php echo Lang::LABEL_UPDATE;?>
" /></a></td>
			<td><a class="jsDelSector" rel="<?php echo $_smarty_tpl->tpl_vars['item']->value['id'];?>
" href="<?php echo $_smarty_tpl->tpl_vars['item']->value['urlDelete'];?>
" title="<?php echo Lang::LABEL_DELETE;?>
"><img src="<?php echo Constant::DEFAULT_URL_PICTURE_DIRECTORY;?>
delete.png" alt="<?php echo Lang::LABEL_DELETE;?>
" /></a>
			</td>
		</tr>
		<?php if ($_smarty_tpl->getVariable('smarty')->value['foreach']['list']['last']){?>
	</tbody>
</table>
<?php }?> <?php }} ?>

</div>
