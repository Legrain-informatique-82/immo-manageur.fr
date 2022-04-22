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
        <h1 class="h2">Fiche du mandat n°{$mandate->getNumberMandate()} de type : {$mandate->getMandateType()->getName()}</h1>
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
		<div class="accordion" rel="2">
			<h2 rel="gen">
				<a href="#" rel="gen">Général</a>
			</h2>
			<div>
				{if ($user->getLevelMember()->getIdLevelMember() < 3 OR
				$user->getIdUser() eq $mandate->getUser()->getIdUser() )}
				{* AND
				$mandate->getEtap()->getIdMandateEtap() eq
				Constant::ID_ETAP_TO_SELL*}
				<p>
					<a href="{Tools::create_url($user,$smarty.get.module,'updateGen',$smarty.get.action)}" class="btn btn-default"><i class="fa fa-pencil-square-o"></i> Modifier les informations</a>
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
                    </div></div></div>
                    <div class="col-md-3">

                        <div class="panel panel-default">

                            <div class="panel-heading">Général :</div>
                            <div class="panel-body">
    <!-- 				<div class="bulle"> -->

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
                        <dt>Type de bien :</dt> <dd>{$mandate->getMandateType()->getName()}</dd>
                                    </dl>
                        </div></div></div>
    <!-- 				</div> -->

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

                        <dt>Numéro lot :</dt><dd>{if $mandate->getNumberLot()} {$mandate->getNumberLot()}{else}NC{/if}</dd>
                                    </dl>
                    </div></div></div>
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
                                        <dt>Loyer (si locataires) :</dt><dd> {if $mandate->getRental() eq null}NC{else}{round($mandate->getRental())} &euro;{/if}</dd>
                        {else}
                                        <dt>Loyer + frais d'agence :</dt><dd>
                            {Tools::grosNombre(round($mandate->getPriceFAI(),0))} &euro;</dd>
                                        <dt>Loyer :</dt><dd> {Tools::grosNombre(round($mandate->getPriceSeller(),0))}
                            &euro;</dd>
                                    <dt>Commission :</dt><dd>
                            {Tools::grosNombre(round($mandate->getCommission(),0))} &euro;</dd>
                        {/if}
                                    <dt>Rentabilité :</dt><dd> {if $mandate->getProfitability() eq null}NC{else}{$mandate->getProfitability()} %{/if}</dd>
                                    <dt>Prix garage :</dt><dd> {if $mandate->getPriceGarage() eq null}NC{else}{round($mandate->getPriceGarage())}{/if}</dd>
                                    <dt>Prix cave :</dt><dd> {if $mandate->getPriceCellar() eq null}NC{else}{round($mandate->getPriceCellar())}{/if}</dd>
                                    </dl>
    <!-- 					</div> -->
                    </div></div></div>

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
				<a href="#desc">Infos</a>
			</h3>
			<div>
				{if ($user->getLevelMember()->getIdLevelMember() < 3 OR
				$user->getIdUser() eq $mandate->getUser()->getIdUser() ) AND
				$mandate->getEtap()->getIdMandateEtap() eq
				Constant::ID_ETAP_TO_SELL}
				<p>
					<a
						href="{Tools::create_url($user,$smarty.get.module,'updateDesc',$smarty.get.action)}" class="btn btn-default"><i class="fa fa-pencil-square-o"></i> Modifier
						les infos/descriptions</a>
				</p>
				{/if}

            <div class="row">
				<div class="col-md-4">
				
				
					<table class="table table-bordered table-striped">
					
					<tr>
							<td class="gauche">Numéro garage</td>
							<td class="droite">{if $mandate->getNumberGarage() eq null OR  $mandate->getNumberGarage() eq ''}NC{else}{$mandate->getNumberGarage()}{/if}</td>
						</tr>
						<tr>
							<td class="gauche">Numéro  cave</td>
							<td class="droite">{if $mandate->getNumberCellar() eq null OR  $mandate->getNumberCellar() eq ''}NC{else}{$mandate->getNumberCellar()}{/if}</td>
						</tr>
						<tr>
							<td class="gauche">Numéro parking</td>
							<td class="droite">{if $mandate->getNumberParking() eq null OR  $mandate->getNumberParking() eq ''}NC{else}{$mandate->getNumberParking()}{/if}</td>
						</tr>
						<tr>
							<td class="gauche">Numéro grenier</td>
							<td class="droite">{if $mandate->getNumberAttic() eq null OR  $mandate->getNumberAttic() eq ''}NC{else}{$mandate->getNumberAttic()}{/if}</td>
						</tr>
					
					
					
					
					
						<tr>
							<td class="gauche">Nombre de pièces</td>
							<td class="droite">{$mandate->getNbPiece()}</td>
						</tr>
						<tr>
							<td class="gauche">Nombre de chambres</td>
							<td class="droite">{$mandate->getNbChambre()}</td>
						</tr>
						<tr>
							<td class="gauche">Superficie terrain</td>
							<td class="droite">{if $mandate->getSuperficieTotale() eq
								0}NC{else}{$mandate->getSuperficieTotale()}{/if}</td>
						</tr>
						<tr>
							<td class="gauche">Surface habitable</td>
							<td class="droite">{$mandate->getSurfaceHabitable()}</td>
						</tr>
						<tr>
							<td class="gauche">Surface pièce vie</td>
							<td class="droite">{$mandate->getSurfacePieceVie()}</td>
						</tr>
						<tr>
							<td class="gauche">Niveau</td>
							<td class="droite">{$mandate->getNiveau()}</td>
						</tr>
						<tr>
							<td class="gauche">Année construction</td>
							<td class="droite">{if
								$mandate->getAnneeConstruction()==0}NC{else}{$mandate->getAnneeConstruction()}{/if}</td>
						</tr>
						<tr>
							<td class="gauche">Charges mensuelles</td>
							<td class="droite">{$mandate->getChargesMensuelle()}</td>
						</tr>
						<tr>
							<td class="gauche">Taxes foncières</td>
							<td class="droite">{$mandate->getTaxesFonciere()}</td>
						</tr>
						<tr>
							<td class="gauche">Taxes Habitation</td>
							<td class="droite">{$mandate->getTaxeHabitation()}</td>
						</tr>

					</table>
					
				</div>
                <div class="col-md-4">

                    <table class="table table-bordered table-striped">
											<tr>
							<td class="gauche">Cheminée</td>
							<td class="droite">{if $mandate->getCheminee() eq
								1}Oui{else}Non{/if}</td>
						</tr>
						<tr>
							<td class="gauche">Cuisine équipée</td>
							<td class="droite">{if $mandate->getCuisineEquipee() eq
								1}Oui{else}Non{/if}</td>
						</tr>
						<tr>
							<td class="gauche">Cuisine amenagée</td>
							<td class="droite">{if $mandate->getCuisineAmenagee() eq
								1}Oui{else}Non{/if}</td>
						</tr>
						<tr>
							<td class="gauche">Piscine</td>
							<td class="droite">{if $mandate->getPiscine() eq
								1}Oui{else}Non{/if}</td>
						</tr>
						<tr>
							<td class="gauche">Piscine intérieure</td>
							<td class="droite">{if $mandate->getPoolHouse() eq
								1}Oui{else}Non{/if}</td>
						</tr>
						<tr>
							<td class="gauche">Terrasse</td>
							<td class="droite">{if $mandate->getTerrasse() eq
								1}Oui{else}Non{/if}</td>
						</tr>
						<tr>
							<td class="gauche">Mezzanine</td>
							<td class="droite">{if $mandate->getMezzanine() eq
								1}Oui{else}Non{/if}</td>
						</tr>
						<tr>
							<td class="gauche">Dépendance</td>
							<td class="droite">{if $mandate->getDependance() eq
								1}Oui{else}Non{/if}</td>
						</tr>
						<tr>
							<td class="gauche">Gaz</td>
							<td class="droite">{if $mandate->getGaz() eq 1}Oui{else}Non{/if}</td>
						</tr>

						<tr>
							<td class="gauche">Cave</td>
							<td class="droite">{if $mandate->getCave() eq 1}Oui{else}Non{/if}</td>
						</tr>
						<tr>
							<td class="gauche">Sous sol</td>
							<td class="droite">{if $mandate->getSousSol() eq
								1}Oui{else}Non{/if}</td>
						</tr>
						<tr>
							<td class="gauche">Garage</td>
							<td class="droite">{if $mandate->getGarage() eq
								1}Oui{else}Non{/if}</td>
						</tr>
						<tr>
							<td class="gauche">Parking</td>
							<td class="droite">{if $mandate->getParking() eq
								1}Oui{else}Non{/if}</td>
						</tr>
						<tr>
							<td class="gauche">Rez de jardin</td>
							<td class="droite">{if $mandate->getRezDeJardin() eq
								1}Oui{else}Non{/if}</td>
						</tr>
					</table>
				</div>
                <div class="col-md-4">
                    <table class="table table-bordered table-striped">
						<td class="gauche">Tout à l'égout</td>
							<td class="droite">{if $mandate->getToutALegout() eq
								1}Oui{else}Non{/if}</td>
						</tr>
						<tr>
							<td class="gauche">Plain pied</td>
							<td class="droite">{if $mandate->getPlainPied() eq
								1}Oui{else}Non{/if}</td>
						</tr>
						<tr>
							<td class="gauche">Carrière</td>
							<td class="droite">{if $mandate->getCarriere() eq
								1}Oui{else}Non{/if}</td>
						</tr>
						<tr>
							<td class="gauche">Point eau</td>
							<td class="droite">{if $mandate->getPointEau() eq
								1}Oui{else}Non{/if}</td>
						</tr>
						<tr>
							<td class="gauche">Isolation</td>
							<td class="droite">{if
								$mandate->getInsulation()}{$mandate->getInsulation()->getName()}{else}Non
								spécifié{/if}</td>
						</tr>
						<tr>
							<td class="gauche">Toiture</td>
							<td class="droite">{if
								$mandate->getRoof()}{$mandate->getRoof()->getName()}{else}Non
								spécifié{/if}</td>
						</tr>
						<tr>
							<td class="gauche">Chauffage</td>
							<td class="droite">{if
								$mandate->getHeating()}{$mandate->getHeating()->getName()}{else}Non
								spécifié{/if}</td>
						</tr>
						<tr>
							<td class="gauche">Parties communes</td>
							<td class="droite">{if
								$mandate->getCommonOwnership()}{$mandate->getCommonOwnership()->getName()}{else}Non
								spécifié{/if}</td>
						</tr>
						
						<tr>
							<td class="gauche">Type de construction</td>
							<td class="droite">{if
								$mandate->getConstruction()}{$mandate->getConstruction()->getName()}{else}Non
								spécifié{/if}</td>
						</tr>
						<tr>
							<td class="gauche">Style</td>
							<td class="droite">{if
								$mandate->getStyle()}{$mandate->getStyle()->getName()}{else}Non
								spécifié{/if}</td>
						</tr>
						<tr>
							<td class="gauche">Nouveautés</td>
							<td class="droite">{if
								$mandate->getNews()}{$mandate->getNews()->getName()}{else}Non
								spécifié{/if}</td>
						</tr>
						<tr>
							<td class="gauche">Conditions</td>
							<td class="droite">{if
								$mandate->getCondition()}{$mandate->getCondition()->getName()}{else}Non
								spécifié{/if}</td>
						</tr>
						<tr>
							<td class="gauche">Mitoyenneté : </td>
							<td class="droite">{if
								$mandate->getMandateAdjoining()}{$mandate->getMandateAdjoining()->getName()}{else}Non
								spécifié{/if}</td>
						</tr>
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
				<a href="#dpe">DPE</a>
			</h3>
			<div>
                {if
                ($user->getLevelMember()->getIdLevelMember() < 3 OR
                $user->getIdUser() eq $mandate->getUser()->getIdUser() ) AND
                $mandate->getEtap()->getIdMandateEtap() eq
                Constant::ID_ETAP_TO_SELL}
                    <p>
                        <a
                                href="{Tools::create_url($user,$smarty.get.module,'updateDpe',$smarty.get.action)}" class="btn btn-default">
                            <i class="fa fa-pencil-square-o"></i> Modifier les infos DPE</a>
                    </p>
                {/if}
				{include file="tpl_default/hook.tpl" position="hook_center"}
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

            </div></div>
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
					<td>{if $item->getIsDefault()}OUI{else}NON  {/if} </td>
					<td>

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

	</div>
	<div id="plans">
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
                <input type="submit" value="Envoyer" id="sendPlanForMandate" name="sendPlanForMandate" class="btn btn-default" />
            </div>
		</form>
		{/if}
        <p ></p>
        <p ></p>
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
									value="{$mandate->getIdMandate()}" /> <input type="hidden"
									name="idPlan" value="{$item->getIdMandateScan()}" />

                            <button type="submit" class="btn btn-danger" name="delete_plan">
                                <i class="fa fa-trash"></i> Supprimer le plan
                            </button>

						</form> {else} - {/if}</td>
				</tr>
				{/foreach}
			</tbody>
		</table>
	</div>
	<div id="fichiers">{include file="tpl_default/hook.tpl" position="hook_files"}</div>
	<div id="impressions">{include file="tpl_default/hook.tpl" position="hook_imp"}</div>
	{include file="tpl_default/hook.tpl" position="hook_acq"}

</div>
{include file="tpl_default/hook.tpl" position="hook_bottom"}
</div>
