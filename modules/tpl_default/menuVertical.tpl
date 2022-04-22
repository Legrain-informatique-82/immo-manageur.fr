{*
{if $menu} 
<ul id="menuVertical" class="{if $classMenu}{$classMenu} {/if}{if $smarty.session.etatMenuVertical neq 'repli'}depli{else}repli{/if}" rel="{$smarty.get.module}">
	{foreach name="monMenu" from=$menu item=item}
	<li><a
		class="{if $item.url eq Tools::create_url($user,$smarty.get.module,$smarty.get.page,$smarty.get.action)}actif{/if}{if $item.moduleName eq $smarty.get.module} actifM{/if} {if $smarty.foreach.monMenu.first} first{/if}"
		href="{$item.url}" title="{$item.libelle}">
		{if $item.logo}<img src="{$item.logo}" alt="{$item.libelle}" />{else}IMAGE PAR DEFAUT{/if}
{if $smarty.session.etatMenuVertical neq 'repli'}
<span class="libel">{$item.libelle}</span>
{/if}
</a></li> {/foreach}
<li id="btnMenuVertical">


<form action="" method="post">

<input type="submit" name="toogleMenuVertical" value="{if $smarty.session.etatMenuVertical neq 'repli'}<<{else}>>{/if}" />

</form>
</li>
</ul>

{/if}
*}

{if $menu} 
<ul id="menuVertical" class="{if $classMenu}{$classMenu} {/if}{if $smarty.session.etatMenuVertical neq 'repli'}depli{else}repli{/if}">
	{foreach name="monMenu" from=$menu item=item}
	<li><a id="menuPrincipal_lien_{$smarty.foreach.monMenu.iteration}"
		class="{if $item.url eq Tools::create_url($user,$smarty.get.module,$smarty.get.page,$smarty.get.action)}actif{/if}{if $item.moduleName eq $smarty.get.module} actifM{/if} {if $smarty.foreach.monMenu.first} first{/if}{if $smarty.foreach.monMenu.last} last{/if}"
		href="{$item.url}" title="{$item.libelle}">
		{if $item.logo}<img src="{$item.logo}" alt="{$item.libelle}" />{else}<img src="{Constant::DEFAULT_URL_LOGO_MODULES}" alt="{$item.libelle}" />{/if}

{*<span class="libel">{$item.libelle}</span>*}

</a></li> {/foreach}
{*
<li id="btnMenuVertical">


<form action="" method="post">

<input type="submit" name="toogleMenuVertical" value="{if $smarty.session.etatMenuVertical neq 'repli'}<<{else}>>{/if}" />

</form>

</li>
*}
</ul>

{/if}