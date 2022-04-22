{include file="tpl_default/entete.tpl"}
<form action="" method="post" role="form" class="form-horizontal" xmlns="http://www.w3.org/1999/html">

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



<fieldset>
    <legend>Superficie</legend>
    <div class="form-group">
        <label class="col-sm-2 control-label" for="superficieParcelle1">Superficie parcelle 1 :</label>
        <div class="col-sm-8">
            <input type="text" class="form-control" name="superficieParcelle1" id="superficieParcelle1" value="{$superficieParcelle1}" />
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-2 control-label" for="superficieParcelle2">Superficie parcelle 2 :</label>
        <div class="col-sm-8">
            <input type="text" class="form-control" name="superficieParcelle2" id="superficieParcelle2" value="{$superficieParcelle2}" />
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-2 control-label" for="superficieParcelle3">Superficie parcelle 3 :</label>
        <div class="col-sm-8">
            <input type="text" class="form-control" name="superficieParcelle3" id="superficieParcelle3" value="{$superficieParcelle3}" />
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-2 control-label" for="superficieAutreParcelle">Superficie autres parcelle : </label>
        <div class="col-sm-8">
            <input type="text" class="form-control" name="superficieAutreParcelle" id="superficieAutreParcelle" value="{$superficieAutreParcelle}" />
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-2 control-label" for="superficieConstructible">Superficie constructible : </label>
        <div class="col-sm-8">
            <input type="text" class="form-control" name="superficieConstructible" id="superficieConstructible" value="{$superficieConstructible}" />
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-2 control-label" for="superficieNonConstructible">Superficie non constructible : </label>
        <div class="col-sm-8">
            <input type="text" class="form-control" name="superficieNonConstructible" id="superficieNonConstructible" value="{$superficieNonConstructible}" />
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-2 control-label" for="superficieTotale">Superficie totale :</label>
        <div class="col-sm-8">
            <input type="text" class="form-control" name="superficieTotale" id="superficieTotale" value="{$superficieTotale}" />
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-2 control-label" for="nouveauteSite">Nouveauté ( site Internet) :</label>
        <div class="col-sm-8">
            <input type="text" class="form-control" name="nouveauteSite" id="nouveauteSite" class="datepicker" value="{$nouveauteSite}" />
        </div>
    </div>

    {if !empty($listGeometer)}
        <div class="form-group">
            <label class="col-sm-2 control-label" for="idGeometer">géometre :</label>
            <div class="col-sm-8">
                <select name="idGeometer" id="idGeometer" class="form-control">
                    <option value="">Non renseigné</option>
                    {foreach from=$listGeometer item=item}
                        <option {if $item->getIdMandateGeometer() eq $idGeometer}selected="selected" {/if}value="{$item->getIdMandateGeometer()}"> {$item->getName()}</option>
                    {/foreach}
                </select>
            </div>
        </div>
    {/if} {if !empty($listBornageTerrain)}
        <div class="form-group">
            <label class="col-sm-2 control-label" for="idBornageTerrain">Bornage :</label>
            <div class="col-sm-8">
                <select name="idBornageTerrain" id="idBornageTerrain" class="form-control">
                    <option value="">Non renseigné</option>
                    {foreach from=$listBornageTerrain item=item}
                        <option {if $item->getIdMandateBornageTerrain() eq $idBornageTerrain}selected="selected" {/if}value="{$item->getIdMandateBornageTerrain()}">{$item->getName()}</option> {/foreach}
                </select>
            </div>
        </div>
    {/if}
