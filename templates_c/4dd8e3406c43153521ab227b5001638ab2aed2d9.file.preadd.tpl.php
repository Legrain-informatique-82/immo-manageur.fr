<?php /* Smarty version Smarty-3.0.6, created on 2012-10-12 11:36:14
         compiled from "/var/www/aptana/extra-immo/modules/mandat/views/preadd.tpl" */ ?>
<?php /*%%SmartyHeaderCode:9553238715077e48ef2db70-04218241%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '4dd8e3406c43153521ab227b5001638ab2aed2d9' => 
    array (
      0 => '/var/www/aptana/extra-immo/modules/mandat/views/preadd.tpl',
      1 => 1312885710,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '9553238715077e48ef2db70-04218241',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<?php $_template = new Smarty_Internal_Template("tpl_default/entete.tpl", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate();?><?php $_template->updateParentVariables(0);?><?php unset($_template);?>
<h1>Ajouter un mandat à partir :</h1>
<form action="<?php echo $_smarty_tpl->getVariable('urlAct')->value;?>
" method="post">

	<p>
		<input type="submit" name="new" value="D'un nouveau vendeur" />
	</p>
</form>
<table class="standard">
	<thead>
		<tr>

			<th>Nom &amp; prénom</th>
			<th>Titre</th>
			<th>Opérateur lié</th>
			<th>téléphones</th>
			<th>Email</th>
			<th>Etat</th>
			<th>De ce vendeur</th>
		</tr>
	</thead>
	<tbody>
		<?php  $_smarty_tpl->tpl_vars['item'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('listSeller')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['item']->key => $_smarty_tpl->tpl_vars['item']->value){
?>
		<tr>

			<td><?php echo $_smarty_tpl->getVariable('item')->value->getName();?>
 - <?php echo $_smarty_tpl->getVariable('item')->value->getFirstname();?>
</td>
			<td><?php echo $_smarty_tpl->getVariable('item')->value->getSellerTitle()->getLibel();?>
</td>
			<td><?php echo $_smarty_tpl->getVariable('item')->value->getUser()->getFirstname();?>
 <?php echo $_smarty_tpl->getVariable('item')->value->getUser()->getName();?>
</td>
			<td><?php if ($_smarty_tpl->getVariable('item')->value->getPhone()){?>
				<p><?php echo Lang::LABEL_SELLER_ADD_PHONE;?>
<?php echo $_smarty_tpl->getVariable('item')->value->getPhone();?>
</p><?php }?> <?php if ($_smarty_tpl->getVariable('item')->value->getMobilPhone()){?>
				<p><?php echo Lang::LABEL_SELLER_ADD_MOBIL_PHONE;?>
<?php echo $_smarty_tpl->getVariable('item')->value->getMobilPhone();?>
</p><?php }?>
				<?php if ($_smarty_tpl->getVariable('item')->value->getWorkPhone()){?>
				<p><?php echo Lang::LABEL_SELLER_ADD_WORK_PHONE;?>
<?php echo $_smarty_tpl->getVariable('item')->value->getWorkPhone();?>
</p><?php }?>
			</td>
			<td><?php echo $_smarty_tpl->getVariable('item')->value->getEmail();?>
</td>
			<td><?php if ($_smarty_tpl->getVariable('item')->value->getAsset()==1){?>Actif<?php }else{ ?>Inactif<?php }?></td>
			<td>
				<form action="<?php echo $_smarty_tpl->getVariable('urlAct')->value;?>
" method="post">
					<p>
						<input type="hidden" name="idSeller"
							value="<?php echo $_smarty_tpl->getVariable('item')->value->getIdSeller();?>
" /> <input type="submit"
							name="used" value="De ce vendeur" />
					</p>
				</form>
			</td>
		</tr>
		<?php }} ?>
	</tbody>
</table>


</div>
