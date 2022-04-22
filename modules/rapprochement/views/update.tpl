{include file="tpl_default/entete.tpl"}
<form action="" method="post" role="form" class="form-horizontal">
    <div class="row bg-success bannerTitle">
        <div class="col-md-6">
            <h1 class="h2">Mise à jour du rapprochement</h1>
        </div>

        <div class="col-md-6">
            <p class="h4 text-right ">
                <button type="submit" value="Sauvegarder" name="send" id="send" class="btn btn-warning" title="Mettre à jour">
                    <i class="fa fa-save fa-2x"></i>
                </button>
                <button type="submit" value="Annuler" name="cancel" id="cancel" class="btn btn-default" title="Annuler et fermer">
                    <i class="fa fa-close fa-2x"></i>
                </button>
            </p>
        </div>
    </div>
    {include file="tpl_default/viewsErrors.tpl"}

    <fieldset>
        <legend>Général : </legend>
        {if $listUser}
            <div class="form-group">
            <label class="col-sm-2 control-label" for="utilisateurLie"> Utilisateur lié : </label>
            <div class="col-sm-8">
                <select name="utilisateurLie" id="utilisateurLie" class="form-control">
                    {foreach from=$listUser item=u}
                        <option value="{$u->getIdUser()}" {if $u->getIdUser() eq $utilisateurLie} selected="selected"{/if}>{$u->getFirstname()} {$u->getName()}</option> {/foreach}
                </select>
            </div>
            </div>{/if}

        <div class="form-group">

            <label class="col-sm-2 control-label" for="mandate"> Mandat lié :</label>
            <div class="col-sm-8">
                <select name="mandate" id="mandate" class="form-control">
                    {foreach from=$listMandate item=m}
                        <option value="{$m->getIdMandate()}" {if $m->getIdMandate() eq $mandate} selected="selected"{/if}>{$m->getNumberMandate()} prix Fai : {$m->getPriceFai()} €</option> {/foreach}
                </select>
            </div>
        </div>

        <div class="form-group">
            <label class="col-sm-2 control-label" for="mandate"> Acquereur associé :</label>
            <div class="col-sm-8">
                <select name="acq" id="acq" class="form-control">
                    {foreach from=$listAcq item=a}
                        <option value="{$a->getIdAcquereur()}" {if $a->getIdAcquereur() eq $acq} selected="selected"{/if}>{$a->getFirstname()} {$a->getName()} Budget : de {$a->getPriceMin()} à {$a->getPriceMax()} €</option>
                    {/foreach}
                </select>
            </div>
        </div>
    </fieldset>
    <fieldset>
        <legend>Visite : </legend>

        <div class="form-group">
            <label class="col-sm-2 control-label" for="dateVisite">Date de la visite :</label>
            <div class="col-sm-8">
                <input type="text"  name="dateVisite" value="{$dateVisite}" id="dateVisite" class="dateTimepicker form-control" />
            </div>
        </div>

        <div class="form-group">
            <label class="col-sm-2 control-label" for="dateCompteRendu">Compte rendu le :</label>
            <div class="col-sm-8">
                <input type="text" name="dateCompteRendu" value="{$dateCompteRendu}" id="dateCompteRendu" class="dateTimepicker form-control" />
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label" for="resultat">Resultat :</label>
            <div class="col-sm-8">
                <input type="text" name="resultat" value="{$resultat}" id="resultat" class="form-control"/>
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label" for="ptPositifs">Points positifs : </label>
            <div class="col-sm-8">
                <textarea name="ptPositifs" id="ptPositifs" cols="30" rows="10" class="form-control">{$ptPositifs}</textarea>
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label" for="ptNegatifs">points negatifs : </label>
            <div class="col-sm-8">
                <textarea name="ptNegatifs" id="ptNegatifs" cols="30" rows="10" class="form-control">{$ptNegatifs}</textarea>
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label" for="resultatVisite">Résultat de la visite : </label>
            <div class="col-sm-8">
                <select name="resultatVisite" id="resultatVisite" class="form-control">

                    <option {if $resultatVisite eq 0} selected="selected"{/if} value="0">-------</option>
                    <option {if $resultatVisite eq 1} selected="selected"{/if}  value="1">Ne correspond pas</option>
                    <option {if $resultatVisite eq 2} selected="selected"{/if} value="2">Ok</option>

                </select>
            </div>
        </div>
    </fieldset>

    <div class="form-group">
        <div class="col-sm-offset-2 col-sm-8">
            <button type="submit" value="Sauvegarder" name="send" id="send" class="btn btn-warning">
                <i class="fa fa-save"></i> Mettre à jour
            </button>
            <button type="submit" value="Annuler" name="cancel" id="cancel" class="btn btn-default">
                <i class="fa fa-close"></i> Annuler et fermer
            </button>
        </div>
    </div>
</form>
</div>
