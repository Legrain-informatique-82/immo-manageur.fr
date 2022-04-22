{include file="tpl_default/entete.tpl"}
<h1>{Lang::LABEL_CITY_UPDATE}</h1>

{if $error} {foreach name="error" from=$error item=item} {if
	$smarty.foreach.error.first}
	<ul class="contError">
		{/if}
		<li class="error">{$item}</li> {if $smarty.foreach.error.last}
	</ul>
	{/if} {/foreach} {/if}
	
<div class="bulle" id="blocCity">
<p>Ancien nom : {$oldCity}</p>
<form action="" method="post">
	
	<p>
		<label for="city_name">{Lang::LABEL_SECTOR_NAME}</label><input type="text"
			value="{$city_name}" name="city_name" id="city_name" /> 
	</p>
	<p>
		<label for="zipCode">{Lang::LABEL_CITY_ADD_ZIP_CODE}</label><input type="text"
			value="{$zipCode}" name="zipCode" id="zipCode" /> 
	</p>
	<p>
		<label for="idSector">{Lang::LABEL_CITY_ADD_SECTOR} </label><select
			name="idSector" id="idSector"> {foreach from=$listOfSector
				item=sector}
				<option {if $sector->getIdSector() eq
					$idSector}selected="selected"{/if}
					value="{$sector->getIdSector()}">{$sector->getName()}</option>
				{/foreach}
		</select>
	</p>
	<p>
		<input type="hidden" name="oldSector" value="{$oldSector}" /> <input
			type="hidden" name="oldCity" value="{$oldCity}" /> <input
			type="hidden" name="id_city" value="{$id_city}" /> <input
			type="submit" name="send_city" value="{Lang::LABEL_UPDATE}" /> <input
			type="submit" name="city_cancel" value="{Lang::LABEL_CANCEL}" />
	</p>
</form>
</div>
</div>