</fieldset>
<fieldset>
    <legend>Description</legend>
    {if !empty($listOrientation)}
        <div class="form-group">
            <label class="col-sm-2 control-label" for="idOrientation">Orientation :</label>
            <div class="col-sm-8">
                <select name="idOrientation" id="idOrientation" class="form-control">
                    <option value="">Non renseigné</option>
                    {foreach from=$listOrientation item=item}
                        <option {if $item->getIdMandateOrientation() eq $idOrientation}selected="selected" {/if}value="{$item->getIdMandateOrientation()}">{$item->getName()}</option>
                    {/foreach}
                </select>
            </div>
        </div>
    {/if} {if !empty($listSlope)}
        <div class="form-group">
            <label class="col-sm-2 control-label" for="idSlope">Pente :</label>
            <div class="col-sm-8">
                <select name="idSlope" class="form-control" id="idSlope">
                    <option value="">Non renseigné</option>
                    {foreach from=$listSlope item=item}
                        <option {if $item->getIdMandateSlope() eq $idSlope}selected="selected" {/if}value="{$item->getIdMandateSlope()}"> {$item->getName()}</option>
                    {/foreach}
                </select>
            </div>
        </div>
    {/if}
    <div class="form-group">
        <label class="col-sm-2 control-label" for="tailleFacade">Taille de la façade :</label>
        <div class="col-sm-8">
            <input class="form-control" type="text" name="tailleFacade" id="tailleFacade" value="{$tailleFacade}" />
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-2 control-label" for="profondeurTerrain">Profondeur du terrain :</label>
        <div class="col-sm-8">
            <input type="text" name="profondeurTerrain" id="profondeurTerrain" value="{$profondeurTerrain}" class="form-control"/>
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-2 control-label" for="proximiteEcole">Proximité école :</label>
        <div class="col-sm-8">
            <input class="form-control" type="text" name="proximiteEcole" id="proximiteEcole" value="{$proximiteEcole}" />
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-2 control-label" for="proximiteCommerce">Proximité commerce :</label>
        <div class="col-sm-8">
            <input class="form-control" type="text" name="proximiteCommerce" id="proximiteCommerce" value="{$proximiteCommerce}" />
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-2 control-label" for="proximiteTransport">Proximité transport :</label>
        <div class="col-sm-8">
            <input class="form-control" type="text" name="proximiteTransport" id="proximiteTransport" value="{$proximiteTransport}" />
        </div>
    </div>
</fieldset>

<fieldset>
    <legend>Cadastre</legend>
    <div class="form-group">
        <label class="col-sm-2 control-label" for="refCadastre1">Ref cadastre parcelle 1 :</label>
        <div class="col-sm-8">
            <input class="form-control" type="text" name="refCadastre1" id="refCadastre1" value="{$refCadastre1}" />
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-2 control-label" for="refCadastre2">Ref cadastre parcelle 2 :</label>
        <div class="col-sm-8">
            <input class="form-control" type="text" name="refCadastre2" id="refCadastre2" value="{$refCadastre2}" />
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-2 control-label" for="refCadastre3">Ref cadastre parcelle 3 :</label>
        <div class="col-sm-8">
            <input class="form-control" type="text" name="refCadastre3" id="refCadastre3" value="{$refCadastre3}" />
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-2 control-label" for="autreRefCadastre">Autre ref cadastre : </label>
        <div class="col-sm-8">
            <input class="form-control" type="text" name="autreRefCadastre" id="autreRefCadastre" value="{$autreRefCadastre}" />
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-2 control-label" for="numLot">Numéro de lot :</label>
        <div class="col-sm-8">
            <input class="form-control" type="text" name="numLot" id="numLot" value="{$numLot}" />
        </div>
    </div>
</fieldset>
<fieldset>
    <legend>Autorisation : DP</legend>

    <div class="form-group">

        <div class="col-sm-offset-2 col-sm-10">
            <label for="dPValideFalse" class="radio-inline">
                <input type="radio" {if $dPValide eq 0} checked="checked" {/if} value="0" name="dPValide" id="dPValideFalse" />
                DP invalide</label>

            <label for="dPValideTrue" class="radio-inline">
                <input type="radio" {if $dPValide eq 1} checked="checked" {/if} value="1" name="dPValide" id="dPValideTrue" />
                DP valide</label>

        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-2 control-label" for="dateDeclPrealableDP">Date déclaration préalable :</label>
        <div class="col-sm-8">
            <input class="datepicker form-control" type="text" name="dateDeclPrealableDP" id="dateDeclPrealableDP" value="{$dateDeclPrealableDP}" />
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-2 control-label" for="dateProrogationDP">Prorogation DP jusqu'au : </label>
        <div class="col-sm-8">
            <input class="datepicker form-control" type="text" name="dateProrogationDP" id="dateProrogationDP" value="{$dateProrogationDP}" />
        </div>
    </div>

