<h2>Imgages exportées</h2>
{foreach from=$listPictureWithPosition item=i}
<p class="miniExport">

	<img
		src="{Constant::DEFAULT_URL_PICTURE_MODULE_DIRECTORY}{$smarty.get.module}/thumb/{$i.name}"
		alt="" /> <input type="hidden" name="idPhoto[]" value="{$i.idPhoto}" />
	<input type="hidden" name="name[]" value="{$i.name}" /> <input
		type="hidden" name="idPhotoExportee[]" value="{$i.idPhotoExportee}" />
	<input type="text" name="position[]" value="{$i.position}" />
</p>
{/foreach}
<hr class="invi clear" />
