{include file="tpl_default/entete.tpl"}
<div class="row bg-success bannerTitle">
    <div class="col-md-12">
        <h1 class="h2">Dupliquer le mandat (terrain)</h1>
    </div>

</div>
<form action="" method="post" {* enctype="multipart/form-data"*}  role="form" class="form-horizontal">

{include file="tpl_default/error.tpl"}




{* N'apparait que si l'utilisateur a un grade supérieur à opérateur *}
{if !empty($listUser)}
    <fieldset>
        <legend>Utilisateur</legend>
        <div class="form-group">
            <label class="col-sm-2 control-label" for="idUser">Utilisateur affecté au mandat :</label>
            <div class="col-sm-8"><select
                        name="idUser" id="idUser" class="form-control"> {foreach from=$listUser item=item}
                        <option {if $item->getIdUser() eq $idUser}selected="selected"
                                {/if}value="{$item->getIdUser()}">{$item->getFirstname()}
                            {$item->getName()}</option> {/foreach}
                </select>
            </div>
            <input type="hidden" name="typeTransaction"
                   value="{Constant::ID_ETAP_TO_SELL}" /> <input type="hidden"
                                                                 name="typeBien" value="{Constant::ID_PLOT_OF_LAND}" />


        </div>
    </fieldset>
{/if} {* Apparait à tout le monde*} {* <fieldset> <legend>Vendeur
		principal</legend> {include file='seller/views/frm_add_seller.tpl'}
		</fieldset> *}


<fieldset>
    <legend>Infos mandat</legend>

    <h2>Type de terrain :</h2>
    <div class="form-group">
        <div class="col-sm-offset-2 col-sm-8">
            <div class="checkbox">
                <label for="aBatir"> <input type="radio" name="typeTerrain" id="aBatir" {if $typeTerrain==1}
                        checked="checked" {/if} value="1" /> À batir</label>
            </div>
        </div>
    </div>
    <div class="form-group">
        <div class="col-sm-offset-2 col-sm-8">
            <div class="checkbox">
                <label for="alotir"> <input type="radio"  name="typeTerrain" id="alotir" {if $typeTerrain==2}
                        checked="checked" {/if} value="2" /> À lotir</label>
            </div>
        </div>
    </div>


    <h2>Situation du terrain :</h2>
    <div class="form-group">
        <div class="col-sm-offset-2 col-sm-8">
            <div class="checkbox">
                <label for="lotissement">
                    <input type="radio" name="situationTerrain" id="lotissement" {if $situationTerrain==1}
                        checked="checked" {/if} value="1" /> Lotissement</label>
            </div>
        </div>
    </div>
    <div class="form-group">
        <div class="col-sm-offset-2 col-sm-8">
            <div class="checkbox">
                <label for="diffus"> <input
                            type="radio" name="situationTerrain" id="diffus"
                            {if $situationTerrain==2} checked="checked" {/if} value="2" />
                    Diffus ( hors lotissement)</label>
            </div>
        </div>
    </div>


    <div class="form-group">
        <label class="col-sm-2 control-label" for="nature">Nature du bien :</label>

        <div class="col-sm-8">
            <select name="nature" class="form-control"
                    id="nature"> {foreach from=$listNature item=tb}

                    <option {if $tb->getIdMandateNature() eq $nature}
                        selected="selected" {/if}
                            value="{$tb->getIdMandateNature()}">{$tb->getName()}</option>

                {/foreach}
            </select>
        </div>
    </div>


    {if !empty($listNotary)}
        <div class="form-group">
            <label class="col-sm-2 control-label" for="idNotary">Notaire :</label>

            <div class="col-sm-8"><select name="idNotary" class="form-control"
                                          id="idNotary"> {foreach from=$listNotary item=item}
                        <option {if $item->getIdNotary() eq $idNotary}selected="selected"
                                {/if}value="{$item->getIdNotary()}"> {$item->getName()}</option>
                    {/foreach}
                </select>
            </div>
        </div>
    {/if} {if !empty($listNotary)}
        <div class="form-group">
            <label class="col-sm-2 control-label" for="idNotaryAcq">Notaire acquereur :</label>
            <div class="col-sm-8">
                <select class="form-control"
                        name="idNotaryAcq" id="idNotaryAcq">
                    <option value="">NC</option> {foreach from=$listNotary item=item}
                        <option {if $item->getIdNotary() eq
                        $idNotaryAcq}selected="selected"
                                {/if}value="{$item->getIdNotary()}"> {$item->getName()}</option>
                    {/foreach}
                </select>
            </div>
        </div>
    {/if}
    <div class="form-group">
        <label class="col-sm-2 control-label" for="numMandat">N° Mandat :</label>
        <div class="col-sm-8">
            <input type="text"
                   name="numMandat" id="numMandat" value="{$numMandat}" class="form-control"/>
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-2 control-label" for="debutMandat">Début : </label>
        <div class="col-sm-8">
            <input class="datepicker form-control"
                   type="text" name="debutMandat" id="debutMandat"
                   value="{$debutMandat}" />
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-2 control-label" for="finMandat">Fin :</label>
        <div class="col-sm-8">
            <input class="datepicker form-control"
                   type="text" name="finMandat" id="finMandat" value="{$finMandat}" />
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-2 control-label" for="libreMandat">libre le :</label>

        <div class="col-sm-8"><input
                    class="datepicker form-control" type="text" name="libreMandat" id="libreMandat"
                    value="{$libreMandat}" />
        </div>
    </div>

