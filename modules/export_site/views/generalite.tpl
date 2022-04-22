{include file="tpl_default/entete.tpl"}
<form action="" method="post" enctype="multipart/form-data" role="form" class="form-horizontal">
    <div class="row bg-success bannerTitle">
        <div class="col-md-6">
            <h1 class="h2">Généralités</h1>
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
        <label class="col-sm-2 control-label"  for="nomSite">Nom du site : </label>
        <div class="col-sm-8">
            <input type="text" name="nomSite" id="nomSite" value="{$se->getNomSite()}" class="form-control"/>
        </div>
    </div>


    <div class="form-group">
        <label class="col-sm-2 control-label"  for="emailContact">Email de contact :</label>
        <div class="col-sm-8">
            <input type="text" name="emailContact" id="emailContact" value="{$se->getEmailContact()}" class="form-control" />
        </div>
    </div>

    {*add*}
    <div class="form-group">
        <label class="col-sm-2 control-label"  for="nameAgency">Nom de l'agence :</label>
        <div class="col-sm-8">
            <input type="text" name="nameAgency" id="nameAgency" value="{$se->getNameAgency()}" class="form-control" />
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-2 control-label"  for="addressAgency">Adresse de l'agence :</label>
        <div class="col-sm-8">
            <input type="text" name="addressAgency" id="addressAgency" value="{$se->getAddressAgency()}" class="form-control" />
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-2 control-label"  for="zipCodeAgency">Code postal de l'agence :</label>
        <div class="col-sm-8">
            <input type="text" name="zipCodeAgency" id="zipCodeAgency" value="{$se->getZipCodeAgency()}" class="form-control" />
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-2 control-label"  for="cityAgency">Ville de l'agence :</label>
        <div class="col-sm-8">
            <input type="text" name="cityAgency" id="cityAgency" value="{$se->getCityAgency()}" class="form-control" />
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-2 control-label"  for="phoneAgency">téléphone de l'agence :</label>
        <div class="col-sm-8">
            <input type="text" name="phoneAgency" id="phoneAgency" value="{$se->getPhoneAgency()}" class="form-control" />
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-2 control-label"  for="faxAgency">Fax de l'agence :</label>
        <div class="col-sm-8">
            <input type="text" name="faxAgency" id="faxAgency" value="{$se->getFaxAgency()}" class="form-control" />
        </div>
    </div>
    {*fin add*}


    <div class="form-group">
        <label class="col-sm-2 control-label"  for="robots">Référençable : </label>
        <div class="col-sm-8">
            <select name="robots" id="robots" class="form-control">
                <option {if $se->getRobots() eq 0} selected="selected"{/if} value="0">Non</option>
                <option {if $se->getRobots() eq 1} selected="selected"{/if} value="1">Oui</option>
            </select>
        </div>
    </div>

    <div class="form-group">
        <label class="col-sm-2 control-label"  for="theme">Thème : </label>
        <div class="col-sm-8">
            <select name="theme" id="theme" class="form-control">
                {foreach from=$themes item=it}
                    <option {if $it->getId() eq $se->getTheme()->getId()} selected="selected" {/if} value="{$it->getId()}">{$it->getName()}</option>
                {/foreach}
            </select>
        </div>
    </div>

    <div class="form-group">
        <label class="col-sm-2 control-label"  for="nbNouveauteParAgence">Nouveautés par agence :</label>
        <div class="col-sm-8">
            <select name="nbNouveauteParAgence" id="nbNouveauteParAgence" class="form-control">
                <option {if $se->getNbNouveauteParAgence() eq 2} selected="selected" {/if} value="2">2</option>
                <option {if $se->getNbNouveauteParAgence() eq 4} selected="selected" {/if} value="4">4</option>
                <option {if $se->getNbNouveauteParAgence() eq 6} selected="selected" {/if} value="6">6</option>
            </select>
        </div>
    </div>

    <div class="form-group">
        <label class="col-sm-2 control-label"  for="nbAnnonceParPage">Annonces par page : </label>
        <div class="col-sm-8">
            <select name="nbAnnonceParPage" id="nbAnnonceParPage" class="form-control">

                {section name=foo start=1 loop=101}
                    <option {if $smarty.section.foo.index eq $se->getNbAnnoncesParPage()} selected="selected"{/if} value="{$smarty.section.foo.index}">{$smarty.section.foo.index}</option>
                {/section}
            </select>
        </div>
    </div>


    {if $se->getHeader()}
        <div class="form-group">
            {* /var/www/aptana/extra-immo/images/modules/export_site/images *}
            <div class="col-sm-offset-2 col-sm-10">
                <img src="{Constant::DEFAULT_URL_PICTURE_DIRECTORY}modules/{$smarty.get.module}/images/{$se->getHeader()}" alt="" class="img-thumbnail" />
            </div>
        </div>
    {/if}

    <div class="form-group">
        <label class="col-sm-2 control-label"  for="header">Entête (jpg) :</label>
        <div class="col-sm-8">
            <input type="file" name="header" id="header" />
        </div>
    </div>


    {if $se->getLogo()}
        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
                <p ><img src="{Constant::DEFAULT_URL_PICTURE_DIRECTORY}modules/{$smarty.get.module}/images/{$se->getLogo()}" alt="" class="img-thumbnail"/></p>
            </div>
        </div>
    {/if}
    <div class="form-group">
        <label class="col-sm-2 control-label"  for="logo">Logo (png) :</label>
        <div class="col-sm-8">
            <input type="file" name="logo" id="logo" />
        </div>
    </div>



    {*

                <h2>Page d'accueil</h2>
                    <p><label class="col-sm-2 control-label"  for="titreAccueil">Titre  :</label> <input type="text"
            name="titreAccueil" id="titreAccueil" value="{$se->getTitreAccueil()}" />
        </p>
        <p><label class="col-sm-2 control-label"  for="metaDescriptionAccueil">Description : </label><textarea name="metaDescriptionAccueil" id="metaDescriptionAccueil" cols="30" rows="10">{$se->getMetaDescriptionAccueil()}</textarea></p>
        <p><label class="col-sm-2 control-label"  for="txtAccueil">Texte :</label></p>
        <p class="clear"><textarea class="editor" name="txtAccueil" id="txtAccueil" cols="30" rows="10">{$se->getTxtIndex()}</textarea></p>
        *}
    <div class="form-group">
        <div class="col-sm-offset-2 col-sm-10">
            <button type="submit" name="send" value="Valider" class="btn btn-success">
                <i class="fa-save fa"></i> Sauvegarder
            </button>
        </div>
    </div>
</form>
</div>

