@extends('home.layout.app')

    @section('content')
    <input type="hidden" id="bg-img-blue" value="{{asset('images/blue-bg.png')}}">
    @if(!empty($page))
        <div class="csm-pages-wraper">
            <div class="cms-page-title">
                <h3 class="about-h-1 text-center">@php echo set_locale($page->title) @endphp</h3>
            </div>
            <div class="cms-page-content">
                <div class="container-fluid container-width">
                    <div class="d-flex flex-column justify-content-center align-items-center">
                        {!! str_replace('src="http://127.0.0.1:8000','src="'.url('').'', set_locale($page->description))  !!}
                        <p>hghjnknk</p>
                    </div>
                </div>
            </div>
        </div>
    @else
        <div class="csm-pages-wraper">
             <div class="cms-page-title">
                <h3 class="about-h-1 text-center">{{ __('app.sorry') }}</h3>
            </div>
            <div class="cms-page-content">
                <div class="container-fluid container-width">
                    <div class="d-flex flex-column justify-content-center align-items-center">
                        <p class="about-t-1 text-center">
                            {{ __('app.no-page-found') }}
                        </p>
                    </div>
                </div>
            </div>
        </div>
    @endif

@endsection