</fieldset>
<fieldset>
    <legend>Autorisation : CU</legend>


    <div class="form-group">

        <div class="col-sm-offset-2 col-sm-10">
            <label for="cuValideFalse" class="radio-inline">
                <input type="radio" value="0" {if $cuValide eq 0} checked="checked" {/if} name="cuValide" id="cuValideFalse" />
                CU invalide</label>

            <label for="cuValideTrue" class="radio-inline">
                <input type="radio" value="1" {if $cuValide eq 1} checked="checked" {/if}name="cuValide" id="cuValideTrue" />
                CU valide</label>
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-2 control-label" for="dateDeclPrealableCU">Date déclaration préalable :</label>
        <div class="col-sm-8">
            <input class="datepicker form-control" type="text" name="dateDeclPrealableCU" id="dateDeclPrealableCU" value="{$dateDeclPrealableCU}" />
        </div>
    </div>

    <div class="form-group">
        <label class="col-sm-2 control-label" for="dateProrogationCU">Prorogation CU jusqu'au : </label>
        <div class="col-sm-8">
            <input class="datepicker form-control" type="text" name="dateProrogationCU" id="dateProrogationCU" value="{$dateProrogationCU}" />
        </div>
    </div>
</fieldset>
<fieldset>
    <legend>CU OPS</legend>



    <div class="form-group">

        <div class="col-sm-offset-2 col-sm-10">
            <label for="cuOpsValideFalse" class="radio-inline">
                <input type="radio" {if $cuOpsValide eq 0} checked="checked" {/if} value="0" name="cuOpsValide" id="cuOpsValideFalse" />
                CU OPS invalide</label>

            <label for="cuOpsValideTrue" class="radio-inline">
                <input type="radio" {if $cuOpsValide eq 1} checked="checked" {/if} value="1" name="cuOpsValide" id="cuOpsValideTrue" />
                CU OPS valide</label>
        </div>
    </div>

    <div class="form-group">
        <label class="col-sm-2 control-label" for="dateDeclPrealableCUOPS">Date déclaration préalable : </label>
        <div class="col-sm-8">
            <input class="form-control datepicker" type="text" name="dateDeclPrealableCUOPS" id="dateDeclPrealableCUOPS" value="{$dateDeclPrealableCUOPS}" />
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-2 control-label" for="dateProrogationCUOPS">Prorogation CU Ops jusqu'au :</label>
        <div class="col-sm-8">
            <input class="datepicker form-control" type="text" name="dateProrogationCUOPS" id="dateProrogationCUOPS" value="{$dateProrogationCUOPS}" />
        </div>
    </div>
</fieldset>
<fieldset>
    <legend>Permis d'amenager</legend>

    <div class="form-group">

        <div class="col-sm-offset-2 col-sm-10">
            <label for="permisAmenagerValideFalse" class="radio-inline">
                <input type="radio" value="0" {if $permisAmenagerValide eq 0} checked="checked" {/if} name="permisAmenagerValide" id="permisAmenagerValideFalse" />
                Permis d'amenager invalide</label>

            <label for="permisAmenagerValideTrue" class="radio-inline">
                <input type="radio" value="1" {if $permisAmenagerValide eq 1} checked="checked" {/if}  name="permisAmenagerValide" id="permisAmenagerValideTrue" />
                Permis d'amenager valide</label>
        </div>
    </div>

    <div class="form-group">
        <label class="col-sm-2 control-label" for="datePermisAmenager">Date de permis d'amenager :</label>
        <div class="col-sm-8">
            <input class="datepicker form-control" type="text" name="datePermisAmenager" id="datePermisAmenager" value="{$datePermisAmenager}" />
        </div>
    </div>



</fieldset>

