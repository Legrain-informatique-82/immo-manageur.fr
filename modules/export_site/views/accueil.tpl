{include file="tpl_default/entete.tpl"}
<form action="" method="post" enctype="multipart/form-data" class="form-horizontal" role="form">
    <div class="row bg-success bannerTitle">
        <div class="col-md-6">
            <h1 class="h2">Page d'accueil</h1>
        </div>

        <div class="col-md-6">

            <p class="h4 text-right ">

                <button type="submit" name="send" value="Valider" class="btn btn-success" title="Sauvegarder">
                    <i class="fa-save fa fa-2x"></i>
                </button>


            </p>
        </div>
    </div>








    <div class="form-group">
        <label class="col-sm-2 control-label" for="titreAccueil">Titre  :</label>
        <div class="col-sm-8">
            <input type="text" class="form-control"  name="titreAccueil" id="titreAccueil" value="{$se->getTitreAccueil()}" />
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-2 control-label" for="metaDescriptionAccueil">Description : </label>
        <div class="col-sm-8">
            <textarea class="form-control" name="metaDescriptionAccueil" id="metaDescriptionAccueil" cols="30" rows="10">{$se->getMetaDescriptionAccueil()}</textarea>
        </div>
    </div>
    <div class="form-group">
        <label for="txtAccueil" class="col-sm-2 control-label">Texte :</label>
        <div class="col-sm-8">
            <textarea class="form-control editor" name="txtAccueil" id="txtAccueil" cols="30" rows="10">{$se->getTxtIndex()}</textarea>
        </div>
    </div>

    <div class="form-group">
        <div class="col-sm-offset-2 col-sm-10">
            <button type="submit" name="send" value="Valider" class="btn btn-success">
                <i class="fa fa-save"></i> Sauvegarder
            </button>
        </div>
    </div>
</form>
</div>

