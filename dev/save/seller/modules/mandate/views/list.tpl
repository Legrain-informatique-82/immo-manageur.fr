<h1>Liste des mandats associés</h1>
<table class="standard">
	<thead>
		<tr>
			<th>Photo principale</th>
			<th>Ref mandat</th>
			<th>type de mandat</th>
			<th>Etape en cours</th>
			<th>Adresse</th>
			<th>Prix FAI</th>
			<th>Voir</th>
		</tr>
	</thead>
	<tbody>
		{foreach from=$listMandate item=i}
		<tr>
			<td>{if $i->getPictureByDefault()}<img
				src="{Constant::DEFAULT_URL_PICTURE_MODULE_DIRECTORY}/terrain/thumb/{$i->getPictureByDefault()->getName()}"
				alt="Img" />{else}NC {/if}</td>
			<td>{$i->getNumberMandate()}</td>
			<td>{$i->getMandateType()->getName()}</td>
			<td>{$i->getEtap()->getName()}</td>
			<td>{$i->getAddress()}<br />{$i->getCity()->getZipCode()}
				{$i->getCity()->getName()}</td>
			<td>{Tools::grosNombre(round($i->getPriceFai(),0))} &euro;</td>
			<td><a
				href="{Tools::create_url($user,'terrain','see',$i->getIdMandate())}">Voir</a>
			</td>
		</tr>

		{/foreach}
	</tbody>
</table>
