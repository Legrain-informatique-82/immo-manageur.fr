{include file="tpl_default/entete.tpl"}
{*
<p id="arrowsNextPreview">
	{if $mandatPrecedent} <a
		href="{Tools::create_url($user,$smarty.get.module,$smarty.get.page,$premierMandat->getIdMAndate())}"><img
		src="{Constant::DEFAULT_URL_PICTURE_DIRECTORY}finalBack.png"
		alt="Premier Mandat" /> </a> <a
		href="{Tools::create_url($user,$smarty.get.module,$smarty.get.page,$mandatPrecedent->getIdMAndate())}"><img
		src="{Constant::DEFAULT_URL_PICTURE_DIRECTORY}back.png"
		alt="Mandat précédent" /> </a> {/if} {if $mandatSuivant} <a
		href="{Tools::create_url($user,$smarty.get.module,$smarty.get.page,$mandatSuivant->getIdMAndate())}"><img
		src="{Constant::DEFAULT_URL_PICTURE_DIRECTORY}forward.png"
		alt="Mandat suivant" /> </a> <a
		href="{Tools::create_url($user,$smarty.get.module,$smarty.get.page,$dernierMandat->getIdMAndate())}"><img
		src="{Constant::DEFAULT_URL_PICTURE_DIRECTORY}finalForward.png"
		alt="Dernier mandat" /> </a> {/if}
</p>
*}
<div class="row bg-success bannerTitle">
    <div class="col-md-12">
        <h1 class="h2">Fiche du terrain n°{$mandate->getNumberMandate()}</h1>
    </div>

</div>

<div class="row" id="headerFicheMandate">
    <div class="col-md-4">
        <div class="panel panel-default">


            <div class="panel-heading">
                <div class="row">

                    <div class="col-xs-5">
                        Etape en cours : {$mandate->getEtap()->getName()}
                    </div>
                    <div class="col-xs-7 text-right">
                        {if $mandate->getCommentaire()}{$mandate->getCommentaire()}{/if} {if
                        ($user->getLevelMember()->getIdLevelMember() < 3 OR $user->getIdUser()
                        eq $mandate->getUser()->getIdUser()) AND
                        $mandate->getEtap()->getIdMandateEtap() eq Constant::ID_ETAP_TO_SELL}
                            <a class="btn btn-danger" href="{Tools::create_url($user,$smarty.get.module,'cancel',$smarty.get.action)}">Annuler le mandat</a>

                        {/if} {* Si le mandat n'est pas à vendre, on peut le réactualiser.
	(pere et admin ? ou tout le monde ?) *} {if
                        ($user->getLevelMember()->getIdLevelMember() < 3 OR $user->getIdUser()
                        eq $mandate->getUser()->getIdUser()) AND
                        $mandate->getEtap()->getIdMandateEtap() neq Constant::ID_ETAP_TO_SELL}

                            <a class="btn btn-warning"
                               href="{Tools::create_url($user,$smarty.get.module,'renew',$smarty.get.action)}">Reaffecter
                                le mandat</a>

                        {/if} {* Finaliser la vente (pere ou admin) pour un mandat en etat
	compromis *} {if ($user->getLevelMember()->getIdLevelMember() < 3 OR
                        $user->getIdUser() eq $mandate->getUser()->getIdUser()) AND
                        $mandate->getEtap()->getIdMandateEtap() eq CONSTANT::ID_ETAP_COMPROMIS}
                            <a class="btn btn-success"
                               href="{Tools::create_url($user,'mandat','endSell',$mandate->getIdMandate())}">Finaliser
                                la vente</a>
                        {/if}
                    </div>
                </div>
            </div>




            <div class="panel-body">
                <p>
                    {include file="tpl_default/hook.tpl"  position="hook_blockLeftMandate"}
                </p>
                {* Taches.. *}
                {include file="tpl_default/hook.tpl"  position="hook_blockLeftMandateListTaches"}

            </div>
        </div>
    </div>

    {if $mandate->getPubInternet() !=''}

        <div class="col-md-4">
            <div class="panel panel-default">

                <div class="panel-heading">Pub :</div>
                <div class="panel-body">


                    <p>{Tools::substr($mandate->getPubInternet(),0,750)} {if Tools::strlen(
                        $mandate->getPubInternet() ) > 750} [...] {/if}</p>
                </div>
            </div>
        </div>
    {else}
        <div class="col-md-4"></div>
    {/if} {* mettre dans un hook *} {include file="tpl_default/hook.tpl"
    position="hook_elemMandateCom_see"} {*fin hook*} {if
    $mandate->getPictureByDefault()}
        <div class="col-md-4">
            <div class="panel panel-default">

                <div class="panel-heading">Image par défaut :</div>
                <div class="panel-body text-center">
                    <img class="img-thumbnail"
                         src="{Constant::DEFAULT_URL_PICTURE_MODULE_DIRECTORY}/{$smarty.get.module}/thumb/{$mandate->getPictureByDefault()->getName()}"
                         alt="" id="" />
                </div>
            </div></div>
    {/if}
</div>

<div class="h1 text-center alert alert-success">{Tools::grosNombre(round($mandate->getPriceFAI(),0))} € - FAI</div>

{include file="tpl_default/hook.tpl" position="hook_action"}




{* error plans*}
{if $errorPlan} {foreach from=$errorPlan item=item name=e} {if
$smarty.foreach.e.first}
    <div class="alert alert-danger" role="alert">
    <ul>
{/if}
    <li class="error">{$item}</li> {if $smarty.foreach.e.last}
        </ul>
    {/if} {/foreach}
    </div>
{/if}
<div id="tabs">
<ul>
    <li><a href="#biens">Bien</a>
    </li>
    <li><a href="#vendeur">Vendeur</a>
    </li>
    <li><a href="#plans">Plans</a>
    </li>
    <li><a href="#fichiers">Fichiers</a>
    </li>
    <li><a href="#impressions">Impressions</a>
    </li> {include file="tpl_default/hook.tpl" position="hook_acqTitle"}
</ul>
<div id="biens">
<div class="accordion" rel="1">
<h2 rel="gen">
    <a href="#" rel="gen">Général</a>
