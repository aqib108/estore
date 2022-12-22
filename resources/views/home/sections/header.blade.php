@php
    $departments = App\Models\Admin\Department::wherestatus(1)->orderBy('id', 'DESC')->get();
    $locations = App\Models\Admin\Location::wherestatus(1)->orderBy('id', 'DESC')->get();
    $library_types = App\Models\Admin\LibraryType::wherestatus(1)->orderBy('id', 'DESC')->get();
    $news = App\Models\Admin\News::wherestatus(1)->take(3)->orderBy('id', 'DESC')->get();
@endphp
<header class="header">
    <div class="bottom-header">
        <div class="container-fluid container-width">
            <nav class="navbar navbar-expand-lg navbar-light navbar-bg">
                <a class="navbar-brand" href="index.html">
                    <div class="logo">
                        <img src="{{asset(getSettingDataHelper('logo'))}}" alt="image not found" class="img-fluid" />
                    </div>
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse header-list" id="navbarSupportedContent">
                    <ul class="navbar-nav mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link main-header-active" href="/">Home</a>
                        </li>
                        <li class="nav-item custom-design-drop-down">
                            <div class="about-drop-down">
                                <div id="adropDown" class="drop-down__button">
                                    <a class="nav-link d-flex align-items-center"> About Us <span class="next00"></span></a>
                                </div>
                                <div class="drop-down__menu-box">
                                    <ul class="drop-down__menu">
                                        <li><a href="/aims-&-object" class="drop-down__item" title="">Aims and Object</a></li>
                                        <li><a href="/satzung" class="drop-down__item" title="">Satzung</a></li>
                                        <li><a href="/membership-form" class="drop-down__item" title="">Membership Form</a></li>
                                        <li><a href="/union" class="drop-down__item" title="">Union</a></li>
                                        {{-- <li class="menu-item-has-children">
                                            <a class="drop-down__item" href="#" title="">Nested drop down</a>
                                            <ul>
                                                <li><a class="drop-down__item" href="index.html" title="">Header Style 1</a></li>
                                                <li><a class="drop-down__item" href="index2.html" title="">Header Style 2</a></li>
                                            </ul>
                                        </li> --}}
                                    </ul>
                                </div>
                            </div>
                        </li>
                        <li class="nav-item custom-design-drop-down">
                            <div class="about-drop-down">
                                <div id="adropDown" class="drop-down__button">
                                    <a class="nav-link d-flex align-items-center">Departments <span class="next00"></span></a>
                                </div>
                                <div class="drop-down__menu-box">
                                    <ul class="drop-down__menu">
                                        @foreach ($departments as $depart)
                                            <li><a href="{{ $depart->url }}" class="drop-down__item" title="">@php echo set_locale($depart->name) @endphp</a></li>
                                        @endforeach
                                        {{-- <li><a href="newsfeed.html" class="drop-down__item" title=""></a>Your Dashboard</li>
                                        <li><a href="" class="drop-down__item" title=""></a>Your Profile</li> --}}
                                        {{-- <li class="menu-item-has-children">
                                            <a class="drop-down__item" href="#" title="">Nested drop down</a>
                                            <ul>
                                                <li><a class="drop-down__item" href="index.html" title="">Header Style 1</a></li>
                                                <li><a class="drop-down__item" href="index2.html" title="">Header Style 2</a></li>
                                            </ul>
                                        </li> --}}
                                    </ul>
                                </div>
                            </div>
                        </li>
                        <li class="nav-item custom-design-drop-down">
                            <div class="about-drop-down">
                                <div id="adropDown" class="drop-down__button">
                                    <a class="nav-link d-flex align-items-center">Location <span class="next00"></span></a>
                                </div>
                                <div class="drop-down__menu-box">
                                    <ul class="drop-down__menu">
                                        @foreach ($locations as $loc)
                                            <li><a href="{{ $loc->location_link }}" class="drop-down__item" title="">@php echo set_locale($loc->location_address) @endphp</a></li>
                                        @endforeach
                                        {{-- <li><a href="newsfeed.html" class="drop-down__item" title=""></a>Your Dashboard</li>
                                        <li><a href="" class="drop-down__item" title=""></a>Your Profile</li>
                                        <li class="menu-item-has-children">
                                            <a class="drop-down__item" href="#" title="">Nested drop down</a>
                                            <ul>
                                                <li><a class="drop-down__item" href="index.html" title="">Header Style 1</a></li>
                                                <li><a class="drop-down__item" href="index2.html" title="">Header Style 2</a></li>
                                            </ul>
                                        </li> --}}
                                    </ul>
                                </div>
                            </div>
                        </li>
                        <li class="nav-item custom-design-drop-down">
                            <div class="about-drop-down">
                                <div id="adropDown" class="drop-down__button">
                                    <a href="{{ route('home.courses') }}" class="nav-link d-flex align-items-center">Courses</a>
                                </div>
                            </div>
                        </li>
                        <li class="nav-item custom-design-drop-down">
                            <div class="about-drop-down">
                                <div id="adropDown" class="drop-down__button">
                                    <a class="nav-link d-flex align-items-center">Library <span class="next00"></span></a>
                                </div>
                                <div class="drop-down__menu-box">
                                    <ul class="drop-down__menu">
                                        @foreach ($library_types as $library_type)
                                            <li><a href="index.html" class="drop-down__item" title="">@php echo set_locale($library_type->title) @endphp</a></li>
                                        @endforeach
                                        {{-- <li><a href="newsfeed.html" class="drop-down__item" title=""></a>Your Dashboard</li>
                                        <li><a href="" class="drop-down__item" title=""></a>Your Profile</li>
                                        <li class="menu-item-has-children">
                                            <a class="drop-down__item" href="#" title="">Nested drop down</a>
                                            <ul>
                                                <li><a class="drop-down__item" href="index.html" title="">Header Style 1</a></li>
                                                <li><a class="drop-down__item" href="index2.html" title="">Header Style 2</a></li>
                                            </ul>
                                        </li> --}}
                                    </ul>
                                </div>
                            </div>
                        </li>
                        <li class="nav-item custom-design-drop-down">
                            <div class="about-drop-down">
                                <div id="adropDown" class="drop-down__button">
                                    <a class="nav-link d-flex align-items-center">Magzine</a>
                                </div>
                                {{-- <div class="drop-down__menu-box">
                                    <ul class="drop-down__menu">
                                        <li><a href="index.html" class="drop-down__item" title=""></a>Your Profile</li>
                                        <li><a href="newsfeed.html" class="drop-down__item" title=""></a>Your Dashboard</li>
                                        <li><a href="" class="drop-down__item" title=""></a>Your Profile</li>
                                        <li class="menu-item-has-children">
                                            <a class="drop-down__item" href="#" title="">Nested drop down</a>
                                            <ul>
                                                <li><a class="drop-down__item" href="index.html" title="">Header Style 1</a></li>
                                                <li><a class="drop-down__item" href="index2.html" title="">Header Style 2</a></li>
                                            </ul>
                                        </li>
                                    </ul>
                                </div> --}}
                            </div>
                        </li>
                        <li class="nav-item custom-design-drop-down">
                            <div class="about-drop-down">
                                <div id="adropDown" class="drop-down__button">
                                    <a class="nav-link d-flex align-items-center">News & Events <span class="next00"></span></a>
                                </div>
                                <div class="drop-down__menu-box">
                                    <ul class="drop-down__menu">
                                        @foreach ($news as $new)
                                            <li><a href="" class="drop-down__item" title="">@php echo set_locale($new->title) @endphp</a></li> 
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        </li>
                        
                        <li class="nav-item custom-design-drop-down">
                            <div class="about-drop-down">
                                <div id="adropDown" class="drop-down__button">
                                    <a class="nav-link d-flex align-items-center">Donation<span class="next00"></span></a>
                                </div>
                                <div class="drop-down__menu-box">
                                    <ul class="drop-down__menu">
                                        <li><a href="index.html" class="drop-down__item" title="">Contact Us</a></li>
                                        {{-- <li><a href="newsfeed.html" class="drop-down__item" title=""></a>Your Dashboard</li>
                                        <li><a href="" class="drop-down__item" title=""></a>Your Profile</li>
                                        <li class="menu-item-has-children">
                                            <a class="drop-down__item" href="#" title="">Nested drop down</a>
                                            <ul>
                                                <li><a class="drop-down__item" href="index.html" title="">Header Style 1</a></li>
                                                <li><a class="drop-down__item" href="index2.html" title="">Header Style 2</a></li>
                                            </ul>
                                        </li> --}}
                                    </ul>
                                </div>
                            </div>
                        </li>
                        <li class="nav-item custom-design-drop-down">
                            <form action="/set-local" method="POST">
                                @csrf
                            <select onChange="this.form.submit()" name="set_language" id='language_selector'>
                            @foreach(getLanguages() as $lang)
                            @if(app()->getLocale()==$lang->short_name)
                            <option value="{{$lang->short_name}}" selected >{{$lang->name}}</option>
                            @else
                            <option value="{{$lang->short_name}}">{{$lang->name}}</option>
                            @endif
                            @endforeach
                           
                           </select>
                            </form>
                        </li>
                    </ul>
                </div>
            </nav>
        </div>
    </div>
</header>