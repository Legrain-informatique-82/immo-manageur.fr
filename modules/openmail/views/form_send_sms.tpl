
<form action="" method="post" {if $idForm}id="{$idForm}"{/if} class="form-horizontal">


    <div class="row bg-success bannerTitle">
        <div class="col-md-6">
            <h1 class="h2"> Envoyer un Sms</h1>
        </div>
        <div class="col-md-6">
            <p class="h4 text-right ">
                <button type="submit" value="Envoyer" name="send" class="btn btn-success changebtnPaperPlane" title="Envoyer par SMS">
                    <i class="fa fa-paper-plane fa-2x"></i>
                </button>
                {*

                {if $user->getLevelMember()->getIdLevelMember()<3 || $user->getIdUser() eq $rapprochement->getUser()->getIdUser()}

                    <a href="{$linkToUpdate}"  title="Modifier" class="btn btn-warning"> <i class="fa fa-pencil-square-o fa-2x"></i></a>

                    <a href="{$linkToDelete}" title="Supprimer" class="btn btn-danger"> <i class="fa fa-trash fa-2x"></i></a>

                {/if}

                <a title="{$labelRedirect}" class="btn btn-default" href="{$redirect}">
                    <i class="fa fa-close fa-2x"></i>
                </a>
*}
            </p>
        </div>
    </div>
<div id="seeError"></div>

    {include file="tpl_default/error.tpl"}
    <div class="form-group">
        <label class="col-sm-3 control-label" for="expediteur">Expéditeur : </label>
        <div class="col-sm-8">
            <select class="form-control" name="expediteur" id="expediteur">
                {foreach $listSenders as $s}
                    <option {if $expediteur eq $s} selected="selected" {/if} value="{$s}">{$s}</option>
                {/foreach}
            </select>
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-3 control-label" for="name">Nom de l'envoi ( facultatif) : </label>
        <div class="col-sm-8">
            <input class="form-control" type="text" name="name" id="name" value="{$name}"/>
        </div>
    </div>

    <div class="form-group">
        <label class="col-sm-3 control-label" for="date">Date de l'envoi ( laisser vide pour envoyer maintenant) : </label>
        <div class="col-sm-8">
            <input type="text" value="{$date}" class="dateTimepicker form-control" name="date" id="date"/>
        </div>
    </div>

    <div class="form-group">
        <label class="col-sm-3 control-label" for="dest">Destinataires ( format international séparés par des ;) : </label>
        <div class="col-sm-8">
            <input class="form-control" type="text" value="{$dest}" name="dest" id="dest"/>
        </div>
    </div>

    <div class="form-group">
        <label class="col-sm-3 control-label" for="message">Message : </label>
        <div class="col-sm-8">
            <textarea class="form-control" name="message" id="message" cols="30" rows="10">{$message}</textarea>
        </div>
    </div>
    <div class="form-group">
        <div class="col-sm-offset-3 col-sm-8">
            <button type="submit" value="Envoyer" name="send" class="btn btn-success changebtnPaperPlane">
                <i class="fa fa-paper-plane"></i> Envoyer par SMS
                </button>
        </div>
    </div>

</form>