{include file="tpl_default/entete.tpl"}
<h1>{Lang::LABEL_CITY_ADD}</h1>
{if $error} {foreach name="error" from=$error item=item} {if
$smarty.foreach.error.first}
<ul class="contError">
	{/if}
	<li class="error">{$item}</li> {if $smarty.foreach.error.last}
</ul>
{/if} {/foreach} {/if}
<div class="bulle" id="blocCity">
<form action="" method="post">
	<p>
		<label for="city_add_name">{Lang::LABEL_CITY_ADD_NAME} </label><input
			type="text" value="{$smarty.post.city_add_name}" name="city_add_name"
			id="city_add_name" />
	</p>
	<p>
		<label for="zipCode">{Lang::LABEL_CITY_ADD_ZIP_CODE}</label><input type="text"
			value="{$smarty.post.zipCode}" name="zipCode" id="zipCode" /> 
	</p>
	<p>
		<label for="idSector">{Lang::LABEL_CITY_ADD_SECTOR}</label><select
			name="idSector" id="idSector"> {foreach from=$listOfSector
				item=sector}
				<option {if $sector->getIdSector() eq
					$smarty.post.idSector}selected="selected"{/if}
					value="{$sector->getIdSector()}">{$sector->getName()}</option>
				{/foreach}
		</select> 
	</p>
	<p>
		<input type="submit" value="{Lang::LABEL_SAVE}"
			name="sector_add_city_send" id="sector_add_city_send" /> <input
			type="submit" value="{Lang::LABEL_CANCEL}"
			name="sector_add_city_cancel" id="sector_add_city_cancel" />
	</p>


</form>
</div>
</div>