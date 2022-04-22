{include file="tpl_default/entete.tpl"}
<div class="row bg-success bannerTitle">
    <div class="col-md-12">
        <h1 class="h2">{LANG::LABEL_SECTOR_ADD}</h1>
    </div>

</div>
{if $error}

    <div class="alert alert-danger" role="alert">
        {$error}
    </div>
{/if}


<form action="" method="post" role="form" class="form-horizontal">

    <div class="form-group">
        <label for="sector_name" class="col-sm-2 control-label">{Lang::LABEL_SECTOR_NAME}</label>
        <div class="col-sm-8">
            <input class="form-control" type="text" value="{$smarty.post.sector_name}" name="sector_name" id="sector_name" />
        </div>
    </div>
    <div class="form-group">
        <div class="col-sm-offset-2 col-sm-10">
            <input class="btn btn-default" type="submit" name="send_sector" value="{Lang::LABEL_SECTOR_ADD_SENT}" />
        </div>
    </div>
</form>
</div>
