<fieldset>
    <legend>Images exportées</legend>
    <div class="col-sm-offset-2 col-sm-8">

        {foreach from=$listPictureWithPosition item=i name=boucle}


        {if $smarty.foreach.boucle.index %3 ==0}
        {if !$smarty.foreach.boucle.first}</div>{/if}
    <div class="row">
        {/if}

        <div class="col-md-4 text-center">
            <img src="{Constant::DEFAULT_URL_PICTURE_MODULE_DIRECTORY}{$smarty.get.module}/thumb/{$i.name}" alt="" class="img-thumbnail" />
            <input type="hidden" name="idPhoto[]" value="{$i.idPhoto}" />
            <input type="hidden" name="name[]" value="{$i.name}" />
            <input type="hidden" name="idPhotoExportee[]" value="{$i.idPhotoExportee}" />
            <input  class="form-control" type="text" name="position[]" value="{$i.position}" placeholder="position de la photo (ex : {$smarty.foreach.boucle.iteration} )"/>
            <p></p>
        </div>

        {/foreach}
    </div>
    </div>
</fieldset>

