/**
 * @license Copyright (c) 2003-2013, CKSource - Frederico Knabben. All rights reserved.
 * For licensing, see LICENSE.html or http://ckeditor.com/license
 */
CKEDITOR.editorConfig = function( config ) {
    // Define changes to default configuration here. For example:
    //config.language = 'tr';
    //config.skin = 'office2013';
    config.entities = false;
    config.entities_latin = false;
    config.htmlEncodeOutput = false;
    config.toolbar = [
        { name: 'document', groups: [ 'mode', 'document', 'doctools' ], items: [ 'Source', '-', 'Save', 'NewPage', 'Preview', 'Print', '-', 'Templates' ] },
        { name: 'clipboard', groups: [ 'clipboard', 'undo' ], items: [ 'Cut', 'Copy', 'Paste', 'PasteText', 'PasteFromWord', '-', 'Undo', 'Redo' ] },
        { name: 'editing', groups: [ 'find', 'selection', 'spellchecker' ], items: [ 'Find', 'Replace', '-', 'SelectAll', '-' ] },

        '/',
        { name: 'basicstyles', groups: [ 'basicstyles', 'cleanup' ], items: [ 'Bold', 'Italic', 'Underline', 'Strike', 'Subscript', 'Superscript', '-', 'RemoveFormat' ] },
        { name: 'paragraph', groups: [ 'list', 'indent', 'blocks', 'align', 'bidi' ], items: [ 'NumberedList', 'BulletedList', '-', 'Outdent', 'Indent',  '-', 'JustifyLeft', 'JustifyCenter', 'JustifyRight', 'JustifyBlock', '-', 'BidiLtr', 'BidiRtl', 'Language' ] },
        { name: 'links', items: [ 'Link', 'Unlink'] },
        { name: 'insert', items: [ 'Image', 'Flash', 'Table' ] },
        { name: 'styles', items: [ 'Styles', 'Format', 'Font', 'FontSize' ] },
        { name: 'colors', items: [ 'TextColor', 'BGColor' ] },
        { name: 'tools', items: [ 'Maximize' ] },
        { name: 'others', items: [ '-' ] }
    ];

    config.filebrowserBrowseUrl = '/backend/ckfinder/ckfinder.html';
    config.filebrowserImageBrowseUrl = '/backend/ckfinder/ckfinder.html?Type=Images';
    config.filebrowserFlashBrowseUrl = '/backend/ckfinder/ckfinder.html?Type=Flash';
    config.filebrowserUploadUrl = '/backend/ckfinder/core/connector/php/connector.php?command=QuickUpload&type;=Files';
    config.filebrowserImageUploadUrl = '/backend/ckfinder/core/connector/php/connector.php?command=QuickUpload&type;=Images';
    config.filebrowserFlashUploadUrl = '/backend/ckfinder/core/connector/php/connector.php?command=QuickUpload&type;=Flash';
};





