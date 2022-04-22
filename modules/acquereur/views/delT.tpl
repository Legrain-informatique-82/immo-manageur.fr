{include file="tpl_default/entete.tpl"} {if $error}
<ul class="error">
	{foreach from=$error item=e}
	<li>{$e}</li> {/foreach}
</ul>
{/if}
<h1>Supprimer le titre : {$name}</h1>
<p>Êtes-vous sûr de vouloir supprimer ce titre ?</p>
<form action="" method="post">
	<p>
		<input type="submit" value="Supprimer" name="valid" /> <input
			type="submit" value="Annuler" name="cancel" />
	</p>
</form>
</div>