</fieldset>

<fieldset>
<legend>Biens</legend>
<fieldset>
    <legend>Localisation</legend>
    <div class="form-group">
        <label class="col-sm-2 control-label" for="adresseMandat">Adresse : </label>
        <div class="col-sm-8">
            <input type="text"
                   name="adresseMandat" id="adresseMandat" value="{$adresseMandat}"  class="form-control"/>
        </div>
    </div>
    {if !empty($listCity)}
        <div class="form-group">
            <label class="col-sm-2 control-label" for="idCity">Ville : </label>
            <div class="col-sm-8">
                <select name="idCity" class="form-control"
                        id="idCity"> {foreach from=$listCity item=item}
                        <option {if $item->getIdCity() eq $idCity}selected="selected"
                                {/if}value="{$item->getIdCity()}"> {$item->getZipCode()} -
                            {$item->getName()}</option> {/foreach}
                </select>
            </div>
        </div>
    {/if}
</fieldset>
<fieldset >
    <legend>Prix</legend>

    <div class="form-group">
        <label class="col-sm-2 control-label" for="prixFai"><span id="jsPrixFai">Prix FAI</span> :</label>
        <div class="col-sm-8">
            <input type="text" name="prixFai" id="prixFai" value="{$prixFai}" class="form-control"/>
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-2 control-label" for="prixNetVendeur"><span id="jsPrixNetVendeur">Prix net
							vendeur</span> :</label>
        <div class="col-sm-8">
            <input type="text" name="prixNetVendeur"
                   id="prixNetVendeur" value="{$prixNetVendeur}" class="form-control"/>
        </div>
    </div>
    <div class="form-group" id="jsCommission">
        <label class="col-sm-2 control-label" for="commissionMandat">Commission :</label>
        <div class="col-sm-8">
            <input
                    type="text" name="commissionMandat" id="commissionMandat"
                    value="{$commissionMandat}" class="form-control" />
        </div>
    </div>
    <div class="form-group" id="jsEstim">
        <label class="col-sm-2 control-label" for="estimationFai">Estimation FAI :</label>

        <div class="col-sm-8"><input
                    type="text" name="estimationFai" id="estimationFai"
                    value="{$estimationFai}" class="form-control"/>
        </div>
    </div>
    <div class="form-group" id="jsMargeNegoce">
        <label class="col-sm-2 control-label" for="margeNegoce">Marge negoce :</label>
        <div class="col-sm-8">
            <input type="text"
                   name="margeNegoce" id="margeNegoce" value="{$margeNegoce}" class="form-control"/>
        </div>
    </div>
