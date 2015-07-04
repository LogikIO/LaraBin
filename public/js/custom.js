function autoCloseAlert(string, delay) {
    var alert = $('#site-alert:contains('+string+')');
    window.setTimeout(function() { alert.fadeOut('slow') }, delay);
}

autoCloseAlert('Successfully logged in!', 3000);
autoCloseAlert('See ya later!', 3000);

$('body').on('keydown','[name="username"],[name="email"],[name="useremail"]',function(e){
    return e.which !== 32;
});