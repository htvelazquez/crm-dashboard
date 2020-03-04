<!-- Main Header -->
<header class="main-header">
    <!-- Logo -->
    <a href="/" class="logo">
        <!-- mini logo for sidebar mini 50x50 pixels -->
        <span class="logo-mini"><i>CRM</i></span>
        <!-- logo for regular state and mobile devices -->
        <span class="logo-lg">CIRENIO <i>CRM</i></span>
    </a>

    <!-- Header Navbar -->
    <nav class="navbar navbar-static-top" role="navigation">
        <!-- Sidebar toggle button-->
        <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
            <span class="sr-only">Toggle navigation</span>
        </a>

        <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
                @if (null !== auth()->user())
                    <li class="dropdown user user-menu">
                        <a href="/profile">
                            <img src="{{ Auth::user()->avatar }}" class="user-image" alt="User Image">
                            <span class="hidden-xs">{{ Auth::user()->name }}</span>
                        </a>
                    </li>
                    <li>
                        <a href="/logout" title="Exit - {{ Auth::user()->name }}"><i class="glyphicon glyphicon-off"></i></a>
                    </li>
                @endif
            </ul>
        </div>
    </nav>
</header>
