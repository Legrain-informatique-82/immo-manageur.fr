{include file="tpl_default/entete.tpl"}
<form action="" method="post" role="form" class="form-horizontal">
    <div class="row bg-success bannerTitle">
        <div class="col-md-6">
            <h1 class="h2">{$title}</h1>
        </div>

        <div class="col-md-6">

            <p class="h4 text-right ">

                <button class="btn {if $add}btn-success{else}btn-warning{/if}" type="submit" name="send" value="Enregistrer" title="Enregistrer">
                    <i class="fa fa-save fa-2x"></i>
                </button>
                <button class="btn btn-default" type="submit" name="cancel" value="Annuler" title="Annuler">
                    <i class="fa fa-close fa-2x"></i>
                </button>

            </p>
        </div>
    </div>



    {include file="tpl_default/error.tpl"}


    <div class="form-group">

        <label class="col-sm-2 control-label" for="name">Nom <i class="fa"></i>: </label>
        <div class="col-sm-8">
            <input class="form-control" type="text" value="{$name}" name="name" id="name" />
        </div>

    </div>
    <div class="form-group">
        <div class="col-sm-offset-2 col-sm-8">
            <button type="submit" name="send" value="Enregistrer" class="btn  {if $add}btn-success{else}btn-warning{/if}">
                <i class="fa fa-save"></i> {if $add}Ajouter{else}Mettre à jour{/if}
            </button>
            <button type="submit" name="cancel" value="Annuler" class="btn btn-default">
                <i class="fa fa-close"></i> Annuler
            </button>
        </div>
    </div>
</form>
</div>
