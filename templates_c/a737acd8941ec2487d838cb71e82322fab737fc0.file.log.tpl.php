<?php /* Smarty version Smarty-3.0.6, created on 2013-04-16 10:16:01
         compiled from "/var/www/aptana/extra-immo/modules/seller/views/log.tpl" */ ?>
<?php /*%%SmartyHeaderCode:1162228336516d08c1057c06-85160312%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'a737acd8941ec2487d838cb71e82322fab737fc0' => 
    array (
      0 => '/var/www/aptana/extra-immo/modules/seller/views/log.tpl',
      1 => 1308581463,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1162228336516d08c1057c06-85160312',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<?php $_template = new Smarty_Internal_Template("tpl_default/entete.tpl", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate();?><?php $_template->updateParentVariables(0);?><?php unset($_template);?>
<h1>Logs de ce module :</h1>
<div class="containtTbl">
	<?php  $_smarty_tpl->tpl_vars['line'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('arrayLog')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
 $_smarty_tpl->tpl_vars['line']->total= $_smarty_tpl->_count($_from);
 $_smarty_tpl->tpl_vars['line']->iteration=0;
 $_smarty_tpl->tpl_vars['line']->index=-1;
if ($_smarty_tpl->tpl_vars['line']->total > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['line']->key => $_smarty_tpl->tpl_vars['line']->value){
 $_smarty_tpl->tpl_vars['line']->iteration++;
 $_smarty_tpl->tpl_vars['line']->index++;
 $_smarty_tpl->tpl_vars['line']->first = $_smarty_tpl->tpl_vars['line']->index === 0;
 $_smarty_tpl->tpl_vars['line']->last = $_smarty_tpl->tpl_vars['line']->iteration === $_smarty_tpl->tpl_vars['line']->total;
 $_smarty_tpl->tpl_vars['smarty']->value['foreach']["arrayLog"]['first'] = $_smarty_tpl->tpl_vars['line']->first;
 $_smarty_tpl->tpl_vars['smarty']->value['foreach']["arrayLog"]['last'] = $_smarty_tpl->tpl_vars['line']->last;
?> <?php if ($_smarty_tpl->getVariable('smarty')->value['foreach']['arrayLog']['first']){?>
	<table class="threeColumnWithFirstDate">
		<thead>
			<tr>
				<th>Date</th>
				<th>Utilisateur</th>
				<th>Log</th>
			</tr>
		</thead>
		<tbody>
			<?php }?>
			<tr>
				<td><?php echo date(Constant::DATE_FORMAT,$_smarty_tpl->getVariable('line')->value->getDateLog());?>
</td>
				<td><?php echo $_smarty_tpl->getVariable('line')->value->getUser()->getName();?>
 <?php echo $_smarty_tpl->getVariable('line')->value->getUser()->getFirstname();?>
</td>
				<td><?php echo $_smarty_tpl->getVariable('line')->value->getLog();?>
</td>
			</tr>
			<?php if ($_smarty_tpl->getVariable('smarty')->value['foreach']['arrayLog']['last']){?>
		</tbody>
	</table>
	<?php }?> <?php }} ?>
</div>
</div>
