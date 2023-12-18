/**
 * @license Copyright (c) 2003-2021, CKSource - Frederico Knabben. All rights reserved.
 * For licensing, see https://ckeditor.com/legal/ckeditor-oss-license
 */

CKEDITOR.editorConfig = function( config ) {
	// Define changes to default configuration here. For example:
	config.language = 'vi';
	// config.uiColor = '#AADC6E';
	config.htmlEncodeOutput = false;
	config.ProcessHTMLEntities = false;
	config.entities = false;
	config.entities_latin = false;
	config.removeDialogTabs = 'image:advanced;link:advanced';
	//config.font_names = 'Roboto';
	CKEDITOR.config.font_names = 'Arial; Helvetica;' +
	'Comic Sans MS; cursive;' +
	'Courier New;' +
	'Georgia;' +
	'Lucida Sans Unicode; Lucida Grande;' +
	'Tahoma; Geneva;' +
	'Times New Roman;' +
	'Trebuchet MS;Helvetica;' +
	'Verdana;Geneva;' +
	'Roboto;';
};
