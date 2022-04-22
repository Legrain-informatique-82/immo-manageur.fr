{include file="tpl_default/entete.tpl"}
<form action="" method="post" role="form" class="form-horizontal">
    <div class="row bg-success bannerTitle">
        <div class="col-md-6">
            <h1 class="h2"> Supprimer la fourchette</h1>
        </div>
        <div class="col-md-6">
            <p class="h4 text-right ">

                <button type="submit" name="valid" value="{Lang::LABEL_DELETE}" class="btn btn-danger" title="{Lang::LABEL_DELETE}">
                    <i class="fa fa-trash fa-2x"></i>
                </button>
                <button type="submit" name="cancel" value="{Lang::LABEL_CANCEL}" class="btn btn-default" title="{Lang::LABEL_CANCEL}">
                    <i class="fa fa-close fa-2x"></i>
                </button>

            </p>
        </div>
    </div>
    <div class="col-sm-offset-2 col-sm-8">
        <p class="help-block">Êtes-vous sûr de vouloir supprimer la fourchette : {$fo->getName()} </p>
        <p>
            <button type="submit" name="valid" value="Valider" class="btn btn-danger">
                <i class="fa fa-trash"></i> Supprimer
            </button>
            <button type="submit"name="cancel" value="Annuler" class="btn btn-default">
                <i class="fa fa-close"></i> Annuler et fermer
            </button>
        </p>
    </div>
</form>


