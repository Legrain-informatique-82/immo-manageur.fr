{include file="tpl_default/entete.tpl"} {if $error}
<ul class="contError">
	{foreach from=$error item=e}
	<li class="error">{$e}</li> {/foreach}
</ul>

{/if}
<div id="blocTerrain">
	<form action="" method="post" enctype="multipart/form-data">

		<fieldset>
			<legend>Superficie</legend>

			<p>
				<label for="superficieParcelle1"> Superficie parcelle 1 : </label><input
					type="text" name="superficieParcelle1" id="superficieParcelle1"
					value="{$superficieParcelle1}" />
			</p>
			<p>
				<label for="superficieParcelle2"> Superficie parcelle 2 :</label> <input
					type="text" name="superficieParcelle2" id="superficieParcelle2"
					value="{$superficieParcelle2}" />
			</p>
			<p>
				<label for="superficieParcelle3">Superficie parcelle 3 :</label> <input
					type="text" name="superficieParcelle3" id="superficieParcelle3"
					value="{$superficieParcelle3}" />
			</p>
			<p>
				<label for="superficieAutreParcelle">Superficie autres parcelle :</label>
				<input type="text" name="superficieAutreParcelle"
					id="superficieAutreParcelle" value="{$superficieAutreParcelle}" />
			</p>
			<p>
				<label for="superficieConstructible">Superficie constructible :</label>
				<input type="text" name="superficieConstructible"
					id="superficieConstructible" value="{$superficieConstructible}" />
			</p>
			<p>
				<label for="superficieNonConstructible">Superficie non constructible
					:</label> <input type="text" name="superficieNonConstructible"
					id="superficieNonConstructible"
					value="{$superficieNonConstructible}" />
			</p>
			<p>
				<label for="superficieTotale">Superficie totale : </label><input
					type="text" name="superficieTotale" id="superficieTotale"
					value="{$superficieTotale}" />
			</p>

			{if !empty($listGeometer)}
			<p>
				<label for="idGeometer">géometre :</label> <select name="idGeometer"
					id="idGeometer">
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
				<label for="idBornageTerrain">Bornage : </label><select
					name="idBornageTerrain" id="idBornageTerrain">
					<option value="">Non renseigné</option> {foreach
					from=$listBornageTerrain item=item}
					<option {if $item->getIdMandateBornageTerrain() eq
						$idBornageTerrain}selected="selected"
						{/if}value="{$item->getIdMandateBornageTerrain()}">
						{$item->getName()}</option> {/foreach}
				</select>
			</p>
			{/if}


		</fieldset>
		<fieldset>
			<legend>Réglementation</legend>

			{if !empty($listZonagePlu)}
			<p>
				<label for="idZonagePlu">Zonage PLU </label><select
					name="idZonagePlu" id="idZonagePlu">
					<option value="">Non renseigné</option> {foreach
					from=$listZonagePlu item=item}
					<option {if $item->getIdMandateZonagePlu() eq
						$idZonagePlu}selected="selected"
						{/if}value="{$item->getIdMandateZonagePlu()}"> {$item->getName()}</option>
					{/foreach}
				</select>
			</p>
			{/if} {if !empty($listZonageRnu)}
			<p>
				<label for="idZonageRnu">Zonage RNU</label> <select
					name="idZonageRnu" id="idZonageRnu">
					<option value="">Non renseigné</option> {foreach
					from=$listZonageRnu item=item}
					<option {if $item->getIdMandateZonageRnu() eq
						$idZonageRnu}selected="selected"
						{/if}value="{$item->getIdMandateZonageRnu()}"> {$item->getName()}</option>
					{/foreach}
				</select>
			</p>
			{/if} {if !empty($listCos)}
			<p>
				<label for="idCos">COS : </label><select name="idCos" id="idCos">
					<option value="">Non renseigné</option> {foreach from=$listCos
					item=item}
					<option {if $item->getIdMandateCos() eq $idCos}selected="selected"
						{/if}value="{$item->getIdMandateCos()}"> {$item->getName()}</option>
					{/foreach}
				</select>
			</p>
			{/if}
			<p>
				<label for="shonAccordee"> Shon accordée :</label> <input
					type="text" name="shonAccordee" id="shonAccordee"
					value="{$shonAccordee}" />
			</p>

			<p>
			
			
			<div class="bulle">
				<h2>Zone BDF :</h2>
				<label for="zonebdfFalse">Non</label> <input type="radio"
					{if $zonebdf eq 0}checked="checked" {/if} value="0" name="zonebdf"
					id="zonebdfFalse" />
				</p>
				<p>
					<label for="zonebdfTrue">Oui</label><input type="radio"
						{if $zonebdf eq 1}checked="checked" {/if} value="1" name="zonebdf"
						id="zonebdfTrue" />
				</p>
			</div>
			<div class="bulle">
				<h2>Ligne de crete :</h2>
				<p>
					<label for="ligneCreteFalse">Non</label><input {if $ligneCrete
						eq 0}checked="checked" {/if} type="radio" value="0"
						name="ligneCrete" id="ligneCreteFalse" />
				</p>
				<p>
					<label for="ligneCreteTrue">Oui</label><input type="radio"
						{if $ligneCrete eq 1}checked="checked" {/if} value="1"
						name="ligneCrete" id="ligneCreteTrue" />
				</p>
			</div>
			<div class="bulle">
				<h2>Zone inondable :</h2>
				<p>
					<label for="zoneInondableFalse">Non</label><input type="radio"
						value="0" {if $zoneInondable eq 0} checked="checked"
						{/if}  name="zoneInondable" id="zoneInondableFalse" />
				</p>
				<p>
					<label for="zoneInondableTrue">Oui</label><input type="radio"
						value="1" {if $zoneInondable eq 1} checked="checked"
						{/if} name="zoneInondable" id="zoneInondableTrue" />
				</p>
			</div>
			<p>
				<label for="reglementLotissement">Réglement lotissement :</label>
				<textarea name="reglementLotissement" id="reglementLotissement"
					cols="30" rows="10">{$reglementLotissement}</textarea>
			</p>
			<p>
				<label for="ernt">ERNT :</label>
				<textarea name="ernt" id="ernt" cols="30" rows="10">{$ernt}</textarea>
			</p>
		</fieldset>
		<fieldset>
			<legend>Autorisation</legend>

			<h2>DP :</h2>
			<div class="bulle">
				<h3>DP valide :</h3>
				<p>
					<label for="dPValideFalse">Non</label><input type="radio"
						{if $dPValide eq 0} checked="checked" {/if} value="0"
						name="dPValide" id="dPValideFalse" />
				</p>
				<p>
					<label for="dPValideTrue">Oui</label><input type="radio"
						{if $dPValide eq 1} checked="checked" {/if} value="1"
						name="dPValide" id="dPValideTrue" />

				</p>
			</div>

			<p>
				<label for="dateDeclPrealableDP">Date déclaration préalable :</label>
				<input class="datepicker" type="text" name="dateDeclPrealableDP"
					id="dateDeclPrealableDP" value="{$dateDeclPrealableDP}" />
			</p>
			<p>
				<label for="dateProrogationDP">Prorogation DP jusqu'au :</label> <input
					class="datepicker" type="text" name="dateProrogationDP"
					id="dateProrogationDP" value="{$dateProrogationDP}" />
			</p>

			<h2>CU :</h2>
			<div class="bulle">
				<h3>CU valide :</h3>
				<p>
					<label for="cuValideFalse">Non</label><input type="radio" value="0"
						{if $cuValide eq 0} checked="checked" {/if} name="cuValide"
						id="cuValideFalse" />
				</p>
				<p>
					<label for="cuValideTrue">Oui</label><input type="radio" value="1"
						{if $cuValide eq 1} checked="checked" {/if}name="cuValide"
						id="cuValideTrue" />
				</p>
			</div>
			<p>
				<label for="dateDeclPrealableCU">Date déclaration préalable :</label>
				<input class="datepicker" type="text" name="dateDeclPrealableCU"
					id="dateDeclPrealableCU" value="{$dateDeclPrealableCU}" />
			</p>
			<p>
				<label for="dateProrogationCU">Prorogation CU jusqu'au :</label> <input
					class="datepicker" type="text" name="dateProrogationCU"
					id="dateProrogationCU" value="{$dateProrogationCU}" />
			</p>
			<h2>CU Ops :</h2>
			<div class="bulle">
				<h3>CU Ops valide :</h3>

				<p>
					<label for="cuOpsValideFalse">Non</label><input type="radio"
						{if $cuOpsValide eq 0} checked="checked" {/if} value="0"
						name="cuOpsValide" id="cuOpsValideFalse" />
				</p>
				<p>
					<label for="cuOpsValideTrue">Oui</label><input type="radio"
						{if $cuOpsValide eq 1} checked="checked" {/if} value="1"
						name="cuOpsValide" id="cuOpsValideTrue" />
				</p>
			</div>
			<p>
				<label for="dateDeclPrealableCUOPS">Date déclaration préalable :</label>
				<input class="datepicker" type="text" name="dateDeclPrealableCUOPS"
					id="dateDeclPrealableCUOPS" value="{$dateDeclPrealableCUOPS}" />
			</p>
			<p>
				<label for="dateProrogationCUOPS">Prorogation CU Ops jusqu'au : </label><input
					class="datepicker" type="text" name="dateProrogationCUOPS"
					id="dateProrogationCUOPS" value="{$dateProrogationCUOPS}" />
			</p>
			<h2>Permis d'amenager</h2>
			<div class="bulle">
				<h3>Permis d'amenager valide :</h3>
				<p>
					<label for="permisAmenagerValideFalse">Non</label><input
						type="radio" value="0" {if $permisAmenagerValide
						eq 0} checked="checked" {/if} name="permisAmenagerValide"
						id="permisAmenagerValideFalse" />
				</p>
				<p>
					<label for="permisAmenagerValideTrue">Oui</label><input
						type="radio" value="1" {if $permisAmenagerValide
						eq 1} checked="checked" {/if}  name="permisAmenagerValide"
						id="permisAmenagerValideTrue" />
				</p>
			</div>
			<p>
				<label for="datePermisAmenager">Date de permis d'amenager :</label><input
					class="datepicker" type="text" name="datePermisAmenager"
					id="datePermisAmenager" value="{$datePermisAmenager}" />
			</p>

		</fieldset>
		<fieldset>
			<legend>Viabilisation</legend>
			<div class="bulle">
				<h2>Terrain vendu viabilisé :</h2>
				<p>
					<label for="terrainViabiliseFalse">Non</label><input type="radio"
						{if $terrainViabilise eq 0} checked="checked" {/if} value="0"
						name="terrainViabilise" id="terrainViabiliseFalse" />
				</p>
				<p>
					<label for="terrainViabiliseTrue">Oui</label><input type="radio"
						{if $terrainViabilise eq 1} checked="checked" {/if} value="1"
						name="terrainViabilise" id="terrainViabiliseTrue" />
				</p>
			</div>
			<div class="bulle">
				<h2>Terrain vendu semi viabilisé :</h2>

				<p>
					<label for="terrainSemiViabiliseFalse">Non</label><input
						type="radio" value="0" {if $terrainSemiViabilise
						eq 0} checked="checked" {/if} name="terrainSemiViabilise"
						id="terrainSemiViabiliseFalse" />
				</p>
				<p>
					<label for="terrainSemiViabiliseTrue">Oui</label><input
						type="radio" value="1" name="terrainSemiViabilise"
						{if $terrainSemiViabilise eq 1} checked="checked"
						{/if} id="terrainSemiViabiliseTrue" />
				</p>
			</div>
			<div class="bulle">
				<h2>Terrain vendu non viabilisé :</h2>

				<p>
					<label for="terrainNonViabiliseFalse">Non</label><input
						type="radio" value="0" {if $terrainNonViabilise
						eq 0} checked="checked" {/if} name="terrainNonViabilise"
						id="terrainNonViabiliseFalse" />
				</p>
				<p>
					<label for="terrainNonViabiliseTrue">Oui</label><input type="radio"
						value="1" name="terrainNonViabilise" {if $terrainNonViabilise
						eq 1} checked="checked" {/if} id="terrainNonViabiliseTrue" />
				</p>
			</div>
			<p>
				<label for="passageEau"> Passage eau :</label>
				<textarea name="passageEau" id="passageEau" cols="30" rows="10">{$passageEau}</textarea>
			</p>
			{if !empty($listWaterCorresponding)}
			<p>
				<label for="idWaterCorresponding">Correspondant eau :</label> <select
					name="idWaterCorresponding" id="idWaterCorresponding">
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
				<label for="passageElectricite">Passage éléctricité :</label>
				<textarea name="passageElectricite" id="passageElectricite"
					cols="30" rows="10">{$passageElectricite}</textarea>
			</p>
			{if !empty($listElectricCorresponding)}

			<p>
				<label for="idElectricCorresponding">Correspondant electrique :</label>
				<select name="idElectricCorresponding" id="idElectricCorresponding">
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
				<label for="passageGaz">Passage gaz :</label>
				<textarea name="passageGaz" id="passageGaz" cols="30" rows="10">{$passageGaz}</textarea>
			</p>
			{if !empty($listGazCorresponding)}
			<p>
				<label for="idGazCorresponding">Correspondant gaz : </label><select
					name="idGazCorresponding" id="idGazCorresponding">
					<option value="">Non renseigné</option> {foreach
					from=$listGazCorresponding item=item}
					<option {if $item->getIdMandateGazCorresponding() eq
						$idGazCorresponding}selected="selected"
						{/if}value="{$item->getIdMandateGazCorresponding()}">
						{$item->getName()}</option> {/foreach}
				</select>
			</p>
			{/if}
			<div class="bulle">
				<h2>Tout à l'égout :</h2>

				<p>
					<label for="toutEgoutFalse">Non</label><input type="radio"
						{if $toutEgout eq 0} checked="checked" {/if} value="0"
						name="toutEgout" id="toutEgoutFalse" />
				</p>
				<p>
					<label for="toutEgoutTrue">Oui</label><input type="radio" value="1"
						{if $toutEgout eq 1} checked="checked" {/if} name="toutEgout"
						id="toutEgoutTrue" />
				</p>
			</div>
			<div class="bulle">
				<h2>Assainissement par fosse sceptique :</h2>

				<p>
					<label for="assainissementFosseSceptiqueFalse">Non</label><input
						id="assainissementFosseSceptiqueFalse" type="radio"
						{if $assainissementFosseSceptique eq 0} checked="checked"
						{/if} value="0" name="assainissementFosseSceptique" />
				</p>
				<p>
					<label for="assainissementFosseSceptiqueTrue">Oui</label><input
						type="radio" value="1" {if $assainissementFosseSceptique
						eq 1} checked="checked" {/if} name="assainissementFosseSceptique"
						id="assainissementFosseSceptiqueTrue" />
				</p>
			</div>
			{if !empty($listSanitationCorresponding)}
			<p>
				<label for="idSanitationCorresponding">Correspondant sanitaire :</label>
				<select name="idSanitationCorresponding"
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
				<label for="voirie">Voirie :</label>
				<textarea name="voirie" id="voirie" cols="30" rows="10">{$voirie}</textarea>
			</p>
		</fieldset>
		<fieldset>
			<legend>Description</legend>
			{if !empty($listOrientation)}
			<p>
				<label for="idOrientation">Orientation :</label> <select
					name="idOrientation" id="idOrientation">
					<option value="">Non renseigné</option> {foreach
					from=$listOrientation item=item}
					<option {if $item->getIdMandateOrientation() eq
						$idOrientation}selected="selected"
						{/if}value="{$item->getIdMandateOrientation()}">
						{$item->getName()}</option> {/foreach}
				</select>
			</p>
			{/if} {if !empty($listSlope)}
			<p>
				<label for="idSlope">Pente :</label> <select name="idSlope"
					id="idSlope">
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
				<label for="tailleFacade">Taille de la façade :</label> <input
					type="text" name="tailleFacade" id="tailleFacade"
					value="{$tailleFacade}" />
			</p>
			<p>
				<label for="profondeurTerrain">Profondeur du terrain :</label> <input
					type="text" name="profondeurTerrain" id="profondeurTerrain"
					value="{$profondeurTerrain}" />
			</p>
			{* <p> Commentaires : <textarea name="commentaire" id="commentaire"
			cols="30" rows="10">{$commentaire}</textarea> </p> *}
			<div class="bulle">
				<h2>Geolocalisation (en degrès sexagésimaux) :</h2>
				<p>
					<label for="geoloc">latitude :</label> <input type="text" name="geolocLatitude" id="geoloc"
						value="{$geolocLatitude}" />
				</p>
				<label for="geolocLongitude">Longitude :</label> <input type="text" name="geolocLongitude"
					id="geolocLongitude" value="{$geolocLongitude}" />
				</p>
			</div>
			<p>
				<label for="proximiteEcole">Proximité école :</label> <input type="text" name="proximiteEcole"
					id="proximiteEcole" value="{$proximiteEcole}" />
			</p>
			<p>
				<label for="proximiteCommerce">Proximité commerce : </label><input type="text" name="proximiteCommerce"
					id="proximiteCommerce" value="{$proximiteCommerce}" />
			</p>
			<p>
				<label for="proximiteTransport">Proximité transport :</label> <input type="text" name="proximiteTransport"
					id="proximiteTransport" value="{$proximiteTransport}" />
			</p>
			<p>
				Texte vitrine :
				<textarea name="commentaireApparent" id="commentaireApparent"
					cols="30" rows="10">{$commentaireApparent}</textarea>
			</p>
			<p>
				<label for="pubinternet">Pub internet :</label>
				<textarea name="pubinternet" id="pubinternet" cols="30" rows="10">{$pubinternet}</textarea>
			</p>
			<p>
				<label for="nouveauteSite">Nouveauté ( site Internet) :</label> <input
					type="text" name="nouveauteSite" id="nouveauteSite"
					class="datepicker" value="{$nouveauteSite}" /> 
			</p>
		</fieldset>

		<p>
			<input type="submit" name="valider" value="{Lang::LABEL_SAVE}" /> <input
				type="submit" name="annuler" value="{Lang::LABEL_CANCEL}" />
		</p>

	</form>
</div>
</div>
