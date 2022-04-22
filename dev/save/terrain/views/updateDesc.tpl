{include file="tpl_default/entete.tpl"}
<h1>{$title}</h1>

{if $error}
<ul class="error">
	{foreach from=$error item=e}
	<li>{$e}</li> {/foreach}
</ul>
{/if}
<form action="" method="post">
	<div class="mSep">
		<h3>Superficie</h3>
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
		<p>
			Superficie totale : <input type="text" name="superficieTotale"
				id="superficieTotale" value="{$superficieTotale}" />
		</p>

		{if !empty($listGeometer)}
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
		{/if}
		<h3>Description</h3>
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

		<h3>Cadastre</h3>
		<p>
			Ref cadastre parcelle 1 : <input type="text" name="refCadastre1"
				id="refCadastre1" value="{$refCadastre1}" />
		</p>
		<p>
			Ref cadastre parcelle 2 : <input type="text" name="refCadastre2"
				id="refCadastre2" value="{$refCadastre2}" />
		</p>
		<p>
			Ref cadastre parcelle 3 : <input type="text" name="refCadastre3"
				id="refCadastre3" value="{$refCadastre3}" />
		</p>
		<p>
			Autre ref cadastre : <input type="text" name="autreRefCadastre"
				id="autreRefCadastre" value="{$autreRefCadastre}" />
		</p>
		<p>
			Numéro de lot : <input type="text" name="numLot" id="numLot"
				value="{$numLot}" />
		</p>

		<h3>Autorisation</h3>

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


		<h3>Réglementation</h3>
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

	</div>
	<div class="mSep">

		<h3>Viabilisation</h3>
		<!-- Select à faire -->
		{*
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

		*}

		<p>
			<label for="terrainVendu">Terrain vendu : <select name="terrainVendu"
				id="terrainVendu">
					<option value="0" {if $terrainVendu eq 0} selected="selected"{/if}>Non
						renseigné</option>
					<option value="1" {if $terrainVendu eq 1} selected="selected"{/if}>Viabilisé</option>
					<option value="2" {if $terrainVendu eq 2} selected="selected"{/if}>Semi
						viabilisé</option>
					<option value="3" {if $terrainVendu eq 3} selected="selected"{/if}>Non
						viabilisé</option>
			</select> </label>
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
		{/if} {*
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
		*}
		<p>
			<label for="assainissement">Assainissement : </label><select
				name="assainissement" id="assainissement">
				<option value="0" {if $assainissement eq 0} selected="selected"{/if}>Non
					renseigné</option>
				<option value="1" {if $assainissement eq 1} selected="selected"{/if}>Tout
					à l'égout</option>
				<option value="2" {if $assainissement eq 2} selected="selected"{/if}>Fosse
					sceptique</option>
			</select>
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






	</div>
	<hr class="invi clear" />
	<p>
		<input type="submit" name="valid" value="Valider" /><input
			type="submit" name="cancel" value="Annuler" />
	</p>
</form>
</div>
