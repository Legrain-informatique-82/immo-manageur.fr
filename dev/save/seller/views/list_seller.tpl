{include file="tpl_default/entete.tpl"}
<h1>{Lang::LABEL_SELLER_LIST_H1}</h1>

<form action="" method="post">
	<p>
		<label for="seeAsset">Afficher les inactifs : <input
			{if $smarty.post.seeAsset eq 'on'} checked="checked"
			{/if}type="checkbox" value="on" name="seeAsset" id="seeAsset" /> </label>
		<input type="submit" name="actSeeAsset" value="actualiser"
			class="jsNone" />
	</p>

</form>
<table class="standard">
	<thead>
		<tr>
			<th>Nom &amp; prénom</th>
			<th>Titre</th>
			<th>Opérateur lié</th>
			<th>téléphones</th>
			<th>email</th>
			<th>Modifier</th>
			<th>Supprimer</th>
			<th>Voir</th>
		</tr>
	</thead>
	<tbody>
		{foreach from=$list item=item}
		<tr>
			<td>{$item.name}</td>
			<td>{$item.title}</td>
			<td>{$item.user}</td>
			<td>{if $item.phone.phone}
				<p>{Lang::LABEL_SELLER_ADD_PHONE}{$item.phone.phone}</p>{/if} {if
				$item.phone.mobilPhone}
				<p>{Lang::LABEL_SELLER_ADD_MOBIL_PHONE}{$item.phone.mobilPhone}</p>{/if}
				{if $item.phone.workPhone}
				<p>{Lang::LABEL_SELLER_ADD_WORK_PHONE}{$item.phone.workPhone}</p>{/if}
			</td>
			<td>{$item.email}</td>
			<td>{if $item.idUser eq $user->getIdUser() ||
				$user->getLevelMember()->getIdLevelMember() < 3} <a
				href="{$item.urlUpdate}">{lang::LABEL_UPDATE}</a> {else} _ {/if}</td>
			<td>{if $item.idUser eq $user->getIdUser() ||
				$user->getLevelMember()->getIdLevelMember() < 3} <a
				class="jsdelSeller" rel="{$item.id}" href="{$item.urlDelete}">{lang::LABEL_DELETE}</a>
				{else} _ {/if}</td>
			<td>{if $item.idUser eq $user->getIdUser() ||
				$user->getLevelMember()->getIdLevelMember() < 3} <a
				href="{$item.urlSee}">{lang::LABEL_SEE}</a> {else} _ {/if}</td>
		</tr>
		{/foreach}
	</tbody>
</table>
</div>
