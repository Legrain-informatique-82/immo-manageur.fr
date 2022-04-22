{include file="tpl_default/entete.tpl"}
<h1>{$title}</h1>
<table class="standard">

	<thead>
		<tr>
			<th>Nom</th> {*
			<th>Utilisateur affecté</th> *} 
			<th>Modifier</th>
			<th>Supprimer</th> 
			
		</tr>
	</thead>

	<tbody>
		{foreach from=$lc item=i}
		<tr>
			<td>{$i->getName()}</td>
			{*<td>{$i.obj->getUser()->getName()}
				{$i.obj->getUser()->getFirstname()}</td>*}
			<td><a
				href="{Tools::create_url($user,'contacts','updC',$i->getIdcategorycontact())}"><img src="{Constant::DEFAULT_URL_PICTURE_DIRECTORY}update.png" alt="{Lang::LABEL_UPDATE}" /></a>
			</td>
			<td><a
				href="{Tools::create_url($user,'contacts','delC',$i->getIdcategorycontact())}"><img src="{Constant::DEFAULT_URL_PICTURE_DIRECTORY}delete.png" alt="{Lang::LABEL_DELETE}" /></a>
			</td> 
		</tr>
		{/foreach}
	</tbody>
</table>
</div>
