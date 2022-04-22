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
			href="{Tools::create_url($user,$smarty.get.module,'updateCom',$smarty.get.action)}" class="btn btn-default"><i class="fa fa-pencil-square-o"></i>
			{if $elementMandateCom} Modifier le commentaire et/ou l'info visite.
			{else} Ajouter un commentaire et/ou l'info visite {/if} </a>
	</p>

	{/if}
    <div class="row">

        <div class="col-md-4">

            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">Commentaire</h3>
                </div>
                <div class="panel-body">
                    {if $elementMandateCom} {if $elementMandateCom->getCom() !=''}
                        {$elementMandateCom->getCom()} {else}
                        <p>Aucun commentaire actuellement.</p>
                    {/if} {else}
                        <p>Aucun commentaire actuellement.</p>
                    {/if}
                </div>
            </div>
        </div>

        <div class="col-md-4">

            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">Infos visite</h3>
                </div>
                <div class="panel-body">
                    {if $elementMandateCom} {if $elementMandateCom->getInfoVisite() != ''}
                        {$elementMandateCom->getInfoVisite()} {else}
                        <p>Aucune info visite actuellement.</p>
                    {/if} {else}
                        <p>Aucune info visite actuellement.</p>
                    {/if}
                </div>
            </div>
        </div>


        <div class="col-md-4">

            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">Observations</h3>
                </div>
                <div class="panel-body">
                    {if $elementMandateCom} {if $elementMandateCom->getOtherCom() != ''}
                        {$elementMandateCom->getOtherCom()} {else}
                        <p>Aucune observation actuellement.</p>
                    {/if} {else}
                        <p>Aucune observation actuellement.</p>
                    {/if}
                </div>
            </div>
        </div>



    </div>
</div>
