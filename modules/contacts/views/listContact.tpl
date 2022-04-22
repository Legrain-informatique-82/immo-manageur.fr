{include file="tpl_default/entete.tpl"}
<h1>{$title}</h1>
<table class="standard">

	<thead>
		<tr>
			<th>Nom</th> {*
			<th>Utilisateur affecté</th> *} {*
			<th>Modifier</th>
			<th>Supprimer</th> *}
			<th>Catégories</th>
			<th>Voir</th>
		</tr>
	</thead>

	<tbody>
		{foreach from=$listContact item=i}
		<tr>
			<td>{$i.name}</td>
			{*<td>{$i.obj->getUser()->getName()}
				{$i.obj->getUser()->getFirstname()}</td>*} {*
			<td><a
				href="{Tools::create_url($user,'contacts','upd',$i.obj->getIdContact())}">Modifier</a>
			</td>
			<td><a
				href="{Tools::create_url($user,'contacts','del',$i.obj->getIdContact())}">Supprimer</a>
			</td> *}
			<td>
			{foreach $i.obj->listCategories() as $item}
				<p class="inlineBlock bulle">{$item->getName()}</p>
			{/foreach}

</td>
			<td><a
				href="{Tools::create_url($user,'contacts','see',$i.obj->getIdContact())}" title="{Lang::LABEL_SEE}"><img src="{Constant::DEFAULT_URL_PICTURE_DIRECTORY}see.png" alt="{Lang::LABEL_SEE}" /></a>
			</td>
		</tr>
		{/foreach}
	</tbody>
</table>
</div>
