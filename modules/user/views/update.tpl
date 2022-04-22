{include file="tpl_default/entete.tpl"}
<form action="" method="post" role="form" class="form-horizontal">
<div class="row bg-success bannerTitle">
    <div class="col-md-6">
        <h1 class="h2"> Modifier un utilisateur</h1>
    </div>
    <div class="col-md-6">
        <p class="h4 text-right ">
            <button type="submit" value="{Lang::LABEL_USER_UPDATE_SUBMIT}" id="user_update_submit2" name="user_update_submit" class="btn btn-warning">
                <i class="fa fa-save fa-2x"></i>
            </button>
            <a class="btn btn-default" href="{Tools::create_url($user,'user','list')}">
                <i class="fa fa-close fa-2x"></i>
            </a>
        </p>
    </div>

</div>

{include file="tpl_default/error.tpl"}


    <fieldset>
        <legend>Identifiants :</legend>
        {if $user->getLevelMember()->getIdLevelMember() eq 1}
            <div class="form-group">
                <label class="col-sm-2 control-label" for="user_update_identifiant">{Lang::LABEL_USER_ADD_IDENTIFIANT}</label>
                <div class="col-sm-8">
                    <input class="form-control" type="text" name="user_update_identifiant" id="user_update_identifiant" value="{$user_update_identifiant}" />
                    <input type="hidden" name="user_update_old_identifiant" id="user_update_old_identifiant" value="{$user_update_old_identifiant}" />
                </div>
            </div>
        {else}
            <div class="form-group">
                {Lang::LABEL_USER_ADD_IDENTIFIANT}{$user_update_identifiant}
                <input type="hidden" name="user_update_identifiant"  value="{$user_update_identifiant}" />
                <input type="hidden" name="user_update_old_identifiant" id="user_update_old_identifiant" value="{$user_update_old_identifiant}" />
            </div>
        {/if}
        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
                <p class="help-block">{Lang::LABEL_EDITO_PASSWORD}</p>
            </div>
            <label class="col-sm-2 control-label" for="user_update_password">{Lang::LABEL_USER_ADD_PASSWORD} </label>
            <div class="col-sm-8">
                <input class="form-control" type="password" name="user_update_password" id="user_update_password" value="{$user_update_password}" />
            </div>
        </div>

        <div class="form-group">

            <label class="col-sm-2 control-label" for="user_update_confirm_password">{Lang::LABEL_USER_ADD_CONFIRM_PASSWORD}</label>
            <div class="col-sm-8">
                <input class="form-control" type="password" name="user_update_confirm_password" id="user_update_confirm_password" value="{$user_update_confirm_password}" />
            </div>
        </div>
    </fieldset>
    <fieldset>
        <legend>Général :</legend>
        <div class="form-group">
            <label class="col-sm-2 control-label" for ="user_update_name">{Lang::LABEL_USER_ADD_NAME}</label>
            <div class="col-sm-8">
                <input class="form-control" type="text" name="user_update_name" id="user_update_name" value="{$user_update_name}" />
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label" for ="user_update_firstname">{Lang::LABEL_USER_ADD_FIRSTNAME}</label>
            <div class="col-sm-8">
                <input class="form-control" type="text" name="user_update_firstname" id="user_update_firstname" value="{$user_update_firstname}" />
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label" for ="user_update_email">{Lang::LABEL_USER_ADD_EMAIL}</label>
            <div class="col-sm-8">
                <input class="form-control" type="text" name="user_update_email" id="user_update_email" value="{$user_update_email}" />
            </div>
        </div>

        <div class="form-group">
            <label class="col-sm-2 control-label" for ="user_update_cellphone"> Téléphone portable : </label>
            <div class="col-sm-8">
                <input class="form-control" type="text" name="user_update_cellphone" id="user_update_cellphone" value="{$user_update_cellphone}"/>
            </div>
        </div>

        {if
        $user->getLevelMember()->getIdLevelMember() eq 1}
            <div class="form-group">
                <label class="col-sm-2 control-label" for ="user_update_agency"> {Lang::LABEL_USER_ADD_AGENCY_NAME}</label>
                <div class="col-sm-8">
                    <select class="form-control" name="user_update_agency" id="user_update_agency"> {foreach
                        from=$listOfAgency item="ag"}
                            <option {if $ag->getIdAgency() eq $user_update_agency}
                                selected="selected" {/if}
                                    value="{$ag->getIdAgency()}">{$ag->getName()}</option> {/foreach}
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label" for ="user_update_level"> {Lang::LABEL_USER_ADD_LEVEL}</label>
                <div class="col-sm-8">
                    <select class="form-control" name="user_update_level" id="user_update_level"> {foreach
                        from=$listOfLevel item="lv"}
                            <option {if $lv->getIdLevelMember() eq $user_update_level}
                                selected="selected" {/if}
                                    value="{$lv->getIdLevelMember()}">{$lv->getName()}</option>
                        {/foreach}
                    </select>
                </div>
            </div>
        {/if}
        <div class="form-group">
            <label class="col-sm-2 control-label" for ="theme">Thème : </label>
            <div class="col-sm-8">
                <select class="form-control" name="theme" id="theme">
                    {foreach from=$listOfThemes item=th}

                        <option {if $th eq $user_update_theme || ($user_update_theme eq '' && $th eq Constant::THEME)} selected="selected"{/if} value="{$th}">{$th}</option>
                    {/foreach}
                </select>
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label" for ="user_openInNewTab">Ouverture des pages dans de nouveaux onglets :</label>
            <div class="col-sm-8">
                <select name="user_openInNewTab" id="user_openInNewTab" class="form-control">
                    <option value="0" {if $user_openInNewTab eq 0} selected="selected"{/if}>Non</option>
                    <option value="1" {if $user_openInNewTab eq 1} selected="selected"{/if}>Oui</option>
                </select>
            </div>
        </div>

        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-8">

                <button type="submit" value="{Lang::LABEL_USER_UPDATE_SUBMIT}" id="user_update_submit" name="user_update_submit" class="btn btn-warning">
                    <i class="fa fa-save"></i> Mettre à jour
                </button>
                <a class="btn btn-default" href="{Tools::create_url($user,'user','list')}">
                    <i class="fa fa-close"></i> Annuler
                </a>
            </div>
        </div>
    </fieldset>


</form>
</div>

