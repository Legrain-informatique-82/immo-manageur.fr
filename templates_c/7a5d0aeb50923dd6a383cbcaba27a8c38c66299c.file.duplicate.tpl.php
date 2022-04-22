<?php /* Smarty version Smarty-3.0.6, created on 2012-10-15 11:58:32
         compiled from "/var/www/aptana/extra-immo/modules/mandat/views/duplicate.tpl" */ ?>
<?php /*%%SmartyHeaderCode:1498401788507bde48a6d0e8-83280851%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '7a5d0aeb50923dd6a383cbcaba27a8c38c66299c' => 
    array (
      0 => '/var/www/aptana/extra-immo/modules/mandat/views/duplicate.tpl',
      1 => 1350295111,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1498401788507bde48a6d0e8-83280851',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<?php $_template = new Smarty_Internal_Template("tpl_default/entete.tpl", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate();?><?php $_template->updateParentVariables(0);?><?php unset($_template);?>

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
			<label for="numMandat">N° Mandat :</label> <input type="text" name="numMandat" id="numMandat"
				value="<?php echo $_smarty_tpl->getVariable('numMandat')->value;?>
" />
		</p>
		<p>
		<label for="debutMandat">	Début : </label><input class="datepicker" type="text" name="debutMandat"
				id="debutMandat" value="<?php echo $_smarty_tpl->getVariable('debutMandat')->value;?>
" />
		</p>
		<p>
			<label for="finMandat">Fin : </label><input class="datepicker" type="text" name="finMandat"
				id="finMandat" value="<?php echo $_smarty_tpl->getVariable('finMandat')->value;?>
" />
		</p>
		<p>
			<label for="libreMandat">libre le :</label> <input class="datepicker" type="text" name="libreMandat"
				id="libreMandat" value="<?php echo $_smarty_tpl->getVariable('libreMandat')->value;?>
" />
		</p>
	<p><label for="numberlot">Numéro de lot : </label><input type="text" name="numberlot" id="numberlot" value="<?php echo $_smarty_tpl->getVariable('numberlot')->value;?>
"/></p>
	</fieldset>

	<fieldset>
		<legend>Biens</legend>
		<fieldset>
			<legend>Localisation</legend>
			<p>
				<label for="adresseMandat">Adresse :</label> <input type="text" name="adresseMandat" id="adresseMandat"
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
			<label for="prixFai">	<span id="jsPrixFai">Prix FAI</span> :</label> <input type="text"
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
				<label for="commissionMandat">Commission :</label> <input type="text" name="commissionMandat"
					id="commissionMandat" value="<?php echo $_smarty_tpl->getVariable('commissionMandat')->value;?>
" />
			</p>
			<p id="jsEstim">
				<label for="estimationFai">Estimation FAI mini : </label><input type="text" name="estimationFai"
					id="estimationFai" value="<?php echo $_smarty_tpl->getVariable('estimationFai')->value;?>
" />
			</p>
			<p id="jsEstimMaxi">
				<label for="estimationMaxi">Estimation FAI maxi : </label><input type="text" name="estimationMaxi"
					id="jsEstimMaxi" value="<?php echo $_smarty_tpl->getVariable('estimationMaxi')->value;?>
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
				<label for="refCadastre1">Ref cadastre parcelle 1 : </label><input type="text" name="refCadastre1"
					id="refCadastre1" value="<?php echo $_smarty_tpl->getVariable('refCadastre1')->value;?>
" />
			</p>
		</fieldset>

		<hr class="clear invi" />
		<fieldset>
			<legend>Superficie</legend>
			<p>
			<label for="superficieTotale">
				Superficie totale : </label><input type="text" name="superficieTotale"
					id="superficieTotale" value="<?php echo $_smarty_tpl->getVariable('superficieTotale')->value;?>
" />
			</p>

		</fieldset>
		<fieldset>
			<legend>DPE</legend>
			<p>
				<label for="dpeConsoEner">Consommation energétique : </label><input
					type="text" value="<?php echo $_smarty_tpl->getVariable('dpeConsoEner')->value;?>
" name="dpeConsoEner"
					id="dpeConsoEner" /> 
			</p>
			<p>
				<label for="dpeEmissionGaz">Emission de gaz :</label> <input type="text"
					value="<?php echo $_smarty_tpl->getVariable('dpeEmissionGaz')->value;?>
" name="dpeEmissionGaz" id="dpeEmissionGaz" />
				
			</p>
		</fieldset>
		<fieldset>
			<legend>Info du bien</legend>


			<p>
				<label for="nbPiece">Nombre de pièce : </label><input type="text"
					name="nbPiece" id="nbPiece" value="<?php echo $_smarty_tpl->getVariable('nbPiece')->value;?>
" /> 
			</p>

			<p>
				<label for="nbChambre">Nombre de chambre : </label><input type="text"
					name="nbChambre" id="nbChambre" value="<?php echo $_smarty_tpl->getVariable('nbChambre')->value;?>
" /> 
			</p>

			<p>
				<label for="surfaceHab">Surface habitable : </label> <input type="text"
					name="surfaceHab" id="surfaceHab" value="<?php echo $_smarty_tpl->getVariable('surfaceHab')->value;?>
" />
			</p>
			<p>
				<label for="surfacePieceVie">Surface pièce vie :</label> <input type="text"
					name="surfacePieceVie" id="surfacePieceVie"
					value="<?php echo $_smarty_tpl->getVariable('surfacePieceVie')->value;?>
" /> 
			</p>

			<p>
				<label for="niveau">Niveau :</label> <input type="text" name="niveau"
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
				<label for="coupCoeur">Coup de coeur :</label> <input <?php if ($_smarty_tpl->getVariable('coupCoeur')->value=='on'){?> checked="checked" <?php }?> type="checkbox" name="coupCoeur"
					id="coupCoeur" value="on" /> 
			</p>
			<p>
				<label for="nouveauteSite">Nouveauté (site Internet) : </label><input
					type="text" name="nouveauteSite" id="nouveauteSite"
					value="<?php echo $_smarty_tpl->getVariable('nouveauteSite')->value;?>
" class="datepicker" /> 
			</p>

			<p>
				<label for="chargesMensuelle">Charges mensuelles :</label> <input
					type="text" name="chargesMensuelle" id="chargesMensuelle"
					value="<?php echo $_smarty_tpl->getVariable('chargesMensuelle')->value;?>
" /> 
			</p>
			<p>
				<label for="taxesFoncieres">Taxes foncières : </label><input type="text"
					name="taxesFoncieres" id="taxesFoncieres" value="<?php echo $_smarty_tpl->getVariable('taxesFoncieres')->value;?>
" />
				
			</p>
			<p>
				<label for="taxeHabitation">Taxe Habitation : </label><input type="text"
					name="taxeHabitation" id="taxeHabitation" value="<?php echo $_smarty_tpl->getVariable('taxeHabitation')->value;?>
" />
				
			</p>
			<p><label for="numbergarage">Numéro garage : </label><input type="text" name="numbergarage" id="numbergarage" value="<?php echo $_smarty_tpl->getVariable('numbergarage')->value;?>
"/></p>
			<p><label for="numbercellar">Numéro cave : </label><input type="text" name="numbercellar" id="numbercellar"  value="<?php echo $_smarty_tpl->getVariable('numbercellar')->value;?>
"/></p>
			<p><label for="numberparking">Numéro parking : </label><input type="text" name="numberparking" id="numberparking"  value="<?php echo $_smarty_tpl->getVariable('numberparking')->value;?>
"/></p>
			<p><label for="numberattic">Numéro grenier : </label><input type="text" name="numberattic" id="numberattic"  value="<?php echo $_smarty_tpl->getVariable('numberattic')->value;?>
"/></p>
			<p>
				<label for="cheminee">Cheminée : </label><input <?php if ($_smarty_tpl->getVariable('cheminee')->value=='on'){?> checked="checked" <?php }?> type="checkbox" name="cheminee"
					id="cheminee" value="on" /> 
			</p>
			<p>
				<label for="cuisineEquipee">Cuisine équipée :</label> <input
					<?php if ($_smarty_tpl->getVariable('cuisineEquipee')->value=='on'){?> checked="checked"
					<?php }?> type="checkbox" name="cuisineEquipee" id="cuisineEquipee"
					value="on" /> 
			</p>
			<p>
				<label for="cuisineAmenagee">cuisine amenagée :</label> <input
					<?php if ($_smarty_tpl->getVariable('cuisineAmenagee')->value=='on'){?> checked="checked"
					<?php }?> type="checkbox" name="cuisineAmenagee" id="cuisineAmenagee"
					value="on" /> 
			</p>
			<p>
				<label for="piscine">Piscine :</label> <input <?php if ($_smarty_tpl->getVariable('piscine')->value=='on'){?> checked="checked" <?php }?> type="checkbox" name="piscine"
					id="piscine" value="on" /> 
			</p>
			<p>
				<label for="poolHouse">Piscine intérieure :</label> <input <?php if ($_smarty_tpl->getVariable('poolHouse')->value=='on'){?> checked="checked" <?php }?> type="checkbox" name="poolHouse"
					id="poolHouse" value="on" /> 
			</p>
			<p>
				<label for="terrasse">Terrasse :</label> <input <?php if ($_smarty_tpl->getVariable('terrasse')->value=='on'){?> checked="checked" <?php }?> type="checkbox" name="terrasse"
					id="terrasse" value="on" /> 
			</p>
			<p>
				<label for="mezzanine">Mezzanine :</label> <input <?php if ($_smarty_tpl->getVariable('mezzanine')->value=='on'){?> checked="checked" <?php }?> type="checkbox" name="mezzanine"
					id="mezzanine" value="on" /> 
			</p>
			<p>
				<label for="dependance">Dépendance :</label> <input <?php if ($_smarty_tpl->getVariable('dependance')->value=='on'){?> checked="checked" <?php }?> type="checkbox" name="dependance"
					id="dependance" value="on" /> 
			</p>
			<p>
				<label for="gaz">Gaz :</label> <input <?php if ($_smarty_tpl->getVariable('gaz')->value=='on'){?> checked="checked"
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
				<label for="rezDeJardin">Rez de jardin :</label> <input <?php if ($_smarty_tpl->getVariable('rezDeJardin')->value=='on'){?> checked="checked" <?php }?> type="checkbox" name="rezDeJardin"
					id="rezDeJardin" value="on" /> 
			</p>
			<p>
				<label for="plainPied">Plain pied :</label> <input <?php if ($_smarty_tpl->getVariable('plainPied')->value=='on'){?> checked="checked" <?php }?> type="checkbox" name="plainPied"
					id="plainPied" value="on" /> 
			</p>
			<p>
				<label for="carriere">Carrière : </label><input <?php if ($_smarty_tpl->getVariable('carriere')->value=='on'){?> checked="checked" <?php }?> type="checkbox" name="carriere"
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
				<label for="roof"> Toiture : </label><select name="roof" id="roof">
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
				<label for="heating"> Chauffage :</label> <select name="heating"
					id="heating">
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
				<label for="conditions"> Conditions : </label><select name="conditions"
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
		</fieldset>
		<fieldset>
			<legend>Description</legend>
			<?php if (!empty($_smarty_tpl->getVariable('listOrientation',null,true,false)->value)){?>
			<p>
				<label for="idOrientation">Orientation : </label><select name="idOrientation" id="idOrientation">
					<option value="">Non renseigné</option> <?php  $_smarty_tpl->tpl_vars['item'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('listOrientation')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['item']->key => $_smarty_tpl->tpl_vars['item']->value){
?>
					<option <?php if ($_smarty_tpl->getVariable('item')->value->getIdMandateOrientation()==$_smarty_tpl->getVariable('idOrientation')->value){?>selected="selected"
						<?php }?>value="<?php echo $_smarty_tpl->getVariable('item')->value->getIdMandateOrientation();?>
">
						<?php echo $_smarty_tpl->getVariable('item')->value->getName();?>
</option> <?php }} ?>
				</select>
			</p>
			<?php }?> <?php if (!empty($_smarty_tpl->getVariable('listSlope',null,true,false)->value)){?>
			<p>
				<label for="idSlope">Pente : </label><select name="idSlope" id="idSlope">
					<option value="">Non renseigné</option> <?php  $_smarty_tpl->tpl_vars['item'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('listSlope')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['item']->key => $_smarty_tpl->tpl_vars['item']->value){
?>
					<option <?php if ($_smarty_tpl->getVariable('item')->value->getIdMandateSlope()==$_smarty_tpl->getVariable('idSlope')->value){?>selected="selected"
						<?php }?>value="<?php echo $_smarty_tpl->getVariable('item')->value->getIdMandateSlope();?>
"> <?php echo $_smarty_tpl->getVariable('item')->value->getName();?>
</option>
					<?php }} ?>
				</select>
			</p>
			<?php }?>
			<p>
				<label for="tailleFacade">Taille de la façade : </label><input type="text" name="tailleFacade"
					id="tailleFacade" value="<?php echo $_smarty_tpl->getVariable('tailleFacade')->value;?>
" />
			</p>
			<p>
				<label for="profondeurTerrain">Profondeur du terrain :</label> <input type="text" name="profondeurTerrain"
					id="profondeurTerrain" value="<?php echo $_smarty_tpl->getVariable('profondeurTerrain')->value;?>
" />
			</p>
			<p>
				Geolocalisation : </p>
				<p><label for="geoloc">latitude :</label> <input type="text"
					name="geolocLatitude" id="geoloc" value="<?php echo $_smarty_tpl->getVariable('geolocLatitude')->value;?>
" />
					</p>
					<p>
					<label for="geolocLongitude">
				Longitude : </label><input type="text" name="geolocLongitude"
					id="geolocLongitude" value="<?php echo $_smarty_tpl->getVariable('geolocLongitude')->value;?>
" />
			</p>
			<p>
				<label for="proximiteEcole">Proximité école :</label> <input type="text" name="proximiteEcole"
					id="proximiteEcole" value="<?php echo $_smarty_tpl->getVariable('proximiteEcole')->value;?>
" />
			</p>
			<p>
				<label for="proximiteEcole">Proximité commerce :</label> <input type="text" name="proximiteCommerce"
					id="proximiteCommerce" value="<?php echo $_smarty_tpl->getVariable('proximiteCommerce')->value;?>
" />
			</p>
			<p>
				<label for="proximiteTransport">Proximité transport : </label><input type="text" name="proximiteTransport"
					id="proximiteTransport" value="<?php echo $_smarty_tpl->getVariable('proximiteTransport')->value;?>
" />
			</p>
			<p>
				<label for="commentaireApparent">Texte vitrine :</label>
				<textarea name="commentaireApparent" id="commentaireApparent"
					cols="30" rows="10"><?php echo $_smarty_tpl->getVariable('commentaireApparent')->value;?>
</textarea>
			</p>
			<p>
			<label for="pubInternet">
				Pub Internet :</label>
				<textarea name="pubInternet" id="pubInternet" cols="30" rows="10"><?php echo $_smarty_tpl->getVariable('pubInternet')->value;?>
</textarea>
			</p>
		</fieldset>
	</fieldset>

	<p>
		<input type="submit" value="Enregistrer le nouveau mandat" name="send" />
	</p>

</form>
</div>
</div>