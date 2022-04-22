


	<table class="dataTableDefault2 table table-striped table-bordered table-condensed">
		<thead>
        <tr class="tri">
            <th class="jshide"></th>
            <th class="jshide"></th>
            <th class="jshide"></th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>


            <th class="jshide"></th>
        </tr>
			<tr>

                <th>image</th>
				<th>Prix fai</th>
				<th>Numéro du mandat</th>
				<th>Type de bien</th>
				<th>Type de transaction</th>
				<th>Style du bien</th>
				<th>Surface terrain</th>
				<th>Surface habitable</th>
                <th>Code postal</th>
				<th>ville</th>


				<th>Actions</th>


			</tr>
		</thead>

		<tbody>
			{foreach from=$listMandate item=mandate} {if
			BddRapprochement::relMandateAcquereurExist($pdo,$mandate,$acq)}
			{assign var=rapproche value=1} {else} {assign var=rapproche value=0}
			{/if} {if $mandate->getMandateType()->getIdMandateType() eq
			Constant::ID_PLOT_OF_LAND} {assign var=module value='terrain'} {else}
			{assign var=module value='mandat'} {/if}


			<tr>
                <td>{if $mandate->getPictureByDefault()}
                    <a href="{Constant::DEFAULT_URL_PICTURE_MODULE_DIRECTORY}/{$module}/big/{$mandate->getPictureByDefault()->getName()}" class="fancybox">
                        <img class="img-thumbnail" src="{Constant::DEFAULT_URL_PICTURE_MODULE_DIRECTORY}/{$module}/thumb/{$mandate->getPictureByDefault()->getName()}" alt="" />
                        </a>{/if}
                </td>
				<td data-order="{$mandate->getPriceFai()}"
					class="gras{if ($mandate->getPriceFai() >= $acq->getPriceMax()
				||$mandate->getPriceFai() <= $acq->getPriceMin())&&
				$acq->getPriceMax() !=0} red{/if}">
					{Tools::grosNombre(round($mandate->getPriceFai(),0))} €</td>
				<td class="gras">{$mandate->getNumberMandate()}</td>
				<td class="gras{if $acq->getMandateType()}{if $mandate->getMandateType()->getIdMandateType()
				neq $acq->getMandateType()->getIdMandateType()} red{/if}{/if}">
					{if $mandate->getMandateType()}{$mandate->getMandateType()->getName()}{else}Indifferent{/if}</td>
					
				<td {if $mandate->getTransactionType()->getId() neq
					$acq->getTransactionType()->getId()}
					class="red"{/if}>{$mandate->getTransactionType()->getName()}</td>
					
				<td>{if $mandate->getStyle()&&$acq->getMandateStyle()} {if
					$mandate->getStyle()->getIdMandateStyle() neq
					$acq->getMandateStyle()->getIdMandateStyle()} class="red" {/if}>
					{$mandate->getStyle()->getName()} {else} {if
					$mandate->getStyle()}{$mandate->getStyle()->getName()}{else}NC{/if}
					{/if}</td>
				<td>{$mandate->getSuperficieTotale()}</td>
				<td>{$mandate->getSurfaceHabitable()}</td>
                <td>{$mandate->getCity()->getZipCode()}</td>
				<td>{$mandate->getCity()->getName()}</td>


				
				<td>

                    <div class="btn-group">


                        {if !$rapproche}
                            <a class="btn btn-default" href="{Tools::create_url($user,'rapprochement','add_rapprochement_acq',$smarty.get.action,array($mandate->getIdMandate()))}" title="Rapprocher">
                                <i class="fa fa-crosshairs"></i> Rapprocher
                            </a>
                        {else}
                            <a class="btn btn-default" title="Voir la fiche rapprochement" href="{Tools::create_url($user,'rapprochement','seeByAcq',BddRapprochement::loadByMandateAndAcquereur($pdo,$mandate,$acq)->getIdRapprochement(),array($acq->getIdAcquereur()))}" {if $user->getOpenInNewTab()} target="_blank"{/if}>
                                <i class="fa fa-chevron-circle-right"></i> Fiche rapp.</a>

                        {/if}


                        <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
                            <span class="caret"></span>
                            <span class="sr-only">Toggle Dropdown</span>
                        </button>
                        <ul class="dropdown-menu" role="menu">
                            <li>
                                <a href="{Tools::create_url($user,$module,'see',$mandate->getIdMandate())}" title="Voir" {if $user->getOpenInNewTab()} target="_blank"{/if}><i class="fa fa-chevron-circle-right"></i> Voir la fiche du bien</a>
                            </li>
                        </ul>

                    </div>

                   </td>

			</tr>
			{/foreach}
		</tbody>
	</table>


