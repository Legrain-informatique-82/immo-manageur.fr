{include file="tpl_default/entete.tpl"}
<form action="" method="post"  role="form" class="form-horizontal">
    <div class="row bg-success bannerTitle">
        <div class="col-md-6">
            <h1 class="h2">Modifier les pubs</h1>
        </div>

        <div class="col-md-6">
            <p class="h4 text-right ">


                <button type="submit" name="seller_add_submit_send" class="btn btn-success">
                    <i class="fa fa-save fa-2x"></i>
                </button>
                <a title="annuler et fermer" class="btn btn-default" href="{Tools::create_url($user,"seller","lists")}">
                    <i class="fa fa-close fa-2x"></i>
                </a>
            </p>
        </div>
    </div>

    {if $error} {foreach from=$error item=item name=e} {if
    $smarty.foreach.e.first}
        <div class="alert alert-danger" role="alert">
        <ul>
    {/if}
        <li class="error">{$item}</li> {if $smarty.foreach.e.last}
            </ul>
        {/if} {/foreach}
        </div>
    {/if}

    <fieldset>
        <legend>Options</legend>

        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
                <div class="checkbox">
                    <label for="coupCoeur">
                        <input {if $coupCoeur eq "on"}checked="checked" {/if} type="checkbox" name="coupCoeur" value="on" id="coupCoeur" /> Coup de coeur
                    </label>
                </div>
            </div>
        </div>
        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
                <div class="checkbox">
                    <label for="afficheEnVitrine">
                        <input {if $afficheEnVitrine eq "on"}checked="checked" {/if} type="checkbox" name="afficheEnVitrine" value="on" id="afficheEnVitrine" /> Texte utilisé dans la vitrine
                    </label>
                </div>
            </div>
        </div>

    </fieldset>

    <fieldset>
        <legend>Texte utilisé dans les affiches :</legend>

        <div class="form-group">
            <label class="col-sm-2 control-label" for="vitrine">Texte vitrine : </label>
            <div class="col-sm-8">
                <textarea class="form-control" name="vitrine" id="vitrine" cols="30" rows="10">{$vitrine}</textarea>
            </div>
        </div>
    </fieldset>







    <fieldset>
        <legend>Texte utilisé avec les passerelles :</legend>

        <div class="form-group">
            <label class="col-sm-2 control-label" for="pub">Publicité Internet : </label>
            <div class="col-sm-8">
                <textarea class="form-control" name="pub" id="pub" cols="30" rows="10">{$pub}</textarea>
            </div>
        </div>

    </fieldset>




    {include file="tpl_default/hook.tpl" position="hook_updatePhotosExport"}
    <div class="form-group">
        <div class="col-sm-offset-2 col-sm-8">
            <button type="submit" name="valid" value="Valider" class="btn-warning btn">
                <i class="fa-save fa"></i> Mettre à jour
            </button>
            <button type="submit" name="cancel" value="Annuler" class="btn btn-default">
                <i class="fa-fa-close"></i> Annuler et fermer
            </button>
        </div>
    </div>
</form>
