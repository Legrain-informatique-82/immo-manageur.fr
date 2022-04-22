<div>
	{foreach from=$photosExportees item=i}
	<p class="miniExport">
		<img
			src="{Constant::DEFAULT_URL_PICTURE_MODULE_DIRECTORY}{$smarty.get.module}/thumb/{$i->getName()}"
			alt="" /> <br /> {$i->getPosition()}
	</p>
	{foreachelse}
	<p>Aucune photo exportée.</p>
	{/foreach}
</div>
