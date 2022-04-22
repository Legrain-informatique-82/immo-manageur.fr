/*
 * UPD lgr
 */


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
						url;
					} else {
						url = url.substr(0, explo) ;
					}

//alert(url);
/*
 *  /upd Lgr
 */
					
					
/*
Copyright (c) 2003-2011, CKSource - Frederico Knabben. All rights reserved.
For licensing, see LICENSE.html or http://ckeditor.com/license
*/
CKEDITOR.config.toolbar_Classique =
[
	['Source','-','Preview','-','Templates'],
	['Cut','Copy','Paste','PasteText','PasteFromWord','-', 'SpellChecker', 'Scayt'],
	['Undo','Redo','-','Find','Replace','-','SelectAll','RemoveFormat'],
	'/',
	['Bold','Italic','Underline','Strike','-','Subscript','Superscript'],
	['NumberedList','BulletedList','-','Outdent','Indent','Blockquote','CreateDiv'],
	['JustifyLeft','JustifyCenter','JustifyRight','JustifyBlock'],
	['Link','Unlink','Anchor'],
	['Image','Table','HorizontalRule','Smiley','SpecialChar',],
	'/',
	['Styles','Format','Font','FontSize'],
	['TextColor','BGColor'],
	['Maximize', 'ShowBlocks','-']
];

CKEDITOR.config.toolbar_Documents =
    [
        ['Source','-','Templates'],
        ['Cut','Copy','Paste','PasteText','PasteFromWord','-', 'SpellChecker', 'Scayt'],
        ['Undo','Redo','-','Find','Replace','-','SelectAll','RemoveFormat'],
        '/',
        ['Bold','Italic','Underline','Strike','-','Subscript','Superscript'],
        ['NumberedList','BulletedList','-','Outdent','Indent','Blockquote','CreateDiv'],
        ['JustifyLeft','JustifyCenter','JustifyRight','JustifyBlock'],
        ['Link','Unlink','Anchor'],
        ['Image','Table','HorizontalRule','Smiley','SpecialChar',],
        '/',
        ['Styles','Format','FontSize'],
        ['TextColor','BGColor'],
        ['Maximize', 'ShowBlocks','-']
    ];


// mettre la valeur dans le dom ... pas d'autres choix ...
CKEDITOR.editorConfig = function( config )
{
	// Define changes to default configuration here. For example:
	// config.language = 'fr';
	// config.uiColor = '#AADC6E';
config.entities_latin = false;

config.language = 'fr';
 config.filebrowserBrowseUrl = url+'/libs/kcfinder/browse.php?type=files';
   config.filebrowserImageBrowseUrl =url+ '/libs/kcfinder/browse.php?type=images';
   config.filebrowserFlashBrowseUrl = url+'/libs/kcfinder/browse.php?type=flash';
   config.filebrowserUploadUrl =url+ '/libs/kcfinder/upload.php?type=files';
   config.filebrowserImageUploadUrl = url+'/libs/kcfinder/upload.php?type=images';
   config.filebrowserFlashUploadUrl =url+ '/libs/kcfinder/upload.php?type=flash';
    config.skin = 'bootstrapck';
};
