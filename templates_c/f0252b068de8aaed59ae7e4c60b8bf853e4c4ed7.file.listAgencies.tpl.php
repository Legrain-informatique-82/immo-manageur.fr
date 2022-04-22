<?php /* Smarty version Smarty-3.0.6, created on 2013-10-30 11:45:23
         compiled from "/var/www/aptana/extra-immo/modules/user/views/listAgencies.tpl" */ ?>
<?php /*%%SmartyHeaderCode:2225996375270e343092dc4-96008968%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'f0252b068de8aaed59ae7e4c60b8bf853e4c4ed7' => 
    array (
      0 => '/var/www/aptana/extra-immo/modules/user/views/listAgencies.tpl',
      1 => 1369380412,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '2225996375270e343092dc4-96008968',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<?php $_template = new Smarty_Internal_Template("tpl_default/entete.tpl", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate();?><?php $_template->updateParentVariables(0);?><?php unset($_template);?>

<h1><?php echo $_smarty_tpl->getVariable('title')->value;?>
</h1>
<div class="containtTbl">
	<?php  $_smarty_tpl->tpl_vars['line'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('agencies')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
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
?>
	
	 <?php if ($_smarty_tpl->getVariable('smarty')->value['foreach']['arrayLog']['first']){?>
	<table class="standard">
		<thead>
			<tr>
				<th>Contact</th>
				<th>Nom de l'agence (interne)</th>
				<th>Téléphone(s)</th>
				<th>Email</th>
				<th>Adresse</th>
				<th>Modifier</th>
			</tr>
		</thead>
		<tbody>
			<?php }?>
			<tr>
				<td><?php echo (($tmp = @$_smarty_tpl->getVariable('line')->value->getContact())===null||$tmp==='' ? 'NC' : $tmp);?>
</td>
				<td><?php echo $_smarty_tpl->getVariable('line')->value->getName();?>
</td>
				<td>
				<?php if ($_smarty_tpl->getVariable('line')->value->getTel1()){?><p>Tél 1 : <?php echo $_smarty_tpl->getVariable('line')->value->getTel1();?>
</p><?php }?>
				<?php if ($_smarty_tpl->getVariable('line')->value->getTel2()){?><p>Tél 2 : <?php echo $_smarty_tpl->getVariable('line')->value->getTel2();?>
</p><?php }?>
				<?php if ($_smarty_tpl->getVariable('line')->value->getTel3()){?><p>Tél 3 : <?php echo $_smarty_tpl->getVariable('line')->value->getTel3();?>
</p><?php }?>
				</td>
				<td><?php echo (($tmp = @$_smarty_tpl->getVariable('line')->value->getEmail())===null||$tmp==='' ? 'NC' : $tmp);?>
</td>
				<td>
				<p><?php echo $_smarty_tpl->getVariable('line')->value->getAddress();?>
</p>
				<p><?php echo $_smarty_tpl->getVariable('line')->value->getZipCode();?>
 <?php echo $_smarty_tpl->getVariable('line')->value->getCity();?>
</p>
				</td>
				<td><a href="<?php echo Tools::create_url($_smarty_tpl->getVariable('user')->value,'user','updAgency',$_smarty_tpl->getVariable('line')->value->getIdAgency());?>
" title="Modifier"><img src="<?php echo Constant::DEFAULT_URL_PICTURE_DIRECTORY;?>
update.png" alt="Modifier" /></a></td>
			</tr>
			<?php if ($_smarty_tpl->getVariable('smarty')->value['foreach']['arrayLog']['last']){?>
		</tbody>
	</table>
	<?php }?> <?php }} ?>
</div>
</div>
