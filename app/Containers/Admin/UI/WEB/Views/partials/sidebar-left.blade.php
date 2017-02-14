<aside class="main-sidebar sidebar-left">

    {{-- sidebar: style can be found in sidebar.less --}}
    <section class="sidebar">
        
        {{-- sidebar user panel --}}
        <div class="user-panel">
            <div class="pull-left image">
                <img src="{{ asset('img/default-avatar.png') }}" class="img-circle" alt="User Image">
            </div>
            <div class="pull-left info">
                <p>{{ Auth::user()->name }}</p>
                <p><small>since {{ Auth::user()->created_at->toFormattedDateString() }}</small></p>
            </div>
        </div>
        {{-- /sidebar user panel --}}

        {{-- sidebar menu --}}
        <ul class="sidebar-menu">
            {{-- this a example multilevel menu --}}
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-edit"></i>
                    <span class="nav-label">Forms</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                {{-- submenu --}}
                <ul class="treeview-menu">
                    <li><a href="#">Basic form</a></li>
                    <li><a href="#">Advanced Plugins</a></li>
                    <li><a href="#">Wizard</a></li>
                    <li><a href="#">File Upload</a></li>
                    <li><a href="#">Text Editor</a></li>
                    <li><a href="#">Markdown</a></li>
                </ul>
                {{-- /submenu --}}
            </li>
        </ul>
        {{-- /sidebar-menu --}}

    </section>
    {{-- /sidebar --}}
</aside>
