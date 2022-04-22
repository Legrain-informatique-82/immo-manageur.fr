{include file="tpl_default/entete.tpl"} {* Inclu le tpl déclaré dans le
hook *} {if $hook_header} {foreach from=$hook_header item=hook} {include
file=$hook} {/foreach} {/if}

<div class="row bg-success bannerTitle">
    <div class="col-md-6">
        <h1 class="h2"> Général : </h1>
    </div>
    <div class="col-md-6">
        <p class="h4 text-right ">

            {if $user->getLevelMember()->getIdLevelMember() ==1 || $user->getIdUser() == $userToSee->getIdUser()}
            <a title="Modifier le membre" href="{Constant::DEFAULT_URL}/mod-user/update/{$smarty.get.action}" class="btn btn-warning"><i class="fa fa-pencil-square-o fa-2x"></i></a>{/if}
            {if $user->getLevelMember()->getIdLevelMember() ==1 && $user->getIdUser() != $userToSee->getIdUser()}
            <a title="Supprimer le membre" href="{Constant::DEFAULT_URL}/mod-user/delete/{$smarty.get.action}" class="btn btn-danger"><i class="fa fa-trash fa-2x"></i></a>{/if}

            <a class="btn btn-default" href="{Tools::create_url($user,'user','list')}" title="fermer et retourner à la liste">
                <i class="fa fa-2x fa-close"></i>
            </a>
        </p>
    </div>
</div>
<div>

</div>
<dl class="dl-horizontal">
    <dt>Identifiant :</dt>
    <dd>{$userToSee->getIdentifiant()}</dd>
    <dt>Nom :</dt>
    <dd>{$userToSee->getName()}</dd>
    <dt>Prénom :</dt>
    <dd>{$userToSee->getFirstname()}</dd>
    <dt>Email :</dt>
    <dd>{if $userToSee->getEmail()}{$userToSee->getEmail()} <a href="{Constant::DEFAULT_URL}/modules/openmail/formFancybox/sendEmail.php?{time()}&amp;dest={$userToSee->getEmail()}" class="fancyboxAjax fancybox.ajax btn btn-default" title="Envoyer un SMS"> <i class="fa fa-paper-plane"></i> </a>{/if}</dd>
    <dt>Téléphone portable : </dt>
    <dd>{if $userToSee->getCellPhone()}{$userToSee->getCellPhone()}  <a href="{Constant::DEFAULT_URL}/modules/openmail/formFancybox/sendSms.php?{time()}&amp;dest={str_replace('+','%2B',$userToSee->getCellPhone())}" class="fancyboxAjax fancybox.ajax btn btn-default"><i class="fa fa-mobile-phone fa-2x"></i>  </a>{else}NC{/if}</dd>
    <dt>Agence :</dt>
    <dd>{$userToSee->getAgency()->getName()}</dd>
    <dt>Niveau :</dt>
    <dd>{$userToSee->getLevelMember()->getName()}</dd>
    <dt>Thème : </dt>
    <dd>{$userToSee->getTheme()}</dd>
    <dt>Ouverture des pages<br/> dans de nouveaux<br/> onglets :</dt>
    <dd>{if $userToSee->getOpenInNewTab() eq 0}Non{else}Oui{/if}</dd>
</dl>
{if $user->getLevelMember()->getIdLevelMember() ==1 ||
$user->getIdUser() == $userToSee->getIdUser()}

<div class="row bg-success bannerTitle">
    <div class="col-md-12">
        <h1 class="h2"> Historique des connexions :</h1>
    </div>
</div>

<div class="containtTbl">
	{foreach name="tblhist" from=$historicConnexion item=line} {if
	$smarty.foreach.tblhist.first}
	<table class="dataTableDefault table table-striped table-bordered" data-rendering="desc" data-display_length="10">
		<thead>
        <tr class="tri">
            <th class="jshide"></th>
            <th></th>
        </tr>
			<tr>
				<th>Date de connexion</th>
				<th>Ip</th>
			</tr>
		</thead>
		<tbody>
			{/if}
			<tr>
				<td data-order="{$line->getDateConnection()}">{date(Constant::DATE_FORMAT,$line->getDateConnection())}</td>
				<td>{$line->getIp()}</td>
			</tr>
			{if $smarty.foreach.tblhist.last}
		</tbody>
	</table>
	{/if} {/foreach}
</div>
{/if} {if $user->getLevelMember()->getIdLevelMember() ==1}
<div>
    <div class="row bg-success bannerTitle">
        <div class="col-md-12">
            <h1 class="h2"> Logs :</h1>
        </div>
    </div>
	<div class="containtTbl">
		{foreach name="tblLog" from=$arrayLog item=line} {if
		$smarty.foreach.tblLog.first}
		<table class="dataTableDefault2 table table-striped table-bordered" data-rendering="desc" data-display_length="10">
			<thead>
            <tr class="tri">
                <th class="jshide"></th>
                <th></th>
                <th class="jshide"></th>
            </tr>
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
