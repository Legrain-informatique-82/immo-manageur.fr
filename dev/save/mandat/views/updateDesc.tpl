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
			<label for="superficieTotale">Surface totale : <input type="text"
				name="superficieTotale" id="superficieTotale" value="{$superficieTotale}" /> </label>
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
	</div>
	<div class="mSep">
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
	</div>
	<hr class="clear invi" />
	<p>
		<input type="submit" name="valid" value="Valider" /><input
			type="submit" name="cancel" value="Annuler" />
	</p>
</form>
</div>