</fieldset>

<fieldset>
    <legend>Cadastre</legend>
    <div class="form-group">
        <label class="col-sm-2 control-label" for="refCadastre1">Ref cadastre parcelle 1 : </label>
        <div class="col-sm-8">
            <input
                    type="text" name="refCadastre1" id="refCadastre1"
                    value="{$refCadastre1}" class="form-control"/>
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-2 control-label" for="refCadastre2">Ref cadastre parcelle 2 : </label>
        <div class="col-sm-8">
            <input
                    type="text" name="refCadastre2" id="refCadastre2"
                    value="{$refCadastre2}" class="form-control"/>
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-2 control-label" for="refCadastre3">Ref cadastre parcelle 3 : </label>
        <div class="col-sm-8">
            <input
                    type="text" name="refCadastre3" id="refCadastre3"
                    value="{$refCadastre3}" class="form-control" />
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-2 control-label" for="autreRefCadastre">Autre ref cadastre :</label>
        <div class="col-sm-8">
            <input
                    type="text" name="autreRefCadastre" id="autreRefCadastre"
                    value="{$autreRefCadastre}" class="form-control"/>
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-2 control-label" for="numLot">Numéro de lot :</label>
        <div class="col-sm-8">
            <input type="text"
                   name="numLot" id="numLot" value="{$numLot}" class="form-control" />
        </div>
    </div>
</fieldset>


<fieldset>
    <legend>Superficie</legend>

    <div class="form-group">
        <label class="col-sm-2 control-label" for="superficieParcelle1">Superficie parcelle 1 :</label>
        <div class="col-sm-8">
            <input
                    type="text" name="superficieParcelle1" id="superficieParcelle1" class="form-control"
                    value="{$superficieParcelle1}" />
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-2 control-label" for="superficieParcelle2">Superficie parcelle 2 :</label>
        <div class="col-sm-8">
            <input
                    type="text" name="superficieParcelle2" id="superficieParcelle2" class="form-control"
                    value="{$superficieParcelle2}" />
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-2 control-label" for="superficieParcelle3">Superficie parcelle 3 :</label>
        <div class="col-sm-8">
            <input
                    type="text" name="superficieParcelle3" id="superficieParcelle3"
                    value="{$superficieParcelle3}"  class="form-control"/>
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-2 control-label" for="superficieAutreParcelle">Superficie autres parcelle :</label>
        <div class="col-sm-8">
            <input type="text" name="superficieAutreParcelle"
                   id="superficieAutreParcelle" value="{$superficieAutreParcelle}" class="form-control"/>
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-2 control-label" for="superficieConstructible">Superficie constructible :</label>
        <div class="col-sm-8">
            <input type="text" name="superficieConstructible"
                   id="superficieConstructible" value="{$superficieConstructible}" class="form-control"/>
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-2 control-label" for="superficieNonConstructible">Superficie non
            constructible :</label>
        <div class="col-sm-8">
            <input type="text"
                   name="superficieNonConstructible" id="superficieNonConstructible"
                   value="{$superficieNonConstructible}" class="form-control"/>
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-2 control-label" for="superficieTotale">Superficie totale :</label>
        <div class="col-sm-8">
            <input
                    type="text" name="superficieTotale" id="superficieTotale" class="form-control"
                    value="{$superficieTotale}" />
        </div>
    </div>

    {if !empty($listGeometer)}
        <div class="form-group">
            <label class="col-sm-2 control-label" for="idGeometer">géometre :</label>
            <div class="col-sm-8">
                <select
                        name="idGeometer" id="idGeometer" class="form-control">
                    <option value="">Non renseigné</option> {foreach
                    from=$listGeometer item=item}
                        <option {if $item->getIdMandateGeometer() eq
                        $idGeometer}selected="selected"
                                {/if}value="{$item->getIdMandateGeometer()}"> {$item->getName()}</option>
                    {/foreach}
                </select>
            </div>
        </div>
    {/if} {if !empty($listBornageTerrain)}
        <div class="form-group">
            <label class="col-sm-2 control-label" for="idBornageTerrain">Bornage : </label>
            <div class="col-sm-8">
                <select class="form-control"
                        name="idBornageTerrain" id="idBornageTerrain">
                    <option value="">Non renseigné</option> {foreach
                    from=$listBornageTerrain item=item}
                        <option {if $item->getIdMandateBornageTerrain() eq
                        $idBornageTerrain}selected="selected"
                                {/if}value="{$item->getIdMandateBornageTerrain()}">
                            {$item->getName()}</option> {/foreach}
                </select>
            </div>
        </div>
    {/if}


