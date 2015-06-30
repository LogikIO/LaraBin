@if(session()->has('success') || session()->has('error'))
    <div id="site-alert" class="alert alert-dismissible {{ session()->has('success') ? 'alert-success' : 'alert-danger' }}">
        <button type="button" class="close" data-dismiss="alert">&times;</button>
        {!! session()->get('success') !!}{!! session()->get('error') !!}
    </div>
@endif