{include file="tpl_default/entete.tpl"}

<div class="row bg-success bannerTitle">
    <div class="col-md-7">
        <h1 class="h2">Rapprocher des mandats pour : {$acq->getFirstname()} {$acq->getName()}</h1>
    </div>

    <div class="col-md-5">
        <p class="h4 text-right ">
            <a title="Ajouter un rapprochement" class="btn btn-default" href="{Tools::create_url($user,"rapprochement","list")}">
                <i class="fa fa-close fa-2x"></i>
            </a>
        </p>
    </div>
</div>

<div class="panel panel-default">
    <div class="panel-heading">Critères</div>
    <div class="panel-body">




        <p>Type de transaction : {$acq->getTransactionType()->getName()}</p>
        <p>Type de bien : {if
            $acq->getMandateType()}{$acq->getMandateType()->getName()}{else}Indifferent{/if}</p>
        <p>Style : {if
            $acq->getMandateStyle()}{$acq->getMandateStyle()->getName()}{else}Indifferent{/if}</p>
        <p>Prix compris entre {$acq->getPriceMin()} et {$acq->getPriceMax()} €.</p>
        <p>Surface de terrain entre {$acq->getSurfaceTerrainMin()} et
            {$acq->getSurfaceTerrainMax()} m²</p>
        <p>Surface habitable entre {$acq->getSurfaceHabitableMin()} et
            {$acq->getSurfaceHabitableMax()} m²</p>
        <p>Secteur souhaité : {if
            $acq->getRechercheSector()}{$acq->getRechercheSector()->getName()}{else}Indifferent{/if}</p>
        <p>Ville souhaitée : {if
            $acq->getRechercheCity()}{$acq->getRechercheCity()->getName()}{else}Indifferent{/if}</p>
    </div>
</div>
<form action="" method="post" class="form-horizontal">

    <div class="row bg-success bannerTitle">
        <div class="col-md-7">
            <h1 id="h2Change" class="h2">{$h2}</h1>
        </div>

        <div class="col-md-5">
            <div class="h4 text-right ">
                <div class="form-group checkbox">
                    <label for="allMandat" class="checkbox">
                        <input
                                type="checkbox" rel="{$acq->getIdAcquereur()}" name="allMandat"
                                {if $allMandat eq 'on'}  checked="checked" {/if}  id="allMandat" />
                        Afficher tous les mandats
                    </label>
                    <input class="jsNone" type="submit" value="Ok" />
                </div>
            </div>
        </div>
    </div>



    <div id="contentMandates">
        <table class="dataTableDefault table table-striped table-bordered">
            <thead>
            <tr class="tri">
                <th></th>
                <th></th>
                <th></th>
                <th></th>
                <th></th>
                <th></th>
                <th></th>
                <th></th>
                <th></th>
                <th class="jshide"></th>
                <th class="jshide"></th>
            </tr>
            <tr>
                <th>Prix fai</th>
                <th>Numéro du mandat</th>
                <th>Type de bien</th>
                <th>Type de transaction</th>
                <th>Style du bien</th>
                <th>Surface terrain</th>
                <th>Surface habitable</th>
                <th>Code postal</th>
                <th>ville</th>
                <th>Photo</th>
                <th>Actions</th>
            </tr>
            </thead>

            <tbody>
            {foreach from=$listMandats item=mandate}
                {if BddRapprochement::relMandateAcquereurExist($pdo,$mandate,$acq)}
                    {assign var=rapproche value=1} {else} {assign var=rapproche value=0}
                {/if} {if $mandate->getMandateType()->getIdMandateType() eq
            Constant::ID_PLOT_OF_LAND} {assign var=module value='terrain'}
            {else} {assign var=module value='mandat'} {/if}


                <tr>
                    <td data-order="{$mandate->getPriceFai()}" class="gras{if ($mandate->getPriceFai() >= $acq->getPriceMax() ||$mandate->getPriceFai() <= $acq->getPriceMin())&& $acq->getPriceMax() !=0} red{/if}">
                        {Tools::grosNombre(round($mandate->getPriceFai(),0))} €
                    </td>
                    <td class="gras">{$mandate->getNumberMandate()}</td>

                    <td class="gras
					{if $acq->getMandateType()}
					{if $mandate->getMandateType()->getIdMandateType() neq $acq->getMandateType()->getIdMandateType()} red{/if}{/if}">

                        {$mandate->getMandateType()->getName()}
                    </td>
                    <td 	{if $acq->getMandateType()}{if $mandate->getMandateType()->getIdMandateType() neq $acq->getMandateType()->getIdMandateType()} class="red"{/if}{/if}>{$mandate->getTransactionType()->getName()}</td>
                    <td>{if $mandate->getStyle()&&$acq->getMandateStyle()} {if
                        $mandate->getStyle()->getIdMandateStyle() neq
                        $acq->getMandateStyle()->getIdMandateStyle()} class="red" {/if}>
                            {$mandate->getStyle()->getName()} {else} {if
                            $mandate->getStyle()}{$mandate->getStyle()->getName()}{else}NC{/if}
                        {/if}</td>
                    <td>{$mandate->getSuperficieTotale()}</td>
                    <td>{$mandate->getSurfaceHabitable()}</td>
                    <td>{$mandate->getCity()->getZipCode()}</td>
                    <td>{$mandate->getCity()->getName()}</td>

                    <td>{if $mandate->getPictureByDefault()}
                        <a class="fancybox" href="{Constant::DEFAULT_URL_PICTURE_MODULE_DIRECTORY}/{$module}/big/{$mandate->getPictureByDefault()->getName()}">
                            <img src="{Constant::DEFAULT_URL_PICTURE_MODULE_DIRECTORY}/{$module}/thumb/{$mandate->getPictureByDefault()->getName()}" alt="" class="img-thumbnail"/> {else} NC {/if}
                        </a>
                    </td>
                    <td>


                        <div class="btn-group">

                            {if !$rapproche}
                                <a class="btn btn-default" href="{Tools::create_url($user,'rapprochement','add_rapprochement_chooseM',$smarty.get.action,array($mandate->getIdMandate()))}" title="Rapprocher">
                                    <i class="fa fa-crosshairs"></i> Rapprocher
                                </a>
                            {else}
                                <a class="btn btn-default" href="{Tools::create_url($user,'rapprochement','seeByChooseM',BddRapprochement::loadByMandateAndAcquereur($pdo,$mandate,$acq)->getIdRapprochement(),array($acq->getIdAcquereur()))}" title="Fiche rapprochement"><i class="fa fa-chevron-circle-right"></i> Fiche rapprochement</a>
                            {/if}
                            <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
                                <span class="caret"></span>
                                <span class="sr-only">Toggle Dropdown</span>
                            </button>
                            <ul class="dropdown-menu" role="menu">
                                <li><a href="{Tools::create_url($user,$module,'see',$mandate->getIdMandate())}" title="Voir"><i class="fa fa-chevron-circle-right"></i> Voir la fiche du bien </a></li>
                            </ul>

                        </div>




                    </td>

                </tr>
            {/foreach}
            </tbody>
        </table>


    </div>
</form>
</div>
