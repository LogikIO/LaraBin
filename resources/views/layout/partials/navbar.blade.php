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
                <li class="{{ Menu::isActiveRoute('bins.all') }}"><a href="{{ route('bins.all') }}">All Bins</a></li>
                @if(auth()->check())
                    <li class="{{ Menu::isActiveRoute('bins.my') }}"><a href="{{ route('bins.my') }}">My Bins</a></li>
                    <li class="{{ Menu::isActiveRoute('bins.create') }}"><a href="{{ route('bins.create') }}">Create Bin +</a></li>
                    @if(auth()->user()->admin())
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Admin <span class="caret"></span></a>
                            <ul class="dropdown-menu" role="menu">
                                <li><a href="{{ route('admin.users') }}">Users</a></li>
                                <li><a href="{{ route('admin.twitter') }}">Twitter</a></li>
                                <li><a href="{{ route('admin.logs') }}" target="_blank">Logs</a></li>
                            </ul>
                        </li>
                    @endif
                @endif
            </ul>

            <ul class="nav navbar-nav navbar-right">
                @if(auth()->check())
                    <li class="dropdown">
                        <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                            {{ auth()->user()->username }} <span class="caret"></span>
                        </a>
                        <ul class="dropdown-menu">
                            <li><a href="{{ route('user', auth()->user()->username) }}">Profile</a></li>
                            <li><a href="{{ route('settings') }}">Settings</a></li>
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