{include file='tpl_default/entete.tpl'}

<form action="" method="post" class="form-horizontal" role="form">
    <div class="row bg-success bannerTitle">
        <div class="col-md-6">
            <h1 class="h2">Mandats et exports</h1>
        </div>

        <div class="col-md-6">
            <p class="h4 text-right ">
                <button type="submit" class="btn btn-warning" name="send" title="Mettre à jour" value="Mettre à jour">
                    <i class="fa fa-save fa-2x"></i>
                </button>
                <a title="Revenir à la liste de choix des passerelles" class="btn btn-default" href="{Tools::create_url($user,'export','preList')}">
                    <i class="fa fa-close fa-2x"></i>
                </a>
        </div>
    </div>




    <div class="form-inline" role="form">
        <div class="col-md-12">
        <div class="form-group">
            <label for="agency">Afficher les mandats de :  </label>
            <div class="input-group">
                <select name="agency" id="agency" class="form-control">
                    <option value="ALL" {if $agency eq 'ALL'} selected="selected"{/if}>Toute
                        les agences</option> {foreach from=$listAgency item=a}
                        <option value="{$a->getIdAgency()}" {if $agency eq $a->getIdAgency()}
                            selected="selected" {/if}>l'agence de {$a->getName()}</option>
                    {/foreach}
                </select>
                 <span class="input-group-btn">
                <button type="submit" name="toogleConfidentialMode" value="Ok"  class="btn btn-default" >Valider</button>
                     </span>
            </div>


        </div>
        </div>
    </div>

    <table class="dataTableDefaultWithoutPagination table table-striped table-bordered">
        <thead>
        <tr class="tri">
            <th></th>
            <th></th>
            <th></th>
            <th class="jshide"></th>
            <th></th>
            <th></th>
            <th></th>
            <th class="jshide"></th>
            <th class="jshide"></th>
            <th class="jshide"></th>
        </tr>
        <tr>

            <th><p>Numéro de mandat</p></th>
            <th><p>Type du bien</p></th>
            <th><p>Prénom et<br/>nom du vendeur</p></th>
            <th><p>Adresse<br/> du bien</p></th>
            <th><p>Code postal</p></th>
            <th><p>Ville</p></th>
            <th><p>Secteur</p></th>
            <th>
                <p>Voir la fiche</p>
            </th>
            <th><p>Image du mandat</p></th>

            {foreach from=$listPasserelle item=pa} {* pb tout cocher ... *}
                <th><p>{$pa->getName()}</p>
                    <p class="JsVisible">
                        Tout cocher : <input type="checkbox" name="checkAll" class="jsCheckAll" rel="{$pa->getIdPasserelle()}" />
                    </p>
                </th> {/foreach}

        </tr>
        </thead>
        <tbody>
        {foreach from=$listMandate item=m}
            <tr>
                <td>{$m->getNumberMandate()}</td>
                <td>
                    {$m->getMandateType()->getName()}


                </td>
                <td> {if $m->getDefaultSeller()}
                        {$m->getDefaultSeller()->getFirstname()} {$m->getDefaultSeller()->getName()}
                    {else}
                        NC
                    {/if}
                </td>
                <td><p>
                        {$m->getAddress()}<br />{$m->getCity()->getZipCode()}
                        {$m->getCity()->getName()}
                    </p></td>
                <td>{$m->getCity()->getZipCode()}</td>
                <td>{$m->getCity()->getName()}</td>
                <td>{$m->getCity()->getSector()->getName()}</td>
                <td>{if $m->getMandateType()->getIdMandateType() eq Constant::ID_PLOT_OF_LAND}
                        {assign var="mod" value="terrain"}
                    {else}
                        {assign var="mod" value="mandat"}
                    {/if}

                    <a href="{tools::create_url($user,$mod,'see',$m->getIdMandate())}" class="btn btn-default">Fiche du bien</a>

                </td>
                <td><p>
                        {if $m->getPictureByDefault()}
                            <a class="fancybox" href="{Constant::DEFAULT_URL_PICTURE_MODULE_DIRECTORY}{if $m->getMandateType()->getIdMandateType() eq Constant::ID_PLOT_OF_LAND}terrain{else}mandat{/if}/big/{$m->getPictureByDefault()->getName()}">
                                <img src="{Constant::DEFAULT_URL_PICTURE_MODULE_DIRECTORY}{if $m->getMandateType()->getIdMandateType() eq Constant::ID_PLOT_OF_LAND}terrain{else}mandat{/if}/thumb/{$m->getPictureByDefault()->getName()}" alt=""  class="img-thumbnail img-responsive"/>
                            </a>
                        {else}
                            NC
                        {/if}
                    </p></td>
                {foreach from=$listPasserelle item=pa}
                    <td data-order="{if $pa->isLinked($m)}1{else}0{/if}">

                        <p>
                            <input type="hidden" name="hidden_{$pa->getIdPasserelle()}_{$m->getIdMandate()}" value="" />
                            <input type="checkbox" rel="{$pa->getIdPasserelle()}" name="export_{$pa->getIdPasserelle()}_{$m->getIdMandate()}" {if $pa->isLinked($m)} checked="checked" {/if} value="1"/>
                        </p>
                    </td>
                {/foreach}
            </tr>
        {/foreach}
        </tbody>
    </table>

</form>
</div>
