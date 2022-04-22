<?php /* Smarty version Smarty-3.0.6, created on 2014-05-14 09:13:37
         compiled from "/var/www/aptana/extra-immo/modules/mandat/views/add_new_seller_for_mandate.tpl" */ ?>
<?php /*%%SmartyHeaderCode:1259339662537317a195d165-89309986%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '4de5f92f31c4c388f48c65c7e91280a80547463c' => 
    array (
      0 => '/var/www/aptana/extra-immo/modules/mandat/views/add_new_seller_for_mandate.tpl',
      1 => 1369380366,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1259339662537317a195d165-89309986',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<?php $_template = new Smarty_Internal_Template("tpl_default/entete.tpl", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate();?><?php $_template->updateParentVariables(0);?><?php unset($_template);?>
<h1>Ajouter un vendeur au terrain : <?php echo $_smarty_tpl->getVariable('mandate')->value->getNumberMandate();?>
</h1>

<h2>A partir d'un nouveau vendeur</h2>
	<?php if ($_smarty_tpl->getVariable('error')->value){?>
	<ul class="contError">
		<?php  $_smarty_tpl->tpl_vars['item'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('error')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['item']->key => $_smarty_tpl->tpl_vars['item']->value){
?>
		<li class="error"><?php echo $_smarty_tpl->tpl_vars['item']->value;?>
</li> <?php }} ?>
	</ul>
	<?php }?> 
<div class="bulle" id="blocMandate">
<form action="" method="post">
<?php $_template = new Smarty_Internal_Template('seller/views/frm_add_seller.tpl', $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate();?><?php $_template->updateParentVariables(0);?><?php unset($_template);?>
	<p>
		<label for="sellerByDefault"> Vendeur par defaut :</label> <input
			value="on" type="checkbox" name="sellerByDefault"
			id="sellerByDefault" /> 
	</p>
	<p>
		<input type="submit" value="<?php echo Lang::LABEL_SAVE;?>
"
			id="seller_add_submit_send" name="seller_add_submit_send" />
	</p>
</form>
</div>
<h2>D'un vendeur de la liste ci-dessous</h2>
<table class="standard">
	<thead>
		<tr>

			<th>Nom &amp; prénom</th>
			<th>Titre</th>
			<th>Opérateur lié</th>
			<th>Téléphones</th>
			<th>Email</th>
			<th>Etat</th>
			<th>De ce vendeur</th>
		</tr>
	</thead>
	<tbody>
		<?php  $_smarty_tpl->tpl_vars['item'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('listSeller')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
 $_smarty_tpl->tpl_vars['smarty']->value['foreach']["frm"]['iteration']=0;
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['item']->key => $_smarty_tpl->tpl_vars['item']->value){
 $_smarty_tpl->tpl_vars['smarty']->value['foreach']["frm"]['iteration']++;
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
				<form action="" method="post">
					<p>
						<input type="hidden" name="idSeller"
							value="<?php echo $_smarty_tpl->getVariable('item')->value->getIdSeller();?>
" /> <label
							for="sellerByDefault<?php echo $_smarty_tpl->getVariable('smarty')->value['foreach']['frm']['iteration'];?>
">Définir
							comme vendeur par defaut : <input value="on" type="checkbox"
							name="sellerByDefault"
							id="sellerByDefault<?php echo $_smarty_tpl->getVariable('smarty')->value['foreach']['frm']['iteration'];?>
" /> </label>
					</p>
					<p>
						<input type="submit" name="used" value="Affecter ce vendeur" />
					</p>
				</form>
			</td>
		</tr>
		<?php }} ?>
	</tbody>
</table>


</div>
