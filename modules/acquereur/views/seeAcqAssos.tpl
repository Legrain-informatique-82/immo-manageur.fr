{include file="tpl_default/entete.tpl"}
<div class="row bg-success bannerTitle">
    <div class="col-md-6">
        <h1 class="h2">Fiche de l'acquereur associé</h1>
    </div>

    <div class="col-md-6">

        <p class="h4 text-right ">

            <a href="{Tools::create_url($user,$smarty.get.module,'see',$acq->getAcquereur()->getIdAcquereur())}" class="btn-default btn" title="Fermer la fiche">
                <i class="fa fa-close fa-2x"></i>
            </a>

        </p>
    </div>
</div>


<div class="row">
    <div class="col-md-4">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">Infos  acquereur</h3>
            </div>
            <div class="panel-body">
                <dl>
                    <dt>Prénom &amp; nom :</dt><dd>{$acq->getFirstname()} {$acq->getName()} </dd>
                    {if $acq->getMaidenName()}
                        <dt>Nom de jeune fille :</dt><dd> {$acq->getMaidenName()}</dd>
                    {/if}
                    <dt>Adresse :</dt>
                    <dd>
                        <address>
                            {$acq->getAddress()} <br />
                            {$acq->getCity()->getZipCode()}
                            {$acq->getCity()->getName()}
                        </address>
                    </dd>
                    <dt>Date de naissance : </dt><dd>{if $acq->getBirthdate()}{date(Constant::DATE_FORMAT2,$acq->getBirthdate())}{else}NC{/if} </dd>
                    <dt>Lieu de naissance :</dt><dd> {if $acq->getBirthLocation()}{$acq->getBirthLocation()}{else}NC{/if}</dd>
                    <dt>Nationalité :</dt><dd> {if $acq->getNationality()}{$acq->getNationality()}{else}NC{/if}</dd>
                    <dt>Profession : </dt><dd>{if $acq->getJob()}{$acq->getJob()}{else}NC{/if}</dd>
                </dl>
            </div>
        </div>

    </div>

    <div class="col-md-4">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">Coordonnées acquereur</h3>
            </div>
            <div class="panel-body">
                <dl>
                    <dt>Tél. fixe :</dt><dd> {if $acq->getPhone()}{$acq->getPhone()}{else}NC{/if}</dd>
                    <dt>Tél. mobile : </dt><dd>{if $acq->getCellPhone()}{$acq->getCellPhone()} <a href="{Constant::DEFAULT_URL}/modules/openmail/formFancybox/sendSms.php?{time()}&amp;dest={str_replace('+','%2B',$acq->getCellPhone())}" class="fancyboxAjax fancybox.ajax btn btn-default" title="Envoyer un sms"> <i class="fa fa-2x fa-mobile-phone"></i>    </a>{else}NC{/if}</dd>
                    <dt>Tél. du travail :</dt><dd> {if $acq->getWorkPhone()}{$acq->getWorkPhone()}{else}NC{/if}</dd>
                    <dt>Fax :</dt><dd> {if $acq->getFax()}{$acq->getFax()}{else}NC{/if}</dd>
                    <dt>Email :</dt><dd>{if $acq->getEmail()}{$acq->getEmail()} <a href="{Constant::DEFAULT_URL}/modules/openmail/formFancybox/sendEmail.php?{time()}&amp;dest={$acq->getEmail()}" class="fancyboxAjax fancybox.ajax btn btn-default" title="Envoyer un e-mail"> <i class="fa fa-paper-plane"></i></a>{else}NC{/if}</dd>
                </dl>


            </div>
        </div>


    </div>
    <div class="col-md-3">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">Situation de famille ( acquereur principal)</h3>
            </div>
            <div class="panel-body">
                <dl>
                    {if $situationFamille}


                        <dt>Situation : </dt><dd>{$situationFamille->getSituationAcquereur()->getName()}</p></dd>
                        {if $situationFamille->getSituationAcquereur()->getIfEventDate()} <dt>Le :</dt><dd> {date(Constant::DATE_FORMAT2,$situationFamille->getEventDate())}</dd>{/if}
                        {if $situationFamille->getSituationAcquereur()->getIfEventLocation()}<dt>À :</dt><dd> {$situationFamille->getEventLocation()}</dd>{/if}

                    {else}
                        <dt>Situation : </dt><dd>NC</p></dd>
                    {/if}
                </dl>



            </div>
        </div>


    </div>

</div>
{if $acq->getComment() && $acq->getComment() neq ''}
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">Commentaire</h3>
        </div>
        <div class="panel-body">
            {$acq->getComment()}
        </div>
    </div>

{/if}


{* ajout du sous module avec les mandats correspondants aux
critères *}
{include file="tpl_default/hook.tpl" position="hook_content_bottom"}
</div>
