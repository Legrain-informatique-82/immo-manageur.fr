{include file="tpl_default/entete.tpl"}
<form action="" method="post" enctype="multipart/form-data" role="form" class="form-horizontal">
    <div class="row bg-success bannerTitle">
        <div class="col-md-6">
            <h1 class="h2">{$cms->getPrivateName()}</h1>
        </div>

        <div class="col-md-6">

            <p class="h4 text-right ">

                <button type="submit" name="send" value="Valider" class="btn btn-success" title="Sauvegarder">
                    <i class="fa-save fa fa-2x"></i>
                </button>


            </p>
        </div>
    </div>





        {include file="tpl_default/error.tpl"}




        <div class="form-group">
            <label class="col-sm-2 control-label" for="publicName">Titre du menu  :</label>
            <div class="col-sm-8">
                <input class="form-control" type="text" name="publicName" id="publicName" value="{$cms->getPublicName()}" />
            </div>
        </div>


        <div class="form-group">
            <label class="col-sm-2 control-label" for="title">Titre de la page  :</label>
            <div class="col-sm-8">
                <input class="form-control" type="text" name="title" id="title" value="{$cms->getTitle()}" />
            </div>
        </div>

        <div class="form-group">
            <label class="col-sm-2 control-label" for="url">Url de la page  :</label>
            <div class="col-sm-8">
                <input class="form-control" type="text" name="url" id="url" value="{$cms->getUrl()}" />
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label" for="description">Description : </label>
            <div class="col-sm-8">
                <textarea class="form-control" name="description" id="description" cols="30" rows="10">{$cms->getDescription()}</textarea>
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label" for="content">Texte :</label>
            <div class="col-sm-8">
                <textarea class="form-control editor"  name="content" id="content" cols="30" rows="10">{$cms->getContent()}</textarea>
            </div>
        </div>

        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
                <button type="submit" name="send" value="Valider" class="btn btn-success">
                    <i class="fa fa-save"></i> sauvegarder
                </button>
            </div>
        </div>
</form>
</div>