<fieldset>
    <legend>Réglementation</legend>
    {if !empty($listZonagePlu)}
        <div class="form-group">
            <label class="col-sm-2 control-label" for="idZonagePlu">Zonage PLU :</label>
            <div class="col-sm-8">
                <select class="form-control" name="idZonagePlu" id="idZonagePlu">
                    <option value="">Non renseigné</option> {foreach
                    from=$listZonagePlu item=item}
                        <option {if $item->getIdMandateZonagePlu() eq
                        $idZonagePlu}selected="selected"
                                {/if}value="{$item->getIdMandateZonagePlu()}"> {$item->getName()}</option>
                    {/foreach}
                </select>
            </div>
        </div>
    {/if} {if !empty($listZonageRnu)}
        <div class="form-group">
            <label class="col-sm-2 control-label" for="idZonageRnu">Zonage RNU :</label>
            <div class="col-sm-8">
                <select class="form-control" name="idZonageRnu" id="idZonageRnu">
                    <option value="">Non renseigné</option> {foreach
                    from=$listZonageRnu item=item}
                        <option {if $item->getIdMandateZonageRnu() eq
                        $idZonageRnu}selected="selected"
                                {/if}value="{$item->getIdMandateZonageRnu()}"> {$item->getName()}</option>
                    {/foreach}
                </select>
            </div>
        </div>
    {/if} {if !empty($listCos)}
        <div class="form-group">
            <label class="col-sm-2 control-label" for="idCos">COS :</label>
            <div class="col-sm-8">
                <select class="form-control" name="idCos" id="idCos">
                    <option value="">Non renseigné</option> {foreach from=$listCos
                    item=item}
                        <option {if $item->getIdMandateCos() eq $idCos}selected="selected"
                                {/if}value="{$item->getIdMandateCos()}"> {$item->getName()}</option>
                    {/foreach}
                </select>
            </div>
        </div>
    {/if}
    <div class="form-group">
        <label class="col-sm-2 control-label" for="shonAccordee">Shon accordée :</label>
        <div class="col-sm-8">
            <input type="text" class="form-control" name="shonAccordee" id="shonAccordee" value="{$shonAccordee}" />
        </div>
    </div>






    <div class="form-group">

        <div class="col-sm-offset-2 col-sm-10">

            <label for="zonebdfFalse" class="radio-inline">
                <input type="radio" {if $zonebdf eq 0}checked="checked" {/if} value="0" name="zonebdf" id="zonebdfFalse" />
                Hors zone BDF</label>
            <label for="zonebdfTrue" class="radio-inline">
                <input type="radio" {if $zonebdf eq 1}checked="checked" {/if} value="1" name="zonebdf" id="zonebdfTrue" />
                En zone BDF</label>
        </div>
    </div>
    <div class="form-group">

        <div class="col-sm-offset-2 col-sm-10" >
            <label for="ligneCreteFalse" class="radio-inline">
                <input {if $ligneCrete eq 0}checked="checked" {/if} type="radio" value="0" name="ligneCrete" id="ligneCreteFalse" />
                Hors ligne de crête</label>
            <label for="ligneCreteTrue" class="radio-inline">
                <input type="radio" {if $ligneCrete eq 1}checked="checked" {/if} value="1" name="ligneCrete" id="ligneCreteTrue" />
                En ligne de crête</label>
        </div>
    </div>
    <div class="form-group">

        <div class="col-sm-offset-2 col-sm-10" >
            <label for="zoneInondableFalse" class="radio-inline">
                <input type="radio" value="0" {if $zoneInondable eq 0} checked="checked" {/if}  name="zoneInondable" id="zoneInondableFalse" />
                Hors zone inondable</label>
            <label for="zoneInondableTrue" class="radio-inline">
                <input type="radio" value="1" {if $zoneInondable eq 1} checked="checked" {/if} name="zoneInondable" id="zoneInondableTrue" />
                En zone inondable</label>
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-2 control-label"  for="reglementLotissement">Réglement lotissement :</label>
        <div class="col-sm-8">
            <textarea class="form-control" name="reglementLotissement" id="reglementLotissement" cols="30" rows="10">{$reglementLotissement}</textarea>
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-2 control-label"  for="ernt">ERNT :</label>
        <div class="col-sm-8">
            <textarea class="form-control" name="ernt" id="ernt" cols="30" rows="10">{$ernt}</textarea>
        </div>
    </div>
