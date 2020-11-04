/**
 * @license Copyright (c) 2003-2019, CKSource - Frederico Knabben. All rights reserved.
 * For licensing, see https://ckeditor.com/legal/ckeditor-oss-license
 */

CKEDITOR.editorConfig = function( config ) {
	// Define changes to default configuration here. For example:
	// config.language = 'fr';
	// config.uiColor = '#AADC6E';
	
	config.extraPlugins = 'btgrid';
	
	config.filebrowserBrowseUrl = './../../../public/admin/plugin/ckfinder/ckfinder.html';
	config.filebrowserImageBrowseUrl = './../../../public/admin/plugin/ckfinder/ckfinder.html?type=Images';
	config.filebrowserFlashBrowseUrl = './../../../public/admin/plugin/ckfinder/ckfinder.html?type=Flash';
	config.filebrowserUploadUrl = './../../../public/admin/plugin/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files';
	config.filebrowserImageUploadUrl = './../../../public/admin/plugin/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images';
	config.filebrowserFlashUploadUrl = './../../../public/admin/plugin/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash';
};

