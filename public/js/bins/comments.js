$errors = $('#errors').hide();
$comment = $('#comment');
tabOverride.set(document.getElementById('comment'));
tabOverride.tabSize(4);
tabOverride.autoIndent(false);
$comment.submit(function(e){
    if ($.trim($comment.val()) == '') {
        e.preventDefault();
        processError('Comment cannot be blank!');
    }
});

function processError(error) {
    $errors.text(error).show();
    throw error;
}

$(document).ready(function() {
    $('.markcomment pre code').each(function(i, block) {
        hljs.highlightBlock(block);
    });
});