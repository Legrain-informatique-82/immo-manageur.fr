{include file="tpl_default/entete.tpl"}
<h1>Liste des utilisateurs</h1>
<div class="containtTbl">
	<table class="standard">
		<thead>
			<tr>
				<th>Identifiant</th>
				<th>Nom &amp; prénom</th>
				<th>Agence</th>
				<th>Niveau de membre</th>
				<th>Modifier</th>
				<th>Supprimer</th>
				<th>Voir</th>
			</tr>
		</thead>
		<tbody>
			{foreach from=$listUsers item=u}
			<tr>
				<td>{$u.identifiant}</td>
				<td>{$u.name}</td>
				<td>{$u.agency}</td>
				<td>{$u.levelMember}</td>
				<td>{if $user->getLevelMember()->getIdLevelMember() eq 1 or
					$user->getIdUser() eq $u.idUser}<a href="{$u.urlUpdate}">Modifier</a>{else}_{/if}</td>
				<td>{if $user->getLevelMember()->getIdLevelMember() eq 1 and
					$user->getIdUser() neq $u.idUser}<a class="jsdelUser"
					rel="{$u.idUser}" href="{$u.urlDelete}">Supprimer</a>{else}_{/if}</td>
				<td><a href="{$u.urlSee}">Voir</a></td>
			</tr>
			{/foreach}
		</tbody>
	</table>
</div>
</div>
