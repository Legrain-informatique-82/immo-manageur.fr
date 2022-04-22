{include file="tpl_default/entete.tpl"}
<h1>{Lang::LABEL_CITY_LIST}</h1>
{foreach name="list" from=$listCity item=item} {if
$smarty.foreach.list.first}
<table class="standard">
	<thead>
		<tr>
			<th>{Lang::LABEL_CITY_ADD_NAME}</th>
			<th>{Lang::LABEL_CITY_ADD_ZIP_CODE}</th>
			<th>{Lang::LABEL_SECTOR_NAME}</th>
			<th>{Lang::LABEL_UPDATE}</th>
			<th>{Lang::LABEL_DELETE}</th>
		</tr>
	</thead>
	<tbody>
		{/if}
		<tr>
			<td>{$item.name}</td>
			<td>{$item.zipCode}</td>
			<td>{$item.sector}</td>
			<td><a href="{$item.urlUpdate}" title="{Lang::LABEL_UPDATE}"><img src="{Constant::DEFAULT_URL_PICTURE_DIRECTORY}update.png" alt="{Lang::LABEL_UPDATE}" /></a></td>
			<td><a class="jsDelCity" rel="{$item.id}" href="{$item.urlDelete}" title="{Lang::LABEL_DELETE}" ><img src="{Constant::DEFAULT_URL_PICTURE_DIRECTORY}delete.png" alt="{Lang::LABEL_DELETE}" /></a>
			</td>
		</tr>
		{if $smarty.foreach.list.last}
	</tbody>
</table>
{/if} {foreachelse}
<p>Aucune ville enregistrée dans la base de données.</p>
{/foreach}
</div>
