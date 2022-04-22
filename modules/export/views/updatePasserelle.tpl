{include file='tpl_default/entete.tpl'}
<form action="" method="post" role="form" class="form-horizontal">

    <div class="row bg-success bannerTitle">
        <div class="col-md-6">
            <h1 class="h2">Modifier la passerelle</h1>
        </div>

        <div class="col-md-6">
            <p class="h4 text-right ">
                <button type="submit" name="send" value="Modifier" title="Modifier" class="btn btn-warning">
                    <i class="fa fa-save fa-2x"></i>
                </button>
                <button type="submit" name="cancel" value="Annuler" title="Annuler" class="btn btn-default">
                    <i class="fa fa-close fa-2x"></i>
                </button>

            </p>
        </div>
    </div>

    <div class="form-group">
        <label class="col-sm-2 control-label" for="name">Nom :</label>
        <div class="col-sm-8">
            <input type="text" class="form-control" name="name" id="name" value="{$name}" />
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-2 control-label"l for="type">Type d'export : </label>
        <div class="col-sm-8">
            <input type="text" class="form-control" name="type" id="type" value="{$type}" />
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-2 control-label" for="param">Paramètres : </label>
        <div class="col-sm-8">
            <textarea name="param" class="form-control" id="param" cols="30" rows="10">{$param}</textarea>
        </div>
    </div>
    <div class="form-group">
        <div class="col-sm-offset-2 col-sm-10">
            <div class="checkbox">
                <label for="asset">
                    <input type="checkbox" {if $asset eq 1} checked="checked" {/if} name="asset" id="asset" value="1" />
                    Active
                </label>
            </div>
        </div>
    </div>
    <div class="form-group">
        <div class="col-sm-offset-2 col-sm-10">
            <button type="submit" name="send" value="Modifier" class="btn btn-warning">
                <i class="fa fa-save"></i> Modifier
            </button>
            <button type="submit" name="cancel" value="Annuler" class="btn btn-default">
                <i class="fa fa-close"></i> Annuler
            </button>
        </div>
    </div>
</form>
</div>
