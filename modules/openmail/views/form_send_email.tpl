<form action="" method="post" class="frmFileUpload form-horizontal" {if $idForm}id="{$idForm}"{/if}>
    <input name="token" type="hidden" value="{$token}"/>
    <div class="row bg-success bannerTitle">
        <div class="col-md-6">
            <h1 class="h2"> Envoyer un e-mail</h1>
        </div>
        <div class="col-md-6">
            <p class="h4 text-right ">

                <button id="submitSendEmail2" type="submit" value="Envoyer" name="send" class="btn btn-success" title="Envoyer par e-mail">
                    <i class="fa fa-paper-plane fa-2x"></i>
                </button>


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
                    <option {if $expediteur eq $s->id} selected="selected" {/if} value="{$s->id}">{$s->name} &lt;{$s->addressReplyTo}&gt;</option>
                {/foreach}
            </select>
            <input name="listSendersSerialize" value="{str_replace('"',"%22",serialize($listSenders))}" type="hidden"/>
        </div>
    </div>

    <div class="form-group">
        <label class="col-sm-3 control-label" for="name">Nom de l'envoi ( facultatif) : </label>
        <div class="col-sm-8" >
            <input type="text" class="form-control" name="name" id="name" value="{$name}"/>
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
            <input type="text" class="form-control" value="{$dest}" name="dest" id="dest"/>
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-3 control-label" for="subject">Sujet : </label>
        <div class="col-sm-8">
            <input type="text" value="{$subject}" name="subject" id="subject" class="form-control"/>
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-3 control-label" for="message">Message : </label>
        <div class="col-sm-8">
            <textarea class="editor" name="message" id="message" cols="30" rows="10">{$message}</textarea>
        </div>
    </div>
    <div class="col-sm-offset-3 col-sm-8">
        <div id="pj">
            <h2>Pièce(s) jointe(s) : </h2>
            {if $pjs}
                {$totalfilesize=0}
                {foreach $pjs as $key => $pj}
                    {$totalfilesize=$pj['filesize']+$totalfilesize}

                    <div class="well" >
                        <div class="row">
                            <div class="col-md-6">
                                <a href="{Constant::DEFAULT_URL}/modules/openmail/script/downloadpj.php?index={$key}&amp;token={$token}" target="_blank">  {$pj['filename']}</a>
                            </div>

                            <div class="col-md-6 text-right">
                                {Tools::format_bytes(  $pj['filesize'])}

                            <input {if in_array($key,$delpj )} checked="checked" {/if}  type="checkbox" name="delpj[]" id="delpj_{$key}" value="{$key}"/>
                            <label for="delpj_{$key}"> <img src="{Constant::DEFAULT_URL}/images/trash.png" alt="Supprimer la pièce jointe"/></label>

                            </div>
                        </div>
                    </div>
                {/foreach}
                <div id="piedPagePj" class="row">
                    <div class="col-md-6">
                        <p>Poids total des pièces jointes : {Tools::format_bytes($totalfilesize)} </p>
                    </div>
                    <div class="col-md-6 text-right">
                        <button id="submitDeleteSendEmail" type="submit" name="submitDelPj" value="Supprimer les pièces jointes sélectionnées" class="btn btn-danger">
                            <i class="fa fa-trash"></i> Supprimer les pièces jointes sélectionnées
                        </button>
                    </div>

                </div>
            {else}
                <p>Aucune pièce jointe</p>
            {/if}
        </div>


        <div id="uploader" data-btn="{$urlBtns}" data-script="{$urlScriptUpload}" data-token="{$token}">
            <p>Votre navigateur ne gère ni Flash ni Silverlight ni HTML5 ou n'a pas javascript d'activé</p>
            <p>Pour pouvoir envoyer des pièces jointes, vous devez utiliser un navigateur plus moderne comme : </p>
            <ul>
                <li>La dernière version d'Internet Explorer</li>
                <li>Firefox</li>
                <li>Chrome</li>
                <li>Opéra</li>
                <li>Safari</li>

            </ul>
        </div>
    </div>
    <div class="form-group">
        <div class="col-sm-offset-3 col-sm-8">
            <button type="submit" value="Envoyer" name="send" id="submitSendEmail" class="btn btn-success">
                <i class="fa fa-paper-plane"></i> Envoyer par e-mail
            </button>
        </div>
    </div>
</form>