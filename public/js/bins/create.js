$errors = $('#errors').hide();

// array containing all the editors we will create
var editors = [];

function newFile() {
    $newEditor = $('#editor-template .editor-instance').clone();
    $newEditor.appendTo($('#editor-container'));
    var uniqueId = new Date().getTime() + Math.floor(Math.random()*10000);
    $newEditor.find('.editor-area').attr('id', 'editor_' + uniqueId);
    $newEditor.find('[name="name"]').attr('name', 'name['+uniqueId+']');
    $newEditor.find('[name="language"]').attr('name', 'language['+uniqueId+']');
    $newEditor.find('[name="code"]').attr('name', 'code['+uniqueId+']');
    $newEditor.find('.language, .delete-file').data('editor', uniqueId);

    // initialize the editor
    var editor = ace.edit('editor_' + uniqueId);
    editor.setTheme("ace/theme/chrome");
    // follow PSR-2
    editor.getSession().setTabSize(4);
    editor.getSession().setUseSoftTabs(true);

    var textarea = $newEditor.find('.real-code');
    editor.getSession().setValue(textarea.val());
    editor.getSession().on('change', function(){
        textarea.val(editor.getSession().getValue());
    });

    editors.push({ id: uniqueId, instance: editor });
}

$('#add-file').click(newFile);

// generate first file
newFile();

$(document).on('click', '.delete-file', function(){
    // remove editor from editors array
    var id = $(this).data('editor');

    editors = $.grep(editors, function(key) {
        return key.id != id;
    });

    // delete file instance
    $(this).closest('.editor-instance').remove();
});

$(document).on('change', '.language', function(){
    var mode = $(this).val();
    var id = $(this).data('editor');

    var resultArray = $.grep(editors, function(key){
        return key.id === id;
    });
    var editor = resultArray[0].instance;

    processLanguage(mode, editor);
});

function processLanguage(mode, editor) {
    var setMode;
    switch (mode) {
        case 'php': setMode = 'ace/mode/php'; break;
        case 'html': setMode = 'ace/mode/html'; break;
        case 'javascript': setMode = 'ace/mode/javascript'; break;
        case 'coffeescript': setMode = 'ace/mode/coffee'; break;
        case 'css': setMode = 'ace/mode/css'; break;
        case 'scss': setMode = 'ace/mode/scss'; break;
        case 'less': setMode = 'ace/mode/less'; break;
        case 'markdown': setMode = 'ace/mode/markdown'; break;
        case 'json': setMode = 'ace/mode/json'; break;
        case 'ini': setMode = 'ace/mode/ini'; break;
        case 'bash': setMode = 'ace/mode/sh'; break;
        case 'nohighlight': setMode = 'ace/mode/text'; break;
        default: setMode = 'ace/mode/text';
    }

    return editor.getSession().setMode(setMode);
}

$('form').submit(function(e){
    var fileCount = 0;
    $.each($('#editor-container .real-code'), function(){
        if ($(this).val() == '') {
            e.preventDefault();
            processError('All files must have content!');
        }
        fileCount++;
    });
    if (!fileCount) {
        e.preventDefault();
        processError('You must include at least one file!');
    }
});

function processError(error) {
    $errors.text(error).show();
    throw error;
}