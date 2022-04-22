{include file="tpl_default/entete.tpl"}
<form action="" method="post" role="form" class="form-horizontal">
<div class="row bg-success bannerTitle">
    <div class="col-md-6">
        <h1 class="h2">Modification générales</h1>
    </div>
    <div class="col-md-6">
        <p class="h4 text-right ">
            <button type="submit" name="valid" value="Valider" class="btn btn-warning" >
                <i class="fa fa-save fa-2x"></i>
            </button>
            <button type="submit" name="cancel" value="Annuler" class="btn btn-default" >
                <i class="fa fa-close fa-2x"></i>
            </button>
        </p>
    </div>
</div>
{include file="tpl_default/error.tpl"}

<fieldset>
    <legend>Localisation</legend>
    <div class="form-group">


        <label class="col-sm-2 control-label"  for="address">Addresse : </label>

        <div class="col-sm-8">
            <input type="text" name="address" id="address" class="form-control" value="{$address}"/>
        </div>
    </div>
    <div class="form-group">

        <label class="col-sm-2 control-label"  for="city">Ville : </label>

        <div class="col-sm-8">
            <select name="city" id="city" class="form-control">
                {foreach from=$listcity item=ci}
                    <option {if $ci->getIdCity() eq $city} selected="selected"
                                                           {/if}value="{$ci->getIdCity()}"> {$ci->getZipCode()}
                        {$ci->getName()}</option>
                {/foreach}
            </select>
        </div>
    </div>
</fieldset>
<fieldset>
    <legend>Général</legend>




        <div class="form-group">
            <label class="col-sm-2 control-label"  for="nature">Nature du bien : </label>

            <div class="col-sm-8">
                <select name="nature" class="form-control"
                        id="nature"> {foreach from=$listNature item=it}
                        <option {if $it->getIdMandateNature() eq $nature}
                                selected="selected" {/if}value="{$it->getIdMandateNature()}">
                            {$it->getName()}</option>
                    {/foreach}
                </select></div>
        </div>
        {if $user->getLevelMember()->getIdLevelMember() <3}
            <div class="form-group">
                <label class="col-sm-2 control-label"  for="userSe">Utilisateur affecté
                    : </label>

                <div class="col-sm-8"><select class="form-control"
                                              name="userSe" id="userSe"> {foreach from=$listUser item=i}
                            <option {if $i->getIdUser() eq $userSe} selected="selected"
                                                                    {/if}value="{$i->getIdUser()}">{$i->getFirstName()} {$i->getName()}</option>
                        {/foreach}
                    </select></div>
            </div>
        {/if}
        {if !empty($listNotary)}
            <div class="form-group">
                <label class="col-sm-2 control-label" for="notary">Notaire vendeur
                    : </label>

                <div class="col-sm-8"><select name="notary" class="form-control"
                                              id="notary"> {foreach from=$listNotary item=i}
                            <option {if $i->getIdNotary() eq $notary} selected="selected"
                                                                      {/if}value="{$i->getIdNotary()}"> {$i->getName()}</option>
                        {/foreach}
                    </select></div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label"  for="notaryAcq">Notaire acquereur
                    :</label>

                <div class="col-sm-8">
                    <select name="notaryAcq" id="notaryAcq" class="form-control">
                        <option value="">NC</option>
                        {foreach from=$listNotary item=item}
                            <option {if $item->getIdNotary() eq $notaryAcq}selected="selected"
                                    {/if}value="{$item->getIdNotary()}"> {$item->getName()}</option>
                        {/foreach}
                    </select>
                </div>
            </div>
        {/if}
        <div class="form-group">
            <label class="col-sm-2 control-label"  for="typeTransaction">Type de
                transaction : </label>

            <div class="col-sm-8"><select class="form-control"
                                          name="transactionType" id="typeTransaction"> {foreach
                    from=$listTransactionType item=i}
                        <option {if $i->getIdTransactionType() eq $transactionType}
                                selected="selected" {/if}value="{$i->getIdTransactionType()}">
                            {$i->getName()}</option>
                    {/foreach}
                </select></div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label"  for="typeBien">Type de bien : </label>

            <div class="col-sm-8"><select name="typeBien" class="form-control"
                                          id="typeBien"> {foreach from=$listMandateType item=i}
                        {if $i->getIdMandateType() neq Constant::ID_PLOT_OF_LAND}
                            <option {if $i->getIdMandateType() eq $typeBien} selected="selected"
                                                                             {/if}value="{$i->getIdMandateType()}"> {$i->getName()}</option>
                        {/if}
                    {/foreach}
                </select>
            </div>
        </div>


</fieldset>

