{include file='tpl_default/entete.tpl'}
<h1>{$title}</h1>

<table class="standard">
	<thead>
		<tr>
			<th>Libellé</th>
			<th>Modifier</th>
			<th>Supprimer</th>
		</tr>
	</thead>
	<tbody>
		{foreach from=$listLibelAct item=i}
		<tr>
			<td>{$i->getLibel()}</td>
			<td><a
				href="{Tools::create_url($user,$smarty.get.module,'upd_libel',$i->getIdLibelAction())}">Modifier</a>
			</td>
			<td><a
				href="{Tools::create_url($user,$smarty.get.module,'del_libel',$i->getIdLibelAction())}">Supprimer</a>
			</td>

		</tr>
		{/foreach}
	</tbody>
</table>
</div>
