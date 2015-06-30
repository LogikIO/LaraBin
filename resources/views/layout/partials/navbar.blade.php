<div class="navbar navbar-default">
    <div class="container">
        <div class="navbar-header">
            <a href="{{ route('home') }}" class="navbar-brand">LaraBin</a>
            <button class="navbar-toggle" type="button" data-toggle="collapse" data-target="#navbar-main">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
        </div>
        <div class="navbar-collapse collapse" id="navbar-main">
            <ul class="nav navbar-nav">

            </ul>

            <ul class="nav navbar-nav navbar-right">
                @if(auth()->check())
                    <li class="dropdown">
                        <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                            {{ auth()->user()->username }} <span class="caret"></span>
                        </a>
                        <ul class="dropdown-menu">
                            <li><a href="#">Settings</a></li>
                            <li class="divider"></li>
                            <li><a href="{{ route('logout') }}">Logout</a></li>
                        </ul>
                    </li>
                @else
                    <li class="{{ Menu::isActiveRoute('login') }}"><a href="{{ route('login') }}">Login</a></li>
                    <li class="{{ Menu::isActiveRoute('register') }}"><a href="{{ route('register') }}">Register</a></li>
                @endif
            </ul>

        </div>
    </div>
</div>