</fieldset>


<legend>Info du bien</legend>


<div class="form-group">
    <div class="col-sm-offset-2 col-sm-8">
        <div class="checkbox">
            <label for="coupCoeur"><input {if $coupCoeur
                eq 'on'} checked="checked" {/if} type="checkbox" name="coupCoeur"
                                                 id="coupCoeur" value="on" /> Coup de coeur</label>
        </div>
    </div>
</div>
<div class="form-group">
    <label class="col-sm-2 control-label" for="nouveauteSite">Nouveauté ( site Internet) :</label>
    <div class="col-sm-8">
        <input
                type="text" name="nouveauteSite" id="nouveauteSite"
                value="{$nouveauteSite}" class="datepicker form-control" />
    </div>
</div>




</fieldset>
<fieldset>
    <legend>Réglementation</legend>

    {if !empty($listZonagePlu)}
        <div class="form-group">
            <label class="col-sm-2 control-label" for="idZonagePlu">Zonage PLU :</label>
            <div class="col-sm-8">
                <select
                        name="idZonagePlu" id="idZonagePlu" class="form-control">
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
                <select class="form-control"
                        name="idZonageRnu" id="idZonageRnu">
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
                <select name="idCos" id="idCos" class="form-control">
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
            <input type="text" class="form-control"
                   name="shonAccordee" id="shonAccordee" value="{$shonAccordee}" />
        </div>

    </div>

    <h2>Zone BDF :</h2>

    <div class="form-group">
        <div class="col-sm-offset-2 col-sm-8">
            <div class="checkbox">
                <label for="zonebdfFalse">
                    <input type="radio"
                           {if $zonebdf eq 0}checked="checked" {/if} value="0" name="zonebdf"
                           id="zonebdfFalse" /> Non</label>
            </div>
        </div>
    </div>
    <div class="form-group">

        <div class="col-sm-offset-2 col-sm-8">
            <div class="checkbox">
                <label for="zonebdfTrue">

                    <input type="radio"
                           {if $zonebdf eq 1}checked="checked" {/if} value="1" name="zonebdf"
                           id="zonebdfTrue" /> Oui</label>
            </div>
        </div>
    </div>

    <h2>Ligne de crete :</h2>

    <div class="form-group">
        <div class="col-sm-offset-2 col-sm-8">
            <div class="checkbox">
                <label for="ligneCreteFalse">

                    <input {if $ligneCrete
                    eq 0}checked="checked" {/if} type="radio" value="0"
                           name="ligneCrete" id="ligneCreteFalse" /> Non</label>
            </div></div>
    </div>
    <div class="form-group">
        <div class="col-sm-offset-2 col-sm-8">
            <div class="checkbox">
                <label for="ligneCreteTrue"><input type="radio"
                                                   {if $ligneCrete eq 1}checked="checked" {/if} value="1"
                                                   name="ligneCrete" id="ligneCreteTrue" /> Oui</label>
            </div>
        </div>
    </div>


    <h2>Zone inondable :</h2>

    <div class="form-group">
        <div class="col-sm-offset-2 col-sm-8">
            <div class="checkbox">
                <label  for="zoneInondableFalse">
                    <input type="radio"
                           value="0" {if $zoneInondable eq 0} checked="checked"
                    {/if}  name="zoneInondable" id="zoneInondableFalse" /> Non</label>
            </div>
        </div>
    </div>
    <div class="form-group">
        <div class="col-sm-offset-2 col-sm-8">
            <div class="checkbox">
                <label  for="zoneInondableTrue"><input type="radio"
                                                       value="1" {if $zoneInondable eq 1} checked="checked"
                    {/if} name="zoneInondable" id="zoneInondableTrue" /> Oui</label>
            </div>
        </div>
    </div>

    <div class="form-group">
        <label class="col-sm-2 control-label" for="reglementLotissement">Réglement lotissement :</label>
        <div class="col-sm-8">
            <textarea name="reglementLotissement" id="reglementLotissement" class="form-control"
                      cols="30" rows="10">{$reglementLotissement}</textarea>
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-2 control-label" for="ernt">ERNT :</label>
        <div class="col-sm-8">
            <textarea class="form-control" name="ernt" id="ernt" cols="30" rows="10">{$ernt}</textarea>
        </div>
    </div>
