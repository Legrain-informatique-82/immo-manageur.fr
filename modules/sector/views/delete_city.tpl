{include file="tpl_default/entete.tpl"}
<h1>{Lang::LABEL_CITY_DELETE}</h1>
{if $error}
<p class="error">{$error}</p>
{/if}
<p>{Lang::LABEL_CITY_DELETE_INFO}{$city->getName()} ?</p>
<form action="" method="post">
	<input type="hidden" name="id_city" value="{$city->getIdCity()}" /> <input
		type="submit" name="send_city" value="{Lang::LABEL_DELETE}" /> <input
		type="submit" name="city_cancel" value="{Lang::LABEL_CANCEL}" />
</form>
</div>
