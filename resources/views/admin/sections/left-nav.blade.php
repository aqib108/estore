@php
$url_1 = Request::segment(2);
$url_2 = Request::segment(3);
$url_3 = Request::segment(4);
@endphp

<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{ route('admin.dashboard') }}" class="brand-link">
        <img src="{{ asset('assets/front/images/logo.png') }}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">Admin</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->


        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

                @if(have_right('Access-Dashboard'))
                <li class="nav-item">
                    <a href="{{ route('admin.dashboard') }}" class="nav-link {{ $url_1 == 'dashboard' ? 'active':'' }}">
                        <i class="nav-icon fas fa-home"></i>
                        <p>
                            Dashboard
                        </p>
                    </a>
                </li>
                @endif



                <!-- menu-open -->
                @if(have_right('Access-Admin') || have_right('Access-User') || have_right('Access-Roles-Managment'))
                <li class="d-none nav-item {{ ($url_1 == 'admins' || $url_1 == 'roles' || $url_1 == 'customers') ? 'menu-open':'' }}">
                    <a href="#" class="nav-link {{ ($url_1 == 'admins' || $url_1 == 'roles' || $url_1 == 'customers') ? 'active':'' }}">
                        <i class="nav-icon fas fa-cogs"></i>
                        <p>
                            System
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>

                    <ul class="nav nav-treeview">

                        @if(have_right('Access-Admin'))
                        <li class="nav-item">
                            <a href="{{ URL('admin/admins') }}" class="nav-link {{ $url_1 == 'admins' ? 'active':'' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Admins</p>
                            </a>
                        </li>
                        @endif

                        {{-- @if(have_right('Access-User'))
                        <li class="nav-item">
                            <a href="{{ URL('admin/customers') }}" class="nav-link {{ $url_1 == 'customers' ? 'active':'' }}">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Customers</p>
                        </a>
                </li>
                @endif --}}

                @if(have_right('Access-Roles-Managment'))
                <li class="nav-item">
                    <a href="{{ URL('admin/roles') }}" class="nav-link {{ $url_1 == 'roles' ? 'active':'' }}">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Roles Managment</p>
                    </a>
                </li>
                @endif

            </ul>

            </li>
            @endif
            {{--admin room--}}
            <li class="nav-item">
                <a href="{{ URL('admin/categories') }}" class="nav-link {{ $url_1 == 'categories' ? 'active':'' }}">
                    <i class="nav-icon fas fa-list"></i>
                    <p>
                        categories
                    </p>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ URL('admin/products') }}" class="nav-link {{ $url_1 == 'products' ? 'active':'' }}">
                    <i class="nav-icon fas fa-list"></i>
                    <p>
                        Products
                    </p>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ URL('admin/offers') }}" class="nav-link {{ $url_1 == 'offers' ? 'active':'' }}">
                   <i class="nav-icon fas fa-tachometer-alt"></i>
                    <p>
                        Offers
                    </p>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ URL('admin/customers') }}" class="nav-link {{ $url_1 == 'customers' ? 'active':'' }}">
                    <i class="nav-icon fas fa-users"></i>
                    <p>
                        Customers
                    </p>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ URL('admin/orders') }}" class="nav-link {{ $url_1 == 'orders' ? 'active':'' }}">
                    <i class="nav-icon fas fa-tachometer-alt"></i>
                    <p>Orders</p>
                </a>
            </li>

            <li class="nav-item">
                <a href="{{ URL('admin/slider') }}" class="nav-link {{ $url_1 == 'slider' ? 'active':'' }}">
                    <i class="nav-icon fas fa-tachometer-alt"></i>
                    <p>
                        Sliders
                    </p>
                </a>
            </li>


            {{-- end Blog section --}}

            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
