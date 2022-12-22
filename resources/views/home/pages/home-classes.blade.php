@extends('home.layout.app')

    @section('content')
    @if(count($classes))
        <div class="csm-pages-wraper">
            <div class="cms-page-title">
                <h3 class="about-h-1 text-center">Classes</h3>
            </div>
                <div class="cms-page-content">
                    <div class="container-fluid container-width">
                        <div class="row">
                            @foreach ($classes as $class)
                            <div class="col-sm-3">
                              <div class="card">
                                <div class="card-body">
                                  <a href="{{ $class->url }}" target="_blank"><h5 class="card-title">@php echo set_locale($class->title) @endphp</h5></a>
                                </div>
                              </div>
                            </div>
                            @endforeach
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
                            No Class Found!
                        </p>
                    </div>
                </div>
            </div>
        </div>
    @endif
@endsection