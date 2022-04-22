<?php /* Smarty version Smarty-3.0.6, created on 2014-09-11 12:28:08
         compiled from "/var/www/aptana/immo-manageur.fr/modules/seller/modules/mandate/views/list.tpl" */ ?>
<?php /*%%SmartyHeaderCode:128885107854117938846d13-90053521%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '7e6173c4d436e97a8884817f5e6bb2f5627d5f09' => 
    array (
      0 => '/var/www/aptana/immo-manageur.fr/modules/seller/modules/mandate/views/list.tpl',
      1 => 1410431286,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '128885107854117938846d13-90053521',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<div class="row bg-success bannerTitle">
    <div class="col-md-12">
        <h1 class="h2">Liste des mandats associés</h1>
    </div>
    </div>
<table class="dataTableDefault table table-striped table-bordered">
	<thead>
    <tr class="tri">
        <th class="jshide"></th>
        <th class="jshide"></th>
        <th></th>
        <th></th>
        <th class="jshide"></th>
        <th></th>
        <th class="jshide"></th>
    </tr>
		<tr>
			<th>Photo principale</th>
			<th>Ref mandat</th>
			<th>type de mandat</th>
			<th>Etape en cours</th>
			<th>Adresse</th>
			<th>Prix FAI</th>
			<th>Actions</th>
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
				alt="Img" class="img-thumbnail" /><?php }else{ ?>NC <?php }?></td>
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
			<td data-order="<?php echo round($_smarty_tpl->getVariable('i')->value->getPriceFai(),0);?>
"><?php echo Tools::grosNombre(round($_smarty_tpl->getVariable('i')->value->getPriceFai(),0));?>
 &euro;</td>
			<td>

                <a href="<?php echo Tools::create_url($_smarty_tpl->getVariable('user')->value,$_smarty_tpl->getVariable('module')->value,'see',$_smarty_tpl->getVariable('i')->value->getIdMandate());?>
"<?php if ($_smarty_tpl->getVariable('user')->value->getOpenInNewTab()){?> target="_blank"<?php }?> class="btn btn-default"> <i class="fa fa-chevron-circle-right"></i> <?php echo Lang::LABEL_SEE;?>
 </a>
			</td>
		</tr>

		<?php }} ?>
	</tbody>
</table>
