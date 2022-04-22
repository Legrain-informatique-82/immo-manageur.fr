{include file="tpl_default/entete.tpl"}
<div class="row bg-success bannerTitle">
    <div class="col-md-6">
        <h1 class="h2">{Lang::LABEL_SELLER_DELETE_h1}</h1>
    </div>
</div>
{if $error}
    <div class="alert alert-danger">
        <p >{$error}</p>
    </div>
{/if}
<p>{Lang::LABEL_SELLER_DELETE_INFO} {$seller->getFirstname()} {$seller->getName()} ?</p>
<form action="" method="post" role="form" class="form-horizontal">

	<input type="hidden" name="id_seller" value="{$seller->getIdSeller()}"  />
	<button type="submit" name="send_seller" value="{Lang::LABEL_DELETE}"  class="btn btn-danger">
        <i class="fa fa-trash"></i> {Lang::LABEL_DELETE}
        </button>
	<button type="submit" name="cancel_seller" value="{Lang::LABEL_CANCEL}" class="btn btn-default" >
        <i class="fa fa-close"></i> {Lang::LABEL_CANCEL}
        </button>
</form>
</div>
