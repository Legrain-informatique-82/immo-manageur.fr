{include file="tpl_default/entete.tpl"}
<div class="row bg-success bannerTitle">
    <div class="col-md-12">
        <h1 class="h2">Dupliquer le mandat</h1>
    </div>

</div>

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

{* N'apparait que si l'utilisateur a un grade supérieur à
opérateur *}
<div id="blocMandate">
<form action="" method="post" role="form" class="form-horizontal">
{if !empty($listUser)}
    <fieldset>
        <legend>Utilisateur</legend>

        <div class="form-group">
            <label class="col-sm-2 control-label" for="idUser">Utilisateur affecté au mandat : </label>
            <div class="col-sm-8">
                <select name="idUser" id="idUser" class="form-control">
                    {foreach from=$listUser item=item}
                        <option {if $item->getIdUser() eq $idUser}selected="selected"{/if}value="{$item->getIdUser()}">{$item->getFirstname()} {$item->getName()}</option> {/foreach}
                </select>
            </div>
        </div>
    </fieldset>
{/if} {* Apparait à tout le monde*}
<fieldset>
    <legend>Général</legend>
    <div class="form-group">
        <label class="col-sm-2 control-label" for="typeTransaction">Type de transaction :</label>
        <div class="col-sm-8">
            <select name="typeTransaction" id="typeTransaction" class="form-control">
                {foreach from=$listTypeTransaction item=tt}
                    <option {if $tt->getIdTransactionType() eq $typeTransaction} selected="selected" {/if} value="{$tt->getIdTransactionType()}">{$tt->getName()}</option>
                {/foreach}
            </select>
        </div>
    </div>

    <div class="form-group">
        <label class="col-sm-2 control-label" for="typeBien">Type de bien : </label>
        <div class="col-sm-8">
            <select name="typeBien" id="typeBien" class="form-control">
                {foreach from=$listTypeBien item=tb}
                    {if $tb->getIdMandateType() neq Constant::ID_PLOT_OF_LAND}
                        <option {if $tb->getIdMandateType() eq $typeBien}
                            selected="selected"
                        {/if} value="{$tb->getIdMandateType()}">{$tb->getName()}</option> {/if}
                {/foreach}
            </select>
        </div>
    </div>

    <div class="form-group">
        <label class="col-sm-2 control-label" for="nature">Nature du bien : </label>
        <div class="col-sm-8">
            <select name="nature" id="nature" class="form-control">
                {foreach from=$listNature item=tb}
                    <option {if $tb->getIdMandateNature() eq $nature}
                        selected="selected" {/if} value="{$tb->getIdMandateNature()}">{$tb->getName()}</option>

                {/foreach}
            </select>
        </div>
    </div>
</fieldset>
{*
<fieldset>
    <legend>Vendeur principal</legend>
    {include file='seller/views/frm_add_seller.tpl'}
</fieldset>
*}


<fieldset>
    <legend>Infos mandat</legend>
    {if !empty($listNotary)}
        <div class="form-group">
            <label class="col-sm-2 control-label" for="idNotary">Notaire vendeur :</label>
            <div class="col-sm-8">
                <select name="idNotary" id="idNotary" class="form-control">
                    {foreach from=$listNotary item=item}
                        <option {if $item->getIdNotary() eq $idNotary}selected="selected" {/if}value="{$item->getIdNotary()}"> {$item->getName()}</option>
                    {/foreach}
                </select>
            </div></div>
    {/if}
    {if !empty($listNotary)}
        <div class="form-group">
            <label class="col-sm-2 control-label" for="idNotaryAcq">Notaire acquereur :</label>
            <div class="col-sm-8">
                <select name="idNotaryAcq" id="idNotaryAcq" class="form-control">
                    <option value="">NC</option>
                    {foreach from=$listNotary item=item}
                        <option {if $item->getIdNotary() eq $idNotaryAcq}selected="selected" {/if}value="{$item->getIdNotary()}"> {$item->getName()}</option>
                    {/foreach}
                </select></div>
        </div>
    {/if}

    <div class="form-group">
        <label class="col-sm-2 control-label" for="numMandat">N° Mandat :</label>
        <div class="col-sm-8">
            <input class="form-control" type="text" name="numMandat" id="numMandat" value="{$numMandat}" />
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-2 control-label" for="debutMandat">	Début : </label>
        <div class="col-sm-8">
            <input class="datepicker form-control" type="text" name="debutMandat" id="debutMandat" value="{$debutMandat}" />
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-2 control-label" for="finMandat">Fin : </label>
        <div class="col-sm-8">
            <input class="datepicker form-control" type="text" name="finMandat" id="finMandat" value="{$finMandat}" />
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-2 control-label" for="libreMandat">libre le :</label>
        <div class="col-sm-8">
            <input class="datepicker form-control" type="text" name="libreMandat" id="libreMandat" value="{$libreMandat}" />
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-2 control-label" for="numberlot">Numéro de lot : </label>
        <div class="col-sm-8">
            <input class="form-control" type="text" name="numberlot" id="numberlot" value="{$numberlot}"/>
        </div>
    </div>
</fieldset>

<fieldset>
<legend>Biens</legend>
<fieldset>
    <legend>Localisation</legend>
    <div class="form-group">
        <label class="col-sm-2 control-label" for="adresseMandat">Adresse :</label>
        <div class="col-sm-8">
            <input class="form-control input-lg" type="text" name="adresseMandat" id="adresseMandat" value="{$adresseMandat}" />
        </div>
    </div>
    {if !empty($listCity)}
        <div class="form-group">
            <label class="col-sm-2 control-label" for="idCity">Ville : </label>
            <div class="col-sm-8">
                <select name="idCity" id="idCity" class="form-control">
                    {foreach from=$listCity item=item}
                        <option {if $item->getIdCity() eq $idCity}
                            selected="selected"
                        {/if}
                                value="{$item->getIdCity()}"> {$item->getZipCode()} - {$item->getName()}</option>
                    {/foreach}
                </select>
            </div>
        </div>
    {/if}
