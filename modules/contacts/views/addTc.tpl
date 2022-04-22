{include file="tpl_default/entete.tpl"} {* Add TC *}
<h1>{$title}</h1>
{if !empty($error)}
<ul class="contError">
	{foreach from=$error item=item}
	<li class="error">{$item}</li> {/foreach}
</ul>

{/if}
<div class="bulle" id="blocContact">

<form action="" method="post">
	<p>
		<label for="typeContact">Type de contact : </label> <input type="text"
			name="typeContact" id="typeContact" value="{$typeContact}" />
	
	
	<p>
		<input type="submit" value="{$labelBtn}" name="submitAddTc" /> <input
			type="submit" value="Annuler" name="cancelAddTc" />
	</p>
	</p>
</form>



</div>
</div>