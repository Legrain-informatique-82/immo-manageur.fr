{include file="tpl_default/entete.tpl"} {if $error}
<ul>
	{foreach from=$error item=e}
	<li class="error">{$e}</li> {/foreach}
</ul>
{/if}
<form action="" method="post">
	<p>
		Reaffecter le mandant : {$mandate->getNumberMandate()}<input
			type="hidden" name="id" value="{$mandate->getIdMandate()}" />
	</p>
	<p>
		<label for="initDate">Date de début : <input type="text"
			name="initDate" id="initDate" value="{$initDate}" class="datepicker" />
		</label>
	</p>
	<p>
		<label for="deadDate">Date de fin : <input type="text" name="deadDate"
			id="deadDate" value="{$deadDate}" class="datepicker" /> </label>
	</p>
	<p>
		<label for="freeDate">Libre le <input type="text" name="freeDate"
			id="freeDate" value="{$freeDate}" class="datepicker" /> </label>
	</p>
	<p>
		<input type="submit" name="valid" value="Valider" /><input
			type="submit" name="cancel" value="Annuler" />
	</p>
</form>
</div>
