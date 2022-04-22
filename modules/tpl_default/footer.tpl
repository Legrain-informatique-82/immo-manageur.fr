
<div id="footer" class="clear">{if $login neq '1'}</div>
{/if}
</div>

{*<script type="text/javascript" src="{Constant::DEFAULT_URL}/js/jquery.js"></script>*}
<script type="text/javascript" src="http://code.jquery.com/jquery-latest.min.js"></script>

<script
	type="text/javascript"
	src="{Constant::DEFAULT_URL}/js/jquery.dataTables.min.js"></script>
<script
	type="text/javascript"
	src="{Constant::DEFAULT_URL}/js/dataTables.specificSort.js"></script>
 <script
	type="text/javascript"
	src="{Constant::DEFAULT_URL}/js/KeyTable.min.js"></script>
<script
	type="text/javascript"
	src="{Constant::DEFAULT_URL}/js/jquery-ui-1.8.10.custom.min.js"></script>
<script
	type="text/javascript"
	src="{Constant::DEFAULT_URL}/js/jquery-ui-timepicker-addon.js"></script>
<script
	type="text/javascript" src="{Constant::DEFAULT_URL}/js/swfobject.js"></script>
<script
	type="text/javascript"
	src="{Constant::DEFAULT_URL}/js/jquery.uploadify.v2.1.4.min.js"></script>
<script
	type="text/javascript"
	src="http://maps.google.com/maps/api/js?sensor=false"></script>
<script
	type="text/javascript" src="{Constant::DEFAULT_URL}/js/gmap3.min.js"></script>
	<script
	type="text/javascript" src="{Constant::DEFAULT_URL}/js/hoverIntent.js"></script>


<!-- Add mousewheel plugin (this is optional) -->
<script type="text/javascript" src="{Constant::DEFAULT_URL}/js/fancybox/lib/jquery.mousewheel-3.0.6.pack.js"></script>

<!-- Add fancyBox main JS and CSS files -->
<script type="text/javascript" src="{Constant::DEFAULT_URL}/js/fancybox/source/jquery.fancybox.js?v=2.1.5"></script>


<!-- Add Button helper (this is optional) -->

<script type="text/javascript" src="{Constant::DEFAULT_URL}/js/fancybox/source/helpers/jquery.fancybox-buttons.js?v=1.0.5"></script>

<!-- Add Thumbnail helper (this is optional) -->

<script type="text/javascript" src="{Constant::DEFAULT_URL}/js/fancybox/source/helpers/jquery.fancybox-thumbs.js?v=1.0.7"></script>

<!-- Add Media helper (this is optional) -->
<script type="text/javascript" src="{Constant::DEFAULT_URL}/js/fancybox/source/helpers/jquery.fancybox-media.js?v=1.0.6"></script>
{*
	<script
	type="text/javascript" src="{Constant::DEFAULT_URL}/js/jquery.masonry.min.js"></script>
*}





<script type="text/javascript" src="{Constant::DEFAULT_URL}/libs/TableTools/js/dataTables.tableTools.min.js"></script>

<script type="text/javascript" src="{Constant::DEFAULT_URL}/libs/bootstrap/js/bootstrap.min.js"></script>
<script type="text/javascript" language="javascript" src="//cdn.datatables.net/plug-ins/725b2a2115b/integration/bootstrap/3/dataTables.bootstrap.js"></script>

<script type="text/javascript" src="{Constant::DEFAULT_URL}/libs/plupload/js/plupload.full.min.js"></script>
<script type="text/javascript" src="{Constant::DEFAULT_URL}/libs/plupload/js/jquery.plupload.queue/jquery.plupload.queue.js"></script>

{*
<script type="text/javascript" src="{Constant::DEFAULT_URL}/libs/plupload/js/plupload.full.min.js"></script>
<script type="text/javascript" src="{Constant::DEFAULT_URL}/libs/plupload/js/jquery.ui.plupload/jquery.ui.plupload.js"></script>
*}
{if $js}
    {foreach $js as $file}
        <script type="text/javascript" src="{Constant::DEFAULT_URL}/modules/{$module}/js/{$file}"></script>
    {/foreach}
{/if}

<script type="text/javascript" src="{Constant::DEFAULT_URL}/libs/ckeditor/ckeditor.js"></script>
<script type="text/javascript" src="{Constant::DEFAULT_URL}/libs/ckeditor/adapters/jquery.js"></script>
<script type="text/javascript" src="{Constant::DEFAULT_URL}/js/stickyMojo.js"></script>

<script type="text/javascript" src="{Constant::DEFAULT_URL}/js/functions.js"></script>

</body>
</html>