</fieldset>
<fieldset>
    <legend>Autorisation</legend>
    <h2>DP</h2>

    <h3>DP valide :</h3>

    <div class="form-group">
        <div class="col-sm-offset-2 col-sm-8">
            <div class="checkbox">
                <label for="dPValideFalse"><input type="radio"
                            {if $dPValide eq 0} checked="checked" {/if} value="0"
                                                  name="dPValide" id="dPValideFalse" /> Non</label>
            </div>
        </div>
    </div>
    <div class="form-group">
        <div class="col-sm-offset-2 col-sm-8">
            <div class="checkbox">
                <label for="dPValideTrue"> <input type="radio"
                            {if $dPValide eq 1} checked="checked" {/if} value="1"
                                                  name="dPValide" id="dPValideTrue" /> Oui</label>
            </div>
        </div>
    </div>

    <div class="form-group">

        <label class="col-sm-2 control-label" for="dateDeclPrealableDP">Date déclaration préalable :</label>
        <div class="col-sm-8">
            <input class="datepicker form-control" type="text" name="dateDeclPrealableDP"
                   id="dateDeclPrealableDP" value="{$dateDeclPrealableDP}" />
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-2 control-label" for="dateProrogationDP">Prorogation DP jusqu'au :</label>
        <div class="col-sm-8">
            <input
                    class="datepicker form-control" type="text" name="dateProrogationDP"
                    id="dateProrogationDP" value="{$dateProrogationDP}" />
        </div>
    </div>
    <h2>CU</h2>

    <h3>CU valide :</h3>

    <div class="form-group">
        <div class="col-sm-offset-2 col-sm-8">
            <div class="checkbox">
                <label for="cuValideFalse"><input type="radio" value="0"
                            {if $cuValide eq 0} checked="checked" {/if} name="cuValide"
                                                  id="cuValideFalse" /> Non</label>
            </div>
        </div>
    </div>
    <div class="form-group">
        <div class="col-sm-offset-2 col-sm-8">
            <div class="checkbox">
                <label for="cuValideTrue"><input type="radio" value="1"
                            {if $cuValide eq 1} checked="checked" {/if}name="cuValide"
                                                 id="cuValideTrue" /> Oui</label>
            </div>
        </div>
    </div>

    <div class="form-group">
        <label class="col-sm-2 control-label" for="dateDeclPrealableCU">Date déclaration préalable :</label>
        <div class="col-sm-8">
            <input class="datepicker form-control" type="text" name="dateDeclPrealableCU"
                   id="dateDeclPrealableCU" value="{$dateDeclPrealableCU}" />
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-2 control-label" for="dateProrogationCU">Prorogation CU jusqu'au :</label>
        <div class="col-sm-8">
            <input
                    class="datepicker form-control" type="text" name="dateProrogationCU"
                    id="dateProrogationCU" value="{$dateProrogationCU}" />
        </div>
    </div>
    <h2>CU Ops</h2>

    <h3>CU Ops valide :</h3>

    <div class="form-group">
        <div class="col-sm-offset-2 col-sm-8">
            <div class="checkbox">
                <label for="cuOpsValideFalse">

                    <input type="radio"
                            {if $cuOpsValide eq 0} checked="checked" {/if} value="0"
                           name="cuOpsValide" id="cuOpsValideFalse" /> Non</label>
            </div>
        </div>
    </div>
    <div class="form-group">
        <div class="col-sm-offset-2 col-sm-8">
            <div class="checkbox">
                <label for="cuOpsValideTrue"><input type="radio"
                            {if $cuOpsValide eq 1} checked="checked" {/if} value="1"
                                                    name="cuOpsValide" id="cuOpsValideTrue" /> Oui</label>
            </div>
        </div>
    </div>

    <div class="form-group">
        <label class="col-sm-2 control-label" for="dateDeclPrealableCUOPS">Date déclaration préalable :</label>
        <div class="col-sm-8">
            <input class="datepicker form-control" type="text" name="dateDeclPrealableCUOPS"
                   id="dateDeclPrealableCUOPS" value="{$dateDeclPrealableCUOPS}" />
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-2 control-label" for="dateProrogationCUOPS">Prorogation CU Ops jusqu'au :</label>
        <div class="col-sm-8">
            <input class="datepicker form-control" type="text" name="dateProrogationCUOPS"
                   id="dateProrogationCUOPS" value="{$dateProrogationCUOPS}" />
        </div>
    </div>
    <h2>Permis d'amenager</h2>

    <h3>Permis d'amenager valide :</h3>

    <div class="form-group">
        <div class="col-sm-offset-2 col-sm-8">
            <div class="checkbox">
                <label  for="permisAmenagerValideFalse"><input
                            type="radio" value="0" {if $permisAmenagerValide
                    eq 0} checked="checked" {/if} name="permisAmenagerValide"
                            id="permisAmenagerValideFalse" /> Non</label>
            </div>
        </div>
    </div>
    <div class="form-group">
        <div class="col-sm-offset-2 col-sm-8">
            <div class="checkbox">
                <label for="permisAmenagerValideTrue"><input
                            type="radio" value="1" {if $permisAmenagerValide
                    eq 1} checked="checked" {/if}  name="permisAmenagerValide"
                            id="permisAmenagerValideTrue" /> Oui</label>
            </div>
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-2 control-label" for="datePermisAmenager">Date de permis d'amenager :</label>
        <div class="col-sm-8">
            <input class="datepicker form-control" type="text" name="datePermisAmenager"
                   id="datePermisAmenager" value="{$datePermisAmenager}" />
        </div>
    </div>
