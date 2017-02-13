<header class="main-header">
    <!-- logo -->
    <a href="{{ url('/') }}" class="logo">
        {{-- TODO: maybe we need 'app.fullname', 'app.small-name', 'app.big-name' config? --}}
        <span class="logo-mini">
            <b>API</b>
        </span>
        <span class="logo-lg">
            <b>Hello</b> API
        </span>
    </a>
    <!-- header navbar -->
    <nav class="navbar navbar-static-top" role="navigation">
        <!-- sidebar toggle button-->
        <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Toggle navigation</span>
        </a>
        <!-- navbar right menu -->
        <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
                <!-- user account menu -->
                <li class="dropdown user user-menu">
                    <!-- menu toggle button -->
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <!-- the user image in the navbar -->
                        <img src="{{ asset('img/default-avatar.png') }}" class="user-image" alt="User Image">
                        <!-- hidden-xs hides the username on small devices so only the image appears. -->
                        <span class="hidden-xs">{{ Auth::user()->name }}</span>
                    </a>
                    <ul class="dropdown-menu">
                        <!-- the user image in the menu -->
                        <li class="user-header">
                            <img src="{{ asset('img/default-avatar.png') }}" class="img-circle" alt="User Image">
                            <p>
                                {{ Auth::user()->name }}
                                <small>Member since {{ Auth::user()->created_at->toFormattedDateString() }}</small>
                            </p>
                        </li>
                        <!-- menu footer-->
                        <li class="user-footer">
                            <div class="pull-left">
                                <a href="#" class="btn btn-default btn-flat">
                                    {{ trans('core::views.profile') }}
                                </a>
                            </div>
                            <div class="pull-right">
                                <a href="{{ url('/logout') }}" class="btn btn-default btn-flat logout">
                                    {{ trans('core::views.logout') }}
                                </a>
                            </div>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </nav>
</header>
