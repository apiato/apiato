<header class="main-header">
    <nav class="navbar navbar-static-top">

        <div class="container-fluid">

            <div class="navbar-header">
                <a href="/" class="navbar-brand"><b>{{ config('app.big-name', 'Hello') }}</b> {{ config('app.small-name', 'API') }}</a>
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse">
                    <i class="fa fa-bars"></i>
                </button>
            </div>

            <!-- Navbar Right Menu -->
            <div class="navbar-custom-menu">
                <ul class="nav navbar-nav">
                {{-- TODO: make the user menu a component/partial and call from here!! --}}
                </ul>
            </div>
            <!-- /.navbar-custom-menu -->

        </div>

    </nav>
</header>