</fieldset>
<fieldset >
    <legend>Prix</legend>

    <div class="form-group">
        <label class="col-sm-2 control-label" for="prixFai">	<span id="jsPrixFai">Prix FAI</span> :</label>
        <div class="col-sm-8">
            <input class="form-control" type="text" name="prixFai" id="prixFai" value="{$prixFai}" />
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-2 control-label" for="prixNetVendeur"><span id="jsPrixNetVendeur">Prix net vendeur</span> :</label>
        <div class="col-sm-8">
            <input class="form-control" type="text" name="prixNetVendeur" id="prixNetVendeur" value="{$prixNetVendeur}" />
        </div>
    </div>
    <div class="form-group" id="jsCommission">
        <label class="col-sm-2 control-label" for="commissionMandat">Commission :</label>
        <div class="col-sm-8">
            <input class="form-control" type="text" name="commissionMandat" id="commissionMandat" value="{$commissionMandat}" />
        </div>
    </div>
    <div class="form-group" id="jsEstim">
        <label class="col-sm-2 control-label" for="estimationFai">Estimation FAI mini : </label>
        <div class="col-sm-8">
            <input class="form-control" type="text" name="estimationFai" id="estimationFai" value="{$estimationFai}" />
        </div>
    </div>
    <div class="form-group" id="jsEstimMaxi">
        <label class="col-sm-2 control-label" for="estimationMaxi">Estimation FAI maxi : </label>
        <div class="col-sm-8">
            <input class="form-control" type="text" name="estimationMaxi" id="jsEstimMaxi" value="{$estimationMaxi}" />
        </div>
    </div>
    <div class="form-group" id="jsMargeNegoce">
        <label class="col-sm-2 control-label" for="margeNegoce">Marge negoce :</label>
        <div class="col-sm-8">
            <input class="form-control" type="text" name="margeNegoce" id="margeNegoce" value="{$margeNegoce}" />
        </div>
    </div>
    <div class="form-group" id="jsRental">

        <label class="col-sm-2 control-label" for="rental">Loyer actuel (si locataires ) :</label>
        <div class="col-sm-8">
            <input class="form-control" type="text" name="rental" id="rental" value="{$rental}"/>
        </div>
    </div>

    <div class="form-group">
        <label class="col-sm-2 control-label" for="pricegarage">Prix garage : </label>
        <div class="col-sm-8">
            <input class="form-control" type="text" name="pricegarage" id="pricegarage" value="{$pricegarage}"/>
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-2 control-label" for="pricecellar">Prix Cave : </label>
        <div class="col-sm-8">
            <input class="form-control" type="text" name="pricecellar" id="pricecellar" value="{$pricecellar}"/>
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-2 control-label" for="profitability">Rentabilité en % :</label>
        <div class="col-sm-8">
            <input class="form-control" type="text" name="profitability" id="profitability" value="{$profitability}"/>
        </div>
    </div>
</fieldset>

<fieldset >
    <legend>Cadastre</legend>
    <div class="form-group">
        <label class="col-sm-2 control-label" for="refCadastre1">Ref cadastre parcelle 1 : </label>
        <div class="col-sm-8">
            <input class="form-control" type="text" name="refCadastre1" id="refCadastre1" value="{$refCadastre1}" />
        </div>
    </div>
    {*
     <div class="form-group">
        Ref cadastre parcelle 2 : <input type="text" name="refCadastre2"
            id="refCadastre2" value="{$refCadastre2}" />
    </div>
     <div class="form-group">
        Ref cadastre parcelle 3 : <input type="text" name="refCadastre3"
            id="refCadastre3" value="{$refCadastre3}" />
    </div>
     <div class="form-group">
        Autre ref cadastre : <input type="text" name="autreRefCadastre"
            id="autreRefCadastre" value="{$autreRefCadastre}" />
    </div>
     <div class="form-group">
        Numéro de lot : <input type="text" name="numLot" id="numLot"
            value="{$numLot}" />
    </div>
    *}
</fieldset>

