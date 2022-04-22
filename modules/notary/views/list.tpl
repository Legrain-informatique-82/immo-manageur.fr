{include file="tpl_default/entete.tpl"}

<div class="row bg-success bannerTitle">
    <div class="col-md-6">
        <h1 class="h2"> {Lang::LABEL_NOTARY_LIST_H1}</h1>
    </div>
    <div class="col-md-6">
        <p class="h4 text-right ">
            <a title="Ajouter un notaire" class="btn btn-success" href="{Tools::create_url($user,"notary","add")}"> <i class="fa fa-plus-circle fa-2x"></i></a>
        </p>
    </div>
</div>


<table class="dataTableDefault table table-striped table-bordered">
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
			<td>{$item.name}</td>
			<td>
                <p>
                {if $item.number[0]}
				{Lang::LABEL_NOTARY_ADD_PHONE}{$item.number[0]}<br/>{/if} {if
				$item.number[1]}
				{Lang::LABEL_NOTARY_ADD_MOBIL_PHONE}

                    {$item.number[1]} <a title="Envoyer un SMS" href="{Constant::DEFAULT_URL}/modules/openmail/formFancybox/sendSms.php?{time()}&amp;dest={str_replace('+','%2B',$item.number[1])}" class="btn btn-default fancyboxAjax fancybox.ajax"><i class="fa fa-mobile fa-2x"></i></a>
                <br/>{/if}
				{if $item.number[2]}
				{Lang::LABEL_NOTARY_ADD_JOB_PHONE}{$item.number[2]}<br/>{/if}

                </p>
            </td>
			<td>{if $item.email}<p>{$item.email}  <a title="Envoyer un e-mail" href="{Constant::DEFAULT_URL}/modules/openmail/formFancybox/sendEmail.php?{time()}&amp;dest={$item.email}" class="btn btn-default fancyboxAjax fancybox.ajax"><i class="fa fa-paper-plane"></i></a></p>{/if}</td>

			<td>
                <div class="btn-group">

                    <a class="btn  btn-default" href="{$item.urlSee}" title="{Lang::LABEL_SEE}" {if $user->getOpenInNewTab()} target="_blank"{/if}><i class="fa fa-chevron-circle-right"></i> {Lang::LABEL_SEE} </a>
                    <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
                        <span class="caret"></span>
                        <span class="sr-only">Toggle Dropdown</span>
                    </button>
                    <ul class="dropdown-menu" role="menu">
                        <li><a href="{$item.urlUpdate}" title="{Lang::LABEL_UPDATE}"><i class="fa fa-pencil-square-o"></i> {Lang::LABEL_UPDATE}</a></li>
                        <li><a class="jsDelNotary" rel="{$item.id}" href="{$item.urlDelete}" title="{Lang::LABEL_DELETE}"><i class="fa fa-trash"></i> {Lang::LABEL_DELETE}</a></li>
                        {include file="tpl_default/menu_send_sms_mail.tpl" email=$item.email phonenumber=$item.number[1]}

                    </ul>
                </div>

		</tr>
		{/foreach}
	</tbody>

</table>
</div>
