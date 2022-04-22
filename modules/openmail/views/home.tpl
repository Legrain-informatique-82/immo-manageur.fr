{include file="tpl_default/entete.tpl"}
<div class="row bg-success bannerTitle">
    <div class="col-md-12">
        <h1 class="h2">Open-Mail : Solde de vos services</h1>
    </div>
</div>
{*

*}
<div class="row">
    <div class="col-xs-6">
        {if $smsCreditleft !== "error"}
        <div class="panel panel-default">
            <div class="panel-heading">
                Sms
            </div>
            <div class="panel-body">
                <p>Solde : {Tools::grosNombre($smsCreditleft)}</p>
            </div>
        </div>
    </div>
    {/if}
    {*
    {if $faxCreditleft !== 'error'}
        <p class="mSep">
            fax restants : {Tools::grosNombre($faxCreditleft)} en euros
        </p>
    {/if}
    *}
    {if $emailCreditleft !== 'error'}
        <div class="col-xs-6">
            <div class="panel panel-default">
                <div class="panel-heading">
                    E-mail
                </div>
                <div class="panel-body">
                    <p>Solde : {Tools::grosNombre($emailCreditleft)}</p>
                </div>
            </div>
        </div>
    {/if}
</div>

<p>
    <a href="http://app1.openmail.fr" class="btn btn-default" target="_blank">
        <i class="fa fa-money"></i> Approvisionner votre compte
    </a>
</p>
</div>
