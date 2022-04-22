{include file="tpl_default/entete.tpl"}


<div class="row bg-success bannerTitle">
    <div class="col-md-12">
        <h1 class="h2">Logs de ce module :</h1>
    </div>

</div>



<div class="containtTbl">
	{foreach name="arrayLog" from=$arrayLog item=line} {if
	$smarty.foreach.arrayLog.first}
	<table class="dataTableDefault table table-striped table-bordered" data-rendering="desc" data-display_length="100">
		<thead>
			<tr>
				<th>Date</th>
				<th>Utilisateur</th>
				<th>Log</th>
			</tr>
		</thead>
		<tbody>
			{/if}
			<tr>
				<td data-order="{$line->getDateLog()}">{date(Constant::DATE_FORMAT,$line->getDateLog())}</td>
				<td>{$line->getUser()->getName()} {$line->getUser()->getFirstname()}</td>
				<td>{$line->getLog()}</td>
			</tr>
			{if $smarty.foreach.arrayLog.last}
		</tbody>
	</table>
	{/if} {/foreach}
</div>
</div>
