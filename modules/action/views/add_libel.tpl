{include file='tpl_default/entete.tpl'}
<form action="" method="post" role="form" class="form-horizontal">
    <div class="row bg-success bannerTitle">
        <div class="col-md-6">
            <h1 class="h2">{$title}</h1>
        </div>

        <div class="col-md-6">
            <p class="h4 text-right ">
                <button type="submit" name="send" value="Valider" title="{if $add}Enregistrer{else}Mettre à jour{/if}" class="btn {if $add}btn-success{else}btn-warning{/if}">
                    <i class="fa fa-save fa-2x"></i>
                </button>
                <a title="Annuler et fermer" class="btn btn-default" href="{Tools::create_url($user,"action","list_libel")}">
                    <i class="fa fa-close fa-2x"></i>
                </a>

            </p>
        </div>
    </div>


    {include file="tpl_default/error.tpl"}


    <div class="form-group">
        <label class="col-sm-2 control-label" for="libel">Libellé : </label>
        <div class="col-sm-8">
            <input class="form-control" type="text" name="libel" id="libel" value="{$libel}" />
        </div>
    </div>
    <div class="form-group">
        <div class="col-sm-offset-2 col-sm-8">
            <button type="submit" name="send" value="Valider" class="btn  {if $add}btn-success{else}btn-warning{/if}">
                <i class="fa fa-save"></i>  {if $add}Enregistrer{else}Mettre à jour{/if}
            </button>
            <a title="Annuler et fermer" class="btn btn-default" href="{Tools::create_url($user,"action","list_libel")}">
                <i class="fa fa-close"></i> Annuler &amp; fermer
            </a>
        </div>
    </div>
</form>
</div>
