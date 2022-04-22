
$(document).ready(function() {

        // recup de l'url
        url = window.location.href;
        explo = url.indexOf('/mod-');

        if (explo == -1) {
            urlCss = url + '/css/';
        } else {
            urlCss = url.substr(0, explo) + '/css/';
        }
        if (explo == -1) {
            urlAjax = url + '/ajax/';
        } else {
            urlAjax = url.substr(0, explo) + '/ajax/';
        }
        if (explo == -1) {
            url += '/js/';
        } else {
            url = url.substr(0, explo) + '/js/';
        }

        // datepickers
        $(".datepicker").datepicker($.datepicker.regional['fr'])
            .attr('autocomplete', 'off');

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



        /**
         *  Plupload mandate
         */

        $("#uploaderPicturesMandates").pluploadQueue({
            // General settings
            runtimes : 'html5,flash,silverlight,html4',
            url : $('#uploaderPicturesMandates').data('script')+"upload.php?idMandat="+$('#uploaderPicturesMandates').data('idmandat'),

            rename : true,
            dragdrop: true,

            filters : {
                // Maximum file size
                max_file_size : '10mb',
                // Specify what files to browse for
                mime_types: [
                    {title : "Image files", extensions : "jpg,jpeg"}

                ]
            },
            multiple_queues:true,
            // Resize images on clientside if we can
            //resize : {width : 320, height : 240, quality : 90},

            flash_swf_url : '../../js/Moxie.swf',
            silverlight_xap_url : '../../js/Moxie.xap',
            init: {

                FilesAdded: function(up, files) {},
                UploadComplete: function(up, files) {
//

                    $('.plupload_filelist_content').empty();
//


                    $.post(  $('#uploaderPicturesMandates').data('script')+'loadPicturesForMandate.php', { idmandat: $('#uploaderPicturesMandates').data('idmandat')  } ,function( data ) {
                        $( "#listesPhotos" ).html( data );
                    });

                }
            }
        });


        /**
         * END pupload mandate
         */

        /**
         * Del photos mandate
         */
        $('#listesPhotos').on('click','.jsDelPictureMandate',function(){
            if (confirm("Voulez-vous supprimer cette photo  ?")) {
                $.post(  $('#uploaderPicturesMandates').data('script')+'delPicturesForMandate.php', { idmandat: $('#uploaderPicturesMandates').data('idmandat'),idpicture:$(this).data('idpicture')  } ,function( data ) {
                    $( "#listesPhotos" ).html( data );
                });
            }
            return false;
        });
        /**
         * Fin Del photos mandate
         */

        /**
         * FANCYBOX
         */
        $(".fancyboxAjax").fancybox({
            maxWidth	: 1000,
            maxHeight	: 600,
            fitToView	: false,
            width		: '70%',
            height		: '70%',
            autoSize	: false,
            closeClick	: false,
            openEffect	: 'none',
            closeEffect	: 'none'
        });

        $(".fancybox").fancybox({
            openEffect	: 'none',
            closeEffect	: 'none'
        });


        /**
         * FIN FANCYBOX
         */

    // Valid frm
        $( "body" ).on( "click", ".changebtnPaperPlane", function() {
            $('.changebtnPaperPlane').addClass('disabled');
            $('.changebtnPaperPlane > i').removeClass('fa-paper-plane').addClass('fa-spinner fa-spin');
        });

    //



    /**
     * Afficher les mandats pour rapprochement
     */
    $('#allMandat')
        .click(
        function() {
            var toogle = 0;
            if ($(this).is(':checked'))
                toogle = 1;
            acq = $(this).attr('rel');

            $.get( urlAjax + 'load_mandates.php?toogle=' + toogle + '&acq=' + acq, function(data) {

                obj = $.parseJSON(data);

                $('#h2Change').html(obj.h2);

                $('#contentMandates').html(
                    obj.html
                );


                // nouvelle instance datatable
                dataTableDefault=lgrDataTableDefault($('table.dataTableDefault'));
                $('.dataTableDefault tbody').on( 'click', 'tr', function () {
                    if ( $(this).hasClass('selected') ) {
                        $(this).removeClass('selected');
                    }
                    else {
                        dataTableDefault.$('tr.selected').removeClass('selected');
                        $(this).addClass('selected');
                    }
                } );


                $(".dataTableDefault thead tr.tri th").each( function ( i ) {
                    var select = $('<select><option value="">Tous</option></select>')
                        .appendTo( $(this).empty() )
                        .on( 'change', function () {
                            var val = $(this).val();

                            dataTableDefault.column( i )
                                .search( val ? '^'+$(this).val()+'$' : val, true, false )
                                .draw();
                        } );


                    dataTableDefault.column( i ).data().unique().sort().each( function ( d, j ) {
                        select.append( '<option value="'+d+'">'+d+'</option>' )
                    } );

                } );
                $('tr.tri th.jshide select').hide();


            });
        });

  /*
   datatables
   */
    if ($('table#tableMandat').size() == 1) {

        var oTable2 = $('table#tableMandat').DataTable({
            /*
             "dom": 'T<"clear">lfrtip',
             "tableTools": {
             "sSwfPath": "/libs/TableTools/swf/copy_csv_xls_pdf.swf"
             },
             */
            "aoColumnDefs": [
                { "class":          'details-control',
                    "orderable":      false,
                    "data":           null,
                    "defaultContent": '',
                    "aTargets": [0]
                },
                {
                    "targets": [1 ],
                    "visible": false
                }


            ],
            "order": [[2, 'asc']],
            "iDisplayLength" : 100,

            "bJQueryUI" : true,
            /*
             "sScrollY" : "600px",
             "bScrollCollapse" : true,
             */
            "bPaginate" : false,

            "oLanguage" : {
                "sUrl" : url + "fr_FR.txt"
            }


        });



        var keys = new $.fn.dataTable.KeyTable( oTable2 );
        keys.event.focus(null, null, function() {

            var tr = $("table#tableMandat tr.focus");
            if ( tr.hasClass('selected') ) {
                tr.removeClass('selected');
            }
            else {
                oTable2.$('tr.selected').removeClass('selected');
                tr.addClass('selected');
            }

            $.get(urlAjax + 'getPicture.php?idMandate='
                + tr.attr('rel'), function(data) {
                // supprime ce qui a été ajouté
                $('#miniature > p,#miniature > dl,#miniature > img,#miniature > div').remove();
                // Rajoute en fct du mandat
                $('#miniature').prepend(data);
            });

        });

        // aDD COL TRI

        $("#tableMandat thead tr.tri th").each( function ( i ) {
            var select = $('<select><option value="">Tous</option></select>')
                .appendTo( $(this).empty() )
                .on( 'change', function () {
                    var val = $(this).val();

                    oTable2.column( i )
                        .search( val ? '^'+$(this).val()+'$' : val, true, false )
                        .draw();
                } );


            oTable2.column( i ).data().unique().sort().each( function ( d, j ) {
                select.append( '<option value="'+d+'">'+d+'</option>' )
            } );

        } );

        $('tr.tri th.jshide select').hide();

        function format ( d ) {
            // `d` is the original data object for the row
            return '<table cellpadding="5" cellspacing="0" border="0" style="padding-left:50px;">'+
                '<tr>'+
                '<td>Type de contrat : </td>'+
                '<td>'+ d.nature+'</td>'+
                '</tr>'+
                '<tr>'+
                '<td>Prénom et nom du vendeur par défaut : </td>'+
                '<td>'+ d.sellerFirstname+' '+d.sellerName+'</td>'+
                '</tr>'+
                '<tr>'+
                '<td>Adresse du bien :</td>'+
                '<td>'+d.address+'<br/>'+ d.zipCode+' '+ d.city+'</td>'+
                '</tr>'+
                '<tr>'+
                '<td>Téléphone</td>'+
                '<td>'+ d.sellerPhone+'</td>'+
                '</tr>'+
                '<tr>'+
                '<td>Portable :</td>'+
                '<td>'+ d.sellerCellPhone+'</td>'+
                '</tr>'+
                '<tr>'+
                '<td>tél. travail :</td>'+
                '<td>'+ d.sellerWorkPhone+'</td>'+
                '</tr>'+
                '<tr>'+
                '<td>fax :</td>'+
                '<td>'+ d.sellerFax+'</td>'+
                '</tr>'+
                '<tr>'+
                '<td>Email :</td>'+
                '<td>'+d.sellerEmail+'</td>'+
                '</tr>'+
                '</table>';
        }

        // Add event listener for opening and closing details
        $('#tableMandat tbody').on('click', 'td.details-control', function () {
            var tr = $(this).closest('tr');
            var row = oTable2.row( tr );

            if ( row.child.isShown() ) {
                // This row is already open - close it
                row.child.hide();
                tr.removeClass('shown');
            }
            else {

                $.post(  urlAjax+'loadPrivateInfosForMandate.php', { idmandat: tr.attr('rel')  } ,function( data ) {
                    var flow =$.parseJSON(data);
                    row.child( format(flow) ).show();

                });



                tr.addClass('shown');
            }
        } );



    }
    if ($('table#actAccueil').size() == 1) {

        var keys = new KeyTable({
            "table" : document.getElementById('actAccueil'),
            "datatable" : oTableAcq,
            "focus" : [0,5]
        });

        // taches/actions Accueil
        var oTableAcq = $('table#actAccueil').dataTable({

            //	"iDisplayLength" : 100,

            "bJQueryUI" : true,

            "sScrollY" : 100,

            "bScrollCollapse" : true,
            "bPaginate" : false,

            "oLanguage" : {
                "sUrl" : url + "fr_FR.txt"
            }
        });


        keys.event.focus(null, null, function() {

            $(oTableAcq.fnSettings().aoData).each(function() {

                $(this.nTr).removeClass('selected');
            });
            var tr = $("table#actAccueil tr.focus");
            tr.addClass('selected');

            $.get(urlAjax + 'getTache.php?idTache='
            + tr.attr('rel'), function(data) {
                // Ajoute le détail de l'action
                $('#textTacheSelected').text(data);
            });

        });


    }

        var dataTablewithoutTri = lgrDataTableDefault($('.dataTablewithoutTri'));

    if ($('table.dataTablewithoutSearch').size() == 1){


        var dataTablewithoutSearch = $('table.dataTablewithoutSearch').DataTable( {
            paging: false,
            searching: false,
            info:false,
            "iDisplayLength" : 5,
            "bJQueryUI" : true,
            "aaSorting" : [ [ 0, "asc" ] ],
            "oLanguage" : {
                "sUrl" : url + "fr_FR.txt"
            },
            "sPaginationType" : "full_numbers"
        } );

        /*
        $('.dataTablewithoutSearch tbody').on( 'click', 'tr', function () {
            if ( $(this).hasClass('selected') ) {
                $(this).removeClass('selected');
            }
            else {
                dataTablewithoutSearch.$('tr.selected').removeClass('selected');
                $(this).addClass('selected');
            }
        } );
        */
    }
    if ($('table.dataTableDefault').size() == 1){
        dataTableDefault=lgrDataTableDefault($('table.dataTableDefault'));
        $('.dataTableDefault tbody').on( 'click', 'tr', function () {
            if ( $(this).hasClass('selected') ) {
                $(this).removeClass('selected');
            }
            else {
                dataTableDefault.$('tr.selected').removeClass('selected');
                $(this).addClass('selected');
            }
        } );


        $(".dataTableDefault thead tr.tri th").each( function ( i ) {
            var select = $('<select><option value="">Tous</option></select>')
                .appendTo( $(this).empty() )
                .on( 'change', function () {
                    var val = $(this).val();

                    dataTableDefault.column( i )
                        .search( val ? '^'+$(this).val()+'$' : val, true, false )
                        .draw();
                } );


            dataTableDefault.column( i ).data().unique().sort().each( function ( d, j ) {
                select.append( '<option value="'+d+'">'+d+'</option>' )
            } );

        } );
        $('tr.tri th.jshide select').hide();
    }
    if ($('table.dataTableDefault2').size() == 1){
        dataTableDefault2=lgrDataTableDefault($('table.dataTableDefault2'));
        $('.dataTableDefault2 tbody').on( 'click', 'tr', function () {
            if ( $(this).hasClass('selected') ) {
                $(this).removeClass('selected');
            }
            else {
                dataTableDefault2.$('tr.selected').removeClass('selected');
                $(this).addClass('selected');
            }
        } );


        $(".dataTableDefault2 thead tr.tri th").each( function ( i ) {
            var select = $('<select><option value="">Tous</option></select>')
                .appendTo( $(this).empty() )
                .on( 'change', function () {
                    var val = $(this).val();

                    dataTableDefault2.column( i )
                        .search( val ? '^'+$(this).val()+'$' : val, true, false )
                        .draw();
                } );


            dataTableDefault2.column( i ).data().unique().sort().each( function ( d, j ) {
                select.append( '<option value="'+d+'">'+d+'</option>' )
            } );

        } );
        $('tr.tri th.jshide select').hide();
    }
    if ($('table.dataTableDefault3').size() == 1){
        dataTableDefault3=lgrDataTableDefault($('table.dataTableDefault3'));
        $('.dataTableDefault3 tbody').on( 'click', 'tr', function () {
            if ( $(this).hasClass('selected') ) {
                $(this).removeClass('selected');
            }
            else {
                dataTableDefault3.$('tr.selected').removeClass('selected');
                $(this).addClass('selected');
            }
        } );


        $(".dataTableDefault3 thead tr.tri th").each( function ( i ) {
            var select = $('<select><option value="">Tous</option></select>')
                .appendTo( $(this).empty() )
                .on( 'change', function () {
                    var val = $(this).val();

                    dataTableDefault3.column( i )
                        .search( val ? '^'+$(this).val()+'$' : val, true, false )
                        .draw();
                } );


            dataTableDefault3.column( i ).data().unique().sort().each( function ( d, j ) {
                select.append( '<option value="'+d+'">'+d+'</option>' )
            } );

        } );
        $('tr.tri th.jshide select').hide();
    }

    if ($('table.dataTableDefault4').size() == 1){
        dataTableDefault4=lgrDataTableDefault($('table.dataTableDefault4'));
        $('.dataTableDefault3 tbody').on( 'click', 'tr', function () {
            if ( $(this).hasClass('selected') ) {
                $(this).removeClass('selected');
            }
            else {
                dataTableDefault4.$('tr.selected').removeClass('selected');
                $(this).addClass('selected');
            }
        } );


        $(".dataTableDefault4 thead tr.tri th").each( function ( i ) {
            var select = $('<select><option value="">Tous</option></select>')
                .appendTo( $(this).empty() )
                .on( 'change', function () {
                    var val = $(this).val();

                    dataTableDefault4.column( i )
                        .search( val ? '^'+$(this).val()+'$' : val, true, false )
                        .draw();
                } );


            dataTableDefault4.column( i ).data().unique().sort().each( function ( d, j ) {
                select.append( '<option value="'+d+'">'+d+'</option>' )
            } );

        } );
        $('tr.tri th.jshide select').hide();
    }
    if ($('table.dataTableDefault5').size() == 1){
        dataTableDefault5=lgrDataTableDefault($('table.dataTableDefault5'));
        $('.dataTableDefault5 tbody').on( 'click', 'tr', function () {
            if ( $(this).hasClass('selected') ) {
                $(this).removeClass('selected');
            }
            else {
                dataTableDefault3.$('tr.selected').removeClass('selected');
                $(this).addClass('selected');
            }
        } );


        $(".dataTableDefault5 thead tr.tri th").each( function ( i ) {
            var select = $('<select><option value="">Tous</option></select>')
                .appendTo( $(this).empty() )
                .on( 'change', function () {
                    var val = $(this).val();

                    dataTableDefault5.column( i )
                        .search( val ? '^'+$(this).val()+'$' : val, true, false )
                        .draw();
                } );


            dataTableDefault5.column( i ).data().unique().sort().each( function ( d, j ) {
                select.append( '<option value="'+d+'">'+d+'</option>' )
            } );

        } );
        $('tr.tri th.jshide select').hide();
    }
    if ($('table.dataTableDefault6').size() == 1){
        dataTableDefault6=lgrDataTableDefault($('table.dataTableDefault6'));
        $('.dataTableDefault6 tbody').on( 'click', 'tr', function () {
            if ( $(this).hasClass('selected') ) {
                $(this).removeClass('selected');
            }
            else {
                dataTableDefault6.$('tr.selected').removeClass('selected');
                $(this).addClass('selected');
            }
        } );


        $(".dataTableDefault6 thead tr.tri th").each( function ( i ) {
            var select = $('<select><option value="">Tous</option></select>')
                .appendTo( $(this).empty() )
                .on( 'change', function () {
                    var val = $(this).val();

                    dataTableDefault6.column( i )
                        .search( val ? '^'+$(this).val()+'$' : val, true, false )
                        .draw();
                } );


            dataTableDefault6.column( i ).data().unique().sort().each( function ( d, j ) {
                select.append( '<option value="'+d+'">'+d+'</option>' )
            } );

        } );
        $('tr.tri th.jshide select').hide();
    }

    if ($('table.dataTableDefaultWithoutPagination').size() == 1) {
       var dataTableDefaultWithoutPagination = $('table.dataTableDefaultWithoutPagination').DataTable({

            "iDisplayLength": 100,

            "bJQueryUI": true,

            "sScrollY": 600,
            "sScrollX": "100%",
            "bScrollCollapse": true,
            "bPaginate": false,

            "oLanguage": {
                "sUrl": url + "fr_FR.txt"
            },
            "sPaginationType": "full_numbers"
        });
        $('.dataTableDefaultWithoutPagination tbody').on( 'click', 'tr', function () {
            if ( $(this).hasClass('selected') ) {
                $(this).removeClass('selected');
            }
            else {
                dataTableDefaultWithoutPagination.$('tr.selected').removeClass('selected');
                $(this).addClass('selected');
            }
        } );


        $(".dataTableDefaultWithoutPagination thead tr.tri th").each( function ( i ) {
            var select = $('<select><option value="">Tous</option></select>')
                .appendTo( $(this).empty() )
                .on( 'change', function () {
                    var val = $(this).val();

                    dataTableDefaultWithoutPagination.column( i )
                        .search( val ? '^'+$(this).val()+'$' : val, true, false )
                        .draw();
                } );


            dataTableDefaultWithoutPagination.column( i ).data().unique().sort().each( function ( d, j ) {
                select.append( '<option value="'+d+'">'+d+'</option>' )
            } );

        } );
        $('tr.tri th.jshide select').hide();
    }

    /*
    Fin datatables
     */


        /* Add terrain ( verif js ) */
        var prixNetVendeur = $('#prixNetVendeur');
        var prixFai = $('#prixFai');
        var commissionMandat = $('#commissionMandat');
        //   $('body').on('click', '.delLineRecherche', function() {
        //$('#prixNetVendeur,#prixFai').live('focusout keyup click',function() {
        $('body').on('focusout keyup click', '#prixNetVendeur,#prixFai', function() {
            commissionMandat.val(roundNumber(prixFai.val()
                - prixNetVendeur.val(), 2));
        });
        /**
         * Ajout d'un mandat
         */
        toogleLocateSell();
        $('#typeTransaction').change(function() {
            toogleLocateSell();
        });
        // Js des modules

        /**
         * Suppression d'un membre (ajax)
         */
        $('.jsdelUser')
            .click(
            function() {
                idUser = $(this).attr('rel');
                // recup de l'id identifiant
                if (confirm("Voulez-vous supprimer le membre ?")) { // Clic
                    // sur
                    // OK
                    //parent = $(this).parent().parent();
                    $.get(urlAjax
                        + 'delete_user.php?idUser='
                        + idUser, function(data) {
                        obj = $.parseJSON(data);
                        alert(obj.message);
                        if (obj.done == '1')
                        //parent.remove();
                            dataTableDefault.row('.selected').remove().draw( false );
                    });
                }
                return false;
            });
        /**
         * Suppression d'un titre vendeur
         */
            //
        $('.jsdelTitleSeller')
            .click(
            function() {
                id = $(this).attr('rel');
                // recup de l'id identifiant
                if (confirm("Voulez-vous supprimer le titre ?")) { // Clic
                    // sur
                    // OK
                   // parent = $(this).parent().parent();
                    $
                        .get(
                        urlAjax
                            + 'delete_title_seller.php?id='
                            + id,
                        function(data) {
                            obj = $
                                .parseJSON(data);
                            alert(obj.message);
                            if (obj.done == '1')
//                                parent.remove();
                                dataTableDefault.row('.selected').remove().draw( false );
                        });
                }
                return false;
            });
        /**
         * Suppression d'un titre vendeur
         */
            //
        $('.jsdelSeller')
            .click(
            function() {
                id = $(this).attr('rel');
                // recup de l'id identifiant
                if (confirm("Voulez-vous supprimer le vendeur ?")) { // Clic
                    // sur
                    // OK
                  //  parent = $(this).parent().parent();
                    $.get(urlAjax
                        + 'delete_seller.php?id='
                        + id, function(data) {
                        obj = $.parseJSON(data);
                        alert(obj.message);
                        if (obj.done == '1')
                          //  parent.remove();
                            dataTableDefault.row('.selected').remove().draw( false );
                    });
                }
                return false;
            });
        $('.jsDelNotary')
            .click(
            function() {
                id = $(this).attr('rel');
                // recup de l'id identifiant
                if (confirm("Voulez-vous supprimer le notaire ?")) { // Clic
                    // sur
                    // OK
                    //parent = $(this).parent().parent().parent().parent().parent();
                    $.get(urlAjax
                        + 'delete_notary.php?id='
                        + id, function(data) {
                        obj = $.parseJSON(data);
                        alert(obj.message);
                        if (obj.done == '1'){
                            //parent.remove();
                            dataTableDefault.row('.selected').remove().draw( false );
                        }
                    });
                }
                return false;
            });
        $('.jsDelSector')
            .click(
            function() {
                id = $(this).attr('rel');
                // recup de l'id identifiant
                if (confirm("Voulez-vous supprimer le secteur ?")) { // Clic
                    // sur
                    // OK
                    //parent = $(this).parent().parent();
                    $.get(urlAjax
                        + 'delete_sector.php?id='
                        + id, function(data) {
                        obj = $.parseJSON(data);
                        alert(obj.message);
                        if (obj.done == '1')
                            oTable.row('.selected').remove().draw( false );
                    });
                }
                return false;
            });
        $('.jsDelCity')
            .click(
            function() {
                id = $(this).attr('rel');
                // recup de l'id identifiant
                if (confirm("Voulez-vous supprimer la ville ?")) { // Clic
                    // sur
                    // OK
                    parent = $(this).parent().parent();
                    $.get(urlAjax
                        + 'delete_city.php?id='
                        + id, function(data) {
                        obj = $.parseJSON(data);
                        alert(obj.message);
                        if (obj.done == '1')
                            //parent.remove();
                            tableCities.row('.selected').remove().draw( false );
                    });
                }
                return false;
            });
        $('.jsDelAcquereur').click( function() {
            id = $(this).attr('rel');
            // recup de l'id identifiant
            if (confirm("Voulez-vous supprimer l'acquereur ?")) { // Clic
                // sur
                // OK
                //parent = $(this).parent().parent();
                $.get(urlAjax+ 'delete_acquereur.php?id='+ id,function(data) {
                    // alert(data);
                    obj = $.parseJSON(data);
                    alert(obj.message);
                    if (obj.done == '1')
                    //parent.remove();
                        dataTableDefault.row('.selected').remove().draw( false );
                });
            }
            return false;
        });
        /**
         * Vendeur act/inactif
         */
        $('.jsNone').remove();



        $("#tabs").tabs();

        $(".accordion").accordion({
            autoHeight : false,
            navigation : true,
            collapsible : true,
            heightStyle: "content",
            active : parseInt($(".accordion").attr('rel'))
        });

        $('.accordion .head').click(function() {
            $(this).next().toggle('slow');
            return false;
        }).next().hide();

        $('.accordion h2 a,.accordion h2').click( function() {

            if ($(this).attr('rel') == 'gen') {
                // alert($(this).attr('rel'));*
                // activation de la map
                // map
                var latitude = $('#latitude').text();
                var longitude = $('#longitude').text();

                $("#map").css('width', '100%').css(
                        'height', '540px').gmap3({
                        action : 'addMarker',
                        // address: "place de l'étoile, paris",
                        lat : latitude,
                        lng : longitude,

                        map : {
                            center : true,
                            scrollwheel :false,
                            zoom : 14

                        },
                        marker : {
                            options : {
                                draggable : true

                            }
                        }

                    });

                $("#map2").css('width', '100%').css(
                        'height', '540px').gmap3({
                        action : 'addMarker',
                        address: $('#map2').data('address'),

                        map : {
                            center : true,
                            scrollwheel :false,
                            zoom : 14
                        },
                        marker : {
                            options : {
                                draggable : true

                            }
                        }

                    });
            }

            // suppression de l'attribut
            $(this).attr('rel', 'done');
        });





        $(".accordionStandard").accordion({
            autoHeight : false,
            navigation : true,
            collapsible : true,
            heightStyle: "content",
            active : parseInt($(".accordionStandard").attr('rel'))
        });

        $('.accordionStandard .head').click(function() {
            $(this).next().toggle('slow');
            return false;
        }).next().hide();



        $('#tableUpdateMandateDescription').after(
                '<p><a href="#" id="addLine">Ajouter une ligne</a></p> ');
        $('#addLine').click(function() {
                $('#tableUpdateMandateDescription').append('<tr><td><input type="hidden" name="id[]" value="" /><input type="text" name="niveau[]" value=""/></td><td><input type="text" name="piece[]" value=""/></td><td><input type="text" name="surface[]" value=""/></td><td><input type="text" name="carac[]" value=""/></td><td>NC</td></tr>');
                return false;
            });
        $('.jsAddLinkNewLine').append(
                '<p><a href="#" class="addLine">Ajouter une ligne</a></p>');
        $('.addLine').click(function() {
                var rel = $(this).parent().parent().attr('rel');
                $(this).parent().parent().prepend(
                        '<p class="bulle"><input type="hidden" name="type[]" value="'
                            + rel
                            + '" /><input type="hidden" name="id[]" value="" />Position : <input type="text" name="pos[]" value="" class="minText"/> Libellé : <textarea class="trenteCinq" name="libel[]"  cols="30" rows="10"></textarea> Valeur : <textarea class="trenteCinq" name="val[]"  cols="30" rows="10"></textarea>Supprimer ? <input type="checkbox" name="del[]" disabled="disabled" value="" /></p>');
                return false;
            })
        $('.jsCheckAll').click(
            function() {
                var idPasserelle = $(this).attr('rel');
                if ($(this).is(':checked')) {
                    // alert(idPasserelle);
                    // cocher toute la rangée
                    $(
                        'input:checkbox[rel|="'
                            + idPasserelle + '"]')
                        .attr('checked', 'checked');

                } else {
                    // décocher toute la rangée
                    $(
                        'input:checkbox[rel|="'
                            + idPasserelle + '"]')
                        .removeAttr('checked');
                }
            });


        //$('.chooseCritereMandate').live('change',function() {
        $('body').on('change', '.chooseCritereMandate', function() {

            var type = $(this).find(
                    "option:selected")
                .attr('class');

            //
            // alert(type);

            if (type == 'simple') {
                $(this)
                    .parent()
                    .children(
                        '.complementWithJs')
                    .replaceWith(
                        '<span class="complementWithJs"><input type="text"  name="val1[]" /> <input type="hidden" name="val2[]" value=""/><input type="hidden" name="type[]" value="'
                            + type
                            + '"/><input type="hidden" name="table[]" value=""/></span>');
            } else if (type == 'double') {
                $(this)
                    .parent()
                    .children(
                        '.complementWithJs')
                    .replaceWith(
                        '<span class="complementWithJs"><input type="text"  name="val1[]" /> et <input type="text"  name="val2[]" /><input type="hidden" name="type[]" value="'
                            + type
                            + '"/><input type="hidden" name="table[]" value=""/></span>');
            } else if (type == 'empty') {
                $(this)
                    .parent()
                    .children(
                        '.complementWithJs')
                    .replaceWith(
                        '<span class="complementWithJs"></span>');

            } else {
                // type contient le nom de la table
                // de la liste à afficher.
                var pa = $(this).parent();
                $
                    .get(
                    urlAjax
                        + 'loadList.php?class='
                        + type,
                    function(data) {

                        pa
                            .children(
                                '.complementWithJs')
                            .replaceWith(
                                '<span class="complementWithJs">'
                                    + data
                                    + '</span>');
                    });
            }


        });

        // ajout d'une ligne de recherche
        // Critere_mandate
        $('#addNewRecherchLine').click(
            function() {
                var pa = $(this);
                $.get(urlAjax + 'loadList.php?class='
                    + $(this).attr('class'),
                    function(data) {
                        // pa.parent().prepend(data);
                        $('.lineCritere:last').after(data);

                    });
                return false;
            });

        //$('.delLineRecherche').live('click', function() {
        $('body').on('click', '.delLineRecherche', function() {

            $(this).parent().remove();
            return false;
        });



        // appel de ckeditor
        $( 'textarea.editor' ).ckeditor(function()  { /*toolbar : 'Classique'*/ },{toolbar : 'Classique' } );

        // toolbar personalisée ( à faire)
        $( 'textarea.editor_document' ).ckeditor(function() { /*toolbar : 'Classique'*/ }, {
                toolbar : 'Documents' }

        );

        $('#accordion').accordion({
            heightStyle: "content"
        });


    var countPictures = 0;
    $('.arrayPicture') .click( function() {

        if ($(this).is(':checked')) {
            // alert($(this).val()+'zz');
            if (countPictures >= 3) {
                $(this).attr('checked', false);
                alert('Impossible de selectionner plus de 3 miniatures');
            } else {
                countPictures++;
            }
        } else {
            countPictures--;
        }
    });
    // Virer les styles de bien pour les terrains.
    if ($('#typeBien').val() == 1)
        $('#pStyle').hide();
    $('#typeBien').change(function() {
        if ($('#typeBien').val() == 1) {
            $('#pStyle').hide();
        } else {
            $('#pStyle').show();
        }
    });
    // $('#choosePicturegenerateAfficheMandate').hide();
    if ($('#une').is(':checked')) {
        $("#choosePicturegenerateAfficheMandate").hide();
    }
    $(':radio[name=photos]').click(function() {
        if ($('#quatre').is(':checked')) {
            $('#choosePicturegenerateAfficheMandate').show();
        } else {
            $('#choosePicturegenerateAfficheMandate').hide();
        }

    });




        // Fin boucle jquery
    });



