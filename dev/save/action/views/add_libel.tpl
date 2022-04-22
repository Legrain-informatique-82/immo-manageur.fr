{include file='tpl_default/entete.tpl'}
<h1>{$title}</h1>
{if $error}
<ul>
	{foreach from=$error item=e}
	<li class="error">{$e}</li> {/foreach}
</ul>

{/if}
<form action="" method="post">
	<p>
		<label for="libel">Libelé : <input type="text" name="libel" id="libel"
			value="{$libel}" /> </label>
	</p>
	<p>
		<input type="submit" name="send" value="Valider" />
	</p>
</form>
</div>
