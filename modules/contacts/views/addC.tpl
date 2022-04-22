{include file="tpl_default/entete.tpl"}
<h1>{$title}</h1>
{if $error}
	<ul class="contError">
		{foreach from=$error item=e}
		<li class="error">{$e}</li> {/foreach}
	</ul>
	{/if} 
<div class="bulle" id="blocContact">
<form action="" method="post">

<p><label for="name">Nom de la catégorie  </label><input type="text" name="name" id="name" value="{$name}"/></p>
<p><input type="submit" value="Valider" name="go" /><input type="submit" value="Annuler" name="cancel" /></p>

</form>
</div>
</div>