<hr class="clear invi" />
<fieldset>
    <legend>Superficie</legend>
    {*
     <div class="form-group">
        Superficie parcelle 1 : <input type="text"
            name="superficieParcelle1" id="superficieParcelle1"
            value="{$superficieParcelle1}" />
    </div>
     <div class="form-group">
        Superficie parcelle 2 : <input type="text"
            name="superficieParcelle2" id="superficieParcelle2"
            value="{$superficieParcelle2}" />
    </div>
     <div class="form-group">
        Superficie parcelle 3 : <input type="text"
            name="superficieParcelle3" id="superficieParcelle3"
            value="{$superficieParcelle3}" />
    </div>
     <div class="form-group">
        Superficie autres parcelle : <input type="text"
            name="superficieAutreParcelle" id="superficieAutreParcelle"
            value="{$superficieAutreParcelle}" />
    </div>
     <div class="form-group">
        Superficie constructible : <input type="text"
            name="superficieConstructible" id="superficieConstructible"
            value="{$superficieConstructible}" />
    </div>
     <div class="form-group">
        Superficie non constructible : <input type="text"
            name="superficieNonConstructible" id="superficieNonConstructible"
            value="{$superficieNonConstructible}" />
    </div>
    *}
    <div class="form-group">
        <label class="col-sm-2 control-label" for="superficieTotale">Superficie totale : </label>
        <div class="col-sm-8">
            <input class="form-control" type="text" name="superficieTotale" id="superficieTotale" value="{$superficieTotale}" />
        </div>
    </div>

    {* {if !empty($listGeometer)}
     <div class="form-group">
        géometre : <select name="idGeometer" id="idGeometer">
            <option value="">Non renseigné</option> {foreach from=$listGeometer
            item=item}
            <option {if $item->getIdMandateGeometer() eq
                $idGeometer}selected="selected"
                {/if}value="{$item->getIdMandateGeometer()}"> {$item->getName()}</option>
            {/foreach}
        </select>
    </div>
    {/if} {if !empty($listBornageTerrain)}
     <div class="form-group">
        Bornage : <select name="idBornageTerrain" id="idBornageTerrain">
            <option value="">Non renseigné</option> {foreach
            from=$listBornageTerrain item=item}
            <option {if $item->getIdMandateBornageTerrain() eq
                $idBornageTerrain}selected="selected"
                {/if}value="{$item->getIdMandateBornageTerrain()}">
                {$item->getName()}</option> {/foreach}
        </select>
    </div>
    {/if} *}

</fieldset>

{* DPE *}
<fieldset>
    <legend>DPE</legend>
    <div class="form-group">
        <label class="col-sm-2 control-label" for="dpeConsoEner">Consommation energétique : </label>
        <div class="col-sm-8">
            <input class="form-control" type="text" value="{$dpeConsoEner}" name="dpeConsoEner" id="dpeConsoEner" />
        </div>
    </div>

    <div class="form-group">
        <label class="col-sm-2 control-label" for="dpeEmissionGaz">Emission de gaz :</label>
        <div class="col-sm-8">
            <input class="form-control" type="text" value="{$dpeEmissionGaz}" name="dpeEmissionGaz" id="dpeEmissionGaz" />
        </div>
    </div>
</fieldset>
<fieldset>
<legend>Info du bien</legend>


<div class="form-group">
    <label class="col-sm-2 control-label" for="nbPiece">Nombre de pièce : </label>
    <div class="col-sm-8">
        <input type="text" class="form-control" name="nbPiece" id="nbPiece" value="{$nbPiece}" />
    </div>
</div>

<div class="form-group">
    <label class="col-sm-2 control-label" for="nbChambre">Nombre de chambre : </label>
    <div class="col-sm-8">
        <input type="text" class="form-control" name="nbChambre" id="nbChambre" value="{$nbChambre}" />
    </div>
</div>

<div class="form-group">
    <label class="col-sm-2 control-label" for="surfaceHab">Surface habitable : </label>
    <div class="col-sm-8">
        <input type="text" class="form-control" name="surfaceHab" id="surfaceHab" value="{$surfaceHab}" />
    </div>
</div>
<div class="form-group">
    <label class="col-sm-2 control-label" for="surfacePieceVie">Surface pièce vie :</label>
    <div class="col-sm-8">
        <input class="form-control" type="text" name="surfacePieceVie" id="surfacePieceVie" value="{$surfacePieceVie}" />
    </div>
</div>

<div class="form-group">
    <label class="col-sm-2 control-label" for="niveau">Niveau :</label>
    <div class="col-sm-8">
        <input type="text" class="form-control" name="niveau" id="niveau" value="{$niveau}" />
    </div>
</div>
<div class="form-group">
    <label class="col-sm-2 control-label" for="anneeConstruction">Année construction :</label>
    <div class="col-sm-8">
        <input type="text" class="form-control" name="anneeConstruction" id="anneeConstruction" value="{$anneeConstruction}" />
    </div>
</div>
<div class="form-group">
    <label class="col-sm-2 control-label" for="coupCoeur">Coup de coeur :</label>
    <input {if $coupCoeur eq 'on'} checked="checked" {/if} type="checkbox" name="coupCoeur" id="coupCoeur" value="on" />
</div>
<div class="form-group">
    <label class="col-sm-2 control-label" for="nouveauteSite">Nouveauté (site Internet) : </label>
    <div class="col-sm-8">
        <input type="text" name="nouveauteSite" id="nouveauteSite" value="{$nouveauteSite}" class="datepicker form-control" />
    </div>
</div>

<div class="form-group">
    <label class="col-sm-2 control-label" for="chargesMensuelle">Charges mensuelles :</label>
    <div class="col-sm-8">
        <input class="form-control" type="text" name="chargesMensuelle" id="chargesMensuelle" value="{$chargesMensuelle}" />
    </div>
</div>
<div class="form-group">
    <label class="col-sm-2 control-label" for="taxesFoncieres">Taxes foncières : </label>
    <div class="col-sm-8">
        <input type="text" class="form-control" name="taxesFoncieres" id="taxesFoncieres" value="{$taxesFoncieres}" />
    </div>

</div>
<div class="form-group">
    <label class="col-sm-2 control-label" for="taxeHabitation">Taxe Habitation : </label>
    <div class="col-sm-8">
        <input type="text" class="form-control" name="taxeHabitation" id="taxeHabitation" value="{$taxeHabitation}" />
    </div>

</div>
<div class="form-group">
    <label class="col-sm-2 control-label" for="numbergarage">Numéro garage : </label>
    <div class="col-sm-8">
        <input type="text" class="form-control" name="numbergarage" id="numbergarage" value="{$numbergarage}"/>
    </div>
