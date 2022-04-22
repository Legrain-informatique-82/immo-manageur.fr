{* Inclut les hooks appartenant à position. N'inclut rien le cas échéant
*} {if $hook[$position]} {foreach from=$hook[$position] item=i} {include
file=$i} {/foreach} {/if}
