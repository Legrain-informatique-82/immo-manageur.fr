{include file="tpl_default/entete.tpl"}
<div class="row bg-success bannerTitle">
    <div class="col-md-6">
        <h1 class="h2">Liste des rapprochements</h1>
    </div>

    <div class="col-md-6">
        <p class="h4 text-right ">
            <a title="Ajouter un rapprochement" class="btn btn-success" href="{Tools::create_url($user,"rapprochement","add")}">
                <i class="fa fa-plus-circle fa-2x"></i>
            </a>
        </p>
    </div>
</div>
<table class="dataTableDefault table table-striped table-bordered">
	<thead>
    <tr class="tri">
        <th></th>
        <th></th>
        <th></th>
        <th class="jshide"></th>
        <th class="jshide"></th>
        <th class="jshide"></th>
        <th></th>
        <th></th>
        <th class="jshide"></th>
    </tr>
		<tr>
			<th>Numéro mandat</th>
			<th>Type de bien</th>
			<th>Acquereur</th>
			<th>Tel</th>
			<th>Tel travail</th>
			<th>Budget</th>
			<th>Utilisateur lié</th>
			<th>Visitée ?</th>

			<th>Actions</th>
		</tr>
	</thead>
	<tbody>
		{foreach from=$listRapp item=r}
		<tr>
			{* Assigne la valeur de l'acquereur actuel *}
            {assign var=acq value=$r->getAcquereur()}
            {$m=$r->getMandate()}
            {if $m->getMandateType()->getId() eq Constant::ID_PLOT_OF_LAND}
                {$mod='terrain'}
            {else}
                {$mod='mandat'}
            {/if}
			<td>{$r->getMandate()->getNumberMandate()}</td>
            <td>
                {$m->getMandateType()->getName()}
            </td>
			<td>{$acq->getFirstname()} {$acq->getName()}</td>
			<td><p>Fixe : {$acq->getPhone()}</p>
				<p>Mobile : {if $acq->getMobilPhone()}{$acq->getMobilPhone()} <a href="{Constant::DEFAULT_URL}/modules/openmail/formFancybox/sendSms.php?{time()}&amp;dest={str_replace('+','%2B',$acq->getMobilPhone())}" class="fancyboxAjax fancybox.ajax btn btn-default" title="Envoyer un sms"><i class="fa fa-2x fa-mobile-phone"></i> </a>{/if}</p></td>
			<td>{$acq->getWorkPhone()}</td>
			<td>De {$acq->getPriceMin()} à {$acq->getPriceMax()} €</td>
			<td>{$acq->getUser()->getFirstname()} {$acq->getUser()->getName()}</td>
			<td>{if $r->getResultatVisite() !=0}Oui{else}Non{/if}</td>
			{*
            <td>{if $user->getLevelMember()->getIdLevelMember()<3 ||
				$user->getIdUser() eq $r->getUser()->getIdUser()} <a
				href="{Tools::create_url($user,'rapprochement','update',$r->getIdRapprochement())}" title="Modifier"><img src="{Constant::DEFAULT_URL_PICTURE_DIRECTORY}update.png" alt="Modifier" /></a>
				{else} - {/if}</td>
			<td>{if $user->getLevelMember()->getIdLevelMember()<3 ||
				$user->getIdUser() eq $r->getUser()->getIdUser()} <a
				href="{Tools::create_url($user,'rapprochement','delete',$r->getIdRapprochement())}" title="Supprimer"><img src="{Constant::DEFAULT_URL_PICTURE_DIRECTORY}delete.png" alt="Supprimer" /></a>
				{else} - {/if}</td>

			<td><a
				href="{Tools::create_url($user,'rapprochement','see',$r->getIdRapprochement())}" title="Voir la fiche" {if $user->getOpenInNewTab()} target="_blank"{/if}><img src="{Constant::DEFAULT_URL_PICTURE_DIRECTORY}see.png" alt="Voir la fiche" /></a></td>
*}
            <td>
                <div class="btn-group">

                    <a class="btn btn-default" href="{Tools::create_url($user,'rapprochement','see',$r->getIdRapprochement())}" {if $user->getOpenInNewTab()} target="_blank"{/if}><i class="fa fa-chevron-circle-right"></i> Fiche </a>
                    <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
                        <span class="caret"></span>
                        <span class="sr-only">Toggle Dropdown</span>
                    </button>
                    <ul class="dropdown-menu" role="menu">

                        <li><a href="{Tools::create_url($user,'acquereur','see',$acq->getIdAcquereur())}"><i class="fa fa-chevron-circle-right"></i> Fiche de l'acquéreur</a></li>
                        <li><a href="{Tools::create_url($user,$mod,'see',$m->getIdMandate())}"><i class="fa fa-chevron-circle-right"></i> Fiche du bien</a></li>

                        {if $user->getLevelMember()->getIdLevelMember()<3 ||
                        $user->getIdUser() eq $r->getUser()->getIdUser()}
                           <li> <a href="{Tools::create_url($user,'rapprochement','update',$r->getIdRapprochement())}" title="Modifier"><i class="fa fa-pencil-square-o"></i> Modifier</a></li>
                        {else}
                            <li class="disabled"> <a href="javascript:return false;" title="Modifier"><i class="fa fa-pencil-square-o"></i> Modifier</a></li>
                        {/if}

                        {if $user->getLevelMember()->getIdLevelMember()<3 ||
                        $user->getIdUser() eq $r->getUser()->getIdUser()}
                            <li> <a href="{Tools::create_url($user,'rapprochement','delete',$r->getIdRapprochement())}" title="Supprimer"><i class="fa fa-trash"></i> Supprimer</a></li>
                        {else}
                            <li class="disabled"> <a href="javascript:return false;" title="Modifier"><i class="fa fa-trash"></i> Supprimer</a></li>
                        {/if}
                        {include file="tpl_default/menu_send_sms_mail.tpl" email=$acq->getEmail() phonenumber=$acq->getMobilPhone}
                    </ul>

                </div>
            </td>

		</tr>
		{/foreach}
	</tbody>
</table>
</div>
