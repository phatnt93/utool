<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{ route('admin.dashboard') }}" class="brand-link text-center">
        <span class="brand-text font-weight-light"><b>Utool</b></span>
    </a>
    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <li class="nav-item">
                    <a href="{{ route('admin.dashboard') }}" class="nav-link">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>{{ trans('dashboard') }}</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-cogs"></i>
                        <p> {{ trans('settings') }} <i class="right fas fa-angle-left"></i> </p>
                    </a>
                    <ul class="nav nav-treeview">
                        {{-- <li class="nav-item">
                            <a href="{{ route('admin.user.profile') }}" class="nav-link"> <i class="far fa-circle nav-icon"></i> <p>{{ trans('user.profile') }}</p> </a>
                        </li> --}}
                        <li class="nav-item">
                            <a href="{{ route('admin.menu.manage') }}" class="nav-link"> <i class="far fa-circle nav-icon"></i> <p>{{ trans('menu') }}</p> </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.user.manage') }}" class="nav-link"> <i class="far fa-circle nav-icon"></i> <p>{{ trans('users') }}</p> </a>
                        </li>
                        {{-- <li class="nav-item">
                            <a href="{{ route('admin.user.role') }}" class="nav-link"> <i class="far fa-circle nav-icon"></i> <p>{{ trans('role.manage') }}</p> </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.user.permission') }}" class="nav-link"> <i class="far fa-circle nav-icon"></i> <p>{{ trans('permission.manage') }}</p> </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.config') }}" class="nav-link"> <i class="far fa-circle nav-icon"></i> <p>{{ trans('configs') }}</p> </a>
                        </li> --}}
                    </ul>
                </li>
                <li class="nav-item">
                    <a href="{{ route('admin.logout') }}" class="nav-link">
                        <i class="nav-icon fas fa-th"></i>
                        <p>Logout</p>
                    </a>
                </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>