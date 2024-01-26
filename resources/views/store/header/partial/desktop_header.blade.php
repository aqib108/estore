<div class="container-menu-desktop">
    <!-- Topbar -->
    <div class="top-bar">
        <div class="content-topbar flex-sb-m h-full container">
            <div class="left-top-bar">
                	<span class="fs-18 txt-center size-211">
							<span class="lnr lnr-map-marker"></span>
                            <span>{{getCompanyLocationName()}}</span>
						</span>
                        <span class="pl-2 fs-18  txt-center size-211">
							<span class="lnr lnr-phone-handset"></span>
                            <span>{{getCompanyPhoneNo()}}</span>
						</span>
            </div>

            <div class="right-top-bar flex-w h-full">
               @guest
                @if (Route::has('login'))
                <a href="{{ route('login') }}" class="flex-c-m trans-04 p-lr-25">
                    Login
                </a>
                @endif
                 @if (Route::has('register'))
                 <a href="{{ route('register') }}" class="flex-c-m trans-04 p-lr-25">
                    Register
                </a>
                 @endif
            @endguest
            @auth
              <a href="#" class="flex-c-m trans-04 p-lr-25">
                    My Account
                </a>
            @endauth

               

               
            </div>
        </div>
    </div>

    <div class="wrap-menu-desktop d-flex">
        <nav class="limiter-menu-desktop container">

            <!-- Logo desktop -->
            <a href="/" class="logo">
                <img src="{{ asset('assets/front/images/logo.png') }}" alt="IMG-LOGO">
            </a>

            <!-- Menu desktop -->
            <div class="menu-desktop">
                <ul class="main-menu">
                    <li>
                        <a href="/">Home</a>
                    </li>

                    <li>
                        <a href="{{route('get.products',['category'=>'all'])}}">Catlog</a>
                        @php
                        $categories = getProductCategories();
                        @endphp
                        @if($categories->count()>0)
                        <ul class="sub-menu">
                        @foreach($categories as $category)
                            <li><a href="{{route('get.products',['category'=> $category?->id])}}">{{$category?->name}}</a></li>
                        @endforeach
                        </ul>
                        @endif
                    </li>

                
                    <li>
                        <a href="blog.html">Services</a>
                    </li>

                    <li>
                        <a href="{{route('about_us')}}">About</a>
                    </li>

                    <li>
                        <a href="{{route('contact_us')}}">Contact</a>
                    </li>
                      <li>
                        <a href="{{route('contact_us')}}">Issue Booking</a>
                    </li>
                      <li>
                        <a href="{{route('contact_us')}}">Offer</a>
                    </li>
                </ul>
            </div>

            <!-- Icon header -->
            <div class="wrap-icon-header flex-w flex-r-m ">
                <div class="icon-header-item cl2 hov-cl1 trans-04 p-l-22 p-r-11 js-show-modal-search d-none">
                    <i class="zmdi zmdi-search"></i>
                </div>

                <div class="icon-header-item cl2 hov-cl1 trans-04 p-l-22 p-r-11 icon-header-noti js-show-cart" data-notify="2">
                    <i class="zmdi zmdi-shopping-cart"></i>
                </div>

                <a href="#" class="dis-block icon-header-item cl2 hov-cl1 trans-04 p-l-22 p-r-11 icon-header-noti d-none"  data-notify="0">
                    <i class="zmdi zmdi-favorite-outline"></i>
                </a>
            </div>
        </nav>
        
    </div>
</div>
