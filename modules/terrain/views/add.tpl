{include file="tpl_default/entete.tpl"}
<form action="" method="post" {* enctype="multipart/form-data"*}  role="form" class="form-horizontal">
<div class="row bg-success bannerTitle">
    <div class="col-md-6">
        <h1 class="h2">Ajouter un terrain</h1>
    </div>
    <div class="col-md-6">
        <p class="h4 text-right ">
            <button class="btn btn-success" type="submit" name="terrain_add_submit" title="{Lang::LABEL_ADD_TERRAIN_AND_REDIRECT_SAVE}">
                <i class="fa fa-save fa-2x"></i>
            </button>
            <a title="fermer" class="btn btn-default" href="{Tools::create_url($user,"mandat","list")}">
                <i class="fa fa-close fa-2x"></i>
            </a>
        </p>
    </div>
</div>
{include file="tpl_default/error.tpl"}


{* N'apparait que si l'utilisateur a un grade supérieur à
   opérateur *} {if !empty($listUser)}
    <fieldset>
        <legend>Utilisateur</legend>

        <div class="form-group">
            <label class="col-sm-2 control-label"  for="idUser">Utilisateur affecté :</label>

            <div class="col-sm-8">
                <select class="form-control" name="idUser" id="idUser" >

                    {foreach from=$listUser item=item}
                        <option {if $item->getIdUser() eq $idUser}selected="selected"
                                {/if}value="{$item->getIdUser()}">{$item->getFirstname()}
                            {$item->getName()}</option> {/foreach}
                </select>
            </div>
        </div>
    </fieldset>
{/if} {* Apparait à tout le monde*} {if $smarty.post.idSeller &&
$smarty.post.used} <input type="hidden" name="idSeller"
                          value="{$smarty.post.idSeller}" /> <input type="hidden" name="used"
                                                                    value="{$smarty.post.used}" /> {else}
    <fieldset>
        <legend>Vendeur principal</legend>
        {include file='seller/views/frm_add_seller.tpl'}
    </fieldset>
{/if}


<fieldset>
    <legend>Type de terrain</legend>


    <div class="form-group">
        <div class="col-sm-offset-2 col-sm-8">
            <div class="checkbox">
                <label  for="aBatir">
                    <input type="radio" name="typeTerrain" id="aBatir" {if $typeTerrain ==1} checked="checked" {/if} value="1"/>
                    À batir
                </label>
            </div>
        </div>
    </div>
    <div class="form-group">
        <div class="col-sm-offset-2 col-sm-8">
            <div class="checkbox">
                <label for="aLotir">
                    <input type="radio" name="typeTerrain" id="alotir" {if $typeTerrain ==2} checked="checked" {/if} value="2"/> À lotir</label>

            </div>
        </div>
    </div>

</fieldset>
<fieldset>
    <legend>Situation du terrain :</legend>
    <div class="form-group">
        <div class="col-sm-offset-2 col-sm-8">
            <div class="checkbox">
                <label for="lotissement">
                    <input type="radio" name="situationTerrain" id="lotissement" {if $situationTerrain ==1} checked="checked" {/if} value="1" />
                    Lotissement</label>
            </div>
        </div>
    </div>
    <div class="form-group">
        <div class="col-sm-offset-2 col-sm-8">
            <div class="checkbox">
                <label  for="aLotir">
                    <input type="radio" name="situationTerrain" id="diffus" {if $situationTerrain ==2} checked="checked" {/if} value="2" />
                    Diffus ( hors lotissement)</label>
            </div>
        </div>
    </div>
</fieldset>


<div class="form-group">
    <label class="col-sm-2 control-label" for="nature">Nature du bien :</label>
    <div class="col-sm-8">
        <select name="nature"
                id="nature" class="form-control"> {foreach from=$listNature item=tb}

                <option {if $tb->getIdMandateNature() eq $nature}
                    selected="selected" {/if}
                        value="{$tb->getIdMandateNature()}">{$tb->getName()}</option>

            {/foreach}
        </select>
    </div>
</div>

{if !empty($listNotary)}
    <div class="form-group">
        <label class="col-sm-2 control-label" for="idNotary">Notaire vendeur :</label>
        <div class="col-sm-8">
            <select name="idNotary" id="idNotary" class="form-control">

                {foreach from=$listNotary item=item}
                    <option {if $item->getIdNotary() eq $idNotary}selected="selected"
                            {/if}value="{$item->getIdNotary()}"> {$item->getName()}</option>
                {/foreach}
            </select>
        </div>
    </div>
{/if}
{if !empty($listNotary)}
    <div class="form-group">
        <label class="col-sm-2 control-label" for="idNotaryAcq">Notaire acquereur :</label>
        <div class="col-sm-8">
            <select name="idNotaryAcq" id="idNotaryAcq" class="form-control">
                <option value="">NC</option>
                {foreach from=$listNotary item=item}
                    <option {if $item->getIdNotary() eq $idNotaryAcq}selected="selected"
                            {/if}value="{$item->getIdNotary()}"> {$item->getName()}</option>
                {/foreach}
            </select>
        </div>
    </div>
{/if}
<div class="form-group">
    <label class="col-sm-2 control-label" for="numMandat">N° Mandat : </label>
    <div class="col-sm-8">
        <input type="text" name="numMandat" id="numMandat"
               value="{$numMandat}" class="form-control"/>
    </div>
