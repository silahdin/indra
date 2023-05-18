CKEDITOR.editorConfig = function (config) {

// To disable CKEditor ACF
config.allowedContent = true;
config.uiColor = '#ffffff';
config.dialog_backgroundCoverColor = '#888888';
config.skin = 'moono';
config.enterMode = CKEDITOR.ENTER_BR;
config.shiftEnterMode = CKEDITOR.ENTER_BR;
config.entities_latin = false;
config.protectedSource.push(/<script[\s\S]*?<\/script>/gi);   // <SCRIPT> tags.

config.toolbar_Full = config.toolbar_Default =
[
    ['Source', '-'],
    ['Cut', 'Copy', 'Paste', 'PasteText', 'PasteFromWord', 'SpellChecker', 'Scayt', '-'],
    ['Undo', 'Redo', 'Find', 'Replace', 'RemoveFormat', '-'],
    //['Bold', 'Italic', 'Underline', 'Strike', 'Subscript', 'Superscript', '-'],
    //['NumberedList', 'BulletedList', 'Outdent', 'Indent', 'Blockquote','CreateDiv', '-'],
    ['NumberedList', 'BulletedList', 'Outdent', 'CreateDiv', 'Blockquote', '-'],
    //['JustifyLeft', 'JustifyCenter', 'JustifyRight', 'JustifyBlock', '-'],
    ['InsertLink', 'Unlink', 'Anchor', '-'],
    //['InsertImageOrMedia', 'QuicklyInsertImage', 'Table', 'HorizontalRule', 'SpecialChar', '-'],
    ['InsertImageOrMedia', 'Table', 'SpecialChar', '-'],
    //['InsertForms', 'InsertPolls', 'InsertRating', 'InsertYouTubeVideo', 'InsertWidget', '-'],
    ['InsertForms', 'InsertYouTubeVideo', 'InsertWidget', '-'],
    //['Styles', 'Format', 'Font', 'FontSize'],
    ['Styles', '-'],
    //['TextColor', 'BGColor', '-'],
    //['InsertMacro', '-'],
    ['Maximize', 'ShowBlocks']
];

config.toolbar = config.toolbar_Full;

config.scayt_customerid = '***';};