</fieldset>
<fieldset>
    <legend>Viabilisation</legend>

    <h2>Terrain vendu viabilisé :</h2>
    <div class="form-group">
        <div class="col-sm-offset-2 col-sm-8">
            <div class="checkbox">
        <label for="terrainViabiliseFalse">
                <input type="radio"
                {if $terrainViabilise eq 0} checked="checked" {/if} value="0"
                                                                                            name="terrainViabilise" id="terrainViabiliseFalse" /> Non</label>
                </div>
            </div>
    </div>
    <div class="form-group">
        <div class="col-sm-offset-2 col-sm-8">
            <div class="checkbox">
        <label for="terrainViabiliseTrue">
        <input type="radio"
                {if $terrainViabilise eq 1} checked="checked" {/if} value="1"
                                                                                           name="terrainViabilise" id="terrainViabiliseTrue" /> Oui</label>
                </div>
            </div>
    </div>


    <h2>Terrain vendu semi viabilisé :</h2>

    <div class="form-group">
        <div class="col-sm-offset-2 col-sm-8">
            <div class="checkbox">
        <label for="terrainSemiViabiliseFalse"><input
                type="radio" value="0" {if $terrainSemiViabilise
        eq 0} checked="checked" {/if} name="terrainSemiViabilise"
                id="terrainSemiViabiliseFalse" /> Non</label>
    </div>
            </div>
        </div>
    <div class="form-group">
        <div class="col-sm-offset-2 col-sm-8">
            <div class="checkbox">
        <label for="terrainSemiViabiliseTrue">
            <input type="radio" value="1" name="terrainSemiViabilise"
                {if $terrainSemiViabilise eq 1} checked="checked"
                {/if} id="terrainSemiViabiliseTrue" /> Oui</label>
    </div>