</div>
<div class="form-group">
    <label class="col-sm-2 control-label" for="numbercellar">Numéro cave : </label>
    <div class="col-sm-8">
        <input type="text" class="form-control" name="numbercellar" id="numbercellar"  value="{$numbercellar}"/>
    </div>
</div>
<div class="form-group">
    <label class="col-sm-2 control-label" for="numberparking">Numéro parking : </label>
    <div class="col-sm-8">
        <input type="text" name="numberparking" id="numberparking"  value="{$numberparking}" class="form-control"/>
    </div>
</div>
<div class="form-group">
    <label class="col-sm-2 control-label" for="numberattic">Numéro grenier : </label>
    <div class="col-sm-8">
        <input type="text" name="numberattic" id="numberattic"  value="{$numberattic}" class="form-control"/>
    </div>
</div>


<div class="row">
    <div class="col-sm-8 col-sm-offset-2">

        <div class="row">
            <div class="col-xs-6 col-md-4">
                <label class="checkbox-inline" for="cheminee">
                    <input {if $cheminee eq 'on'} checked="checked" {/if} type="checkbox" name="cheminee" id="cheminee" value="on" /> Cheminée
                </label>
            </div>
            <div class="col-xs-6 col-md-4">
                <label class="checkbox-inline"  for="cuisineEquipee">
                    <input {if $cuisineEquipee eq 'on'} checked="checked" {/if} type="checkbox" name="cuisineEquipee" id="cuisineEquipee" value="on" /> Cuisine équipée
                </label>
            </div>
            <div class="col-xs-6 col-md-4">
                <label class="checkbox-inline"  for="cuisineAmenagee">
                    <input {if $cuisineAmenagee eq 'on'} checked="checked" {/if} type="checkbox" name="cuisineAmenagee" id="cuisineAmenagee" value="on" /> Cuisine amenagée
                </label>
            </div>
            <div class="col-xs-6 col-md-4">
                <label class="checkbox-inline"  for="piscine">
                    <input {if $piscine eq 'on'} checked="checked" {/if} type="checkbox" name="piscine" id="piscine" value="on" /> Piscine
                </label>
            </div>
            <div class="col-xs-6 col-md-4">
                <label class="checkbox-inline"  for="poolHouse">
                    <input {if $poolHouse eq 'on'} checked="checked" {/if} type="checkbox" name="poolHouse" id="poolHouse" value="on" /> Piscine intérieure
                </label>
            </div>
            <div class="col-xs-6 col-md-4">

                <label class="checkbox-inline"  for="terrasse">
                    <input {if $terrasse eq 'on'} checked="checked" {/if} type="checkbox" name="terrasse" id="terrasse" value="on" /> Terrasse
                </label>
            </div>
            <div class="col-xs-6 col-md-4">

                <label class="checkbox-inline"  for="mezzanine">
                    <input {if $mezzanine eq 'on'} checked="checked" {/if} type="checkbox" name="mezzanine" id="mezzanine" value="on" /> Mezzanine
                </label>
            </div>
            <div class="col-xs-6 col-md-4">

                <label class="checkbox-inline"  for="dependance">
                    <input {if $dependance eq 'on'} checked="checked" {/if} type="checkbox" name="dependance" id="dependance" value="on" /> Dépendance
                </label>
            </div>
            <div class="col-xs-6 col-md-4">

                <label class="checkbox-inline"  for="gaz">
                    <input {if $gaz eq 'on'} checked="checked" {/if} type="checkbox" name="gaz" id="gaz" value="on" /> Gaz
                </label>
            </div>
            <div class="col-xs-6 col-md-4">

                <label class="checkbox-inline"  for="cave">
                    <input {if $cave eq 'on'} checked="checked" {/if} type="checkbox" name="cave" id="cave" value="on" /> Cave
                </label>
            </div>
            <div class="col-xs-6 col-md-4">

                <label class="checkbox-inline"  for="ssol">
                    <input {if $ssol eq 'on'} checked="checked" {/if} type="checkbox" name="ssol" id="ssol" value="on" /> Sous sol
                </label>
            </div>
            <div class="col-xs-6 col-md-4">

                <label class="checkbox-inline"  for="garage">
                    <input {if $garage eq 'on'} checked="checked" {/if} type="checkbox" name="garage" id="garage" value="on" /> Garage
                </label>
            </div>

            <div class="col-xs-6 col-md-4">
                <label class="checkbox-inline"  for="parking">
                    <input {if $parking eq 'on'} checked="checked" {/if} type="checkbox" name="parking" id="parking" value="on" /> Parking
                </label>
            </div>
            <div class="col-xs-6 col-md-4">
                <label class="checkbox-inline"  for="rezDeJardin">
                    <input {if $rezDeJardin eq 'on'} checked="checked" {/if} type="checkbox" name="rezDeJardin" id="rezDeJardin" value="on" /> Rez de jardin
                </label>
            </div>
            <div class="col-xs-6 col-md-4">

                <label class="checkbox-inline"  for="plainPied">
                    <input {if $plainPied eq 'on'} checked="checked" {/if} type="checkbox" name="plainPied" id="plainPied" value="on" /> Plain pied
                </label>
            </div>
            <div class="col-xs-6 col-md-4">
                <label class="checkbox-inline"  for="carriere">
                    <input {if $carriere eq 'on'} checked="checked" {/if} type="checkbox" name="carriere" id="carriere" value="on" /> Carrière
                </label>
            </div>
            <div class="col-xs-6 col-md-4">
                <label class="checkbox-inline"  for="ptEau">
                    <input {if $ptEau eq 'on'} checked="checked" {/if} type="checkbox" name="ptEau" id="ptEau" value="on" /> Point eau
                </label>
            </div>
            <div class="col-xs-6 col-md-4">
                <label class="checkbox-inline"  for="ttEgout">
                    <input {if $ttEgout eq 'on'} checked="checked" {/if} type="checkbox" name="ttEgout" id="ttEgout" value="on" /> Tout à l'égout
                </label>
            </div>
        </div>
    </div>
