<?php /* Smarty version Smarty-3.0.6, created on 2013-05-24 09:52:46
         compiled from "/var/www/aptana/extra-immo/modules/mandat/modules/action/views/list.tpl" */ ?>
<?php /*%%SmartyHeaderCode:615207086519f1c4ed189f5-45928458%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'dfbb42f404389d1ebed74a582b5f74e49daff256' => 
    array (
      0 => '/var/www/aptana/extra-immo/modules/mandat/modules/action/views/list.tpl',
      1 => 1369380335,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '615207086519f1c4ed189f5-45928458',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_smarty_tpl->getVariable('listActions')->value){?>
<div id="contAct">
	<h1>Actions :</h1>
	<table class="triActionsBis">
		<thead>
			<tr>
				<th>Du</th> 
				<th>De</th>
				<th>Pour</th>
				<th>Libellé</th>
				<th>Numéro de mandat lié</th>
				<th>Voir</th>
			</tr>
		</thead>
		<tbody>
			<?php  $_smarty_tpl->tpl_vars['i'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('listActions')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['i']->key => $_smarty_tpl->tpl_vars['i']->value){
?>
			<tr>
				<td><?php echo date(Constant::DATE_FORMAT2,$_smarty_tpl->getVariable('i')->value->getInitDate());?>
</td> 
				<td><?php echo $_smarty_tpl->getVariable('i')->value->getFrom()->getFirstname();?>
 <?php echo $_smarty_tpl->getVariable('i')->value->getFrom()->getName();?>
</td>
				<td><?php echo $_smarty_tpl->getVariable('i')->value->getTo()->getFirstname();?>
 <?php echo $_smarty_tpl->getVariable('i')->value->getTo()->getName();?>
</td>
				<td><?php echo $_smarty_tpl->getVariable('i')->value->getLibel();?>
</td>
				<td><?php if ($_smarty_tpl->getVariable('i')->value->getMandate()){?><?php echo $_smarty_tpl->getVariable('i')->value->getMandate()->getNumberMandate();?>
<?php }else{ ?>Aucun<?php }?></td>
				<td><a
					href="<?php echo Tools::create_url($_smarty_tpl->getVariable('user')->value,'action','see',$_smarty_tpl->getVariable('i')->value->getIdAction());?>
" title="<?php echo Lang::LABEL_SEE;?>
" <?php if ($_smarty_tpl->getVariable('user')->value->getOpenInNewTab()){?> target="_blank"<?php }?>><img src="<?php echo Constant::DEFAULT_URL_PICTURE_DIRECTORY;?>
see.png" alt="<?php echo Lang::LABEL_SEE;?>
" /></a>
				</td>
			</tr>
			<?php }} ?>
		</tbody>
	</table>
</div>
<?php }?>
