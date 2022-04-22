<!doctype html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>{$title}</title>
</head>
<body id="bodyAjax">
{include file="openmail/views/form_send_sms.tpl"}
<script>
    $(document).ready(function(){
        $(".dateTimepicker").datetimepicker({
            timeOnlyTitle : 'Choix de l\'heure',
            timeText : 'à',
            hourText : 'Heures : ',
            minuteText : 'Minutes : ',
            secondText : 'Secondes : ',
            currentText : 'Maintenant',
            closeText : 'Fermer',
            showSecond : false,
            timeFormat : 'hh:mm:ss'

        }).attr('autocomplete', 'off');

        $("#ajaxFormSendSms").bind("submit", function() {
                // Verification des champs
            $('.changebtnPaperPlane').addClass('disabled');
            $('.changebtnPaperPlane > i').removeClass('fa-paper-plane').addClass('fa-spinner fa-spin');

            $.ajax({
                type : "POST",
                cache : false,
                url: "../../modules/openmail/ajax/sendSmsFormProcessing.php",
                data: $(this).serializeArray(),
                success:function(data){

                    var obj = jQuery.parseJSON( data );
                    if(obj.result){
                    $.fancybox('<h1>Open mail - Sms</h1><p>'+obj.errors[0]+'</p>');

                    }else{
                        $('.changebtnPaperPlane').removeClass('disabled');
                        $('.changebtnPaperPlane > i').addClass('fa-paper-plane').removeClass('fa-spinner fa-spin');
                        // Affiches les erreurs
                        $('#blocE').remove();


                       var htmlErrors='<div class="alert alert-danger" role="alert"><ul>';
                        for (var i = 0; i < obj.errors.length; i++) {
                            htmlErrors+='<li class="error">' + obj.errors[i] + '</li>';
                        }
                        htmlErrors+='</ul></div>';
                        $('<div id="blocE">'+htmlErrors+'</div>').insertAfter("#seeError ");

                    }
                }
            });

        return false;
        });
    });
</script>
</body>
</html>