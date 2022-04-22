{include file='tpl_default/entete.tpl'}
<h1>Tableau DPE</h1>
{foreach name="a" from=$list item=item} {if $smarty.foreach.a.first}
<table class="standard">
	<thead>
		<tr>
			<th>Nom</th>
			<th>De</th>
			<th>À</th>
			<th>Modifier</th>
			<th>Supprimer</th>
		</tr>
	</thead>
	<tbody>
		{/if}
		<tr>
			<td>{$item->getName()}</td>
			<td>{$item->getFromValue()}</td>
			<td>{$item->getToValue()}</td>
			<td>{$item->getIdDpe()}</td>
			<td>{$item->getIdDpe()}</td>
		</tr>
		{if $smarty.foreach.a.last}
	</tbody>
</table>
{/if} {/foreach}

<img src="{$img}" alt="" />
</div>
