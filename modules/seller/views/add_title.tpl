{include file="tpl_default/entete.tpl"}
<form action="" method="post"  role="form" class="form-horizontal">
<div class="row bg-success bannerTitle">
    <div class="col-md-6">
        <h1 class="h2">{lang::LABEL_SELLER_ADD_TITLE_h1}</h1>
    </div>
    <div class="col-md-6">
        <p class="h4 text-right ">
            <button type="submit" class="btn btn-success" name="seller_add_title_submit">
                <i class="fa fa-save fa-2x"></i>
            </button>
            <a title="annuler et fermer" class="btn btn-default" href="{Tools::create_url($user,"seller","list")}">
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
        <label class="col-sm-2 control-label" for="seller_add_title_name">{lang::LABEL_SELLER_ADD_TITLE_NAME}</label>
        <div class="col-sm-8">
        <input class="form-control" type="text" name="seller_add_title_name" id="seller_add_title_name">
            </div>

    </div>
    <div class="form-group">
        <div class="col-sm-offset-2 col-sm-8">
        <button class="btn btn-success" type="submit" name="seller_add_title_submit" value="{lang::LABEL_SAVE}">
            <i class="fa fa-save"></i> {lang::LABEL_SAVE}
        </button>
            <a class="btn btn-default" href="{Tools::create_url($user,"seller","list")}">
                <i class="fa fa-close"></i> Annuler et fermer
            </a>
            </div>
    </div>
</form>
</div>