</fieldset>
<fieldset>
    <legend>Viabilisation</legend>
    <!-- Select à faire -->
    {* <p> Terrain vendu viabilisé : <label
    for="terrainViabiliseFalse"><input type="radio" {if $terrainViabilise
    eq 0} checked="checked" {/if} value="0" name="terrainViabilise"
    id="terrainViabiliseFalse" />Non</label><label
    for="terrainViabiliseTrue"><input type="radio" {if $terrainViabilise
    eq 1} checked="checked" {/if} value="1" name="terrainViabilise"
    id="terrainViabiliseTrue" />Oui</label> </p> <p> Terrain vendu semi
    viabilisé : <label for="terrainSemiViabiliseFalse"><input
    type="radio" value="0" {if $terrainSemiViabilise eq 0}
    checked="checked" {/if} name="terrainSemiViabilise"
    id="terrainSemiViabiliseFalse" />Non</label><label
    for="terrainSemiViabiliseTrue"><input type="radio" value="1"
    name="terrainSemiViabilise" {if $terrainSemiViabilise eq 1}
    checked="checked" {/if} id="terrainSemiViabiliseTrue" />Oui</label>
    </p> <p> Terrain vendu non viabilisé : <label
    for="terrainNonViabiliseFalse"><input type="radio" value="0" {if
    $terrainNonViabilise eq 0} checked="checked" {/if}
    name="terrainNonViabilise" id="terrainNonViabiliseFalse"
    />Non</label><label for="terrainNonViabiliseTrue"><input type="radio"
    value="1" name="terrainNonViabilise" {if $terrainNonViabilise eq 1}
    checked="checked" {/if} id="terrainNonViabiliseTrue" />Oui</label>
    </p> *}

    <div class="form-group">
        <label class="col-sm-2 control-label" for="terrainVendu">Terrain vendu :</label>
        <div class="col-sm-8">
            <select name="terrainVendu" id="terrainVendu" class="form-control">
                <option value="0" {if $terrainVendu eq 0} selected="selected"{/if}>Non
                    renseigné</option>
                <option value="1" {if $terrainVendu eq 1} selected="selected"{/if}>Viabilisé</option>
                <option value="2" {if $terrainVendu eq 2} selected="selected"{/if}>Semi
                    viabilisé</option>
                <option value="3" {if $terrainVendu eq 3} selected="selected"{/if}>Non
                    viabilisé</option>
            </select>
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-2 control-label" for="passageEau">Passage eau :</label>
        <div class="col-sm-8">
            <textarea name="passageEau" id="passageEau" cols="30" rows="10" class="form-control">{$passageEau}</textarea>
        </div>
    </div>
    {if !empty($listWaterCorresponding)}
        <div class="form-group">
            <label class="col-sm-2 control-label" for="idWaterCorresponding">Correspondant eau :</label>
            <div class="col-sm-8">
                <select name="idWaterCorresponding" id="idWaterCorresponding" class="form-control">
                    <option value="">Non renseigné</option> {foreach
                    from=$listWaterCorresponding item=item}
                        <option {if $item->getIdMandateWaterCorresponding() eq
                        $idWaterCorresponding}selected="selected"
                                {/if}value="{$item->getIdMandateWaterCorresponding()}">
                            {$item->getName()}</option> {/foreach}
                </select>
            </div>
        </div>
    {/if}

    <div class="form-group">
        <label class="col-sm-2 control-label" for="passageElectricite">Passage éléctricité :</label>
        <div class="col-sm-8">
            <textarea name="passageElectricite" id="passageElectricite" cols="30" rows="10" class="form-control">{$passageElectricite}</textarea>
        </div>
    </div>
    {if !empty($listElectricCorresponding)}

        <div class="form-group">
            <label class="col-sm-2 control-label" for="idElectricCorresponding">Correspondant electrique :</label>
            <div class="col-sm-8">
                <select name="idElectricCorresponding"  id="idElectricCorresponding" class="form-control">
                    <option value="">Non renseigné</option> {foreach
                    from=$listElectricCorresponding item=item}
                        <option {if $item->getIdMandateElectricCorresponding() eq
                        $idElectricCorresponding}selected="selected"
                                {/if}value="{$item->getIdMandateElectricCorresponding()}">
                            {$item->getName()}</option> {/foreach}
                </select>
            </div>
        </div>
    {/if}

    <div class="form-group">
        <label class="col-sm-2 control-label" for="passageGaz">Passage gaz :</label>
        <div class="col-sm-8">
            <textarea name="passageGaz" id="passageGaz" cols="30" rows="10" class="form-control">{$passageGaz}</textarea>
        </div>
    </div>
    {if !empty($listGazCorresponding)}
        <div class="form-group">
            <label class="col-sm-2 control-label" for="idGazCorresponding">Correspondant gaz :</label>
            <div class="col-sm-8">
                <select name="idGazCorresponding" id="idGazCorresponding" class="form-control">
                    <option value="">Non renseigné</option> {foreach
                    from=$listGazCorresponding item=item}
                        <option {if $item->getIdMandateGazCorresponding() eq
                        $idGazCorresponding}selected="selected"
                                {/if}value="{$item->getIdMandateGazCorresponding()}">
                            {$item->getName()}</option> {/foreach}
                </select>
            </div>
        </div>
    {/if} {* <p> Tout à l'égout : <label for="toutEgoutFalse"><input
			type="radio" {if $toutEgout eq 0} checked="checked" {/if} value="0"
			name="toutEgout" id="toutEgoutFalse" />Non</label><label
			for="toutEgoutTrue"><input type="radio" value="1" {if $toutEgout eq
			1} checked="checked" {/if} name="toutEgout" id="toutEgoutTrue"
			/>Oui</label> </p> <p> Assainissement par fosse sceptique : <label
			for="assainissementFosseSceptiqueFalse"><input
			id="assainissementFosseSceptiqueFalse" type="radio" {if
			$assainissementFosseSceptique eq 0} checked="checked" {/if} value="0"
			name="assainissementFosseSceptique" />Non</label><label
			for="assainissementFosseSceptiqueTrue"><input type="radio" value="1"
			{if $assainissementFosseSceptique eq 1} checked="checked" {/if}
			name="assainissementFosseSceptique"
			id="assainissementFosseSceptiqueTrue" />Oui</label> </p> *}
    <div class="form-group">
        <label class="col-sm-2 control-label" for="assainissement">Assainissement : </label>
        <div class="col-sm-8">
            <select name="assainissement" id="assainissement" class="form-control">
                <option value="0" {if $assainissement eq 0} selected="selected"{/if}>Non
                    renseigné</option>
                <option value="1" {if $assainissement eq 1} selected="selected"{/if}>Tout
                    à l'égout</option>
                <option value="2" {if $assainissement eq 2} selected="selected"{/if}>Fosse
                    sceptique</option>
            </select>
        </div>
    </div>
    {if !empty($listSanitationCorresponding)}
        <div class="form-group">
            <label class="col-sm-2 control-label" for="idSanitationCorresponding">Correspondant sanitaire : </label>
            <div class="col-sm-8">
                <select name="idSanitationCorresponding" id="idSanitationCorresponding" class="form-control">
                    <option value="">Non renseigné</option> {foreach
                    from=$listSanitationCorresponding item=item}
                        <option {if $item->getIdMandateSanitationCorresponding() eq
                        $idSanitationCorresponding}selected="selected"
                                {/if}value="{$item->getIdMandateSanitationCorresponding()}">
                            {$item->getName()}</option> {/foreach}
                </select>
            </div>
        </div>
    {/if}
    <div class="form-group">
        <label class="col-sm-2 control-label" for="voirie">Voirie :</label>
        <div class="col-sm-8">
            <textarea name="voirie" id="voirie" cols="30" rows="10" class="form-control">{$voirie}</textarea>
        </div>
    </div>






</fieldset>

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

