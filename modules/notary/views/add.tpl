{include file="tpl_default/entete.tpl"}

<form action="" method="post" role="form" class="form-horizontal">
<div class="row bg-success bannerTitle">
    <div class="col-md-6">
        <h1 class="h2"> {Lang::LABEL_NOTARY_ADD_H1}</h1>
    </div>
    <div class="col-md-6">
        <p class="h4 text-right ">
            <button type="submit" class="btn btn-success" name="notary_add_submit">
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
    </div>
{/if}




    <div class="form-group">
			<label class="col-sm-2 control-label" for="notary_add_name">{Lang::LABEL_NOTARY_ADD_NAME}</label>
        <div class="col-sm-8">
                <input class="form-control" type="text" name="notary_add_name" value="{$smarty.post.notary_add_name}" id="notary_add_name" />
        </div>
		</div>
        <div class="form-group">
			<label  class="col-sm-2 control-label" for="notary_add_firstname">{Lang::LABEL_NOTARY_ADD_FISTNAME}</label>
            <div class="col-sm-8">
                <input class="form-control" type="text" name="notary_add_firstname" value="{$smarty.post.notary_add_firstname}" id="notary_add_firstname" />
            </div>
		</div>
            <div class="form-group">
			<label class="col-sm-2 control-label"  for="notary_add_address">{Lang::LABEL_NOTARY_ADD_ADDRESS}</label>
                <div class="col-sm-8">
                <input class="form-control" type="text" name="notary_add_address" value="{$smarty.post.notary_add_address}" id="notary_add_address" />
                    </div>
		</div>
                <div class="form-group">
			<label  class="col-sm-2 control-label" for="notary_add_zip_code">{Lang::LABEL_NOTARY_ADD_ZIP_CODE}</label>
                    <div class="col-sm-8">
                    <input class="form-control" type="text" name="notary_add_zip_code" value="{$smarty.post.notary_add_zip_code}" id="notary_add_zip_code" />
                        </div>
			
		</div>
                    <div class="form-group">
			<label class="col-sm-2 control-label"  for="notary_add_city">{Lang::LABEL_NOTARY_ADD_CITY}</label>
                        <div class="col-sm-8">
                        <input class="form-control" type="text" name="notary_add_city" value="{$smarty.post.notary_add_city}" id="notary_add_city" />
                            </div>
		</div>

         <div class="form-group">
			<label class="col-sm-2 control-label"  for="notary_add_phone">{Lang::LABEL_NOTARY_ADD_PHONE}</label>
             <div class="col-sm-8">
             <input class="form-control" type="text" name="notary_add_phone" value="{$smarty.post.notary_add_phone}" id="notary_add_phone" />
                 </div>
		</div>
             <div class="form-group">
			<label class="col-sm-2 control-label"  for="notary_add_mobil_phone">{Lang::LABEL_NOTARY_ADD_MOBIL_PHONE}</label>
                 <div class="col-sm-8">
                 <input class="form-control" type="text" name="notary_add_mobil_phone" value="{$smarty.post.notary_add_mobil_phone}" id="notary_add_mobil_phone" />
                     </div>
		</div>
                 <div class="form-group">
			<label class="col-sm-2 control-label"  for="notary_add_job_phone">{Lang::LABEL_NOTARY_ADD_JOB_PHONE}</label>
                     <div class="col-sm-8">
                     <input class="form-control" type="text" name="notary_add_job_phone" value="{$smarty.post.notary_add_job_phone}" id="notary_add_job_phone" />
                         </div>
		</div>
                     <div class="form-group">
			<label class="col-sm-2 control-label"  for="notary_add_fax">{Lang::LABEL_NOTARY_ADD_FAX}</label>
                         <div class="col-sm-8">
                         <input class="form-control" type="text" name="notary_add_fax" value="{$smarty.post.notary_add_fax}" id="notary_add_fax" />
                             </div>
		</div>
                         <div class="form-group">
			<label class="col-sm-2 control-label"  for="notary_add_mail">{Lang::LABEL_NOTARY_ADD_MAIL}</label>
                             <div class="col-sm-8">
                             <input class="form-control" type="text" name="notary_add_mail" value="{$smarty.post.notary_add_mail}" id="notary_add_mail" />
                                 </div>
		</div>
         <div class="form-group">
			<label class="col-sm-2 control-label"  for="notary_add_comments"> {Lang::LABEL_NOTARY_ADD_COMMENTS}</label>
             <div class="col-sm-8">
                <textarea class="form-control" cols="30" rows="10" name="notary_add_comments" id="notary_add_comments">{$smarty.post.notary_add_comments}</textarea>
             </div>
			
		</div>
    <div class="form-group">
        <div class="col-sm-offset-2 col-sm-8">
			<input type="submit" name="notary_add_submit" value="{Lang::LABEL_SAVE}" class="btn btn-default">
	</div>
</div>
</form>

</div>