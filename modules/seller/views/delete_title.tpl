{include file="tpl_default/entete.tpl"}
<h1>{Lang::LABEL_SELLER_TITLE_DELETE_h1}</h1>
{if $error}
<p class="error">{$error}</p>
{/if}
<p>{Lang::LABEL_SELLER_DELETE_TITLE_INFO}{$sellerTitle->getLibel()} ?</p>
<form action="" method="post">
	<input type="hidden" name="id_seller_title"
		value="{$sellerTitle->getIdSellerTitle()}" /> <input type="submit"
		name="send_seller_title" value="{Lang::LABEL_DELETE}" /> <input
		type="submit" name="cancel_seller_title" value="{Lang::LABEL_CANCEL}" />
</form>
</div>
