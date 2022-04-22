{include file="tpl_default/entete.tpl"}
<form action="" method="post" enctype="multipart/form-data" role="form" class="form-horizontal">
<div class="row bg-success bannerTitle">
    <div class="col-md-6">
        <h1 class="h2">{$title}</h1>
    </div>

    <div class="col-md-6">
        <p class="h4 text-right ">
            <button type="submit" name="upd" value="Valider" class="btn btn-warning" title="Valider">
                <i class="fa fa-save fa-2x"></i>
            </button>

            <a title="Annuler et fermer" class="btn btn-default" href="{Tools::create_url($user,"user","listAgencies")}">
                <i class="fa fa-close fa-2x"></i>
            </a>

        </p>
    </div>
</div>

<div id="blocAgency">

<fieldset>
    <legend>Général</legend>
    <div class="form-group">
        <label class="col-sm-2 control-label"  for="name">Nom ( interne) : </label>
        <div class="col-sm-8">
            <input class="form-control" type="text" name="name" id="name" value="{$agency->getName()}"/>
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-2 control-label"  for="generalName">Nom ( general) : </label>
        <div class="col-sm-8">
            <input class="form-control" type="text" name="generalName" id="generalName" value="{$agency->getGeneralName()}"/>
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-2 control-label"  for="url">Site web : </label>
        <div class="col-sm-8">
            <input class="form-control" type="text" name="url" id="url" value="{$agency->getUrl()}"/>
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-2 control-label"  for="tel1">Tél 1 : </label>
        <div class="col-sm-8">
            <input class="form-control" type="text" name="tel1" id="tel1" value="{$agency->getTel1()}" />
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-2 control-label"  for="tel2">Tél 2 : </label>
        <div class="col-sm-8">
            <input class="form-control" type="text" name="tel2" id="tel2" value="{$agency->getTel2()}" />
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-2 control-label"  for="tel3">Tél 3 : </label>
        <div class="col-sm-8">
            <input class="form-control" type="text" name="tel3" id="tel3" value="{$agency->getTel3()}" />
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-2 control-label"  for="email">Email : </label>
        <div class="col-sm-8">
            <input class="form-control" type="text" name="email" id="email" value="{$agency->getEmail()}" />
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-2 control-label"  for="address">Adresse : </label>
        <div class="col-sm-8">
            <input class="form-control" type="text" name="address" id="address" value="{$agency->getAddress()}"/>
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-2 control-label"  for="city">Ville : </label>
        <div class="col-sm-8">
            <input class="form-control" type="text" name="city" id="city" value="{$agency->getCity()}" />
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-2 control-label"  for="zipCode">Code postal : </label>
        <div class="col-sm-8">
            <input class="form-control" type="text" name="zipCode" id="zipCode" value="{$agency->getZipCode()}" />
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-2 control-label"  for="contact">Contact : </label>
        <div class="col-sm-8">
            <input class="form-control" type="text" name="contact" id="contact" value="{$agency->getContact()}" />
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-2 control-label"  for="siret">Siret : </label>
        <div class="col-sm-8">
            <input class="form-control" type="text" name="siret" id="siret" value="{$agency->getSiret()}" />
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-2 control-label"  for="capital">Capital : </label>
        <div class="col-sm-8">
            <input class="form-control" type="text" name="capital" id="capital" value="{$agency->getCapital()}" />
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
           {if $errorlogoExtranet}
               <p class="error">
                   {$errorlogoExtranet}
               </p>
           {/if}

           {if $agency->getLogoExtranet()}
               <p>
                   <img src="{Constant::DEFAULT_URL_PICTURE_DIRECTORY}modules/user/{$agency->getLogoExtranet()}" alt="logo extranet existant" />
               </p>
           {/if}

           <div class="form-group">
               <label class="col-sm-2 control-label"  for="logoExtranet">Logo extranet : </label>
               <input class="form-control" type="file" name="logoExtranet" id="logoExtranet" />
           </div>
   *}



    <!-- Afficher le logo existant -->
    {if $errorAfficheMandat}
        <p class="error">
            {$errorAfficheMandat}
        </p>
    {/if}
    {if $agency->getLogoAfficheMandat()}
        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-8">
                <p>
                    <img src="{Constant::DEFAULT_URL_PICTURE_DIRECTORY}modules/user/{$agency->getLogoAfficheMandat()}" alt="logo affiche mandat existant" />
                </p>
            </div>
        </div>
    {/if}
    <div class="form-group">
        <label class="col-sm-2 control-label"  for="logoAfficheMandat">Entête affiche mandat : </label>
        <div class="col-sm-8">
            <input type="file" name="logoAfficheMandat" id="logoAfficheMandat" />
        </div>
    </div>



    {if $errorAfficheTerrain}
        <p class="error">
            {$errorAfficheTerrain}
        </p>
    {/if}
    {if $agency->getLogoAfficheTerrain()}
        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-8">
                <p>
                    <img src="{Constant::DEFAULT_URL_PICTURE_DIRECTORY}modules/user/{$agency->getLogoAfficheTerrain()}" alt="logo affiche terrain existant" />
                </p>
            </div>
        </div>
    {/if}
    <div class="form-group">
        <label class="col-sm-2 control-label"  for="logoAfficheTerrain">Entête affiche terrain :</label>
        <div class="col-sm-8">
            <input type="file" name="logoAfficheTerrain" id="logoAfficheTerrain" />
        </div>
    </div>



    {*
            {if $errorEnteteCourrier}
                <p class="error">
                    {$errorEnteteCourrier}
                </p>
            {/if}
            <!-- Afficher le logo existant -->
            {if $agency->getLogoCourrier()}
                <p>
                    <img src="{Constant::DEFAULT_URL_PICTURE_DIRECTORY}modules/user/{$agency->getLogoCourrier()}" alt="entête de courrier existante" />
                </p>
            {/if}
            <div class="form-group">
                <label class="col-sm-2 control-label"  for="logoCourrier">Entête courrier :</label>
                <input class="form-control" type="file" name="logoCourrier" id="logoCourrier" />
            </div>
    *}
