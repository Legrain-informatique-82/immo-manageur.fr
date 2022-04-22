{include file="tpl_default/entete.tpl"}
<form action="" method="post" role="form" class="form-horizontal">
    <div class="row bg-success bannerTitle">
        <div class="col-md-8">
            <h1 class="h2">Suppression du rapprochement</h1>
        </div>
        <div class="col-md-4">
            <p class="h4 text-right ">
                <button type="submit" value="Supprimer" name="send" id="send" class="btn btn-danger" title="Supprimer">
                    <i class="fa fa-trash fa-2x"></i>
                </button>

                <button type="submit" value="Annuler" name="cancel" id="cancel" class="btn btn-default" title="Annuler &amp; fermer">
                    <i class="fa fa-close fa-2x"></i>
                </button>
            </p>
        </div>
    </div>
    <div class="form-group">
        <div class="col-sm-offset-2 col-sm-8">
            <p class="help-block">Êtes-vous sûr de vouloir supprimer le rapprochement entre
                {$rapprochement->getAcquereur()->getFirstname()}
                {$rapprochement->getAcquereur()->getName()} et le mandat
                {$rapprochement->getMandate()->getNumberMandate()} ?</p>

            <p>
                <button type="submit" value="Supprimer" name="send" id="send" class="btn btn-danger">
                    <i class="fa fa-trash"></i> Supprimer
                </button>

                <button type="submit" value="Annuler" name="cancel" id="cancel" class="btn btn-default">
                    <i class="fa fa-close"></i> Annuler &amp; fermer
                </button>
            </p>
        </div>
</form>
</div>
