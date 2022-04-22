{include file="tpl_default/entete.tpl"}


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
{/if} {* Si le mandat n'est pas à vendre, on peut le réactualiser. (pere
et admin ? ou tout le monde ?) *} {if
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
{/if} {if ($user->getLevelMember()->getIdLevelMember() < 3 OR
$user->getIdUser() eq $mandate->getUser()->getIdUser()) AND
$mandate->getEtap()->getIdMandateEtap() eq Constant::ID_ETAP_TO_SELL}
<h1>Info du mandat :</h1>
<p>
	<a
		href="{Tools::create_url($user,$smarty.get.module,'update',$smarty.get.action)}">Mettre
		à jour les informations de base.</a>
</p>
{/if} {if ($user->getLevelMember()->getIdLevelMember() < 3 OR
$user->getIdUser() eq $mandate->getUser()->getIdUser() ) AND
$mandate->getEtap()->getIdMandateEtap() eq Constant::ID_ETAP_TO_SELL}
<h1>Informations complèmentaires :</h1>
<p>
	<a
		href="{Tools::create_url($user,$smarty.get.module,'updateComplementaryInformation',$smarty.get.action)}">Mettre
		à jour les informations complèmentaires</a>
</p>
{/if}

<div id="tabs">
	<ul>

		<li><a href="#tab-2">Localisation</a></li>
		<li><a href="#tab-1">Général</a></li>
		<li><a href="#tab-3">Cadastre</a></li>
		<li><a href="#tab-4">Prix</a></li>
		<li><a href="#tab-5">DPE</a></li>
		<li><a href="#tab-6">Info du bien</a></li>
		<li><a href="#tab-7">Description</a></li>
	</ul>

	<div id="tab-2">
		<!-- <h2>Localisation</h2> -->
		<div class="mSep">
			<p>Secteur : {$mandate->getCity()->getSector()->getName()}</p>
			<p>Adresse : {$mandate->getAddress()}</p>
			<p>Ville : {$mandate->getCity()->getName()}</p>
			<p>Code Postal : {$mandate->getCity()->getZipCode()}</p>
			{if $mandate->getGeolocalisation()} {assign var="geo"
			value=explode(',',$mandate->getGeolocalisation())}
			<p>
				Latitude : <span id="latitude">{$geo.0}</span>
			</p>
			<p>
				Longitude : <span id="longitude">{$geo.1}</span>
			</p>
			{/if}
		</div>

		{if $mandate->getGeolocalisation()}
		<div class="mSep">
			<p>Geoloc :</p>

			<div id="map"></div>

		</div>
		{/if}
		<hr class="invi clear" />

	</div>

	{*
	<h2>Général :</h2>
	*}
	<div id="tab-1">
		<p>Nature du bien : {if
			$mandate->getNature()==null}NC{else}{$mandate->getNature()->getName()}{/if}</p>
		<p>Utilisateur affecté : {$mandate->getUser()->getName()}
			{$mandate->getUser()->getFirstname()}</p>
		<p>Notaire : {$mandate->getNotary()->getName()}</p>
		<p>N° Mandat : {$mandate->getNumberMandate()}</p>
		<p>Début : {date(Constant::DATE_FORMAT2,$mandate->getInitDate())}</p>
		<p>Fin : {if date(Constant::DATE_FORMAT2,$mandate->getDeadDate()) eq
			'01/01/1970'} NC
			{else}{date(Constant::DATE_FORMAT2,$mandate->getDeadDate())}{/if}</p>
		<p>libre le : {if $mandate->getFreeDate()==null} NC
			{else}{date(Constant::DATE_FORMAT2,$mandate->getFreeDate())}{/if}</p>
		<p>Type transaction : {$mandate->getTransactionType()->getName()}</p>
		<p>Type de bien : {$mandate->getMandateType()->getName()}</p>
	</div>

	<div id="tab-3">
		<!--<h2>Cadastre : </h2>-->
		<p>Ref cadastre parcelle 1 :
			{$mandate->getReferenceCadastreParcelle1()}</p>
	</div>
	<div id="tab-4">
		<!-- <h2>Prix : </h2>-->

		<p>Prix FAI : {Tools::grosNombre(round($mandate->getPriceFAI(),0))}
			&euro;</p>
		<p>Prix net vendeur :
			{Tools::grosNombre(round($mandate->getPriceSeller(),0))} &euro;</p>
		<p>Commission :
			{Tools::grosNombre(round($mandate->getCommission(),0))} &euro;</p>
		<p>Estimation FAI :
			{Tools::grosNombre(round($mandate->getEstimationFai(),0))} &euro;</p>
		<p>Marge negoce :
			{Tools::grosNombre(round($mandate->getMargeNegociation(),0))} &euro;</p>
	</div>


	<div id="tab-5">{include file="tpl_default/hook.tpl"
		position="hook_center"}</div>
	{*
	<h2>Superficie</h2>
	<p>Superficie parcelle 1 :{if $mandate->getSuperficieParcelle1() eq
		0}NC{else} {$mandate->getSuperficieParcelle1()}{/if}</p>
	<p>Superficie parcelle 2 :{if $mandate->getSuperficieParcelle2() eq
		0}NC{else} {$mandate->getSuperficieParcelle2()}{/if}</p>
	<p>Superficie parcelle 3 : {if $mandate->getSuperficieParcelle3() eq
		0}NC{else}{$mandate->getSuperficieParcelle3()}{/if}</p>
	<p>Superficie autres parcelle : {if
		$mandate->getSuperficieAutreParcelle() eq
		0}NC{else}{$mandate->getSuperficieAutreParcelle()}{/if}</p>
	<p>Superficie constructible : {if
		$mandate->getSuperficieConstructible() eq
		0}NC{else}{$mandate->getSuperficieConstructible()}{/if}</p>
	<p>Superficie non constructible : {if
		$mandate->getSuperficieNonConstructible() eq
		0}NC{else}{$mandate->getSuperficieNonConstructible()}{/if}</p>
	<p>Superficie totale : {if $mandate->getSuperficieTotale() eq
		0}NC{else}{$mandate->getSuperficieTotale()}{/if}</p>
	<p>géometre : {if
		$mandate->getGeometer()}{$mandate->getGeometer()->getName()}{else}NC{/if}
	</p>
	<p>Bornage : {if
		$mandate->getBornageTerrain()}{$mandate->getBornageTerrain()->getName()}{else}NC{/if}</p>
	*} {*
	<h2>Réglementation</h2>
	<p>Zonage PLU : {if
		$mandate->getZonagePlu()}{$mandate->getZonagePlu()->getName()}{else}NC{/if}</p>
	<p>Zonage RNU : {if
		$mandate->getZonageRnu()}{$mandate->getZonageRnu()->getName()}{else}NC{/if}</p>
	<p>COS : {if
		$mandate->getCOS()}{$mandate->getCOS()->getName()}{else}NC{/if}</p>
	<p>Shon accordée : {$mandate->getsHONAccordee()}</p>
	<p>Zone BDF : {if $mandate->getZoneBDF() eq 0}NON{else}OUI{/if}</p>
	<p>Ligne de crete : {if $mandate->getLigneDeCrete() eq
		0}NON{else}OUI{/if}</p>
	<p>zone inondable : {if $mandate->getZoneInondable() eq
		0}NON{else}OUI{/if}</p>
	<p>
		Réglement lotissement : {if $mandate->getReglementDeLotissement()} <br />{$mandate->getReglementDeLotissement()}{/if}
	</p>
	<p>
		ERNT : {if $mandate->getERNT()}<br />{$mandate->getERNT()}{/if}
	</p>
</div>
*}

<div id="tab-6">
	<!--<h2>Info du bien</h2>-->
	<div class="mSep">
		<p>Nombre de pièces : {$mandate->getNbPiece()}</p>
		<p>Nombre de chambres : {$mandate->getNbChambre()}</p>
		<p>Superficie totale : {if $mandate->getSuperficieTotale() eq
			0}NC{else}{$mandate->getSuperficieTotale()}{/if}</p>
		<p>Surface habitable : {$mandate->getSurfaceHabitable()}</p>
		<p>Surface pièce vie : {$mandate->getSurfacePieceVie()}</p>
		<p>Niveau : {$mandate->getNiveau()}</p>
		<p>Année construction : {if
			$mandate->getAnneeConstruction()==0}NC{else}{$mandate->getAnneeConstruction()}{/if}</p>
		<p>Coup de coeur : {if $mandate->getCoupCoeur()}Oui{else}Non{/if}</p>
		<p>Charges mensuelles : {$mandate->getChargesMensuelle()}</p>
		<p>Taxes foncières : {$mandate->getTaxesFonciere()}</p>
		<p>Taxes Habitation : {$mandate->getTaxeHabitation()}</p>
		<p>Cheminée :{if $mandate->getCheminee() eq 1}Oui{else}Non{/if}</p>
		<p>Cuisine équipée : {if $mandate->getCuisineEquipee() eq
			1}Oui{else}Non{/if}</p>
		<p>Cuisine amenagée : {if $mandate->getCuisineAmenagee() eq
			1}Oui{else}Non{/if}</p>
		<p>Piscine : {if $mandate->getPiscine() eq 1}Oui{else}Non{/if}</p>
		<p>Piscine intérieure : {if $mandate->getPoolHouse() eq
			1}Oui{else}Non{/if}</p>
		<p>Terrasse : {if $mandate->getTerrasse() eq 1}Oui{else}Non{/if}</p>
		<p>Mezzanine : {if $mandate->getMezzanine() eq 1}Oui{else}Non{/if}</p>
	</div>
	<div class="mSep">
		<p>Dépendance : {if $mandate->getDependance() eq 1}Oui{else}Non{/if}</p>
		<p>Gaz : {if $mandate->getGaz() eq 1}Oui{else}Non{/if}</p>
		<p>Cave : {if $mandate->getCave() eq 1}Oui{else}Non{/if}</p>
		<p>Sous sol : {if $mandate->getSousSol() eq 1}Oui{else}Non{/if}</p>
		<p>Garage : {if $mandate->getGarage() eq 1}Oui{else}Non{/if}</p>
		<p>Parking : {if $mandate->getParking() eq 1}Oui{else}Non{/if}</p>
		<p>Rez de jardin : {if $mandate->getRezDeJardin() eq
			1}Oui{else}Non{/if}</p>
		<p>Plain pied : {if $mandate->getPlainPied() eq 1}Oui{else}Non{/if}</p>
		<p>Carrière : {if $mandate->getCarriere() eq 1}Oui{else}Non{/if}</p>
		<p>Point eau : {if $mandate->getPointEau() eq 1}Oui{else}Non{/if}</p>
		<p>Isolation : {if
			$mandate->getInsulation()}{$mandate->getInsulation()->getName()}{else}Non
			spécifié{/if}</p>
		<p>Toiture : {if
			$mandate->getRoof()}{$mandate->getRoof()->getName()}{else}Non
			spécifié{/if}</p>
		<p>Chauffage : {if
			$mandate->getHeating()}{$mandate->getHeating()->getName()}{else}Non
			spécifié{/if}</p>
		<p>Parties communes : {if
			$mandate->getCommonOwnership()}{$mandate->getCommonOwnership()->getName()}{else}Non
			spécifié{/if}</p>
		<p>Type de construction : {if
			$mandate->getConstruction()}{$mandate->getConstruction()->getName()}{else}Non
			spécifié{/if}</p>
		<p>Style : {if
			$mandate->getStyle()}{$mandate->getStyle()->getName()}{else}Non
			spécifié{/if}</p>
		<p>Nouveautés : {if
			$mandate->getNews()}{$mandate->getNews()->getName()}{else}Non
			spécifié{/if}</p>
		<p>Conditions : {if
			$mandate->getCondition()}{$mandate->getCondition()->getName()}{else}Non
			spécifié{/if}</p>
	</div>
	<hr class="clear invi" />
</div>
{*
<h2>Autorisation</h2>
<p>DP valide : {if $mandate->getDPValide()}Oui{else}Non{/if}</p>
<p>Date déclaration préalable : {if
	$mandate->getDateDeclarationPrealable()}{date(Constant::DATE_FORMAT2,$mandate->getDateDeclarationPrealable())}{else}NC{/if}</p>
<p>Prorogation DP jusqu'au :{if
	$mandate->getProrogationDPJusquau()}{date(Constant::DATE_FORMAT2,$mandate->getProrogationDPJusquau())}{else}NC{/if}</p>
<p>CU valide : {if $mandate->getCuValide()}Oui{else}Non{/if}</p>
<p>Date déclaration préalable : {if
	$mandate->getDateCu()}{date(Constant::DATE_FORMAT2,$mandate->getDateCu())}{else}NC{/if}</p>
<p>Prorogation CU jusqu'au : {if
	$mandate->getProrogationCUJusquau()}{date(Constant::DATE_FORMAT2,$mandate->getProrogationCUJusquau())}{else}NC{/if}</p>
