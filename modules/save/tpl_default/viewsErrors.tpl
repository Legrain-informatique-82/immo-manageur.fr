{if $error}
<ul class="error">
	{foreach from=$error item=e}
	<li>{$e}</li> {/foreach}
</ul>
{/if}
