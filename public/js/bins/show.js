$(document).ready(function() {
    $('.highlightable pre code').each(function(i, block) {
        hljs.highlightBlock(block);
        hljs.lineNumbersBlock(block);
    });
});

$(document).ready(function() {
    $('.markrender pre code').each(function(i, block) {
        hljs.highlightBlock(block);
    });
});

$('#tweet-bin-button').click(function() {
    bootbox.dialog({
        message: "Are you sure you want to tweet this bin?",
        title: "Tweet Bin",
        buttons: {
            success: {
                label: "Yes",
                className: "btn-success",
                callback: function() {
                    // continue form propagation
                    $('#tweet-bin').submit();
                }
            },
            danger: {
                label: "Cancel",
                className: "btn-danger",
                callback: function() {
                    // Cancel propagation
                }
            }
        }
    });
});