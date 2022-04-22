{include file="tpl_default/entete.tpl"}
<form action="" method="post" role="form" class="form-horizontal">
    <div class="row bg-success bannerTitle">
        <div class="col-md-6">
            <h1 class="h2">{$h1}</h1>
        </div>
        <div class="col-md-6">
            <p class="h4 text-right ">
                {*
                <a class="btn btn-success" href="{Tools::create_url($user,'documents','addDocument')}" title="Ajouter un document">
                    <i class="fa fa-plus-circle fa-2x"></i>
                </a>
    *}
            </p>
        </div>
    </div>
    {include file="tpl_default/viewsErrors.tpl"}


    {if $destinataires}
        <fieldset>
            <legend>Destinataires : </legend>
            <div class="form-group">
                <div class="col-sm-offset-2 col-sm-8">
                    <p class="help-block">
                        Sélectionner les destinataires pour lesquels vous souhaitez imprimer le document.
                    </p>
                    {foreach $destinataires as $dest}

                        <label class="checkbox-inline">
                            <input type="checkbox" name="destinataires[]" value="{$dest.id}" checked="checked"/>
                            {$dest.prenom} {$dest.nom}<br/>
                            {$dest.adresse}<br/>
                            {$dest.code_postal} {$dest.ville}
                        </label>

                    {/foreach}
                </div>
            </div>
        </fieldset>
    {/if}
    <fieldset>
        <legend>Contenu :</legend>
        {include file="documents/views/editor.tpl"}
    </fieldset>

   <div class="form-group">
       <div class="col-sm-offset-2 col-sm-8">
        <button type="submit" value="Générer" name="send" class="btn btn-default">
            <i class="fa fa-print"></i> Imprimer
        </button>
           </div>
       </div>


</form>
</div>
