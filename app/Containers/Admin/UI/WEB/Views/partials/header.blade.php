<header class="main-header">
    
    {{-- app logo/name --}}
    <a href="{{ url('/') }}" class="logo">
        <span class="logo-mini">
            <b>{{ config('app.big-name', 'API') }}</b>
        </span>
        <span class="logo-lg">
            <b>{{ config('app.small-name', 'Hello') }}</b> {{ config('app.big-name', 'API') }}
        </span>
    </a>

    {{-- header navbar --}}
    <nav class="navbar navbar-static-top" role="navigation">

        {{-- sidebar toggle button--}}
        <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Toggle navigation</span>
        </a>

        {{-- navbar right menu --}}
        <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">

                {{-- TODO: this user menu should be a component? --}}
                {{-- user account menu --}}
                <li class="dropdown user user-menu">
                    {{-- menu toggle button --}}
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        {{-- the user image in the navbar --}}
                        <img src="{{ asset('img/default-avatar.png') }}" class="user-image" alt="User Image">
                        {{-- hidden-xs hides the username on small devices so only the image appears. --}}
                        <span class="hidden-xs">{{ auth()->user()->name }}</span>
                    </a>
                    {{-- /menu toggle button --}}

                    <ul class="dropdown-menu">
                        {{-- user image --}}
                        <li class="user-header">
                            <img src="{{ asset('img/default-avatar.png') }}" class="img-circle" alt="User Image">
                            <p>
                                {{ auth()->user()->name }}
                                <small>Member since {{ auth()->user()->created_at->toFormattedDateString() }}</small>
                            </p>
                        </li>
                        {{-- /user image --}}

                        {{-- menu footer--}}
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
                        {{-- /menu footer--}}
                    </ul>
                </li>
                {{-- /user account menu --}}

            </ul>
        </div>
        {{-- /navbar right menu --}}

    </nav>
    {{-- /header navbar --}}
</header>
