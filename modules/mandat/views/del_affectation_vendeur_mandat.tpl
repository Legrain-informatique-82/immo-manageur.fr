{include file="tpl_default/entete.tpl"}
<h1>Supression de l'affectation</h1>
{if $error}
<ul>
	{foreach from=$error item=item}
	<li class="error">{$item}</li> {/foreach}
</ul>
{/if}
<p>Êtes-vous sûr de voulour supprimer l'affectation ?</p>
<form action="" method="post">
	{*
	<p>
		<label for="vendeurInactif"><input type="checkbox"
			name="vendeurInactif" id="vendeurInactif" /> Rendre le vendeur
			inactif.</label>
	</p>
	*}
	<p>
		<input type="hidden" name="idMandate" value="{$smarty.post.idMandate}" />
		<input type="hidden" name="idSeller" value="{$smarty.post.idSeller}" />
		<input type="hidden" name="confirm" value="1" /> <input type="submit"
			value="Annuler" id="cancel_delete_affectation_seller"
			name="cancel_delete_affectation_seller" /> <input type="submit"
			value="Confirmer la suppression" id="delete_affectation_seller"
			name="delete_affectation_seller" />
	</p>

</form>
</div>
