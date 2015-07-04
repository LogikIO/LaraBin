<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
<script src="{{ asset('vendors/ifightcrime-bootstrap-growl/jquery.bootstrap-growl.min.js') }}"></script>
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
    
    (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
        (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
            m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
    })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

    ga('create', 'UA-64775324-1', 'auto');
    ga('send', 'pageview');
</script>