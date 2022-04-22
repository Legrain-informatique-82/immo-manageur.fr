$(function(){



    /***********************************************************************
     * 	Date picker
     ***********************************************************************/

    $('#datesend').datetimepicker({
        changeMonth: true,
        changeYear: true,
        minDate: 0,
        dateFormat:'dd/mm/yy',
        regional:'fr',

        addSliderAccess: true,
        sliderAccessArgs: { touchonly: false }
    });



    /***************************************************************************
     * Editeur js
     **************************************************************************/
   // CKEDITOR.replace( 'content');


    //$( 'textarea#content' ).ckeditor();


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


    // Client side form validation

    $('.frmFileUpload').submit(function(e) {
        $('#submitSendEmail,#submitSendEmail2').addClass('disabled');
        $('#submitSendEmail > i,#submitSendEmail2 > i').removeClass('fa-paper-plane').addClass('fa-spinner fa-spin');
        var uploader = $('#uploader').pluploadQueue();
        if (uploader.files.length > 0) {

            if(uploader.files.length > (uploader.total.uploaded + uploader.total.failed) ){
                res = uploader.files.length-(uploader.total.uploaded + uploader.total.failed);
                if(res==1){
                    msg = res
                    +' pièce jointe n\'a pas été associée.' +
                    ' Souhaitez-vous quand même envoyer votre e-mail sans celle-ci ? ';
                }else{
                    msg = res
                    +' pièces jointes n\'ont pas été associées.' +
                    ' Souhaitez-vous quand même envoyer votre e-mail sans celles-ci ? ';
                }
                if (!confirm(msg)) {
                    return false;
                }
            }

        }

/*

        var uploader = $('#uploader').plupload('getUploader');
        //alert(JSON.stringify(uploader, null, 4));
        // Files in queue upload them first
        if (uploader.files.length > 0) {

            if(uploader.files.length > (uploader.total.uploaded + uploader.total.failed) ){
                res = uploader.files.length-(uploader.total.uploaded + uploader.total.failed);
                if(res==1){
                    msg = res
                        +' pièce jointe n\'a pas été associée.' +
                        ' Souhaitez-vous quand même envoyer votre e-mail sans celle-ci ? ';
                }else{
                    msg = res
                        +' pièces jointes n\'ont pas été associées.' +
                        ' Souhaitez-vous quand même envoyer votre e-mail sans celles-ci ? ';
                }
                if (!confirm(msg)) {
                    return false;
                }
            }

        }
*/

    });



});