</fieldset>


<fieldset>
    <legend>Lettres type</legend>
    <div class="form-group">
        <label class="col-sm-2 control-label"  for="footerLettre">Pied de page</label>
        <div class="col-sm-8">
            <textarea class="form-control" name="footerLettre" id="footerLettre" cols="30" rows="10">{$agency->getFooterLettre()}</textarea>
        </div>
    </div>



    {if $errorEnteteLettre}
        <p class="error">
            {$errorEnteteLettre}
        </p>
    {/if}
    <!-- Afficher le logo existant -->
    {if $agency->getEnteteLettre()}
        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-8">
                <p>
                    <img src="{Constant::DEFAULT_URL_PICTURE_DIRECTORY}modules/user/{$agency->getEnteteLettre()}" alt="entête de lettre existante" />
                </p>
            </div>
        </div>
    {/if}
    <div class="form-group">
        <label class="col-sm-2 control-label"  for="enteteLettre">Entête Lettre :</label>
        <div class="col-sm-8">
            <input type="file" name="enteteLettre" id="enteteLettre" />
        </div>
    </div>





    {if $errorFooterLettre}
        <p class="error">
            {$errorFooterLettre}
        </p>
    {/if}

    {if $agency->getLogoFooterlettre()}
        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-8">
                <p>
                    <img src="{Constant::DEFAULT_URL_PICTURE_DIRECTORY}modules/user/{$agency->getLogoFooterlettre()}" alt="entête de lettre existante" />
                </p>
            </div>
        </div>
    {/if}

    <!-- Afficher le logo existant -->

    <div class="form-group">
        <label class="col-sm-2 control-label"  for="logoFooterLettre">logo pied de page :</label>
        <div class="col-sm-8">
            <input type="file" name="logoFooterLettre" id="logoFooterLettre" />
        </div>
    </div>


</fieldset>

<div class="form-group">
    <div class="col-sm-offset-2 col-sm-8">


        <button type="submit" name="upd" value="Valider" class="btn btn-warning" title="Valider">
            <i class="fa fa-save"></i> Mettre à jour
        </button>

        <a title="Annuler et fermer" class="btn btn-default" href="{Tools::create_url($user,"user","listAgencies")}">
            <i class="fa fa-close"></i> Annuler et fermer
        </a>

    </div>
</div>
</form>

</div>