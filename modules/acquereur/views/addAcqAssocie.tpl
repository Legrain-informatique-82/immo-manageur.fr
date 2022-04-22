{include file="tpl_default/entete.tpl"}
<form action="" method="post" role="form" class="form-horizontal">
<div class="row bg-success bannerTitle">
    <div class="col-md-6">
        <h1 class="h2">{$title}</h1>
    </div>

    <div class="col-md-6">
        <p class="h4 text-right ">

            <button type="submit" class="btn {if $add}btn-success{else}btn-warning{/if}" name="valid" value="Valider">
                <i class="fa fa-save fa-2x"></i>
            </button>

            <a title="Annuler et fermer" class="btn btn-default" href="{Tools::create_url($user,"acquereur","see",$smarty.get.action)}">
                <i class="fa fa-close fa-2x"></i>
            </a>
    </div>
</div>


{include file="tpl_default/error.tpl"}

{if $listUser}

    <fieldset>
        <legend>Utilisateur affecté</legend>
        <div class="form-group">
            <label class="col-sm-2 control-label" for="userSelected">Utilisateur affecté : </label>
            <div class="col-sm-8">
                <select class="form-control" name="userSelected" id="userSelected">
                    {foreach from=$listUser item=u}
                        <option {if $userSelected eq $u->getIdUser()} selected="selected"
                        {/if} value="{$u->getIdUser()}">{$u->getName()} {$u->getFirstname()}</option>
                    {/foreach}
                </select>
            </div>
        </div>
    </fieldset>
{/if}
<fieldset>
    <legend>Acquereur</legend>
    <div class="form-group">
        <label class="col-sm-2 control-label" for="titreAcquereur">Titre acquereur</label>
        <div class="col-sm-8">
            <select class="form-control" name="titreAcquereur" id="titreAcquereur">
                {foreach from=$listTitre item=c}
                    <option {if $titreAcquereur eq $c->getIdTitreAcquereur()} selected="selected" {/if} value="{$c->getIdTitreAcquereur()}"> {$c->getName()}</option>
                {/foreach}
            </select>
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-2 control-label" for="name">Nom : </label>
        <div class="col-sm-8">
            <input class="form-control" type="text" name="name" value="{$name}" id="name" />
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-2 control-label" for="maidenName">Nom de jeune fille : </label>
        <div class="col-sm-8">
            <input class="form-control" type="text" name="maidenName" value="{$maidenName}" id="maidenName" />
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-2 control-label" for="firstname">Prénom :</label>
        <div class="col-sm-8">
            <input class="form-control" type="text" name="firstname" value="{$firstname}" id="firstname" />
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-2 control-label" for="address">Adresse :</label>
        <div class="col-sm-8">
            <input class="form-control" type="text" name="address" value="{$address}" id="address" />
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-2 control-label" for="city">Ville : </label>
        <div class="col-sm-8">
            <select class="form-control" name="city" id="city">
                {foreach from=$listCity item=c}
                    <option {if $city eq $c->getIdCity()} selected="selected" {/if} value="{$c->getIdCity()}"> {$c->getZipCode()} {$c->getName()}</option>
                {/foreach}
            </select>
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-2 control-label" for="phone">Téléphone :</label>
        <div class="col-sm-8">
            <input class="form-control" type="text" name="phone" value="{$phone}" id="phone" />
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-2 control-label" for="mobilPhone">Téléphone portable :</label>
        <div class="col-sm-8">
            <input class="form-control" type="text" name="mobilPhone" value="{$mobilPhone}" id="mobilPhone" />
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-2 control-label" for="workPhone">Téléphone ( travail) :</label>
        <div class="col-sm-8">
            <input class="form-control" type="text" name="workPhone" value="{$workPhone}" id="workPhone" />
        </div>
    </div>

    <div class="form-group">
        <label class="col-sm-2 control-label" for="fax">Fax :</label>
        <div class="col-sm-8">
            <input class="form-control" type="text" name="fax" value="{$fax}" id="fax" />
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-2 control-label" for="email">Email :</label>
        <div class="col-sm-8">
            <input class="form-control" type="text" name="email" value="{$email}" id="email" />
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-2 control-label" for="birthdate">Date de naissance :</label>
        <div class="col-sm-8">
            <input class="form-control" type="text" name="birthdate" value="{$birthdate}" id="birthdate" class="datepicker"/>
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-2 control-label" for="birthLocation">Lieu de naissance :</label>
        <div class="col-sm-8">
            <input class="form-control" type="text" name="birthLocation" value="{$birthLocation}" id="birthLocation" />
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-2 control-label" for="nationality">Nationalité :</label>
        <div class="col-sm-8">
            <input class="form-control" type="text" name="nationality" value="{$nationality}" id="nationality" />
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-2 control-label" for="job">Profession :</label>
        <div class="col-sm-8">
            <input class="form-control" type="text" name="job" value="{$job}" id="job" />
        </div>
    </div>

