{include file="tpl_default/entete.tpl"}

{include file="tpl_default/entete.tpl"}
<form action="" method="post" enctype="multipart/form-data" role="form" class="form-horizontal">
    <div class="row bg-success bannerTitle">
        <div class="col-md-6">
            <h1 class="h2">Gestion des comptes clients</h1>
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
        <label class="col-sm-2 control-label" for="urlwebsite">Url du site vitrine : </label>
        <div class="col-sm-8">
        <input type="text" name="urlwebsite" id="urlwebsite" value="{$urlwebsite}" class="form-control"/>
    </div>
    </div>

    <fieldset>
        <legend>E-mail inscription :</legend>
        <div class="form-group">
            <label class="col-sm-2 control-label" for="subjectemailwelcome">Sujet de l'e-mail : </label>
            <div class="col-sm-8">
            <input type="text" name="subjectemailwelcome" id="subjectemailwelcome" value="{$subjectemailwelcome}" class="form-control"/>
        </div>
        </div>
        <div class="form-group">
            <p class="help-block col-sm-offset-2 col-sm-10">Mots clefs :{literal} {prenom}, {nom},{url},{identifiant},{motDePasse}{/literal} ( respectez la casse)</p>
            <label class="col-sm-2 control-label" for="emailwelcome">Contenu :</label>

            <div class="col-sm-8">
            <textarea name="emailwelcome" id="emailwelcome" cols="30" rows="10" class="editor form-control">{$emailwelcome}</textarea>
        </div>
        </div>
    </fieldset>
    <fieldset>
        <legend>E-mail régénérer le mot de passe :</legend>
        <div class="form-group">
            <label class="col-sm-2 control-label" for="subjectemailresetpassword">Sujet de l'e-mail : </label>
            <div class="col-sm-8">
            <input type="text" name="subjectemailresetpassword" id="subjectemailresetpassword" value="{$subjectemailresetpassword}" class="form-control"/>
        </div>
        </div>
        <div class="form-group">
            <p class="help-block col-sm-offset-2 col-sm-10"> Mots clefs :{literal} {prenom}, {nom},{url},{identifiant},{motDePasse}{/literal} ( respectez la casse)</p>
            <label class="col-sm-2 control-label" for="emailresetpassword">Contenu : </label>
            <div class="col-sm-8">

            <textarea name="emailresetpassword" id="emailresetpassword" cols="30" rows="10" class="editor form-control">{$emailresetpassword}</textarea>
        </div>
        </div>
    </fieldset>
    <fieldset>
        <legend>Email de contact commercial</legend>
        <div class="form-group">
            <label class="col-sm-2 control-label" for="subjectemailcontactcommercial">Sujet de l'email :</label>
            <div class="col-sm-8">
            <input type="text" name="subjectemailcontactcommercial" id="subjectemailcontactcommercial" value="{$subjectemailcontactcommercial}" class="form-control"/>
        </div>
        </div>
    </fieldset>
    <div class="form-group">
        <div class="col-sm-offset-2 col-sm-10">
        <button type="submit" name="send" value="Valider" class="btn-success btn">
            <i class="fa fa-save"></i> Sauvegarder
        </button>
    </div>
    </div>
</form>
</div>