</div>
<div class="form-group">
    <label class="col-sm-2 control-label" for="debutMandat">Début :</label>
    <div class="col-sm-8">
        <input class="datepicker form-control" type="text" name="debutMandat"
               id="debutMandat" value="{$debutMandat}" />
    </div>
</div>
<div class="form-group">
    <label class="col-sm-2 control-label" for="finMandat">Fin :</label>
    <div class="col-sm-8">
        <input class="datepicker form-control" type="text" name="finMandat"
               id="finMandat" value="{$finMandat}" />
    </div>
</div>
<div class="form-group">
    <label class="col-sm-2 control-label" for="libreMandat">libre le :</label>
    <div class="col-sm-8">
        <input class="datepicker form-control" type="text" name="libreMandat"
               id="libreMandat" value="{$libreMandat}" />
    </div>
</div>

</fieldset>


<fieldset>
    <legend>Localisation</legend>
    <div class="form-group">
        <label class="col-sm-2 control-label" for="adresseMandat">
            Adresse : </label>
        <div class="col-sm-8">
            <input type="text" name="adresseMandat" id="adresseMandat"
                   value="{$adresseMandat}" class="form-control"/>
        </div>
    </div>
    {if !empty($listCity)}
        <div class="form-group">
            <label class="col-sm-2 control-label" for="idCity">Ville : </label>
            <div class="col-sm-8">
                <select name="idCity" id="idCity" class="form-control"> {foreach from=$listCity
                    item=item}
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
        <label class="col-sm-2 control-label" for="prixFai">Prix FAI : </label>
        <div class="col-sm-8">
            <input type="text" name="prixFai" id="prixFai"
                   value="{$prixFai}" class="form-control" />
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-2 control-label" for="prixNetVendeur">Prix net vendeur : </label>
        <div class="col-sm-8">
            <input type="text" name="prixNetVendeur"
                   id="prixNetVendeur" value="{$prixNetVendeur}" class="form-control"/>
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-2 control-label" for="commissionMandat">Commission :</label>
        <div class="col-sm-8">
            <input type="text" name="commissionMandat"
                   id="commissionMandat" value="{$commissionMandat}" class="form-control"/>
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-2 control-label" for="estimationFai">Estimation FAI mini :</label>
        <div class="col-sm-8">
            <input type="text" name="estimationFai"
                   id="estimationFai" value="{$estimationFai}" class="form-control"/>
        </div>
    </div>
    <div class="form-group" id="jsEstimMaxi">
        <label class="col-sm-2 control-label" for="estimationMaxi">Estimation FAI maxi :</label>
        <div class="col-sm-8">
            <input type="text" name="estimationMaxi"
                   id="estimationMaxi" value="{$estimationMaxi}" class="form-control"/>
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-2 control-label" for="margeNegoce">Marge negoce : </label>
        <div class="col-sm-8">
            <input type="text" name="margeNegoce"
                   id="margeNegoce" value="{$margeNegoce}" class="form-control" />
        </div>
    </div>
</fieldset>
<fieldset >
    <legend>Cadastre</legend>
    <div class="form-group">
        <label class="col-sm-2 control-label" for="refCadastre1">	Ref cadastre parcelle 1 :</label>
        <div class="col-sm-8">
            <input type="text" name="refCadastre1"
                   id="refCadastre1" value="{$refCadastre1}" class="form-control"/>
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-2 control-label" for="refCadastre2">Ref cadastre parcelle 2 :</label>
        <div class="col-sm-8">
            <input type="text" name="refCadastre2"
                   id="refCadastre2" value="{$refCadastre2}" class="form-control" />
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-2 control-label" for="refCadastre3">Ref cadastre parcelle 3 : </label>
        <div class="col-sm-8">
            <input type="text" name="refCadastre3"
                   id="refCadastre3" value="{$refCadastre3}" class="form-control"/>
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-2 control-label" for="autreRefCadastre">Autre ref cadastre :</label>
        <div class="col-sm-8">
            <input type="text" name="autreRefCadastre"
                   id="autreRefCadastre" value="{$autreRefCadastre}" class="form-control"/>
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-2 control-label" for="numLot">Numéro de lot :</label>
        <div class="col-sm-8"><input type="text" name="numLot" id="numLot"
                                     value="{$numLot}" class="form-control"/>
        </div>
    </div>
</fieldset>



<div class="form-group">
    <div class="col-sm-offset-2 col-sm-8">
        <button type="submit" value="{Lang::LABEL_ADD_TERRAIN_CONTINUE_SAVE}" name="terrain_add_submit_and_continue" class="btn btn-success">
            <i class="fa fa-save"></i> {Lang::LABEL_ADD_TERRAIN_CONTINUE_SAVE}
        </button>

        <button type="submit" value="{Lang::LABEL_ADD_TERRAIN_AND_REDIRECT_SAVE}" name="terrain_add_submit" class="btn btn-success">
            <i class="fa fa-save"></i> {Lang::LABEL_ADD_TERRAIN_AND_REDIRECT_SAVE}
        </button>

        <a title="fermer" class="btn btn-default" href="{Tools::create_url($user,"terrain","list")}">
            <i class="fa fa-close"></i> Annuler et fermer
        </a>
    </div>
</div>

</form>
</div>