</h2>
<div>
    {if ($user->getLevelMember()->getIdLevelMember() < 3 OR
    $user->getIdUser() eq $mandate->getUser()->getIdUser() ) AND
    $mandate->getEtap()->getIdMandateEtap() eq
    Constant::ID_ETAP_TO_SELL}
        <p>
            <a
                    href="{Tools::create_url($user,$smarty.get.module,'updateGen',$smarty.get.action)}" class="btn btn-default"><i class="fa fa-pencil-square-o"></i> Modifier
                les informations</a>
        </p>
    {/if}
    <div class="row" id="ficheMandateFirstLine">
        <div class="col-md-3">
            <div class="panel panel-default">

                <div class="panel-heading">Localisation :</div>
                <div class="panel-body">

                    <!-- 					<div class="bulle"> -->
                    <dl class="dl-horizontal">
                        <dt>adresse :</dt>
                        <dd>{$mandate->getAddress()}</p>
                            {$mandate->getCity()->getZipCode()}
                            {$mandate->getCity()->getName()}</dd>
                    </dl>

                    <!-- 					</div> -->
                </div>
            </div>
        </div>
        <div class="col-md-3">

            <div class="panel panel-default">

                <div class="panel-heading">Général :</div>
                <div class="panel-body">

                    <dl class="dl-horizontal">
                        <dt>Nature du bien :</dt><dd> {if
                            $mandate->getNature()==null}NC{else}{$mandate->getNature()->getName()}{/if}</dd>
                        <dt>Utilisateur affecté :</dt><dd> {$mandate->getUser()->getName()}
                            {$mandate->getUser()->getFirstname()}</dd>
                        <dt>Notaire vendeur :</dt> <dd>{if
                            $mandate->getNotary()}{$mandate->getNotary()->getName()}{else}NC{/if}</dd>
                        <dt>Notaire acquereur :</dt><dd> {if
                            $mandate->getNotaryAcq()}{$mandate->getNotaryAcq()->getName()}{else}NC{/if}</dd>
                        <dt>Type transaction :</dt> <dd>{$mandate->getTransactionType()->getName()}</dd>

                        <dt>Type de terrain ::</dt><dd> {if $mandate->getTypeTerrain() ==0} NC {elseif $mandate->getTypeTerrain() ==1} À batir {else} À lotir{/if}</dd>
                        <dt>Situation du terrain ::</dt><dd> {if $mandate->getSituationTerrain() ==0} NC {elseif $mandate->getSituationTerrain() ==1} Lotissement {else} Diffus ( hors lotissement){/if}</dd>
                    </dl>

                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="panel panel-default">

                <div class="panel-heading">Mandat :</div>
                <div class="panel-body">
                    <!-- 				<div class="bulle"> -->
                    <dl class="dl-horizontal">
                        <dt>N° Mandat :</dt><dd> {$mandate->getNumberMandate()}</dd>
                        <dt>Début : </dt><dd>{date(Constant::DATE_FORMAT2,$mandate->getInitDate())}</dd>
                        <dt>Fin : </dt><dd>{if date(Constant::DATE_FORMAT2,$mandate->getDeadDate())
                            eq '01/01/1970'} NC
                            {else}{date(Constant::DATE_FORMAT2,$mandate->getDeadDate())}{/if}</dd>
                        <dt>libre le :</dt><dd> {if $mandate->getFreeDate()==null} NC
                            {else}{date(Constant::DATE_FORMAT2,$mandate->getFreeDate())}{/if}</dd>
                        <!-- 					</div> -->


                    </dl>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="panel panel-default">

                <div class="panel-heading">Prix :</div>
                <div class="panel-body">
                    <!-- 					<div class="bulle"> -->
                    <dl class="dl-horizontal">

                        {* Si c'est = à vente*} {if Constant::ID_TRANSACTION_TYPE_SELLER eq
                        $mandate->getTransactionType()->getIdTransactionType()}
                            <dt>Prix FAI :</dt><dd> {Tools::grosNombre(round($mandate->getPriceFAI(),0))}
                                &euro;</dd>
                            <dt>Prix net vendeur :</dt><dd>
                                {Tools::grosNombre(round($mandate->getPriceSeller(),0))} &euro;</dd>
                            <dt>Commission :</dt><dd>
                                {Tools::grosNombre(round($mandate->getCommission(),0))} &euro;</dd>
                            {if Tools::grosNombre(round($mandate->getEstimationMaxi(),0)) eq 0}
                                {if Tools::grosNombre(round($mandate->getEstimationFai(),0)) neq 0}
                                    <dt>Estimation FAI :</dt><dd>
                                    {Tools::grosNombre(round($mandate->getEstimationFai(),0))} &euro;</dd>
                                {/if} {else}


                                <dt>Estimation FAI : </dt><dd>entre
                                {Tools::grosNombre(round($mandate->getEstimationFai(),0))} &euro;
                                et {Tools::grosNombre(round($mandate->getEstimationMaxi(),0))}
                                &euro;</dd>

                            {/if}



                            {if Tools::grosNombre(round($mandate->getMargeNegociation(),0)) neq 0}
                                <dt>Marge negoce :</dt><dd>
                                {Tools::grosNombre(round($mandate->getMargeNegociation(),0))}
                                &euro;</dd>
                            {/if}

                        {else}
                            <dt>Loyer + frais d'agence :</dt><dd>
                                {Tools::grosNombre(round($mandate->getPriceFAI(),0))} &euro;</dd>
                            <dt>Loyer :</dt><dd> {Tools::grosNombre(round($mandate->getPriceSeller(),0))}
                                &euro;</dd>
                            <dt>Commission :</dt><dd>
                                {Tools::grosNombre(round($mandate->getCommission(),0))} &euro;</dd>
                        {/if}


                    </dl>
                    <!-- 					</div> -->
                </div>
            </div>
        </div>

    </div>
    {if $mandate->getGeolocalisation()} {assign var="geo"
    value=explode(',',$mandate->getGeolocalisation())}
        <h3>Géolocalisation</h3>


        <div id="map"></div>

        <p class="help-block">
            Latitude : en degrès sexagésimaux : {$geo.0} - en degrès décimaux :
            <span id="latitude">{Tools::convertSexadecimalInDecimal($geo.0)}</span>
            <br />Longitude : en degrès sexagésimaux : {$geo.1} - en degrès
            décimaux : <span id="longitude">{Tools::convertSexadecimalInDecimal($geo.1)}</span>
        </p>

    {else}
        <div id="map2" data-address="{$mandate->getAddress()}, {$mandate->getCity()->getZipCode()} {$mandate->getCity()->getName()}"></div>
        <p class="help-block">
            Latitude : en degrès sexagésimaux : {$geo.0} - en degrès décimaux :
            <span id="latitude">{Tools::convertSexadecimalInDecimal($geo.0)}</span>
            <br />Longitude : en degrès sexagésimaux : {$geo.1} - en degrès
            décimaux : <span id="longitude">{Tools::convertSexadecimalInDecimal($geo.1)}</span>
        </p>
    {/if}
</div>

<h3>
    <a href="#">Infos/Descriptions</a>
</h3>
<div>
{if ($user->getLevelMember()->getIdLevelMember() < 3 OR
$user->getIdUser() eq $mandate->getUser()->getIdUser() ) AND
$mandate->getEtap()->getIdMandateEtap() eq
Constant::ID_ETAP_TO_SELL}
    <p>
        <a
                href="{Tools::create_url($user,$smarty.get.module,'updateDesc',$smarty.get.action)}"  class="btn btn-default"><i class="fa fa-pencil-square-o"></i> Modifier
            les infos/descriptions</a>
    </p>
{/if}
<div class="row">
    <div class="col-md-4">
        <table class="table table-bordered table-striped">
            <thead>
            <tr>
                <th colspan="2"><h3>Superficie</h3></th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td class="gauche">Superficie parcelle 1</td>
                <td class="droite">{if $mandate->getSuperficieParcelle1() eq
                    0}NC{else} {$mandate->getSuperficieParcelle1()}{/if}</td>
            </tr>
            <tr>
                <td class="gauche">Superficie parcelle 2</td>
                <td class="droite">{if $mandate->getSuperficieParcelle2() eq
                    0}NC{else} {$mandate->getSuperficieParcelle2()}{/if}</td>
            </tr>
            <tr>
                <td class="gauche">Superficie parcelle 3</td>
                <td class="droite">{if $mandate->getSuperficieParcelle3() eq
                    0}NC{else}{$mandate->getSuperficieParcelle3()}{/if}</td>
            </tr>
            <tr>
                <td class="gauche">Superficie autres parcelle</td>
                <td class="droite">{if $mandate->getSuperficieAutreParcelle() eq
                    0}NC{else}{$mandate->getSuperficieAutreParcelle()}{/if}</td>
            </tr>
            <tr>
                <td class="gauche">Superficie constructible</td>
                <td class="droite">{if $mandate->getSuperficieConstructible() eq
                    0}NC{else}{$mandate->getSuperficieConstructible()}{/if}</td>
            </tr>
            <tr>
                <td class="gauche">Superficie non constructible</td>
                <td class="droite">{if $mandate->getSuperficieNonConstructible()
                    eq 0}NC{else}{$mandate->getSuperficieNonConstructible()}{/if}</td>
            </tr>
            <tr>
                <td class="gauche">Superficie totale</td>
                <td class="droite">{if $mandate->getSuperficieTotale() eq
                    0}NC{else}{$mandate->getSuperficieTotale()}{/if}</td>
            </tr>
            <tr>
                <td class="gauche">géometre</td>
                <td class="droite">{if
                    $mandate->getGeometer()}{$mandate->getGeometer()->getName()}{else}NC{/if}
                </td>
            </tr>
            <tr>
                <td class="gauche">Bornage</td>
                <td class="droite">{if
                    $mandate->getBornageTerrain()}{$mandate->getBornageTerrain()->getName()}{else}NC{/if}</td>
            </tr>
            </tbody>
        </table>
    </div>

    <div class="col-md-4">
        <table class="table table-bordered table-striped">
            <thead>
            <tr>
                <th colspan="2"><h3>Réglementation</h3></th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td class="gauche">Zonage PLU</td>
                <td class="droite">{if
                    $mandate->getZonagePlu()}{$mandate->getZonagePlu()->getName()}{else}NC{/if}</td>
            </tr>
            <tr>
                <td class="gauche">Zonage RNU</td>
                <td class="droite">{if
                    $mandate->getZonageRnu()}{$mandate->getZonageRnu()->getName()}{else}NC{/if}</td>
            </tr>
            <tr>
                <td class="gauche">COS</td>
                <td class="droite">{if
                    $mandate->getCOS()}{$mandate->getCOS()->getName()}{else}NC{/if}</td>
            </tr>
            <tr>
                <td class="gauche">Shon accordée</td>
                <td class="droite">{$mandate->getsHONAccordee()}</td>
            </tr>
            <tr>
                <td class="gauche">Zone BDF</td>
                <td class="droite">{if $mandate->getZoneBDF() eq
                    0}NON{else}OUI{/if}</td>
            </tr>
            <tr>
                <td class="gauche">Ligne de crete</td>
                <td class="droite">{if $mandate->getLigneDeCrete() eq
                    0}NON{else}OUI{/if}</td>
            </tr>
            <tr>
                <td class="gauche">zone inondable</td>
                <td class="droite">{if $mandate->getZoneInondable() eq
                    0}NON{else}OUI{/if}</td>
            </tr>
            <tr>
                <td class="gauche">Réglement lotissement</td>
                <td class="droite">{if $mandate->getReglementDeLotissement()} <br />{$mandate->getReglementDeLotissement()}{/if}
                </td>
            </tr>
            <tr>
                <td class="gauche">ERNT</td>
                <td class="droite">{if $mandate->getERNT()}<br />{$mandate->getERNT()}{/if}
                </td>
            </tr>
            </tbody>
        </table>
    </div>

    <div class="col-md-4">
        <table class="table table-bordered table-striped">

            <thead>
            <tr>
                <th colspan="2"><h3>Autorisation</h3></th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td class="gauche">DP valide</td>
                <td class="droite">{if $mandate->getDPValide()}Oui{else}Non{/if}</td>
            </tr>
            <tr>
                <td class="gauche">Date déclaration préalable</td>
                <td class="droite">{if
                    $mandate->getDateDeclarationPrealable()}{date(Constant::DATE_FORMAT2,$mandate->getDateDeclarationPrealable())}{else}NC{/if}</td>
            </tr>
            <tr>
                <td class="gauche">Prorogation DP jusqu'au</td>
                <td class="droite">{if
                    $mandate->getProrogationDPJusquau()}{date(Constant::DATE_FORMAT2,$mandate->getProrogationDPJusquau())}{else}NC{/if}</td>
            </tr>
            <tr>
                <td class="gauche">CU valide</td>
                <td class="droite">{if $mandate->getCuValide()}Oui{else}Non{/if}</td>
            </tr>
            <tr>
                <td class="gauche">Date déclaration préalable</td>
                <td class="droite">{if
                    $mandate->getDateCu()}{date(Constant::DATE_FORMAT2,$mandate->getDateCu())}{else}NC{/if}</td>
            </tr>
            <tr>
                <td class="gauche">Prorogation CU jusqu'au</td>
                <td class="droite">{if
                    $mandate->getProrogationCUJusquau()}{date(Constant::DATE_FORMAT2,$mandate->getProrogationCUJusquau())}{else}NC{/if}</td>
            </tr>
            <tr>
                <td class="gauche">CU Ops valide</td>
                <td class="droite">{if
                    $mandate->getCuOpsValide()}Oui{else}Non{/if}</td>
            </tr>
            <tr>
                <td class="gauche">Date déclaration préalable</td>
                <td class="droite">{if
                    $mandate->getDateCuOps()}{date(Constant::DATE_FORMAT2,$mandate->getDateCuOps())}{else}NC{/if}</td>
            </tr>
            <tr>
                <td class="gauche">Prorogation CU Ops jusqu'au</td>
                <td class="droite">{if
                    $mandate->getProrogationCUOpsJusquau()}{date(Constant::DATE_FORMAT2,$mandate->getProrogationCUOpsJusquau())}{else}NC{/if}</td>
            </tr>
            <tr>
                <td class="gauche">Permis d'amenager valide</td>
                <td class="droite">{if
                    $mandate->getPermisDamenagerValide()}Oui{else}Non{/if}</td>
            </tr>
            <tr>
                <td class="gauche">Date de permis d'amenager</td>
                <td class="droite">{if
                    $mandate->getDatePermisDamenager()}{date(Constant::DATE_FORMAT2,$mandate->getDatePermisDamenager())}{else}NC{/if}</td>
            </tr>
            </tbody>
        </table>
    </div>
