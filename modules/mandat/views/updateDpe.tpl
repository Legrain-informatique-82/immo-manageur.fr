{include file="tpl_default/entete.tpl"}
<form action="" method="post" role="form" class="form-horizontal">
<div class="row bg-success bannerTitle">
    <div class="col-md-6">
        <h1 class="h2">Modification des infos. DPE</h1>
    </div>
    <div class="col-md-6">
        <p class="h4 text-right ">

            <button type="submit" name="valid" value="Valider" class="btn btn-warning" title="Mettre à jour">
                <i class="fa fa-save fa-2x"></i>
            </button>
            <button type="submit" name="cancel" value="Annuler" class="btn btn-default" title="Annuler">
                <i class="fa fa-close fa-2x"></i>
            </button>
    </div>
</div>
{if $error} {foreach from=$error item=item name=e} {if
$smarty.foreach.e.first}
    <div class="alert alert-danger" role="alert">
    <ul>
{/if}
    <li class="error">{$item}</li>
    {if $smarty.foreach.e.last}
        </ul>
    {/if} {/foreach}
    </div>
{/if}



    <div class="form-group">
		<label class="col-sm-2 control-label" for="dpeConsoEner">Consommation energétique : </label>
        <div class="col-sm-8">
            <input type="text" value="{$dpeConsoEner}" name="dpeConsoEner" id="dpeConsoEner" class="form-control"/>
	    </div>
    </div>
    <div class="form-group">
		<label class="col-sm-2 control-label" for="dpeEmissionGaz">Emission de gaz : </label>
        <div class="col-sm-8">
            <input type="text" value="{$dpeEmissionGaz}" name="dpeEmissionGaz" id="dpeEmissionGaz" class="form-control"/>
        </div>
	</div>
    <div class="form-group">
        <div class="col-sm-offset-2 col-sm-8">
            <button type="submit" name="valid" value="Valider" class="btn btn-warning">
                <i class="fa fa-save"></i> Mettre à jour
            </button>
            <button type="submit" name="cancel" value="Annuler" class="btn btn-default">
                <i class="fa fa-close"></i> Annuler
            </button>
        </div>
    </div>
</form>
</div>
