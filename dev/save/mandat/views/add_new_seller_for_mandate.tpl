{include file="tpl_default/entete.tpl"}
<h1>Ajouter un vendeur au terrain : {$mandate->getNumberMandate()}</h1>

<h2>A partir d'un nouveau vendeur</h2>
<form action="" method="post">
	{if $error}
	<ul>
		{foreach from=$error item=item}
		<li class="error">{$item}</li> {/foreach}
	</ul>
	{/if} {include file='seller/views/frm_add_seller.tpl'}
	<p>
		<label for="sellerByDefault"> Définir comme vendeur par defaut : <input
			value="on" type="checkbox" name="sellerByDefault"
			id="sellerByDefault" /> </label>
	</p>
	<p>
		<input type="submit" value="{Lang::LABEL_SAVE}"
			id="seller_add_submit_send" name="seller_add_submit_send" />
	</p>
</form>

<h2>D'un vendeur de la liste ci-dessous</h2>
<table class="standard">
	<thead>
		<tr>

			<th>Nom &amp; prénom</th>
			<th>Titre</th>
			<th>Opérateur lié</th>
			<th>Téléphones</th>
			<th>Email</th>
			<th>Etat</th>
			<th>De ce vendeur</th>
		</tr>
	</thead>
	<tbody>
		{foreach name="frm" from=$listSeller item=item}
		<tr>

			<td>{$item->getName()} - {$item->getFirstname()}</td>
			<td>{$item->getSellerTitle()->getLibel()}</td>
			<td>{$item->getUser()->getFirstname()} {$item->getUser()->getName()}</td>
			<td>{if $item->getPhone()}
				<p>{Lang::LABEL_SELLER_ADD_PHONE}{$item->getPhone()}</p>{/if} {if
				$item->getMobilPhone()}
				<p>{Lang::LABEL_SELLER_ADD_MOBIL_PHONE}{$item->getMobilPhone()}</p>{/if}
				{if $item->getWorkPhone()}
				<p>{Lang::LABEL_SELLER_ADD_WORK_PHONE}{$item->getWorkPhone()}</p>{/if}
			</td>
			<td>{$item->getEmail()}</td>
			<td>{if $item->getAsset() eq 1}Actif{else}Inactif{/if}</td>
			<td>
				<form action="" method="post">
					<p>
						<input type="hidden" name="idSeller"
							value="{$item->getIdSeller()}" /> <label
							for="sellerByDefault{$smarty.foreach.frm.iteration}">Définir
							comme vendeur par defaut : <input value="on" type="checkbox"
							name="sellerByDefault"
							id="sellerByDefault{$smarty.foreach.frm.iteration}" /> </label>
					</p>
					<p>
						<input type="submit" name="used" value="Affecter ce vendeur" />
					</p>
				</form>
			</td>
		</tr>
		{/foreach}
	</tbody>
</table>


</div>