</div>
<div class="row">
    <div class="col-md-4">
    <table class="table table-bordered table-striped">

            <thead>
            <tr>
                <th colspan="2"><h3>Viabilisation</h3></th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td class="gauche">Terrain vendu</td>
                <td class="droite">{if
                    $mandate->getTerrainVenduViabilise()}viabilisé{elseif
                    $mandate->getTerrainVenduSemiViabilise()}Semi viabilisé{elseif
                    $mandate->getTerrainVenduNonViabilise()}Non
                        viabilisé{else}NC{/if}</td>
            </tr>
            <tr>
                <td class="gauche">Passage eau</td>
                <td class="droite">{if $mandate->getPassageEau()}<br />{$mandate->getPassageEau()}{/if}
                </td>
            </tr>
            <tr>
                <td class="gauche">Correspondant eau</td>
                <td class="droite">{if
                    $mandate->getWaterCorresponding()}{$mandate->getWaterCorresponding()->getName()}{else}NC{/if}</td>
            </tr>
            <tr>
                <td class="gauche">Passage éléctricité</td>
                <td class="droite">{if $mandate->getPassageElectricite()}<br />{$mandate->getPassageEau()}{/if}
                </td>
            </tr>
            <tr>
                <td class="gauche">Correspondant electrique</td>
                <td class="droite">{if
                    $mandate->getElectricCorresponding()}{$mandate->getElectricCorresponding()->getName()}{else}NC{/if}</td>
            </tr>
            <tr>
                <td class="gauche">Passage gaz</td>
                <td class="droite">{if $mandate->getPassageGaz()}<br />{$mandate->getPassageGaz()}{/if}
                </td>
            </tr>
            <tr>
                <td class="gauche">Correspondant gaz</td>
                <td class="droite">{if
                    $mandate->getGazCorresponding()}{$mandate->getGazCorresponding()->getName()}{else}NC{/if}</td>
            </tr>

            <tr>
                <td class="gauche">Assainissement</td>
                <td class="droite">{if $mandate->getToutALegout()}Tout à l'égout
                    {elseif $mandate->getAssainissementParFosseSceptique()}Par fosse
                        sceptique{else}NC{/if}</td>
            </tr>

            <tr>
                <td class="gauche">Correspondant sanitaire</td>
                <td class="droite">{if
                    $mandate->getSanitationCorresponding()}{$mandate->getSanitationCorresponding()->getName()}{else}NC{/if}</td>
            </tr>
            <tr>
                <td class="gauche">Voirie</td>
                <td class="droite">{if $mandate->getVoirie()}<br />{$mandate->getVoirie()}{/if}
                </td>
            </tr>
            </tbody>
        </table>
</div>

<div class="col-md-4">
    <table class="table table-bordered table-striped">
        <thead>
        <tr>
            <th colspan="2"><h3>Description</h3></th>
        </tr>
        </thead>
        <tbody>
        <tr>
            <td class="gauche">Orientation</td>
            <td class="droite">{if
                $mandate->getOrientation()}{$mandate->getOrientation()->getName()}{else}NC{/if}</td>
        </tr>
        <tr>
            <td class="gauche">Pente</td>
            <td class="droite">{if
                $mandate->getSlope()}{$mandate->getSlope()->getName()}{else}NC{/if}</td>
        </tr>

        <tr>
            <td class="gauche">Taille de la façade</td>
            <td class="droite">{if
                $mandate->getTailleFacade()}{$mandate->getTailleFacade()}{else}NC{/if}</td>
        </tr>
        <tr>
            <td class="gauche">Profondeur du terrain</td>
            <td class="droite">{if
                $mandate->getProfondeurTerrain()}{$mandate->getProfondeurTerrain()}{else}NC{/if}</td>
        </tr>

        {if $mandate->getCommentaire()}
            <tr>
                <td class="gauche">Commentaires</td>
                <td class="droite">{$mandate->getCommentaire()}</td>
            </tr>
        {/if}

        <tr>
            <td class="gauche">Proximité école</td>
            <td class="droite">{if $mandate->getProximiteEcole() eq
                0}NC{else}{$mandate->getProximiteEcole()} {/if}</td>
        </tr>
        <tr>
            <td class="gauche">Proximité commerce</td>
            <td class="droite">{if $mandate->getProximiteCommerce() eq
                0}NC{else}{$mandate->getProximiteCommerce()} {/if}</td>
        </tr>
        <tr>
            <td class="gauche">Proximité transport</td>
            <td class="droite">{if $mandate->getProximiteTransport() eq
                0}NC{else}{$mandate->getProximiteTransport()} {/if}</td>
        </tr>
        </tbody>
    </table>
