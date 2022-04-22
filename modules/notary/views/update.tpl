{include file="tpl_default/entete.tpl"}
<form action="" method="post" role="form" class="form-horizontal">
    <div class="row bg-success bannerTitle">
        <div class="col-md-6">
            <h1 class="h2"> {Lang::LABEL_NOTARY_UPDATE_H1}</h1>
        </div>

        <div class="col-md-6">
            <p class="h4 text-right ">

                <button type="submit" name="notary_update_submit" value="{Lang::LABEL_SAVE}" class="btn btn-warning">
                    <i class="fa fa-save fa-2x"></i>
                </button>

                <a title="Annuler et fermer" class="btn btn-default" href="{Tools::create_url($user,"notary","list")}">
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
        </div>{/if}



    <div class="form-group">
        <label class="col-sm-2 control-label" for="notary_update_name">{Lang::LABEL_NOTARY_ADD_NAME}</label>
        <div class="col-sm-8">
            <input class="form-control" type="text" name="notary_update_name" value="{$notary_update_name}" id="notary_update_name" />
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-2 control-label" for="notary_update_firstname">{Lang::LABEL_NOTARY_ADD_FISTNAME}</label>
        <div class="col-sm-8">
            <input class="form-control" type="text" name="notary_update_firstname" value="{$notary_update_firstname}" id="notary_update_firstname" />
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-2 control-label" for="notary_update_address">{Lang::LABEL_NOTARY_ADD_ADDRESS}</label>
        <div class="col-sm-8">
            <input  class="form-control" type="text" name="notary_update_address" value="{$notary_update_address}" id="notary_update_address" />
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-2 control-label" for="notary_update_zip_code">{Lang::LABEL_NOTARY_ADD_ZIP_CODE}</label>
        <div class="col-sm-8">
            <input class="form-control" type="text" name="notary_update_zip_code" value="{$notary_update_zip_code}" id="notary_update_zip_code" />
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-2 control-label" for="notary_update_city">{Lang::LABEL_NOTARY_ADD_CITY}</label>
        <div class="col-sm-8">
            <input class="form-control"  type="text" name="notary_update_city" value="{$notary_update_city}" id="notary_update_city" />
        </div>
    </div>

    <div class="form-group">
        <label class="col-sm-2 control-label" for="notary_update_phone">{Lang::LABEL_NOTARY_ADD_PHONE}</label>
        <div class="col-sm-8">
            <input  class="form-control" type="text" name="notary_update_phone" value="{$notary_update_phone}" id="notary_update_phone" />
        </div>

    </div>
    <div class="form-group">
        <label class="col-sm-2 control-label" for="notary_update_mobil_phone">{Lang::LABEL_NOTARY_ADD_MOBIL_PHONE}</label>
        <div class="col-sm-8">
            <input class="form-control" type="text" name="notary_update_mobil_phone" value="{$notary_update_mobil_phone}" id="notary_update_mobil_phone" />
        </div>

    </div>
    <div class="form-group">
        <label class="col-sm-2 control-label" for="notary_update_job_phone">{Lang::LABEL_NOTARY_ADD_JOB_PHONE}</label>
        <div class="col-sm-8">
            <input class="form-control" type="text" name="notary_update_job_phone" value="{$notary_update_job_phone}" id="notary_update_job_phone" />
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-2 control-label" for="notary_update_fax">{Lang::LABEL_NOTARY_ADD_FAX}</label>
        <div class="col-sm-8">
            <input class="form-control" type="text" name="notary_update_fax" value="{$notary_update_fax}" id="notary_update_fax" />
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-2 control-label" for="notary_update_mail">{Lang::LABEL_NOTARY_ADD_MAIL}</label>
        <div class="col-sm-8">
            <input class="form-control" type="text" name="notary_update_mail" value="{$notary_update_mail}" id="notary_update_mail" />
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-2 control-label" for="notary_update_comments">
            {Lang::LABEL_NOTARY_ADD_COMMENTS}</label>
        <div class="col-sm-8">
            <textarea  class="form-control" cols="30" rows="10" name="notary_update_comments" id="notary_update_comments">{$notary_update_comments}</textarea>
        </div>

    </div>
    <div class="form-group">
        <div class="col-sm-offset-2 col-sm-10">
            <button type="submit" name="notary_update_submit" value="{Lang::LABEL_SAVE}" class="btn btn-warning">
                <i class="fa fa-save"></i> Mettre à jour
            </button>

            <a title="Annuler et fermer" class="btn btn-default" href="{Tools::create_url($user,"notary","list")}">
                <i class="fa fa-close"></i> Annuler et fermer
            </a>

        </div>
    </div>


</form>
</div>
</div>
