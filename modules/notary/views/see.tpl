{include file="tpl_default/entete.tpl"}


<div  class="row bg-success bannerTitle">
    <div class="col-md-6">
        <h1 class="h2"> {Lang::LABEL_NOTARY_SEE_H1}</h1>
    </div>
    <div class="col-md-6">
        <p class="h4 text-right ">


            <a title="Fermer la fiche" class="btn btn-default" href="{Tools::create_url($user,'notary','list')}"><i class="fa fa-times fa-2x"></i></a>

            {if $user->getLevelMember()->getIdLevelMember() <= 2}
                <a title="Modifier" class="btn btn-warning" href="{$urlUpdate}"><i class="fa fa-pencil-square-o fa-2x"></i></a>
                <a title="Supprimer" class="btn btn-danger" href="{$urlDelete}"><i class="fa fa-trash fa-2x"></i></a>
            {/if}
        </p>
    </div>
</div>

<dl class="dl-horizontal">
    <dt>Nom :</dt>
    <dd>{$notary->getName()}</dd>
    <dt>Prénom :</dt>
    <dd>{$notary->getFirstname()}</dd>
    <dt>Adresse :</dt>
    <dd>
        {$notary->getAddress()}<br>
        {$notary->getZipCode()} {$notary->getCity()}
    </dd>
        <dt>Tél. : </dt>
    <dd>{$notary->getPhone()}</dd>
        <dt>Tél. port. : </dt>
    <dd>{if $notary->getMobilPhone()}{$notary->getMobilPhone()} <a title="Envoyer un SMS" href="{Constant::DEFAULT_URL}/modules/openmail/formFancybox/sendSms.php?{time()}&amp;dest={str_replace('+','%2B',$notary->getMobilPhone())}" class="fancyboxAjax fancybox.ajax btn btn-default"> <i class="fa fa-mobile fa-2x"></i>  </a>{else}NC{/if}</dd>
        <dt>Tél pro. : </dt>
    <dd>{$notary->getJobPhone()}</dd>
    <dt>Fax :</dt>
    <dd>{$notary->getFax()}</dd>
    <dt>Email : </dt>
    <dd>{if $notary->getEmail()}{$notary->getEmail()}  <a href="{Constant::DEFAULT_URL}/modules/openmail/formFancybox/sendEmail.php?{time()}&amp;dest={$notary->getEmail()}" class="fancyboxAjax fancybox.ajax btn btn-default" title="Envoyer un e-mail"><i class="fa fa-paper-plane"></i></a>{/if}</dd>
    <dt>Commentaire :</dt>
    <dd>{$notary->getComments()}</dd>
</dl>


<div  class="row bg-success bannerTitle">
    <div class="col-md-6">
        <h1 class="h2"> Clerc de notaire</h1>
    </div>
    <div class="col-md-6">
        <p class="h4 text-right ">
            {if $user->getLevelMember()->getIdLevelMember() <= 2}
                <a title="Ajouter un clerc de notaire" class="btn btn-success" href="{Tools::create_url($user,'notary','addClerk',$notary->getIdNotary())}"><i class="fa fa-plus-circle fa-2x"></i></a>

            {/if}
        </p>
    </div>
</div>




<table class="dataTableDefault6 table table-striped table-bordered">
	<thead>
		<tr>
			<th>Nom &amp; prénom</th>
			<th>Téléphones</th>
			<th>Email</th>
			<th>Actions</th>
		</tr>
	</thead>
	<tbody>

		{foreach from=$list item=item}

		<tr>
			<td>{$item->getName()} {$item->getFirstname()}</td>
			<td>{if $item->getPhone()}
				<p>{Lang::LABEL_NOTARY_ADD_PHONE}{$item->getPhone()}</p>{/if} {if
				$item->getMobilPhone()}
				<p>{Lang::LABEL_NOTARY_ADD_MOBIL_PHONE}{if $item->getMobilPhone()}{$item->getMobilPhone()} <a href="{Constant::DEFAULT_URL}/modules/openmail/formFancybox/sendSms.php?{time()}&amp;dest={str_replace('+','%2B',$item->getMobilPhone())}" class="fancyboxAjax fancybox.ajax btn btn-default" title="Envoyer un SMS"> <i class="fa fa-mobile fa-2x"></i>  </a>{else}NC{/if}</p>{/if}
				{if $item->getJobPhone()}
				<p>{Lang::LABEL_NOTARY_ADD_JOB_PHONE}{$item->getJobPhone()}</p>{/if}</td>
			<td>{if $item->getEmail()}{$item->getEmail()}  <a href="{Constant::DEFAULT_URL}/modules/openmail/formFancybox/sendEmail.php?{time()}&amp;dest={$item->getEmail()}" class="fancyboxAjax fancybox.ajax btn btn-default" title="Envoyer un e-mail"><i class="fa fa-paper-plane"></i></a>{/if}</td>

			<td>






                <div class="btn-group">
                    {*<button type="button" class="btn  btn-default">Action</button>*}
                    <a class="btn  btn-default" href="{Tools::create_url($user,'notary','seeClerk',{$item->getIdNotaryClerk()})}" title="{Lang::LABEL_SEE}" {if $user->getOpenInNewTab()} target="_blank"{/if}><i class="fa fa-chevron-circle-right"></i> {Lang::LABEL_SEE} </a>
                    {if $user->getLevelMember()->getIdLevelMember() <= 2}
                    <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
                        <span class="caret"></span>
                        <span class="sr-only">Toggle Dropdown</span>
                    </button>
                    <ul class="dropdown-menu" role="menu">
                        <li class="disabled">
                            <a href="#" title="{Lang::LABEL_UPDATE}"><i class="fa fa-pencil-square-o"></i> {Lang::LABEL_UPDATE}</a></li>
                        <li class="disabled">
                            <a  href="#" title="{Lang::LABEL_DELETE}"><i class="fa fa-trash"></i> {Lang::LABEL_DELETE}</a></li>

                    </ul>
                    {/if}
                </div>









            </td>
		</tr>
		{/foreach}
	</tbody>

</table>


</div>