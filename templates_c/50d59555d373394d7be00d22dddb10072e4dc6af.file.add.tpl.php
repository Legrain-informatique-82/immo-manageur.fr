<?php /* Smarty version Smarty-3.0.6, created on 2012-10-17 09:15:25
         compiled from "/var/www/aptana/extra-immo/modules/acquereur/views/add.tpl" */ ?>
<?php /*%%SmartyHeaderCode:375605767507e5b0d765b43-42376806%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '50d59555d373394d7be00d22dddb10072e4dc6af' => 
    array (
      0 => '/var/www/aptana/extra-immo/modules/acquereur/views/add.tpl',
      1 => 1325673449,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '375605767507e5b0d765b43-42376806',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<?php $_template = new Smarty_Internal_Template("tpl_default/entete.tpl", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate();?><?php $_template->updateParentVariables(0);?><?php unset($_template);?>
<h1><?php echo $_smarty_tpl->getVariable('h1')->value;?>
</h1>

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
	<div id="blocAcq">
<form action="" method="post">
<?php if ($_smarty_tpl->getVariable('listUser')->value){?>
	
	<fieldset>
		<legend>Utilisateur affecté </legend>
		<label for="userSelected">Utilisateur affecté : </label><select name="userSelected" id="userSelected"> <?php  $_smarty_tpl->tpl_vars['u'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('listUser')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['u']->key => $_smarty_tpl->tpl_vars['u']->value){
?>
			<option <?php if ($_smarty_tpl->getVariable('userSelected')->value==$_smarty_tpl->getVariable('u')->value->getIdUser()){?> selected="selected"
				<?php }?> value="<?php echo $_smarty_tpl->getVariable('u')->value->getIdUser();?>
"><?php echo $_smarty_tpl->getVariable('u')->value->getName();?>
 <?php echo $_smarty_tpl->getVariable('u')->value->getFirstname();?>
</option>
			<?php }} ?>
		</select>
	</fieldset>
	<?php }?>
	<fieldset>
		<legend>Acquereur</legend>
		<p>
			<label for="titreAcquereur">Titre acquereur</label> <select name="titreAcquereur" id="titreAcquereur">
				<?php  $_smarty_tpl->tpl_vars['c'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('listTitre')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['c']->key => $_smarty_tpl->tpl_vars['c']->value){
?>
				<option <?php if ($_smarty_tpl->getVariable('titreAcquereur')->value==$_smarty_tpl->getVariable('c')->value->getIdTitreAcquereur()){?>
					selected="selected" <?php }?> value="<?php echo $_smarty_tpl->getVariable('c')->value->getIdTitreAcquereur();?>
">
					<?php echo $_smarty_tpl->getVariable('c')->value->getName();?>
</option> <?php }} ?>
			</select>
		</p>
		<p>
			<label for="name">Nom : </label><input type="text" name="name"
				value="<?php echo $_smarty_tpl->getVariable('name')->value;?>
" id="name" /> 
		</p>
				<p>
			<label for="maidenName">Nom de jeune fille : </label><input type="text" name="maidenName"
				value="<?php echo $_smarty_tpl->getVariable('maidenName')->value;?>
" id="maidenName" /> 
		</p>
		<p>
			 <label for="firstname">Prénom :</label><input type="text" name="firstname"
				value="<?php echo $_smarty_tpl->getVariable('firstname')->value;?>
" id="firstname" /> 
		</p>
		<p>
			 <label for="address">Adresse :</label><input type="text" name="address"
				value="<?php echo $_smarty_tpl->getVariable('address')->value;?>
" id="address" /> 
		</p>
		<p>
			<label for="city">Ville : </label><select name="city" id="city"><?php  $_smarty_tpl->tpl_vars['c'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('listCity')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['c']->key => $_smarty_tpl->tpl_vars['c']->value){
?>
				<option <?php if ($_smarty_tpl->getVariable('city')->value==$_smarty_tpl->getVariable('c')->value->getIdCity()){?> selected="selected" <?php }?>
					value="<?php echo $_smarty_tpl->getVariable('c')->value->getIdCity();?>
"> <?php echo $_smarty_tpl->getVariable('c')->value->getZipCode();?>
 <?php echo $_smarty_tpl->getVariable('c')->value->getName();?>
</option>
				<?php }} ?>
			</select>
		</p>
		
		<p>
			 <label for="phone">Téléphone :</label><input type="text" name="phone"
				value="<?php echo $_smarty_tpl->getVariable('phone')->value;?>
" id="phone" /> 
		</p>
		<p>
			 <label for="mobilPhone">Téléphone portable :</label><input type="text"
				name="mobilPhone" value="<?php echo $_smarty_tpl->getVariable('mobilPhone')->value;?>
" id="mobilPhone" /> 
		</p>
		<p>
			 <label for="workPhone">Téléphone ( travail) :</label><input type="text"
				name="workPhone" value="<?php echo $_smarty_tpl->getVariable('workPhone')->value;?>
" id="workPhone" /> 
		</p>

		<p>
			 <label for="fax">Fax :</label><input type="text" name="fax" value="<?php echo $_smarty_tpl->getVariable('fax')->value;?>
"
				id="fax" /> 
		</p>
		<p>
			 <label for="email">Email :</label><input type="text" name="email"
				value="<?php echo $_smarty_tpl->getVariable('email')->value;?>
" id="email" /> 
		</p>
		
		
		<p>
			 <label for="birthdate">Date de naissance :</label><input type="text" name="birthdate"
				value="<?php echo $_smarty_tpl->getVariable('birthdate')->value;?>
" id="birthdate" class="datepicker"/> 
		</p>
		<p>
			 <label for="birthLocation">Lieu de naissance :</label><input type="text" name="birthLocation"
				value="<?php echo $_smarty_tpl->getVariable('birthLocation')->value;?>
" id="birthLocation" /> 
		</p>
		<p>
			 <label for="nationality">Nationalité :</label><input type="text" name="nationality"
				value="<?php echo $_smarty_tpl->getVariable('nationality')->value;?>
" id="nationality" /> 
		</p>
		<p>
			 <label for="job">Profession :</label><input type="text" name="job"
				value="<?php echo $_smarty_tpl->getVariable('job')->value;?>
" id="job" /> 
		</p>
	</fieldset>
	
	
	<?php if ($_smarty_tpl->getVariable('listSituation')->value){?>
	<fieldset>
		<legend>Situation de famille : </legend>
		<?php  $_smarty_tpl->tpl_vars["itemSit"] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('listSituation')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
 $_smarty_tpl->tpl_vars['smarty']->value['foreach']["boucle"]['iteration']=0;
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars["itemSit"]->key => $_smarty_tpl->tpl_vars["itemSit"]->value){
 $_smarty_tpl->tpl_vars['smarty']->value['foreach']["boucle"]['iteration']++;
?>
		<?php if ($_smarty_tpl->getVariable('situation')->value==$_smarty_tpl->getVariable('itemSit')->value->getId()){?>
			<?php $_smarty_tpl->tpl_vars["valueOk"] = new Smarty_variable("1", null, null);?>
		<?php }else{ ?>
			<?php $_smarty_tpl->tpl_vars["valueOk"] = new Smarty_variable("0", null, null);?>
		<?php }?>
			<p><label for="situation_<?php echo $_smarty_tpl->getVariable('smarty')->value['foreach']['boucle']['iteration'];?>
"><?php echo $_smarty_tpl->getVariable('itemSit')->value->getName();?>
</label>
			<input type="radio" name="situation" id="situation_<?php echo $_smarty_tpl->getVariable('smarty')->value['foreach']['boucle']['iteration'];?>
" value="<?php echo $_smarty_tpl->getVariable('itemSit')->value->getId();?>
" <?php if ($_smarty_tpl->getVariable('situation')->value==$_smarty_tpl->getVariable('itemSit')->value->getId()){?> checked="checked"<?php }?>/>
			<input type="hidden" name="id[]" value="<?php echo $_smarty_tpl->getVariable('itemSit')->value->getId();?>
"/>
			<?php if ($_smarty_tpl->getVariable('itemSit')->value->getIfEventDate()){?> Le : <input type="text" name="eventDate[]"  class="datepicker" value="<?php if ($_smarty_tpl->getVariable('valueOk')->value==1){?><?php echo $_smarty_tpl->getVariable('situationDate')->value;?>
<?php }?>"/><?php }else{ ?> <input type="hidden" name="eventDate[]" value="" /> <?php }?>			
			<?php if ($_smarty_tpl->getVariable('itemSit')->value->getIfEventLocation()){?> À : <input type="text" name="eventLocation[]"  value="<?php if ($_smarty_tpl->getVariable('valueOk')->value==1){?><?php echo $_smarty_tpl->getVariable('situationLocation')->value;?>
<?php }?>" /><?php }else{ ?><input type="hidden" name="eventLocation[]" value="" /><?php }?>
			
			
			
			</p>
		<?php }} ?>
		
	</fieldset>
	<?php }?>
	<fieldset>
		<legend>Critères de recherche : </legend>
		<p>
		<label for="typeTransaction">	Type transaction :</label> <select name="typeTransaction"
				id="typeTransaction"> <?php  $_smarty_tpl->tpl_vars['c'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('listTypeTransaction')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['c']->key => $_smarty_tpl->tpl_vars['c']->value){
?>
				<option <?php if ($_smarty_tpl->getVariable('typeTransaction')->value==$_smarty_tpl->getVariable('c')->value->getIdTransactionType()){?>
					selected="selected" <?php }?> value="<?php echo $_smarty_tpl->getVariable('c')->value->getIdTransactionType();?>
">
					<?php echo str_replace('Vente','Achat',$_smarty_tpl->getVariable('c')->value->getName());?>
</option> <?php }} ?>
			</select>
		</p>

		<p>
			<label for="typeBien">Type de bien : </label> <select name="typeBien" id="typeBien">
				<option value="0">Indifférent</option>
			 <?php  $_smarty_tpl->tpl_vars['c'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('listTypeBien')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['c']->key => $_smarty_tpl->tpl_vars['c']->value){
?>
				<option <?php if ($_smarty_tpl->getVariable('typeBien')->value==$_smarty_tpl->getVariable('c')->value->getIdMandateType()){?> selected="selected"
					<?php }?> value="<?php echo $_smarty_tpl->getVariable('c')->value->getIdMandateType();?>
"> <?php echo $_smarty_tpl->getVariable('c')->value->getName();?>
</option>
				<?php }} ?>
			</select>

		</p>
		<p id="pStyle">
			<label for="style">Style :</label><select name="style" id="style">
				<option value="undefined" <?php if ($_smarty_tpl->getVariable('style')->value=='undefined'){?> selected="selected"<?php }?>>Indifférent</option>
				<?php  $_smarty_tpl->tpl_vars['c'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('listStyle')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['c']->key => $_smarty_tpl->tpl_vars['c']->value){
?>
				<option <?php if ($_smarty_tpl->getVariable('style')->value==$_smarty_tpl->getVariable('c')->value->getIdMandateStyle()){?> selected="selected"
					<?php }?> value="<?php echo $_smarty_tpl->getVariable('c')->value->getIdMandateStyle();?>
"> <?php echo $_smarty_tpl->getVariable('c')->value->getName();?>
</option>
				<?php }} ?>
			</select>
		</p>
		<p>
			<label for="prixMin">Prix minimum : </label><input type="text" name="prixMin"
				id="prixMin" value="<?php echo $_smarty_tpl->getVariable('prixMin')->value;?>
" /> 
		</p>
		<p> <label for="prixMax">Prix
				Maximum : </label><input type="text" name="prixMax" id="prixMax"
				value="<?php echo $_smarty_tpl->getVariable('prixMax')->value;?>
" /> 
		</p>

		<p>
			<label for="surfaceTmin">Surface terrain minimum : </label><input type="text"
				name="surfaceTmin" id="surfaceTmin" value="<?php echo $_smarty_tpl->getVariable('surfaceTmin')->value;?>
" />
		</p>
		<p>
			<label for="surfaceTmax">Surface terrain Maximum :</label> <input type="text"
				name="surfaceTmax" id="surfaceTmax" value="<?php echo $_smarty_tpl->getVariable('surfaceTmax')->value;?>
" /> 
		</p>

		<p>
			<label for="surfaceHmin">Surface habitable minimum :</label> <input
				type="text" name="surfaceHmin" id="surfaceHmin"
				value="<?php echo $_smarty_tpl->getVariable('surfaceHmin')->value;?>
" /> 
		</p>
		<p>
			<label for="surfaceHmax">Surface
				habitable Maximum :</label> <input type="text" name="surfaceHmax"
				id="surfaceHmax" value="<?php echo $_smarty_tpl->getVariable('surfaceHmax')->value;?>
" /> 
		</p>

		<p>
			<label for="sector">Secteur : </label><select name="sector" id="sector">
					<option value="undefined" <?php if ($_smarty_tpl->getVariable('sector')->value=='undefined'){?> selected="selected"<?php }?>>Indifférent</option>
					<?php  $_smarty_tpl->tpl_vars['c'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('listSector')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['c']->key => $_smarty_tpl->tpl_vars['c']->value){
?>
					<option <?php if ($_smarty_tpl->getVariable('sector')->value==$_smarty_tpl->getVariable('c')->value->getIdSector()){?> selected="selected" <?php }?>
						value="<?php echo $_smarty_tpl->getVariable('c')->value->getIdSector();?>
"> <?php echo $_smarty_tpl->getVariable('c')->value->getName();?>
</option> <?php }} ?>
			</select> 
		</p>
		<p>
			<label for="rCity"> Ville :</label> <select name="rCity" id="rCity">
					<option value="undefined" <?php if ($_smarty_tpl->getVariable('rCity')->value=='undefined'){?> selected="selected"<?php }?>>Indifférent</option>
					<?php  $_smarty_tpl->tpl_vars['c'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('listCity')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['c']->key => $_smarty_tpl->tpl_vars['c']->value){
?>
					<option <?php if ($_smarty_tpl->getVariable('rCity')->value==$_smarty_tpl->getVariable('c')->value->getIdCity()){?> selected="selected" <?php }?>
						value="<?php echo $_smarty_tpl->getVariable('c')->value->getIdCity();?>
"> <?php echo $_smarty_tpl->getVariable('c')->value->getZipCode();?>
 <?php echo $_smarty_tpl->getVariable('c')->value->getName();?>
</option>
					<?php }} ?>
			</select> 
		</p>
	</fieldset>
	<fieldset>
		<legend>Commentaire :</legend>
		<p>
			<label for="commentAcq">Commentaire sur l'acquereur :</label>
			<textarea name="comment" id="commentAcq" cols="30" rows="10"><?php echo $_smarty_tpl->getVariable('comment')->value;?>
</textarea>
		</p>
	</fieldset>
	<p>
		<input type="submit" name="valid" value="Valider">
	</p>
</form>
</div>
</div>