</div>
        </div>

    <h2>Terrain vendu non viabilisé :</h2>

    <div class="form-group">
        <div class="col-sm-offset-2 col-sm-8">
            <div class="checkbox">
        <label for="terrainNonViabiliseFalse"><input
                type="radio" value="0" {if $terrainNonViabilise
        eq 0} checked="checked" {/if} name="terrainNonViabilise"
                id="terrainNonViabiliseFalse" /> Non</label>
                </div>
            </div>
    </div>
    <div class="form-group">
        <div class="col-sm-offset-2 col-sm-8">
            <div class="checkbox">
        <label for="terrainNonViabiliseTrue">
                <input type="radio" value="1" name="terrainNonViabilise" {if $terrainNonViabilise
        eq 1} checked="checked" {/if} id="terrainNonViabiliseTrue" /> Oui</label>
                </div>
            </div>
    </div>

    <div class="form-group">
        <label class="col-sm-2 control-label" for="passageEau">Passage eau :</label>
        <div class="col-sm-8">
            <textarea class="form-control" name="passageEau" id="passageEau" cols="30" rows="10">{$passageEau}</textarea>
        </div>
    </div>
    {if !empty($listWaterCorresponding)}
        <div class="form-group">
            <label class="col-sm-2 control-label" for="idWaterCorresponding">Correspondant eau : </label>
            <div class="col-sm-8">
                <select
                        name="idWaterCorresponding" id="idWaterCorresponding" class="form-control">
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
            <textarea name="passageElectricite" id="passageElectricite" class="form-control"
                      cols="30" rows="10">{$passageElectricite}</textarea>
        </div>
    </div>
    {if !empty($listElectricCorresponding)}

        <div class="form-group">
            <label class="col-sm-2 control-label" for="idElectricCorresponding">Correspondant electrique : </label>
            <div class="col-sm-8">
                <select
                        name="idElectricCorresponding" id="idElectricCorresponding" class="form-control">
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
            <textarea class="form-control" name="passageGaz" id="passageGaz" cols="30" rows="10">{$passageGaz}</textarea>
        </div>
    </div>
    {if !empty($listGazCorresponding)}
        <div class="form-group">
            <label class="col-sm-2 control-label" for="idGazCorresponding">Correspondant gaz :</label>
            <div class="col-sm-8">
                <select class="form-control"
                        name="idGazCorresponding" id="idGazCorresponding">
                    <option value="">Non renseigné</option> {foreach
                    from=$listGazCorresponding item=item}
                        <option {if $item->getIdMandateGazCorresponding() eq
                        $idGazCorresponding}selected="selected"
                                {/if}value="{$item->getIdMandateGazCorresponding()}">
                            {$item->getName()}</option> {/foreach}
                </select>
            </div>
        </div>
    {/if}

    <h2>Tout à l'égout :</h2>

    <div class="form-group">
        <div class="col-sm-offset-2 col-sm-8">
            <div class="checkbox">
        <label for="toutEgoutFalse">
                <input type="radio"
                {if $toutEgout eq 0} checked="checked" {/if} value="0"   name="toutEgout" id="toutEgoutFalse" /> Non</label>
                </div>
            </div>
    </div>
    <div class="form-group">
        <div class="col-sm-offset-2 col-sm-8">
            <div class="checkbox">
        <label for="toutEgoutTrue"><input type="radio" value="1"
                {if $toutEgout eq 1} checked="checked" {/if} name="toutEgout"
                                                                                    id="toutEgoutTrue" /> Oui</label>
                </div>
            </div>
    </div>


    <h2>Assainissement par fosse sceptique :</h2>

    <div class="form-group">
        <div class="col-sm-offset-2 col-sm-8">
            <div class="checkbox">
        <label  for="assainissementFosseSceptiqueFalse"><input
                id="assainissementFosseSceptiqueFalse" type="radio"
                {if $assainissementFosseSceptique eq 0} checked="checked"
                {/if} value="0" name="assainissementFosseSceptique" /> Non</label>
                </div>
            </div>
    </div>
    <div class="form-group">
        <div class="col-sm-offset-2 col-sm-8">
            <div class="checkbox">
        <label for="assainissementFosseSceptiqueTrue"><input
                type="radio" value="1" {if $assainissementFosseSceptique
        eq 1} checked="checked" {/if} name="assainissementFosseSceptique"
                id="assainissementFosseSceptiqueTrue" /> Oui</label>
    </div>
            </div>
        </div>


    {if !empty($listSanitationCorresponding)}
        <div class="form-group">
            <label class="col-sm-2 control-label" for="idSanitationCorresponding">Correspondant sanitaire :</label>
            <div class="col-sm-8">
                <select name="idSanitationCorresponding" class="form-control"
                        id="idSanitationCorresponding">
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
            <textarea class="form-control" name="voirie" id="voirie" cols="30" rows="10">{$voirie}</textarea>
        </div>
    </div>
