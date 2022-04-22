
    <li class="divider"></li>

    {if $phonenumber}
        <li><a href="{Constant::DEFAULT_URL}/modules/openmail/formFancybox/sendSms.php?{time()}&amp;dest={str_replace('+','%2B',$phonenumber)}" class="fancyboxAjax fancybox.ajax"><i class="fa fa-mobile "></i> Envoyer un Sms</a></li>
        {else}
        <li class="disabled"><a href="javascript:return false;"><i class="fa fa-mobile "></i> Envoyer un Sms</a></li>
    {/if}
    {if $email}
        <li><a href="{Constant::DEFAULT_URL}/modules/openmail/formFancybox/sendEmail.php?{time()}&amp;dest={$email}" class="fancyboxAjax fancybox.ajax"><i class="fa fa-paper-plane"></i> Envoyer un Email</a></li>
    {else}
        <li class="disabled"><a href="javascript:return false;"><i class="fa fa-paper-plane"></i> Envoyer un Email</a></a></li>
    {/if}