<fieldset>
    <legend>
        Mandat
    </legend>


    <div class="form-group">
        <label class="col-sm-2 control-label"  for="numMandat">Numéro de mandat : </label>

        <div class="col-sm-8">
            <input type="text" name="numMandat" id="numMandat" value="{$numMandat}" class="form-control"/>
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-2 control-label"  for="debutMandat">Début : </label>

        <div class="col-sm-8">
            <input type="text" class="datepicker form-control" name="debutMandat" id="debutMandat"
                   value="{$debutMandat}"/>
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-2 control-label"  for="finMandat">Fin : </label>

        <div class="col-sm-8"><input type="text"
                                     class="datepicker form-control" name="finMandat" id="finMandat"
                                     value="{$finMandat}"/>
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-2 control-label"  for="libreMandat">libre le : </label>

        <div class="col-sm-8"><input type="text"
                                     class="datepicker form-control" name="libreMandat" id="libreMandat"
                                     value="{$libreMandat}"/>
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-2 control-label"  for="numberlot">Numéro de lot : </label>

        <div class="col-sm-8">
            <input type="text" name="numberlot" id="numberlot" value="{$numberlot}" class="form-control"/>
        </div>
    </div>
</fieldset>

<fieldset>
    <legend>Prix</legend>

    <div class="form-group">
        <label class="col-sm-2 control-label"  for="prixFai">Prix FAI : </label>

        <div class="col-sm-8">
            <input type="text" class="form-control" name="prixFAI" id="prixFai" value="{$prixFAI}"/>
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-2 control-label"  for="prixNetVendeur">Prix net vendeur
            : </label><div class="col-sm-8">
            <input type="text" name="prixNetVendeur" id="prixNetVendeur" value="{$prixNetVendeur}" class="form-control"/>
        </div></div>
    <div class="form-group" id="jsCommission">
        <label class="col-sm-2 control-label"  for="commissionMandat">Commission
            : </label><div class="col-sm-8"><input type="text"
                             name="commission" id="commissionMandat" value="{$commission}" class="form-control"/>
    </div></div>
    <div class="form-group" id="jsEstim">
        <label class="col-sm-2 control-label"  for="estimationMini">Estimation Mini
            : </label><div class="col-sm-8"><input
                type="text" name="estimationMini" id="estimationMini"
                value="{$estimationMini}" class="form-control"/>
    </div></div>
    <div class="form-group" id="jsEstimMaxi">
        <label class="col-sm-2 control-label"  for="estimationMaxi">
            Estimation Maxi : </label>
        <div class="col-sm-8">
            <input type="text" name="estimationMaxi" id="estimationMaxi" value="{$estimationMaxi}" class="form-control"/>
        </div>
    </div>
    <div class="form-group" id="jsMargeNegoce">
        <label class="col-sm-2 control-label"  for="margeNegoce">
            Marge negoce:
        </label>
        <div class="col-sm-8">
            <input type="text" name="margeNegoce" id="margeNegoce" value="{$margeNegoce}" class="form-control"/>
        </div>
    </div>

    <div class="form-group" id="jsRental">

        <label class="col-sm-2 control-label"  for="rental">
            Loyer actuel (si locataires ) :</label><div class="col-sm-8"><input class="form-control" type="text" name="rental" id="rental" value="{$rental}"/>
    </div></div>

    <div class="form-group">
        <label class="col-sm-2 control-label"  for="pricegarage">Prix
            garage : </label>
        <div class="col-sm-8">
            <input type="text" name="pricegarage" id="pricegarage" value="{$pricegarage}" class="form-control"/>
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-2 control-label"  for="pricecellar">Prix
            Cave : </label>
        <div class="col-sm-8">
        <input class="form-control" type="text" name="pricecellar" id="pricecellar" value="{$pricecellar}"/>
        </div>
        </div>
    <div class="form-group">
        <label class="col-sm-2 control-label"  for="profitability">Rentabilité
            en % :</label>
        <div class="col-sm-8">
        <input class="form-control" type="text" name="profitability" id="profitability" value="{$profitability}"/>
        </div>
        </div>

</fieldset>

<fieldset>
    <legend>
        Géolocalisation
    </legend>

        <div class="form-group">

            <p class="help-block col-sm-offset-2">En degrès sexagésimaux :</p>
            <label class="col-sm-2 control-label"  for="latitude">Latitude
                : </label><div class="col-sm-8"><input type="text"
                                 id="latitude" name="latitude" value="{$latitude}" class="form-control"/>
        </div></div>
        <div class="form-group">
            <label class="col-sm-2 control-label"  for="longitude"> Longitude : </label>
            <div class="col-sm-8"><input type="text"
                   id="longitude" name="longitude" value="{$longitude}" class="form-control"/>
        </div>
        </div>


</fieldset>


<div class="form-group">
    <div class="col-sm-offset-2 col-sm-8">
        <button type="submit" name="valid" value="Valider" class="btn btn-warning" >
            <i class="fa fa-save"></i> Mettre à jour
            </button>
        <button type="submit" name="cancel" value="Annuler" class="btn btn-default" >
            <i class="fa fa-close"></i> Annuler et fermer
            </button>
    </div>
</div>
</form>
</div>
