<?php /* Smarty version Smarty-3.0.6, created on 2012-10-12 11:05:46
         compiled from "/var/www/aptana/extra-immo/modules/mandat/views/updateDesc.tpl" */ ?>
<?php /*%%SmartyHeaderCode:15220172145077dd6add4033-84867507%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '2b72fc36632846b3820fa12a761c172e43117b4b' => 
    array (
      0 => '/var/www/aptana/extra-immo/modules/mandat/views/updateDesc.tpl',
      1 => 1350032745,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '15220172145077dd6add4033-84867507',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<?php $_template = new Smarty_Internal_Template("tpl_default/entete.tpl", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate();?><?php $_template->updateParentVariables(0);?><?php unset($_template);?>
<h1><?php echo $_smarty_tpl->getVariable('title')->value;?>
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
<div id="blocMandate">
<form action="" method="post">
	<div class="mSep">
		<p>
			<label for="nbPiece">Nombre de pièce :</label> <input type="text"
				name="nbPiece" id="nbPiece" value="<?php echo $_smarty_tpl->getVariable('nbPiece')->value;?>
" /> 
		</p>
		<p>
			<label for="nbChambre">Nombre de chambre : </label><input type="text"
				name="nbChambre" id="nbChambre" value="<?php echo $_smarty_tpl->getVariable('nbChambre')->value;?>
" /> 
		</p>
		<p>
			<label for="surfaceHab">Surface habitable :</label> <input type="text"
				name="surfaceHab" id="surfaceHab" value="<?php echo $_smarty_tpl->getVariable('surfaceHab')->value;?>
" /> 
		</p>
			<p>
			<label for="superficieTotale">Surface terrain : </label><input type="text"
				name="superficieTotale" id="superficieTotale" value="<?php echo $_smarty_tpl->getVariable('superficieTotale')->value;?>
" />
		</p>
		<p>
			<label for="surfacePieceVie">Surface pièce vie : </label><input type="text"
				name="surfacePieceVie" id="surfacePieceVie"
				value="<?php echo $_smarty_tpl->getVariable('surfacePieceVie')->value;?>
" /> 
		</p>
		<p>
			<label for="niveau">Niveau : </label> <input type="text" name="niveau"
				id="niveau" value="<?php echo $_smarty_tpl->getVariable('niveau')->value;?>
" />
		</p>
		<p>
			<label for="anneeConstruction">Année construction :</label> <input
				type="text" name="anneeConstruction" id="anneeConstruction"
				value="<?php echo $_smarty_tpl->getVariable('anneeConstruction')->value;?>
" /> 
		</p>
		<p>
			<label for="nouveauteSite">Nouveauté ( site Internet) :</label> <input
				type="text" name="nouveauteSite" id="nouveauteSite"
				class="datepicker" value="<?php echo $_smarty_tpl->getVariable('nouveauteSite')->value;?>
" /> 
		</p>
		<p>
			<label for="chargesMensuelle">Charges mensuelles :</label> <input type="text"
				name="chargesMensuelle" id="chargesMensuelle"
				value="<?php echo $_smarty_tpl->getVariable('chargesMensuelle')->value;?>
" /> 
		</p>
		<p>
			<label for="taxesFoncieres">Taxes foncières : </label><input type="text"
				name="taxesFoncieres" id="taxesFoncieres" value="<?php echo $_smarty_tpl->getVariable('taxesFoncieres')->value;?>
" />
			
		</p>
		<p>
			<label for="taxeHabitation">Taxe Habitation :</label> <input type="text"
				name="taxeHabitation" id="taxeHabitation" value="<?php echo $_smarty_tpl->getVariable('taxeHabitation')->value;?>
" />
			
		</p>
		<p><label for="numbergarage">Numéro garage : </label><input type="text" name="numbergarage" id="numbergarage" value="<?php echo $_smarty_tpl->getVariable('numbergarage')->value;?>
" /></p>
		<p><label for="numbercellar">Numéro cave : </label><input type="text" name="numbercellar" id="numbercellar" value="<?php echo $_smarty_tpl->getVariable('numbercellar')->value;?>
" /></p>
		<p><label for="numberparking">Numéro parking : </label><input type="text" name="numberparking" id="numberparking" value="<?php echo $_smarty_tpl->getVariable('numberparking')->value;?>
" /></p>
		<p><label for="numberattic">Numéro grenier : </label><input type="text" name="numberattic" id="numberattic" value="<?php echo $_smarty_tpl->getVariable('numberattic')->value;?>
" /></p>
		<p>
			<label for="cheminee">Cheminée : </label> <input <?php if ($_smarty_tpl->getVariable('cheminee')->value=='on'){?> checked="checked" <?php }?> type="checkbox" name="cheminee"
				id="cheminee" value="on" />
		</p>
		<p>
			<label for="cuisineEquipee">Cuisine équipée : </label><input
				<?php if ($_smarty_tpl->getVariable('cuisineEquipee')->value=='on'){?> checked="checked" <?php }?> type="checkbox"
				name="cuisineEquipee" id="cuisineEquipee" value="on" /> 
		</p>
		<p>
			<label for="cuisineAmenagee">cuisine amenagée : </label> <input
				<?php if ($_smarty_tpl->getVariable('cuisineAmenagee')->value=='on'){?> checked="checked"
				<?php }?> type="checkbox" name="cuisineAmenagee" id="cuisineAmenagee"
				value="on" />
		</p>
		<p>
			<label for="piscine">Piscine : </label><input <?php if ($_smarty_tpl->getVariable('piscine')->value=='on'){?> checked="checked" <?php }?> type="checkbox" name="piscine"
				id="piscine" value="on" /> 
		</p>
		<p>
			<label for="poolHouse">Piscine intérieure : </label><input <?php if ($_smarty_tpl->getVariable('poolHouse')->value=='on'){?> checked="checked" <?php }?> type="checkbox" name="poolHouse"
				id="poolHouse" value="on" /> 
		</p>
		<p>
			<label for="terrasse">Terrasse : </label><input <?php if ($_smarty_tpl->getVariable('terrasse')->value=='on'){?> checked="checked" <?php }?> type="checkbox" name="terrasse"
				id="terrasse" value="on" /> 
		</p>
	</div>
	<div class="mSep">
		<p>
			<label for="mezzanine">Mezzanine :</label> <input <?php if ($_smarty_tpl->getVariable('mezzanine')->value=='on'){?> checked="checked" <?php }?> type="checkbox" name="mezzanine"
				id="mezzanine" value="on" /> 
		</p>
		<p>
			<label for="dependance">Dépendance : </label><input <?php if ($_smarty_tpl->getVariable('dependance')->value=='on'){?> checked="checked" <?php }?> type="checkbox" name="dependance"
				id="dependance" value="on" /> 
		</p>
		<p>
			<label for="gaz">Gaz : </label> <input <?php if ($_smarty_tpl->getVariable('gaz')->value=='on'){?> checked="checked"
				<?php }?> type="checkbox" name="gaz" id="gaz" value="on" />
		</p>
		<p>
			<label for="cave">Cave :</label> <input <?php if ($_smarty_tpl->getVariable('cave')->value=='on'){?> checked="checked"
				<?php }?> type="checkbox" name="cave" id="cave" value="on" /> 
		</p>
		<p>
			<label for="ssol">Sous sol :</label> <input <?php if ($_smarty_tpl->getVariable('ssol')->value=='on'){?> checked="checked" <?php }?> type="checkbox" name="ssol"
				id="ssol" value="on" /> 
		</p>
		<p>
			<label for="garage">Garage :</label> <input <?php if ($_smarty_tpl->getVariable('garage')->value=='on'){?> checked="checked" <?php }?> type="checkbox" name="garage"
				id="garage" value="on" /> 
		</p>
		<p>
			<label for="parking">Parking :</label> <input <?php if ($_smarty_tpl->getVariable('parking')->value=='on'){?> checked="checked" <?php }?> type="checkbox" name="parking"
				id="parking" value="on" /> 
		</p>
		<p>
			<label for="rezDeJardin">Rez de jardin : </label> <input <?php if ($_smarty_tpl->getVariable('rezDeJardin')->value=='on'){?> checked="checked" <?php }?> type="checkbox" name="rezDeJardin"
				id="rezDeJardin" value="on" />
		</p>
		<p>
			<label for="plainPied">Plain pied : </label><input <?php if ($_smarty_tpl->getVariable('plainPied')->value=='on'){?> checked="checked" <?php }?> type="checkbox" name="plainPied"
				id="plainPied" value="on" /> 
		</p>
		<p>
			<label for="carriere">Carrière :</label> <input <?php if ($_smarty_tpl->getVariable('carriere')->value=='on'){?> checked="checked" <?php }?> type="checkbox" name="carriere"
				id="carriere" value="on" /> 
		</p>
		<p>
			<label for="ptEau">Point eau : </label><input <?php if ($_smarty_tpl->getVariable('ptEau')->value=='on'){?> checked="checked" <?php }?> type="checkbox" name="ptEau"
				id="ptEau" value="on" /> 
		</p>
		<p>
			<label for="ttEgout">Tout à l'égout :</label> <input <?php if ($_smarty_tpl->getVariable('ttEgout')->value=='on'){?> checked="checked" <?php }?> type="checkbox" name="ttEgout"
				id="ttEgout" value="on" /> 
		</p>

		<p>
			<label for="insulation"> Isolation :</label> <select name="insulation"
				id="insulation">
					<option value="0">Non spécifié</option> <?php  $_smarty_tpl->tpl_vars['item'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('listInsulation')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['item']->key => $_smarty_tpl->tpl_vars['item']->value){
?>
					<option value="<?php echo $_smarty_tpl->getVariable('item')->value->getIdMandateInsulation();?>
" <?php if ($_smarty_tpl->getVariable('item')->value->getIdMandateInsulation()==$_smarty_tpl->getVariable('insulation')->value){?> selected="selected"<?php }?>><?php echo $_smarty_tpl->getVariable('item')->value->getName();?>
</option>
					<?php }} ?>
			</select> 
		</p>

		<p>
			<label for="roof"> Toiture :  </label><select name="roof" id="roof">
					<option value="0">Non spécifié</option> <?php  $_smarty_tpl->tpl_vars['item'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('listRoof')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['item']->key => $_smarty_tpl->tpl_vars['item']->value){
?>
					<option value="<?php echo $_smarty_tpl->getVariable('item')->value->getIdMandateRoof();?>
" <?php if ($_smarty_tpl->getVariable('item')->value->getIdMandateRoof()==$_smarty_tpl->getVariable('roof')->value){?> selected="selected"<?php }?>><?php echo $_smarty_tpl->getVariable('item')->value->getName();?>
</option>
					<?php }} ?>
			</select>
		</p>


		<p>
			<label for="heating"> Chauffage : </label> <select name="heating" id="heating">
					<option value="0">Non spécifié</option> <?php  $_smarty_tpl->tpl_vars['item'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('listHeating')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['item']->key => $_smarty_tpl->tpl_vars['item']->value){
?>
					<option value="<?php echo $_smarty_tpl->getVariable('item')->value->getIdMandateHeating();?>
" <?php if ($_smarty_tpl->getVariable('item')->value->getIdMandateHeating()==$_smarty_tpl->getVariable('heating')->value){?> selected="selected"<?php }?>><?php echo $_smarty_tpl->getVariable('item')->value->getName();?>
</option>
					<?php }} ?>
			</select>
		</p>


		<p>
			<label for="commonOwnership"> Parties communes :</label> <select
				name="commonOwnership" id="commonOwnership">
					<option value="0">Non spécifié</option> <?php  $_smarty_tpl->tpl_vars['item'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('listCommonOwnership')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['item']->key => $_smarty_tpl->tpl_vars['item']->value){
?>
					<option value="<?php echo $_smarty_tpl->getVariable('item')->value->getIdMandateCommonOwnership();?>
" <?php if ($_smarty_tpl->getVariable('item')->value->getIdMandateCommonOwnership()==$_smarty_tpl->getVariable('commonOwnership')->value){?> selected="selected"<?php }?>><?php echo $_smarty_tpl->getVariable('item')->value->getName();?>
</option>
					<?php }} ?>
			</select> 
		</p>


		<p>
			<label for="constructionType"> Type de construction :</label> <select
				name="constructionType" id="constructionType">
					<option value="0">Non spécifié</option> <?php  $_smarty_tpl->tpl_vars['item'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('listConstructionType')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['item']->key => $_smarty_tpl->tpl_vars['item']->value){
?>
					<option value="<?php echo $_smarty_tpl->getVariable('item')->value->getIdMandateConstructionType();?>
" <?php if ($_smarty_tpl->getVariable('item')->value->getIdMandateConstructionType()==$_smarty_tpl->getVariable('constructionType')->value){?> selected="selected"<?php }?>><?php echo $_smarty_tpl->getVariable('item')->value->getName();?>
</option>
					<?php }} ?>
			</select> 
		</p>

		<p>
			<label for="style"> Style : </label><select name="style" id="style">
					<option value="0">Non spécifié</option> <?php  $_smarty_tpl->tpl_vars['item'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('listStyle')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['item']->key => $_smarty_tpl->tpl_vars['item']->value){
?>
					<option value="<?php echo $_smarty_tpl->getVariable('item')->value->getIdMandateStyle();?>
" <?php if ($_smarty_tpl->getVariable('item')->value->getIdMandateStyle()==$_smarty_tpl->getVariable('style')->value){?> selected="selected"<?php }?>><?php echo $_smarty_tpl->getVariable('item')->value->getName();?>
</option>
					<?php }} ?>
			</select> 
		</p>

		<p>
			<label for="ne"> Nouveautés :</label> <select name="ne" id="ne">
					<option value="0">Non spécifié</option> <?php  $_smarty_tpl->tpl_vars['item'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('listNews')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['item']->key => $_smarty_tpl->tpl_vars['item']->value){
?>
					<option value="<?php echo $_smarty_tpl->getVariable('item')->value->getIdMandateNews();?>
" <?php if ($_smarty_tpl->getVariable('item')->value->getIdMandateNews()==$_smarty_tpl->getVariable('ne')->value){?> selected="selected"<?php }?>><?php echo $_smarty_tpl->getVariable('item')->value->getName();?>
</option>
					<?php }} ?>
			</select> 
		</p>


		<p>
			<label for="conditions"> Conditions :</label> <select name="conditions"
				id="conditions">
					<option value="0">Non spécifié</option> <?php  $_smarty_tpl->tpl_vars['item'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('listConditions')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['item']->key => $_smarty_tpl->tpl_vars['item']->value){
?>
					<option value="<?php echo $_smarty_tpl->getVariable('item')->value->getIdMandateCondition();?>
" <?php if ($_smarty_tpl->getVariable('item')->value->getIdMandateCondition()==$_smarty_tpl->getVariable('conditions')->value){?> selected="selected"<?php }?>><?php echo $_smarty_tpl->getVariable('item')->value->getName();?>
</option>
					<?php }} ?>
			</select> 
		</p>
		
		<p>
			<label for="adjoining"> Mitoyenneté : </label><select name="adjoining"
				id="adjoining">
					<option value="0">Non spécifié</option> <?php  $_smarty_tpl->tpl_vars['item'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('listAdjoining')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['item']->key => $_smarty_tpl->tpl_vars['item']->value){
?>
					<option value="<?php echo $_smarty_tpl->getVariable('item')->value->getId();?>
" <?php if ($_smarty_tpl->getVariable('item')->value->getId()==$_smarty_tpl->getVariable('adjoining')->value){?> selected="selected"<?php }?>><?php echo $_smarty_tpl->getVariable('item')->value->getName();?>
</option>
					<?php }} ?>
			</select> 
		</p>
		
	</div>
	<hr class="clear invi" />
	<p>
		<input type="submit" name="valid" value="Valider" /><input
			type="submit" name="cancel" value="Annuler" />
	</p>
</form>
</div>
</div>