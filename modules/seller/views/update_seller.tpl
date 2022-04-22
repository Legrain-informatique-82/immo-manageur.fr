{include file="tpl_default/entete.tpl"}
<form action="" method="post"  role="form" class="form-horizontal">
    <div class="row bg-success bannerTitle">
        <div class="col-md-6">
            <h1 class="h2">Modifier le vendeur</h1>
        </div>

        <div class="col-md-6">
            <p class="h4 text-right ">


                <button type="submit" name="seller_update_submit_send" class="btn btn-warning">
                    <i class="fa fa-save fa-2x"></i>
                </button>
                <a title="annuler et fermer" class="btn btn-default" href="{Tools::create_url($user,"seller","lists")}">
                    <i class="fa fa-close fa-2x"></i>
                </a>
            </p>
        </div>
    </div>

    {if $error} {foreach from=$error item=item name=e} {if
    $smarty.foreach.e.first}
        <div class="alert alert-danger" role="alert">
        <ul>
    {/if}
        <li class="error">{$item}</li> {if $smarty.foreach.e.last}
            </ul>
        {/if} {/foreach}
        </div>
    {/if}
    <div id="blocSeller" class="bulle">


        {if $user->getLevelMember()->getIdLevelMember() <3}
            <div class="form-group">
                <label class="col-sm-2 control-label" for="seller_update_user"> Utilisateur : </label>
                <div class="col-sm-8">
                    <select class="form-control" name="seller_update_user" id="seller_update_user"> {foreach from=$listUser item=item}
                            <option {if ($item->getIdUser() eq $seller_update_user &&
                            !empty($seller_update_user)) ||( $user->getIdUser() eq
                            $item->getIdUser()&& empty($seller_update_user))}
                                    selected="selected"
                                    {/if}value="{$item->getIdUser()}">{$item->getFirstname()}
                                {$item->getName()}</option> {/foreach}

                    </select>
                </div>
            </div>
        {/if}
        <div class="form-group">
            <label class="col-sm-2 control-label" for="seller_update_list_title"> {Lang::LABEL_SELLER_ADD_TITLE}</label>
            <div class="col-sm-8">
                <select class="form-control" name="seller_update_list_title" id="seller_update_list_title">
                    {foreach from=$listTitle item=item}
                        <option {if $seller_update_list_title eq $item->getIdSellerTitle()}
                                selected="selected"
                                {/if}value="{$item->getIdSellerTitle()}">{$item->getLibel()}</option>
                    {/foreach}
                </select>
            </div>
        </div>

        <div class="form-group">
            <label class="col-sm-2 control-label" for="seller_update_name">{Lang::LABEL_SELLER_ADD_NAME}</label>
            <div class="col-sm-8">
                <input class="form-control" type="text" name="seller_update_name" value="{$seller_update_name}" id="seller_update_name" />
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label" for="seller_update_firstname">{Lang::LABEL_SELLER_ADD_FIRSTNAME}</label>
            <div class="col-sm-8">
                <input class="form-control" type="text" name="seller_update_firstname" value="{$seller_update_firstname}" id="seller_update_firstname" />
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label" for="seller_update_address">{Lang::LABEL_SELLER_ADD_ADDRESS}</label>
            <div class="col-sm-8">
                <input class="form-control" type="text" name="seller_update_address" value="{$seller_update_address}" id="seller_update_address" />
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label" for="seller_update_list_city"> {Lang::LABEL_SELLER_ADD_CITY}</label>
            <div class="col-sm-8">
                <select class="form-control" name="seller_update_list_city" id="seller_update_list_city"> {foreach
                    from=$listCity item=item}
                        <option {if $seller_update_list_city eq $item->getIdCity()}
                                selected="selected"
                                {/if}value="{$item->getIdCity()}">{$item->getZipCode()} -
                            {$item->getName()}</option> {/foreach}
                </select>
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label" for="seller_update_phone">{Lang::LABEL_SELLER_ADD_PHONE}</label>
            <div class="col-sm-8">
                <input class="form-control" type="text" name="seller_update_phone" value="{$seller_update_phone}" id="seller_update_phone" />
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label" for="seller_update_mobil_phone">{Lang::LABEL_SELLER_ADD_MOBIL_PHONE}</label>
            <div class="col-sm-8">
                <input class="form-control" type="text" name="seller_update_mobil_phone" value="{$seller_update_mobil_phone}" id="seller_update_mobil_phone" />
            </div>

        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label" for="seller_update_work_phone">{Lang::LABEL_SELLER_ADD_WORK_PHONE}</label>
            <div class="col-sm-8">
                <input class="form-control" type="text" name="seller_update_work_phone" value="{$seller_update_work_phone}" id="seller_update_work_phone" />
            </div>

        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label" for="seller_update_fax">{Lang::LABEL_SELLER_ADD_FAX}</label>
            <div class="col-sm-8">
                <input class="form-control" type="text" name="seller_update_fax" value="{$seller_update_fax}" id="seller_update_fax" />
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label" for="seller_update_email">{Lang::LABEL_SELLER_ADD_EMAIL}</label>
            <div class="col-sm-8">
                <input class="form-control" type="text" name="seller_update_email" value="{$seller_update_email}" id="seller_update_email" />
            </div>
        </div>
        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
                <div class="checkbox">
                    <label for="vitrine">
                        <input type="checkbox" name="vitrine" id="vitrine" value="1" {if $smarty.post.vitrine eq 1 or $vitrine eq 1} checked="checked" {/if}/>
                        Possède un compte client sur votre site vitrine.
                    </label>
                </div>
            </div>
        </div>

        <div class="form-group">
            <label class="col-sm-2 control-label" for="seller_update_comment">{Lang::LABEL_SELLER_ADD_COMMENT}</label>
            <div class="col-sm-8">
                <textarea  class="form-control" name="seller_update_comment" id="seller_update_comment" cols="30" rows="10">{$seller_update_comment}</textarea>
            </div>
        </div>

        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
                <button class="btn btn-warning" type="submit" value="{Lang::LABEL_SAVE}" id="seller_update_submit_send" name="seller_update_submit_send" >
                    <i class="fa fa-save"></i> Mettre à jour
                    </button>
                <a title="annuler et fermer" class="btn btn-default" href="{Tools::create_url($user,"seller","lists")}">
                    <i class="fa fa-close"></i> Annuler et fermer
                </a>
            </div>
        </div>

</form>
</div>
</div>
