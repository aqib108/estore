@extends('home.layout.app')

    @section('content')
    @if(count($courses))
        <div class="csm-pages-wraper">
            <div class="cms-page-title">
                <h3 class="about-h-1 text-center">{{ __('app.courses') }}</h3>
            </div>
                <div class="cms-page-content">
                    <div class="container-fluid container-width">
                        <div class="row">
                            @foreach ($courses as $course)
                            <div class="col-sm-3">
                            <a href="{{ route('home.classes', ['id' => $course->id]) }}">
                              <div class="card">
                                <div class="card-body">
                                  <h5 class="card-title">@php echo set_locale($course->name) @endphp</h5>
                                </div>
                              </div>
                            </a>
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
                            No course Found!
                        </p>
                    </div>
                </div>
            </div>
        </div>
    @endif
@endsection