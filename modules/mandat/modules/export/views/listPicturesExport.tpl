
	{foreach from=$photosExportees item=i name="exportPictures"}
        {if $smarty.foreach.exportPictures.first || $smarty.foreach.exportPictures.index %4 eq 0}
        {if !$smarty.foreach.exportPictures.first}</div>{/if}

    <div class="row">
        {/if}
	<div class="col-xs-3">
        <span class="badge">{$i->getPosition()}</span> <img src="{Constant::DEFAULT_URL_PICTURE_MODULE_DIRECTORY}{$smarty.get.module}/thumb/{$i->getName()}" alt="" class="img-thumbnail"/>
    </div>
        {if $smarty.foreach.exportPictures.last}
            </div>

       {/if}
	{foreachelse}
	<p>Aucune photo exportée.</p>
	{/foreach}


