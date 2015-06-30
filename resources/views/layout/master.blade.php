<!DOCTYPE html>
<html lang="en">
    @include('layout.partials.head')
    <body>
        @include('layout.partials.navbar')

        @include('layout.partials.alerts')

        <div class="container">
            @yield('content')
        </div>

        @include('layout.partials.footer')
    </body>
</html>