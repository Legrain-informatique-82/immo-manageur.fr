var oTable2;
var giRedraw = false;
$(document).ready(function() {

	// recup de l'url
	url = window.location.href;
	explo = url.indexOf('/mod-');

	if(explo == -1) {
		urlCss = url + '/css/';
	} else {
		urlCss = url.substr(0, explo) + '/css/';
	}
	if(explo == -1) {
		urlAjax = url + '/ajax/';
	} else {
		urlAjax = url.substr(0, explo) + '/ajax/';
	}
	if(explo == -1) {
		url += '/js/';
	} else {
		url = url.substr(0, explo) + '/js/';
	}
	// Ajout des css "uiCupertino" au site
	//$('head').append('	');
	// datepickers
	$(".datepicker").datepicker($.datepicker.regional['fr']).attr('autocomplete', 'off');

	$(".dateTimepicker").datetimepicker({
	timeOnlyTitle: 'Choix de l\'heure',
	timeText: 'à',
	hourText: 'Heures : ',
	minuteText: 'Minutes : ',
	secondText: 'Secondes : ',
	currentText: 'Maintenant',
	closeText: 'Fermer',
	showSecond: false,
	timeFormat: 'hh:mm:ss'

	}).attr('autocomplete', 'off');

	// datatable
	/* Add a click handler to the rows - this could be used as a callback */
	$("table.listMandat tbody tr").hover(function(event) {
		$(oTable2.fnSettings().aoData).each(function() {
			$(this.nTr).removeClass('row_selected');
		});
		$(this).addClass('row_selected');
		// Appel d'un script php qui va chercher et qui affiche l'image par defaut...
		$.get(urlAjax + 'getPicture.php?idMandate=' + $(this).attr('rel'), function(data) {
			// supprime ce qui a été ajouté
			$('#miniature > p,#miniature > img').remove();
			// Rajoute en fct du mandat
			$('#miniature').prepend(data);
		});
	});
	$('#listVignettes img').click(function() {

		//contient idPicture
		$(this).attr('rel');
		$.get(urlAjax + 'getPicture2.php?idPicture=' + $(this).attr('rel'), function(data) {

			var data = jQuery.parseJSON(data);

			if(!$('#grdF').attr('src')) {
				$('#contentBigPicture').append('<img src="" alt="" id="grdF"/>');
			}
			$('#grdF').attr('src', data.url);
			// Ajout du paragraphe image principale si c'est le cas.

			// remove
			$('.jsIndic').remove();
			if(data.isDefault == 1) {
				$('#contentBigPicture').append('<p class="jsIndic">Image principale</p>');
			}
			if(data.autorized == 1) {
				// Ajout des boutons
				if(data.isDefault == 0) {
					// on ajoute le bouton définir comme principale
					$('#contentBigPicture').append('<form action="" method="post" class="jsIndic"><p><input type="hidden" name="idMandate" value="' + data.idMandate + '"/><input type="hidden" name="idPicture" value="' + data.idPicture + '"/><input type="submit" name="sendPictureByDefault" value="Définir comme principale"/></p></form>');
				}
				// on ajoute le btn de suppression
				$('#contentBigPicture').append('<form action="" method="post" class="jsIndic"><p><input type="hidden" name="idMandate" value="' + data.idMandate + '"/><input type="hidden" name="idPicture" value="' + data.idPicture + '"/><input type="submit" value="Supprimer l\'image" name="delete_picture"/></p></form>');
			}
		});
	});
	/* Init the table */
	oTable2 = $('table.listMandat').dataTable({
		"iDisplayLength" : 100,
		"bJQueryUI" : true,
		"sScrollY" : 600,
		"bScrollCollapse" : true,
		"bPaginate" : false,
		"oLanguage" : {
			"sUrl" : url + "fr_FR.txt"
		},
		"sPaginationType" : "full_numbers"
	});
	oTable = $('table.standard').dataTable({
		"iDisplayLength" : 100,
		"bJQueryUI" : true,
		"oLanguage" : {
			"sUrl" : url + "fr_FR.txt"
		},
		"sPaginationType" : "full_numbers"
	});
	$('table.threeColumnWithFirstDate').dataTable({
		"bJQueryUI" : true,
		"oLanguage" : {
			"sUrl" : url + "fr_FR.txt"
		},
		"sPaginationType" : "full_numbers",
		"aaSorting" : [[0, "desc"]],
		"aoColumns" : [{
			"sType" : "date-euro"
		}, null, null]
	});
	$('table.twoColumnWithFirstDate').dataTable({
		"bJQueryUI" : true,
		"oLanguage" : {
			"sUrl" : url + "fr_FR.txt"
		},
		"sPaginationType" : "full_numbers",
		"aaSorting" : [[0, "desc"]],
		"aoColumns" : [{
			"sType" : "date-euro"
		}, null]
	});

	$('table.triActions').dataTable({
		"bJQueryUI" : true,
		"oLanguage" : {
			"sUrl" : url + "fr_FR.txt"
		},
		"sPaginationType" : "full_numbers",
		"aaSorting" : [[0, "asc"]],
		"aoColumns" : [{
			"sType" : "date-euro"
		}, {
			"sType" : "date-euro"
		}, null, null]
	});

	$('table.triActionsBis').dataTable({
		"bJQueryUI" : true,
		"oLanguage" : {
			"sUrl" : url + "fr_FR.txt"
		},
		"sPaginationType" : "full_numbers",
		"aaSorting" : [[0, "desc"]],
		"aoColumns" : [{
			"sType" : "date-euro"
		},          /* {
		 "sType": "date-euro"
		 },*/
		null, null, null, null, null]
	});
	$('table.triActionsOld').dataTable({
		"bJQueryUI" : true,
		"oLanguage" : {
			"sUrl" : url + "fr_FR.txt"
		},
		"sPaginationType" : "full_numbers",
		"aaSorting" : [[0, "desc"]],
		"aoColumns" : [{
			"sType" : "date-euro"
		}, {
			"sType" : "date-euro"
		},          /* {
		 "sType": "date-euro"
		 }, */
		null, null, null, null, null]
	});

	/* Add terrain ( verif js ) */
	var prixNetVendeur = $('#prixNetVendeur');
	var prixFai = $('#prixFai');
	var commissionMandat = $('#commissionMandat');

	$('#prixNetVendeur,#prixFai').live('focusout keyup click', function() {
		commissionMandat.val(roundNumber(prixFai.val() -
		prixNetVendeur.val(), 2));
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
	$('.jsdelUser').click(function() {
		idUser = $(this).attr('rel');
		// recup de l'id identifiant
		if(confirm("Voulez-vous supprimer le membre ?")) { // Clic sur OK
			parent = $(this).parent().parent();
			$.get(urlAjax + 'delete_user.php?idUser=' + idUser, function(data) {
				obj = $.parseJSON(data);
				alert(obj.message);
				if(obj.done == '1')
					parent.remove();
			});
		}
		return false;
	});
	/**
	 * Suppression d'un titre vendeur
	 */
	//
	$('.jsdelTitleSeller').click(function() {
		id = $(this).attr('rel');
		// recup de l'id identifiant
		if(confirm("Voulez-vous supprimer le titre ?")) { // Clic sur OK
			parent = $(this).parent().parent();
			$.get(urlAjax + 'delete_title_seller.php?id=' + id, function(data) {
				obj = $.parseJSON(data);
				alert(obj.message);
				if(obj.done == '1')
					parent.remove();
			});
		}
		return false;
	});
	/**
	 * Suppression d'un titre vendeur
	 */
	//
	$('.jsdelSeller').click(function() {
		id = $(this).attr('rel');
		// recup de l'id identifiant
		if(confirm("Voulez-vous supprimer le vendeur ?")) { // Clic sur OK
			parent = $(this).parent().parent();
			$.get(urlAjax + 'delete_seller.php?id=' + id, function(data) {
				obj = $.parseJSON(data);
				alert(obj.message);
				if(obj.done == '1')
					parent.remove();
			});
		}
		return false;
	});
	$('.jsDelNotary').click(function() {
		id = $(this).attr('rel');
		// recup de l'id identifiant
		if(confirm("Voulez-vous supprimer le notaire ?")) { // Clic sur OK
			parent = $(this).parent().parent();
			$.get(urlAjax + 'delete_notary.php?id=' + id, function(data) {
				obj = $.parseJSON(data);
				alert(obj.message);
				if(obj.done == '1')
					parent.remove();
			});
		}
		return false;
	});
	$('.jsDelSector').click(function() {
		id = $(this).attr('rel');
		// recup de l'id identifiant
		if(confirm("Voulez-vous supprimer le secteur ?")) { // Clic sur OK
			parent = $(this).parent().parent();
			$.get(urlAjax + 'delete_sector.php?id=' + id, function(data) {
				obj = $.parseJSON(data);
				alert(obj.message);
				if(obj.done == '1')
					parent.remove();
			});
		}
		return false;
	});
	$('.jsDelCity').click(function() {
		id = $(this).attr('rel');
		// recup de l'id identifiant
		if(confirm("Voulez-vous supprimer la ville ?")) { // Clic sur OK
			parent = $(this).parent().parent();
			$.get(urlAjax + 'delete_city.php?id=' + id, function(data) {
				obj = $.parseJSON(data);
				alert(obj.message);
				if(obj.done == '1')
					parent.remove();
			});
		}
		return false;
	});
	$('.jsDelAcquereur').click(function() {
		id = $(this).attr('rel');
		// recup de l'id identifiant
		if(confirm("Voulez-vous supprimer l'acquereur ?")) { // Clic sur OK
			parent = $(this).parent().parent();
			$.get(urlAjax + 'delete_acquereur.php?id=' + id, function(data) {
				//							 alert(data);
				obj = $.parseJSON(data);
				alert(obj.message);
				if(obj.done == '1')
					parent.remove();
			});
		}
		return false;
	});
	/**
	 * Vendeur act/inactif
	 */
	$('.jsNone').remove();
	$('#seeAsset').click(function() {
		var toogle = 0;
		if($(this).is(':checked'))
			toogle = 1;
		$.get(urlAjax + 'load_seller.php?toogle=' + toogle, function(data) {
			oTable.fnDestroy();
			$('.standard').html(data).dataTable({
				"iDisplayLength" : 100,
				"bJQueryUI" : true,
				"oLanguage" : {
					"sUrl" : url + "fr_FR.txt"
				},
				"sPaginationType" : "full_numbers"
			});

			$('.jsdelSeller').click(function() {
				id = $(this).attr('rel');
				// recup de l'id identifiant
				if(confirm("Voulez-vous supprimer le vendeur ?")) { // Clic sur OK
					parent = $(this).parent().parent();
					$.get(urlAjax + 'delete_seller.php?id=' + id, function(data) {
						obj = $.parseJSON(data);
						alert(obj.message);
						if(obj.done == '1')
							parent.remove();
					});
				}
				return false;
			});
		})
	});
	/**
	 *  Afficher les mandats pour rapprochement
	 */
	$('#allMandat').click(function() {
		var toogle = 0;
		if($(this).is(':checked'))
			toogle = 1;
		acq = $(this).attr('rel');
		$.get(urlAjax + 'load_mandates.php?toogle=' + toogle + '&acq=' + acq, function(data) {
			obj = $.parseJSON(data);
			$('#h2Change').html(obj.h2);

			$('#contentMandates').html(obj.html);
			// nouvelle instance de .standard

			$('.standard').dataTable({
				"iDisplayLength" : 100,
				"bJQueryUI" : true,
				"oLanguage" : {
					"sUrl" : url + "fr_FR.txt"
				},
				"sPaginationType" : "full_numbers"
			});

			// fin ajout

		});
	})
	$('#seeAssetAc').click(function() {
		var toogle = 0;
		if($(this).is(':checked'))
			toogle = 1;
		$.get(urlAjax + 'load_acquereur.php?toogle=' + toogle, function(data) {
			oTable.fnDestroy();
			$('.standard').html(data).dataTable({
				"iDisplayLength" : 100,
				"bJQueryUI" : true,
				"oLanguage" : {
					"sUrl" : url + "fr_FR.txt"
				},
				"sPaginationType" : "full_numbers"
			});
			$('.jsDelAcquereur').click(function() {
				id = $(this).attr('rel');
				// recup de l'id identifiant
				if(confirm("Voulez-vous supprimer l'acquereur ?")) { // Clic sur OK
					parent = $(this).parent().parent();
					$.get(urlAjax + 'delete_acquereur.php?id=' + id, function(data) {
						//										 alert(data);
						obj = $.parseJSON(data);
						alert(obj.message);
						if(obj.done == '1')
							parent.remove();
					});
				}
				return false;
			});
		})
	});
	var countPictures = 0;
	$('.arrayPicture').click(function() {

		if($(this).is(':checked')) {
			//					alert($(this).val()+'zz');
			if(countPictures >= 3) {
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
	if($('#typeBien').val() == 1)
		$('#pStyle').hide();
	$('#typeBien').change(function() {
		if($('#typeBien').val() == 1) {
			$('#pStyle').hide();
		} else {
			$('#pStyle').show();
		}
	});
	//				$('#choosePicturegenerateAfficheMandate').hide();
	if($('#une').is(':checked')) {
		$("#choosePicturegenerateAfficheMandate").hide();
	}
	$(':radio[name=photos]').click(function() {
		if($('#quatre').is(':checked')) {
			$('#choosePicturegenerateAfficheMandate').show();
		} else {
			$('#choosePicturegenerateAfficheMandate').hide();
		}

	})
	/*
	 Bug de la carte ...
	 Il faudrait la charger avant le tabs
	 * */

	$("#tabs").tabs();

	$( ".accordion" ).accordion({
		autoHeight : false,
		navigation : true,
		collapsible : true,
		active : parseInt($( ".accordion" ).attr('rel'))
	});

	$('.accordion .head').click( function() {
	$(this).next().toggle('slow');
	return false;
	}).next().hide();
	$('.accordion h2 a').click(function() {
		if($(this).attr('rel') == 'gen') {
			//alert($(this).attr('rel'));*
			// activation de la map
			// map
			var latitude = $('#latitude').text();
			var longitude = $('#longitude').text();

			$("#map").css('width','100%').css('height','540px').gmap3({
				action : 'addMarker',
				//address: "place de l'étoile, paris",
				lat : latitude,
				lng : longitude,
				map : {
					center : true,

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
	$( ".accordionStandard" ).accordion({
		autoHeight : false,
		navigation : true,
		collapsible : true,
		active : parseInt($( ".accordionStandard" ).attr('rel'))
	});

	$('.accordionStandard .head').click( function() {
	$(this).next().toggle('slow');
	return false;
	}).next().hide();

	//alert( $(".accordion").val() );

	// test upload...
	// ajout des éléments....
	//file_upload
	$('.uploadMultiple input').remove();
	$('.uploadMultiple label').remove();

	$('.uploadMultiple').append('Ajouter les images du mandat :  	<div id="status-message"></div><div id="custom-queue"></div> <input id="file_upload" name="file_upload" type="file" />');
	// Voir mandat ou terrain ...
	$('#file_upload').uploadify({
		'uploader' : '../../ajax/uploadify.swf',
		'script' : '../../ajax/upload.php',  // 'script'    : '../../ajax/upload.php?idMandat='+$('#idMandate').val()+'&idSess='+$('#idSess').val(),        //'script'    : 'uploadify.php',
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
			$('#status-message').text(data.filesSelected + ' fichiers ont été ajouté à la file d\'attente.');
		},
		'onAllComplete' : function(event, data) {
			$('#status-message').text(data.filesUploaded + ' fichiers envoyés, ' + data.errors + ' erreurs.');
			document.location.reload();
		}
	});
	// fin test upload

	// Modifier les descriptions
	//tableUpdateMandateDescription

	$('#tableUpdateMandateDescription').after('<p><a href="#" id="addLine">Ajouter une ligne</a></p> ');
	$('#addLine').click(function() {
		$('#tableUpdateMandateDescription').append('<tr><td><input type="hidden" name="id[]" value="" /><input type="text" name="niveau[]" value=""/></td><td><input type="text" name="piece[]" value=""/></td><td><input type="text" name="surface[]" value=""/></td><td><input type="text" name="carac[]" value=""/></td><td>NC</td></tr>');
		return false;
	});
	$('.jsAddLinkNewLine').append('<p><a href="#" class="addLine">Ajouter une ligne</a></p>');
	$('.addLine').click(function() {
		var rel = $(this).parent().parent().attr('rel');
		$(this).parent().parent().prepend('<p><input type="hidden" name="type[]" value="' + rel + '" /><input type="hidden" name="id[]" value="" />Position : <input type="text" name="pos[]" value="" class="minText"/> Libellé : <textarea class="trenteCinq" name="libel[]"  cols="30" rows="10"></textarea> Valeur : <textarea class="trenteCinq" name="val[]"  cols="30" rows="10"></textarea>Supprimer ? <input type="checkbox" name="del[]" disabled="disabled" value="" /></p>');
		return false;
	})
	$('.jsCheckAll').click(function() {
		var idPasserelle = $(this).attr('rel');
		if($(this).is(':checked')) {
			//alert(idPasserelle);
			// cocher toute la rangée
			$('input:checkbox[rel|="'+idPasserelle+'"]').attr('checked', 'checked');

		} else {
			// décocher toute la rangée
			$('input:checkbox[rel|="'+idPasserelle+'"]').removeAttr('checked');
		}
	});
	
	$('.chooseCritereMandate').live('change' ,function() {


       var type =  $(this).find("option:selected").attr('class') ;
                
      
       //
//alert(type);
	if(type == 'simple') {
	$(this).parent().children('.complementWithJs').replaceWith('<span class="complementWithJs"><input type="text"  name="val1[]" /> <input type="hidden" name="val2[]" value=""/><input type="hidden" name="type[]" value="'+type+'"/><input type="hidden" name="table[]" value=""/></span>');
	} else if(type == 'double') {
	$(this).parent().children('.complementWithJs').replaceWith('<span class="complementWithJs"><input type="text"  name="val1[]" /> et <input type="text"  name="val2[]" /><input type="hidden" name="type[]" value="'+type+'"/><input type="hidden" name="table[]" value=""/></span>');
	} else if(type == 'empty') {
	$(this).parent().children('.complementWithJs').replaceWith('<span class="complementWithJs"></span>');

	} else {
	// type contient le nom de la table de la liste à afficher.
	var pa = $(this).parent();
	$.get(urlAjax + 'loadList.php?class=' + type, function(data) {
		
	pa.children('.complementWithJs').replaceWith('<span class="complementWithJs">'+data+'</span>');
	});
	}
	// il faut chopper le type (single,double ou list)

	});


	// ajout d'une ligne de recherche
	//Critere_mandate
	$('#addNewRecherchLine').click(function(){
	var pa=$(this);
	$.get(urlAjax + 'loadList.php?class=' + $(this).attr('class'), function(data) {

	//pa.parent().prepend(data);
	$('.lineCritere:last').after(data);

	});
	return false;
	} );
	
	
	$('.delLineRecherche').live('click',function(){
		$(this).parent().remove();
		return false;
	});

	// Fin boucle jquery
});
function roundNumber(number, digits) {
	var multiple = Math.pow(10, digits);
	var rndedNum = Math.round(number * multiple) / multiple;
	return rndedNum;
}

function toogleLocateSell() {
	if($('#typeTransaction').val() == 1) {
		$('#jsPrixFai').html('Loyer + frais d\'agences');
		$('#jsPrixNetVendeur').html('Loyer');
		$('#jsEstim').hide();
		$('#jsEstimMaxi').hide();
		$('#jsMargeNegoce').hide();
	} else {
		$('#jsPrixFai').html('Prix FAI');
		$('#jsPrixNetVendeur').html('Prix net vendeur');
		$('#jsEstim').show();
		$('#jsEstimMaxi').show();
		$('#jsMargeNegoce').show();
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
		monthNames : ['Janvier', 'Février', 'Mars', 'Avril', 'Mai', 'Juin', 'Juillet', 'Août', 'Septembre', 'Octobre', 'Novembre', 'Décembre'],
		monthNamesShort : ['Jan', 'Fév', 'Mar', 'Avr', 'Mai', 'Jun', 'Jul', 'Aoû', 'Sep', 'Oct', 'Nov', 'Déc'],
		dayNames : ['Dimanche', 'Lundi', 'Mardi', 'Mercredi', 'Jeudi', 'Vendredi', 'Samedi'],
		dayNamesShort : ['Dim', 'Lun', 'Mar', 'Mer', 'Jeu', 'Ven', 'Sam'],
		dayNamesMin : ['Di', 'Lu', 'Ma', 'Me', 'Je', 'Ve', 'Sa'],
		weekHeader : 'Sm',
		dateFormat : 'dd/mm/yy',
		firstDay : 1,
		isRTL : false,
		showMonthAfterYear : false,
		yearSuffix : ''
	};
	$.datepicker.setDefaults($.datepicker.regional['fr']);
});
function fnGetSelected(oTableLocal) {
	var aReturn = new Array();
	var aTrs = oTableLocal.fnGetNodes();

	for(var i = 0; i < aTrs.length; i++) {
		if($(aTrs[i]).hasClass('row_selected')) {
			aReturn.push(aTrs[i]);
		}
	}
	return aReturn;
}