</div>
<p></p>
<p></p>

{* Listes ... *}
<div class="form-group">
    <label class="col-sm-2 control-label" for="insulation"> Isolation :</label>
    <div class="col-sm-8">
        <select name="insulation" id="insulation" class="form-control">
            <option value="0">Non spécifié</option> {foreach
            from=$listInsulation item=item}
                <option value="{$item->getIdMandateInsulation()}" {if $item->getIdMandateInsulation()
                eq $insulation} selected="selected"{/if}>{$item->getName()}</option>
            {/foreach}
        </select>
    </div>
</div>

<div class="form-group">
    <label class="col-sm-2 control-label" for="roof"> Toiture : </label>
    <div class="col-sm-8">
        <select name="roof" id="roof" class="form-control">
            <option value="0">Non spécifié</option> {foreach from=$listRoof
            item=item}
                <option value="{$item->getIdMandateRoof()}" {if $item->getIdMandateRoof()
                eq $roof} selected="selected"{/if}>{$item->getName()}</option>
            {/foreach}
        </select>
    </div>
</div>


<div class="form-group">
    <label class="col-sm-2 control-label" for="heating"> Chauffage :</label>
    <div class="col-sm-8">
        <select name="heating" id="heating" class="form-control">
            <option value="0">Non spécifié</option> {foreach from=$listHeating
            item=item}
                <option value="{$item->getIdMandateHeating()}" {if $item->getIdMandateHeating()
                eq $heating} selected="selected"{/if}>{$item->getName()}</option>
            {/foreach}
        </select>
    </div>
</div>

<div class="form-group">
    <label class="col-sm-2 control-label" for="commonOwnership"> Parties communes :</label>
    <div class="col-sm-8">
        <select name="commonOwnership" id="commonOwnership" class="form-control">
            <option value="0">Non spécifié</option> {foreach
            from=$listCommonOwnership item=item}
                <option value="{$item->getIdMandateCommonOwnership()}" {if $item->getIdMandateCommonOwnership()
                eq $commonOwnership} selected="selected"{/if}>{$item->getName()}</option>
            {/foreach}
        </select>
    </div></div>


<div class="form-group">
    <label class="col-sm-2 control-label" for="constructionType"> Type de construction :</label>
    <div class="col-sm-8">
        <select name="constructionType" id="constructionType" class="form-control">
            <option value="0">Non spécifié</option> {foreach
            from=$listConstructionType item=item}
                <option value="{$item->getIdMandateConstructionType()}" {if $item->getIdMandateConstructionType()
                eq $constructionType} selected="selected"{/if}>{$item->getName()}</option>
            {/foreach}
        </select>
    </div>
</div>

<div class="form-group">
    <label class="col-sm-2 control-label" for="style"> Style : </label>
    <div class="col-sm-8">
        <select name="style" id="style" class="form-control">
            <option value="0">Non spécifié</option> {foreach from=$listStyle
            item=item}
                <option value="{$item->getIdMandateStyle()}" {if $item->getIdMandateStyle()
                eq $style} selected="selected"{/if}>{$item->getName()}</option>
            {/foreach}
        </select>
    </div>
</div>

<div class="form-group">
    <label class="col-sm-2 control-label" for="ne"> Nouveautés :</label>
    <div class="col-sm-8">
        <select name="ne" id="ne" class="form-control">
            <option value="0">Non spécifié</option> {foreach from=$listNews
            item=item}
                <option value="{$item->getIdMandateNews()}" {if $item->getIdMandateNews()
                eq $ne} selected="selected"{/if}>{$item->getName()}</option>
            {/foreach}
        </select>
    </div>
</div>

<div class="form-group">
    <label class="col-sm-2 control-label" for="conditions"> Conditions : </label>
    <div class="col-sm-8">
        <select name="conditions" id="conditions" class="form-control">
            <option value="0">Non spécifié</option> {foreach
            from=$listConditions item=item}
                <option value="{$item->getIdMandateCondition()}" {if $item->getIdMandateCondition()
                eq $conditions} selected="selected"{/if}>{$item->getName()}</option>
            {/foreach}
        </select>
    </div>
</div>

<div class="form-group">
    <label class="col-sm-2 control-label" for="adjoining"> Mitoyenneté : </label>
    <div class="col-sm-8">
        <select name="adjoining" id="adjoining" class="form-control">
            <option value="0">Non spécifié</option> {foreach
            from=$listAdjoining item=item}
                <option value="{$item->getId()}" {if $item->getId()
                eq $adjoining} selected="selected"{/if}>{$item->getName()}</option>
            {/foreach}
        </select>
    </div>
