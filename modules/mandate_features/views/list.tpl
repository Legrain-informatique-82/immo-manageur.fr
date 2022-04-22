{include file='tpl_default/entete.tpl'}
<h1>{$h1}</h1>
<table class="standard">
	<thead>
		<tr>
			<th>Nom</th>
			<th>Code</th>
			<th>Modifier</th>
			<th>Actif</th>
		</tr>
	</thead>
	<tbody>
		{foreach from=$list item=i}
		<tr>
			<td>{$i->getName()}</td>
			<td>{$i->getCode()}</td>
			<td><a
				href="{Tools::create_url($user,$smarty.get.module,$page,$i->getId() )}" title="{Lang::LABEL_UPDATE}"><img src="{Constant::DEFAULT_URL_PICTURE_DIRECTORY}update.png" alt="{Lang::LABEL_UPDATE}" /></a>
			</td>
			<td>{if $i->getIsDisabled()}Désactivé{else}Activé{/if}</td>
		</tr>
		{/foreach}
	</tbody>
</table>
</div>