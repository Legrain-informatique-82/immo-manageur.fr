{include file="tpl_default/entete.tpl"}
<div class="row bg-success bannerTitle">
    <div class="col-md-6">
        <h1 class="h2">À partir de cet acquereur :</h1>
    </div>

    <div class="col-md-6">
        <p class="h4 text-right ">
            <a title="Annuler et revenir à la liste" class="btn btn-default" href="{Tools::create_url($user,"rapprochement","list")}">
                <i class="fa fa-close fa-2x"></i>
            </a>
        </p>
    </div>
</div>

<table class="dataTableDefault table table-striped table-bordered">
	<thead>
    <tr class="tri">
        <th class="jshide"></th>
        <th></th>
        <th></th>
        <th class="jshide"></th>
        <th class="jshide"></th>
        <th class="jshide"></th>
    </tr>
		<tr>
			<th>Nom &amp; prénom</th>
			<th>Titre</th>
			<th>Opérateur lié</th>
			<th>téléphones</th>
			<th>email</th>
			<th>Actions</th>
		</tr>
	</thead>
	<tbody>
		{foreach from=$listAcq item=item}
		<tr>

			<td>{$item->getFirstname()} {$item->getName()}</td>
			<td>{$item->getTitreAcquereur()->getName()}</td>
			<td>{$item->getUser()->getFirstname()} {$item->getUser()->getName()}
			</td>
			<td>{if $item->getPhone()}
				<p>{Lang::LABEL_SELLER_ADD_PHONE}{$item->getPhone()}</p>{/if} {if
				$item->getMobilPhone()}
				<p>{Lang::LABEL_SELLER_ADD_MOBIL_PHONE}{$item->getMobilPhone()}</p>{/if}
				{if $item->getWorkPhone()}
				<p>{Lang::LABEL_SELLER_ADD_WORK_PHONE}{$item->getWorkPhone()}</p>{/if}
			</td>
			<td>{$item->getEmail()}</td>
			<td>

                <div class="btn-group">
                    <a class="btn btn-default" href="{Tools::create_url($user,'rapprochement','chooseMandate',$item->getIdAcquereur())}" {if $user->getOpenInNewTab()} target="_blank"{/if}><i class="fa fa-check"></i> Utiliser </a>
                    <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
                        <span class="caret"></span>
                        <span class="sr-only">Toggle Dropdown</span>
                    </button>
                    <ul class="dropdown-menu" role="menu">
                        <li><a href="{Tools::create_url($user,'acquereur','see',$item->getIdAcquereur())}"><i class="fa fa-chevron-circle-right"></i> Fiche de l'acquéreur</a></li>
                        {include file="tpl_default/menu_send_sms_mail.tpl" email=$item->getEmail() phonenumber=$item->getMobilPhone}
                    </ul>

                </div>
			</td>
		</tr>
		{/foreach}
	</tbody>
</table>
</div>