</div>
</fieldset>
{*
<fieldset>
    <legend>Réglementation</legend>

    {if !empty($listZonagePlu)}
     <div class="form-group">
        Zonage PLU <select name="idZonagePlu" id="idZonagePlu">
            <option value="">Non renseigné</option> {foreach
            from=$listZonagePlu item=item}
            <option {if $item->getIdMandateZonagePlu() eq
                $idZonagePlu}selected="selected"
                {/if}value="{$item->getIdMandateZonagePlu()}"> {$item->getName()}</option>
            {/foreach}
        </select>
    </div>
    {/if} {if !empty($listZonageRnu)}
     <div class="form-group">
        Zonage RNU <select name="idZonageRnu" id="idZonageRnu">
            <option value="">Non renseigné</option> {foreach
            from=$listZonageRnu item=item}
            <option {if $item->getIdMandateZonageRnu() eq
                $idZonageRnu}selected="selected"
                {/if}value="{$item->getIdMandateZonageRnu()}"> {$item->getName()}</option>
            {/foreach}
        </select>
    </div>
    {/if} {if !empty($listCos)}
     <div class="form-group">
        COS : <select name="idCos" id="idCos">
            <option value="">Non renseigné</option> {foreach from=$listCos
            item=item}
            <option {if $item->getIdMandateCos() eq $idCos}selected="selected"
                {/if}value="{$item->getIdMandateCos()}"> {$item->getName()}</option>
            {/foreach}
        </select>
    </div>
    {/if}
     <div class="form-group">
        Shon accordée : <input type="text" name="shonAccordee"
            id="shonAccordee" value="{$shonAccordee}" />
    </div>

     <div class="form-group">
        Zone BDF : <label class="col-sm-2 control-label" for="zonebdfFalse"><input type="radio"
            {if $zonebdf eq 0}checked="checked" {/if} value="0" name="zonebdf"
            id="zonebdfFalse" />Non</label><label class="col-sm-2 control-label" for="zonebdfTrue"><input
            type="radio" {if $zonebdf eq 1}checked="checked" {/if} value="1"
            name="zonebdf" id="zonebdfTrue" />Oui</label>
    </div>
     <div class="form-group">
        ligne de crete : <label class="col-sm-2 control-label" for="ligneCreteFalse"><input {if $ligneCrete
            eq 0}checked="checked" {/if} type="radio" value="0"
            name="ligneCrete" id="ligneCreteFalse" />Non</label><label class="col-sm-2 control-label"
            for="ligneCreteTrue"><input type="radio" {if $ligneCrete
            eq 1}checked="checked" {/if} value="1" name="ligneCrete"
            id="ligneCreteTrue" />Oui</label>
    </div>
     <div class="form-group">
        zone inondable : <label class="col-sm-2 control-label" for="zoneInondableFalse"><input type="radio"
            value="0" {if $zoneInondable eq 0} checked="checked"
            {/if}  name="zoneInondable" id="zoneInondableFalse" />Non</label><label class="col-sm-2 control-label"
            for="zoneInondableTrue"><input type="radio" value="1"
            {if $zoneInondable eq 1} checked="checked"
            {/if} name="zoneInondable" id="zoneInondableTrue" />Oui</label>
    </div>
     <div class="form-group">
        Réglement lotissement :
        <textarea name="reglementLotissement" id="reglementLotissement"
            cols="30" rows="10">{$reglementLotissement}</textarea>
    </div>
     <div class="form-group">
        ERNT :
        <textarea name="ernt" id="ernt" cols="30" rows="10">{$ernt}</textarea>
    </div>
</fieldset>
<fieldset>
    <legend>Autorisation</legend>
     <div class="form-group">
        DP valide : <label class="col-sm-2 control-label" for="dPValideFalse"><input type="radio"
            {if $dPValide eq 0} checked="checked" {/if} value="0"
            name="dPValide" id="dPValideFalse" />Non</label><label class="col-sm-2 control-label"
            for="dPValideTrue"><input type="radio" {if $dPValide
            eq 1} checked="checked" {/if} value="1" name="dPValide"
            id="dPValideTrue" />Oui</label>
    </div>
     <div class="form-group">
        Date déclaration préalable : <input class="datepicker" type="text"
            name="dateDeclPrealableDP" id="dateDeclPrealableDP"
            value="{$dateDeclPrealableDP}" />
    </div>
     <div class="form-group">
        Prorogation DP jusqu'au : <input class="datepicker" type="text"
            name="dateProrogationDP" id="dateProrogationDP"
            value="{$dateProrogationDP}" />
    </div>
     <div class="form-group">
        CU valide : <label class="col-sm-2 control-label" for="cuValideFalse"><input type="radio" value="0"
            {if $cuValide eq 0} checked="checked" {/if} name="cuValide"
            id="cuValideFalse" />Non</label><label class="col-sm-2 control-label" for="cuValideTrue"><input
            type="radio" value="1" {if $cuValide eq 1} checked="checked"
            {/if}name="cuValide" id="cuValideTrue" />Oui</label>
    </div>
     <div class="form-group">
        Date déclaration préalable : <input class="datepicker" type="text"
            name="dateDeclPrealableCU" id="dateDeclPrealableCU"
            value="{$dateDeclPrealableCU}" />
    </div>
     <div class="form-group">
        Prorogation CU jusqu'au : <input class="datepicker" type="text"
            name="dateProrogationCU" id="dateProrogationCU"
            value="{$dateProrogationCU}" />
    </div>
     <div class="form-group">
        CU Ops valide : <label class="col-sm-2 control-label" for="cuOpsValideFalse"><input type="radio"
            {if $cuOpsValide eq 0} checked="checked" {/if} value="0"
            name="cuOpsValide" id="cuOpsValideFalse" />Non</label><label class="col-sm-2 control-label"
            for="cuOpsValideTrue"><input type="radio" {if $cuOpsValide
            eq 1} checked="checked" {/if} value="1" name="cuOpsValide"
            id="cuOpsValideTrue" />Oui</label>
    </div>
     <div class="form-group">
        Date déclaration préalable : <input class="datepicker" type="text"
            name="dateDeclPrealableCUOPS" id="dateDeclPrealableCUOPS"
            value="{$dateDeclPrealableCUOPS}" />
    </div>
     <div class="form-group">
        Prorogation CU Ops jusqu'au : <input class="datepicker" type="text"
            name="dateProrogationCUOPS" id="dateProrogationCUOPS"
            value="{$dateProrogationCUOPS}" />
    </div>
     <div class="form-group">
        Permis d'amenager valide : <label class="col-sm-2 control-label" for="permisAmenagerValideFalse"><input
            type="radio" value="0" {if $permisAmenagerValide
            eq 0} checked="checked" {/if} name="permisAmenagerValide"
            id="permisAmenagerValideFalse" />Non</label><label class="col-sm-2 control-label"
            for="permisAmenagerValideTrue"><input type="radio" value="1"
            {if $permisAmenagerValide eq 1} checked="checked"
            {/if}  name="permisAmenagerValide" id="permisAmenagerValideTrue" />Oui</label>
    </div>
     <div class="form-group">
        Date de permis d'amenager : <input class="datepicker" type="text"
            name="datePermisAmenager" id="datePermisAmenager"
            value="{$datePermisAmenager}" />
    </div>
</fieldset>
<fieldset>
    <legend>Viabilisation</legend>
     <div class="form-group">
        Terrain vendu viabilisé : <label class="col-sm-2 control-label" for="terrainViabiliseFalse"><input
            type="radio" {if $terrainViabilise eq 0} checked="checked"
            {/if} value="0" name="terrainViabilise" id="terrainViabiliseFalse" />Non</label><label class="col-sm-2 control-label"
            for="terrainViabiliseTrue"><input type="radio"
            {if $terrainViabilise eq 1} checked="checked" {/if} value="1"
            name="terrainViabilise" id="terrainViabiliseTrue" />Oui</label>
    </div>
     <div class="form-group">
        Terrain vendu semi viabilisé : <label class="col-sm-2 control-label"
            for="terrainSemiViabiliseFalse"><input type="radio" value="0"
            {if $terrainSemiViabilise eq 0} checked="checked"
            {/if} name="terrainSemiViabilise" id="terrainSemiViabiliseFalse" />Non</label><label class="col-sm-2 control-label"
            for="terrainSemiViabiliseTrue"><input type="radio" value="1"
            name="terrainSemiViabilise" {if $terrainSemiViabilise
            eq 1} checked="checked" {/if} id="terrainSemiViabiliseTrue" />Oui</label>
    </div>
     <div class="form-group">
        Terrain vendu non viabilisé : <label class="col-sm-2 control-label" for="terrainNonViabiliseFalse"><input
            type="radio" value="0" {if $terrainNonViabilise
            eq 0} checked="checked" {/if} name="terrainNonViabilise"
            id="terrainNonViabiliseFalse" />Non</label><label class="col-sm-2 control-label"
            for="terrainNonViabiliseTrue"><input type="radio" value="1"
            name="terrainNonViabilise" {if $terrainNonViabilise
            eq 1} checked="checked" {/if} id="terrainNonViabiliseTrue" />Oui</label>
    </div>
     <div class="form-group">
        Passage eau :
        <textarea name="passageEau" id="passageEau" cols="30" rows="10">{$passageEau}</textarea>
    </div>
    {if !empty($listWaterCorresponding)}
     <div class="form-group">
        Correspondant eau : <select name="idWaterCorresponding"
            id="idWaterCorresponding">
            <option value="">Non renseigné</option> {foreach
            from=$listWaterCorresponding item=item}
            <option {if $item->getIdMandateWaterCorresponding() eq
                $idWaterCorresponding}selected="selected"
                {/if}value="{$item->getIdMandateWaterCorresponding()}">
                {$item->getName()}</option> {/foreach}
        </select>
    </div>
    {/if}

     <div class="form-group">
        Passage éléctricité :
        <textarea name="passageElectricite" id="passageElectricite"
            cols="30" rows="10">{$passageElectricite}</textarea>
    </div>
    {if !empty($listElectricCorresponding)}

     <div class="form-group">
        Correspondant electrique : <select name="idElectricCorresponding"
            id="idElectricCorresponding">
            <option value="">Non renseigné</option> {foreach
            from=$listElectricCorresponding item=item}
            <option {if $item->getIdMandateElectricCorresponding() eq
                $idElectricCorresponding}selected="selected"
                {/if}value="{$item->getIdMandateElectricCorresponding()}">
                {$item->getName()}</option> {/foreach}
        </select>
    </div>
    {/if}

     <div class="form-group">
        Passage gaz :
        <textarea name="passageGaz" id="passageGaz" cols="30" rows="10">{$passageGaz}</textarea>
    </div>
    {if !empty($listGazCorresponding)}
     <div class="form-group">
        Correspondant gaz : <select name="idGazCorresponding"
            id="idGazCorresponding">
            <option value="">Non renseigné</option> {foreach
            from=$listGazCorresponding item=item}
            <option {if $item->getIdMandateGazCorresponding() eq
                $idGazCorresponding}selected="selected"
                {/if}value="{$item->getIdMandateGazCorresponding()}">
                {$item->getName()}</option> {/foreach}
        </select>
    </div>
    {/if}
     <div class="form-group">
        Tout à l'égout : <label class="col-sm-2 control-label" for="toutEgoutFalse"><input type="radio"
            {if $toutEgout eq 0} checked="checked" {/if} value="0"
            name="toutEgout" id="toutEgoutFalse" />Non</label><label class="col-sm-2 control-label"
            for="toutEgoutTrue"><input type="radio" value="1" {if $toutEgout
            eq 1} checked="checked" {/if} name="toutEgout" id="toutEgoutTrue" />Oui</label>
    </div>
     <div class="form-group">
        Assainissement par fosse sceptique : <label class="col-sm-2 control-label"
            for="assainissementFosseSceptiqueFalse"><input
            id="assainissementFosseSceptiqueFalse" type="radio"
            {if $assainissementFosseSceptique eq 0} checked="checked"
            {/if} value="0" name="assainissementFosseSceptique" />Non</label><label class="col-sm-2 control-label"
            for="assainissementFosseSceptiqueTrue"><input type="radio"
            value="1" {if $assainissementFosseSceptique eq 1} checked="checked"
            {/if} name="assainissementFosseSceptique"
            id="assainissementFosseSceptiqueTrue" />Oui</label>
    </div>
    {if !empty($listSanitationCorresponding)}
     <div class="form-group">
        Correspondant sanitaire : <select name="idSanitationCorresponding"
            id="idSanitationCorresponding">
            <option value="">Non renseigné</option> {foreach
            from=$listSanitationCorresponding item=item}
            <option {if $item->getIdMandateSanitationCorresponding() eq
                $idSanitationCorresponding}selected="selected"
                {/if}value="{$item->getIdMandateSanitationCorresponding()}">
                {$item->getName()}</option> {/foreach}
        </select>
    </div>
    {/if}

     <div class="form-group">
        Voirie :
        <textarea name="voirie" id="voirie" cols="30" rows="10">{$voirie}</textarea>
    </div>
</fieldset>
*}
<fieldset>
    <legend>Description</legend>
    {if !empty($listOrientation)}
        <div class="form-group">
            <label class="col-sm-2 control-label" for="idOrientation">Orientation : </label>
            <div class="col-sm-8">
                <select name="idOrientation" id="idOrientation" class="form-control">
                    <option value="">Non renseigné</option> {foreach
                    from=$listOrientation item=item}
                        <option {if $item->getIdMandateOrientation() eq
                        $idOrientation}selected="selected"
                                {/if}value="{$item->getIdMandateOrientation()}">
                            {$item->getName()}</option> {/foreach}
                </select>
            </div>
        </div>
    {/if} {if !empty($listSlope)}
        <div class="form-group">
            <label class="col-sm-2 control-label" for="idSlope">Pente : </label>
            <div class="col-sm-8">
                <select name="idSlope" id="idSlope" class="form-control">
                    <option value="">Non renseigné</option> {foreach from=$listSlope
                    item=item}
                        <option {if $item->getIdMandateSlope() eq
                        $idSlope}selected="selected"
                                {/if}value="{$item->getIdMandateSlope()}"> {$item->getName()}</option>
                    {/foreach}
                </select>
            </div>
        </div>
    {/if}
    <div class="form-group">
        <label class="col-sm-2 control-label" for="tailleFacade">Taille de la façade : </label>
        <div class="col-sm-8">
            <input type="text" name="tailleFacade" id="tailleFacade" value="{$tailleFacade}"  class="form-control"/>
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-2 control-label" for="profondeurTerrain">Profondeur du terrain :</label>
        <div class="col-sm-8">
            <input type="text" name="profondeurTerrain" id="profondeurTerrain" value="{$profondeurTerrain}" class="form-control"/>
        </div>
    </div>
    {*
     <div class="form-group">
        Commentaires :
        <textarea name="commentaire" id="commentaire" cols="30" rows="10">{$commentaire}</textarea>
    </div>
    *}

    <div class="form-group">
        <p class="help-block col-sm-offset-2">
            Geolocalisation ( en degré sexagésimaux :) </p>
        <label class="col-sm-2 control-label" for="geoloc">latitude :</label>
        <div class="col-sm-8">
            <input type="text" name="geolocLatitude" id="geoloc" value="{$geolocLatitude}" class="form-control" />
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-2 control-label" for="geolocLongitude">Longitude : </label>
        <div class="col-sm-8">
            <input class="form-control" type="text" name="geolocLongitude" id="geolocLongitude" value="{$geolocLongitude}" />
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-2 control-label" for="proximiteEcole">Proximité école :</label>
        <div class="col-sm-8">
            <input class="form-control" type="text" name="proximiteEcole" id="proximiteEcole" value="{$proximiteEcole}" />
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-2 control-label" for="proximiteEcole">Proximité commerce :</label>
        <div class="col-sm-8">
            <input class="form-control" type="text" name="proximiteCommerce" id="proximiteCommerce" value="{$proximiteCommerce}" />
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-2 control-label" for="proximiteTransport">Proximité transport : </label>
        <div class="col-sm-8">
            <input class="form-control" type="text" name="proximiteTransport" id="proximiteTransport" value="{$proximiteTransport}" />
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-2 control-label" for="commentaireApparent">Texte vitrine :</label>
        <div class="col-sm-8">
            <textarea class="form-control" name="commentaireApparent" id="commentaireApparent"
                      cols="30" rows="10">{$commentaireApparent}</textarea>
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-2 control-label" for="pubInternet">
            Pub Internet :</label>
        <div class="col-sm-8">
            <textarea class="form-control" name="pubInternet" id="pubInternet" cols="30" rows="10">{$pubInternet}</textarea>
        </div>
    </div>
</fieldset>
</fieldset>

<div class="form-group">
    <div class="col-sm-offset-2 col-sm-10">
        <input class="btn btn-default" type="submit" value="Enregistrer le nouveau mandat" name="send" />
    </div>
</div>

</form>
</div>
</div>