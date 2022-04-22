{include file="tpl_default/entete.tpl"}
<h1>{Lang::LABEL_SELLER_SEE_H1}</h1>
{if $seller->getUser()->getIdUser eq $user->getIdUser() ||
$user->getLevelMember()->getIdLevelMember() < 3}
<a href="{$urlUpdate}">{Lang::LABEL_UPDATE}</a>
-
<a href="{$urlDelete}">{Lang::LABEL_DELETE}</a>
{/if}
<p>{Lang::LABEL_SELLER_ADD_TITLE}
	{$seller->getSellerTitle()->getLibel()}</p>
<p>{Lang::LABEL_SELLER_ADD_NAME} {$seller->getName()}</p>
<p>{Lang::LABEL_SELLER_ADD_FIRSTNAME} {$seller->getFirstname()}</p>
<p>{Lang::LABEL_SELLER_ADD_ADDRESS} {$seller->getAddress()}</p>
<p>{$seller->getCity()->getZipCode()} {$seller->getCity()->getName()}</p>
<p>{Lang::LABEL_SELLER_ADD_PHONE} {$seller->getPhone()}</p>
<p>{Lang::LABEL_SELLER_ADD_MOBIL_PHONE} {$seller->getMobilPhone()}</p>
<p>{Lang::LABEL_SELLER_ADD_WORK_PHONE} {$seller->getWorkPhone()}</p>
<p>{Lang::LABEL_SELLER_ADD_FAX} {$seller->getFax()}</p>
<p>{Lang::LABEL_SELLER_ADD_EMAIL} {$seller->getEmail()}</p>
<p>{Lang::LABEL_SELLER_ADD_COMMENT} {$seller->getComments()}</p>
<p>Etat : {if $seller->getAsset() eq 1}Actif{else}Inactif{/if}</p>

{* Ajouter le hook permettant l'affichage de la liste des mandats
associés *} {include file="tpl_default/hook.tpl"
position="hook_fin_corps_droite"}
</div>
