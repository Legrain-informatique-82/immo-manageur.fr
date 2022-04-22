{include file="tpl_default/entete.tpl"}
<form action="" method="post" role="form" class="form-horizontal">
    <div class="row bg-success bannerTitle">
        <div class="col-md-6">
            <h1 class="h2"> {Lang::LABEL_NOTARY_DELETE_H1}</h1>
        </div>
        <div class="col-md-6">
            <p class="h4 text-right ">

                <button type="submit" name="send_notary" value="{Lang::LABEL_DELETE}" class="btn btn-danger" title="{Lang::LABEL_DELETE}">
                    <i class="fa fa-trash fa-2x"></i>
                </button>
                <button type="submit" name="cancel_notary" value="{Lang::LABEL_CANCEL}" class="btn btn-default" title="{Lang::LABEL_CANCEL}">
                    <i class="fa fa-close fa-2x"></i>
                </button>

            </p>
        </div>
    </div>

    {if $error}
        <div class="alert alert-danger" role="alert">
            <p class="error">{$error}</p>
        </div>
    {/if}
    <div class="col-sm-offset-2 col-sm-8">
        <p>{Lang::LABEL_NOTARY_DELETE_INFO}{$notary->getName()} ?</p>

        <input type="hidden" name="id_sector" value="{$notary->getIdNotary()}" />
        <button type="submit" name="send_notary" value="{Lang::LABEL_DELETE}" class="btn btn-danger">
            <i class="fa fa-trash"></i> {Lang::LABEL_DELETE}
        </button>
        <button type="submit" name="cancel_notary" value="{Lang::LABEL_CANCEL}" class="btn btn-default">
            <i class="fa fa-close"></i> {Lang::LABEL_CANCEL}
        </button>
    </div>
</form>
</div>
