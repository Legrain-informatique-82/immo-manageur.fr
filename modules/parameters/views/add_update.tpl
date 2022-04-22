{include file='tpl_default/entete.tpl'}
<div class="row bg-success bannerTitle">
    <div class="col-md-6">
        <h1 class="h2">{$h1}</h1>
    </div>
    <div class="col-md-6">

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

<div>
<form action="" method="post" role="form" class="form-horizontal">
	<div class="form-group">
		<input type="hidden" name="idOpt" value="{$idOpt}" />
        <input type="hidden" name="oldName" value="{$oldName}" />
        <input type="hidden" name="oldCode" value="{$oldCode}" />
        <label class="col-sm-2 control-label" for="name">{$labelName} :</label>
        <div class="col-sm-8">
        <input type="text" name="name" value="{$name}" id="name" class="form-control"/>
            </div>
	</div>
        <div class="form-group">
		<label class="col-sm-2 control-label" for="code">{$labelCode} :</label>
            <div class="col-sm-8">
        <input type="text" name="code" value="{$code}" id="code" class="form-control"/>
                </div>
	</div>
    <div class="form-group">
        <div class="col-sm-offset-2 col-sm-10">
            <div class="checkbox">
		<label for="isDisabled">
        <input type="checkbox"
			{if $isDisabled} checked="checked" {/if} name="isDisabled"
			id="isDisabled" value="1" />
            Actif
        </label>
                </div></div>
	</div>
            <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
		<input type="submit" name="valider" value="{Lang::LABEL_SAVE}" class="btn btn-default"/>
                    </div>
	</div>
</form>
</div>
</div>