</div>
<div class="col-md-4">

    <table class="table table-bordered table-striped">
        <thead>
        <tr>
            <th colspan="2"><h3>Cadastre</h3></th>
        </tr>
        </thead>
        <tbody>
        <tr>
            <td class="gauche">Ref cadastre parcelle 1</td>
            <td class="droite">{$mandate->getReferenceCadastreParcelle1()}</td>
        </tr>
        <tr>
            <td class="gauche">Ref cadastre parcelle 2</td>
            <td class="droite">{$mandate->getReferenceCadastreParcelle2()}</td>
        </tr>
        <tr>
            <td class="gauche">Ref cadastre parcelle 3</td>
            <td class="droite">{$mandate->getReferenceCadastreParcelle3()}</td>
        </tr>
        <tr>
            <td class="gauche">Autre ref cadastre</td>
            <td class="droite">{$mandate->getAutreReferenceParcelle()}</td>
        </tr>
        <tr>
            <td class="gauche">Numéro de lot</td>
            <td class="droite">{$mandate->getNumberLot()}</td>
        </tr>
        </tbody>
    </table>
</div>
</div>
</div>

{include file="tpl_default/hook.tpl" position="hook_see_mandateDescription"}

<h3>
    <a href="#">Pub</a>
</h3>
<div>
    {if ($user->getLevelMember()->getIdLevelMember() < 3 OR
    $user->getIdUser() eq $mandate->getUser()->getIdUser() ) AND
    $mandate->getEtap()->getIdMandateEtap() eq
    Constant::ID_ETAP_TO_SELL}
        <p>
            <a
                    href="{Tools::create_url($user,$smarty.get.module,'updatePub',$smarty.get.action)}" class="btn btn-default"><i class="fa fa-pencil-square-o"></i> Modifier
                les pubs</a>
        </p>
    {/if}

{*

    <div class="mSep">
        <h3>Coup de coeur</h3>
        <p>Coup de coeur : {if $mandate->getCoupCoeur()}Oui{else}Non{/if}</p>
    </div>
    <div class="mSep">
        <h3>Vitrine</h3>
        <p>Affiché en vitrine : {if $afficheEnVitrine}Oui{else}Non{/if}</p>
    </div>
    <hr class="clear invi" />

    <div class="bulle">
        <h3>Texte utilisé dans les affiches</h3>
        {if $mandate->getCommentaireApparent() ==''}
            <p>Aucun texte saisi.</p>
        {else}
            <p>{$mandate->getCommentaireApparent()}</p>
        {/if}
    </div>


    <div class="bulle">
        <h3>Passerelles utilisées</h3>
        {include file="tpl_default/hook.tpl" position="hook_site"}
    </div>

    <div class="bulle">
        <h3>Texte utilisé avec les passerelles.</h3>
        {if $mandate->getPubInternet() ==''}
            <p>Aucun texte saisi.</p>
        {else}
            <p>{$mandate->getPubInternet()}</p>
        {/if}
    </div>
    <div class="bulle">
        <h3>Photos utilisées avec les passerelles.</h3>
        {include file="tpl_default/hook.tpl" position="hook_ExportsList"}
    </div>
*}

    <div class="row">


        <div class="col-md-6">


            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">Coup de coeur</h3>
                </div>
                <div class="panel-body">
                    <p>Coup de coeur : {if $mandate->getCoupCoeur()}Oui{else}Non{/if}</p>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">Vitrine</h3>
                </div>
                <div class="panel-body">
                    <p>Affiché en vitrine : {if $afficheEnVitrine}Oui{else}Non{/if}</p>
                </div>
            </div>


        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">Texte utilisé dans les affiches</h3>
                </div>
                <div class="panel-body">
                    {if $mandate->getCommentaireApparent() ==''}
                        <p>Aucun texte saisi.</p>
                    {else}
                        <p>{$mandate->getCommentaireApparent()}</p>
                    {/if}
                </div>
            </div>
        </div>


        <div class="col-md-6">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">Texte utilisé avec les passerelles</h3>
                </div>
                <div class="panel-body">
                    {if $mandate->getPubInternet() ==''}
                        <p>Aucun texte saisi.</p>
                    {else}
                        <p>{$mandate->getPubInternet()}</p>
                    {/if}
                </div>
            </div>
        </div>

    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">Passerelles utilisées</h3>
                </div>
                <div class="panel-body">
                    {include file="tpl_default/hook.tpl" position="hook_site"}
                </div>
            </div>



        </div>
    </div>


    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">Photos utilisées avec les passerelles</h3>
                </div>
                <div class="panel-body">
                    {include file="tpl_default/hook.tpl" position="hook_ExportsList"}
                </div>
            </div>



        </div>
    </div>


</div>


<h3>
    <a href="#photos">Photos</a>
