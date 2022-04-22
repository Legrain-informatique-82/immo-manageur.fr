{include file="tpl_default/entete.tpl"}
<h1>Suppression de l'acquereur</h1>
{if $error}
<p class="error">{$error}</p>
{/if}
<p>Êtes-vous sûr de vouloir supprimer l'acquereur : {$acq->getName()} ?</p>
<form action="" method="post">
	<input type="hidden" name="id_seller" value="{$acq->getIdAcquereur()}" />
	<input type="submit" name="send" value="{Lang::LABEL_DELETE}" /> <input
		type="submit" name="cancel" value="{Lang::LABEL_CANCEL}" />
</form>
</div>
