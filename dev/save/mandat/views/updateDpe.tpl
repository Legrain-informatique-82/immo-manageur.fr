{include file="tpl_default/entete.tpl"}
<h1>Dpe</h1>

{if $error}
<ul class="error">
	{foreach from=$error item=e}
	<li>{$e}</li> {/foreach}
</ul>
{/if}
<form action="" method="post">
	<p>
		<label for="dpeConsoEner">Consommation energétique : </label><input
			type="text" value="{$dpeConsoEner}" name="dpeConsoEner"
			id="dpeConsoEner" />
	</p>
	<p>
		<label for="dpeEmissionGaz">Emission de gaz : </label><input
			type="text" value="{$dpeEmissionGaz}" name="dpeEmissionGaz"
			id="dpeEmissionGaz" />
	</p>
	<p>
		<input type="submit" name="valid" value="Valider" /><input
			type="submit" name="cancel" value="Annuler" />
	</p>
</form>
</div>
