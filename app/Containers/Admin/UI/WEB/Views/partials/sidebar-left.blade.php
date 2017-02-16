<aside class="main-sidebar sidebar-left">

    {{-- sidebar: style can be found in sidebar.less --}}
    <section class="sidebar">
        
        {{-- sidebar user panel --}}
        <div class="user-panel">
            <div class="pull-left image">
                <img src="{{ asset('img/default-avatar.png') }}" class="img-circle" alt="User Image">
            </div>
            <div class="pull-left info">
                <p>{{ auth()->user()->name }}</p>
            </div>
        </div>
        {{-- /sidebar user panel --}}

        {{-- TODO: we should build a dynamic menu with options for sort, show/hide, etc, according to user preferences/permissions  --}}
        {{-- main menu --}}
        @include('partials.menu')

    </section>
    {{-- /sidebar --}}
</aside>
