<div class="menu-mobile">
    <ul class="topbar-mobile">
        <li>
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
            
        </li>

        <li>
            <div class="right-top-bar flex-w h-full">
                  @if (auth()->check())
                <a href="{{route('account.profile')}}" class="flex-c-m trans-04 p-lr-25">
                    My Account
                </a>
            @else
              <a href="{{ route('login') }}" class="flex-c-m trans-04 p-lr-25">
                    Login
                </a>
                 <a href="{{ route('register') }}" class="flex-c-m trans-04 p-lr-25">
                    Register
                </a>
            @endif  
            </div>
        </li>
    </ul>

    <ul class="main-menu-m">
        <li>
            <a href="{{route('main.home')}}">Home</a>
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
            <a href="{{route('services')}}">Services</a>
        </li>

        <li>
            <a href="{{route('about_us')}}">About</a>
        </li>

        <li>
            <a href="{{route('contact_us')}}">Contact</a>
        </li>
        <li>
            <a href="{{route('issue.booking.page')}}">Issue Booking</a>
        </li>
        <li>
            <a href="{{route('offer.list')}}">Offer</a>
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
