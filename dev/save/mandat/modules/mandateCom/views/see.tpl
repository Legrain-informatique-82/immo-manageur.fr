<h3>
	<a href="#">Commentaire / Infos visite</a>
</h3>
<div>
	{* Si parent ou admin, lien pour ajouter/modifier les infos *} {if
	($user->getLevelMember()->getIdLevelMember() < 3 OR $user->getIdUser()
	eq $mandate->getUser()->getIdUser() ) AND
	$mandate->getEtap()->getIdMandateEtap() eq Constant::ID_ETAP_TO_SELL}

	<p>
		<a
			href="{Tools::create_url($user,$smarty.get.module,'updateCom',$smarty.get.action)}">
			{if $elementMandateCom} Modifier le commentaire et/ou l'info visite.
			{else} Ajouter un commentaire et/ou l'info visite {/if} </a>
	</p>

	{/if}
	<h4>Commentaire</h4>
	{if $elementMandateCom} {if $elementMandateCom->getCom() !=''}
	{$elementMandateCom->getCom()} {else}
	<p>Aucun commentaire actuellement.</p>
	{/if} {else}
	<p>Aucun commentaire actuellement.</p>
	{/if}
	<h4>Infos visite</h4>
	{if $elementMandateCom} {if $elementMandateCom->getInfoVisite() != ''}
	{$elementMandateCom->getInfoVisite()} {else}
	<p>Aucune info visite actuellement.</p>
	{/if} {else}
	<p>Aucune info visite actuellement.</p>
	{/if}
	<h4>Observations</h4>
	{if $elementMandateCom} {if $elementMandateCom->getOtherCom() != ''}
	{$elementMandateCom->getOtherCom()} {else}
	<p>Aucune observation actuellement.</p>
	{/if} {else}
	<p>Aucune observation actuellement.</p>
	{/if}
</div>
