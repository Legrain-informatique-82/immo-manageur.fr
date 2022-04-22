<form action="" method="post" role="form" class="form-horizontal">

    <div class="row bg-success bannerTitle">
        <div class="col-md-6">
            <h1 class="h2">Modification des commentaires / Infos visite</h1>
        </div>
        <div class="col-md-6">
            <p class="h4 text-right ">
                <button type="submit" value="Valider" name="send" class="btn btn-warning" title="Mettre à jour">
                    <i class="fa fa-save fa-2x"></i>
                </button>
                <button type="submit" value="Annuler" name="cancel" class="btn btn-default" title="Annuler et fermer" >
                    <i class="fa fa-close fa-2x"></i>
                </button>
            </p>
        </div>
    </div>


    <div class="form-group">
        <label class="col-sm-2 control-label" for="com">Commentaire :</label>
        <div class="col-sm-8">
            <textarea class="form-control" name="com" id="com" cols="30" rows="10">{if $elementMandateCom}{$elementMandateCom->getCom()}{/if}</textarea>
        </div>

    </div>
    <div class="form-group">
        <label class="col-sm-2 control-label" for="infoVisite">Infos visite : </label>
        <div class="col-sm-8">
            <textarea class="form-control" name="infoVisite" id="infoVisite" cols="30" rows="10">{if $elementMandateCom}{$elementMandateCom->getInfoVisite()}{/if}</textarea>
        </div>

    </div>
    <div class="form-group">
        <label class="col-sm-2 control-label" for="otherCom">Observations : </label>
        <div class="col-sm-8">
            <textarea class="form-control" name="otherCom" id="otherCom" cols="30" rows="10">{if $elementMandateCom}{$elementMandateCom->getOtherCom()}{/if}</textarea>
        </div>

    </div>
    <div class="form-group">
        <div class="col-sm-offset-2 col-sm-8">
            <button type="submit" value="Valider" name="send" class="btn btn-warning">
                <i class="fa fa-save"></i> Mettre à jour
            </button>
            <button type="submit" value="Annuler" name="cancel" class="btn btn-default" >
                <i class="fa fa-close"></i> Annuler et fermer
            </button>
        </div>
    </div>
</form>
