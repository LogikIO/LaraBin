// initialize the editor
var editor = ace.edit('editor-area');
editor.setTheme("ace/theme/chrome");
// follow PSR-2
editor.getSession().setTabSize(4);
editor.getSession().setUseSoftTabs(true);
editor.getSession().setMode('ace/mode/markdown');

var textarea = $('.editor-instance .message');
editor.getSession().setValue(textarea.val());
editor.getSession().on('change', function(){
    textarea.val(editor.getSession().getValue());
});