</fieldset>
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
            </div> 			</div>
    {/if}
    <div class="form-group">
        <label class="col-sm-2 control-label" for="tailleFacade">Taille de la façade :</label>
        <div class="col-sm-8">
            <input type="text" class="form-control" name="tailleFacade"
                   id="tailleFacade" value="{$tailleFacade}" />
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-2 control-label" for="profondeurTerrain">Profondeur du terrain :</label>
        <div class="col-sm-8">
            <input type="text" name="profondeurTerrain" class="form-control"
                   id="profondeurTerrain" value="{$profondeurTerrain}" />
        </div>
    </div>
    {* <p> Commentaires : <textarea name="commentaire" id="commentaire"
    cols="30" rows="10">{$commentaire}</textarea> </p> *}

    <h2>Geolocalisation</h2>

    <div class="form-group">
        <label class="col-sm-2 control-label" for="geoloc">latitude :</label>
        <div class="col-sm-8">
            <input type="text" class="form-control"
                   name="geolocLatitude" id="geoloc" value="{$geolocLatitude}" />
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-2 control-label" for="geolocLongitude">Longitude :</label>
        <div class="col-sm-8">
            <input type="text" class="form-control" name="geolocLongitude"
                   id="geolocLongitude" value="{$geolocLongitude}" />
        </div>
    </div>

    <div class="form-group">
        <label class="col-sm-2 control-label" for="proximiteEcole">Proximité école :</label>
        <div class="col-sm-8">
            <input type="text" class="form-control" name="proximiteEcole"
                   id="proximiteEcole" value="{$proximiteEcole}" />
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-2 control-label" for="proximiteCommerce">Proximité commerce :</label>
        <div class="col-sm-8">
            <input type="text" class="form-control" name="proximiteCommerce"
                   id="proximiteCommerce" value="{$proximiteCommerce}" />
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-2 control-label" for="proximiteTransport">Proximité transport : </label>

        <div class="col-sm-8">
            <input type="text" name="proximiteTransport" class="form-control"
                   id="proximiteTransport" value="{$proximiteTransport}" />
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-2 control-label" for="commentaireApparent">Texte vitrine :</label>
        <div class="col-sm-8">
            <textarea name="commentaireApparent" id="commentaireApparent" class="form-control"
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



<div class="form-group">
    <div class="col-sm-offset-2 col-sm-10">
        <input class="btn btn-default" type="submit" value="Enregistrer le nouveau mandat" name="send" />
    </div>
</div>
</form>
</div>