function roundNumber(number, digits) {
    var multiple = Math.pow(10, digits);
    var rndedNum = Math.round(number * multiple) / multiple;
    return rndedNum;
}

function toogleLocateSell() {
    if ($('#typeTransaction').val() == 1) {
        $('#jsPrixFai').html('Loyer + frais d\'agences');
        $('#jsPrixNetVendeur').html('Loyer');
        $('#jsEstim').hide();
        $('#jsEstimMaxi').hide();
        $('#jsMargeNegoce').hide();
        $('#jsRental').hide();
    } else {
        $('#jsPrixFai').html('Prix FAI');
        $('#jsPrixNetVendeur').html('Prix net vendeur');
        $('#jsEstim').show();
        $('#jsEstimMaxi').show();
        $('#jsMargeNegoce').show();
        $('#jsRental').show();

    }
}

/* French initialisation for the jQuery UI date picker plugin. */
/*
 * Written by Keith Wood (kbwood{at}iinet.com.au) and Stéphane Nahmani
 * (sholby@sholby.net).
 */
jQuery(function($) {
    $.datepicker.regional['fr'] = {
        closeText : 'Fermer',
        prevText : '&#x3c;Préc',
        nextText : 'Suiv&#x3e;',
        currentText : 'Courant',
        monthNames : [ 'Janvier', 'Février', 'Mars', 'Avril', 'Mai', 'Juin',
            'Juillet', 'Août', 'Septembre', 'Octobre', 'Novembre',
            'Décembre' ],
        monthNamesShort : [ 'Jan', 'Fév', 'Mar', 'Avr', 'Mai', 'Jun', 'Jul',
            'Aoû', 'Sep', 'Oct', 'Nov', 'Déc' ],
        dayNames : [ 'Dimanche', 'Lundi', 'Mardi', 'Mercredi', 'Jeudi',
            'Vendredi', 'Samedi' ],
        dayNamesShort : [ 'Dim', 'Lun', 'Mar', 'Mer', 'Jeu', 'Ven', 'Sam' ],
        dayNamesMin : [ 'Di', 'Lu', 'Ma', 'Me', 'Je', 'Ve', 'Sa' ],
        weekHeader : 'Sm',
        dateFormat : 'dd/mm/yy',
        firstDay : 1,
        isRTL : false,
        showMonthAfterYear : false,
        yearSuffix : ''
    };
    $.datepicker.setDefaults($.datepicker.regional['fr']);





    jQuery.fn.dataTableExt.oSort['title-numeric-asc']  = function(a,b) {
        var x = a.match(/title="*(-?[0-9\.]+)/)[1];
        var y = b.match(/title="*(-?[0-9\.]+)/)[1];
        x = parseFloat( x );
        y = parseFloat( y );
        return ((x < y) ? -1 : ((x > y) ?  1 : 0));
    };

    jQuery.fn.dataTableExt.oSort['title-numeric-desc'] = function(a,b) {
        var x = a.match(/title="*(-?[0-9\.]+)/)[1];
        var y = b.match(/title="*(-?[0-9\.]+)/)[1];
        x = parseFloat( x );
        y = parseFloat( y );
        return ((x < y) ?  1 : ((x > y) ? -1 : 0));
    };


});
function fnGetSelected(oTableLocal) {
    var aReturn = new Array();
    var aTrs = oTableLocal.fnGetNodes();

    for ( var i = 0; i < aTrs.length; i++) {
        if ($(aTrs[i]).hasClass('row_selected')) {
            aReturn.push(aTrs[i]);
        }
    }
    return aReturn;
}

function RenderDecimalNumber(oObj) {
    var num = new NumberFormat();
    num.setInputDecimal('.');
    num.setNumber(oObj.aData[oObj.iDataColumn]);
    num.setPlaces(this.oCustomInfo.decimalPlaces, true);
    num.setCurrency(false);
    num.setNegativeFormat(num.LEFT_DASH);
    num.setSeparators(true, this.oCustomInfo.decimalSeparator, this.oCustomInfo.thousandSeparator);

    return num.toFormatted();
}


function lgrDataTableDefault( tableSelector ){
    order=tableSelector.data('rendering');
    if(!order)order="asc";
    display_length=tableSelector.data('display_length');
    if(!display_length)display_length="100";
    return tableSelector.DataTable( {
        paging: true,
        "iDisplayLength" : display_length,
        "bJQueryUI" : true,
        "aaSorting" : [ [ 0, order ] ],
        "oLanguage" : {
            "sUrl" : url + "fr_FR.txt"
        },
        "sPaginationType" : "full_numbers"
    } );
}

