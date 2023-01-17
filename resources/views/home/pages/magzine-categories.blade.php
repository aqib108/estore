@extends('home.layout.app')
@section('content')
    <div class="csm-pages-wraper">
        <div class="cms-page-title">
            <h3 class="about-h-1 text-center">{{ __('app.magazine-categories') }}</h3>
        </div>
        <div class="cms-page-content">
            <div class="container-fluid container-width">
                <div class="row magzine-pg">
                    @foreach($categories as $key => $category)
                   
                        <div class="col-lg-3 mt-2">
                            <a href="{{ route('home.magazine.detail',['id'=>$category->id]) }}" class="col-lg-3 mt-2">
                            <div class="img-holder image-galary">
                                <h1 class="text-center">{{ set_locale($category->name)}}</h1>
                            </div>
                        </a>         
                        </div>     
                  
                    @endforeach
                </div>
                <div class="mt-5 d-flex justify-content-center">
                    {!! $categories->links() !!}
                </div>
            </div>
        </div>
    </div>    
@endsection	
