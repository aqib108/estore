@extends('home.layout.app')
@section('content')
    <div class="csm-pages-wraper">
        <div class="cms-page-title">
            <h3 class="about-h-1 text-center">{{ __('app.magzine') }}</h3>
        </div>
        <div class="cms-page-content">
            <div class="container-fluid container-width">
                <div class="row magzine-pg">
                    @foreach($magazines as $key => $magazine)
                   
                        <div class="col-lg-3 mt-2">
                            <a href="{{asset($magazine->file)}}" target="_blank">
                                <div class="card" style="width: 18rem;">
                                    <div class="img-holder image-galary">
                                        <img class="img-fluid card-img-top" src="{{asset($magazine->thumbnail_image)}}" alt="Magazine thumbnail">
                                    </div>
                                    <div class="card-body">
                                      <h5 class="card-title">{{set_locale($magazine->title)}}</h5>
                                      <p class="card-text">{{set_locale($magazine->description)}}</p>
                                    </div>
                                  </div>       
                        </a>
                        </div>     
                    @endforeach
                </div>
                <div class="mt-5 d-flex justify-content-center">
                    {!! $magazines->links() !!}
                </div>
            </div>
        </div>
    </div>    
@endsection	
