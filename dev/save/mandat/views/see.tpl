{include file="tpl_default/entete.tpl"}
<p id="arrowsNextPreview">
	{if $mandatPrecedent} <a
		href="{Tools::create_url($user,$smarty.get.module,$smarty.get.page,$premierMandat->getIdMAndate())}"><img
		src="{Constant::DEFAULT_URL_PICTURE_DIRECTORY}finalBack.png"
		alt="Premier Mandat" /> </a> <a
		href="{Tools::create_url($user,$smarty.get.module,$smarty.get.page,$mandatPrecedent->getIdMAndate())}"><img
		src="{Constant::DEFAULT_URL_PICTURE_DIRECTORY}back.png"
		alt="Mandat précédent" /> </a> {/if} {if $mandatSuivant} <a
		href="{Tools::create_url($user,$smarty.get.module,$smarty.get.page,$mandatSuivant->getIdMAndate())}"><img
		src="{Constant::DEFAULT_URL_PICTURE_DIRECTORY}forward.png"
		alt="Mandat suivant" /> </a> <a
		href="{Tools::create_url($user,$smarty.get.module,$smarty.get.page,$dernierMandat->getIdMAndate())}"><img
		src="{Constant::DEFAULT_URL_PICTURE_DIRECTORY}finalForward.png"
		alt="Dernier mandat" /> </a> {/if}
</p>
<hr class="clear invi" />

<div class="blocEnteteMandat">
	<h1>Etape en cours :</h1>
	<p>etape : {$mandate->getEtap()->getName()}</p>
	{if $mandate->getCommentaire()}{$mandate->getCommentaire()}{/if} {if
	($user->getLevelMember()->getIdLevelMember() < 3 OR $user->getIdUser()
	eq $mandate->getUser()->getIdUser()) AND
	$mandate->getEtap()->getIdMandateEtap() eq Constant::ID_ETAP_TO_SELL}
	<p>
		<a
			href="{Tools::create_url($user,$smarty.get.module,'cancel',$smarty.get.action)}">Le
			contrat a été annulé</a>
	</p>
	{/if} {* Si le mandat n'est pas à vendre, on peut le réactualiser.
	(pere et admin ? ou tout le monde ?) *} {if
	($user->getLevelMember()->getIdLevelMember() < 3 OR $user->getIdUser()
	eq $mandate->getUser()->getIdUser()) AND
	$mandate->getEtap()->getIdMandateEtap() neq Constant::ID_ETAP_TO_SELL}
	<p>
		<a
			href="{Tools::create_url($user,$smarty.get.module,'renew',$smarty.get.action)}">Reaffecter
			le mandat</a>
	</p>
	{/if} {* Finaliser la vente (pere ou admin) pour un mandat en etat
	compromis *} {if ($user->getLevelMember()->getIdLevelMember() < 3 OR
	$user->getIdUser() eq $mandate->getUser()->getIdUser()) AND
	$mandate->getEtap()->getIdMandateEtap() eq CONSTANT::ID_ETAP_COMPROMIS}
	<p>
		<a
			href="{Tools::create_url($user,'mandat','endSell',$mandate->getIdMandate())}">Finaliser
			la vente</a>
	</p>

	{/if}
</div>
{if $mandate->getPubInternet() !=''}
<div class="blocEnteteMandat">
	<h1>Pub :</h1>

	<p>{Tools::substr($mandate->getPubInternet(),0,250)} {if Tools::strlen(
		$mandate->getPubInternet() ) > 250} [...] {/if}</p>
</div>
{/if} {* mettre dans un hook *} {include file="tpl_default/hook.tpl"
position="hook_elemMandateCom_see"} {*fin hook*} {if
$mandate->getPictureByDefault()}
<img
	src="{Constant::DEFAULT_URL_PICTURE_MODULE_DIRECTORY}/{$smarty.get.module}/thumb/{$mandate->getPictureByDefault()->getName()}"
	alt="" id="miniature2" />
{/if}
<hr class="clear invi" />
{include file="tpl_default/hook.tpl" position="hook_action"}

