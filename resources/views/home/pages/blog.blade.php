@extends('home.layout.app')
@section('content')
    <div class="csm-pages-wraper">
        <div class="cms-page-title">
            <h3 class="about-h-1 text-center">{{ __('app.blog') }}</h3>
        </div>
        <div class="cms-page-content blog-pg">
            <div class="container">
                <div class="row">
                    <div class="col-lg-8">
                        @foreach ($posts as $key => $post)
                            <div class="card mb-5">
                                <h2 class="m-3">@php echo set_locale($post->title) @endphp</h2>
                                <h5 class="m-3"><p><span class="icon fa fa-calendar text-yellow me-3"></span>@php echo date('M, d Y', strtotime($post->date)); @endphp</p></h5>
                                <div class="fakeimg" style="height:200px;"><img  style="width: 700px;height: 180px;object-fit: cover;" src="{{asset('feature-images/'.$post->image)}}" class="img-fluid"></div>
                                <p class="m-3">@php echo  !empty($post->short_description) ? set_locale($post->short_description) : '' @endphp</p>
                                <div class="buton-holder d-flex justify-content-end m-3">
                                    <button class="orange theme-button">{{ __('app.read-more') }}</button>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <div class="col-lg-4">
                        <div class="card">
                            <h2 class="widget-title">{{ __('app.recent-posts') }}</h2>
                            <div class="blog-widget blog-products">
                                <ul class="recent-posts">
                                    @foreach ($recent_posts as $key => $recent_post)
                                    <li>
                                        <a target="_blank" href="{{ route('home.blog-detail', ['id' => $recent_post->id]) }}">@php echo set_locale($recent_post->title) @endphp</a>
                                    </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="mt-5 d-flex justify-content-center">
                    {!! $posts->links() !!}
                </div>
            </div>
        </div>
    </div>     
@endsection	
