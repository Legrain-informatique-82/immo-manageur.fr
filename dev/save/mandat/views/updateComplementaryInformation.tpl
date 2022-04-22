{include file="tpl_default/entete.tpl"} {if $error}
<ul>
	{foreach from=$error item=e}
	<li class="error">{$e}</li> {/foreach}
</ul>

{/if}
<form action="" method="post" enctype="multipart/form-data">


	<fieldset>
		<legend>Superficie</legend>
		{*
		<p>
			Superficie parcelle 1 : <input type="text" name="superficieParcelle1"
				id="superficieParcelle1" value="{$superficieParcelle1}" />
		</p>
		<p>
			Superficie parcelle 2 : <input type="text" name="superficieParcelle2"
				id="superficieParcelle2" value="{$superficieParcelle2}" />
		</p>
		<p>
			Superficie parcelle 3 : <input type="text" name="superficieParcelle3"
				id="superficieParcelle3" value="{$superficieParcelle3}" />
		</p>
		<p>
			Superficie autres parcelle : <input type="text"
				name="superficieAutreParcelle" id="superficieAutreParcelle"
				value="{$superficieAutreParcelle}" />
		</p>
		<p>
			Superficie constructible : <input type="text"
				name="superficieConstructible" id="superficieConstructible"
				value="{$superficieConstructible}" />
		</p>
		<p>
			Superficie non constructible : <input type="text"
				name="superficieNonConstructible" id="superficieNonConstructible"
				value="{$superficieNonConstructible}" />
		</p>
		*}
		<p>
			Superficie totale : <input type="text" name="superficieTotale"
				id="superficieTotale" value="{$superficieTotale}" />
		</p>
		{* {if !empty($listGeometer)}
		<p>
			géometre : <select name="idGeometer" id="idGeometer">
				<option value="">Non renseigné</option> {foreach from=$listGeometer
				item=item}
				<option {if $item->getIdMandateGeometer() eq
					$idGeometer}selected="selected"
					{/if}value="{$item->getIdMandateGeometer()}"> {$item->getName()}</option>
				{/foreach}
			</select>
		</p>
		{/if} {if !empty($listBornageTerrain)}
		<p>
			Bornage : <select name="idBornageTerrain" id="idBornageTerrain">
				<option value="">Non renseigné</option> {foreach
				from=$listBornageTerrain item=item}
				<option {if $item->getIdMandateBornageTerrain() eq
					$idBornageTerrain}selected="selected"
					{/if}value="{$item->getIdMandateBornageTerrain()}">
					{$item->getName()}</option> {/foreach}
			</select>
		</p>
		{/if} *}
	</fieldset>

	{* DPE *}
	<fieldset>
		<legend>DPE</legend>
		<p>
			<label for="dpeConsoEner">Consommation energétique : <input
				type="text" value="{$dpeConsoEner}" name="dpeConsoEner"
				id="dpeConsoEner" /> </label>
		</p>
		<p>
			<label for="dpeEmissionGaz">Emission de gaz : <input type="text"
				value="{$dpeEmissionGaz}" name="dpeEmissionGaz" id="dpeEmissionGaz" />
			</label>
		</p>
	</fieldset>
	<fieldset>
		<legend>Info du bien</legend>


		<p>
			<label for="nbPiece">Nombre de pièce : <input type="text"
				name="nbPiece" id="nbPiece" value="{$nbPiece}" /> </label>
		</p>

		<p>
			<label for="nbChambre">Nombre de chambre : <input type="text"
				name="nbChambre" id="nbChambre" value="{$nbChambre}" /> </label>
		</p>

		<p>
			<label for="surfaceHab">Surface habitable : <input type="text"
				name="surfaceHab" id="surfaceHab" value="{$surfaceHab}" /> </label>
		</p>
		<p>
			<label for="surfacePieceVie">Surface pièce vie : <input type="text"
				name="surfacePieceVie" id="surfacePieceVie"
				value="{$surfacePieceVie}" /> </label>
		</p>

		<p>
			<label for="niveau">Niveau : <input type="text" name="niveau"
				id="niveau" value="{$niveau}" /> </label>
		</p>
		<p>
			<label for="anneeConstruction">Année construction : <input
				type="text" name="anneeConstruction" id="anneeConstruction"
				value="{$anneeConstruction}" /> </label>
		</p>
		<p>
			<label for="coupCoeur">Coup de coeur : <input {if $coupCoeur
				eq 'on'} checked="checked" {/if} type="checkbox" name="coupCoeur"
				id="coupCoeur" value="on" /> </label>
		</p>
		<p>
			<label for="nouveauteSite">Nouveauté (champs site Internet) : <input
				type="text" name="nouveauteSite" id="nouveauteSite"
				class="datepicker" value="{$nouveauteSite}" /> </label>
		</p>

		<p>
			<label for="chargesMensuelle">Charges mensuelles : <input type="text"
				name="chargesMensuelle" id="chargesMensuelle"
				value="{$chargesMensuelle}" /> </label>
		</p>
		<p>
			<label for="taxesFoncieres">Taxes foncières : <input type="text"
				name="taxesFoncieres" id="taxesFoncieres" value="{$taxesFoncieres}" />
			</label>
		</p>
		<p>
			<label for="taxeHabitation">Taxe Habitation : <input type="text"
				name="taxeHabitation" id="taxeHabitation" value="{$taxeHabitation}" />
			</label>
		</p>

		<p>
			<label for="cheminee">Cheminée : <input {if $cheminee
				eq 'on'} checked="checked" {/if} type="checkbox" name="cheminee"
				id="cheminee" value="on" /> </label>
		</p>
		<p>
			<label for="cuisineEquipee">Cuisine équipée : <input
				{if $cuisineEquipee eq 'on'} checked="checked" {/if} type="checkbox"
				name="cuisineEquipee" id="cuisineEquipee" value="on" /> </label>
		</p>
		<p>
			<label for="cuisineAmenagee">cuisine amenagée : <input
				{if $cuisineAmenagee eq 'on'} checked="checked"
				{/if} type="checkbox" name="cuisineAmenagee" id="cuisineAmenagee"
				value="on" /> </label>
		</p>
		<p>
			<label for="piscine">Piscine : <input {if $piscine
				eq 'on'} checked="checked" {/if} type="checkbox" name="piscine"
				id="piscine" value="on" /> </label>
		</p>
		<p>
			<label for="poolHouse">Piscine intérieure : <input {if $poolHouse
				eq 'on'} checked="checked" {/if} type="checkbox" name="poolHouse"
				id="poolHouse" value="on" /> </label>
		</p>
		<p>
			<label for="terrasse">Terrasse : <input {if $terrasse
				eq 'on'} checked="checked" {/if} type="checkbox" name="terrasse"
				id="terrasse" value="on" /> </label>
		</p>
		<p>
			<label for="mezzanine">Mezzanine : <input {if $mezzanine
				eq 'on'} checked="checked" {/if} type="checkbox" name="mezzanine"
				id="mezzanine" value="on" /> </label>
		</p>
		<p>
			<label for="dependance">Dépendance : <input {if $dependance
				eq 'on'} checked="checked" {/if} type="checkbox" name="dependance"
				id="dependance" value="on" /> </label>
		</p>
		<p>
			<label for="gaz">Gaz : <input {if $gaz eq 'on'} checked="checked"
				{/if} type="checkbox" name="gaz" id="gaz" value="on" /> </label>
		</p>
		<p>
			<label for="cave">Cave : <input {if $cave eq 'on'} checked="checked"
				{/if} type="checkbox" name="cave" id="cave" value="on" /> </label>
		</p>
		<p>
			<label for="ssol">Sous sol : <input {if $ssol
				eq 'on'} checked="checked" {/if} type="checkbox" name="ssol"
				id="ssol" value="on" /> </label>
		</p>
		<p>
			<label for="garage">Garage : <input {if $garage
				eq 'on'} checked="checked" {/if} type="checkbox" name="garage"
				id="garage" value="on" /> </label>
		</p>
		<p>
			<label for="parking">Parking : <input {if $parking
				eq 'on'} checked="checked" {/if} type="checkbox" name="parking"
				id="parking" value="on" /> </label>
		</p>
		<p>
			<label for="rezDeJardin">Rez de jardin : <input {if $rezDeJardin
				eq 'on'} checked="checked" {/if} type="checkbox" name="rezDeJardin"
				id="rezDeJardin" value="on" /> </label>
		</p>
		<p>
			<label for="plainPied">Plain pied : <input {if $plainPied
				eq 'on'} checked="checked" {/if} type="checkbox" name="plainPied"
				id="plainPied" value="on" /> </label>
		</p>
		<p>
			<label for="carriere">Carrière : <input {if $carriere
				eq 'on'} checked="checked" {/if} type="checkbox" name="carriere"
				id="carriere" value="on" /> </label>
		</p>
		<p>
			<label for="ptEau">Point eau : <input {if $ptEau
				eq 'on'} checked="checked" {/if} type="checkbox" name="ptEau"
				id="ptEau" value="on" /> </label>
		</p>

		{* Listes ... *}
		<p>
			<label for="insulation"> Isolation : <select name="insulation"
				id="insulation">
					<option value="0">Non spécifié</option> {foreach
					from=$listInsulation item=item}
					<option value="{$item->getIdMandateInsulation()}" {if $item->getIdMandateInsulation()
						eq $insulation} selected="selected"{/if}>{$item->getName()}</option>
					{/foreach}
			</select> </label>
		</p>

		<p>
			<label for="roof"> Toiture : <select name="roof" id="roof">
					<option value="0">Non spécifié</option> {foreach from=$listRoof
					item=item}
					<option value="{$item->getIdMandateRoof()}" {if $item->getIdMandateRoof()
						eq $roof} selected="selected"{/if}>{$item->getName()}</option>
					{/foreach}
			</select> </label>
		</p>


		<p>
			<label for="heating"> Chauffage : <select name="heating" id="heating">
					<option value="0">Non spécifié</option> {foreach from=$listHeating
					item=item}
					<option value="{$item->getIdMandateHeating()}" {if $item->getIdMandateHeating()
						eq $heating} selected="selected"{/if}>{$item->getName()}</option>
					{/foreach}
			</select> </label>
		</p>


		<p>
			<label for="commonOwnership"> Parties communes : <select
				name="commonOwnership" id="commonOwnership">
					<option value="0">Non spécifié</option> {foreach
					from=$listCommonOwnership item=item}
					<option value="{$item->getIdMandateCommonOwnership()}" {if $item->getIdMandateCommonOwnership()
						eq $commonOwnership} selected="selected"{/if}>{$item->getName()}</option>
					{/foreach}
			</select> </label>
		</p>


		<p>
			<label for="constructionType"> Type de construction : <select
				name="constructionType" id="constructionType">
					<option value="0">Non spécifié</option> {foreach
					from=$listConstructionType item=item}
					<option value="{$item->getIdMandateConstructionType()}" {if $item->getIdMandateConstructionType()
						eq $constructionType} selected="selected"{/if}>{$item->getName()}</option>
					{/foreach}
			</select> </label>
		</p>

		<p>
			<label for="style"> Style : <select name="style" id="style">
					<option value="0">Non spécifié</option> {foreach from=$listStyle
					item=item}
					<option value="{$item->getIdMandateStyle()}" {if $item->getIdMandateStyle()
						eq $style} selected="selected"{/if}>{$item->getName()}</option>
					{/foreach}
			</select> </label>
		</p>

		<p>
			<label for="ne"> Nouveautés : <select name="ne" id="ne">
					<option value="0">Non spécifié</option> {foreach from=$listNews
					item=item}
					<option value="{$item->getIdMandateNews()}" {if $item->getIdMandateNews()
						eq $ne} selected="selected"{/if}>{$item->getName()}</option>
					{/foreach}
			</select> </label>
		</p>


		<p>
			<label for="conditions"> Conditions : <select name="conditions"
				id="conditions">
					<option value="0">Non spécifié</option> {foreach
					from=$listConditions item=item}
					<option value="{$item->getIdMandateCondition()}" {if $item->getIdMandateCondition()
						eq $conditions} selected="selected"{/if}>{$item->getName()}</option>
					{/foreach}
			</select> </label>
		</p>


	</fieldset>
	{*
	<fieldset>
		<legend>Réglementation</legend>

		{if !empty($listZonagePlu)}
		<p>
			Zonage PLU <select name="idZonagePlu" id="idZonagePlu">
				<option value="">Non renseigné</option> {foreach from=$listZonagePlu
				item=item}
				<option {if $item->getIdMandateZonagePlu() eq
					$idZonagePlu}selected="selected"
					{/if}value="{$item->getIdMandateZonagePlu()}"> {$item->getName()}</option>
				{/foreach}
			</select>
		</p>
		{/if} {if !empty($listZonageRnu)}
		<p>
			Zonage RNU <select name="idZonageRnu" id="idZonageRnu">
				<option value="">Non renseigné</option> {foreach from=$listZonageRnu
				item=item}
				<option {if $item->getIdMandateZonageRnu() eq
					$idZonageRnu}selected="selected"
					{/if}value="{$item->getIdMandateZonageRnu()}"> {$item->getName()}</option>
				{/foreach}
			</select>
		</p>
		{/if} {if !empty($listCos)}
		<p>
			COS : <select name="idCos" id="idCos">
				<option value="">Non renseigné</option> {foreach from=$listCos
				item=item}
				<option {if $item->getIdMandateCos() eq $idCos}selected="selected"
					{/if}value="{$item->getIdMandateCos()}"> {$item->getName()}</option>
				{/foreach}
			</select>
		</p>
		{/if}
		<p>
			Shon accordée : <input type="text" name="shonAccordee"
				id="shonAccordee" value="{$shonAccordee}" />
		</p>

		<p>
			Zone BDF : <label for="zonebdfFalse"><input type="radio" {if $zonebdf
				eq 0}checked="checked" {/if} value="0" name="zonebdf"
				id="zonebdfFalse" />Non</label><label for="zonebdfTrue"><input
				type="radio" {if $zonebdf eq 1}checked="checked" {/if} value="1"
				name="zonebdf" id="zonebdfTrue" />Oui</label>
		</p>
		<p>
			ligne de crete : <label for="ligneCreteFalse"><input {if $ligneCrete
				eq 0}checked="checked" {/if} type="radio" value="0"
				name="ligneCrete" id="ligneCreteFalse" />Non</label><label
				for="ligneCreteTrue"><input type="radio" {if $ligneCrete
				eq 1}checked="checked" {/if} value="1" name="ligneCrete"
				id="ligneCreteTrue" />Oui</label>
		</p>
		<p>
			zone inondable : <label for="zoneInondableFalse"><input type="radio"
				value="0" {if $zoneInondable eq 0} checked="checked"
				{/if}  name="zoneInondable" id="zoneInondableFalse" />Non</label><label
				for="zoneInondableTrue"><input type="radio" value="1"
				{if $zoneInondable eq 1} checked="checked"
				{/if} name="zoneInondable" id="zoneInondableTrue" />Oui</label>
		</p>
		<p>
			Réglement lotissement :
			<textarea name="reglementLotissement" id="reglementLotissement"
				cols="30" rows="10">{$reglementLotissement}</textarea>
		</p>
		<p>
			ERNT :
			<textarea name="ernt" id="ernt" cols="30" rows="10">{$ernt}</textarea>
		</p>
	</fieldset>

	<fieldset>
		<legend>Autorisation</legend>
		<p>
			DP valide : <label for="dPValideFalse"><input type="radio"
				{if $dPValide eq 0} checked="checked" {/if} value="0"
				name="dPValide" id="dPValideFalse" />Non</label><label
				for="dPValideTrue"><input type="radio" {if $dPValide
				eq 1} checked="checked" {/if} value="1" name="dPValide"
				id="dPValideTrue" />Oui</label>
		</p>
		<p>
			Date déclaration préalable : <input class="datepicker" type="text"
				name="dateDeclPrealableDP" id="dateDeclPrealableDP"
				value="{$dateDeclPrealableDP}" />
		</p>
		<p>
			Prorogation DP jusqu'au : <input class="datepicker" type="text"
				name="dateProrogationDP" id="dateProrogationDP"
				value="{$dateProrogationDP}" />
		</p>
		<p>
			CU valide : <label for="cuValideFalse"><input type="radio" value="0"
				{if $cuValide eq 0} checked="checked" {/if} name="cuValide"
				id="cuValideFalse" />Non</label><label for="cuValideTrue"><input
				type="radio" value="1" {if $cuValide eq 1} checked="checked"
				{/if}name="cuValide" id="cuValideTrue" />Oui</label>
		</p>
		<p>
			Date déclaration préalable : <input class="datepicker" type="text"
				name="dateDeclPrealableCU" id="dateDeclPrealableCU"
				value="{$dateDeclPrealableCU}" />
		</p>
		<p>
			Prorogation CU jusqu'au : <input class="datepicker" type="text"
				name="dateProrogationCU" id="dateProrogationCU"
				value="{$dateProrogationCU}" />
		</p>
		<p>
			CU Ops valide : <label for="cuOpsValideFalse"><input type="radio"
				{if $cuOpsValide eq 0} checked="checked" {/if} value="0"
				name="cuOpsValide" id="cuOpsValideFalse" />Non</label><label
				for="cuOpsValideTrue"><input type="radio" {if $cuOpsValide
				eq 1} checked="checked" {/if} value="1" name="cuOpsValide"
				id="cuOpsValideTrue" />Oui</label>
		</p>
		<p>
			Date déclaration préalable : <input class="datepicker" type="text"
				name="dateDeclPrealableCUOPS" id="dateDeclPrealableCUOPS"
				value="{$dateDeclPrealableCUOPS}" />
		</p>
		<p>
			Prorogation CU Ops jusqu'au : <input class="datepicker" type="text"
				name="dateProrogationCUOPS" id="dateProrogationCUOPS"
				value="{$dateProrogationCUOPS}" />
		</p>
		<p>
			Permis d'amenager valide : <label for="permisAmenagerValideFalse"><input
				type="radio" value="0" {if $permisAmenagerValide
				eq 0} checked="checked" {/if} name="permisAmenagerValide"
				id="permisAmenagerValideFalse" />Non</label><label
				for="permisAmenagerValideTrue"><input type="radio" value="1"
				{if $permisAmenagerValide eq 1} checked="checked"
				{/if}  name="permisAmenagerValide" id="permisAmenagerValideTrue" />Oui</label>
		</p>
		<p>
			Date de permis d'amenager : <input class="datepicker" type="text"
				name="datePermisAmenager" id="datePermisAmenager"
				value="{$datePermisAmenager}" />
		</p>
	</fieldset>
	<fieldset>
		<legend>Viabilisation</legend>
		<p>
			Terrain vendu viabilisé : <label for="terrainViabiliseFalse"><input
				type="radio" {if $terrainViabilise eq 0} checked="checked"
				{/if} value="0" name="terrainViabilise" id="terrainViabiliseFalse" />Non</label><label
				for="terrainViabiliseTrue"><input type="radio" {if $terrainViabilise
				eq 1} checked="checked" {/if} value="1" name="terrainViabilise"
				id="terrainViabiliseTrue" />Oui</label>
		</p>
		<p>
			Terrain vendu semi viabilisé : <label for="terrainSemiViabiliseFalse"><input
				type="radio" value="0" {if $terrainSemiViabilise
				eq 0} checked="checked" {/if} name="terrainSemiViabilise"
				id="terrainSemiViabiliseFalse" />Non</label><label
				for="terrainSemiViabiliseTrue"><input type="radio" value="1"
				name="terrainSemiViabilise" {if $terrainSemiViabilise
				eq 1} checked="checked" {/if} id="terrainSemiViabiliseTrue" />Oui</label>
		</p>
		<p>
			Terrain vendu non viabilisé : <label for="terrainNonViabiliseFalse"><input
				type="radio" value="0" {if $terrainNonViabilise
				eq 0} checked="checked" {/if} name="terrainNonViabilise"
				id="terrainNonViabiliseFalse" />Non</label><label
				for="terrainNonViabiliseTrue"><input type="radio" value="1"
				name="terrainNonViabilise" {if $terrainNonViabilise
				eq 1} checked="checked" {/if} id="terrainNonViabiliseTrue" />Oui</label>
		</p>
		<p>
			Passage eau :
			<textarea name="passageEau" id="passageEau" cols="30" rows="10">{$passageEau}</textarea>
		</p>
		{if !empty($listWaterCorresponding)}
		<p>
			Correspondant eau : <select name="idWaterCorresponding"
				id="idWaterCorresponding">
				<option value="">Non renseigné</option> {foreach
				from=$listWaterCorresponding item=item}
				<option {if $item->getIdMandateWaterCorresponding() eq
					$idWaterCorresponding}selected="selected"
					{/if}value="{$item->getIdMandateWaterCorresponding()}">
					{$item->getName()}</option> {/foreach}
			</select>
		</p>
		{/if}

		<p>
			Passage éléctricité :
			<textarea name="passageElectricite" id="passageElectricite" cols="30"
				rows="10">{$passageElectricite}</textarea>
		</p>
		{if !empty($listElectricCorresponding)}

		<p>
			Correspondant electrique : <select name="idElectricCorresponding"
				id="idElectricCorresponding">
				<option value="">Non renseigné</option> {foreach
				from=$listElectricCorresponding item=item}
				<option {if $item->getIdMandateElectricCorresponding() eq
					$idElectricCorresponding}selected="selected"
					{/if}value="{$item->getIdMandateElectricCorresponding()}">
					{$item->getName()}</option> {/foreach}
			</select>
		</p>
		{/if}

		<p>
			Passage gaz :
			<textarea name="passageGaz" id="passageGaz" cols="30" rows="10">{$passageGaz}</textarea>
		</p>
		{if !empty($listGazCorresponding)}
		<p>
			Correspondant gaz : <select name="idGazCorresponding"
				id="idGazCorresponding">
				<option value="">Non renseigné</option> {foreach
				from=$listGazCorresponding item=item}
				<option {if $item->getIdMandateGazCorresponding() eq
					$idGazCorresponding}selected="selected"
					{/if}value="{$item->getIdMandateGazCorresponding()}">
					{$item->getName()}</option> {/foreach}
			</select>
		</p>
		{/if}
		<p>
			Tout à l'égout : <label for="toutEgoutFalse"><input type="radio"
				{if $toutEgout eq 0} checked="checked" {/if} value="0"
				name="toutEgout" id="toutEgoutFalse" />Non</label><label
				for="toutEgoutTrue"><input type="radio" value="1" {if $toutEgout
				eq 1} checked="checked" {/if} name="toutEgout" id="toutEgoutTrue" />Oui</label>
		</p>
		<p>
			Assainissement par fosse sceptique : <label
				for="assainissementFosseSceptiqueFalse"><input
				id="assainissementFosseSceptiqueFalse" type="radio"
				{if $assainissementFosseSceptique eq 0} checked="checked"
				{/if} value="0" name="assainissementFosseSceptique" />Non</label><label
				for="assainissementFosseSceptiqueTrue"><input type="radio" value="1"
				{if $assainissementFosseSceptique eq 1} checked="checked"
				{/if} name="assainissementFosseSceptique"
				id="assainissementFosseSceptiqueTrue" />Oui</label>
		</p>
		{if !empty($listSanitationCorresponding)}
		<p>
			Correspondant sanitaire : <select name="idSanitationCorresponding"
				id="idSanitationCorresponding">
				<option value="">Non renseigné</option> {foreach
				from=$listSanitationCorresponding item=item}
				<option {if $item->getIdMandateSanitationCorresponding() eq
					$idSanitationCorresponding}selected="selected"
					{/if}value="{$item->getIdMandateSanitationCorresponding()}">
					{$item->getName()}</option> {/foreach}
			</select>
		</p>
		{/if}

		<p>
			Voirie :
			<textarea name="voirie" id="voirie" cols="30" rows="10">{$voirie}</textarea>
		</p>
	</fieldset>
	*}
	<fieldset>
		<legend>Description</legend>
		{if !empty($listOrientation)}
		<p>
			Orientation : <select name="idOrientation" id="idOrientation">
				<option value="">Non renseigné</option> {foreach
				from=$listOrientation item=item}
				<option {if $item->getIdMandateOrientation() eq
					$idOrientation}selected="selected"
					{/if}value="{$item->getIdMandateOrientation()}"> {$item->getName()}</option>
				{/foreach}
			</select>
		</p>
		{/if} {if !empty($listSlope)}
		<p>
			Pente : <select name="idSlope" id="idSlope">
				<option value="">Non renseigné</option> {foreach from=$listSlope
				item=item}
				<option {if $item->getIdMandateSlope() eq
					$idSlope}selected="selected"
					{/if}value="{$item->getIdMandateSlope()}"> {$item->getName()}</option>
				{/foreach}
			</select>
		</p>
		{/if}
		<p>
			Taille de la façade : <input type="text" name="tailleFacade"
				id="tailleFacade" value="{$tailleFacade}" />
		</p>
		<p>
			Profondeur du terrain : <input type="text" name="profondeurTerrain"
				id="profondeurTerrain" value="{$profondeurTerrain}" />
		</p>
		{*
		<p>
			Commentaires :
			<textarea name="commentaire" id="commentaire" cols="30" rows="10">{$commentaire}</textarea>
		</p>
		*}
		<p>
			Geolocalisation (en degrès sexagésimaux) : <br />latitude : <input
				type="text" name="geolocLatitude" id="geoloc"
				value="{$geolocLatitude}" /> Longitude : <input type="text"
				name="geolocLongitude" id="geolocLongitude"
				value="{$geolocLongitude}" />
		</p>
		<p>
			Proximité école : <input type="text" name="proximiteEcole"
				id="proximiteEcole" value="{$proximiteEcole}" />
		</p>
		<p>
			Proximité commerce : <input type="text" name="proximiteCommerce"
				id="proximiteCommerce" value="{$proximiteCommerce}" />
		</p>
		<p>
			Proximité transport : <input type="text" name="proximiteTransport"
				id="proximiteTransport" value="{$proximiteTransport}" />
		</p>
		<p>
			Texte vitrine :
			<textarea name="commentaireApparent" id="commentaireApparent"
				cols="30" rows="10">{$commentaireApparent}</textarea>
		</p>
		<p>
			Pub internet :
			<textarea name="pubinternet" id="pubinternet" cols="30" rows="10">{$pubinternet}</textarea>
		</p>
	</fieldset>


	<p>
		<input type="submit" name="valider" value="{Lang::LABEL_SAVE}" /> <input
			type="submit" name="annuler" value="{Lang::LABEL_CANCEL}" />
	</p>
</form>
</div>
