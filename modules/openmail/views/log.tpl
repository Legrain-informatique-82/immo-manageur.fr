{include file="tpl_default/entete.tpl"}
<h1>Logs de ce module :</h1>
<div class="containtTbl">
	{foreach name="arrayLog" from=$arrayLog item=line} {if
	$smarty.foreach.arrayLog.first}
	<table class="threeColumnWithFirstDate">
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
				<td>{date(Constant::DATE_FORMAT,$line->getDateLog())}</td>
				<td>{$line->getUser()->getName()} {$line->getUser()->getFirstname()}</td>
				<td>{$line->getLog()}</td>
			</tr>
			{if $smarty.foreach.arrayLog.last}
		</tbody>
	</table>
	{/if} {/foreach}
</div>
</div>
