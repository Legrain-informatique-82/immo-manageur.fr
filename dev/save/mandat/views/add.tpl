{include file="tpl_default/entete.tpl"}
<h1>Ajouter un mandat</h1>
<form action="" method="post" {* enctype="multipart/form-data"*}>
	{if !empty($error)}
	<ul>
		{foreach from=$error item=item}
		<li class="error">{$item}</li> {/foreach}
	</ul>

	{/if} {* N'apparait que si l'utilisateur a un grade supérieur à
	opérateur *} {if !empty($listUser)}
	<fieldset>
		<legend>Utilisateur</legend>
		<p>
			Utilisateur affecté au mandat : <select name="idUser" id="idUser">
				{foreach from=$listUser item=item}
				<option {if $item->getIdUser() eq $idUser}selected="selected"
					{/if}value="{$item->getIdUser()}">{$item->getFirstname()}
					{$item->getName()}</option> {/foreach}
			</select>
		</p>
	</fieldset>
	{/if} {* Apparait à tout le monde*}
	<fieldset>
		<legend>Général</legend>
		<p>
			<label for="typeTransaction">Type de transaction : <select
				name="typeTransaction" id="typeTransaction"> {foreach
					from=$listTypeTransaction item=tt}
					<option {if $tt->getIdTransactionType() eq $typeTransaction}
						selected="selected" {/if}
						value="{$tt->getIdTransactionType()}">{$tt->getName()}</option>
					{/foreach}
			</select> </label>
		</p>

		<p>
			<label for="typeBien">Type de bien : <select name="typeBien"
				id="typeBien"> {foreach from=$listTypeBien item=tb} {if
					$tb->getIdMandateType() neq Constant::ID_PLOT_OF_LAND}
					<option {if $tb->getIdMandateType() eq $typeBien}
						selected="selected" {/if}
						value="{$tb->getIdMandateType()}">{$tb->getName()}</option> {/if}
					{/foreach}
			</select> </label>
		</p>

		<p>
			<label for="nature">Nature du bien : <select name="nature"
				id="nature"> {foreach from=$listNature item=tb}

					<option {if $tb->getIdMandateNature() eq $nature}
						selected="selected" {/if}
						value="{$tb->getIdMandateNature()}">{$tb->getName()}</option>

					{/foreach}
			</select> </label>
		</p>

	</fieldset>
	{if $smarty.post.idSeller && $smarty.post.used} <input type="hidden"
		name="idSeller" value="{$smarty.post.idSeller}" /> <input
		type="hidden" name="used" value="{$smarty.post.used}" /> {else}
	<fieldset>
		<legend>Vendeur principal</legend>
		{include file='seller/views/frm_add_seller.tpl'}
	</fieldset>
	{/if}


	<fieldset>
		<legend>Infos mandat</legend>
		{if !empty($listNotary)}
		<p>
			Notaire vendeur : <select name="idNotary" id="idNotary"> {foreach
				from=$listNotary item=item}
				<option {if $item->getIdNotary() eq $idNotary}selected="selected"
					{/if}value="{$item->getIdNotary()}"> {$item->getName()}</option>
				{/foreach}
			</select>
		</p>
		{/if}
				{if !empty($listNotary)}
		<p>
			Notaire acquereur : <select name="idNotaryAcq" id="idNotaryAcq"> 
			<option value="">NC</option>
			{foreach from=$listNotary item=item}
				<option {if $item->getIdNotary() eq $idNotaryAcq}selected="selected"
					{/if}value="{$item->getIdNotary()}"> {$item->getName()}</option>
				{/foreach}
			</select>
		</p>
		{/if}
		<p>
			N° Mandat : <input type="text" name="numMandat" id="numMandat"
				value="{$numMandat}" />
		</p>
		<p>
			Début : <input class="datepicker" type="text" name="debutMandat"
				id="debutMandat" value="{$debutMandat}" />
		</p>
		<p>
			Fin : <input class="datepicker" type="text" name="finMandat"
				id="finMandat" value="{$finMandat}" />
		</p>
		<p>
			libre le : <input class="datepicker" type="text" name="libreMandat"
				id="libreMandat" value="{$libreMandat}" />
		</p>

	</fieldset>

	<fieldset>
		<legend>Biens</legend>
		<fieldset>
			<legend>Localisation</legend>
			<p>
				Adresse : <input type="text" name="adresseMandat" id="adresseMandat"
					value="{$adresseMandat}" />
			</p>
			{if !empty($listCity)}
			<p>
				<select name="idCity" id="idCity"> {foreach from=$listCity
					item=item}
					<option {if $item->getIdCity() eq $idCity}selected="selected"
						{/if}value="{$item->getIdCity()}"> {$item->getZipCode()} -
						{$item->getName()}</option> {/foreach}
				</select>
			</p>
			{/if}
		</fieldset>
		<fieldset class="cinquante">
			<legend>Prix</legend>

			<p>
				<span id="jsPrixFai">Prix FAI</span> : <input type="text"
					name="prixFai" id="prixFai" value="{$prixFai}" />
			</p>
			<p>
				<span id="jsPrixNetVendeur">Prix net vendeur</span> : <input
					type="text" name="prixNetVendeur" id="prixNetVendeur"
					value="{$prixNetVendeur}" />
			</p>
			<p id="jsCommission">
				Commission : <input type="text" name="commissionMandat"
					id="commissionMandat" value="{$commissionMandat}" />
			</p>
			<p id="jsEstim">
				Estimation FAI Mini: <input type="text" name="estimationFai"
					id="estimationFai" value="{$estimationFai}" />
			</p>
			<p id="jsEstimMaxi">
				Estimation FAI Maxi: <input type="text" name="estimationMaxi"
					id="estimationMaxi" value="{$estimationMaxi}" />
			</p>
			<p id="jsMargeNegoce">
				Marge negoce : <input type="text" name="margeNegoce"
					id="margeNegoce" value="{$margeNegoce}" />
			</p>
		</fieldset>

		<fieldset class="cinquante">
			<legend>Cadastre</legend>
			<p>
				Ref cadastre parcelle 1 : <input type="text" name="refCadastre1"
					id="refCadastre1" value="{$refCadastre1}" />
			</p>

		</fieldset>

		<p class="clear">

			<input type="submit"
				value="{Lang::LABEL_ADD_TERRAIN_AND_REDIRECT_SAVE}"
				name="terrain_add_submit" /> <input type="submit"
				value="{Lang::LABEL_ADD_TERRAIN_CONTINUE_SAVE}"
				name="terrain_add_submit_and_continue" />
		</p>
	</fieldset>

</form>
</div>
