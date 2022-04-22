<?php /* Smarty version Smarty-3.0.6, created on 2013-05-24 09:52:52
         compiled from "/var/www/aptana/extra-immo/modules/mandat/views/updateGen.tpl" */ ?>
<?php /*%%SmartyHeaderCode:910180218519f1c540fe1a1-56501055%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '0360c34e25ef7e49755c6460268d823e3e01b084' => 
    array (
      0 => '/var/www/aptana/extra-immo/modules/mandat/views/updateGen.tpl',
      1 => 1369380368,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '910180218519f1c540fe1a1-56501055',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<?php $_template = new Smarty_Internal_Template("tpl_default/entete.tpl", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate();?><?php $_template->updateParentVariables(0);?><?php unset($_template);?>
<h1>Modification générales :</h1>
<?php if ($_smarty_tpl->getVariable('error')->value){?>
<ul class="contError">
	<?php  $_smarty_tpl->tpl_vars['e'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('error')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['e']->key => $_smarty_tpl->tpl_vars['e']->value){
?>
	<li class="error"><?php echo $_smarty_tpl->tpl_vars['e']->value;?>
</li> <?php }} ?>
</ul>
<?php }?>
<div id="blocMandate">
<form action="" method="post">
	<div class="mSep">
		<h2>Localisation</h2>
		<p>
			<label for="address">Addresse : </label><input type="text"
				name="address" id="address" value="<?php echo $_smarty_tpl->getVariable('address')->value;?>
" />
		</p>
		<p>
			<label for="city">Ville : </label><select name="city" id="city">
				<?php  $_smarty_tpl->tpl_vars['ci'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('listcity')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['ci']->key => $_smarty_tpl->tpl_vars['ci']->value){
?>
				<option <?php if ($_smarty_tpl->getVariable('ci')->value->getIdCity()==$_smarty_tpl->getVariable('city')->value){?> selected="selected"
					<?php }?>value="<?php echo $_smarty_tpl->getVariable('ci')->value->getIdCity();?>
"> <?php echo $_smarty_tpl->getVariable('ci')->value->getZipCode();?>

					<?php echo $_smarty_tpl->getVariable('ci')->value->getName();?>
</option> <?php }} ?>
			</select>
		</p>
	</div>
	<div class="mSep">
		<h2>Général</h2>
		<p>
			<label for="nature">Nature du bien : </label><select name="nature"
				id="nature"> <?php  $_smarty_tpl->tpl_vars['it'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('listNature')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['it']->key => $_smarty_tpl->tpl_vars['it']->value){
?>
				<option <?php if ($_smarty_tpl->getVariable('it')->value->getIdMandateNature()==$_smarty_tpl->getVariable('nature')->value){?>
					selected="selected" <?php }?>value="<?php echo $_smarty_tpl->getVariable('it')->value->getIdMandateNature();?>
">
					<?php echo $_smarty_tpl->getVariable('it')->value->getName();?>
</option> <?php }} ?>
			</select>
		</p>
		<?php if ($_smarty_tpl->getVariable('user')->value->getLevelMember()->getIdLevelMember()<3){?>
		<p>
			<label for="userSe">Utilisateur affecté : </label><select
				name="userSe" id="userSe"> <?php  $_smarty_tpl->tpl_vars['i'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('listUser')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['i']->key => $_smarty_tpl->tpl_vars['i']->value){
?>
				<option <?php if ($_smarty_tpl->getVariable('i')->value->getIdUser()==$_smarty_tpl->getVariable('userSe')->value){?> selected="selected"
					<?php }?>value="<?php echo $_smarty_tpl->getVariable('i')->value->getIdUser();?>
"><?php echo $_smarty_tpl->getVariable('i')->value->getFirstName();?>
 <?php echo $_smarty_tpl->getVariable('i')->value->getName();?>
</option>
				<?php }} ?>
			</select>
		</p>
		<?php }?>
		<?php if (!empty($_smarty_tpl->getVariable('listNotary',null,true,false)->value)){?>
		<p>
			<label for="notary">Notaire vendeur : </label><select name="notary"
				id="notary"> <?php  $_smarty_tpl->tpl_vars['i'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('listNotary')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['i']->key => $_smarty_tpl->tpl_vars['i']->value){
?>
				<option <?php if ($_smarty_tpl->getVariable('i')->value->getIdNotary()==$_smarty_tpl->getVariable('notary')->value){?> selected="selected"
					<?php }?>value="<?php echo $_smarty_tpl->getVariable('i')->value->getIdNotary();?>
"> <?php echo $_smarty_tpl->getVariable('i')->value->getName();?>
</option>
				<?php }} ?>
			</select>
		</p>
			
		<p>
			<label for="notaryAcq">Notaire acquereur :</label> <select name="notaryAcq" id="notaryAcq"> 
			<option value="">NC</option>
			<?php  $_smarty_tpl->tpl_vars['item'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('listNotary')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['item']->key => $_smarty_tpl->tpl_vars['item']->value){
?>
				<option <?php if ($_smarty_tpl->getVariable('item')->value->getIdNotary()==$_smarty_tpl->getVariable('notaryAcq')->value){?>selected="selected"
					<?php }?>value="<?php echo $_smarty_tpl->getVariable('item')->value->getIdNotary();?>
"> <?php echo $_smarty_tpl->getVariable('item')->value->getName();?>
</option>
				<?php }} ?>
			</select>
		</p>
		<?php }?>
		<p>
			<label for="typeTransaction">Type de transaction : </label><select
				name="transactionType" id="typeTransaction"> <?php  $_smarty_tpl->tpl_vars['i'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('listTransactionType')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['i']->key => $_smarty_tpl->tpl_vars['i']->value){
?>
				<option <?php if ($_smarty_tpl->getVariable('i')->value->getIdTransactionType()==$_smarty_tpl->getVariable('transactionType')->value){?>
					selected="selected" <?php }?>value="<?php echo $_smarty_tpl->getVariable('i')->value->getIdTransactionType();?>
">
					<?php echo $_smarty_tpl->getVariable('i')->value->getName();?>
</option> <?php }} ?>
			</select>
		</p>
		<p>
			<label for="typeBien">Type de bien : </label><select name="typeBien"
				id="typeBien"> <?php  $_smarty_tpl->tpl_vars['i'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('listMandateType')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['i']->key => $_smarty_tpl->tpl_vars['i']->value){
?>
				<?php if ($_smarty_tpl->getVariable('i')->value->getIdMandateType()!=Constant::ID_PLOT_OF_LAND){?>
				<option <?php if ($_smarty_tpl->getVariable('i')->value->getIdMandateType()==$_smarty_tpl->getVariable('typeBien')->value){?> selected="selected"
					<?php }?>value="<?php echo $_smarty_tpl->getVariable('i')->value->getIdMandateType();?>
"> <?php echo $_smarty_tpl->getVariable('i')->value->getName();?>
</option>
					<?php }?>
				<?php }} ?>
			</select>
		</p>

	</div>
	<hr class="invi clear" />
	<div class="mSep">
		<h2>Mandat</h2>
		<p>
			<label for="numMandat">Numéro de mandat : </label><input type="text"
				name="numMandat" id="numMandat" value="<?php echo $_smarty_tpl->getVariable('numMandat')->value;?>
" />
		</p>
		<p>
			<label for="debutMandat">Début : </label> <input type="text"
				class="datepicker" name="debutMandat" id="debutMandat"
				value="<?php echo $_smarty_tpl->getVariable('debutMandat')->value;?>
" />
		</p>
		<p>
			<label for="finMandat">Fin : </label> <input type="text"
				class="datepicker" name="finMandat" id="finMandat"
				value="<?php echo $_smarty_tpl->getVariable('finMandat')->value;?>
" />
		</p>
		<p>
			<label for="libreMandat">libre le : </label> <input type="text"
				class="datepicker" name="libreMandat" id="libreMandat"
				value="<?php echo $_smarty_tpl->getVariable('libreMandat')->value;?>
" />
		</p>
		<p><label for="numberlot">Numéro de lot : </label><input type="text" name="numberlot" id="numberlot" value="<?php echo $_smarty_tpl->getVariable('numberlot')->value;?>
"/></p>
	</div>
	<div class="mSep">
		<h2>Prix</h2>
		<p>
			<label for="prixFai">Prix FAI : </label><input type="text"
				name="prixFAI" id="prixFai" value="<?php echo $_smarty_tpl->getVariable('prixFAI')->value;?>
" />
		</p>
		<p>
			<label for="prixNetVendeur">Prix net vendeur : </label><input
				type="text" name="prixNetVendeur" id="prixNetVendeur"
				value="<?php echo $_smarty_tpl->getVariable('prixNetVendeur')->value;?>
" />
		</p>
		<p id="jsCommission">
			<label for="commissionMandat">Commission : </label><input type="text"
				name="commission" id="commissionMandat" value="<?php echo $_smarty_tpl->getVariable('commission')->value;?>
" />
		</p>
		<p id="jsEstim">
			<label for="estimationMini">Estimation Mini : </label><input
				type="text" name="estimationMini" id="estimationMini"
				value="<?php echo $_smarty_tpl->getVariable('estimationMini')->value;?>
" />
		</p>
		<p id="jsEstimMaxi">
			<label for="estimationMaxi">Estimation Maxi : </label><input
				type="text" name="estimationMaxi" id="estimationMaxi"
				value="<?php echo $_smarty_tpl->getVariable('estimationMaxi')->value;?>
" />
		</p>
		<p id="jsMargeNegoce">
			<label for="margeNegoce">Marge negoce : </label><input type="text"
				name="margeNegoce" id="margeNegoce" value="<?php echo $_smarty_tpl->getVariable('margeNegoce')->value;?>
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
	</div>
	<hr class="invi clear" />
	<div class="bulle">
		<h2>Géolocalisation</h2>
		<p>En degrès sexagésimaux :</p>
		<p>
			<label for="latitude">Latitude : </label><input type="text"
				id="latitude" name="latitude" value="<?php echo $_smarty_tpl->getVariable('latitude')->value;?>
" />
		</p>
		<p>
			<label for="longitude"> Longitude : </label> <input type="text"
				id="longitude" name="longitude" value="<?php echo $_smarty_tpl->getVariable('longitude')->value;?>
" />
		</p>
	</div>

	<p>
		<input type="submit" name="valid" value="Valider" /><input
			type="submit" name="cancel" value="Annuler" />
	</p>
</form>
</div>
</div>