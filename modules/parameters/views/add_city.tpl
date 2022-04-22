{include file="tpl_default/entete.tpl"}

<div class="row bg-success bannerTitle">
    <div class="col-md-12">
        <h1 class="h2">{LANG::LABEL_CITY_ADD}</h1>
    </div>

</div>
{if $error}
    <div class="alert alert-danger" role="alert">
        <ul>
            {foreach $error as $e}
                <li>{$e}</li>
            {/foreach}
        </ul>
    </div>
{/if}


<form action="" method="post" role="form" class="form-horizontal">
    <div class="form-group">
        <label class="col-sm-2 control-label" for="city_add_name">{Lang::LABEL_CITY_ADD_NAME} </label>
        <div class="col-sm-8">
            <input class="form-control" type="text" value="{$smarty.post.city_add_name}" name="city_add_name" id="city_add_name" />
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-2 control-label"for="zipCode">{Lang::LABEL_CITY_ADD_ZIP_CODE}</label>
        <div class="col-sm-8">
            <input class="form-control"  type="text" value="{$smarty.post.zipCode}" name="zipCode" id="zipCode" />
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-2 control-label"for="idSector">{Lang::LABEL_CITY_ADD_SECTOR}</label>
        <div class="col-sm-8">
            <select class="form-control"  name="idSector" id="idSector">
                {foreach from=$listOfSector item=sector}
                    <option {if $sector->getIdSector() eq $smarty.post.idSector}selected="selected"{/if} value="{$sector->getIdSector()}">{$sector->getName()}</option>
                {/foreach}
            </select>
        </div>
    </div>
    <div class="form-group">
        <div class="col-sm-offset-2 col-sm-10">
            <input class="btn btn-default" type="submit" value="{Lang::LABEL_SAVE}" name="sector_add_city_send" id="sector_add_city_send" />
            <input class="btn btn-default" type="submit" value="{Lang::LABEL_CANCEL}" name="sector_add_city_cancel" id="sector_add_city_cancel" />
        </div>
    </div>


</form>
</div>