</fieldset>
{if $listSituation}
    <fieldset>
        <legend>Situation de famille : </legend>
        {* liste des situations, avec le champs date et lieu si besoin est (text), des hiddens vide sinon !*}
        {foreach from=$listSituation item="itemSit" name="boucle"}
            {if $situation eq $itemSit->getId()}
                {assign var="valueOk" value="1"}
            {else}
                {assign var="valueOk" value="0"}
            {/if}

            <div class="form-group ">
                <span class="col-sm-2 control-label"></span>
                <div class="col-sm-8">

                    <div class="form-group row">

                        <div class="checkbox col-sm-3">
                            <label for="situation_{$smarty.foreach.boucle.iteration}">
                                <input type="radio" name="situation" id="situation_{$smarty.foreach.boucle.iteration}" value="{$itemSit->getId()}" {if $situation eq $itemSit->getId()} checked="checked"{/if}/>
                                {$itemSit->getName()}
                            </label>
                        </div>
                        <input type="hidden" name="id[]" value="{$itemSit->getId()}"/>

                        {if $itemSit->getIfEventDate()}
                            <label for="date_{$smarty.foreach.boucle.iteration}" class="col-sm-1 control-label">  Le :</label><div class="col-sm-2"> <input id="date_{$smarty.foreach.boucle.iteration}" type="text" name="eventDate[]"  class="datepicker form-control" value="{if $valueOk eq 1}{$situationDate}{/if}"/></div>
                        {else}
                            <input type="hidden" name="eventDate[]" value="" />
                        {/if}

                        {if $itemSit->getIfEventLocation()}
                            <label for="location_{$smarty.foreach.boucle.iteration}" class="col-sm-1 control-label">À :</label> <div class="col-sm-5"><input id="location_{$smarty.foreach.boucle.iteration}" type="text" name="eventLocation[]"  class="form-control" value="{if $valueOk eq 1}{$situationLocation}{/if}" /></div>
                        {else}
                            <input type="hidden" name="eventLocation[]" value="" />
                        {/if}
                    </div>
                </div>
            </div>


        {/foreach}

    </fieldset>
{/if}


<fieldset>
    <legend>Commentaire :</legend>

    <div class="form-group">
        <label class="col-sm-2 control-label" for="commentAcq">Commentaire sur l'acquereur :</label>
        <div class="col-sm-8">
            <textarea class="form-control" name="comment" id="commentAcq" cols="30" rows="10">{$comment}</textarea>
        </div>
    </div>
</fieldset>
<div class="form-group">

    <div class="col-sm-offset-2 col-sm-8">
        <button class="btn {if $add}btn-success{else}btn-warning{/if}" type="submit"  name="valid" value="Valider">
            <i class="fa fa-save"></i> {if $add}Ajouter{else}Mettre à jour{/if}
        </button>
        <button class="btn btn-default" type="submit"  name="cancel" value="Annuler">
            <i class="fa fa-close"></i> Annuler
        </button>


    </div>
</div>
</form>

</div>
