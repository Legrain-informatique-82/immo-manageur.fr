{include file="tpl_default/entete.tpl"}
<form action="" method="post" class="form-horizontal" role="form">

    <div class="row bg-success bannerTitle">
        <div class="col-md-6">
            <h1 class="h2"> Ajouter un clerc au notaire {$notary->getFirstname()} {$notary->getName()}</h1>
        </div>
        <div class="col-md-6">

            <p class="h4 text-right">

                {*
                <button type="submit" class="btn btn-success" name="notary_add_submit">
                    <i class="fa fa-save fa-2x"></i>
                </button>
                <a title="Annuler et fermer" class="btn btn-default" href="{Tools::create_url($user,"notary","list")}">
                    <i class="fa fa-close fa-2x"></i>
                </a>
                *}
                <button type="submit" name="notary_add_submit" value="{Lang::LABEL_SAVE}" class="btn btn-success" title="{Lang::LABEL_SAVE}">
                    <i class="fa fa-save fa-2x"></i>
                </button>
                <button type="submit" name="cancel" value="Annuler" class="btn btn-default" title="Annuler">
                    <i class="fa fa-close fa-2x"></i>
                </button>
            </p>
        </div>
    </div>





    <fieldset>
        <div class="form-group">
            <label class="col-sm-2 control-label"  for="notary_add_name">Nom du clerc : </label>
            <div class="col-sm-8">
                <input type="text" class="form-control" name="notary_add_name" value="{$smarty.post.notary_add_name}" id="notary_add_name" />
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label"  for="notary_add_firstname">Prénom du clerc : </label>
            <div class="col-sm-8">
                <input type="text" class="form-control" name="notary_add_firstname" value="{$smarty.post.notary_add_firstname}" id="notary_add_firstname" />
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label"  for="notary_add_address">{Lang::LABEL_NOTARY_ADD_ADDRESS}</label>
            <div class="col-sm-8">
                <input type="text" class="form-control"  name="notary_add_address" value="{$smarty.post.notary_add_address}" id="notary_add_address" />
            </div>

        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label"  for="notary_add_zip_code">{Lang::LABEL_NOTARY_ADD_ZIP_CODE}</label>
            <div class="col-sm-8">
                <input type="text" class="form-control" name="notary_add_zip_code" value="{$smarty.post.notary_add_zip_code}" id="notary_add_zip_code" />
            </div>

        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label"  for="notary_add_city">{Lang::LABEL_NOTARY_ADD_CITY}</label>
            <div class="col-sm-8">
                <input type="text" class="form-control" name="notary_add_city" value="{$smarty.post.notary_add_city}" id="notary_add_city" />
            </div>
        </div>

        <div class="form-group">
            <label class="col-sm-2 control-label"  for="notary_add_phone">{Lang::LABEL_NOTARY_ADD_PHONE}</label>
            <div class="col-sm-8">
                <input type="text" class="form-control" name="notary_add_phone" value="{$smarty.post.notary_add_phone}" id="notary_add_phone" />
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label"  for="notary_add_mobil_phone">{Lang::LABEL_NOTARY_ADD_MOBIL_PHONE}</label>
            <div class="col-sm-8">
                <input type="text" class="form-control" name="notary_add_mobil_phone" value="{$smarty.post.notary_add_mobil_phone}" id="notary_add_mobil_phone" />
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label"  for="notary_add_job_phone">{Lang::LABEL_NOTARY_ADD_JOB_PHONE}</label>
            <div class="col-sm-8">
                <input type="text" class="form-control" name="notary_add_job_phone" value="{$smarty.post.notary_add_job_phone}" id="notary_add_job_phone" />
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label"  for="notary_add_fax">{Lang::LABEL_NOTARY_ADD_FAX}</label>
            <div class="col-sm-8">
                <input type="text" class="form-control" name="notary_add_fax" value="{$smarty.post.notary_add_fax}" id="notary_add_fax" />
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label"  for="notary_add_mail">{Lang::LABEL_NOTARY_ADD_MAIL}</label>
            <div class="col-sm-8">
                <input type="text" class="form-control" name="notary_add_mail" value="{$smarty.post.notary_add_mail}" id="notary_add_mail" />
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label"  for="notary_add_comments"> {Lang::LABEL_NOTARY_ADD_COMMENTS}</label>
            <div class="col-sm-8">
                <textarea cols="30" class="form-control" rows="10" name="notary_add_comments" id="notary_add_comments">{$smarty.post.notary_add_comments}</textarea>
            </div>

        </div>
        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-8">
                <button type="submit" name="notary_add_submit" value="{Lang::LABEL_SAVE}" class="btn btn-success">
                    <i class="fa fa-save"></i> {Lang::LABEL_SAVE}
                </button>
                <button type="submit" name="cancel" value="Annuler" class="btn btn-default">
                    <i class="fa fa-close"></i> Annuler
                </button>
            </div>
        </div>
    </fieldset>
</form>
</div>
