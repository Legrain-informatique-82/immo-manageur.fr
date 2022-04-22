{include file="tpl_default/entete.tpl"}
<h1>Pubs</h1>
{if $error}
<ul class="error">
	{foreach from=$error item=e}
	<li>{$e}</li> {/foreach}
</ul>
{/if}
<form action="" method="post">
	<h2>Vitrine</h2>
	<p>
		<label for="vitrine">Texte vitrine : </label>
		<textarea name="vitrine" id="vitrine" cols="30" rows="10">{$vitrine}</textarea>
	</p>
	<h2>Pub</h2>
	<p>
		<label for="pub">Publicité Internet : </label>
		<textarea name="pub" id="pub" cols="30" rows="10">{$pub}</textarea>
	</p>
	<h2>Coup de coeur</h2>
	<p>
		<label for="coupCoeur">Coup de coeur : </label><input {if $coupCoeur
			eq "on"}checked="checked" {/if} type="checkbox" name="coupCoeur"
			value="on" id="coupCoeur" />
	</p>
	<h2>Affiché en vitrine</h2>
	<p>
		<label for="afficheEnVitrine">Affiché en vitrine : </label><input
			{if $afficheEnVitrine eq "on"}checked="checked" {/if} type="checkbox"
			name="afficheEnVitrine" value="on" id="afficheEnVitrine" />
	</p>
	{include file="tpl_default/hook.tpl"
	position="hook_updatePhotosExport"}
	<p>
		<input type="submit" name="valid" value="Valider" /><input
			type="submit" name="cancel" value="Annuler" />
	</p>
</form>
</div>
