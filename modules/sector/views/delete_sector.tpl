{include file="tpl_default/entete.tpl"}
<h1>{Lang::LABEL_SECTOR_DELETE}</h1>
{if $error}
<p class="error">{$error}</p>
{/if}
<p>{Lang::LABEL_SECTOR_DELETE_INFO}{$sector->getName()} ?</p>
<form action="" method="post">
	<input type="hidden" name="id_sector" value="{$sector->getIdSector()}" />
	<input type="submit" name="send_sector" value="{Lang::LABEL_DELETE}" />
	<input type="submit" name="sector_cancel" value="{Lang::LABEL_CANCEL}" />
</form>
</div>
