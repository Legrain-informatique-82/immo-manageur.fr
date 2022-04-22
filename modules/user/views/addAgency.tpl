{include file="tpl_default/entete.tpl"}
<form action="" method="post" enctype="multipart/form-data" class="form-horizontal" role="form">
<div class="row bg-success bannerTitle">
    <div class="col-md-6">
        <h1 class="h2">{$title}</h1>
    </div>

    <div class="col-md-6">
        <p class="h4 text-right ">
            <button type="submit" name="add" value="Valider" class="btn btn-success" title="Valider">
                <i class="fa fa-save fa-2x"></i>
            </button>

            <a title="Annuler et fermer" class="btn btn-default" href="{Tools::create_url($user,"user","listAgencies")}">
                <i class="fa fa-close fa-2x"></i>
            </a>

        </p>
    </div>
</div>

{include file="tpl_default/error.tpl"}

<fieldset>
    <legend>Général</legend>
    <div class="form-group">
        <label class="col-sm-2 control-label" for="name">Nom ( interne) : </label>
        <div class="col-sm-8">
            <input type="text" name="name" id="name" value="{$smarty.post.name}" class="form-control"/>
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-2 control-label" for="generalName">Nom ( general) : </label>
        <div class="col-sm-8">
            <input type="text" name="generalName" id="generalName" value="{$smarty.post.generalName}" class="form-control"/>
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-2 control-label" for="url">Site web : </label>
        <div class="col-sm-8">
            <input type="text" name="url" id="url" value="{$smarty.post.url}" class="form-control"/>
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-2 control-label" for="tel1">Tél 1 : </label>
        <div class="col-sm-8">
            <input type="text" name="tel1" id="tel1" value="{$smarty.post.tel1}"  class="form-control"/>
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-2 control-label" for="tel2">Tél 2 : </label>
        <div class="col-sm-8">
            <input type="text" name="tel2" id="tel2" value="{$smarty.post.tel2}"  class="form-control"/>
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-2 control-label" for="tel3">Tél 3 : </label>
        <div class="col-sm-8">
            <input type="text" name="tel3" id="tel3" value="{$smarty.post.tel3}"  class="form-control"/>
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-2 control-label" for="email">Email : </label>
        <div class="col-sm-8">
            <input type="text" name="email" id="email" value="{$smarty.post.email}"  class="form-control"/>
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-2 control-label" for="address">Adresse : </label>
        <div class="col-sm-8">
            <input type="text" name="address" id="address" value="{$smarty.post.address}" class="form-control"/>
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-2 control-label" for="city">Ville : </label>
        <div class="col-sm-8">
            <input type="text" name="city" id="city" value="{$smarty.post.city}"  class="form-control"/>
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-2 control-label" for="zipCode">Code postal : </label>
        <div class="col-sm-8">
            <input type="text" name="zipCode" id="zipCode" value="{$smarty.post.zipCode}"  class="form-control"/>
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-2 control-label" for="contact">Contact : </label>
        <div class="col-sm-8">
            <input type="text" name="contact" id="contact" value="{$smarty.post.contact}"  class="form-control"/>
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-2 control-label" for="siret">Siret : </label>
        <div class="col-sm-8">
            <input type="text" name="siret" id="siret" value="{$smarty.post.siret}"  class="form-control"/>
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-2 control-label" for="capital">Capital : </label>
        <div class="col-sm-8">
            <input type="text" name="capital" id="capital" value="{$smarty.post.capital}"  class="form-control"/>
        </div>
    </div>
