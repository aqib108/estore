@extends('home.layout.app')
@section('content')
    <div class="csm-pages-wraper">
        <div class="cms-page-title">
            <h3 class="about-h-1 text-center">{{ __('app.news-events') }}</h3>
        </div>
        <div class="cms-page-content blog-pg">
            <div class="container">
                <div class="row">
                    <div class="col-lg-8">
                            <div class="card mb-5">
                                <h2 class="m-3">@php echo set_locale($news->title) @endphp</h2>
                                <h5 class="m-3"><p><span class="icon text-yellow me-3">Author:</span>@php echo !empty($news->author_name) ? set_locale($news->author_name) : '' @endphp</p></h5>
                                <h5 class="m-3"><p><span class="icon fa fa-calendar text-yellow me-3"></span>@php echo date('M, d Y', strtotime($news->date)); @endphp</p></h5>
                                <div class="m-3">@php echo !empty($news->content) ? set_locale($news->content) : '' @endphp</div>
                            </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="card">
                            <h2 class="widget-title">{{ __('app.recent-news') }}</h2>
                            <div class="blog-widget blog-products">
                                <ul class="recent-posts">
                                    @foreach ($recent_news as $key => $recent_new)
                                    <li>
                                        <a target="_blank" href="{{ route('home.news-events-detail', ['id' => $recent_new->id]) }}">@php echo set_locale($recent_new->title) @endphp</a>
                                    </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>     
@endsection	
