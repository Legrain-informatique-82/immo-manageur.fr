<?php /* Smarty version Smarty-3.0.6, created on 2012-10-15 09:37:00
         compiled from "/var/www/aptana/extra-immo/modules/mandat/views/add.tpl" */ ?>
<?php /*%%SmartyHeaderCode:1791872896507bbd1c101c27-91115443%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '85b657c9a6341371c6a98ebd785a61fadb25b19d' => 
    array (
      0 => '/var/www/aptana/extra-immo/modules/mandat/views/add.tpl',
      1 => 1350286609,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1791872896507bbd1c101c27-91115443',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<?php $_template = new Smarty_Internal_Template("tpl_default/entete.tpl", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate();?><?php $_template->updateParentVariables(0);?><?php unset($_template);?>
<h1>Ajouter un mandat</h1>
	<?php if (!empty($_smarty_tpl->getVariable('error',null,true,false)->value)){?>
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
<div id="blocMandate">
<form action="" method="post" >


	
	<?php if (!empty($_smarty_tpl->getVariable('listUser',null,true,false)->value)){?>
	<fieldset>
		<legend>Utilisateur</legend>
		<p>
			<label for="idUser">Utilisateur affecté au mandat : </label><select name="idUser" id="idUser">
				<?php  $_smarty_tpl->tpl_vars['item'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('listUser')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['item']->key => $_smarty_tpl->tpl_vars['item']->value){
?>
				<option <?php if ($_smarty_tpl->getVariable('item')->value->getIdUser()==$_smarty_tpl->getVariable('idUser')->value){?>selected="selected"
					<?php }?>value="<?php echo $_smarty_tpl->getVariable('item')->value->getIdUser();?>
"><?php echo $_smarty_tpl->getVariable('item')->value->getFirstname();?>

					<?php echo $_smarty_tpl->getVariable('item')->value->getName();?>
</option> <?php }} ?>
			</select>
		</p>
	</fieldset>
	<?php }?> 
	<fieldset>
		<legend>Général</legend>
		<p>
			<label for="typeTransaction">Type de transaction :</label> <select
				name="typeTransaction" id="typeTransaction"> <?php  $_smarty_tpl->tpl_vars['tt'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('listTypeTransaction')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['tt']->key => $_smarty_tpl->tpl_vars['tt']->value){
?>
					<option <?php if ($_smarty_tpl->getVariable('tt')->value->getIdTransactionType()==$_smarty_tpl->getVariable('typeTransaction')->value){?>
						selected="selected" <?php }?>
						value="<?php echo $_smarty_tpl->getVariable('tt')->value->getIdTransactionType();?>
"><?php echo $_smarty_tpl->getVariable('tt')->value->getName();?>
</option>
					<?php }} ?>
			</select> 
		</p>

		<p>
			<label for="typeBien">Type de bien : </label><select name="typeBien"
				id="typeBien"> <?php  $_smarty_tpl->tpl_vars['tb'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('listTypeBien')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['tb']->key => $_smarty_tpl->tpl_vars['tb']->value){
?> <?php if ($_smarty_tpl->getVariable('tb')->value->getIdMandateType()!=Constant::ID_PLOT_OF_LAND){?>
					<option <?php if ($_smarty_tpl->getVariable('tb')->value->getIdMandateType()==$_smarty_tpl->getVariable('typeBien')->value){?>
						selected="selected" <?php }?>
						value="<?php echo $_smarty_tpl->getVariable('tb')->value->getIdMandateType();?>
"><?php echo $_smarty_tpl->getVariable('tb')->value->getName();?>
</option> <?php }?>
					<?php }} ?>
			</select> 
		</p>

		<p>
			<label for="nature">Nature du bien : </label><select name="nature"
				id="nature"> <?php  $_smarty_tpl->tpl_vars['tb'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('listNature')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['tb']->key => $_smarty_tpl->tpl_vars['tb']->value){
?>

					<option <?php if ($_smarty_tpl->getVariable('tb')->value->getIdMandateNature()==$_smarty_tpl->getVariable('nature')->value){?>
						selected="selected" <?php }?>
						value="<?php echo $_smarty_tpl->getVariable('tb')->value->getIdMandateNature();?>
"><?php echo $_smarty_tpl->getVariable('tb')->value->getName();?>
</option>

					<?php }} ?>
			</select> 
		</p>

	</fieldset>
	<?php if ($_POST['idSeller']&&$_POST['used']){?> <input type="hidden"
		name="idSeller" value="<?php echo $_POST['idSeller'];?>
" /> <input
		type="hidden" name="used" value="<?php echo $_POST['used'];?>
" /> <?php }else{ ?>
	<fieldset>
		<legend>Vendeur principal</legend>
		<?php $_template = new Smarty_Internal_Template('seller/views/frm_add_seller.tpl', $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate();?><?php $_template->updateParentVariables(0);?><?php unset($_template);?>
	</fieldset>
	<?php }?>


	<fieldset>
		<legend>Infos mandat</legend>
		<?php if (!empty($_smarty_tpl->getVariable('listNotary',null,true,false)->value)){?>
		<p>
			<label for="idNotary">Notaire vendeur :</label> <select name="idNotary" id="idNotary"> <?php  $_smarty_tpl->tpl_vars['item'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('listNotary')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['item']->key => $_smarty_tpl->tpl_vars['item']->value){
?>
				<option <?php if ($_smarty_tpl->getVariable('item')->value->getIdNotary()==$_smarty_tpl->getVariable('idNotary')->value){?>selected="selected"
					<?php }?>value="<?php echo $_smarty_tpl->getVariable('item')->value->getIdNotary();?>
"> <?php echo $_smarty_tpl->getVariable('item')->value->getName();?>
</option>
				<?php }} ?>
			</select>
		</p>
		<?php }?>
				<?php if (!empty($_smarty_tpl->getVariable('listNotary',null,true,false)->value)){?>
		<p>
			<label for="idNotaryAcq">Notaire acquereur :</label> <select name="idNotaryAcq" id="idNotaryAcq"> 
			<option value="">NC</option>
			<?php  $_smarty_tpl->tpl_vars['item'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('listNotary')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['item']->key => $_smarty_tpl->tpl_vars['item']->value){
?>
				<option <?php if ($_smarty_tpl->getVariable('item')->value->getIdNotary()==$_smarty_tpl->getVariable('idNotaryAcq')->value){?>selected="selected"
					<?php }?>value="<?php echo $_smarty_tpl->getVariable('item')->value->getIdNotary();?>
"> <?php echo $_smarty_tpl->getVariable('item')->value->getName();?>
</option>
				<?php }} ?>
			</select>
		</p>
		<?php }?>
		<p>
			<label for="numMandat">N° Mandat : </label><input type="text" name="numMandat" id="numMandat"
				value="<?php echo $_smarty_tpl->getVariable('numMandat')->value;?>
" />
		</p>
		<p>
			<label for="debutMandat">Début :</label> <input class="datepicker" type="text" name="debutMandat"
				id="debutMandat" value="<?php echo $_smarty_tpl->getVariable('debutMandat')->value;?>
" />
		</p>
		<p>
			<label for="finMandat">Fin : </label><input class="datepicker" type="text" name="finMandat"
				id="finMandat" value="<?php echo $_smarty_tpl->getVariable('finMandat')->value;?>
" />
		</p>
		<p>
			<label for="libreMandat">libre le : </label><input class="datepicker" type="text" name="libreMandat"
				id="libreMandat" value="<?php echo $_smarty_tpl->getVariable('libreMandat')->value;?>
" />
		</p>
		<p><label for="numberlot">Numéro de lot : </label><input type="text" name="numberlot" id="numberlot"  value="<?php echo $_smarty_tpl->getVariable('numberlot')->value;?>
" /></p>

	</fieldset>

	<fieldset>
		<legend>Biens</legend>
		<fieldset>
			<legend>Localisation</legend>
			<p>
				<label for="adresseMandat">Adresse : </label><input type="text" name="adresseMandat" id="adresseMandat"
					value="<?php echo $_smarty_tpl->getVariable('adresseMandat')->value;?>
" />
			</p>
			<?php if (!empty($_smarty_tpl->getVariable('listCity',null,true,false)->value)){?>
			<p>
			<label for="idCity">Ville : </label>
				<select name="idCity" id="idCity"> <?php  $_smarty_tpl->tpl_vars['item'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('listCity')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['item']->key => $_smarty_tpl->tpl_vars['item']->value){
?>
					<option <?php if ($_smarty_tpl->getVariable('item')->value->getIdCity()==$_smarty_tpl->getVariable('idCity')->value){?>selected="selected"
						<?php }?>value="<?php echo $_smarty_tpl->getVariable('item')->value->getIdCity();?>
"> <?php echo $_smarty_tpl->getVariable('item')->value->getZipCode();?>
 -
						<?php echo $_smarty_tpl->getVariable('item')->value->getName();?>
</option> <?php }} ?>
				</select>
			</p>
			<?php }?>
		</fieldset>
		<fieldset class="cinquante">
			<legend>Prix</legend>

			<p>
				<label for="prixFai"><span id="jsPrixFai">Prix FAI</span> : </label><input type="text"
					name="prixFai" id="prixFai" value="<?php echo $_smarty_tpl->getVariable('prixFai')->value;?>
" />
			</p>
			<p>
				<label for="prixNetVendeur"><span id="jsPrixNetVendeur">Prix net vendeur</span> :</label> <input
					type="text" name="prixNetVendeur" id="prixNetVendeur"
					value="<?php echo $_smarty_tpl->getVariable('prixNetVendeur')->value;?>
" />
			</p>
			<p id="jsCommission">
				<label for="commissionMandat">Commission : </label><input type="text" name="commissionMandat"
					id="commissionMandat" value="<?php echo $_smarty_tpl->getVariable('commissionMandat')->value;?>
" />
			</p>
			<p id="jsEstim">
				<label for="estimationFai">Estimation FAI Mini : </label><input type="text" name="estimationFai"
					id="estimationFai" value="<?php echo $_smarty_tpl->getVariable('estimationFai')->value;?>
" />
			</p>
			<p id="jsEstimMaxi">
			<label for="estimationMaxi">	Estimation FAI Maxi :</label> <input type="text" name="estimationMaxi"
					id="estimationMaxi" value="<?php echo $_smarty_tpl->getVariable('estimationMaxi')->value;?>
" />
			</p>
			<p id="jsMargeNegoce">
				<label for="margeNegoce">Marge negoce :</label> <input type="text" name="margeNegoce"
					id="margeNegoce" value="<?php echo $_smarty_tpl->getVariable('margeNegoce')->value;?>
" />
			</p>
			<p id="jsRental">
		
		<label for="rental">
		Loyer actuel (si locataires ) :</label><input type="text" name="rental" id="rental" value="<?php echo $_smarty_tpl->getVariable('rental')->value;?>
"/> 
		</p>
	    <p><label for="pricegarage">Prix garage : </label><input type="text" name="pricegarage" id="pricegarage" value="<?php echo $_smarty_tpl->getVariable('pricegarage')->value;?>
"/></p>
		<p><label for="pricecellar">Prix Cave : </label><input type="text" name="pricecellar" id="pricecellar" value="<?php echo $_smarty_tpl->getVariable('pricecellar')->value;?>
"/></p>
		<p><label for="profitability">Rentabilité en % :</label><input type="text" name="profitability" id="profitability" value="<?php echo $_smarty_tpl->getVariable('profitability')->value;?>
"/> </p>
		</fieldset>

		<fieldset class="cinquante">
			<legend>Cadastre</legend>
			<p>
			<label for="refCadastre1">	Ref cadastre parcelle 1 :</label> <input type="text" name="refCadastre1"
					id="refCadastre1" value="<?php echo $_smarty_tpl->getVariable('refCadastre1')->value;?>
" />
			</p>

			
		</fieldset>

		<p class="clear">

			<input type="submit"
				value="<?php echo Lang::LABEL_ADD_TERRAIN_AND_REDIRECT_SAVE;?>
"
				name="terrain_add_submit" /> <input type="submit"
				value="<?php echo Lang::LABEL_ADD_TERRAIN_CONTINUE_SAVE;?>
"
				name="terrain_add_submit_and_continue" />
		</p>
	</fieldset>

</form>
</div>
</div>