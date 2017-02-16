{{-- sidebar menu --}}
<ul class="sidebar-menu">
    <li class="{{ Request::is('dashboard') ? 'active' : null }}">
        <a href="{{ url('/dashboard') }}">
            <i class="fa fa-dashboard"></i>
            <span class="nav-label">Dashboard</span>
        </a>
    </li>

    {{-- this a example multilevel menu --}}
    <li class="treeview">
        <a href="#">
            <i class="fa fa-edit"></i>
            <span class="nav-label">Example menu</span>
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