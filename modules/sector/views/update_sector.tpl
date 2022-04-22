{include file="tpl_default/entete.tpl"}
<h1>{LANG::LABEL_SECTOR_UPDATE}</h1>
{if $error}	
	<p class="error contError">{$error}</p>
	
	{/if}
	
	<div id="blocCity" class="bulle">
<p>Ancien nom : {$oldSector}</p>
<form action="" method="post">
	
	<p>
		<label for="sector_name">{Lang::LABEL_SECTOR_NAME}</label><input type="text"
			value="{$sector_name}" name="sector_name" id="sector_name" /> 
	</p>
	<p>
		<input type="hidden" name="oldSector" value="{$oldSector}" /> <input
			type="hidden" name="id_sector" value="{$id_sector}" /> <input
			type="submit" name="send_sector"
			value="{Lang::LABEL_SECTOR_UPDATE_SENT}" /> <input type="submit"
			name="sector_cancel" value="{Lang::LABEL_CANCEL}" />
	</p>
</form>
</div>
</div>