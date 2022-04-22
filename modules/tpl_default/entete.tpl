{*
<div id="left">
   {include file='tpl_default/menu.tpl' h1="" menu=$menu idMenu="menu"}
{if $hook['hook_leftList']}  
	<ul>
		{include file="tpl_default/hook.tpl" position="hook_leftList"}
	</ul>
	{/if}
{if $hook['hook_left']}	
	{include file="tpl_default/hook.tpl" position="hook_left"}
{/if}
	</div>
<div id="right">
    {include file="tpl_default/hook.tpl" position="hook_header"}
*}
<div class="container-fluid">