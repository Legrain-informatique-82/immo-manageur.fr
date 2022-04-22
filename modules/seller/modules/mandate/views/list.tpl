<div class="row bg-success bannerTitle">
    <div class="col-md-12">
        <h1 class="h2">Liste des mandats associés</h1>
    </div>
    </div>
<table class="dataTableDefault table table-striped table-bordered">
	<thead>
    <tr class="tri">
        <th class="jshide"></th>
        <th class="jshide"></th>
        <th></th>
        <th></th>
        <th class="jshide"></th>
        <th></th>
        <th class="jshide"></th>
    </tr>
		<tr>
			<th>Photo principale</th>
			<th>Ref mandat</th>
			<th>type de mandat</th>
			<th>Etape en cours</th>
			<th>Adresse</th>
			<th>Prix FAI</th>
			<th>Actions</th>
		</tr>
	</thead>
	<tbody>
		{foreach from=$listMandate item=i}
		{if $i->getMandateType()->getIdMandateType()==Constant::ID_PLOT_OF_LAND}
		 	{assign var="module" value='terrain'}
		 {else}
		 	{assign var="module" value='mandat'}
		 {/if}
		<tr>
			<td>{if $i->getPictureByDefault()}<img
				src="{Constant::DEFAULT_URL_PICTURE_MODULE_DIRECTORY}/{$module}/thumb/{$i->getPictureByDefault()->getName()}"
				alt="Img" class="img-thumbnail" />{else}NC {/if}</td>
			<td>{$i->getNumberMandate()}</td>
			<td>{$i->getMandateType()->getName()}</td>
			<td>{$i->getEtap()->getName()}</td>
			<td>{$i->getAddress()}<br />{$i->getCity()->getZipCode()}
				{$i->getCity()->getName()}</td>
			<td data-order="{round($i->getPriceFai(),0)}">{Tools::grosNombre(round($i->getPriceFai(),0))} &euro;</td>
			<td>

                <a href="{Tools::create_url($user,$module,'see',$i->getIdMandate())}"{if $user->getOpenInNewTab()} target="_blank"{/if} class="btn btn-default"> <i class="fa fa-chevron-circle-right"></i> {Lang::LABEL_SEE} </a>
			</td>
		</tr>

		{/foreach}
	</tbody>
</table>
