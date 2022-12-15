@php
$url_1 = Request::segment(2);
$url_2 = Request::segment(3);
$url_3 = Request::segment(4);
@endphp

<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{ route('admin.dashboard') }}" class="brand-link">
        <img src="{{ asset('assets/admin/dist/img/AdminLTELogo.png') }}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">IMPACT</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="{{ asset('assets/admin/dist/img/user2-160x160.jpg') }}" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <a href="{{ URL('admin/profile') }}" class="d-block">ArhamSoft Admin</a>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">


                <li class="nav-item">
                    <a href="{{ route('admin.dashboard') }}" class="nav-link {{ $url_1 == 'dashboard' ? 'active':'' }}">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            Dashboard
                        </p>
                    </a>
                </li>

                <!-- menu-open -->
                @if(have_right('view-admins') || have_right('view-customers') || have_right('view-roles'))
                <li class="nav-item {{ ($url_1 == 'admins' || $url_1 == 'roles' || $url_1 == 'customers') ? 'menu-open':'' }}">
                    <a href="#" class="nav-link {{ ($url_1 == 'admins' || $url_1 == 'roles' || $url_1 == 'customers') ? 'active':'' }}">
                        <i class="nav-icon fas fa-cogs"></i>
                        <p>
                            System
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>

                    <ul class="nav nav-treeview">

                        @if(have_right('view-admins'))
                        <li class="nav-item">
                            <a href="{{ URL('admin/admins') }}" class="nav-link {{ $url_1 == 'admins' ? 'active':'' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Admins</p>
                            </a>
                        </li>
                        @endif

                        @if(have_right('view-customers'))
                        <li class="nav-item">
                            <a href="{{ URL('admin/customers') }}" class="nav-link {{ $url_1 == 'customers' ? 'active':'' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Customers</p>
                            </a>
                        </li>
                        @endif

                        @if(have_right('view-roles'))
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

                <!-- Contact & subscriptions menus by saad  -->

                @if(have_right('View-Contacts') || have_right('View-Subscriptions'))
                <li class="nav-item {{ ($url_1 == 'contacts' || $url_1 == 'subscriptions' ) ? 'menu-open':'' }}">
                    <a href="#" class="nav-link {{ ($url_1 == 'contacts' || $url_1 == 'subscriptions' ) ? 'active':'' }}">
                        {{-- <i class="nav-icon fas fa-home"></i> --}}
                        <i class="nav-icon fas fa-folder"></i>
                        <p>
                            Queries
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>

                    <ul class="nav nav-treeview">

                        @if(have_right('View-Contacts'))
                        <li class="nav-item">
                            <a href="{{ URL('admin/contacts') }}" class="nav-link {{ $url_1 == 'contacts' ? 'active':'' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Contacts</p>
                            </a>
                        </li>
                        @endif

                        @if(have_right('View-Subscriptions'))
                        <li class="nav-item">
                            <a href="{{ URL('admin/subscriptions') }}" class="nav-link {{ $url_1 == 'subscriptions' ? 'active':'' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Subscriptions</p>
                            </a>
                        </li>
                        @endif




                    </ul>

                </li>
                @endif

                {{-- Magazine section --}}
                @if(have_right('View-Magazines-Category') || have_right('View-Magazines') )
                <li class="nav-item {{ ($url_1 == 'magazines'|| $url_1=='magazine-categories') ? 'menu-open':'' }}">
                    <a href="#" class="nav-link {{ ($url_1 == 'magazine-categories' || $url_1 == 'magazines' ) ? 'active':'' }}">
                        <i class="nav-icon fas fa fa-book"></i>
                        <p>
                            Magazine
                            <i class="right fas fa-angle-left"></i>

                        </p>
                    </a>

                    <ul class="nav nav-treeview">

                        @if(have_right('View-Magazines-Category'))
                        <li class="nav-item">
                            <a href="{{ URL('admin/magazine-categories') }}" class="nav-link {{ $url_1 == 'magazine-categories' ? 'active':'' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Magazines Category</p>
                            </a>
                        </li>
                        @endif

                        @if(have_right('View-Magazines'))
                        <li class="nav-item">
                            <a href="{{ URL('admin/magazines') }}" class="nav-link {{ $url_1== 'magazines' ? 'active':'' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Magazines</p>
                            </a>
                        </li>
                        @endif

                    </ul>

                </li>
                @endif

                {{-- end magazine section --}}

                {{-- Blog section --}}
                @if(have_right('View-Magazines-Category') || have_right('View-Magazines') )
                <li class="nav-item {{ ($url_1 == 'posts'|| $url_1=='categories' || $url_1=='tags' || $url_1=='news' ) ? 'menu-open':'' }}">
                    <a href="#" class="nav-link {{ ($url_1 == 'categories' || $url_1 == 'posts' || $url_1=='tags' || $url_1=='news') ? 'active':'' }}">
                        <i class="nav-icon fa fa-briefcase"></i>
                        <p>
                            Blog
                            <i class="right fas fa-angle-left"></i>

                        </p>
                    </a>

                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ URL('admin/posts') }}" class="nav-link {{ $url_1 == 'posts' ? 'active':'' }}">
                                <i class="nav-icon far fa-circle"></i>
                                <p>
                                    Posts
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ URL('admin/categories') }}" class="nav-link {{ $url_1 == 'categories' ? 'active':'' }}">
                                <i class="nav-icon far fa-circle"></i>
                                <p>
                                    Categories
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ URL('admin/tags') }}" class="nav-link {{ $url_1 == 'tags' ? 'active':'' }}">
                                <i class="nav-icon far fa-circle"></i>
                                <p>
                                    Tags
                                </p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="{{ URL('admin/news') }}" class="nav-link {{ $url_1 == 'news' ? 'active':'' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>News Feeds</p>
                            </a>
                        </li>
                    </ul>

                </li>
                @endif

                {{-- end Blog section --}}

                <!-- start of library section-->


                @if(have_right('View-Library-Image') || have_right('View-Library-Video') || have_right('View-Library-Audio') || have_right('View-Library-Book') || have_right('View-Library-Document'))
                <li class="nav-item {{ ($url_1 == 'library'  ) ? 'menu-open':'' }}">
                    <a href="#" class="nav-link {{ ($url_1 == 'library'  ) ? 'active':'' }}">
                        <i class="nav-icon fas fa-photo-video"></i>
                        <p>
                            Library
                            <i class="right fas fa-angle-left"></i>

                        </p>
                    </a>

                    <ul class="nav nav-treeview">

                        @if(have_right('View-Library-Image'))
                        <li class="nav-item">
                            <a href="{{ URL('admin/library/1/edit') }}" class="nav-link {{ $url_1.$url_2 == 'library1' ? 'active':'' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Image</p>
                            </a>
                        </li>
                        @endif

                        @if(have_right('View-Library-Video'))
                        <li class="nav-item">
                            <a href="{{ URL('admin/library/2/edit') }}" class="nav-link {{ $url_1.$url_2 == 'library2' ? 'active':'' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Video</p>
                            </a>
                        </li>
                        @endif

                        @if(have_right('View-Library-Audio'))
                        <li class="nav-item">
                            <a href="{{ URL('admin/library/3/edit') }}" class="nav-link {{ $url_1.$url_2 == 'library3' ? 'active':'' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Audio</p>
                            </a>
                        </li>
                        @endif

                        @if(have_right('View-Library-Book'))
                        <li class="nav-item">
                            <a href="{{ URL('admin/library/4/edit') }}" class="nav-link {{ $url_1.$url_2 == 'library4' ? 'active':'' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Book Library</p>
                            </a>
                        </li>
                        @endif

                    </ul>

                </li>
                @endif
                <!-- end of library section-->

                @if(have_right('View-Magazines-Category') || have_right('View-Magazines') )
                <li class="nav-item {{ ($url_1 == 'courses'|| $url_1=='classes') ? 'menu-open':'' }}">
                    <a href="#" class="nav-link {{ ($url_1 == 'classes' || $url_1 == 'courses' ) ? 'active':'' }}">
                        <i class="nav-icon fa fa-users"></i>
                        <p>
                            Courses
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>

                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ URL('admin/courses') }}" class="nav-link {{ $url_1 == 'courses' ? 'active':'' }}">
                                <i class="nav-icon far fa-circle"></i>
                                <p>
                                    Courses
                                </p>
                            </a>
                        </li>
                        @if(have_right('View-Class'))
                        <li class="nav-item">
                            <a href="{{ URL('admin/classes') }}" class="nav-link {{ $url_1 == 'classes' ? 'active':'' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Classess</p>
                            </a>
                        </li>
                        @endif
                    </ul>

                </li>
                @endif

                @if(have_right('View-Magazines-Category') || have_right('View-Magazines') )
                <li class="nav-item {{ ($url_1 == 'ceomessage'|| $url_1=='sliders' || $url_1 == 'pages' || $url_1 == 'testimonials') ? 'menu-open':'' }}">
                    <a href="#" class="nav-link {{ ($url_1 == 'sliders' || $url_1 == 'ceomessage'|| $url_1 == 'pages'|| $url_1 == 'testimonials') ? 'active':'' }}">
                        <i class="nav-icon fa fa-home"></i>
                        <p>
                            Home Setting
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>

                    <ul class="nav nav-treeview">
                        @if(have_right('View-Ceo-Message'))
                        <li class="nav-item">
                            <a href="{{ URL('admin/ceomessage') }}" class="nav-link {{ $url_1 == 'ceomessage' ? 'active':'' }}">
                                <i class="nav-icon  far fa-circle"></i>
                                <p>Ceo Message</p>
                            </a>
                        </li>
                        @endif
                        <li class="nav-item">
                            <a href="{{ URL('admin/sliders') }}" class="nav-link {{ $url_1 == 'sliders' ? 'active':'' }}">
                                <i class="nav-icon far fa-circle"></i>
                                <p>
                                    Sliders
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ URL('admin/aims') }}" class="nav-link {{ $url_1 == 'aims' ? 'active':'' }}">
                                <i class="nav-icon far fa-circle"></i>
                                <p>
                                    Our Aims
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ URL('admin/pages') }}" class="nav-link {{ $url_1 == 'pages' ? 'active':'' }}">
                                <i class="nav-icon far fa-circle"></i>
                                <p>
                                    Pages
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ URL('admin/testimonials') }}" class="nav-link {{ $url_1 == 'testimonials' ? 'active':'' }}">
                                <i class="nav-icon far fa-circle"></i>
                                <p>
                                    Testimonials
                                </p>
                            </a>
                        </li>
                    </ul>

                </li>
                @endif

                @if(have_right('View-Location'))
                <li class="nav-item">
                    <a href="{{ URL('admin/locations') }}" class="nav-link {{ $url_1 == 'locations' ? 'active':'' }}">
                        <i class="fa fa-map-marker nav-icon"></i>
                        <p>Locations</p>
                    </a>
                </li>
                @endif

                <li class="nav-item">
                    <a href="{{ URL('admin/department') }}" class="nav-link {{ $url_1 == 'department' ? 'active':'' }}">
                        <i class="nav-icon fa fa-graduation-cap"></i>
                        <p>
                            Departments
                        </p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ URL('admin/donations') }}" class="nav-link {{ $url_1 == 'donations' ? 'active':'' }}">

                        <i class=" nav-icon fas fa-box"></i>
                        <p>
                            Donations
                        </p>
                    </a>
                </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
