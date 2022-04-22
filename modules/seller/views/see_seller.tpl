{include file="tpl_default/entete.tpl"}



<div class="row bg-success bannerTitle">
    <div class="col-md-6">
        <h1 class="h2">{Lang::LABEL_SELLER_SEE_H1}</h1>
    </div>

    <div class="col-md-6">
        <p class="h4 text-right ">


            {if $seller->getUser()->getIdUser() eq $user->getIdUser() || $user->getLevelMember()->getIdLevelMember() < 3}
                <a href="{$urlUpdate}" title="{Lang::LABEL_UPDATE}" class="btn btn-warning">
                    <i class="fa fa-pencil-square-o fa-2x"></i>
                </a>

                <a href="{$urlDelete}" title="{Lang::LABEL_DELETE}" class="btn btn-danger">
                    <i class="fa fa-trash fa-2x"></i>
                </a>
            {/if}
            <a title="Fermer la fiche" class="btn btn-default" href="{Tools::create_url($user,"seller","lists")}">
                <i class="fa fa-close fa-2x"></i>
            </a>
        </p>
    </div>
</div>

<div class="row">
    <div class="col-md-4">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">Général</h3>
            </div>
            <div class="panel-body">
                <dl class="dl-horizontal">
                    <dt>{Lang::LABEL_SELLER_ADD_TITLE}</dt>
                    <dd>{$seller->getSellerTitle()->getLibel()}</dd>
                    <dt>{Lang::LABEL_SELLER_ADD_NAME}</dt>
                    <dd>{$seller->getName()}</dd>
                    <dt>{Lang::LABEL_SELLER_ADD_FIRSTNAME}</dt>
                    <dd>{$seller->getFirstname()}</dd>
                    <dt>{Lang::LABEL_SELLER_ADD_ADDRESS}</dt>
                    <dd>{$seller->getAddress()}<br/>{$seller->getCity()->getZipCode()} {$seller->getCity()->getName()}</dd>
                </dl>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">Coordonnés</h3>
            </div>
            <div class="panel-body">
                <dl class="dl-horizontal">
                    <dt>{Lang::LABEL_SELLER_ADD_PHONE}</dt><dd> {$seller->getPhone()}</dd>
                    <dt>{Lang::LABEL_SELLER_ADD_MOBIL_PHONE}</dt><dd> {$seller->getMobilPhone()} {if $seller->getMobilPhone()}<a href="{Constant::DEFAULT_URL}/modules/openmail/formFancybox/sendSms.php?{time()}&amp;dest={str_replace('+','%2B',$seller->getMobilPhone())}" class="fancyboxAjax fancybox.ajax btn btn-default" title="Envoyer un SMS"> <i class="fa fa-mobile-phone fa-2x"></i>  </a> {/if}</dd>
                    <dt>{Lang::LABEL_SELLER_ADD_WORK_PHONE}</dt><dd> {$seller->getWorkPhone()}</dd>
                    <dt>{Lang::LABEL_SELLER_ADD_FAX}</dt><dd> {$seller->getFax()}</dd>
                    <dt>{Lang::LABEL_SELLER_ADD_EMAIL} </dt><dd>{if $seller->getEmail()}{$seller->getEmail()} <a href="{Constant::DEFAULT_URL}/modules/openmail/formFancybox/sendEmail.php?{time()}&amp;dest={$seller->getEmail()}" class="fancyboxAjax fancybox.ajax btn btn-default" title="Envoyer un e-mail"> <i class="fa fa-paper-plane"></i></a>{/if}</dd>
                </dl>

            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">Divers</h3>
            </div>
            <div class="panel-body">
                <dl class="dl-horizontal">
                    <dt>{Lang::LABEL_SELLER_ADD_COMMENT}</dt><dd> {$seller->getComments()}</dd>
                    <dt>Possède un compte <br/>client sur <br/> le site vitrine ? </dt><dd>{if $seller->getVitrine_account()}Oui{else}Non{/if}</dd>
                    <dt>Etat </dt><dd> {if $seller->getAsset() eq 1}Actif{else}Inactif{/if}</dd>
                </dl>
            </div>
        </div>
    </div>
</div>




{* Ajouter le hook permettant l'affichage de la liste des mandats
associés *} {include file="tpl_default/hook.tpl"
position="hook_fin_corps_droite"}
</div>