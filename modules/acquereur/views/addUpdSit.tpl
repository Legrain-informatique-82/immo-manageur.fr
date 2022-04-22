{include file="tpl_default/entete.tpl"}
<form action="" method="post" role="form" class="form-horizontal">
    <div class="row bg-success bannerTitle">
        <div class="col-md-6">
            <h1 class="h2">{$title}</h1>
        </div>

        <div class="col-md-6">
            <p class="h4 text-right ">
                <button type="submit" class="btn {if $add}btn-success{else}btn-warning{/if}" name="go" title="Enregistrer">
                    <i class="fa fa-save fa-2x"></i>
                </button>
                <button type="submit" class="btn btn-default" name="cancel" title="Annuler et fermer">
                    <i class="fa fa-close fa-2x"></i>
                </button>
        </div>
    </div>
    {include file="tpl_default/error.tpl"}


    <div class="form-group">
        <label class="col-sm-2 control-label" for="name">Situation : </label>
        <div class="col-sm-8">
            <input type="text" class="form-control" name="name" id="name" value="{$obj.name}" />
        </div>
    </div>
    <div class="form-group">
        <div class="col-sm-offset-2 col-sm-8">
            <p class="help-block">Nécessite une date :</p>

            <label for="eventDateTrue"  class="radio-inline">
                <input type="radio" name="eventDate" id="eventDateTrue" value="1"  {if $obj.eventDate eq 1} checked="checked"{/if} />
                Oui
            </label>
            <label for="eventDateFalse"  class="radio-inline">
                <input type="radio" name="eventDate" id="eventDateFalse" value="0"  {if $obj.eventDate eq 0} checked="checked"{/if} />
                Non
            </label>
        </div>
    </div>
    <div class="form-group">
        <div class="col-sm-offset-2 col-sm-8">
            <p class="help-block">Nécessite un lieu :</p>
            <label for="eventLocationTrue"  class="radio-inline">
                <input type="radio" name="eventLocation" id="eventLocationTrue" value="1"  {if $obj.eventLocation eq 1} checked="checked"{/if} />
                Oui
            </label>

            <label for="eventLocationFalse" class="radio-inline" >
                <input type="radio" name="eventLocation" id="eventLocationFalse" value="0" {if $obj.eventLocation eq 0} checked="checked"{/if} />
                Non
            </label>
        </div>
    </div>

    <div class="form-group">
        <div class="col-sm-offset-2 col-sm-8">
            <button type="submit" name="go" value="Envoyer" class="btn {if $add}btn-success{else}btn-warning{/if}" >
                <i class="fa fa-save"></i> Enregistrer
            </button>
            <button type="submit" name="cancel" value="Annuler" class="btn btn-default">
                <i class="fa fa-close"></i> Annuler
            </button>
        </div>
    </div>
</form>

</div>
