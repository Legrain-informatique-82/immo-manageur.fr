{include file="tpl_default/entete.tpl"}
<form action="" method="post" role="form" class="form-horizontal">
    <div class="row bg-success bannerTitle">
        <div class="col-md-6">
            <h1 class="h2">{$h1}</h1>
        </div>

        <div class="col-md-6">
            <p class="h4 text-right ">
                {*
                <button type="submit" name="delete" value="{Lang::LABEL_DELETE}" class="btn btn-danger" title="{Lang::LABEL_DELETE}">
                    <i class="fa fa-trash fa-2x"></i>
                </button>
                <button type="submit" name="cancel" value="{Lang::LABEL_CANCEL}" class="btn btn-default" title="{Lang::LABEL_CANCEL}">
                    <i class="fa fa-close fa-2x"></i>
                </button>
    *}
                <button type="submit" value="Enregistrer" name="save" class="btn {if $smarty.get.action}btn-warning{else}btn-success{/if}" title="Enregistrer">
                    <i class="fa fa-save fa-2x"></i>
                </button>
                <button type="submit" value="Enregistrer et fermer" name="save_and_quit" class="btn btn-info" title="Enregistrer et fermer">
                    <i class="fa fa-save fa-2x"></i>
                </button>
                <button type="submit" name="cancel" value="Annuler" class="btn btn-default" title="Fermer">
                    <i class="fa fa-close fa-2x"></i>
                </button>
            </p>
        </div>
    </div>
    {include file="tpl_default/viewsErrors.tpl"}



    <fieldset>
        <legend>Type de biens : </legend>
        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-8">
                <p class="help-block">Sélectionner les types de biens pour lesquels le document sera disponible</p>
                {foreach $mandateType as $t}
                    <label class="checkbox-inline"><input {if in_array($t->getId(),$listIdTypeBiensSelected)}checked="checked"{/if} type="checkbox" name="type[]" value="{$t->getId()}"/>{$t->getName()}</label>
                {/foreach}
            </div>
        </div>
    </fieldset>
    <fieldset>
        <legend>Etape du bien : </legend>
        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-8">
                <p class="help-block">Sélectionner les étapes de biens pour lesquels le document sera disponible</p>
                {foreach $mandateEtap as $e}
                    <label class="checkbox-inline"><input  {if in_array($e->getId(),$listIdEtapSelected)}checked="checked"{/if} type="checkbox" name="etap[]" value="{$e->getId()}"/>{$e->getName()}</label>
                {/foreach}
            </div>
        </div>

    </fieldset>

    <fieldset >
        <legend>Désignation : </legend>

        <div class="form-group">
            <label class="col-sm-2 control-label" for="category">Catégorie : </label>
            <div class="col-sm-8">
                <select class="form-control" name="category" id="category">
                    {foreach $categories as $cat}
                        <option {if $category eq $cat->getIdCategoryDocument()} selected="selected"{/if} value="{$cat->getIdCategoryDocument()}">{$cat->getName()}</option>
                    {/foreach}
                </select>
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label" for="name">Nom : </label>
            <div class="col-sm-8">
                <input class="form-control" type="text" name="name" id="name" value="{$name}"/>
            </div>
        </div>
    </fieldset>

    <fieldset>
        <legend>Contenu du courrier : </legend>
        <div>
            {if $smarty.get.action}
                <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-8">
                        <p class="help-block">
                            Vous devez enregistrez le document avant de l'imprimer :
                            <a class="btn btn-default" href="{Tools::create_url($user,'documents','printDoc',$smarty.get.action)}" target="_blank">
                                <i class="fa fa-print"></i> Imprimer le document
                            </a>
                        </p>
                    </div>
                </div>
            {/if}
        </div>
        {include file="documents/views/editor.tpl"}


    </fieldset>



    <div class="form-group">
        <div class="col-sm-offset-2 col-sm-8">
            <button type="submit" value="Enregistrer" name="save" class="btn {if $smarty.get.action}btn-warning{else}btn-success{/if}">
                <i class="fa fa-save"></i> Enregistrer
            </button>
            <button type="submit" value="Enregistrer et fermer" name="save_and_quit" class="btn btn-info" >
                <i class="fa fa-save"></i> Enregistrer et fermer
            </button>
            <button type="submit" name="cancel" value="Annuler" class="btn btn-default">
                <i class="fa fa-close"></i> Fermer
            </button>
        </div>
    </div>


</form>
</div>
