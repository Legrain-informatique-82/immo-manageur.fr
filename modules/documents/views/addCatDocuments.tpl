{include file="tpl_default/entete.tpl"}
<form action="" method="post" role="form" class="form-horizontal">
    <div class="row bg-success bannerTitle">
        <div class="col-md-6">
            <h1 class="h2">{$h1}</h1>
        </div>
        <div class="col-md-6">
            <p class="h4 text-right ">

                <button type="submit" value="{$label_send}" name="send" class="btn {if $add}btn-success{else}btn-warning{/if}" title="{if $add}Enregistrer{else}Mettre à jour{/if}">
                    <i class="fa fa-save fa-2x"></i>
                </button>

                <a class="btn btn-default" href="{Tools::create_url($user,'documents','listCatDocuments')}" title="Annuler &amp; retourner à la liste">
                    <i class="fa fa-close fa-2x"></i>
                </a>
            </p>
        </div>
    </div>
    {include file="tpl_default/viewsErrors.tpl"}


    <div class="form-group">
        <label class="col-sm-2 control-label" for="name">Catégorie : </label>
        <div class="col-sm-8">
            <input type="text" class="form-control" name="name" id="name" value="{$name}" />
        </div>
    </div>

    <div class="form-group">
        <div class="col-sm-offset-2 col-sm-8">
            <p class="help-block">Destinataires :</p>
            <div class="form-inline">
                <label class="checkbox-inline"><input type="radio" name="code" value="seller" {if $code eq "seller"} checked="checked" {/if}/> Vendeurs</label>
                <label class="checkbox-inline"><input type="radio" name="code" value="acq" {if $code eq "acq"} checked="checked" {/if}/> Acquéreurs</label>
                <label class="checkbox-inline"><input type="radio" name="code" value="none" {if $code eq "none"} checked="checked" {/if}/> Indéfini</label>
            </div>
        </div>
    </div>
    <div class="form-group">
        <div class="col-sm-offset-2 col-sm-8">
            <button type="submit" value="{$label_send}" name="send" class="btn {if $add}btn-success{else}btn-warning{/if}">
                <i class="fa fa-save"></i> {if $add}Enregistrer{else}Mettre à jour{/if}
            </button>
            <a class="btn btn-default" href="{Tools::create_url($user,'documents','listCatDocuments')}">
                <i class="fa fa-close"></i> Annuler &amp; retourner à la liste
            </a>
        </div>
    </div>

</form>
</div>
