{include file="tpl_default/entete.tpl"}
<form action="" method="post" role="form" class="form-horizontal">
<div class="row bg-success bannerTitle">
    <div class="col-md-6">
        <h1 class="h2">{$title}</h1>
    </div>
    <div class="col-md-6">
        <p class="h4 text-right ">
            <button type="submit" name="valid" value="Valider" class="btn btn-warning" >
                <i class="fa fa-save fa-2x"></i>
            </button>
            <button type="submit" name="cancel" value="Annuler" class="btn btn-default">
                <i class="fa fa-close fa-2x"></i>
            </button>
        </p>
    </div>
</div>
{include file="tpl_default/error.tpl"}



<div class="form-group">
    <label class="col-sm-2 control-label" for="nbPiece">Nombre de pièce :</label>
    <div class="col-sm-8">
        <input type="text" name="nbPiece" id="nbPiece" value="{$nbPiece}" class="form-control"/>
    </div>
</div>
<div class="form-group">
    <label class="col-sm-2 control-label" for="nbChambre">Nombre de chambre : </label>
    <div class="col-sm-8">
        <input type="text" name="nbChambre" id="nbChambre" value="{$nbChambre}"  class="form-control"/>
    </div>
</div>
<div class="form-group">
    <label class="col-sm-2 control-label" for="surfaceHab">Surface habitable :</label>
    <div class="col-sm-8">
        <input type="text"  name="surfaceHab" id="surfaceHab" value="{$surfaceHab}"  class="form-control"/>
    </div>
</div>
<div class="form-group">
    <label class="col-sm-2 control-label" for="superficieTotale">Surface terrain : </label>
    <div class="col-sm-8">
        <input type="text" name="superficieTotale" id="superficieTotale" value="{$superficieTotale}"  class="form-control"/>
    </div>
</div>
<div class="form-group">
    <label class="col-sm-2 control-label" for="surfacePieceVie">Surface pièce vie : </label>
    <div class="col-sm-8">
        <input type="text" name="surfacePieceVie" id="surfacePieceVie" value="{$surfacePieceVie}" class="form-control" />
    </div>
</div>
<div class="form-group">
    <label class="col-sm-2 control-label" for="niveau">Niveau : </label>
    <div class="col-sm-8">
        <input type="text" name="niveau" id="niveau" value="{$niveau}" class="form-control" />
    </div>
</div>
<div class="form-group">
    <label class="col-sm-2 control-label" for="anneeConstruction">Année construction :</label>
    <div class="col-sm-8">
        <input type="text" name="anneeConstruction" id="anneeConstruction" value="{$anneeConstruction}" class="form-control" />
    </div>
</div>
<div class="form-group">
    <label class="col-sm-2 control-label" for="nouveauteSite">Nouveauté ( site Internet) :</label>
    <div class="col-sm-8">
        <input type="text" name="nouveauteSite" id="nouveauteSite" class="datepicker form-control" value="{$nouveauteSite}" />
    </div>
</div>
<div class="form-group">
    <label class="col-sm-2 control-label" for="chargesMensuelle">Charges mensuelles :</label>
    <div class="col-sm-8">
        <input type="text" name="chargesMensuelle" id="chargesMensuelle" value="{$chargesMensuelle}" class="form-control" />
    </div>
</div>
<div class="form-group">
    <label class="col-sm-2 control-label" for="taxesFoncieres">Taxes foncières : </label>
    <div class="col-sm-8">
        <input type="text" name="taxesFoncieres" id="taxesFoncieres" value="{$taxesFoncieres}" class="form-control" />
    </div>
</div>
<div class="form-group">
    <label class="col-sm-2 control-label" for="taxeHabitation">Taxe Habitation :</label>
    <div class="col-sm-8">
        <input type="text" name="taxeHabitation" id="taxeHabitation" value="{$taxeHabitation}"  class="form-control"/>
    </div>
</div>
<div class="form-group">
    <label class="col-sm-2 control-label" for="numbergarage">Numéro garage : </label>
    <div class="col-sm-8">
        <input type="text" name="numbergarage" id="numbergarage" value="{$numbergarage}" class="form-control" />
    </div>
</div>
<div class="form-group">
    <label class="col-sm-2 control-label" for="numbercellar">Numéro cave : </label>
    <div class="col-sm-8">
        <input type="text" name="numbercellar" id="numbercellar" value="{$numbercellar}"  class="form-control"/>
    </div>
</div>
<div class="form-group">
    <label class="col-sm-2 control-label" for="numberparking">Numéro parking : </label>
    <div class="col-sm-8">
        <input type="text" name="numberparking" id="numberparking" value="{$numberparking}" class="form-control" />
    </div>
</div>
<div class="form-group">
    <label class="col-sm-2 control-label" for="numberattic">Numéro grenier : </label>
    <div class="col-sm-8">
        <input type="text" name="numberattic" id="numberattic" value="{$numberattic}" class="form-control" />
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


