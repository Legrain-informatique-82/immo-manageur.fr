{include file="tpl_default/entete.tpl"}
<form action="" method="post" role="form" class="form-horizontal">

    <div class="row bg-success bannerTitle">
        <div class="col-md-6">
            <h1 class="h2">Rapprocher {$acq->getFirstname()} {$acq->getName()} du mandat
                {$mandate->getNumberMandate()}</h1>
        </div>

        <div class="col-md-6">
            <p class="h4 text-right ">

                <button type="submit" value="valider" name="send" class="btn btn-success" title="Enregistrer">
                    <i class="fa fa-save fa-2x"></i>
                </button>
                <a class="btn btn-default" href="{$redirectC}" title="{$labelRedirectC}">
                    <i class="fa fa-close fa-2x"></i>
                </a>

            </p>
        </div>
    </div>

    {include file="tpl_default/viewsErrors.tpl"}

    <fieldset>
        <legend>Général : </legend>
        {if $listUser}
            <div class="form-group">
                <label class="col-sm-2 control-label" for="utilisateurAssocie">Utilisateur associé :</label>
                <div class="col-sm-8">
                    <select name="utilisateurAssocie" id="utilisateurAssocie" class="form-control">
                        {foreach from=$listUser item=u}
                            <option {if $u->getIdUser() eq $utilisateurAssocie} selected="selected" {/if} value="{$u->getIdUser()}">{$u->getFirstname()} {$u->getName()}</option>
                        {/foreach}
                    </select>
                </div>
            </div>
        {else}
            <div class="col-sm-offset-2 col-sm-8">
                <p class="help-block">
                    Utilisateur associé :
                    {$user->getFirstname()} {$user->getName()}
                </p>
            </div>
        {/if}
        <div class="col-sm-offset-2 col-sm-8">
            <p class="help-block">
                Numéro du mandat associé : {$mandate->getNumberMandate()}
            </p>
            <p class="help-block">
                Acquereur associé : {$acq->getFirstname()} {$acq->getName()}
            </p>
        </div>
    </fieldset>
    <fieldset>
        <legend>Visite : </legend>

        <div class="form-group">
            <label class="col-sm-2 control-label" for="dateVisite">Date de la visite :</label>
            <div class="col-sm-8">
                <input type="text" name="dateVisite" value="{$dateVisite}" id="dateVisite" class="dateTimepicker form-control" />
            </div>
        </div>

        <div class="form-group">
            <label class="col-sm-2 control-label" for="dateCompteRendu">Compte rendu le :</label>
            <div class="col-sm-8">
                <input type="text" name="dateCompteRendu" value="{$dateCompteRendu}" id="dateCompteRendu" class="dateTimepicker form-control" />
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label" for="resultat">Resultat : </label>
            <div class="col-sm-8">
                <input type="text" name="resultat" value="{$resultat}" id="resultat" class="form-control"/>
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label" for="ptPositifs">Points positifs :</label>

            <div class="col-sm-8">
                <textarea class="form-control" name="ptPositifs" id="ptPositifs" cols="30" rows="10">{$ptPositifs}</textarea>
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label" for="ptNegatifs">points negatifs : </label>
            <div class="col-sm-8">
                <textarea name="ptNegatifs" id="ptNegatifs" cols="30" rows="10" class="form-control">{$ptNegatifs}</textarea>
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label" for="resultatVisite">Résultat de la visite :  </label>
            <div class="col-sm-8">
                <select name="resultatVisite" id="resultatVisite" class="form-control">
                    <option {if $resultatVisite eq 0} selected="selected" {/if} value="0">-------</option>
                    <option {if $resultatVisite eq 1} selected="selected" {/if}  value="1">Ne correspond pas</option>
                    <option {if $resultatVisite eq 2} selected="selected" {/if} value="2">Ok</option>
                </select>
            </div>
        </div>
    </fieldset>
    <div class="form-group">
        <div class="col-sm-offset-2 col-sm-8">
            <button type="submit" value="valider" name="send" class="btn btn-success">
                <i class="fa fa-save"></i> Enregistrer
            </button>
            <a class="btn btn-default" href="{$redirectC}">
                <i class="fa fa-close "></i> {$labelRedirectC}
            </a>
        </div>
    </div>
</form>
</div>