</h3>
<div>

    {if $errorPicture}
        <ul>
            {foreach from=$errorPicture item=e}
                <li class="error">{$e}</li> {/foreach}
        </ul>
    {/if}
    {*
    {if ($user->getLevelMember()->getIdLevelMember() < 3 OR
    $user->getIdUser() eq $mandate->getUser()->getIdUser()) AND
    $mandate->getEtap()->getIdMandateEtap() eq
    Constant::ID_ETAP_TO_SELL}
        <form
                action="{Tools::create_url($user,$smarty.get.module,$smarty.get.page,$mandate->getIdMandate())}"
                method="post" enctype="multipart/form-data">
            <input type="hidden" id="idMandate" name="idMandate"
                   value="{$mandate->getIdmandate()}" /> <input type="hidden"
                                                                id="idSess" name="idSess" value="{str_rot13(session_id())}" />
            <p class="uploadMultiple">
                <label for="newPicture">Ajouter une photo : <input type="file"
                                                                   name="newPicture" id="newPicture" /> </label> <label
                        for="isDefaultPicture">Image par defaut ?<input type="checkbox"
                                                                        name="isDefaultPicture" id="isDefaultPicture" /> </label> <input
                        type="submit" value="Envoyer" id="sendPictureForMandate"
                        name="sendPictureForMandate" />
            </p>
        </form>
    {/if}

    <div id="listVignettes">


        {foreach from=$mandate->listPictures() item=item}
            <div>

                <img
                        src="{Constant::DEFAULT_URL_PICTURE_MODULE_DIRECTORY}/{$smarty.get.module}/thumb/{$item->getName()}"
                        rel="{$item->getIdMandatePicture()}" alt="" /> {if
                $item->getIsDefault()}
                    <p class="jsNone">Image principale</p>
                {else} {if $user->getLevelMember()->getIdLevelMember() < 3 OR
                    $user->getIdUser() eq $mandate->getUser()->getIdUser()}
                        <form class="jsNone" action="" method="post">
                            <p>
                                <input type="hidden" name="idMandate"
                                       value="{$mandate->getIdMandate()}" /> <input type="hidden"
                                                                                    name="idPicture" value="{$item->getIdMandatePicture()}" /> <input
                                        type="submit" name="sendPictureByDefault"
                                        value="Définir comme principale" />
                            </p>
                        </form>
                    {/if} {/if}
                <p>{if ($user->getLevelMember()->getIdLevelMember() < 3 OR
                    $user->getIdUser() eq $mandate->getUser()->getIdUser()) AND
                    $mandate->getEtap()->getIdMandateEtap() eq
                    Constant::ID_ETAP_TO_SELL}</p>
                <form action="" class="jsNone" method="post">
                    <p>
                        <input type="hidden" name="idMandate"
                               value="{$mandate->getIdMandate()}" /> <input type="hidden"
                                                                            name="idPicture" value="{$item->getIdMandatePicture()}" /> <input
                                type="submit" value="Supprimer l'image" name="delete_picture" />
                    </p>
                </form>
                {else} - {/if}

            </div>
            <hr class="jsNone" />
        {/foreach}


    </div>
    <div class="quatreVingt" id="contentBigPicture">
         {if
        $mandate->getPictureByDefault()} <img
                    src="{Constant::DEFAULT_URL_PICTURE_MODULE_DIRECTORY}/{$smarty.get.module}/{$mandate->getPictureByDefault()->getName()}"
                    alt="" id="grdF" /> {assign var="item"
            value=$mandate->getPictureByDefault()} {if $item->getIsDefault()}
                <p class="jsIndic">Image principale</p>
            {else} {if $user->getLevelMember()->getIdLevelMember() < 3 OR
                $user->getIdUser() eq $mandate->getUser()->getIdUser()}
                    <form action="" method="post" class="jsIndic">
                        <p>
                            <input type="hidden" name="idMandate"
                                   value="{$mandate->getIdMandate()}" /> <input type="hidden"
                                                                                name="idPicture" value="{$item->getIdMandatePicture()}" /> <input
                                    type="submit" name="sendPictureByDefault"
                                    value="Définir comme principale" />
                        </p>
                    </form>
                {/if} {/if}
            <p>{if ($user->getLevelMember()->getIdLevelMember() < 3 OR
            $user->getIdUser() eq $mandate->getUser()->getIdUser()) AND
            $mandate->getEtap()->getIdMandateEtap() eq
            Constant::ID_ETAP_TO_SELL}</p>
                <form action="" method="post" class="jsIndic">
                    <p>
                        <input type="hidden" name="idMandate"
                               value="{$mandate->getIdMandate()}" /> <input type="hidden"
                                                                            name="idPicture" value="{$item->getIdMandatePicture()}" /> <input
                                type="submit" value="Supprimer l'image" name="delete_picture" />
                    </p>
                </form>
            {else} - {/if} {/if}
            </div>
            *}
    <div class="row">
        {* début #listePhotos *}
        <div class="col-md-12" id="listesPhotos">
            {foreach from=$mandate->listPictures() item=item name="bouclePhotos"}
                {if $smarty.foreach.bouclePhotos.first}
                    <div class="row">
                {else}
                    {if $smarty.foreach.bouclePhotos.index %4 eq 0}
                        </div>
                        <div class="row">
                    {/if}
                {/if}
                <div class="col-md-3 text-center" >
                    <p>
                        <a href="{Constant::DEFAULT_URL_PICTURE_MODULE_DIRECTORY}/{$smarty.get.module}/big/{$item->getName()}" class="fancybox" rel="galery">
                            <img class="img-thumbnail img-responsive {if $item->getIsDefault()}bg-primary{/if}" src="{Constant::DEFAULT_URL_PICTURE_MODULE_DIRECTORY}/{$smarty.get.module}/thumb/{$item->getName()}" rel="{$item->getIdMandatePicture()}" alt="" />
                        </a>
                    </p>


                    {if $user->getLevelMember()->getIdLevelMember() < 3 OR $user->getIdUser() eq $mandate->getUser()->getIdUser()}
                        <form class="" action="" method="post">
                            <p>
                                <input type="hidden" name="idMandate" value="{$mandate->getIdMandate()}" />
                                <input type="hidden" name="idPicture" value="{$item->getIdMandatePicture()}" />
                                {if !$item->getIsDefault()}


                                    <button data-idpicture="{$item->getIdMandatePicture()}" type="submit" class="btn btn-default" name="sendPictureByDefault">
                                        <i class="fa fa-random"></i> Définir comme principale
                                    </button>

                                    <button data-idpicture="{$item->getIdMandatePicture()}" type="submit" class="btn btn-danger jsDelPictureMandate" name="delete_picture" title="Supprimer la photo">
                                        <i class="fa fa-trash"></i>
                                    </button>



                                {else}


                                    <button type="submit" class="btn btn-default disabled">
                                        <i class="fa fa-random"></i> Principale
                                    </button>
                                    <button type="submit" class="btn btn-danger disabled" title="Supprimer la photo">
                                        <i class="fa fa-trash"></i>
                                    </button>
                                {/if}
                            </p>
                        </form>
                    {/if}


                </div>

                {if $smarty.foreach.bouclePhotos.last}
                    </div>
                {/if}

            {/foreach}

        </div>
        {* fin #listePhotos *}


        {if ($user->getLevelMember()->getIdLevelMember() < 3 OR
        $user->getIdUser() eq $mandate->getUser()->getIdUser()) AND
        $mandate->getEtap()->getIdMandateEtap() eq
        Constant::ID_ETAP_TO_SELL}

            <div class="row">
                <div class="col-md-12">

                    <div id="uploaderPicturesMandates" data-script="{Constant::DEFAULT_URL}/ajax/" data-idmandat="{$smarty.get.action}">
                        <p>Your browser doesn't have Flash, Silverlight or HTML5 support.</p>
                    </div>


                </div>
            </div>

        {/if}

    </div>

</div>


</div>
<!--  Fin accordion -->
</div>
<div id="vendeur">
    {if ($user->getLevelMember()->getIdLevelMember() < 3 OR
    $user->getIdUser() eq $mandate->getUser()->getIdUser()) AND
    $mandate->getEtap()->getIdMandateEtap() eq Constant::ID_ETAP_TO_SELL}
        <p>
            <a
                    href="{Tools::create_url($user,$smarty.get.module,'add_new_seller_for_mandate',$mandate->getIdMandate())}" class="btn btn-default"><i class="fa fa-pencil-square-o"></i> Affecter
                un autre vendeur</a>
        </p>
    {/if}

    <table class="dataTableDefault table table-striped table-bordered">
        <thead>
        <tr>
            <th>Nom</th>
            <th>Adresse</th>
            <th>Coordonnées</th>
            <th>Principal</th>
            <th>Actions</th>

        </tr>
        </thead>
        <tbody>
        {foreach from=$mandate->listSellers() item=item}
            <tr>
                <td>{$item->getName()} {$item->getFirstname()}</td>
                <td>
                    <p>{if $item->getCity()} {if $item->getCity()->getSector()}
                            {$item->getCity()->getSector()->getName()} {/if} {/if}</p>
                    <p>{$item->getAddress()}</p>

                    <p>{if $item->getCity()} {$item->getCity()->getZipCode()}
                            {$item->getCity()->getName()} {/if}</p>
                </td>
                <td>{if $item->getPhone()}
                        <p>Téléphone : {$item->getPhone()}</p>{/if}
                    {if $item->getMobilPhone()}
                        <p>Téléphone portable: {$item->getMobilPhone()}
                            <a title="Envoyer un Sms" href="{Constant::DEFAULT_URL}/modules/openmail/formFancybox/sendSms.php?{time()}&amp;dest={str_replace('+','%2B',$item->getMobilPhone())}" class="fancyboxAjax fancybox.ajax btn btn-default"> <i class="fa fa-mobile fa-2x "></i>   </a>
                        </p>
                    {/if}
                    {if $item->getWorkPhone()}
                        <p>Téléphone travail: {$item->getWorkPhone()}</p>{/if} {if
                    $item->getFax()}
                        <p>Fax : {$item->getFax()}</p>{/if} {if $item->getEmail()}
                        <p>Email : {$item->getEmail()} <a title="Envoyer un e-mail" href="{Constant::DEFAULT_URL}/modules/openmail/formFancybox/sendEmail.php?{time()}&amp;dest={$item->getEmail()}" class="fancyboxAjax fancybox.ajax btn btn-default"><i class="fa fa-paper-plane"></i></a></p>{/if}</td>
                <td>{if $item->getIsDefault()}OUI{else}NON
                       {* {if
                    $user->getLevelMember()->getIdLevelMember() < 3 OR
                    $user->getIdUser() eq $mandate->getUser()->getIdUser()}
                        <form action="" method="post">
                            <p>
                                <input type="hidden" name="idMandate"
                                       value="{$mandate->getIdMandate()}" /> <input type="hidden"
                                                                                    name="idSeller" value="{$item->getIdSeller()}" /> <input
                                        type="submit" name="sendSellerByDefault"
                                        value="Définir comme principal" />
                            </p>
                        </form> {/if}*}
                    {/if}</td>
                {*<td><a
                            href="{Tools::create_url($user,'seller','sees',$item->getIdSeller())}" title="{Lang::LABEL_SEE}"><img src="{Constant::DEFAULT_URL_PICTURE_DIRECTORY}see.png" alt="{Lang::LABEL_SEE}" /></a>
                </td>*}
                <td>
                   {* {if $user->getLevelMember()->getIdLevelMember() < 3 OR
                    $user->getIdUser() eq $mandate->getUser()->getIdUser()}
                        <form action="" method="post">
                            <p>
                                <input type="hidden" name="idMandate"
                                       value="{$mandate->getIdMandate()}" /> <input type="hidden"
                                                                                    name="idSeller" value="{$item->getIdSeller()}" /> <input
                                        type="submit" value="Supprimer l'affectation"
                                        name="delete_affectation_seller" />
                            </p>
                        </form> {else} - {/if}*}
                    <form action="" method="post">
                        <div class="btn-group">

                            <a class="btn btn-default" href="{Tools::create_url($user,'seller','sees',$item->getIdSeller())}" title="{Lang::LABEL_SEE}" {if $user->getOpenInNewTab()} target="_blank"{/if}><i class="fa fa-chevron-circle-right"></i> {Lang::LABEL_SEE} </a>

                            <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
                                <span class="caret"></span>
                                <span class="sr-only">Toggle Dropdown</span>
                            </button>

                            <ul class="dropdown-menu" role="menu">

                                {if $item->getIsDefault()}
                                    <li class="disabled"><a href="javascript:return false;" ><i class="fa fa-arrows-h"></i> Définir comme principal</a></li>
                                {else}
                                    {if $user->getLevelMember()->getIdLevelMember() < 3 OR $user->getIdUser() eq $mandate->getUser()->getIdUser()}

                                        <li>
                                            <input type="hidden" name="idMandate" value="{$mandate->getIdMandate()}" />
                                            <input type="hidden" name="idSeller" value="{$item->getIdSeller()}" />
                                            {*<input type="submit" name="sendSellerByDefault" value="Définir comme principal" class="btn btn-link-button-split" />*}


                                            <button type="submit" class="btn btn-link-button-split" name="sendSellerByDefault">
                                                <i class="fa fa-arrows-h"></i> Définir comme principal
                                            </button>
                                        </li>
                                    {else}
                                        <li class="disabled"><a href="javascript:return false;" ><i class="fa fa-arrows-h"></i> Définir comme principal</a></li>
                                    {/if}

                                {/if}



                                {if $user->getLevelMember()->getIdLevelMember() < 3 OR
                                $user->getIdUser() eq $mandate->getUser()->getIdUser()}

                                    {if $item->getIsDefault()}
                                        <li class="disabled"><a href="javascript:return false;"><i class="fa fa-trash"></i> Supprimer l'affectation</a></li>
                                    {else}
                                        <form action="" method="post">
                                            <input type="hidden" name="idMandate" value="{$mandate->getIdMandate()}" />
                                            <input type="hidden" name="idSeller" value="{$item->getIdSeller()}" />

                                            {*<input type="submit" value="Supprimer l'affectation" name="delete_affectation_seller" class="btn btn-link-button-split" />*}
                                            <button type="submit" class="btn btn-link-button-split" name="delete_affectation_seller">
                                                <i class="fa fa-trash"></i> Supprimer l'affectation
                                            </button>
                                        </form>

                                    {/if}
                                {/if}

                                {if $item->getMobilPhone() || $item->getEmail()}
                                    <li class="divider"></li>

                                    {if $item->getMobilPhone()}
                                        <li><a href="{Constant::DEFAULT_URL}/modules/openmail/formFancybox/sendSms.php?{time()}&amp;dest={str_replace('+','%2B',$item->getMobilPhone())}" class="fancyboxAjax fancybox.ajax"><i class="fa fa-mobile "></i> Envoyer un Sms</a></li>
                                    {/if}
                                    {if $item->getEmail()}
                                        <li><a href="{Constant::DEFAULT_URL}/modules/openmail/formFancybox/sendEmail.php?{time()}&amp;dest={$item->getEmail()}" class="fancyboxAjax fancybox.ajax"><i class="fa fa-paper-plane"></i> Envoyer un Email</a></li>
                                    {/if}
                                {/if}

                            </ul>

                        </div>
                    </form>
                </td>
            </tr>
        {/foreach}

        </tbody>
    </table>
    <hr class="invi clear" />
</div>
<div id="plans">
    {* error plans*}
    {if $errorPlan} {foreach from=$errorPlan item=item name=e} {if
    $smarty.foreach.e.first}
        <div class="alert alert-danger" role="alert">
        <ul>
    {/if}
        <li class="error">{$item}</li> {if $smarty.foreach.e.last}
            </ul>
        {/if} {/foreach}
        </div>
    {/if}
    {if ($user->getLevelMember()->getIdLevelMember() < 3 OR
    $user->getIdUser() eq $mandate->getUser()->getIdUser()) AND
    $mandate->getEtap()->getIdMandateEtap() eq Constant::ID_ETAP_TO_SELL}
        <form
                action="{Tools::create_url($user,$smarty.get.module,$smarty.get.page,$mandate->getIdMandate())}"
                method="post" enctype="multipart/form-data" class="form-inline" role="form">
            <div class="form-group">
                <label for="newPlan">Ajouter un plan :</label>
                <input type="file" name="newPlan" id="newPlan" />
                </div>
            <div class="form-group">
                <input type="submit" value="Envoyer" id="sendPlanForMandate" name="sendPlanForMandate"  class="btn btn-default"/>
                </div>
            </p>
        </form>
    {/if}
    <p></p>
    <p></p>
    <table class="dataTableDefault2 table table-striped table-bordered">
        <thead>
        <tr>
            <th>Aperçu</th>
            <th>Lien</th>
            <th>Supprimer</th>
        </tr>
        </thead>
        <tbody>
        {foreach from=$mandate->listPlan() item=item}
            <tr>
                <td><img src="{if !strpos($item->getName(), '.pdf')} {Constant::DEFAULT_URL_PICTURE_MODULE_DIRECTORY}/{$smarty.get.module}/thumb/{$item->getName()}{else}{Constant::DEFAULT_URL_PICTURE_DIRECTORY}logoPdf.png{/if}" alt="" /></td>
                <td><a
                            href="{Constant::DEFAULT_URL_PICTURE_MODULE_DIRECTORY}/{$smarty.get.module}/{$item->getName()}"
                            target="_blank" class="btn btn-default"><i class="fa fa-download"></i> Télécharger ( {$item->getCode()} )</a></td>
                <td>{if $user->getLevelMember()->getIdLevelMember() < 3 OR
                    $user->getIdUser() eq $mandate->getUser()->getIdUser()}
                        <form action="" method="post">

                                <input type="hidden" name="idMandate"
                                       value="{$mandate->getIdMandate()}" />
                                <input type="hidden" name="idPlan" value="{$item->getIdMandateScan()}" />
                                <button type="submit" class="btn btn-danger" name="delete_plan">
                                    <i class="fa fa-trash"></i> Supprimer le plan
                                </button>

                        </form> {else} - {/if}</td>
            </tr>
        {/foreach}
        </tbody>
    </table>
</div>
<div id="fichiers">{include file="tpl_default/hook.tpl"
    position="hook_files"}</div>
<div id="impressions">{include file="tpl_default/hook.tpl" position="hook_imp"}</div>
{include file="tpl_default/hook.tpl" position="hook_acq"}
</div>
<!--  fin tabs -->



<!-- 
	<div id="tabs">
	<ul>
		<li><a href="#tabs-2">Localisation</a></li>
		<li><a href="#tabs-1">Général</a></li>
		<li><a href="#tabs-3">Prix</a></li>
		<li><a href="#tabs-4">Superficie</a></li>
		<li><a href="#tabs-5">Réglementation</a></li>
		<li><a href="#tabs-6">Autorisation</a></li>
		<li><a href="#tabs-7">Viabilisation</a></li>
		<li><a href="#tabs-8">Description</a></li>
		<li><a href="#tabs-9">Cadastre</a></li>
	</ul>
	


{* <h2>Localisation</h2> *}
<div id="tabs-2">
	<div class="mSep">
<p>Secteur : {$mandate->getCity()->getSector()->getName()}</p>
<p>Adresse : {$mandate->getAddress()}</p>
<p>Ville : {$mandate->getCity()->getName()}</p>
<p>Code Postal : {$mandate->getCity()->getZipCode()}</p>
{* <h2>Cadastre : </h2> *}
{if $mandate->getGeolocalisation()}
	{assign var="geo" value=explode(',',$mandate->getGeolocalisation())}
<p>Latitude : <span id="latitude">{$geo.0}</span> </p>
<p>Longitude : <span id="longitude">{$geo.1}</span></p>
	{/if}
</div>

{if $mandate->getGeolocalisation()}
	<div class="mSep">
	<p>Geoloc : </p>
	
	<div id="map">
	</div>

</div>

	{/if}
<hr class="invi clear" />
</div>

{* <h2>Général : </h2>  *}
<div id="tabs-1">
<p>Utilisateur affecté : {$mandate->getUser()->getName()} {$mandate->getUser()->getFirstname()}</p>
<p>Nature du bien : {if $mandate->getNature()==null}NC{else}{$mandate->getNature()->getName()}{/if}</p>
<p>Notaire : {$mandate->getNotary()->getName()}</p>
<p>N° Mandat : {$mandate->getNumberMandate()}</p>
<p>Début : {date(Constant::DATE_FORMAT2,$mandate->getInitDate())}</p>
<p>Fin : {if date(Constant::DATE_FORMAT2,$mandate->getDeadDate()) eq '01/01/1970'} NC {else}{date(Constant::DATE_FORMAT2,$mandate->getDeadDate())}{/if}</p>
<p>libre le : {if $mandate->getFreeDate()==null} NC {else}{date(Constant::DATE_FORMAT2,$mandate->getFreeDate())}{/if}</p>
</div>

<div id="tabs-3">
{*<h2>Prix : </h2>*}
	
<p>Prix FAI : {Tools::grosNombre(round($mandate->getPriceFAI(),0))} &euro;</p>
<p>Prix net vendeur : {Tools::grosNombre(round($mandate->getPriceSeller(),0))} &euro;</p>
<p>Commission : {Tools::grosNombre(round($mandate->getCommission(),0))} &euro;</p>
<p>Estimation FAI : {Tools::grosNombre(round($mandate->getEstimationFai(),0))} &euro;</p>
<p>Marge negoce : {Tools::grosNombre(round($mandate->getMargeNegociation(),0))} &euro;</p>
</div>

{* Début *}
<div id="tabs-4">
		{*  <h2>Superficie</h2>*}
			<p>Superficie parcelle 1 :{if $mandate->getSuperficieParcelle1() eq 0}NC{else} {$mandate->getSuperficieParcelle1()}{/if}</p>
			<p>Superficie parcelle 2 :{if $mandate->getSuperficieParcelle2() eq 0}NC{else} {$mandate->getSuperficieParcelle2()}{/if}</p>
			<p>Superficie parcelle 3 : {if $mandate->getSuperficieParcelle3() eq 0}NC{else}{$mandate->getSuperficieParcelle3()}{/if}</p>
			<p>Superficie autres parcelle : {if $mandate->getSuperficieAutreParcelle() eq 0}NC{else}{$mandate->getSuperficieAutreParcelle()}{/if}</p>
			<p>Superficie constructible : {if $mandate->getSuperficieConstructible() eq 0}NC{else}{$mandate->getSuperficieConstructible()}{/if}  </p>
			<p>Superficie non constructible :  {if $mandate->getSuperficieNonConstructible() eq 0}NC{else}{$mandate->getSuperficieNonConstructible()}{/if}</p>
			<p>Superficie totale : {if $mandate->getSuperficieTotale() eq 0}NC{else}{$mandate->getSuperficieTotale()}{/if}</p>
			<p>géometre : {if $mandate->getGeometer()}{$mandate->getGeometer()->getName()}{else}NC{/if} </p>
			<p>Bornage : {if $mandate->getBornageTerrain()}{$mandate->getBornageTerrain()->getName()}{else}NC{/if}</p>
</div>
		{*<h2>Réglementation</h2>*}
		<div id="tabs-5">
			<p>Zonage PLU : {if $mandate->getZonagePlu()}{$mandate->getZonagePlu()->getName()}{else}NC{/if}</p>
			<p>Zonage RNU : {if $mandate->getZonageRnu()}{$mandate->getZonageRnu()->getName()}{else}NC{/if}</p> 
			<p>COS : {if $mandate->getCOS()}{$mandate->getCOS()->getName()}{else}NC{/if}</p>
			<p>Shon accordée : {$mandate->getsHONAccordee()}   </p>
			<p>Zone BDF : {if $mandate->getZoneBDF() eq 0}NON{else}OUI{/if}</p>
			<p>Ligne de crete : {if $mandate->getLigneDeCrete() eq 0}NON{else}OUI{/if}</p>
			<p>zone inondable : {if $mandate->getZoneInondable() eq 0}NON{else}OUI{/if}</p>
			<p>Réglement lotissement : {if $mandate->getReglementDeLotissement()} <br/>{$mandate->getReglementDeLotissement()}{/if}</p>
			<p>ERNT : {if $mandate->getERNT()}<br/>{$mandate->getERNT()}{/if}</p>
			</div>
		{*<h2>Autorisation</h2>*}
		<div id="tabs-6">
			<p>DP valide :  {if $mandate->getDPValide()}Oui{else}Non{/if}</p>
			<p>Date déclaration préalable : {if $mandate->getDateDeclarationPrealable()}{date(Constant::DATE_FORMAT2,$mandate->getDateDeclarationPrealable())}{else}NC{/if}</p>
			<p>Prorogation DP jusqu'au :{if $mandate->getProrogationDPJusquau()}{date(Constant::DATE_FORMAT2,$mandate->getProrogationDPJusquau())}{else}NC{/if}</p>
			<p>CU valide :  {if $mandate->getCuValide()}Oui{else}Non{/if}</p>
			<p>Date déclaration préalable :  {if $mandate->getDateCu()}{date(Constant::DATE_FORMAT2,$mandate->getDateCu())}{else}NC{/if}</p>
			<p>Prorogation CU jusqu'au : {if $mandate->getProrogationCUJusquau()}{date(Constant::DATE_FORMAT2,$mandate->getProrogationCUJusquau())}{else}NC{/if}</p>
			<p>CU Ops valide : {if $mandate->getCuOpsValide()}Oui{else}Non{/if}</p>
			<p>Date déclaration préalable : {if $mandate->getDateCuOps()}{date(Constant::DATE_FORMAT2,$mandate->getDateCuOps())}{else}NC{/if}</p>
			<p>Prorogation CU Ops jusqu'au : {if $mandate->getProrogationCUOpsJusquau()}{date(Constant::DATE_FORMAT2,$mandate->getProrogationCUOpsJusquau())}{else}NC{/if}</p>
			<p>Permis d'amenager valide : {if $mandate->getPermisDamenagerValide()}Oui{else}Non{/if}</p>
			<p>Date de permis d'amenager : {if $mandate->getDatePermisDamenager()}{date(Constant::DATE_FORMAT2,$mandate->getDatePermisDamenager())}{else}NC{/if}</p>
			</div>
		{*<h2>Viabilisation</h2>*}
		<div id="tabs-7">
			<p>Terrain vendu viabilisé : {if $mandate->getTerrainVenduViabilise()}Oui{else}Non{/if}</p>
			<p>Terrain vendu semi viabilisé : {if $mandate->getTerrainVenduSemiViabilise()}Oui{else}Non{/if}</p>
			<p>Terrain vendu non viabilisé :   {if $mandate->getTerrainVenduNonViabilise()}Oui{else}Non{/if}</p>
			<p>Passage eau : {if $mandate->getPassageEau()}<br/>{$mandate->getPassageEau()}{/if}</p>
			<p>Correspondant eau : {if $mandate->getWaterCorresponding()}{$mandate->getWaterCorresponding()->getName()}{else}NC{/if}</p>
			<p>Passage éléctricité : {if $mandate->getPassageElectricite()}<br/>{$mandate->getPassageEau()}{/if}</p>
			<p>Correspondant electrique : {if $mandate->getElectricCorresponding()}{$mandate->getElectricCorresponding()->getName()}{else}NC{/if}</p>
			<p>Passage gaz : {if $mandate->getPassageGaz()}<br/>{$mandate->getPassageGaz()}{/if}</p>
			<p>Correspondant gaz :  {if $mandate->getGazCorresponding()}{$mandate->getGazCorresponding()->getName()}{else}NC{/if}</p>
			<p>Tout à l'égout :  {if $mandate->getToutALegout()}Oui{else}Non{/if}</p>
			<p>Assainissement par fosse sceptique : {if $mandate->getAssainissementParFosseSceptique()}Oui{else}Non{/if}</p> 
			<p>Correspondant sanitaire :   {if $mandate->getSanitationCorresponding()}{$mandate->getSanitationCorresponding()->getName()}{else}NC{/if}</p>
			<p>Voirie :  {if $mandate->getVoirie()}<br/>{$mandate->getVoirie()}{/if}</p>
				</div>							
		{*<h2>Description</h2>*}
		<div id="tabs-8">
			<p>Orientation : {if $mandate->getOrientation()}{$mandate->getOrientation()->getName()}{else}NC{/if}</p> 
			<p>Pente :  {if $mandate->getSlope()}{$mandate->getSlope()->getName()}{else}NC{/if}</p>
			
	<p>Taille de la façade : {if $mandate->getTailleFacade()}{$mandate->getTailleFacade()}{else}NC{/if}</p>
	<p>Profondeur du terrain : {if $mandate->getProfondeurTerrain()}{$mandate->getProfondeurTerrain()}{else}NC{/if}</p>
	
	{if $mandate->getCommentaire()}<p>Commentaires : <br/>{$mandate->getCommentaire()}</p>{/if}
	
	<p>Proximité école : {if $mandate->getProximiteEcole() eq 0}NC{else}{$mandate->getProximiteEcole()} {/if}</p>
	<p>Proximité commerce : {if $mandate->getProximiteCommerce() eq 0}NC{else}{$mandate->getProximiteCommerce()} {/if}</p>
	<p>Proximité transport :{if $mandate->getProximiteTransport() eq 0}NC{else}{$mandate->getProximiteTransport()} {/if}</p>
	{if $mandate->getCommentaireApparent()}<p>Texte vitrine (et Internet)  : {$mandate->getCommentaireApparent()}</p>{/if}
	</div>
	<div id="tabs-9">	
		<p>Ref cadastre parcelle 1 : {$mandate->getReferenceCadastreParcelle1()}</p>
		<p>Ref cadastre parcelle 2 : {$mandate->getReferenceCadastreParcelle2()} </p>
		<p>Ref cadastre parcelle 3 : {$mandate->getReferenceCadastreParcelle3()} </p>
		<p>Autre ref cadastre :  {$mandate->getAutreReferenceParcelle()}</p>
		<p>Numéro de lot : {$mandate->getNumberLot()}</p>
	</div>
	
</div> 
{* Fin  *}
<h1>Vendeurs : </h1>
{if ($user->getLevelMember()->getIdLevelMember() < 3 OR $user->getIdUser() eq $mandate->getUser()->getIdUser()) AND $mandate->getEtap()->getIdMandateEtap() eq Constant::ID_ETAP_TO_SELL}
	<p><a href="{Tools::create_url($user,$smarty.get.module,'add_new_seller_for_mandate',$mandate->getIdMandate())}">Affecter un autre vendeur</a></p>
	{/if}

<table class="standard">
	<thead>
		<tr>
			<th>Nom</th>
			<th>Adresse</th>
			<th>Coordonnées</th>
			<th>Principal</th>
			<th>Supprimer l'affectation</th>
		</tr>
	</thead>
	<tbody>
		{foreach from=$mandate->listSellers() item=item}
			<tr>
				<td>{$item->getName()} {$item->getFirstname()}</td>
				<td>
					<p>{if $item->getCity()}
						{if $item->getCity()->getSector()}
						{$item->getCity()->getSector()->getName()}
						{/if}
						{/if}
						</p>
					<p>{$item->getAddress()}</p>
					
					<p>
						{if $item->getCity()}
						{$item->getCity()->getZipCode()} {$item->getCity()->getName()}
						{/if}
						</p>
					</td>
				<td>
					{if $item->getPhone()}<p>Téléphone : {$item->getPhone()}</p>{/if}
					{if $item->getMobilPhone()}<p>Téléphone portable: {$item->getMobilPhone()}</p>{/if}
					{if $item->getWorkPhone()}<p>Téléphone travail: {$item->getWorkPhone()}</p>{/if}
					{if $item->getFax()}<p>Fax : {$item->getFax()}</p>{/if}
					{if $item->getEmail()}<p>Email : {$item->getEmail()}</p>{/if}
				</td>
				<td>
					{if $item->getIsDefault()}OUI{else}NON
						{if $user->getLevelMember()->getIdLevelMember() < 3 OR $user->getIdUser() eq $mandate->getUser()->getIdUser()}
							<form action="" method="post">
							<p>
							<input type="hidden" name="idMandate" value="{$mandate->getIdMandate()}"/>
							<input type="hidden" name="idSeller" value="{$item->getIdSeller()}"/>
							<input type="submit" name="sendSellerByDefault" value="Définir comme principal"/>
							</p>
						</form>
	{/if}
					{/if}  
					</td>
				<td>
				{if $user->getLevelMember()->getIdLevelMember() < 3 OR $user->getIdUser() eq $mandate->getUser()->getIdUser()}	
				<form action="" method="post">
					<p>
					<input type="hidden" name="idMandate" value="{$mandate->getIdMandate()}"/>
					<input type="hidden" name="idSeller" value="{$item->getIdSeller()}"/>
					<input type="submit" value="Supprimer l'affectation" name="delete_affectation_seller"/>
					</p>
				</form>
					{else}
					-
					{/if}
				</td>
			</tr>
			{/foreach}
		
	</tbody>
</table>
<h1>Photos : </h1>
{if $errorPicture}
	<ul>
		{foreach from=$errorPicture item=e}
				<li class="error">{$e}</li>
		{/foreach}
	</ul>
	{/if}
{if ($user->getLevelMember()->getIdLevelMember() < 3 OR $user->getIdUser() eq $mandate->getUser()->getIdUser()) AND $mandate->getEtap()->getIdMandateEtap() eq Constant::ID_ETAP_TO_SELL}
	<form action="{Tools::create_url($user,$smarty.get.module,$smarty.get.page,$mandate->getIdMandate())}" method="post"  enctype="multipart/form-data">
		<input type="hidden" id="idMandate" name="idMandate" value="{$mandate->getIdmandate()}"/>
		<input type="hidden" id="idSess" name="idSess" value="{str_rot13(session_id())}"/>
		<p class="uploadMultiple">
			<label for="newPicture">Ajouter une photo : <input type="file" name="newPicture" id="newPicture"/></label>
			<label for="isDefaultPicture">Image par defaut ?<input type="checkbox" name="isDefaultPicture" id="isDefaultPicture"/></label>
			<input type="submit" value="Envoyer" id="sendPictureForMandate" name="sendPictureForMandate" />
		</p>
	</form>	
{/if}
<table class="standard">
	<thead>
		<tr>
			<th>Image</th>
			<th>Principale</th>
			<th>Supprimer</th>
		</tr>
	</thead>
	<tbody>
{foreach from=$mandate->listPictures() item=item}
<tr>
	<td><img src="{Constant::DEFAULT_URL_PICTURE_MODULE_DIRECTORY}/{$smarty.get.module}/thumb/{$item->getName()}" alt=""/></td>
	<td>	{if $item->getIsDefault()}OUI{else}<p>NON</p>
	{if $user->getLevelMember()->getIdLevelMember() < 3 OR $user->getIdUser() eq $mandate->getUser()->getIdUser()}
	<form action="" method="post">
		<p>
		<input type="hidden" name="idMandate" value="{$mandate->getIdMandate()}"/>
		<input type="hidden" name="idPicture" value="{$item->getIdMandatePicture()}"/>
		<input type="submit" name="sendPictureByDefault" value="Définir comme principale"/>
		</p>
	</form>
	{/if}
	{/if} 
	 </td>
	<td>
						{if ($user->getLevelMember()->getIdLevelMember() < 3 OR $user->getIdUser() eq $mandate->getUser()->getIdUser()) AND $mandate->getEtap()->getIdMandateEtap() eq Constant::ID_ETAP_TO_SELL}	
				<form action="" method="post">
					<p>
					<input type="hidden" name="idMandate" value="{$mandate->getIdMandate()}"/>
					<input type="hidden" name="idPicture" value="{$item->getIdMandatePicture()}"/>
					<input type="submit" value="Supprimer l'image" name="delete_picture"/>
					</p>
				</form>
					{else}
					-
					{/if}
	</td>
</tr>
{/foreach}
</tbody>
</table>
<h1>Liste des plans</h1>
{if ($user->getLevelMember()->getIdLevelMember() < 3 OR $user->getIdUser() eq $mandate->getUser()->getIdUser()) AND $mandate->getEtap()->getIdMandateEtap() eq Constant::ID_ETAP_TO_SELL}
	<form action="{Tools::create_url($user,$smarty.get.module,$smarty.get.page,$mandate->getIdMandate())}" method="post"  enctype="multipart/form-data">
		<p>
			<label for="newPlan">Ajouter un plan : <input type="file" name="newPlan" id="newPlan"/></label>
			<input type="submit" value="Envoyer" id="sendPlanForMandate" name="sendPlanForMandate" />
		</p>
	</form>	
{/if}
<table class="standard">
	<thead>
		<tr>
			<th>Aperçu</th>
			<th>Lien</th>
			<th>Supprimer</th>
		</tr>
	</thead>
	<tbody>
		{foreach from=$mandate->listPlan() item=item}
			<tr>
				<td><img src="{Constant::DEFAULT_URL_PICTURE_MODULE_DIRECTORY}/{$smarty.get.module}/thumb/{$item->getName()}" alt=""/></td>
				<td><a href="{Constant::DEFAULT_URL_PICTURE_MODULE_DIRECTORY}/{$smarty.get.module}/{$item->getName()}" target="_blank">Télécharger ( {$item->getCode()} )</a></td>
					<td>
						{if $user->getLevelMember()->getIdLevelMember() < 3 OR $user->getIdUser() eq $mandate->getUser()->getIdUser()}	
				<form action="" method="post">
					<p>
					<input type="hidden" name="idMandate" value="{$mandate->getIdMandate()}"/>
					<input type="hidden" name="idPlan" value="{$item->getIdMandateScan()}"/>
					<input type="submit" value="Supprimer le plan" name="delete_plan"/>
					</p>
				</form>
					{else}
					-
					{/if}
	</td>
			</tr>
			{/foreach}
		
	</tbody>
</table>

{include file="tpl_default/hook.tpl" position="hook_bottom"}
 -->
</div>
