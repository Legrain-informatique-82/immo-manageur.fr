<div id="acquereurs">
	<div class="accordionStandard" rel="2">
		<h2>
			<a href="#">Acquereurs potentiels</a>
		</h2>
		<div>

			<table class="standard">
				<thead>
					<tr>
						<th>Nom &amp; prénom</th>
						<th>Adresse</th>
						<th>Coordonnées</th>
						<th>Voir fiche</th>
						<th>Rapprocher</th>
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
								{if $item->getPhone()} Tél : {$item->getPhone()}<br /> {/if} {if
								$item->getMobilPhone()} Portable : {$item->getMobilPhone()}<br />
								{/if} {if $item->getWorkPhone()} Travail :
								{$item->getWorkPhone()}<br /> {/if} {if $item->getFax()} Fax :
								{$item->getFax()}<br /> {/if} {if $item->getEmail()}
								{$item->getEmail()} {/if}
							</p></td>
						<td><a
							href="{Tools::create_url($user,'acquereur','see',$item->getIdAcquereur( ) )}">Voir</a>
						</td>
						<td><a
							href="{Tools::create_url($user,'rapprochement','add_rapprochement_man',$item->getIdAcquereur(),array($mandate->getIdMandate() )  )}">Rapprocher</a>

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
			<table class="standard">
				<thead>
					<tr>
						<th>Nom &amp; prénom</th>
						<th>Adresse</th>
						<th>Coordonnées</th>
						<th>Voir fiche</th>
						<th>Voir le rapprochement</th>
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
								{if $item->getPhone()} Tél : {$item->getPhone()}<br /> {/if} {if
								$item->getMobilPhone()} Portable : {$item->getMobilPhone()}<br />
								{/if} {if $item->getWorkPhone()} Travail :
								{$item->getWorkPhone()}<br /> {/if} {if $item->getFax()} Fax :
								{$item->getFax()}<br /> {/if} {if $item->getEmail()}
								{$item->getEmail()} {/if}
							</p></td>
						<td><a
							href="{Tools::create_url($user,'acquereur','see',$item->getIdAcquereur( ) )}">Voir</a>
						</td>
						<td>{* id du rapprochement ? *} <a
							href="{Tools::create_url($user,'rapprochement','seeByMan',BddRapprochement::loadByMandateAndAcquereur($pdo,$mandate,$item)->getIdRapprochement(),array($mandate->getIdMandate() )  )}">Voir
								le rapprochement</a></td>
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

			<table class="triActionsBis">
				<thead>
					<tr>
						<th>Date visite</th>
						<th>Nom &amp; prénom</th>
						<th>Visité</th>
						<th>Résultat de la visite</th>
						<th>Bon visite</th>
						<th>Voir fiche</th>
					</tr>
				</thead>
				<tbody>
					{foreach from=$listRapprochement item=item}
					<tr>
						<td>{if
							$item->getDateVisite()}{date(Constant::DATE_FORMAT,$item->getDateVisite())}{/if}</td>
						<td>{$item->getAcquereur()->getName()}
							{$item->getAcquereur()->getFirstname()}</td>
						<td>{if $item->getResultatVisite()!=0}Oui{else}Non{/if}</td>
						<td>{if $item->getResultatVisite()!=0}
							<p>{if $item->getResultatVisite() eq 1}Ne correspond
								pas{else}OK{/if}
									<br />
								<a target="_blank"
									href="{Tools::create_url($user,'documents','resVisite',$item->getAcquereur()->getIdAcquereur(),array($mandate->getIdMandate() ))}">Courrier résultat
									de la visite</a>
								</p> {else}
							<p>Non visité</p> {/if}</td>
						<td>{if $item->getResultatVisite()==0}
							<p>
								<a target="_blank"
									href="{Tools::create_url($user,'documents','bonVisite',$item->getAcquereur()->getIdAcquereur(),array($mandate->getIdMandate() ))}">Bon
									de visite</a>
							</p> {else}
							<p>-</p> {/if}</td>
						<td><a
							href="{Tools::create_url($user,'rapprochement','seeByMan',$item->getIdRapprochement(),array($mandate->getIdMandate() )  )}">Voir</a>
						</td>
					</tr>
					{/foreach}
				</tbody>
			</table>
			{* {var_dump($listAcqPotentiels)} *}
		</div>
	</div>
</div>
