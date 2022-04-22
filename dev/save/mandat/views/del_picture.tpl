{include file="tpl_default/entete.tpl"}

<h1>Supression de l'image</h1>
{if $error}
<ul>
	{foreach from=$error item=item}
	<li class="error">{$item}</li> {/foreach}
</ul>
{/if}
<p>Êtes-vous sûr de voulour supprimer l'image ?</p>
<form action="" method="post">
	<p>
		<input type="hidden" name="idMandate" value="{$smarty.post.idMandate}" />
		<input type="hidden" name="idPicture" value="{$smarty.post.idPicture}" />
		<input type="hidden" name="confirm" value="1" /> <input type="submit"
			value="Annuler" id="cancel_delete_picture"
			name="cancel_delete_picture" /> <input type="submit"
			value="Confirmer la suppression" id="delete_picture"
			name="delete_picture" />
	</p>

</form>
</div>
