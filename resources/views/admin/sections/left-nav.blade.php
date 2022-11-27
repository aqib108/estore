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

          <li class="nav-item">
            <a href="{{ URL('admin/categories') }}" class="nav-link {{ $url_1 == 'categories' ? 'active':'' }}">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Categories
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ URL('admin/department') }}" class="nav-link {{ $url_1 == 'department' ? 'active':'' }}">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Department
              </p>
            </a>
          </li>

          <li class="nav-item">
            <a href="{{ URL('admin/tags') }}" class="nav-link {{ $url_1 == 'tags' ? 'active':'' }}">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Tags
              </p>
            </a>
          </li>

          <li class="nav-item">
            <a href="{{ URL('admin/posts') }}" class="nav-link {{ $url_1 == 'posts' ? 'active':'' }}">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Posts
              </p>
            </a>
          </li>
          {{--  <li class="nav-item">
            <a href="{{ URL('admin/library') }}" class="nav-link {{ $url_1 == 'library' ? 'active':'' }}">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Library
              </p>
            </a>
          </li>  --}}

          <li class="nav-item">
            <a href="{{ URL('admin/pages') }}" class="nav-link {{ $url_1 == 'pages' ? 'active':'' }}">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Pages
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ URL('admin/sliders') }}" class="nav-link {{ $url_1 == 'sliders' ? 'active':'' }}">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Sliders
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ URL('admin/testimonials') }}" class="nav-link {{ $url_1 == 'testimonials' ? 'active':'' }}">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Testimonials
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ URL('admin/courses') }}" class="nav-link {{ $url_1 == 'courses' ? 'active':'' }}">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Courses
              </p>
            </a>
          </li>

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

        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>