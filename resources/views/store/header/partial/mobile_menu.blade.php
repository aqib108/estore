<div class="menu-mobile">
    <ul class="topbar-mobile">
        <li>
            <div class="left-top-bar">
                Free shipping for standard order over $100
            </div>
        </li>

        <li>
            <div class="right-top-bar flex-w h-full">
                <a href="#" class="flex-c-m p-lr-10 trans-04">
                    Help & FAQs
                </a>

                <a href="#" class="flex-c-m p-lr-10 trans-04">
                    My Account
                </a>

                <a href="#" class="flex-c-m p-lr-10 trans-04">
                    EN
                </a>

                <a href="#" class="flex-c-m p-lr-10 trans-04">
                    USD
                </a>
            </div>
        </li>
    </ul>

    <ul class="main-menu-m">
        <li>
            <a href="/">Home</a>
        </li>

        <li>
            <a href="{{route('get.products',['category'=>'all'])}}">Catlog</a>
            @php
            $categories = getProductCategories();
            @endphp
            @if($categories->count()>0)
            <ul class="sub-menu-m">
                @foreach($categories as $category)
                <li><a href="{{route('get.products',['category'=> $category?->id])}}">{{$category?->name}}</a></li>
                @endforeach
            </ul>
            @endif
            <span class="arrow-main-menu-m">
                <i class="fa fa-angle-right" aria-hidden="true"></i>
            </span>
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

        @guest
        @if (Route::has('login'))
        <li>
            <a href="{{ route('login') }}">{{ __('Login') }}</a>
        </li>
        @endif

        @if (Route::has('register'))
        <li>
            <a href="{{ route('register') }}">{{ __('Register') }}</a>
        </li>
        @endif
        @endguest
    </ul>
</div>
