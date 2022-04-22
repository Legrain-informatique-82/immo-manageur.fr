{include file="tpl_default/entete.tpl"}
<h1>{LANG::LABEL_SECTOR_LIST}</h1>
{foreach name="list" from=$list item=item} {if
$smarty.foreach.list.first}
<table class="standard">
	<thead>
		<tr>
			<th>{Lang::LABEL_SECTOR_NAME}</th>
			<th>{Lang::LABEL_UPDATE}</th>
			<th>{Lang::LABEL_DELETE}</th>
		</tr>
	</thead>
	<tbody>
		{/if}
		<tr>
			<td>{$item.name}</td>
			<td><a href="{$item.urlUpdate}" title="{Lang::LABEL_UPDATE}"><img src="{Constant::DEFAULT_URL_PICTURE_DIRECTORY}update.png" alt="{Lang::LABEL_UPDATE}" /></a></td>
			<td><a class="jsDelSector" rel="{$item.id}" href="{$item.urlDelete}" title="{Lang::LABEL_DELETE}"><img src="{Constant::DEFAULT_URL_PICTURE_DIRECTORY}delete.png" alt="{Lang::LABEL_DELETE}" /></a>
			</td>
		</tr>
		{if $smarty.foreach.list.last}
	</tbody>
</table>
{/if} {/foreach}

</div>
