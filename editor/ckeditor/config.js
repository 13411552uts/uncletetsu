/*
Copyright (c) 2003-2012, CKSource - Frederico Knabben. All rights reserved.
For licensing, see LICENSE.html or http://ckeditor.com/license
*/
/*
CKEDITOR.editorConfig = function( config )
{
	// Define changes to default configuration here. For example:
	 config.language = 'vi';
	// config.uiColor = '#AADC6E';
};
*/
var Core = {
		baseUrl:'http://localhost/nhk.com'
}
jQuery(function($)
{
	/*
	var config = {
		toolbar:
		[
			['Bold', 'Italic', '-', 'NumberedList', 'BulletedList', '-', 'Link', 'Unlink'],
			['UIColor']
		]
	};
	 */
	var config = {
		language:'eng',
		filebrowserImageBrowseUrl:Core.baseUrl + '/editor/ckeditor/ckeditor.html',
		filebrowserFlashBrowseUrl:Core.baseUrl + '/editor/ckeditor/ckeditor.html',
		filebrowserUploadBrowseUrl:Core.baseUrl + '/editor/ckeditor/ckeditor.html'	
	};
	// Initialize the editor.
	// Callback function can be passed and executed after full instance creation.
	$('.jquery_ckeditor').ckeditor(config);
});
