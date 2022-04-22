{include file="tpl_default/entete.tpl"}
<form action="" method="post" role="form" class="form-horizontal">
    <div class="row bg-success bannerTitle">
        <div class="col-md-6">
            <h1 class="h2">{$h1}</h1>
        </div>
        <div class="col-md-6">
            <p class="h4 text-right ">
                <button type="submit" name="delete" value="Oui" class="btn btn-danger" title="{Lang::LABEL_DELETE}">
                    <i class="fa fa-trash fa-2x"></i>
                </button>
                <button type="submit" name="cancel" value="Non" class="btn btn-default" title="{Lang::LABEL_CANCEL}">
                    <i class="fa fa-close fa-2x"></i>
                </button>
            </p>
        </div>
    </div>
    {include file="tpl_default/viewsErrors.tpl"}
    <div class="form-group">
        <div class="col-sm-offset-2 col-sm-8">
            <p class="help-block">Êtes-vous certain de vouloir supprimer ce document ? </p>


            <p>

                <button type="submit" name="delete" value="Oui" class="btn btn-danger">
                    <i class="fa fa-trash"></i> {Lang::LABEL_DELETE}
                </button>
                <button type="submit" name="cancel" value="Non" class="btn btn-default">
                    <i class="fa fa-close"></i> {Lang::LABEL_CANCEL}
                </button>
            </p>
        </div>
    </div>
</form>
</div>
