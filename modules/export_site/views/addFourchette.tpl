{include file="tpl_default/entete.tpl"}
<form action="" method="post" role="form" class="form-horizontal">
    <div class="row bg-success bannerTitle">
        <div class="col-md-6">
            <h1 class="h2">{$title}</h1>
        </div>
        <div class="col-md-6">
            <p class="h4 text-right ">

                <button type="submit" name="add" value="Valider" class="btn {if $add}btn-success{else}btn-warning{/if}" title="{if $add}Ajouter{else}Mettre à jour{/if}">
                    <i class="fa fa-save fa-2x"></i>
                </button>
                <button type="submit" name="cancel" value="Annuler" class="btn btn-default" title="Annuler et fermer">
                    <i class="fa fa-close fa-2x"></i>
                </button>

            </p>
        </div>
    </div>

    <div class="form-group">
    <label class="col-sm-2 control-label" for="tt">Type Transaction</label>
        <div class="col-sm-8">
        <select name="tt" id="tt" class="form-control">
{foreach from=$tt item="it"}
	<option value="{$it->getId()}" {if $vtt == $it->getId()} selected="selected" {/if}>{$it->getName()}</option>
{/foreach}
</select>
    </div>
    </div>
    <div class="form-group">
        <label class="col-sm-2 control-label" for="tb">Type Bien</label>
        <div class="col-sm-8">
        <select name="tb" id="tb" class="form-control">
{foreach from=$tb item="it"}
	<option value="{$it->getId()}" {if $vtb == $it->getId()} selected="selected" {/if}>{$it->getName()}</option>
{/foreach}
</select>
        </div>
        </div>

    <div class="form-group">
        <label class="col-sm-2 control-label" for="name">Nom : </label>
        <div class="col-sm-8">
        <input id="name" type="text" name="name" value="{$vname}"  class="form-control"/>
        </div>
        </div>
    <div class="form-group">
    <label class="col-sm-2 control-label" for="valMin">Valeur Mini : </label>
        <div class="col-sm-8">
        <input id="valMin" type="text" name="valMin" value="{$vvalmin}"  class="form-control" />
        </div>
        </div>
    <div class="form-group">
    <label class="col-sm-2 control-label" for="valMax">Valeur Maxi : </label>
        <div class="col-sm-8">
        <input id="valMax" type="text" name="valMax" value="{$vvalmax}"  class="form-control"/>
        </div>
        </div>

    <div class="form-group">
        <div class="col-sm-offset-2 col-sm-10">
        <button type="submit" name="add" value="Valider" class="btn {if $add}btn-success{else}btn-warning{/if}">
            <i class="fa fa-save"></i> {if $add}Ajouter{else}Mettre à jour{/if}
        </button>
        <button type="submit" name="cancel" value="Annuler" class="btn btn-default" >
            <i class="fa fa-close"></i> Annuler et fermer
        </button>
        </div>
        </div>
</form>
</div>
