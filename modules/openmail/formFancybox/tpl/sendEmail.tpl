<!doctype html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>{$title}</title>
    {*<link rel="stylesheet" href="{Constant::DEFAULT_URL}/libs/plupload/js/jquery.ui.plupload/css/jquery.ui.plupload.css"/>*}

</head>
<body id="bodyAjax">
{include file="openmail/views/form_send_email.tpl"}
{*
    $this->css[]="../../../libs/plupload/js/jquery.ui.plupload/css/jquery.ui.plupload.css";
    $this->js[]="../../../libs/plupload/js/plupload.full.min.js";
    $this->js[]="../../../libs/plupload/js/jquery.ui.plupload/jquery.ui.plupload.js";
$this->js[]="../../../libs/plupload/js/i18n/fr.js";
$this->js[]="sendEmail.js";*}
{*
<script type="text/javascript" src="{Constant::DEFAULT_URL}/libs/plupload/js/plupload.full.min.js"></script>
<script type="text/javascript" src="{Constant::DEFAULT_URL}/libs/plupload/js/jquery.ui.plupload/jquery.ui.plupload.js"></script>
<script type="text/javascript" src="{Constant::DEFAULT_URL}/libs/plupload/js/i18n/fr.js"></script>
<script type="text/javascript" src="{Constant::DEFAULT_URL}/modules/openmail/js/sendEmail.js"></script>
*}
<script type="text/javascript" src="{Constant::DEFAULT_URL}/libs/plupload/js/i18n/fr.js"></script>
<script>
    $(document).ready(function(){

        // appel de ckeditor
        {literal}
        // Si l'editeur existe déjà, on le supprime avant de le recreer.
        var editor = CKEDITOR.instances['message'];
       // if (editor) { editor.destroy(true); }
        $( 'textarea.editor' ).ckeditor(function() { /*toolbar : 'Classique'*/ }, {toolbar : 'Classique' } );
        {/literal}

// Appel du plupload



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

        /*********************************
         *   Gestionnaire upload
         ******************************/

        $("#uploader").pluploadQueue({


            //container : $('#uploader').data('token'),
            // General settings
            runtimes : 'html5,silverlight,flash,gears,html4',
            url : $('#uploader').data('script')+"uploadPj.php?token="+$('#uploader').data('token'),

            // User can upload no more then 20 files in one go (sets multiple_queues to false)

//      max_file_count: 20,
            max_file_size:'10mb',
            chunk_size: '10mb',

            // Resize images on clientside if we can
            /*
             resize : {
             width : 200,
             height : 200,
             quality : 90,
             crop: true // crop to exact dimensions
             },
             */
            filters : {
                // Maximum file size
                max_file_size : '10mb'
            },

            // Rename files by clicking on their titles
            rename: true,

            // Sort files
            sortable: true,

            // Enable ability to drag'n'drop files onto the widget (currently only HTML5 supports that)
            dragdrop: true,
            multiple_queues:true,
            // Views to activate
            views: {
                list: true,
                thumbs: true, // Show thumbs
                active: 'thumbs'
            },

            // Flash settings
            flash_swf_url : $('#uploader').data('btn')+'/js/Moxie.swf',

            // Silverlight settings
            silverlight_xap_url : $('#uploader').data('btn')+'/js/Moxie.xap',

            init: {

                FilesAdded: function(up, files) {},
                UploadComplete: function(up, files) {
                    $('.plupload_filelist_content').empty();
//
                    //alert(files.name);
                    // console.log(up);
//                Lancer appel AJAX récuperent le contenu de la session pour ce token

                    $.post(  $('#uploader').data('script')+'loadpj.php', { token: $('#uploader').data('token')  } ,function( data ) {
                        $( "#pj" ).html( data );
                    });

                }
            }

        });



        $( "body" ).on( "click", "#submitDeleteSendEmail", function() {
            $.ajax({
                type : "POST",
                cache : false,
                url: "../../modules/openmail/ajax/deletePjEmailFormProcessing.php",
                data: $("#ajaxFormSendEmail").serializeArray(),
                success:function(data){
                        $( "#pj" ).html( data );
                }
            });
            return false;
        });

       $('#submitSendEmail,#submitSendEmail2').click(function(){

           $('#submitSendEmail,#submitSendEmail2').addClass('disabled');
           $('#submitSendEmail > i,#submitSendEmail2 > i').removeClass('fa-paper-plane').addClass('fa-spinner fa-spin');
           var uploader = $('#uploader').pluploadQueue();
           if (uploader.files.length > 0) {

               if (uploader.files.length > (uploader.total.uploaded + uploader.total.failed)) {
                   res = uploader.files.length - (uploader.total.uploaded + uploader.total.failed);
                   if (res == 1) {
                       msg = res
                       + ' pièce jointe n\'a pas été associée.' +
                       ' Souhaitez-vous quand même envoyer votre e-mail sans celle-ci ? ';
                   } else {
                       msg = res
                       + ' pièces jointes n\'ont pas été associées.' +
                       ' Souhaitez-vous quand même envoyer votre e-mail sans celles-ci ? ';
                   }
                   if (!confirm(msg)) {
                       $('#submitSendEmail,#submitSendEmail2').removeClass('disabled');
                       $('#submitSendEmail > i,#submitSendEmail2 > i').addClass('fa-paper-plane').removeClass('fa-spinner fa-spin');
                       return false;
                   }
               }

           }

           $.ajax({
               type : "POST",
               cache : false,
               url: "../../modules/openmail/ajax/sendEmailFormProcessing.php",
               data: $("#ajaxFormSendEmail").serializeArray(),
               success:function(data){
                   var obj = jQuery.parseJSON( data );
                   if(obj.result){
                       $.fancybox('<h1>Open mail - Email</h1><p>'+obj.errors[0]+'</p>');

                   }else{
                       $('#submitSendEmail,#submitSendEmail2').removeClass('disabled');
                       $('#submitSendEmail > i,#submitSendEmail2 > i').addClass('fa-paper-plane').removeClass('fa-spinner fa-spin');
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

        /*
        $("#ajaxFormSendEmail").on("submit", function() {

          console.log($(this));

            return false;
        });
*/

/*
        $("#ajaxFormSendEmail").bind("submit", function() {
                // Verification des champs

            $.ajax({
                type : "POST",
                cache : false,
                url: "../../modules/openmail/ajax/sendEmailFormProcessing.php",
                data: $(this).serializeArray(),
                success:function(data){

                    var obj = jQuery.parseJSON( data );
                    if(obj.result){
                    $.fancybox('<h1>Open mail - Sms</h1><p>'+obj.errors[0]+'</p>');

                    }else{
                        // Affiches les erreurs
                        $('#blocE').remove();
                       var htmlErrors='<ul class="contError">';
                        for (var i = 0; i < obj.errors.length; i++) {
                            htmlErrors+='<li class="error">' + obj.errors[i] + '</li>';
                        }
                        htmlErrors+='</ul>';
                        $('<div id="blocE">'+htmlErrors+'</div>').insertAfter("#ajaxFormSendEmail h1");

                    }
                }
            });

        return false;
        });
        */
    });
</script>
</body>
</html>