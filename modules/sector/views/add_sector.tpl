{include file="tpl_default/entete.tpl"}
<h1>{LANG::LABEL_SECTOR_ADD}</h1>
{if $error}
	<p class="error contError">{$error}</p>
	{/if}
	
	<div id="blocCity" class="bulle">
<form action="" method="post">
	
	<p>
		<label for="sector_name">{Lang::LABEL_SECTOR_NAME}</label><input type="text"
			value="{$smarty.post.sector_name}" name="sector_name"
			id="sector_name" /> 
	</p>
	<p>
		<input type="submit" name="send_sector"
			value="{Lang::LABEL_SECTOR_ADD_SENT}" />
	</p>
</form>
</div>
</div>