<div id="tabs">
	<ul>
		<li><a href="#biens">Bien</a>
		</li>
		<li><a href="#vendeur">Vendeur</a>
		</li>
		<li><a href="#plans">Plans</a>
		</li>
		<li><a href="#fichiers">Fichiers</a>
		</li>
		<li><a href="#impressions">Impressions</a>
		</li> {include file="tpl_default/hook.tpl" position="hook_acqTitle"}

	</ul>
	<div id="biens">
		<div class="accordion" rel="2">
			<h2>
				<a href="#" rel="gen">Général</a>
			</h2>
			<div>
				{if ($user->getLevelMember()->getIdLevelMember() < 3 OR
				$user->getIdUser() eq $mandate->getUser()->getIdUser() ) AND
				$mandate->getEtap()->getIdMandateEtap() eq
				Constant::ID_ETAP_TO_SELL}
				<p>
					<a
						href="{Tools::create_url($user,$smarty.get.module,'updateGen',$smarty.get.action)}">Modifier
						les informations</a>
				</p>
				{/if}
				<div class="mSep">
					<h3>Localisation</h3>
					<p>{$mandate->getAddress()}</p>
					<p>{$mandate->getCity()->getZipCode()}
						{$mandate->getCity()->getName()}</p>

				</div>
				<div class="mSep">
					<h3>Général</h3>
					<p>Nature du bien : {if
						$mandate->getNature()==null}NC{else}{$mandate->getNature()->getName()}{/if}</p>
					<p>Utilisateur affecté : {$mandate->getUser()->getName()}
						{$mandate->getUser()->getFirstname()}</p>
					<p>Notaire vendeur : {if $mandate->getNotary()}{$mandate->getNotary()->getName()}{else}NC{/if}</p>
					<p>Notaire acquereur : {if $mandate->getNotaryAcq()}{$mandate->getNotaryAcq()->getName()}{else}NC{/if}</p>
					<p>Type transaction : {$mandate->getTransactionType()->getName()}</p>
					<p>Type de bien : {$mandate->getMandateType()->getName()}</p>
				</div>
				<hr class="invi clear" />
				<div class="mSep">
					<h3>Mandat</h3>
					<p>N° Mandat : {$mandate->getNumberMandate()}</p>
					<p>Début : {date(Constant::DATE_FORMAT2,$mandate->getInitDate())}</p>
					<p>Fin : {if date(Constant::DATE_FORMAT2,$mandate->getDeadDate())
						eq '01/01/1970'} NC
						{else}{date(Constant::DATE_FORMAT2,$mandate->getDeadDate())}{/if}</p>
					<p>libre le : {if $mandate->getFreeDate()==null} NC
						{else}{date(Constant::DATE_FORMAT2,$mandate->getFreeDate())}{/if}</p>

				</div>
				<div class="mSep">
					<h3>Prix</h3>
					{* Si c'est = à vente*} {if Constant::ID_TRANSACTION_TYPE_SELLER eq
					$mandate->getTransactionType()->getIdTransactionType()}
					<p>Prix FAI : {Tools::grosNombre(round($mandate->getPriceFAI(),0))}
						&euro;</p>
					<p>Prix net vendeur :
						{Tools::grosNombre(round($mandate->getPriceSeller(),0))} &euro;</p>
					<p>Commission :
						{Tools::grosNombre(round($mandate->getCommission(),0))} &euro;</p>
					{if Tools::grosNombre(round($mandate->getEstimationMaxi(),0)) eq 0}
					{if Tools::grosNombre(round($mandate->getEstimationFai(),0)) neq 0}
					<p>Estimation FAI :
						{Tools::grosNombre(round($mandate->getEstimationFai(),0))} &euro;</p>
					{/if} {else}


					<p>Estimation FAI entre
						{Tools::grosNombre(round($mandate->getEstimationFai(),0))} &euro;
						et {Tools::grosNombre(round($mandate->getEstimationMaxi(),0))}
						&euro;</p>

					{/if} {if
					Tools::grosNombre(round($mandate->getMargeNegociation(),0)) neq 0}
					<p>Marge negoce :
						{Tools::grosNombre(round($mandate->getMargeNegociation(),0))}
						&euro;</p>
					{/if} {else}
					<p>Loyer + frais d'agence :
						{Tools::grosNombre(round($mandate->getPriceFAI(),0))} &euro;</p>
					<p>Loyer : {Tools::grosNombre(round($mandate->getPriceSeller(),0))}
						&euro;</p>
					<p>Commission :
						{Tools::grosNombre(round($mandate->getCommission(),0))} &euro;</p>
					{/if}
				</div>
				<hr class="invi clear" />
				{if $mandate->getGeolocalisation()} {assign var="geo"
				value=explode(',',$mandate->getGeolocalisation())}
				<h3>Géolocalisation</h3>
				<div id="map"></div>
				<p>
					Latitude : en degrès sexagésimaux : {$geo.0} - en degrès décimaux :
					<span id="latitude">{Tools::convertSexadecimalInDecimal($geo.0)}</span>
					<br />Longitude : en degrès sexagésimaux : {$geo.1} - en degrès
					décimaux : <span id="longitude">{Tools::convertSexadecimalInDecimal($geo.1)}</span>
				</p>
				{/if}
			</div>
			<h3>
				<a href="#desc">Infos</a>
			</h3>
			<div>
				{if ($user->getLevelMember()->getIdLevelMember() < 3 OR
				$user->getIdUser() eq $mandate->getUser()->getIdUser() ) AND
				$mandate->getEtap()->getIdMandateEtap() eq
				Constant::ID_ETAP_TO_SELL}
				<p>
					<a
						href="{Tools::create_url($user,$smarty.get.module,'updateDesc',$smarty.get.action)}">Modifier
						les infos/descriptions</a>
				</p>
				{/if}


				<div class="tiers">
					<table>


						<tr>
							<td class="gauche">Nombre de pièces</td>
							<td class="droite">{$mandate->getNbPiece()}</td>
						</tr>
						<tr>
							<td class="gauche">Nombre de chambres</td>
							<td class="droite">{$mandate->getNbChambre()}</td>
						</tr>
						<tr>
							<td class="gauche">Superficie totale</td>
							<td class="droite">{if $mandate->getSuperficieTotale() eq
								0}NC{else}{$mandate->getSuperficieTotale()}{/if}</td>
						</tr>
						<tr>
							<td class="gauche">Surface habitable</td>
							<td class="droite">{$mandate->getSurfaceHabitable()}</td>
						</tr>
						<tr>
							<td class="gauche">Surface pièce vie</td>
							<td class="droite">{$mandate->getSurfacePieceVie()}</td>
						</tr>
						<tr>
							<td class="gauche">Niveau</td>
							<td class="droite">{$mandate->getNiveau()}</td>
						</tr>
						<tr>
							<td class="gauche">Année construction</td>
							<td class="droite">{if
								$mandate->getAnneeConstruction()==0}NC{else}{$mandate->getAnneeConstruction()}{/if}</td>
						</tr>
						<tr>
							<td class="gauche">Charges mensuelles</td>
							<td class="droite">{$mandate->getChargesMensuelle()}</td>
						</tr>
						<tr>
							<td class="gauche">Taxes foncières</td>
							<td class="droite">{$mandate->getTaxesFonciere()}</td>
						</tr>
						<tr>
							<td class="gauche">Taxes Habitation</td>
							<td class="droite">{$mandate->getTaxeHabitation()}</td>
						</tr>
						<tr>
							<td class="gauche">Cheminée</td>
							<td class="droite">{if $mandate->getCheminee() eq
								1}Oui{else}Non{/if}</td>
						</tr>
						<tr>
							<td class="gauche">Cuisine équipée</td>
							<td class="droite">{if $mandate->getCuisineEquipee() eq
								1}Oui{else}Non{/if}</td>
						</tr>
					</table>
				</div>
				<div class="tiers">
					<table>
						<tr>
							<td class="gauche">Cuisine amenagée</td>
							<td class="droite">{if $mandate->getCuisineAmenagee() eq
								1}Oui{else}Non{/if}</td>
						</tr>
						<tr>
							<td class="gauche">Piscine</td>
							<td class="droite">{if $mandate->getPiscine() eq
								1}Oui{else}Non{/if}</td>
						</tr>
						<tr>
							<td class="gauche">Piscine intérieure</td>
							<td class="droite">{if $mandate->getPoolHouse() eq
								1}Oui{else}Non{/if}</td>
						</tr>
						<tr>
							<td class="gauche">Terrasse</td>
							<td class="droite">{if $mandate->getTerrasse() eq
								1}Oui{else}Non{/if}</td>
						</tr>
						<tr>
							<td class="gauche">Mezzanine</td>
							<td class="droite">{if $mandate->getMezzanine() eq
								1}Oui{else}Non{/if}</td>
						</tr>
						<tr>
							<td class="gauche">Dépendance</td>
							<td class="droite">{if $mandate->getDependance() eq
								1}Oui{else}Non{/if}</td>
						</tr>
						<tr>
							<td class="gauche">Gaz</td>
							<td class="droite">{if $mandate->getGaz() eq 1}Oui{else}Non{/if}</td>
						</tr>

						<tr>
							<td class="gauche">Cave</td>
							<td class="droite">{if $mandate->getCave() eq 1}Oui{else}Non{/if}</td>
						</tr>
						<tr>
							<td class="gauche">Sous sol</td>
							<td class="droite">{if $mandate->getSousSol() eq
								1}Oui{else}Non{/if}</td>
						</tr>
						<tr>
							<td class="gauche">Garage</td>
							<td class="droite">{if $mandate->getGarage() eq
								1}Oui{else}Non{/if}</td>
						</tr>
						<tr>
							<td class="gauche">Parking</td>
							<td class="droite">{if $mandate->getParking() eq
								1}Oui{else}Non{/if}</td>
						</tr>
						<tr>
							<td class="gauche">Rez de jardin</td>
							<td class="droite">{if $mandate->getRezDeJardin() eq
								1}Oui{else}Non{/if}</td>
						</tr>
					</table>
				</div>
				<div class="tiers">
					<table>
						<tr>
							<td class="gauche">Plain pied</td>
							<td class="droite">{if $mandate->getPlainPied() eq
								1}Oui{else}Non{/if}</td>
						</tr>
						<tr>
							<td class="gauche">Carrière</td>
							<td class="droite">{if $mandate->getCarriere() eq
								1}Oui{else}Non{/if}</td>
						</tr>
						<tr>
							<td class="gauche">Point eau</td>
							<td class="droite">{if $mandate->getPointEau() eq
								1}Oui{else}Non{/if}</td>
						</tr>
						<tr>
							<td class="gauche">Isolation</td>
							<td class="droite">{if
								$mandate->getInsulation()}{$mandate->getInsulation()->getName()}{else}Non
								spécifié{/if}</td>
						</tr>
						<tr>
							<td class="gauche">Toiture</td>
							<td class="droite">{if
								$mandate->getRoof()}{$mandate->getRoof()->getName()}{else}Non
								spécifié{/if}</td>
						</tr>
						<tr>
							<td class="gauche">Chauffage</td>
							<td class="droite">{if
								$mandate->getHeating()}{$mandate->getHeating()->getName()}{else}Non
								spécifié{/if}</td>
						</tr>
						<tr>
							<td class="gauche">Parties communes</td>
							<td class="droite">{if
								$mandate->getCommonOwnership()}{$mandate->getCommonOwnership()->getName()}{else}Non
								spécifié{/if}</td>
						</tr>
						<tr>
							<td class="gauche">Type de construction</td>
							<td class="droite">{if
								$mandate->getConstruction()}{$mandate->getConstruction()->getName()}{else}Non
								spécifié{/if}</td>
						</tr>
						<tr>
							<td class="gauche">Style</td>
							<td class="droite">{if
								$mandate->getStyle()}{$mandate->getStyle()->getName()}{else}Non
								spécifié{/if}</td>
						</tr>
						<tr>
							<td class="gauche">Nouveautés</td>
							<td class="droite">{if
								$mandate->getNews()}{$mandate->getNews()->getName()}{else}Non
								spécifié{/if}</td>
						</tr>
						<tr>
							<td class="gauche">Conditions</td>
							<td class="droite">{if
								$mandate->getCondition()}{$mandate->getCondition()->getName()}{else}Non
								spécifié{/if}</td>
						</tr>
					</table>
				</div>
				<hr class="clear invi" />
			</div>
			{include file="tpl_default/hook.tpl"
			position="hook_see_mandateDescription"}
			<h3>
				<a href="#">Pub</a>
			</h3>
			<div>
				{if ($user->getLevelMember()->getIdLevelMember() < 3 OR
				$user->getIdUser() eq $mandate->getUser()->getIdUser() ) AND
				$mandate->getEtap()->getIdMandateEtap() eq
				Constant::ID_ETAP_TO_SELL}
				<p>
					<a
						href="{Tools::create_url($user,$smarty.get.module,'updatePub',$smarty.get.action)}">Modifier
						les pubs</a>
				</p>
				{/if}
				<div class="mSep">
					<h3>Vitrine</h3>
					<p>{$mandate->getCommentaireApparent()}</p>
				</div>
				<div class="mSep">
					<h3>Sites</h3>
					{include file="tpl_default/hook.tpl" position="hook_site"}
				</div>
				<hr class="clear invi" />
				<div class="mSep">
					<h3>Pub</h3>
					<p>{$mandate->getPubInternet()}</p>
				</div>
				<div class="mSep">
					<h3>Photos</h3>
					{include file="tpl_default/hook.tpl" position="hook_ExportsList"}
				</div>
				<hr class="clear invi" />
				<div class="mSep">
					<h3>Coup de coeur</h3>
					<p>Coup de coeur : {if $mandate->getCoupCoeur()}Oui{else}Non{/if}</p>
				</div>
				<div class="mSep">
					<h3>Vitrine</h3>
					<p>Affiché en vitrine : {if $afficheEnVitrine}Oui{else}Non{/if}</p>
				</div>
				<hr class="clear invi" />
			</div>
			<h3>
				<a href="#dpe">DPE</a>
			</h3>
			<div>
				{include file="tpl_default/hook.tpl" position="hook_center"} {if
				($user->getLevelMember()->getIdLevelMember() < 3 OR
				$user->getIdUser() eq $mandate->getUser()->getIdUser() ) AND
				$mandate->getEtap()->getIdMandateEtap() eq
				Constant::ID_ETAP_TO_SELL}
				<p>
					<a
						href="{Tools::create_url($user,$smarty.get.module,'updateDpe',$smarty.get.action)}">Modifier
						les infos DPE</a>
				</p>
				{/if}
			</div>

			<h3>
				<a href="#photos">Photos</a>
			</h3>
			<div>

				{if $errorPicture}
				<ul>
					{foreach from=$errorPicture item=e}
					<li class="error">{$e}</li> {/foreach}
				</ul>
				{/if} {if ($user->getLevelMember()->getIdLevelMember() < 3 OR
				$user->getIdUser() eq $mandate->getUser()->getIdUser()) AND
				$mandate->getEtap()->getIdMandateEtap() eq
				Constant::ID_ETAP_TO_SELL}
				<form
					action="{Tools::create_url($user,$smarty.get.module,$smarty.get.page,$mandate->getIdMandate())}"
					method="post" enctype="multipart/form-data">
					<input type="hidden" id="idMandate" name="idMandate"
						value="{$mandate->getIdmandate()}" /> <input type="hidden"
						id="idSess" name="idSess" value="{str_rot13(session_id())}" />
					<p class="uploadMultiple">
						<label for="newPicture">Ajouter une photo : <input type="file"
							name="newPicture" id="newPicture" /> </label> <label
							for="isDefaultPicture">Image par defaut ?<input type="checkbox"
							name="isDefaultPicture" id="isDefaultPicture" /> </label> <input
							type="submit" value="Envoyer" id="sendPictureForMandate"
							name="sendPictureForMandate" />
					</p>
				</form>
				{/if}

				<div id="listVignettes">


					{foreach from=$mandate->listPictures() item=item}
					<div>

						<img
							src="{Constant::DEFAULT_URL_PICTURE_MODULE_DIRECTORY}/{$smarty.get.module}/thumb/{$item->getName()}"
							rel="{$item->getIdMandatePicture()}" alt="" /> {if
						$item->getIsDefault()}
						<p class="jsNone">Image principale</p>
						{else} {if $user->getLevelMember()->getIdLevelMember() < 3 OR
						$user->getIdUser() eq $mandate->getUser()->getIdUser()}
						<form class="jsNone" action="" method="post">
							<p>
								<input type="hidden" name="idMandate"
									value="{$mandate->getIdMandate()}" /> <input type="hidden"
									name="idPicture" value="{$item->getIdMandatePicture()}" /> <input
									type="submit" name="sendPictureByDefault"
									value="Définir comme principale" />
							</p>
						</form>
						{/if} {/if}
						<p>{if ($user->getLevelMember()->getIdLevelMember() < 3 OR
							$user->getIdUser() eq $mandate->getUser()->getIdUser()) AND
							$mandate->getEtap()->getIdMandateEtap() eq
							Constant::ID_ETAP_TO_SELL}</p>
						<form action="" class="jsNone" method="post">
							<p>
								<input type="hidden" name="idMandate"
									value="{$mandate->getIdMandate()}" /> <input type="hidden"
									name="idPicture" value="{$item->getIdMandatePicture()}" /> <input
									type="submit" value="Supprimer l'image" name="delete_picture" />
							</p>
						</form>
						{else} - {/if}

					</div>
					<hr class="jsNone" />
					{/foreach}


				</div>
				<div class="quatreVingt" id="contentBigPicture">
					{* IMG, par defaut mettre la principale *} {if
					$mandate->getPictureByDefault()} <img
						src="{Constant::DEFAULT_URL_PICTURE_MODULE_DIRECTORY}/{$smarty.get.module}/{$mandate->getPictureByDefault()->getName()}"
						alt="" id="grdF" /> {assign var="item"
					value=$mandate->getPictureByDefault()} {if $item->getIsDefault()}
					<p class="jsIndic">Image principale</p>
					{else} {if $user->getLevelMember()->getIdLevelMember() < 3 OR
					$user->getIdUser() eq $mandate->getUser()->getIdUser()}
					<form action="" method="post" class="jsIndic">
						<p>
							<input type="hidden" name="idMandate"
								value="{$mandate->getIdMandate()}" /> <input type="hidden"
								name="idPicture" value="{$item->getIdMandatePicture()}" /> <input
								type="submit" name="sendPictureByDefault"
								value="Définir comme principale" />
						</p>
					</form>
					{/if} {/if}
					<p>{if ($user->getLevelMember()->getIdLevelMember() < 3 OR
						$user->getIdUser() eq $mandate->getUser()->getIdUser()) AND
						$mandate->getEtap()->getIdMandateEtap() eq
						Constant::ID_ETAP_TO_SELL}</p>
					<form action="" method="post" class="jsIndic">
						<p>
							<input type="hidden" name="idMandate"
								value="{$mandate->getIdMandate()}" /> <input type="hidden"
								name="idPicture" value="{$item->getIdMandatePicture()}" /> <input
								type="submit" value="Supprimer l'image" name="delete_picture" />
						</p>
					</form>
					{else} - {/if} {/if}
				</div>
			</div>
		</div>
	</div>
	<div id="vendeur">
		{if ($user->getLevelMember()->getIdLevelMember() < 3 OR
		$user->getIdUser() eq $mandate->getUser()->getIdUser()) AND
		$mandate->getEtap()->getIdMandateEtap() eq Constant::ID_ETAP_TO_SELL}
		<p>
			<a
				href="{Tools::create_url($user,$smarty.get.module,'add_new_seller_for_mandate',$mandate->getIdMandate())}">Affecter
				un autre vendeur</a>
		</p>
		{/if}

		<table class="standard">
			<thead>
				<tr>
					<th>Nom</th>
					<th>Adresse</th>
					<th>Coordonnées</th>
					<th>Principal</th>
					<th>Voir la fiche</th>
					<th>Supprimer l'affectation</th>
				</tr>
			</thead>
			<tbody>
				{foreach from=$mandate->listSellers() item=item}
				<tr>
					<td>{$item->getName()} {$item->getFirstname()}</td>
					<td>
						<p>{if $item->getCity()} {if $item->getCity()->getSector()}
							{$item->getCity()->getSector()->getName()} {/if} {/if}</p>
						<p>{$item->getAddress()}</p>

						<p>{if $item->getCity()} {$item->getCity()->getZipCode()}
							{$item->getCity()->getName()} {/if}</p>
					</td>
					<td>{if $item->getPhone()}
						<p>Téléphone : {$item->getPhone()}</p>{/if} {if
						$item->getMobilPhone()}
						<p>Téléphone portable: {$item->getMobilPhone()}</p>{/if} {if
						$item->getWorkPhone()}
						<p>Téléphone travail: {$item->getWorkPhone()}</p>{/if} {if
						$item->getFax()}
						<p>Fax : {$item->getFax()}</p>{/if} {if $item->getEmail()}
						<p>Email : {$item->getEmail()}</p>{/if}</td>
					<td>{if $item->getIsDefault()}OUI{else}NON {if
						$user->getLevelMember()->getIdLevelMember() < 3 OR
						$user->getIdUser() eq $mandate->getUser()->getIdUser()}
						<form action="" method="post">
							<p>
								<input type="hidden" name="idMandate"
									value="{$mandate->getIdMandate()}" /> <input type="hidden"
									name="idSeller" value="{$item->getIdSeller()}" /> <input
									type="submit" name="sendSellerByDefault"
									value="Définir comme principal" />
							</p>
						</form> {/if} {/if}</td>
					<td><a
						href="{Tools::create_url($user,'seller','sees',$item->getIdSeller())}">Voir</a>
					</td>
					<td>{if $user->getLevelMember()->getIdLevelMember() < 3 OR
						$user->getIdUser() eq $mandate->getUser()->getIdUser()}
						<form action="" method="post">
							<p>
								<input type="hidden" name="idMandate"
									value="{$mandate->getIdMandate()}" /> <input type="hidden"
									name="idSeller" value="{$item->getIdSeller()}" /> <input
									type="submit" value="Supprimer l'affectation"
									name="delete_affectation_seller" />
							</p>
						</form> {else} - {/if}</td>
				</tr>
				{/foreach}

			</tbody>
		</table>
		<hr class="invi clear" />
	</div>
	<div id="plans">
		{if ($user->getLevelMember()->getIdLevelMember() < 3 OR
		$user->getIdUser() eq $mandate->getUser()->getIdUser()) AND
		$mandate->getEtap()->getIdMandateEtap() eq Constant::ID_ETAP_TO_SELL}
		<form
			action="{Tools::create_url($user,$smarty.get.module,$smarty.get.page,$mandate->getIdMandate())}"
			method="post" enctype="multipart/form-data">
			<p>
				<label for="newPlan">Ajouter un plan : <input type="file"
					name="newPlan" id="newPlan" /> </label> <input type="submit"
					value="Envoyer" id="sendPlanForMandate" name="sendPlanForMandate" />
			</p>
		</form>
		{/if}
		<table class="standard">
			<thead>
				<tr>
					<th>Aperçu</th>
					<th>Lien</th>
					<th>Supprimer</th>
				</tr>
			</thead>
			<tbody>
				{foreach from=$mandate->listPlan() item=item}
				<tr>
					<td><img
						src="{Constant::DEFAULT_URL_PICTURE_MODULE_DIRECTORY}/{$smarty.get.module}/thumb/{$item->getName()}"
						alt="" /></td>
					<td><a
						href="{Constant::DEFAULT_URL_PICTURE_MODULE_DIRECTORY}/{$smarty.get.module}/{$item->getName()}"
						target="_blank">Télécharger ( {$item->getCode()} )</a></td>
					<td>{if $user->getLevelMember()->getIdLevelMember() < 3 OR
						$user->getIdUser() eq $mandate->getUser()->getIdUser()}
						<form action="" method="post">
							<p>
								<input type="hidden" name="idMandate"
									value="{$mandate->getIdMandate()}" /> <input type="hidden"
									name="idPlan" value="{$item->getIdMandateScan()}" /> <input
									type="submit" value="Supprimer le plan" name="delete_plan" />
							</p>
						</form> {else} - {/if}</td>
				</tr>
				{/foreach}
			</tbody>
		</table>
	</div>
	<div id="fichiers">{include file="tpl_default/hook.tpl"
		position="hook_files"}</div>
	<div id="impressions">{include file="tpl_default/hook.tpl"
		position="hook_imp"}</div>
	{include file="tpl_default/hook.tpl" position="hook_acq"}

</div>
{include file="tpl_default/hook.tpl" position="hook_bottom"}
</div>
