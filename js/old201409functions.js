var oTable2;
var giRedraw = false;
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



        /* Init the table */

        $('.standardWithoutPagination').dataTable({

            "iDisplayLength" : 100,

            "bJQueryUI" : true,

            "sScrollY" : 600,
            "sScrollX": "100%",
            "bScrollCollapse" : true,
            "bPaginate" : false,

            "oLanguage" : {
                "sUrl" : url + "fr_FR.txt"
            },
            "sPaginationType" : "full_numbers"
        });


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
                    $(this.nTr).removeClass('row_selected');
                });

                var tr = $("table#actAccueil td.focus").parent();
                tr.addClass('row_selected');

                $.get(urlAjax + 'getTache.php?idTache='
                    + tr.attr('rel'), function(data) {
                    // Ajoute le détail de l'action
                    $('#textTacheSelected').text(data);
                });

            });


        }

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
                    '<td>'+d.addres+'<br/>'+ d.zipCode+' '+ d.city+'</td>'+
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
//                                alert(tr.attr('rel'));
                    // Open this row
                    // Récupèration des infos via ajax + passage à la fct format.

                    $.post(  urlAjax+'loadPrivateInfosForMandate.php', { idmandat: tr.attr('rel')  } ,function( data ) {
                        var flow =$.parseJSON(data);
                        row.child( format(flow) ).show();

                    });



                    tr.addClass('shown');
                }
            } );



        }
        if ($('table#datatableCities').size() == 1) {
            var tableCities = $('table#datatableCities').DataTable(
                {
                    "bJQueryUI" : true,
                    "sPaginationType" : "full_numbers",
                    "oLanguage" : {
                        "sUrl" : url + "fr_FR.txt"
                    }
                }
            );

            $("#datatableCities thead tr.tri th").each( function ( i ) {
                var select = $('<select><option value="">Tous</option></select>')
                    .appendTo( $(this).empty() )
                    .on( 'change', function () {
                        var val = $(this).val();

                        tableCities.column( i )
                            .search( val ? '^'+$(this).val()+'$' : val, true, false )
                            .draw();
                    } );


                tableCities.column( i ).data().unique().sort().each( function ( d, j ) {
                    select.append( '<option value="'+d+'">'+d+'</option>' )
                } );

            } );

            $('tr.tri th.jshide select').hide();

            $('#datatableCities tbody').on( 'click', 'tr', function () {
                if ( $(this).hasClass('selected') ) {
                    $(this).removeClass('selected');
                }
                else {
                    tableCities.$('tr.selected').removeClass('selected');
                    $(this).addClass('selected');
                }
            });
        }
        if ( $.fn.dataTable.isDataTable( 'table.standard' ) ) {

            var oTable = $('table.standard').DataTable();
        }
        else {

            oTable=lgrDataTableDefault($('table.standard'));
        }


        $('.standard tbody').on( 'click', 'tr', function () {
            if ( $(this).hasClass('selected') ) {
                $(this).removeClass('selected');
            }
            else {
                oTable.$('tr.selected').removeClass('selected');
                $(this).addClass('selected');
            }
        } );


        $(".standard thead tr.tri th").each( function ( i ) {
            var select = $('<select><option value="">Tous</option></select>')
                .appendTo( $(this).empty() )
                .on( 'change', function () {
                    var val = $(this).val();

                    oTable.column( i )
                        .search( val ? '^'+$(this).val()+'$' : val, true, false )
                        .draw();
                } );


            oTable.column( i ).data().unique().sort().each( function ( d, j ) {
                select.append( '<option value="'+d+'">'+d+'</option>' )
            } );

        } );
        $('tr.tri th.jshide select').hide();


        if ($('table.dateFirst').size() == 1) {
        var table = $('table.dateFirst').DataTable({
            "bJQueryUI" : true,
            "oLanguage" : {
                "sUrl" : url + "fr_FR.txt"
            },
            "sPaginationType" : "full_numbers",
            "aaSorting" : [ [ 0, "desc" ] ],
            "aoColumnDefs": [
                { "sType": "date-euro", "aTargets": [ 0 ] }
            ]
        });

            $('.dateFirst tbody').on( 'click', 'tr', function () {
                if ( $(this).hasClass('selected') ) {
                    $(this).removeClass('selected');
                }
                else {
                    table.$('tr.selected').removeClass('selected');
                    $(this).addClass('selected');
                }
            } );


            $(".dateFirst thead tr.tri th").each( function ( i ) {
                var select = $('<select><option value="">Tous</option></select>')
                    .appendTo( $(this).empty() )
                    .on( 'change', function () {
                        var val = $(this).val();

                        table.column( i )
                            .search( val ? '^'+$(this).val()+'$' : val, true, false )
                            .draw();
                    } );


                table.column( i ).data().unique().sort().each( function ( d, j ) {
                    select.append( '<option value="'+d+'">'+d+'</option>' )
                } );

            } );
            $('tr.tri th.jshide select').hide();

        }

        $('table.threeColumnWithFirstDate').dataTable({
            "bJQueryUI" : true,
            "oLanguage" : {
                "sUrl" : url + "fr_FR.txt"
            },
            "sPaginationType" : "full_numbers",
            "aaSorting" : [ [ 0, "desc" ] ],
            "aoColumns" : [ {
                "sType" : "date-euro"
            }, null, null ]
        });
        $('table.twoColumnWithFirstDate').dataTable({
            "bJQueryUI" : true,
            "oLanguage" : {
                "sUrl" : url + "fr_FR.txt"
            },
            "sPaginationType" : "full_numbers",
            "aaSorting" : [ [ 0, "desc" ] ],
            "aoColumns" : [ {
                "sType" : "date-euro"
            }, null ]
        });

        $('table.triActions').dataTable({
            "bJQueryUI" : true,
            "oLanguage" : {
                "sUrl" : url + "fr_FR.txt"
            },
            "sPaginationType" : "full_numbers",
            "aaSorting" : [ [ 0, "asc" ] ],
            "aoColumns" : [ {
                "sType" : "date-euro"
            }, {
                "sType" : "date-euro"
            }, null, null ]
        });



        $('table.triActionsBis').dataTable({
            "bJQueryUI" : true,
            "oLanguage" : {
                "sUrl" : url + "fr_FR.txt"
            },
            "paging":   false,
            "info":     false,
            "scrollY":        "100px",
            "bFilter": false,
            "scrollCollapse": true,
            "aaSorting" : [ [ 0, "desc" ] ],
            "aoColumnDefs": [
                { "sType": "date-euro", "aTargets": [ 0 ] }
            ]
        });
        $('table.triActionsOld').dataTable({
            "bJQueryUI" : true,
            "oLanguage" : {
                "sUrl" : url + "fr_FR.txt"
            },
            "sPaginationType" : "full_numbers",
            "aaSorting" : [ [ 0, "desc" ] ],
            "aoColumns" : [ {
                "sType" : "date-euro"
            }, {
                "sType" : "date-euro"
            }, /*
             * { "sType": "date-euro" },
             */
                null, null, null, null, null ]
        });
        $('table.triActionsBisBis').dataTable({
            "bJQueryUI" : true,
            "oLanguage" : {
                "sUrl" : url + "fr_FR.txt"
            },
            "sPaginationType" : "full_numbers",
            "aaSorting" : [ [ 0, "desc" ] ],
            "aoColumns" : [ {
                "sType" : "date-euro"
            }, /*
             * { "sType": "date-euro" },
             */
                null, null, null, null, null, null ]
        });
        $('table.triActionsBisOld').dataTable({
            "bJQueryUI" : true,
            "oLanguage" : {
                "sUrl" : url + "fr_FR.txt"
            },
            "sPaginationType" : "full_numbers",
            "aaSorting" : [ [ 0, "desc" ] ],
            "aoColumns" : [ {
                "sType" : "date-euro"
            }, {
                "sType" : "date-euro"
            }, /*
             * { "sType": "date-euro" },
             */
                null, null, null, null, null, null ]
        });
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
                            oTable.row('.selected').remove().draw( false );
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
                                oTable.row('.selected').remove().draw( false );
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
                            oTable.row('.selected').remove().draw( false );
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
                            oTable.row('.selected').remove().draw( false );
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
                        oTable.row('.selected').remove().draw( false );
                });
            }
            return false;
        });
        /**
         * Vendeur act/inactif
         */
        $('.jsNone').remove();
        $('#seeAsset')
            .click(
            function() {
                var toogle = 0;
                if ($(this).is(':checked'))
                    toogle = 1;
                $
                    .get(
                    urlAjax
                        + 'load_seller.php?toogle='
                        + toogle,
                    function(data) {
                        oTable.fnDestroy();
                        $('.standard')
                            .html(data)
                            .dataTable(
                            {
                                "iDisplayLength" : 100,
                                "bJQueryUI" : true,
                                "oLanguage" : {
                                    "sUrl" : url
                                        + "fr_FR.txt"
                                },
                                "sPaginationType" : "full_numbers"

                            });

                        $('.jsdelSeller')
                            .click(
                            function() {
                                id = $(
                                    this)
                                    .attr(
                                        'rel');
                                // recup
                                // de
                                // l'id
                                // identifiant
                                if (confirm("Voulez-vous supprimer le vendeur ?")) { // Clic
                                    // sur
                                    // OK
                                    parent = $(
                                        this)
                                        .parent()
                                        .parent();
                                    $
                                        .get(
                                        urlAjax
                                            + 'delete_seller.php?id='
                                            + id,
                                        function(
                                            data) {
                                            obj = $
                                                .parseJSON(data);
                                            alert(obj.message);
                                            if (obj.done == '1')
                                                parent
                                                    .remove();
                                        });
                                }
                                return false;
                            });
                    })
            });
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
                $
                    .get(
                    urlAjax
                        + 'load_mandates.php?toogle='
                        + toogle
                        + '&acq=' + acq,
                    function(data) {
                        obj = $
                            .parseJSON(data);
                        $('#h2Change')
                            .html(
                                obj.h2);

                        $(
                            '#contentMandates')
                            .html(
                                obj.html);
                        // nouvelle instance
                        // de .standard

                        $('.standard')
                            .dataTable(
                            {
                                "iDisplayLength" : 100,
                                "bJQueryUI" : true,
                                "oLanguage" : {
                                    "sUrl" : url
                                        + "fr_FR.txt"
                                },
                                "sPaginationType" : "full_numbers"
                            });

                        // fin ajout

                    });
            })
        $('#seeAssetAc').click(function() {
            var toogle = 0;
            if ($(this).is(':checked'))
                toogle = 1;
            $.get(urlAjax+ 'load_acquereur.php?toogle='+ toogle,function(data) {
                oTable.fnDestroy();
                $('.standard').html(data).dataTable(
                    {
                        "iDisplayLength" : 100,
                        "bJQueryUI" : true,
                        "oLanguage" : {
                            "sUrl" : url
                                + "fr_FR.txt"
                        },
                        "sPaginationType" : "full_numbers"
                    });
                $('.jsDelAcquereur')
                    .click(
                    function() {
                        id = $(
                            this)
                            .attr(
                                'rel');
                        // recup
                        // de
                        // l'id
                        // identifiant
                        if (confirm("Voulez-vous supprimer l'acquereur ?")) { // Clic
                            // sur
                            // OK
                            parent = $(
                                this)
                                .parent()
                                .parent();
                            $
                                .get(
                                urlAjax
                                    + 'delete_acquereur.php?id='
                                    + id,
                                function(
                                    data) {
                                    // alert(data);
                                    obj = $
                                        .parseJSON(data);
                                    alert(obj.message);
                                    if (obj.done == '1')
                                        parent
                                            .remove();
                                });
                        }
                        return false;
                    });
            })
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

        })
        /*
         * Bug de la carte ... Il faudrait la charger avant le tabs
         */

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

        // alert( $(".accordion").val() );

        // test upload...
        // ajout des éléments....
        // file_upload
    /*
        $('.uploadMultiple input').remove();
        $('.uploadMultiple label').remove();

        $('.uploadMultiple')
            .append(
                'Ajouter les images du mandat :  	<div id="status-message"></div><div id="custom-queue"></div> <input id="file_upload" name="file_upload" type="file" />');
        // Voir mandat ou terrain ...
        $('#file_upload')
            .uploadify(
            {
                'uploader' : '../../ajax/uploadify.swf',
                'script' : '../../ajax/upload.php', // 'script'
                // :
                // '../../ajax/upload.php?idMandat='+$('#idMandate').val()+'&idSess='+$('#idSess').val(),
                // //'script'
                // :
                // 'uploadify.php',
                'scriptData' : {
                    'idMandat' : $('#idMandate').val(),
                    'idSess' : $('#idSess').val()
                },
                'cancelImg' : '../../images/cancel.png',
                // 'folder' :'upload',
                'multi' : true,
                'auto' : true,
                'fileExt' : '*.jpg',
                'fileDesc' : 'Image Files (.JPG)',
                'queueID' : 'custom-queue',
                'queueSizeLimit' : 15,
                'simUploadLimit' : 15,
                'removeCompleted' : false,
                'onSelectOnce' : function(event, data) {
                    $('#status-message')
                        .text(
                            data.filesSelected
                                + ' fichiers ont été ajouté à la file d\'attente.');
                },
                'onAllComplete' : function(event, data) {
                    $('#status-message')
                        .text(
                            data.filesUploaded
                                + ' fichiers envoyés, '
                                + data.errors
                                + ' erreurs.');
                    document.location.reload();
                }
            });
    */
        // fin test upload

        // Modifier les descriptions
        // tableUpdateMandateDescription

        $('#tableUpdateMandateDescription')
            .after(
                '<p><a href="#" id="addLine">Ajouter une ligne</a></p> ');
        $('#addLine')
            .click(
            function() {
                $('#tableUpdateMandateDescription')
                    .append(
                        '<tr><td><input type="hidden" name="id[]" value="" /><input type="text" name="niveau[]" value=""/></td><td><input type="text" name="piece[]" value=""/></td><td><input type="text" name="surface[]" value=""/></td><td><input type="text" name="carac[]" value=""/></td><td>NC</td></tr>');
                return false;
            });
        $('.jsAddLinkNewLine')
            .append(
                '<p><a href="#" class="addLine">Ajouter une ligne</a></p>');
        $('.addLine')
            .click(
            function() {
                var rel = $(this).parent().parent()
                    .attr('rel');
                $(this)
                    .parent()
                    .parent()
                    .prepend(
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
            // il faut chopper le type
            // (single,double ou list)

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


// Menu principal (accueil)
        /*
         $('<div class="jsSmenuAcq" ></div>').appendTo('#accueilB5' ).hide();

         $('#accueilB5 a').click(function(){

         var me = $(this);

         var nameModule = ( $(this).attr('rel') );

         $.get(urlAjax + 'loadsousmenu.php?module='+ nameModule,
         function(data) {



         $(".fleche").removeClass('fleche');

         $('#accueilB5 .jsSmenuAcq').fadeOut(200, function(){

         $(this).remove();

         me.children('span').addClass('fleche');

         $('<div class="jsSmenuAcq" >'+data+'</div>').appendTo(me.parent()).hide();
         ;
         $('#accueilB5 .jsSmenuAcq').fadeIn(300, function(){ $(this).show();});
         } );



         });

         return false;
         });
         */
        /*
         $('#accueilB5 a').click(function(){

         $('.jsSmenuAcq').remove();
         var me = $(this);
         var nameModule = ( $(this).attr('rel') );


         $.get(urlAjax + 'loadsousmenu.php?module='+ nameModule,
         function(data) {



         $(".fleche").removeClass('fleche');

         //$('#accueilB5 .jsSmenuAcq').fadeOut(200, function(){



         me.children('span').addClass('fleche');
         me.after('<div class="jsSmenuAcq">'+data+'</div>');

         $('.jsSmenuAcq').hide().show('slow');


         });

         return false;
         });

         */



        // Si l'écran est plus grand que le menu + l'entete, on passe le menu en fixe
        // 50 étant la marge de sécurité

        if((window.innerHeight - 100) - ($('#menuVertical').height() + $('#entete').height()) > 0  ){
            $('#menuVertical').css('position','fixed');
        }

//					$('#menuVertical').stickyMojo({footerID: '#end', contentID: '#wrapper'});



        // appel de ckeditor
        $( 'textarea.editor' ).ckeditor(function() { /*toolbar : 'Classique'*/ }, {toolbar : 'Classique' } );

        // toolbar personalisée ( à faire)
        $( 'textarea.editor_document' ).ckeditor(function() { /*toolbar : 'Classique'*/ }, {
                toolbar : 'Documents' }

        );

        $('#accordion').accordion({
            heightStyle: "content"
        });




        // Fin boucle jquery
    });
function gestMenuPrincipal(elem) {
    elem.css('width', '270px');
    elem.children('span.libel').show('fast');
}
function gestMenuPrincipalHover(elem) {
    $('#menuVertical li a').mouseover(function() {
        newId = $(this).attr('id')
    })
    if (elem.attr('id') == newId) {
        gestMenuPrincipal(elem);

    }

}
function restaureMenuPrincipal() {
    $('#menuVertical li a').css('width', '100%');
    $('#menuVertical li a span').hide('fast');
}
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
    return tableSelector.DataTable( {
        paging: false,
        "iDisplayLength" : 100,
        "bJQueryUI" : true,
        "oLanguage" : {
            "sUrl" : url + "fr_FR.txt"
        },
        "sPaginationType" : "full_numbers"
    } );
}