</fieldset>
<!-- 3 logos  -->
<fieldset>
    <legend>Logos</legend>
    {*
         * @param logoExtranet string
         * @param logoAfficheMandat string
         * @param logoAfficheTerrain string
         * @param logoCourrier string
    *}

    {*
<div class="bulle">
{if $errorlogoExtranet}
    <p class="error">
    {$errorlogoExtranet}</div>
{/if}

{if $logoExtranet}
<div class="form-group">
    <img src="{Constant::DEFAULT_URL_PICTURE_DIRECTORY}modules/user/{$logoExtranet}" alt="logo extranet existant" />
</div>
{/if}

<div class="form-group">
    <label class="col-sm-2 control-label" for="logoExtranet">Logo extranet : </label>
<input type="file" name="logoExtranet" id="logoExtranet" />
</div>
</div>
*}


    <!-- Afficher le logo existant -->
    {if $errorAfficheMandat}
        <p class="error">
            {$errorAfficheMandat}
        </p>
    {/if}
    {if $logoAfficheMandat}
        <p>
            <img src="{Constant::DEFAULT_URL_PICTURE_DIRECTORY}modules/user/{$logoAfficheMandat}" alt="logo affiche mandat existant" />
        </p>
    {/if}
    <div class="form-group">
        <label class="col-sm-2 control-label" for="logoAfficheMandat">Entête affiche mandat : </label>
        <div class="col-sm-8">
            <input type="file" name="logoAfficheMandat" id="logoAfficheMandat" />
        </div>
    </div>



    {if $errorAfficheTerrain}
        <p class="error">
            {$errorAfficheTerrain}
        </p>
    {/if}
    {if $logoAfficheTerrain}
        <p>
            <img src="{Constant::DEFAULT_URL_PICTURE_DIRECTORY}modules/user/{$logoAfficheTerrain}" alt="logo affiche terrain existant" />
        </p>
    {/if}
    <div class="form-group">
        <label class="col-sm-2 control-label" for="logoAfficheTerrain">Entête affiche terrain :</label>
        <div class="col-sm-8">
            <input type="file" name="logoAfficheTerrain" id="logoAfficheTerrain" />
        </div>
    </div>


    {*
    <div class="bulle">
    {if $errorEnteteCourrier}
        <p class="error">
        {$errorEnteteCourrier}
        </div>
    {/if}
    <!-- Afficher le logo existant -->
    {if $logoCourrier}
    <div class="form-group">
        <img src="{Constant::DEFAULT_URL_PICTURE_DIRECTORY}modules/user/{$logoCourrier}" alt="entête de courrier existante" />
    </div>
    {/if}
    <div class="form-group">
        <label class="col-sm-2 control-label" for="logoCourrier">Entête courrier :</label>
    <input type="file" name="logoCourrier" id="logoCourrier" />
    </div>
    </div>
    *}
</fieldset>



<fieldset>
    <legend>Lettres type</legend>

    <div class="form-group">
        <label class="col-sm-2 control-label" for="footerLettre">Pied de page</label>
        <div class="col-sm-8">
            <textarea name="footerLettre" id="footerLettre" cols="30" rows="10"  class="form-control">{$footerLettre}</textarea>
        </div>
    </div>



    {if $errorEnteteLettre}
        <p class="error">
            {$errorEnteteLettre}
        </p>
    {/if}
    <!-- Afficher le logo existant -->
    {if $enteteLettre}
        <p>
            <img src="{Constant::DEFAULT_URL_PICTURE_DIRECTORY}modules/user/{$enteteLettre}" alt="entête de lettre existante" />
        </p>
    {/if}
    <div class="form-group">
        <label class="col-sm-2 control-label" for="enteteLettre">Entête Lettre :</label>
        <div class="col-sm-8">
            <input type="file" name="enteteLettre" id="enteteLettre" />
        </div>
    </div>




    {if $errorFooterLettre}
        <p class="error">
            {$errorFooterLettre}
        </p>
    {/if}
    <!-- Afficher le logo existant -->
    {if $logoFooterlettre}
        <p>
            <img src="{Constant::DEFAULT_URL_PICTURE_DIRECTORY}modules/user/{$logoFooterlettre}" alt="entête de lettre existante" />
        </p>
    {/if}
    <div class="form-group">
        <label class="col-sm-2 control-label" for="logoFooterLettre">logo pied de page :</label>
        <div class="col-sm-8">
            <input type="file" name="logoFooterLettre" id="logoFooterLettre" />
        </div>
    </div>


</fieldset>

<div class="form-group">
    <div class="col-sm-offset-2 col-sm-8">
        <button type="submit" name="add" value="Valider" class="btn btn-success">
            <i class="fa fa-save"></i> Valider
        </button>
        <a title="Annuler et fermer" class="btn btn-default" href="{Tools::create_url($user,"user","listAgencies")}">
            <i class="fa fa-close"></i> Annuler
        </a>
    </div>
</div>
</form>
</div>
