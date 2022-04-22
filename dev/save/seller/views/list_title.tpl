{include file="tpl_default/entete.tpl"}
<h1>{Lang::LABEL_SELLER_LIST_TITLE_H1}</h1>

<table class="standard">
	<thead>
		<tr>
			<th>Titre</th>
			<th>{Lang::LABEL_UPDATE}</th>
			<th>{Lang::LABEL_DELETE}</th>
		</tr>
	</thead>
	<tbody>
		{foreach from=$list item=item}
		<tr>
			<td>{$item.libel}</td>
			<td><a href="{$item.urlUpdate}">{Lang::LABEL_UPDATE}</a></td>
			<td><a class="jsdelTitleSeller" rel="{$item.idSellerTitle}"
				href="{$item.urlDelete}">{Lang::LABEL_DELETE}</a></td>
		</tr>
		{/foreach}
	</tbody>
</table>
</div>
