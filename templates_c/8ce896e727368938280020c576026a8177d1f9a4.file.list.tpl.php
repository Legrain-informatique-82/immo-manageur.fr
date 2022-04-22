<?php /* Smarty version Smarty-3.0.6, created on 2013-04-16 09:25:13
         compiled from "/var/www/aptana/extra-immo/modules/seller/modules/mandate/views/list.tpl" */ ?>
<?php /*%%SmartyHeaderCode:461930111516cfcd9441ec5-35068724%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '8ce896e727368938280020c576026a8177d1f9a4' => 
    array (
      0 => '/var/www/aptana/extra-immo/modules/seller/modules/mandate/views/list.tpl',
      1 => 1325172353,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '461930111516cfcd9441ec5-35068724',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<h1>Liste des mandats associés</h1>
<table class="standard">
	<thead>
		<tr>
			<th>Photo principale</th>
			<th>Ref mandat</th>
			<th>type de mandat</th>
			<th>Etape en cours</th>
			<th>Adresse</th>
			<th>Prix FAI</th>
			<th>Voir</th>
		</tr>
	</thead>
	<tbody>
		<?php  $_smarty_tpl->tpl_vars['i'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('listMandate')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['i']->key => $_smarty_tpl->tpl_vars['i']->value){
?>
		<?php if ($_smarty_tpl->getVariable('i')->value->getMandateType()->getIdMandateType()==Constant::ID_PLOT_OF_LAND){?>
		 	<?php $_smarty_tpl->tpl_vars["module"] = new Smarty_variable('terrain', null, null);?>
		 <?php }else{ ?>
		 	<?php $_smarty_tpl->tpl_vars["module"] = new Smarty_variable('mandat', null, null);?>
		 <?php }?>
		<tr>
			<td><?php if ($_smarty_tpl->getVariable('i')->value->getPictureByDefault()){?><img
				src="<?php echo Constant::DEFAULT_URL_PICTURE_MODULE_DIRECTORY;?>
/<?php echo $_smarty_tpl->getVariable('module')->value;?>
/thumb/<?php echo $_smarty_tpl->getVariable('i')->value->getPictureByDefault()->getName();?>
"
				alt="Img" /><?php }else{ ?>NC <?php }?></td>
			<td><?php echo $_smarty_tpl->getVariable('i')->value->getNumberMandate();?>
</td>
			<td><?php echo $_smarty_tpl->getVariable('i')->value->getMandateType()->getName();?>
</td>
			<td><?php echo $_smarty_tpl->getVariable('i')->value->getEtap()->getName();?>
</td>
			<td><?php echo $_smarty_tpl->getVariable('i')->value->getAddress();?>
<br /><?php echo $_smarty_tpl->getVariable('i')->value->getCity()->getZipCode();?>

				<?php echo $_smarty_tpl->getVariable('i')->value->getCity()->getName();?>
</td>
			<td><?php echo Tools::grosNombre(round($_smarty_tpl->getVariable('i')->value->getPriceFai(),0));?>
 &euro;</td>
			<td>
			<a href="<?php echo Tools::create_url($_smarty_tpl->getVariable('user')->value,$_smarty_tpl->getVariable('module')->value,'see',$_smarty_tpl->getVariable('i')->value->getIdMandate());?>
"<?php if ($_smarty_tpl->getVariable('user')->value->getOpenInNewTab()){?> target="_blank"<?php }?>>  <img src="<?php echo Constant::DEFAULT_URL_PICTURE_DIRECTORY;?>
see.png" alt="<?php echo Lang::LABEL_SEE;?>
" /> </a>
			</td>
		</tr>

		<?php }} ?>
	</tbody>
</table>
