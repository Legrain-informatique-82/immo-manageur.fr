{include file="tpl_default/entete.tpl"}
<div class="row bg-success bannerTitle">
    <div class="col-md-12">
        <h1 class="h2">{LANG::LABEL_CITY_UPDATE}</h1>
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
        <p class="col-sm-2 control-label">Ancien nom : {$oldCity}</p>
    </div>
    <div class="form-group">

        <label  class="col-sm-2 control-label" for="city_name">{Lang::LABEL_SECTOR_NAME}</label>
        <div class="col-sm-8">
            <input class="form-control" type="text" value="{$city_name}" name="city_name" id="city_name" />
        </div>
    </div>
    <div class="form-group">

        <label class="col-sm-2 control-label" for="zipCode">{Lang::LABEL_CITY_ADD_ZIP_CODE}</label>
        <div class="col-sm-8">
            <input class="form-control" type="text" value="{$zipCode}" name="zipCode" id="zipCode" />
        </div>
    </div>
    <div class="form-group">

        <label class="col-sm-2 control-label" for="idSector">{Lang::LABEL_CITY_ADD_SECTOR} </label>
        <div class="col-sm-8">
            <select class="form-control" name="idSector" id="idSector">
                {foreach from=$listOfSector item=sector}
                    <option {if $sector->getIdSector() eq $idSector}selected="selected"{/if} value="{$sector->getIdSector()}">{$sector->getName()}</option>
                {/foreach}
            </select>
        </div>
    </div>
    <div class="form-group">
        <div class="col-sm-offset-2 col-sm-10">
            <input type="hidden" name="oldSector" value="{$oldSector}" />
            <input type="hidden" name="oldCity" value="{$oldCity}" />
            <input type="hidden" name="id_city" value="{$id_city}" />
            <input class="btn btn-default" type="submit" name="send_city" value="{Lang::LABEL_UPDATE}" />
            <input class="btn btn-default" type="submit" name="city_cancel" value="{Lang::LABEL_CANCEL}" />
        </div>
    </div>
</form>

</div>