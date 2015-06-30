<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
<script src="{{ asset('js/custom.js') }}"></script>
@yield('customjsfiles')

<script>
    $(function() {

        var csrf = $('meta[name=_token]').attr('content');

        $.ajaxSetup({
            beforeSend: function(request) {
                return request.setRequestHeader('X-CSRF-Token', csrf);
            }
        });

        @yield('customjs')

    });
</script>