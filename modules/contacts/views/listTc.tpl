{include file="tpl_default/entete.tpl"}
<h1>{$title}</h1>
<div class="bulle">
<table class="tableSJs">
	<thead>
		<tr>
			<th>Libellé</th>
			<th>Position</th>
			<th>Modifier</th>
			<th>Supprimer</th>
		</tr>
	</thead>
	<tbody>
		{foreach from=$listTypeChampsContact name=foreach
		item=typeChampContact}
		<tr>
			<td>{$typeChampContact->getLibel()}</td>
			<td>{*{$typeChampContact->getPosition()}*} {if
				!$smarty.foreach.foreach.first} <a
				href="{Tools::create_url($user,'contacts','updPosTC',$typeChampContact->getIdTypeChampsContact(),array('up'))}"><img
					src="{Constant::DEFAULT_URL_PICTURE_DIRECTORY}sort_asc.png"
					alt="monter" /> </a> {/if} {if !$smarty.foreach.foreach.last} <a
				href="{Tools::create_url($user,'contacts','updPosTC',$typeChampContact->getIdTypeChampsContact(),array('down'))}"><img
					src="{Constant::DEFAULT_URL_PICTURE_DIRECTORY}sort_desc.png"
					alt="descendre" /> </a> {/if}</td>
			<td><a
				href="{Tools::create_url($user,'contacts','updTC',$typeChampContact->getIdTypeChampsContact())}" title="{Lang::LABEL_UPDATE}"><img src="{Constant::DEFAULT_URL_PICTURE_DIRECTORY}update.png" alt="{Lang::LABEL_UPDATE}" /></a>
			</td>
			<td>{if $typeChampContact->getNumberUsed()==0 &&
				$typeChampContact->getIdTypeChampsContact()!=1} <a
				href="{Tools::create_url($user,'contacts','delTC',$typeChampContact->getIdTypeChampsContact())}" title="{Lang::LABEL_DELETE}"><img src="{Constant::DEFAULT_URL_PICTURE_DIRECTORY}delete.png" alt="{Lang::LABEL_DELETE}" /></a>
				{else} - {/if}</td>
		</tr>
		{foreachelse}
		<tr>
			<td colspan=4>Aucun type de champ</td>
		</tr>
		{/foreach}
	</tbody>
</table>
</div>
</div>