<div class="form-group">
    <label class="col-sm-2 control-label" for="insulation"> Isolation :</label>
    <div class="col-sm-8">
        <select name="insulation" id="insulation" class="form-control">
            <option value="0">Non spécifié</option>
            {foreach from=$listInsulation item=item}
                <option value="{$item->getIdMandateInsulation()}" {if $item->getIdMandateInsulation() eq $insulation} selected="selected"{/if}>{$item->getName()}</option>
            {/foreach}
        </select>
    </div>
</div>

<div class="form-group">
    <label class="col-sm-2 control-label" for="roof"> Toiture :  </label>
    <div class="col-sm-8">
        <select name="roof" id="roof" class="form-control">
            <option value="0">Non spécifié</option>
            {foreach from=$listRoof item=item}
                <option value="{$item->getIdMandateRoof()}" {if $item->getIdMandateRoof() eq $roof} selected="selected"{/if}>{$item->getName()}</option>
            {/foreach}
        </select>
    </div>
</div>


<div class="form-group">
    <label class="col-sm-2 control-label" for="heating"> Chauffage : </label>
    <div class="col-sm-8">
        <select name="heating" id="heating" class="form-control">
            <option value="0">Non spécifié</option> {foreach from=$listHeating item=item}
                <option value="{$item->getIdMandateHeating()}" {if $item->getIdMandateHeating() eq $heating} selected="selected"{/if}>{$item->getName()}</option>
            {/foreach}
        </select>
    </div>
</div>


<div class="form-group">
    <label class="col-sm-2 control-label" for="commonOwnership"> Parties communes :</label>
    <div class="col-sm-8">
        <select name="commonOwnership" id="commonOwnership" class="form-control">
            <option value="0">Non spécifié</option>
            {foreach from=$listCommonOwnership item=item}
                <option value="{$item->getIdMandateCommonOwnership()}" {if $item->getIdMandateCommonOwnership() eq $commonOwnership} selected="selected"{/if}>{$item->getName()}</option>
            {/foreach}
        </select>
    </div>
</div>


<div class="form-group">
    <label class="col-sm-2 control-label" for="constructionType"> Type de construction :</label>
    <div class="col-sm-8">
        <select name="constructionType" id="constructionType" class="form-control">
            <option value="0">Non spécifié</option>
            {foreach from=$listConstructionType item=item}
                <option value="{$item->getIdMandateConstructionType()}" {if $item->getIdMandateConstructionType() eq $constructionType} selected="selected"{/if}>{$item->getName()}</option>
            {/foreach}
        </select>
    </div>
</div>

<div class="form-group">
    <label class="col-sm-2 control-label" for="style"> Style : </label>
    <div class="col-sm-8">
        <select name="style" id="style" class="form-control">
            <option value="0">Non spécifié</option>
            {foreach from=$listStyle item=item}
                <option value="{$item->getIdMandateStyle()}" {if $item->getIdMandateStyle() eq $style} selected="selected"{/if}>{$item->getName()}</option>
            {/foreach}
        </select>
    </div>
</div>

<div class="form-group">
    <label class="col-sm-2 control-label" for="ne"> Nouveautés :</label>
    <div class="col-sm-8">
        <select name="ne" id="ne" class="form-control">
            <option value="0">Non spécifié</option>
            {foreach from=$listNews item=item}
                <option value="{$item->getIdMandateNews()}" {if $item->getIdMandateNews() eq $ne} selected="selected"{/if}>{$item->getName()}</option>
            {/foreach}
        </select>
    </div>
</div>


<div class="form-group">
    <label class="col-sm-2 control-label" for="conditions"> Conditions :</label>
    <div class="col-sm-8">
        <select name="conditions" id="conditions" class="form-control">
            <option value="0">Non spécifié</option>
            {foreach from=$listConditions item=item}
                <option value="{$item->getIdMandateCondition()}" {if $item->getIdMandateCondition() eq $conditions} selected="selected"{/if}>{$item->getName()}</option>
            {/foreach}
        </select>
    </div>
</div>

<div class="form-group">
    <label class="col-sm-2 control-label" for="adjoining"> Mitoyenneté : </label>
    <div class="col-sm-8">
        <select name="adjoining" id="adjoining" class="form-control">
            <option value="0">Non spécifié</option>
            {foreach from=$listAdjoining item=item}
                <option value="{$item->getId()}" {if $item->getId() eq $adjoining} selected="selected"{/if}>{$item->getName()}</option>
            {/foreach}
        </select>
    </div>
</div>


<div class="form-group">
    <div class="col-sm-offset-2 col-sm-8">
        <button type="submit" name="valid" value="Valider" class="btn btn-warning" >
            <i class="fa fa-save"></i> Mettre à jour
            </button>
        <button type="submit" name="cancel" value="Annuler" class="btn btn-default">
            <i class="fa fa-close"></i> Annuler et fermer
            </button>
    </div>
</div>
</form>
</div>
