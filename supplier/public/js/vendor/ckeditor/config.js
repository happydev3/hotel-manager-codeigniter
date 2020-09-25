/**
 * @license Copyright (c) 2003-2017, CKSource - Frederico Knabben. All rights reserved.
 * For licensing, see LICENSE.md or http://ckeditor.com/license
 */

CKEDITOR.editorConfig = function( config ) {
	// Define changes to default configuration here. For example:
	// config.language = 'fr';
	// config.uiColor = '#AADC6E';

	config.contentsCss = '../public/js/vendor/ckeditor/fonts.css';
	// the next line add the new font to the combobox in CKEditor
	config.font_names = 'Roboto/Roboto;' + config.font_names;

	config.font_names = 'Roboto, sans-serif';

	config.font_names = 'Roboto';

};

var tools = {
  // Define the toolbar groups as it is a more accessible solution.
  toolbarGroups: [
    {"name":"basicstyles","groups":["basicstyles"]},
    {"name":"links","groups":["links"]},
    {"name": 'paragraph',"groups":['align', 'list']},
    {"name":'clipboard', "groups":['Cut', 'Copy', 'Paste', 'PasteText', 'PasteFromWord', '-', 'Undo', 'Redo']},
    // {"name":"insert","groups":["insert"]},
    {"name":"styles","groups":["styles"]},
    {"name":"colors","groups":["Colors"]},
    {"name":"document","groups":["Print"]},
  ],
  // Remove the redundant buttons from toolbar groups defined above.
  removeButtons: 'Strike,Subscript,Superscript,Anchor,Styles,Specialchar,Save,Preview,NewPage,Format'
}
