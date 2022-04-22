{include file='tpl_default/entete.tpl'}
<h1>{$h1} :</h1>
{if $error}
<ul>
	{foreach from=$error item=e}
	<li class="error">{$e}</li> {/foreach}
</ul>
{/if}
<div id="blocMandateFeadture" class="bulle">
<form action="" method="post">
	<p>
		<input type="hidden" name="idOpt" value="{$idOpt}" /> <input
			type="hidden" name="oldName" value="{$oldName}" /> <input
			type="hidden" name="oldCode" value="{$oldCode}" /> <label for="name">{$labelName}
			:</label> <input type="text" name="name" value="{$name}" id="name" /> 
	</p>
	<p>
		<label for="code">{$labelCode} :</label> <input type="text" name="code"
			value="{$code}" id="code" /> 
	</p>
	<p>
		<label for="isDisabled">Actif ? </label><input type="checkbox"
			{if $isDisabled} checked="checked" {/if} name="isDisabled"
			id="isDisabled" value="1" /> 
	</p>
	<p>
		<input type="submit" name="valider" value="{Lang::LABEL_SAVE}" />
	</p>
</form>
</div>
</div>