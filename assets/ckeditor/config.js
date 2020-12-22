/**
 * @license Copyright (c) 2003-2020, CKSource - Frederico Knabben. All rights reserved.
 * For licensing, see https://ckeditor.com/legal/ckeditor-oss-license
 */

CKEDITOR.editorConfig = function (config) {
	// Define changes to default configuration here. For example:
	// config.language = 'fr';
	// config.uiColor = '#AADC6E';
	config.removePlugins = "easyimage, cloudservices,exportpdf";
	config.filebrowserBrowseUrl = `${BASE_URL}assets/kcfinder/browse.php?type=files`;
	config.filebrowserImageBrowseUrl = `${BASE_URL}assets/kcfinder/browse.php?type=images`;
	config.filebrowserFlashBrowseUrl = `${BASE_URL}assets/kcfinder/browse.php?type=flash`;
	config.filebrowserUploadUrl = `${BASE_URL}assets/kcfinder/upload.php?type=files`;
	config.filebrowserImageUploadUrl = `${BASE_URL}assets/kcfinder/upload.php?type=images`;
	config.filebrowserFlashUploadUrl = `${BASE_URL}assets/kcfinder/upload.php?type=flash`;
};