<p>CU Ops valide : {if $mandate->getCuOpsValide()}Oui{else}Non{/if}</p>
<p>Date déclaration préalable : {if
	$mandate->getDateCuOps()}{date(Constant::DATE_FORMAT2,$mandate->getDateCuOps())}{else}NC{/if}</p>
<p>Prorogation CU Ops jusqu'au : {if
	$mandate->getProrogationCUOpsJusquau()}{date(Constant::DATE_FORMAT2,$mandate->getProrogationCUOpsJusquau())}{else}NC{/if}</p>
<p>Permis d'amenager valide : {if
	$mandate->getPermisDamenagerValide()}Oui{else}Non{/if}</p>
<p>Date de permis d'amenager : {if
	$mandate->getDatePermisDamenager()}{date(Constant::DATE_FORMAT2,$mandate->getDatePermisDamenager())}{else}NC{/if}</p>
*} {*
<h2>Viabilisation</h2>
<p>Terrain vendu viabilisé : {if
	$mandate->getTerrainVenduViabilise()}Oui{else}Non{/if}</p>
<p>Terrain vendu semi viabilisé : {if
	$mandate->getTerrainVenduSemiViabilise()}Oui{else}Non{/if}</p>
<p>Terrain vendu non viabilisé : {if
	$mandate->getTerrainVenduNonViabilise()}Oui{else}Non{/if}</p>
<p>
	Passage eau : {if $mandate->getPassageEau()}<br />{$mandate->getPassageEau()}{/if}
</p>
<p>Correspondant eau : {if
	$mandate->getWaterCorresponding()}{$mandate->getWaterCorresponding()->getName()}{else}NC{/if}</p>
<p>
	Passage éléctricité : {if $mandate->getPassageElectricite()}<br />{$mandate->getPassageEau()}{/if}
</p>
<p>Correspondant electrique : {if
	$mandate->getElectricCorresponding()}{$mandate->getElectricCorresponding()->getName()}{else}NC{/if}</p>
<p>
	Passage gaz : {if $mandate->getPassageGaz()}<br />{$mandate->getPassageGaz()}{/if}
</p>
<p>Correspondant gaz : {if
	$mandate->getGazCorresponding()}{$mandate->getGazCorresponding()->getName()}{else}NC{/if}</p>
<p>Tout à l'égout : {if $mandate->getToutALegout()}Oui{else}Non{/if}</p>
<p>Assainissement par fosse sceptique : {if
	$mandate->getAssainissementParFosseSceptique()}Oui{else}Non{/if}</p>
<p>Correspondant sanitaire : {if
	$mandate->getSanitationCorresponding()}{$mandate->getSanitationCorresponding()->getName()}{else}NC{/if}</p>
<p>
	Voirie : {if $mandate->getVoirie()}<br />{$mandate->getVoirie()}{/if}
</p>
*}
<div id="tab-7">
	{*
	<h2>Description</h2>
	*}
	<p>Orientation : {if
		$mandate->getOrientation()}{$mandate->getOrientation()->getName()}{else}NC{/if}</p>
	<p>Pente : {if
		$mandate->getSlope()}{$mandate->getSlope()->getName()}{else}NC{/if}</p>
	<p>Taille de la façade : {if
		$mandate->getTailleFacade()}{$mandate->getTailleFacade()}{else}NC{/if}</p>
	<p>Profondeur du terrain : {if
		$mandate->getProfondeurTerrain()}{$mandate->getProfondeurTerrain()}{else}NC{/if}</p>
	{if $mandate->getCommentaire()}
	<p>
		Commentaires : <br />{$mandate->getCommentaire()}
	</p>
	{/if}
	<p>Proximité école : {if $mandate->getProximiteEcole() eq
		0}NC{else}{$mandate->getProximiteEcole()} {/if}</p>
	<p>Proximité commerce : {if $mandate->getProximiteCommerce() eq
		0}NC{else}{$mandate->getProximiteCommerce()} {/if}</p>
	<p>Proximité transport :{if $mandate->getProximiteTransport() eq
		0}NC{else}{$mandate->getProximiteTransport()} {/if}</p>
	{if $mandate->getCommentaireApparent()}
	<p>Texte vitrine (et Internet) : {$mandate->getCommentaireApparent()}</p>
	{/if}
