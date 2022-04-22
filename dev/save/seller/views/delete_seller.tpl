{include file="tpl_default/entete.tpl"}
<h1>{Lang::LABEL_SELLER_DELETE_h1}</h1>
{if $error}
<p class="error">{$error}</p>
{/if}
<p>{Lang::LABEL_SELLER_DELETE_INFO}{$seller->getName()} ?</p>
<form action="" method="post">
	<input type="hidden" name="id_seller" value="{$seller->getIdSeller()}" />
	<input type="submit" name="send_seller" value="{Lang::LABEL_DELETE}" />
	<input type="submit" name="cancel_seller" value="{Lang::LABEL_CANCEL}" />
</form>
</div>
