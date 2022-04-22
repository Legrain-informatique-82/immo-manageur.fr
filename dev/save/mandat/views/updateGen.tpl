{include file="tpl_default/entete.tpl"}
<h1>Modification générales :</h1>
{if $error}
<ul class="error">
	{foreach from=$error item=e}
	<li>{$e}</li> {/foreach}
</ul>
{/if}
<form action="" method="post">
	<div class="mSep">
		<h2>Localisation</h2>
		<p>
			<label for="address">Addresse : </label><input type="text"
				name="address" id="address" value="{$address}" />
		</p>
		<p>
			<label for="city">Ville : </label><select name="city" id="city">
				{foreach from=$listcity item=ci}
				<option {if $ci->getIdCity() eq $city} selected="selected"
					{/if}value="{$ci->getIdCity()}"> {$ci->getZipCode()}
					{$ci->getName()}</option> {/foreach}
			</select>
		</p>
	</div>
	<div class="mSep">
		<h2>Général</h2>
		<p>
			<label for="nature">Nature du bien : </label><select name="nature"
				id="nature"> {foreach from=$listNature item=it}
				<option {if $it->getIdMandateNature() eq $nature}
					selected="selected" {/if}value="{$it->getIdMandateNature()}">
					{$it->getName()}</option> {/foreach}
			</select>
		</p>
		{if $user->getLevelMember()->getIdLevelMember() <3}
		<p>
			<label for="userSe">Utilisateur affecté : </label><select
				name="userSe" id="userSe"> {foreach from=$listUser item=i}
				<option {if $i->getIdUser() eq $userSe} selected="selected"
					{/if}value="{$i->getIdUser()}">{$i->getFirstName()} {$i->getName()}</option>
				{/foreach}
			</select>
		</p>
		{/if}
		{if !empty($listNotary)}
		<p>
			<label for="notary">Notaire vendeur : </label><select name="notary"
				id="notary"> {foreach from=$listNotary item=i}
				<option {if $i->getIdNotary() eq $notary} selected="selected"
					{/if}value="{$i->getIdNotary()}"> {$i->getName()}</option>
				{/foreach}
			</select>
		</p>
			
		<p>
			Notaire acquereur : <select name="notaryAcq" id="notaryAcq"> 
			<option value="">NC</option>
			{foreach from=$listNotary item=item}
				<option {if $item->getIdNotary() eq $notaryAcq}selected="selected"
					{/if}value="{$item->getIdNotary()}"> {$item->getName()}</option>
				{/foreach}
			</select>
		</p>
		{/if}
		<p>
			<label for="typeTransaction">Type de transaction : </label><select
				name="transactionType" id="typeTransaction"> {foreach
				from=$listTransactionType item=i}
				<option {if $i->getIdTransactionType() eq $transactionType}
					selected="selected" {/if}value="{$i->getIdTransactionType()}">
					{$i->getName()}</option> {/foreach}
			</select>
		</p>
		<p>
			<label for="typeBien">Type de bien : </label><select name="typeBien"
				id="typeBien"> {foreach from=$listMandateType item=i}
				<option {if $i->getIdMandateType() eq $typeBien} selected="selected"
					{/if}value="{$i->getIdMandateType()}"> {$i->getName()}</option>
				{/foreach}
			</select>
		</p>

	</div>
	<hr class="invi clear" />
	<div class="mSep">
		<h2>Mandat</h2>
		<p>
			<label for="numMandat">Numéro de mandat : </label><input type="text"
				name="numMandat" id="numMandat" value="{$numMandat}" />
		</p>
		<p>
			<label for="debutMandat">Début : </label> <input type="text"
				class="datepicker" name="debutMandat" id="debutMandat"
				value="{$debutMandat}" />
		</p>
		<p>
			<label for="finMandat">Fin : </label> <input type="text"
				class="datepicker" name="finMandat" id="finMandat"
				value="{$finMandat}" />
		</p>
		<p>
			<label for="libreMandat">libre le : </label> <input type="text"
				class="datepicker" name="libreMandat" id="libreMandat"
				value="{$libreMandat}" />
		</p>
	</div>
	<div class="mSep">
		<h2>Prix</h2>
		<p>
			<label for="prixFai">Prix FAI : </label><input type="text"
				name="prixFAI" id="prixFai" value="{$prixFAI}" />
		</p>
		<p>
			<label for="prixNetVendeur">Prix net vendeur : </label><input
				type="text" name="prixNetVendeur" id="prixNetVendeur"
				value="{$prixNetVendeur}" />
		</p>
		<p id="jsCommission">
			<label for="commissionMandat">Commission : </label><input type="text"
				name="commission" id="commissionMandat" value="{$commission}" />
		</p>
		<p id="jsEstim">
			<label for="estimationMini">Estimation Mini : </label><input
				type="text" name="estimationMini" id="estimationMini"
				value="{$estimationMini}" />
		</p>
		<p id="jsEstimMaxi">
			<label for="estimationMaxi">Estimation Maxi : </label><input
				type="text" name="estimationMaxi" id="estimationMaxi"
				value="{$estimationMaxi}" />
		</p>
		<p id="jsMargeNegoce">
			<label for="margeNegoce">Marge negoce : </label><input type="text"
				name="margeNegoce" id="margeNegoce" value="{$margeNegoce}" />
		</p>
	</div>
	<hr class="invi clear" />
	<div>
		<h2>Géolocalosation</h2>
		<p>En degrès sexagésimaux :</p>
		<p>
			<label for="latitude">Latitude : </label><input type="text"
				id="latitude" name="latitude" value="{$latitude}" />
		</p>
		<p>
			<label for="longitude"> Longitude : </label> <input type="text"
				id="longitude" name="longitude" value="{$longitude}" />
		</p>
	</div>

	<p>
		<input type="submit" name="valid" value="Valider" /><input
			type="submit" name="cancel" value="Annuler" />
	</p>
</form>
</div>
