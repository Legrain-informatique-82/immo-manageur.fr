{include file="tpl_default/entete.tpl"}


<div class="row bg-success bannerTitle">
    <div class="col-md-6">
        <h1 class="h2">Ajouter un vendeur au mandat : {$mandate->getNumberMandate()}</h1>
    </div>

    <div class="col-md-6">
        <p class="h4 text-right ">

            <a title="annuler et fermer" class="btn btn-default" href="{Tools::create_url($user,"mandat","see",$smarty.get.action)}">
                <i class="fa fa-close fa-2x"></i>
            </a>
        </p>
    </div>
</div>
<div class="row">

    <div class="col-md-5">
        <h2>A partir d'un nouveau vendeur</h2>
        {if $error} {foreach from=$error item=item name=e} {if
        $smarty.foreach.e.first}
            <div class="alert alert-danger" role="alert">
            <ul>
        {/if}
            <li class="error">{$item}</li>
            {if $smarty.foreach.e.last}
                </ul>
            {/if} {/foreach}
            </div>
        {/if}
        <div class="bulle" id="blocMandate">
            <form action="" method="post" role="form" class="form-horizontal">
                {include file='seller/views/frm_add_seller.tpl'}

                <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-8">
                        <div class="checkbox">
                            <label>
                                <input type="checkbox" name="sellerByDefault" id="sellerByDefault" value="on"  /> Définir comme vendeur par defaut.
                            </label>
                        </div>
                    </div>
                </div>





                <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-8">
                        <button class="btn btn-success" type="submit" value="{Lang::LABEL_SAVE}" id="seller_add_submit_send" name="seller_add_submit_send" >
                            <i class="fa fa-save"></i> {Lang::LABEL_SAVE}
                        </button>


                    </div>

                </div>
            </form>
        </div>
    </div>

    <div class="col-md-7">
        <h2>D'un vendeur de la liste ci-dessous</h2>
        <table class="dataTableDefault table table-striped table-bordered" data-display_length="10">
            <thead>
            <tr class="tri">
                <th class="jshide"></th>
                <th></th>
                <th></th>
                <th class="jshide"></th>
                <th class="jshide"></th>
                <th></th>
                <th class="jshide"></th>
            </tr>
            <tr>

                <th>Nom &amp; prénom</th>
                <th>Titre</th>
                <th>Opérateur lié</th>
                <th>Téléphones</th>
                <th>Email</th>
                <th>Etat</th>
                <th>De ce vendeur</th>
            </tr>
            </thead>
            <tbody>
            {foreach name="frm" from=$listSeller item=item}
                <tr>

                    <td>{$item->getName()} {$item->getFirstname()}</td>
                    <td>{$item->getSellerTitle()->getLibel()}</td>
                    <td>{$item->getUser()->getFirstname()} {$item->getUser()->getName()}</td>
                    <td>{if $item->getPhone()}
                            <p>{Lang::LABEL_SELLER_ADD_PHONE}{$item->getPhone()}</p>{/if} {if
                        $item->getMobilPhone()}
                            <p>{Lang::LABEL_SELLER_ADD_MOBIL_PHONE}{$item->getMobilPhone()}</p>{/if}
                        {if $item->getWorkPhone()}
                            <p>{Lang::LABEL_SELLER_ADD_WORK_PHONE}{$item->getWorkPhone()}</p>{/if}
                    </td>
                    <td>{$item->getEmail()}</td>
                    <td>{if $item->getAsset() eq 1}Actif{else}Inactif{/if}</td>
                    <td>
                        <form action="" method="post">
                            <p>
                                <input type="hidden" name="idSeller"
                                       value="{$item->getIdSeller()}" /> <label
                                        for="sellerByDefault{$smarty.foreach.frm.iteration}">Définir
                                    comme vendeur par defaut : <input value="on" type="checkbox"
                                                                      name="sellerByDefault"
                                                                      id="sellerByDefault{$smarty.foreach.frm.iteration}" /> </label>
                            </p>
                            <p>
                                <input class="btn btn-default" type="submit" name="used" value="Affecter ce vendeur" />
                            </p>
                        </form>
                    </td>
                </tr>
            {/foreach}
            </tbody>
        </table>
    </div>

</div>
