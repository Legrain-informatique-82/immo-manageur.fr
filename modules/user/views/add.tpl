{include file="tpl_default/entete.tpl"}
<form action="" method="post" role="form" class="form-horizontal">
    <div class="row bg-success bannerTitle">
        <div class="col-md-6">
            <h1 class="h2"> Ajouter un utilisateur</h1>
        </div>

        <div class="col-md-6">
            <p class="h4 text-right ">

                <button type="submit" value="{Lang::LABEL_USER_ADD_SUBMIT}" id="user_add_submit" name="user_add_submit" class="btn btn-success" title="Enregistrer">
                    <i class="fa fa-save fa-2x"></i>
                </button>
                <a class="btn btn-default" href="{Tools::create_url($user,'user','list')}" title="Annuler et retourner à la fiste">
                    <i class="fa fa-close fa-2x"></i>
                </a>
            </p>
        </div>
    </div>

    {include file="tpl_default/error.tpl"}


    <fieldset>
        <legend>Identifiants :</legend>
        <div class="form-group">
            <label class="col-sm-2 control-label"  for="user_add_identifiant">{Lang::LABEL_USER_ADD_IDENTIFIANT}</label>
            <div class="col-sm-8">
                <input class="form-control" type="text" name="user_add_identifiant" id="user_add_identifiant" value="{$smarty.post.user_add_identifiant}" />
            </div>
        </div>
        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
                <p class="help-block">{Lang::LABEL_EDITO_PASSWORD}</p>
            </div>
            <label class="col-sm-2 control-label"  for="user_add_password">{Lang::LABEL_USER_ADD_PASSWORD}</label>
            <div class="col-sm-8">
                <input class="form-control" type="password" name="user_add_password" id="user_add_password" value="{$smarty.post.user_add_password}" />
            </div>
        </div>

        <div class="form-group">
            <label class="col-sm-2 control-label"  for="user_add_confirm_password">{Lang::LABEL_USER_ADD_CONFIRM_PASSWORD} </label>
            <div class="col-sm-8">
                <input class="form-control" type="password" name="user_add_confirm_password" id="user_add_confirm_password" value="{$smarty.post.user_add_confirm_password}" />
            </div>
        </div>
    </fieldset>
    <fieldset>
        <legend>Général :</legend>
        <div class="form-group">
            <label class="col-sm-2 control-label"  for="user_add_name">{Lang::LABEL_USER_ADD_NAME}</label>
            <div class="col-sm-8">
                <input class="form-control" type="text" name="user_add_name" id="user_add_name" value="{$smarty.post.user_add_name}" />
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label"  for="user_add_firstname">{Lang::LABEL_USER_ADD_FIRSTNAME} </label>
            <div class="col-sm-8">
                <input  class="form-control" type="text" name="user_add_firstname" id="user_add_firstname" value="{$smarty.post.user_add_firstname}" />
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label"  for="user_add_email">{Lang::LABEL_USER_ADD_EMAIL}</label>
            <div class="col-sm-8">
                <input  class="form-control" type="text" name="user_add_email" id="user_add_email" value="{$smarty.post.user_add_email}" />
            </div>
        </div>


        <div class="form-group">
            <label class="col-sm-2 control-label"  for="user_add_cellphone"> Téléphone portable : </label>
            <div class="col-sm-8">
                <input  class="form-control" type="text" name="user_add_cellphone" id="user_add_cellphone" value="{$user_add_cellphone}"/>
            </div>
        </div>

        <div class="form-group">
            <label class="col-sm-2 control-label"  for="user_add_agency"> {Lang::LABEL_USER_ADD_AGENCY_NAME} </label>
            <div class="col-sm-8">
                <select  class="form-control" name="user_add_agency" id="user_add_agency"> {foreach
                    from=$listOfAgency item="ag"}
                        <option {if $ag->getIdAgency() eq $smarty.post.user_add_agency}
                            selected="selected" {/if}
                                value="{$ag->getIdAgency()}">{$ag->getName()}</option> {/foreach}
                </select>
            </div>
        </div>




        <div class="form-group">
            <label class="col-sm-2 control-label"  for="user_add_level"> {Lang::LABEL_USER_ADD_LEVEL}</label>
            <div class="col-sm-8">
                <select  class="form-control" name="user_add_level" id="user_add_level"> {foreach
                    from=$listOfLevel item="lv"}
                        <option {if $lv->getIdLevelMember() eq
                        $smarty.post.user_add_level} selected="selected" {/if}
                                value="{$lv->getIdLevelMember()}">{$lv->getName()}</option>
                    {/foreach}
                </select>
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label"  for="theme">Thème : </label>
            <div class="col-sm-8">
                <select  class="form-control"  name="theme" id="theme">
                    {foreach from=$listOfThemes item=th}

                        <option {if $th eq $user_add_theme || ($user_add_theme eq '' && $th eq Constant::THEME)} selected="selected"{/if} value="{$th}">{$th}</option>
                    {/foreach}
                </select>
            </div>
        </div>

        <div class="form-group">
            <label class="col-sm-2 control-label"  for="user_openInNewTab">Ouverture des pages dans de nouveaux onglets :</label>
            <div class="col-sm-8">
                <select name="user_openInNewTab" id="user_openInNewTab"  class="form-control" >
                    <option value="0" {if $smarty.post.user_openInNewTab eq 0} selected="selected"{/if}>Non</option>
                    <option value="1" {if $smarty.post.user_openInNewTab eq 1} selected="selected"{/if}>Oui</option>
                </select>
            </div>
        </div>

        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-8">
                <button type="submit" value="{Lang::LABEL_USER_ADD_SUBMIT}" id="user_add_submit" name="user_add_submit" class="btn btn-success" >
                    <i class="fa fa-save"></i> Enregistrer
                </button>
                <a class="btn btn-default" href="{Tools::create_url($user,'user','list')}">
                    <i class="fa fa-close"></i> Annuler
                </a>
            </div>
        </div>
    </fieldset>


</form>
</div>


