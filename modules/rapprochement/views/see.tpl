{include file="tpl_default/entete.tpl"}
{assign var=acq value=$rapprochement->getAcquereur()}
{assign var=mandate value=$rapprochement->getMandate()}


<div class="row bg-success bannerTitle">
    <div class="col-md-8">
        <h1 class="h2"> Fiche de rapprochement entre {$acq->getFirstName()}
            {$acq->getName()} et le mandat numéro :
            {$rapprochement->getMandate()->getNumberMandate()}</h1>
    </div>
    <div class="col-md-4">
        <p class="h4 text-right ">

            {if $user->getLevelMember()->getIdLevelMember()<3 || $user->getIdUser() eq $rapprochement->getUser()->getIdUser()}

                <a href="{$linkToUpdate}"  title="Modifier" class="btn btn-warning"> <i class="fa fa-pencil-square-o fa-2x"></i></a>

                <a href="{$linkToDelete}" title="Supprimer" class="btn btn-danger"> <i class="fa fa-trash fa-2x"></i></a>

            {/if}

            <a title="{$labelRedirect}" class="btn btn-default" href="{$redirect}">
                <i class="fa fa-close fa-2x"></i>
            </a>
        </p>
    </div>
</div>





<div class="row">
    <div class="col-md-3">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">Général</h3>
            </div>
            <div class="panel-body">
                <p>Utilisateur associé : {$rapprochement->getUser()->getFirstname()}
                    {$rapprochement->getUser()->getName()}</p>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="panel panel-default">

            <div class="panel-heading">
                <div class="row">
                    <h3 class="panel-title col-md-6">
                        Acquereur
                    </h3>
                    <div class="col-md-6 text-right">
                        <a class="btn btn-default btn-xs" href="{Tools::create_url($user,'acquereur','see',$acq->getIdAcquereur())}" {if $user->getOpenInNewTab()} target="_blank"{/if}>
                            <i class="fa fa-chevron-circle-right"></i> Voir la fiche acquereur</a>
                    </div>
                </div>
            </div>
            <div class="panel-body">

                <p>Nom : {$acq->getName()}</p>
                <p>Prénom : {$acq->getFirstname()}</p>
                <p>
                    Adresse : {$acq->getAddress()} <br />
                    {$acq->getVilleAcquereur()->getZipCode()}
                    {$acq->getVilleAcquereur()->getName()}
                </p>

                <p>Téléphones :</p>
                <ul>
                    <li>Principal : {$acq->getPhone()}</li>
                    <li>Mobile : {if $acq->getMobilPhone()}{$acq->getMobilPhone()} <a href="{Constant::DEFAULT_URL}/modules/openmail/formFancybox/sendSms.php?{time()}&amp;dest={str_replace('+','%2B',$acq->getMobilPhone())}" class="fancyboxAjax fancybox.ajax btn btn-default" title="Envoyer un SMS"> <i class="fa fa-2x fa-mobile-phone"></i> </a>{/if}</li>
                    <li>Du travail : {$acq->getWorkPhone()}</li>
                    <li>Fax : {$acq->getFax()}</li>
                </ul>
                <p>Email : {if $acq->getEmail()}{$acq->getEmail()} <a href="{Constant::DEFAULT_URL}/modules/openmail/formFancybox/sendEmail.php?{time()}&amp;dest={$acq->getEmail()}" class="fancyboxAjax fancybox.ajax btn btn-default" title="Envoyer un E-mail">
                            <i class="fa fa-paper-plane"></i>
                        </a>{/if}</p>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="panel panel-default">
            <div class="panel-heading">
                <div class="row">
                    <h3 class="panel-title col-md-6">Mandat</h3>

                    <div class="col-md-6 text-right">

                        {if $mandate->getMandateType()->getIdMandateType() eq Constant::ID_PLOT_OF_LAND}
                            {assign var="module" value='terrain'}
                        {else}
                            {assign var="module" value='mandat'}
                        {/if}
                        <a class="btn btn-default btn-xs" href="{Tools::create_url($user,$module,'see',$mandate->getIdMandate())}" {if $user->getOpenInNewTab()} target="_blank"{/if}>
                            <i class="fa fa-chevron-circle-right"></i> Voir la fiche {$module}
                        </a>
                    </div>
                </div>
            </div>
            <div class="panel-body">
                <p>Numéro de mandat : {$mandate->getNumberMandate()}</p>

            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">Infos rapprochement</h3>
            </div>
            <div class="panel-body">
                <p>Date de la visite : {if
                    $rapprochement->getDateVisite()}{date(Constant::DATE_FORMAT,$rapprochement->getDateVisite())}{else}NC{/if}</p>
                <p>Compte rendu le : {if
                    $rapprochement->getCompteRenduLe()}{date(Constant::DATE_FORMAT,$rapprochement->getCompteRenduLe())}{else}NC{/if}</p>
                <p>Visitée ? {if $rapprochement->getResultatVisite()
                    !=0}Oui{else}Non{/if}</p>
                {if $rapprochement->getResultatVisite() !=0}
                    <p>Points positifs : {$rapprochement->getPointsPositifs()}</p>
                    <p>Points negatifs : {$rapprochement->getPointsNegatifs()}</p>
                    <p>Resultat de la visite ? {if $rapprochement->getResultatVisite() eq
                        1}Ne correspond pas{else}OK{/if}</p>
                {/if}
            </div>
        </div>
    </div>


</div>






{* Rajouter et que le mandat correspondant est à vendre
(ID_ETAP_TO_SELL)*}
{if $user->getLevelMember()->getIdLevelMember()<3 || $user->getIdUser() eq $rapprochement->getUser()->getIdUser()}
    <form action="" method="post">
        <p>
            <button type="submit" value="Mettre en etat compromis" id="goCompromis"
                   name="goCompromis" class="btn btn-default btn-lg btn-block">
                <i class="fa fa-cog"></i> Mettre en etat compromis
                   </button>
        </p>
    </form>
{/if}


</div>
