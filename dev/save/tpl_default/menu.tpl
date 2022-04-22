{if $menu} {if $h1}
<h1>{$h1}</h1>
{/if}
<ul {if $idMenu}id="{$idMenu}" {/if} {if $classMenu}class="{$classMenu}"{/if}>
	{foreach from=$menu item=item}
	<li><a
		class="{if $item.url eq Tools::create_url($user,$smarty.get.module,$smarty.get.page,$smarty.get.action)}actif{/if}{if $item.moduleName eq $smarty.get.module} actifM{/if}"
		href="{$item.url}">{$item.libelle}</a></li> {/foreach}
</ul>
<hr class="invi clear" />
{/if}
