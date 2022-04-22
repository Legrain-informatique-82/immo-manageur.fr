<div id="acquereurs">
	<div class="accordionStandard" rel="2">
		<h2>
			<a href="#">Acquereurs potentiels</a>
		</h2>
		<div>

			<table class="dataTableDefault4 table table-bordered table-striped">
				<thead>
					<tr>
						<th>Nom &amp; prénom</th>
						<th>Adresse</th>
						<th>Coordonnées</th>
						<th>Actions</th>

					</tr>
				</thead>
				<tbody>
					{foreach from=$listAcqPotentiels item=item} {if
					BddRapprochement::relMandateAcquereurExist($pdo,$mandate,$item)}
					{assign var=rapproche value=1} {else} {assign var=rapproche
					value=0} {/if} {if !$rapproche}
					<tr>
						<td>{$item->getName()} {$item->getFirstname()}</td>
						<td>
							<p>
								{$item->getAddress()}{if $item->getVilleAcquereur()}<br />{$item->getVilleAcquereur()->getZipCode()}
								{$item->getVilleAcquereur()->getName()}{/if}
							</p>
						</td>
						<td>
							<p>
								{if $item->getPhone()} Tél : {$item->getPhone()}<br /> {/if}
                                {if $item->getMobilPhone()} Portable : {$item->getMobilPhone()}
                                    <a title="Envoyer un SMS" href="{Constant::DEFAULT_URL}/modules/openmail/formFancybox/sendSms.php?{time()}&amp;dest={str_replace('+','%2B',$item->getMobilPhone())}" class="btn btn-default fancyboxAjax fancybox.ajax"><i class="fa fa-mobile fa-2x"></i></a>
                                    <br />
								{/if}
                                {if $item->getWorkPhone()} Travail :
								{$item->getWorkPhone()}<br /> {/if} {if $item->getFax()} Fax :
								{$item->getFax()}<br /> {/if} {if $item->getEmail()}
								{$item->getEmail()}

                                    <a title="Envoyer un e-mail" href="{Constant::DEFAULT_URL}/modules/openmail/formFancybox/sendEmail.php?{time()}&amp;dest={$item->getEmail()}" class="btn btn-default fancyboxAjax fancybox.ajax"><i class="fa fa-paper-plane"></i></a>
                                {/if}
							</p></td>
						<td>
                            <div class="btn-group">

                                <a class="btn btn-default" href="{Tools::create_url($user,'rapprochement','add_rapprochement_man',$item->getIdAcquereur(),array($mandate->getIdMandate() )  )}" {if $user->getOpenInNewTab()} target="_blank"{/if}><i class="fa fa-crosshairs"></i> Rapprocher </a>

                                <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
                                    <span class="caret"></span>
                                    <span class="sr-only">Toggle Dropdown</span>
                                </button>

                                <ul class="dropdown-menu" role="menu">
                                   <li> <a href="{Tools::create_url($user,'acquereur','see',$item->getIdAcquereur( ) )}" title="{Lang::LABEL_SEE}" {if $user->getOpenInNewTab()} target="_blank"{/if}><i class="fa fa-chevron-circle-right"></i> Fiche acquereur</a></li>
                                    {include file="tpl_default/menu_send_sms_mail.tpl" email=$item->getEmail() phonenumber=$item->getMobilPhone()}
                                    </ul>
                                </div>

						</td>

					</tr>
					{/if} {/foreach}
				</tbody>
			</table>

		</div>
		<h2>
			<a href="#">Acquereurs rapprochés</a>
		</h2>
		<div>
			<table class="dataTableDefault5 table table-bordered table-striped">
				<thead>
					<tr>
						<th>Nom &amp; prénom</th>
						<th>Adresse</th>
						<th>Coordonnées</th>
						<th>Actions</th>
					</tr>
				</thead>
				<tbody>
					{foreach from=$listAcqPotentiels item=item} {if
					BddRapprochement::relMandateAcquereurExist($pdo,$mandate,$item)}
					{assign var=rapproche value=1} {else} {assign var=rapproche
					value=0} {/if} {if $rapproche}
					<tr>
						<td>{$item->getName()} {$item->getFirstname()}</td>
						<td>
							<p>
								{$item->getAddress()}{if $item->getVilleAcquereur()}<br />{$item->getVilleAcquereur()->getZipCode()}
								{$item->getVilleAcquereur()->getName()}{/if}
							</p>
						</td>
						<td>
							<p>
								{if $item->getPhone()} Tél : {$item->getPhone()}<br /> {/if}
                                {if $item->getMobilPhone()} Portable : {$item->getMobilPhone()}
                                    <a title="Envoyer un SMS" href="{Constant::DEFAULT_URL}/modules/openmail/formFancybox/sendSms.php?{time()}&amp;dest={str_replace('+','%2B',$item->getMobilPhone())}" class="btn btn-default fancyboxAjax fancybox.ajax"><i class="fa fa-mobile fa-2x"></i></a><br/>
								{/if}
                                {if $item->getWorkPhone()} Travail :
								{$item->getWorkPhone()}<br /> {/if} {if $item->getFax()} Fax :
								{$item->getFax()}<br /> {/if}
                                {if $item->getEmail()}
								{$item->getEmail()} <a title="Envoyer un e-mail" href="{Constant::DEFAULT_URL}/modules/openmail/formFancybox/sendEmail.php?{time()}&amp;dest={$item->getEmail()}" class="btn btn-default fancyboxAjax fancybox.ajax"><i class="fa fa-paper-plane"></i></a>
                                {/if}
							</p></td>
						<td>

                            <div class="btn-group">

                                <a class="btn btn-default" href="{Tools::create_url($user,'rapprochement','seeByMan',BddRapprochement::loadByMandateAndAcquereur($pdo,$mandate,$item)->getIdRapprochement(),array($mandate->getIdMandate() )  )}" {if $user->getOpenInNewTab()} target="_blank"{/if}><i class="fa fa-crosshairs"></i> Détail du rapprochement </a>

                                <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
                                    <span class="caret"></span>
                                    <span class="sr-only">Toggle Dropdown</span>
                                </button>

                                <ul class="dropdown-menu" role="menu">
                                    <li> <a href="{Tools::create_url($user,'acquereur','see',$item->getIdAcquereur( ) )}" title="{Lang::LABEL_SEE}" {if $user->getOpenInNewTab()} target="_blank"{/if}><i class="fa fa-chevron-circle-right"></i> Fiche acquereur</a></li>
                                    {include file="tpl_default/menu_send_sms_mail.tpl" email=$item->getEmail() phonenumber=$item->getMobilPhone()}
                                </ul>
                            </div>

                        </td>

					</tr>
					{/if} {/foreach}
				</tbody>
			</table>
		</div>
		<h2>
			<a href="#">Infos visites</a>
		</h2>
		<div>
			<p>Visité : {$numberVisite} fois</p>
			<p>Reste à visiter : {$resteAVisite} fois</p>

			<table class="dataTableDefault6 table table-bordered table-striped" data-rendering="desc" data-display_length="10">
				<thead>
                <tr class="tri">
                    <th class="jshide"></th>
                    <th class="jshide"></th>
                    <th></th>
                    <th></th>
                    <th class="jshide"></th>
                </tr>
					<tr>
						<th>Date visite</th>
						<th>Nom &amp; prénom</th>
						<th>Visité</th>
						<th>Résultat de la visite</th>
						<th>Actions</th>

					</tr>
				</thead>
				<tbody>
					{foreach from=$listRapprochement item=item}
					<tr>
						<td data-order="{$item->getDateVisite()}">{if
							$item->getDateVisite()}{date(Constant::DATE_FORMAT,$item->getDateVisite())}{/if}</td>
						<td>{$item->getAcquereur()->getName()}
							{$item->getAcquereur()->getFirstname()}</td>
						<td data-order="{$item->getResultatVisite()}">{if $item->getResultatVisite()!=0}Oui{else}Non{/if}</td>
						<td>{if $item->getResultatVisite()!=0}
							{if $item->getResultatVisite() eq 1}Ne correspond pas{else}OK{/if}
							 {/if}

							 </td>
						<td>

                            <div class="btn-group">
                                <a class="btn btn-default" href="{Tools::create_url($user,'rapprochement','seeByMan',$item->getIdRapprochement(),array($mandate->getIdMandate() )  )}" {if $user->getOpenInNewTab()} target="_blank"{/if}><i class="fa fa-crosshairs"></i> Détail du rapprochement </a>
                                <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
                                    <span class="caret"></span>
                                    <span class="sr-only">Toggle Dropdown</span>
                                </button>
                                <ul class="dropdown-menu" role="menu">
                                    {if $item->getResultatVisite()==0}
                                        <li>
                                            <a target="_blank" href="{Tools::create_url($user,'documents','bonVisite',$item->getAcquereur()->getIdAcquereur(),array($mandate->getIdMandate() ))}"><i class="fa fa-print"></i>  Imprimer le bon de visite</a>
                                        </li>
                                    {else}
                                        <li class="disabled"><a href="javascript:return false;"><i class="fa fa-print"></i> Imprimer le bon de visite</a></li>
                                    {/if}

                                    {if $item->getResultatVisite()!=0}


                                        <li><a target="_blank"  href="{Tools::create_url($user,'documents','resVisite',$item->getAcquereur()->getIdAcquereur(),array($mandate->getIdMandate() ))}"><i class="fa fa-print"></i> Imprimer le résultat de la visite</a></li>
                                    {else}
                                        <li class="disabled"><a href="javascript:return false;"><i class="fa fa-print"></i> Imprimer le résultat de la visite</a></li>
                                    {/if}
                                    <li> <a href="{Tools::create_url($user,'acquereur','see',$item->getAcquereur()->getIdAcquereur( ) )}" title="{Lang::LABEL_SEE}" {if $user->getOpenInNewTab()} target="_blank"{/if}><i class="fa fa-chevron-circle-right"></i> Fiche acquereur</a></li>
                                    {include file="tpl_default/menu_send_sms_mail.tpl" email=$item->getAcquereur()->getEmail() phonenumber=$item->getAcquereur()->getMobilPhone()}
                                </ul>

                            </div>



                           </td>

					</tr>
					{/foreach}
				</tbody>
			</table>
			{* {var_dump($listAcqPotentiels)} *}
		</div>
	</div>
</div>
