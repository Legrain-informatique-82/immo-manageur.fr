{if $error}
    {foreach from=$error item=item name=e}
        {if $smarty.foreach.e.first}
            <div class="alert alert-danger" role="alert">
            <ul>
        {/if}
        <li class="error">{$item}</li>
        {if $smarty.foreach.e.last}
            </ul>
        {/if}
    {/foreach}
</div>
{/if}