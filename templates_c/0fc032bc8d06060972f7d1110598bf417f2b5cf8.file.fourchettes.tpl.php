<?php /* Smarty version Smarty-3.0.6, created on 2013-04-11 10:03:16
         compiled from "/var/www/aptana/extra-immo/modules/export_site/views/fourchettes.tpl" */ ?>
<?php /*%%SmartyHeaderCode:85605180051666e44664105-82192027%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '0fc032bc8d06060972f7d1110598bf417f2b5cf8' => 
    array (
      0 => '/var/www/aptana/extra-immo/modules/export_site/views/fourchettes.tpl',
      1 => 1323771740,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '85605180051666e44664105-82192027',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<?php $_template = new Smarty_Internal_Template("tpl_default/entete.tpl", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate();?><?php $_template->updateParentVariables(0);?><?php unset($_template);?>

<div class="mSep">
<h1>Fourchettes de prix :</h1>
<a href="<?php echo Tools::create_url($_smarty_tpl->getVariable('user')->value,'export_site','addFp');?>
">Ajouter une tranche</a>
<?php $_smarty_tpl->tpl_vars["tt"] = new Smarty_variable('', null, null);?>
<?php $_smarty_tpl->tpl_vars["tb"] = new Smarty_variable('', null, null);?>




<?php  $_smarty_tpl->tpl_vars["fo"] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('fourchettesPrix')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
 $_smarty_tpl->tpl_vars["fo"]->index=-1;
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars["fo"]->key => $_smarty_tpl->tpl_vars["fo"]->value){
 $_smarty_tpl->tpl_vars["fo"]->index++;
 $_smarty_tpl->tpl_vars["fo"]->first = $_smarty_tpl->tpl_vars["fo"]->index === 0;
 $_smarty_tpl->tpl_vars['smarty']->value['foreach']["boucle"]['first'] = $_smarty_tpl->tpl_vars["fo"]->first;
?>


<?php if ($_smarty_tpl->getVariable('tt')->value!=$_smarty_tpl->getVariable('fo')->value->getTransactionType()->getId()||$_smarty_tpl->getVariable('fo')->value->getMandateType()->getId()!=$_smarty_tpl->getVariable('tb')->value){?>

<?php if (!$_smarty_tpl->getVariable('smarty')->value['foreach']['boucle']['first']){?>
</tbody>
	</table>
	<?php }?>
	<h3><?php echo $_smarty_tpl->getVariable('fo')->value->getTransactionType()->getName();?>
 <?php echo $_smarty_tpl->getVariable('fo')->value->getMandateType()->getName();?>
 </h3>
	<table class="centpourCent">
		<thead>
		<tr>
			<th>Nom</th>
			<th>min</th>
			<th>Max</th>
			<th>Modifier</th>
			<th>Supprimer</th>
		</tr>
		</thead>
<tbody>
<?php }?>
	<tr>
<td><?php echo $_smarty_tpl->getVariable('fo')->value->getName();?>
</td>
<td><?php echo $_smarty_tpl->getVariable('fo')->value->getValMin();?>
</td>
<td><?php echo $_smarty_tpl->getVariable('fo')->value->getValMax();?>
</td>
<td class="center"><a href="<?php echo Tools::create_url($_smarty_tpl->getVariable('user')->value,'export_site','updFp',$_smarty_tpl->getVariable('fo')->value->getId());?>
" title="<?php echo Lang::LABEL_UPDATE;?>
"><img src="<?php echo Constant::DEFAULT_URL_PICTURE_DIRECTORY;?>
update.png" alt="<?php echo Lang::LABEL_UPDATE;?>
" /></a></td>
<td class="center"><a href="<?php echo Tools::create_url($_smarty_tpl->getVariable('user')->value,'export_site','delFp',$_smarty_tpl->getVariable('fo')->value->getId());?>
" title="<?php echo Lang::LABEL_DELETE;?>
"><img src="<?php echo Constant::DEFAULT_URL_PICTURE_DIRECTORY;?>
delete.png" alt="<?php echo Lang::LABEL_DELETE;?>
" /></a></td>
</tr>

	
	
<?php $_smarty_tpl->tpl_vars["tt"] = new Smarty_variable($_smarty_tpl->getVariable('fo')->value->getTransactionType()->getId(), null, null);?>
<?php $_smarty_tpl->tpl_vars["tb"] = new Smarty_variable($_smarty_tpl->getVariable('fo')->value->getMandateType()->getId(), null, null);?>


<?php }} ?>

</tbody>
	</table>
</div>
<div class="mSep">
<h1>Fourchettes de surfaces :</h1>
<a href="<?php echo Tools::create_url($_smarty_tpl->getVariable('user')->value,'export_site','addFt');?>
">Ajouter une tranche</a>
<?php $_smarty_tpl->tpl_vars["tt"] = new Smarty_variable('', null, null);?>
<?php $_smarty_tpl->tpl_vars["tb"] = new Smarty_variable('', null, null);?>




<?php  $_smarty_tpl->tpl_vars["fo"] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('fourchettesSurface')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
 $_smarty_tpl->tpl_vars["fo"]->index=-1;
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars["fo"]->key => $_smarty_tpl->tpl_vars["fo"]->value){
 $_smarty_tpl->tpl_vars["fo"]->index++;
 $_smarty_tpl->tpl_vars["fo"]->first = $_smarty_tpl->tpl_vars["fo"]->index === 0;
 $_smarty_tpl->tpl_vars['smarty']->value['foreach']["boucle"]['first'] = $_smarty_tpl->tpl_vars["fo"]->first;
?>


<?php if ($_smarty_tpl->getVariable('tt')->value!=$_smarty_tpl->getVariable('fo')->value->getTransactionType()->getId()||$_smarty_tpl->getVariable('fo')->value->getMandateType()->getId()!=$_smarty_tpl->getVariable('tb')->value){?>

<?php if (!$_smarty_tpl->getVariable('smarty')->value['foreach']['boucle']['first']){?>
</tbody>
	</table>
	<?php }?>
	<h3><?php echo $_smarty_tpl->getVariable('fo')->value->getTransactionType()->getName();?>
 <?php echo $_smarty_tpl->getVariable('fo')->value->getMandateType()->getName();?>
 </h3>
	<table class="centpourCent">
		<thead>
		<tr>
			<th>Nom</th>
			<th>min</th>
			<th>Max</th>
			<th>Modifier</th>
			<th>Supprimer</th>
		</tr>
		</thead>
<tbody>
<?php }?>
	<tr>
<td><?php echo $_smarty_tpl->getVariable('fo')->value->getName();?>
</td>
<td><?php echo $_smarty_tpl->getVariable('fo')->value->getValMin();?>
</td>
<td><?php echo $_smarty_tpl->getVariable('fo')->value->getValMax();?>
</td>
<td class="center"><a href="<?php echo Tools::create_url($_smarty_tpl->getVariable('user')->value,'export_site','updFt',$_smarty_tpl->getVariable('fo')->value->getId());?>
" title="<?php echo Lang::LABEL_UPDATE;?>
"><img src="<?php echo Constant::DEFAULT_URL_PICTURE_DIRECTORY;?>
update.png" alt="<?php echo Lang::LABEL_UPDATE;?>
" /></a></td>
<td class="center"><a href="<?php echo Tools::create_url($_smarty_tpl->getVariable('user')->value,'export_site','delFt',$_smarty_tpl->getVariable('fo')->value->getId());?>
" title="<?php echo Lang::LABEL_DELETE;?>
"><img src="<?php echo Constant::DEFAULT_URL_PICTURE_DIRECTORY;?>
delete.png" alt="<?php echo Lang::LABEL_DELETE;?>
" /></a></td>
</tr>

	
	
<?php $_smarty_tpl->tpl_vars["tt"] = new Smarty_variable($_smarty_tpl->getVariable('fo')->value->getTransactionType()->getId(), null, null);?>
<?php $_smarty_tpl->tpl_vars["tb"] = new Smarty_variable($_smarty_tpl->getVariable('fo')->value->getMandateType()->getId(), null, null);?>


<?php }} ?>

</tbody>
	</table>
</div>
</div>
