{include file="tpl_default/entete.tpl"} {* Inclu le tpl déclaré dans le
hook *} {if $hook_header} {foreach from=$hook_header item=hook} {include
file=$hook} {/foreach} {/if}
<h1>Infos :</h1>
<div>
	{if $user->getLevelMember()->getIdLevelMember() ==1 ||
	$user->getIdUser() == $userToSee->getIdUser()}<a
		href="{Constant::DEFAULT_URL}/mod-user/update/{$smarty.get.action}">Modifier
		la fiche</a>{/if} {if $user->getLevelMember()->getIdLevelMember() ==1
	&& $user->getIdUser() != $userToSee->getIdUser()}<a
		href="{Constant::DEFAULT_URL}/mod-user/delete/{$smarty.get.action}">Supprimer
		le membre</a>{/if}
</div>
<div>
	<p>Identifiant : {$userToSee->getIdentifiant()}</p>
	<p>Nom : {$userToSee->getName()}</p>
	<p>Prénom : {$userToSee->getFirstname()}</p>
	<p>Email : {$userToSee->getEmail()}</p>
	<p>Agence : {$userToSee->getAgency()->getName()}</p>
	<p>Niveau : {$userToSee->getLevelMember()->getName()}</p>
	{* Liste des téléphones quand ils y seront *}
</div>
{if $user->getLevelMember()->getIdLevelMember() ==1 ||
$user->getIdUser() == $userToSee->getIdUser()}
<h1>Historique de connexion (5 dernières ):</h1>

<div class="containtTbl">
	{foreach name="tblhist" from=$historicConnexion item=line} {if
	$smarty.foreach.tblhist.first}
	<table class="twoColumnWithFirstDate">
		<thead>
			<tr>
				<th>Date de connexion</th>
				<th>Ip</th>
			</tr>
		</thead>
		<tbody>
			{/if}
			<tr>
				<td>{date(Constant::DATE_FORMAT,$line->getDateConnection())}</td>
				<td>{$line->getIp()}</td>
			</tr>
			{if $smarty.foreach.tblhist.last}
		</tbody>
	</table>
	{/if} {/foreach}
</div>
{/if} {if $user->getLevelMember()->getIdLevelMember() ==1}
<div>
	<h1>Log</h1>
	<div class="containtTbl">
		{foreach name="tblLog" from=$arrayLog item=line} {if
		$smarty.foreach.tblLog.first}
		<table class="threeColumnWithFirstDate">
			<thead>
				<tr>
					<th>Date</th>
					<th>Module</th>
					<th>Log</th>
				</tr>
			</thead>
			<tbody>
				{/if}
				<tr>
					<td>{date(Constant::DATE_FORMAT,$line->getDateLog())}</td>
					<td>{$line->getPluginName()}</td>
					<td>{$line->getLog()}</td>
				</tr>
				{if $smarty.foreach.tblLog.last}
			</tbody>
		</table>
		{/if} {/foreach}
	</div>
</div>
{/if}
</div>
