{include file="tpl_default/entete.tpl"}
<h1>Liste des terrains : {$nameOfEtap}</h1>
{foreach name="listMenuTrois" from=$listElem item=item} {if
$smarty.foreach.listMenuTrois.first}
<ul class="menuHorizontal">
	{/if}
	<li><a {if $item.name eq $nameOfEtap}class="actif"
		{/if} href="{$item.url}">{$item.name}</a></li> {if
	$smarty.foreach.listMenuTrois.last}
</ul>
{/if} {/foreach}

<hr class="clear invi" />
<form action="" method="post">
	<p class="mSep">
		<label for="confidentialMode"> Mode confidentiel<input type="checkbox"
			{if $smarty.post.confidentialMode eq 'ok' or
			empty($smarty.post)} checked="checked" {/if} value="ok"
			name="confidentialMode" id="confidentialMode" /> </label> <input
			type="submit" name="toogleConfidentialMode" value="Ok" />
	</p>
	<p class="mSep alignR">
		<label for="agency">Voir les mandats de : <select name="agency"
			id="agency">
				<option value="ALL" {if $agency eq 'ALL'} selected="selected"{/if}>Toute
					les agences</option> {foreach from=$listAgency item=a}
				<option value="{$a->getIdAgency()}" {if $agency eq $a->getIdAgency()}
					selected="selected" {/if}>l'agence de {$a->getName()}</option>
				{/foreach}
		</select> </label> <input type="submit" name="toogleConfidentialMode"
			value="Ok" />

	</p>
	<hr class="invi clear" />
</form>
<table class="listMandat">
	<thead>
		<tr>
			<th>Prix (FAI en euros)</th>
			<th>Ref mandat</th>
			<th>Surface terrain</th>
			<th>Adresse du mandat</th> {if $smarty.post.confidentialMode neq 'ok'
			and !empty($smarty.post)}
			<th>Nature</th>

			<th>Nom &amp; prénom du vendeur</th>
			<th>Coordonnées vendeur par defaut</th> {/if}

			<th>Duppliquer le mandat</th>
			<th>Voir la fiche</th>
		</tr>
	</thead>
	<tbody>
		{foreach from=$listMandat item=item}
		<tr rel="{$item.obj->getIdMandate()}">
			<!--		<td>{Tools::grosNombre(round($item.obj->getPriceFai(),0))} &euro;</td>-->
			<td class="gras">{round($item.obj->getPriceFai(),2)}</td>
			<td class="gras">{$item.obj->getNumberMandate()}</td>
			<td>{if
				$item.obj->getSuperficieTotale()==0}NC{else}{$item.obj->getSuperficieTotale()}{/if}</td>
			<td>{if $smarty.post.confidentialMode neq 'ok' and
				!empty($smarty.post)} {$item.obj->getAddress()} {/if}
				{$item.obj->getCity()->getZipCode()}
				{$item.obj->getCity()->getName()}</td> {if
			$smarty.post.confidentialMode neq 'ok' and !empty($smarty.post)}
			<td>{if
				$item.obj->getNature()==null}NC{else}{$item.obj->getNature()->getName()}{/if}</td>

			<td>{if $item.obj->getDefaultSeller()}
			{$item.obj->getDefaultSeller()->getFirstname()}
				{$item.obj->getDefaultSeller()->getName()}{/if}</td>
			<td>{if $item.obj->getDefaultSeller()} {if
				$item.obj->getDefaultSeller()->getPhone()}
				<p>Téléphone : {$item.obj->getDefaultSeller()->getPhone()}</p>{/if}
				{if $item.obj->getDefaultSeller()->getMobilPhone()}
				<p>Téléphone portable:
					{$item.obj->getDefaultSeller()->getMobilPhone()}</p>{/if} {if
				$item.obj->getDefaultSeller()->getWorkPhone()}
				<p>Téléphone travail:
					{$item.obj->getDefaultSeller()->getWorkPhone()}</p>{/if} {if
				$item.obj->getDefaultSeller()->getFax()}
				<p>Fax : {$item.obj->getDefaultSeller()->getFax()}</p>{/if} {if
				$item.obj->getDefaultSeller()->getEmail()}
				<p>Email : {$item.obj->getDefaultSeller()->getEmail()}</p>{/if}
				{else} NC {/if}</td> {/if}

			<td><a href="{$item.urls.duplicate}">Duppliquer</a></td>
			<td><a href="{$item.urls.see}">{Lang::LABEL_SEE}</a></td>
		</tr>
		{/foreach}
	</tbody>
</table>
</div>
