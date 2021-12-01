<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{ route('admin.dashboard') }}" class="brand-link text-center">
        <span class="brand-text font-weight-light"><b>Utool</b></span>
    </a>
    <!-- Sidebar -->
    <div class="sidebar" id="sidebar-menu">
        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                @foreach ($menus as $menu)
                    @php
                        $childs = $menu->childs;
                    @endphp
                    @if (count($childs) == 0)
                    <li class="nav-item">
                        <a href="{{ $menu->route_uri }}" class="nav-link">
                            <i class="{{ $menu->icon }}"></i>
                            <p>{{ trans($menu->name) }}</p>
                        </a>
                    </li>
                    @else
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="{{ $menu->icon }}"></i>
                            <p> {{ trans($menu->name) }} <i class="right fas fa-angle-left"></i> </p>
                        </a>
                        <ul class="nav nav-treeview">
                            @foreach ($childs as $child)
                            <li class="nav-item">
                                <a href="{{ $child->route_uri }}" class="nav-link"> <i class="far fa-circle nav-icon"></i> <p>{{ trans($child->name) }}</p> </a>
                            </li>
                            @endforeach
                        </ul>
                    </li>
                    @endif
                @endforeach
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>

@section('scripts-sidebar')
    <script>
        $(document).ready(function(){
            let uri = window.location.pathname;
            $('#sidebar-menu a').each(function(index, el){
                if ($(el).attr('href') == uri) {
                    $(el).addClass('active');
                    if ($(el).parents('ul').hasClass('nav-treeview')) {
                        $(el).parents('ul').parent().addClass('menu-is-opening menu-open');
                    }
                }
            });
        });
    </script>
@endsection