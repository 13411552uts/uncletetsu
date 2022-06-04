/*
Copyright (c) 2003-2010, CKSource - Frederico Knabben. All rights reserved.
For licensing, see LICENSE.html or http://ckeditor.com/license
*/

CKEDITOR.editorConfig = function( config )
{
	// Define changes to default configuration here. For example:
	// config.language = 'fr';
	// config.uiColor = '#AADC6E';
	config.toolbar = 'Full';
	config.toolbar_Full =
	[
		['Image','Flash','Table','HorizontalRule','SpecialChar','PageBreak'],
	    ['NewPage','PasteText','SpellChecker', 'Scayt'],
	    ['Find','Replace'],
	    ['Form', 'Checkbox', 'Radio', 'TextField', 'Textarea', 'Select', 'Button', 'ImageButton', 'HiddenField'],
	    '/',
	   	['Preview'],
	   	['Source','-','SelectAll','RemoveFormat','-','Bold','Italic','Underline','Strike','Subscript','Superscript'],
	    ['NumberedList','BulletedList','-','Outdent','Indent','Blockquote'],
	    ['JustifyLeft','JustifyCenter','JustifyRight','JustifyBlock'],
	    '/',
	    ['Styles','Format','Font','FontSize'],
	    ['TextColor','BGColor'],
	    ['Link','Unlink','Anchor'],
	   	['Maximize', 'ShowBlocks']
	];
};
