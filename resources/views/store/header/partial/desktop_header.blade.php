<div class="container-menu-desktop">
    <!-- Topbar -->
    <div class="top-bar d-none">
        <div class="content-topbar flex-sb-m h-full container">
            <div class="left-top-bar">
                Free shipping for standard order over $100
            </div>

            <div class="right-top-bar flex-w h-full">
                <a href="#" class="flex-c-m trans-04 p-lr-25">
                    Help & FAQs
                </a>

                <a href="#" class="flex-c-m trans-04 p-lr-25">
                    My Account
                </a>

                <a href="#" class="flex-c-m trans-04 p-lr-25">
                    EN
                </a>

                <a href="#" class="flex-c-m trans-04 p-lr-25">
                    USD
                </a>
            </div>
        </div>
    </div>

    <div class="wrap-menu-desktop d-flex">
        <nav class="limiter-menu-desktop container">

            <!-- Logo desktop -->
            <a href="#" class="logo">
                <img src="{{ asset('assets/front/images/logo.png') }}" alt="IMG-LOGO">
            </a>

            <!-- Menu desktop -->
            <div class="menu-desktop">
                <ul class="main-menu">
                    <li class="active-menu">
                        <a href="index.html">Home</a>
                        <ul class="sub-menu">
                            <li><a href="index.html">Homepage 1</a></li>
                            <li><a href="home-02.html">Homepage 2</a></li>
                            <li><a href="home-03.html">Homepage 3</a></li>
                        </ul>
                    </li>

                    <li>
                        <a href="product.html">Shop</a>
                    </li>

                    <li class="label1" data-label1="hot">
                        <a href="shoping-cart.html">Features</a>
                    </li>

                    <li>
                        <a href="blog.html">Blog</a>
                    </li>

                    <li>
                        <a href="about.html">About</a>
                    </li>

                    <li>
                        <a href="{{route('contact_us')}}">Contact</a>
                    </li>
                </ul>
            </div>

            <!-- Icon header -->
            <div class="wrap-icon-header flex-w flex-r-m d-none">
                <div class="icon-header-item cl2 hov-cl1 trans-04 p-l-22 p-r-11 js-show-modal-search">
                    <i class="zmdi zmdi-search"></i>
                </div>

                <div class="icon-header-item cl2 hov-cl1 trans-04 p-l-22 p-r-11 icon-header-noti js-show-cart" data-notify="2">
                    <i class="zmdi zmdi-shopping-cart"></i>
                </div>

                <a href="#" class="dis-block icon-header-item cl2 hov-cl1 trans-04 p-l-22 p-r-11 icon-header-noti" data-notify="0">
                    <i class="zmdi zmdi-favorite-outline"></i>
                </a>
            </div>
        </nav>
        <!-- Login and Register Buttons -->
        <div class="my-2 my-lg-0 d-flex pr-3 pt-4">
            @guest
            @if (Route::has('login'))
            <li class="nav-item">
                <a class="btn btn-outline-success my-2 my-sm-0 mr-2" href="{{ route('login') }}">{{ __('Login') }}</a>
            </li>
            @endif

            @if (Route::has('register'))
            <li class="nav-item">
                <a class="btn btn-outline-primary my-2 my-sm-0" href="{{ route('register') }}">{{ __('Register') }}</a>
            </li>
            @endif
            @endguest
        </div>
    </div>
</div>