</div>
</div>
{* Fin *}
<h1 class="clear">Vendeurs :</h1>
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
<h1>Photos :</h1>
{if $errorPicture}
<ul>
	{foreach from=$errorPicture item=e}
	<li class="error">{$e}</li> {/foreach}
</ul>
{/if} {if ($user->getLevelMember()->getIdLevelMember() < 3 OR
$user->getIdUser() eq $mandate->getUser()->getIdUser()) AND
$mandate->getEtap()->getIdMandateEtap() eq Constant::ID_ETAP_TO_SELL}
<form
	action="{Tools::create_url($user,$smarty.get.module,$smarty.get.page,$mandate->getIdMandate())}"
	method="post" enctype="multipart/form-data">
	<input type="hidden" id="idMandate" name="idMandate"
		value="{$mandate->getIdmandate()}" /> <input type="hidden" id="idSess"
		name="idSess" value="{str_rot13(session_id())}" />
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
<table class="standard">
	<thead>
		<tr>
			<th>Image</th>
			<th>Principale</th>
			<th>Supprimer</th>
		</tr>
	</thead>
	<tbody>
		{foreach from=$mandate->listPictures() item=item}
		<tr>
			<td><img
				src="{Constant::DEFAULT_URL_PICTURE_MODULE_DIRECTORY}/{$smarty.get.module}/thumb/{$item->getName()}"
				alt="" /></td>
			<td>{if $item->getIsDefault()}OUI{else}
				<p>NON</p> {if $user->getLevelMember()->getIdLevelMember() < 3 OR
				$user->getIdUser() eq $mandate->getUser()->getIdUser()}
				<form action="" method="post">
					<p>
						<input type="hidden" name="idMandate"
							value="{$mandate->getIdMandate()}" /> <input type="hidden"
							name="idPicture" value="{$item->getIdMandatePicture()}" /> <input
							type="submit" name="sendPictureByDefault"
							value="Définir comme principale" />
					</p>
				</form> {/if} {/if}</td>
			<td>{if ($user->getLevelMember()->getIdLevelMember() < 3 OR
				$user->getIdUser() eq $mandate->getUser()->getIdUser()) AND
				$mandate->getEtap()->getIdMandateEtap() eq
				Constant::ID_ETAP_TO_SELL}
				<form action="" method="post">
					<p>
						<input type="hidden" name="idMandate"
							value="{$mandate->getIdMandate()}" /> <input type="hidden"
							name="idPicture" value="{$item->getIdMandatePicture()}" /> <input
							type="submit" value="Supprimer l'image" name="delete_picture" />
					</p>
				</form> {else} - {/if}</td>
		</tr>
		{/foreach}
	</tbody>
</table>
<h1>Liste des plans</h1>
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
{include file="tpl_default/hook.tpl" position="hook_bottom"}
</div>
