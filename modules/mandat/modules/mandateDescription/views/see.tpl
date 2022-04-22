<h3>
	<a href="#">Description</a>
</h3>
<div>
	{* Si parent ou admin, lien pour ajouter/modifier les infos *} {if
	($user->getLevelMember()->getIdLevelMember() < 3 OR $user->getIdUser()
	eq $mandate->getUser()->getIdUser() ) AND
	$mandate->getEtap()->getIdMandateEtap() eq Constant::ID_ETAP_TO_SELL}
	<p>
		<a
			href="{Tools::create_url($user,$smarty.get.module,'updateDescription',$smarty.get.action)}" class="btn btn-default"><i class="fa fa-pencil-square-o"></i>Modifier
			les descriptions</a>
	</p>
	{/if} {* tableau ac tt les champs *}
	<table id="tableSeeMandateDescription" class="table table-striped table-bordered">
		<thead>
			<tr>
				<th>Niveau</th>
				<th>Pièce</th>
				<th>Surface</th>
				<th>Sol/Mur/équipement</th>
			</tr>
		</thead>
		<tbody>
			{foreach from=$listOfDescription item=i}
			<tr>
				<td>{$i->getNiveau()}</td>
				<td>{$i->getPiece()}</td>
				<td>{if preg_match('/.00/i',$i->getSurface() )}
					{round($i->getSurface(),0)} {else} {$i->getSurface()} {/if} m²</td>
				<td>{$i->getCarac()}</td>
			</tr>
			{foreachelse}
			<tr>
				<td colspan=4>Aucune description pour ce mandat</td>
			</tr>
			{/foreach}
		</tbody>
	</table>
</div>
