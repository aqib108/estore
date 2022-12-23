@extends('home.layout.app')
@section('content')
<div class="csm-pages-wraper">
    <div class="cms-page-title">
        <h3 class="about-h-1 text-center">@php echo set_locale($libraryType->title) @endphp Library</h3>
    </div>
    <div class="cms-page-content">
        <div class="container-fluid container-width">
            <div class="row magzine-pg">
                @foreach($libraries as $key => $library)
               @if ($library->type_id==1)
                    <div class="col-lg-3 mt-2">
                        <a href="{{asset($library->file)}}" target="_blank">
                            <div class="card" style="width: 18rem;">
                                <div class="img-holder image-galary">
                                    <img class="img-fluid card-img-top" src="{{asset($library->file)}}" alt="library thumbnail">
                                </div>
                                <div class="card-body">
                                <h5 class="card-title">{{ !empty($library->file_title) ? $library->file_title : ''}}</h5>
                                {{-- <p class="card-text">{{!empty($library->description) ? $library->description : ''}}</p> --}}
                                </div>
                            </div>       
                        </a>
                    </div> 
                @elseif ($library->type_id==2)
                    <div class="col-lg-3 mt-2">
                        <a href="{{asset($library->file)}}" target="_blank">
                            <div class="card" style="width: 18rem;">
                                <div class="img-holder image-galary">
                                    <video controls src="{{ asset($library->file) }}" style="height: 200px; width: 270px;"></video>
                                </div>
                                <div class="card-body">
                                <h5 class="card-title">{{ !empty($library->file_title) ? $library->file_title : ''}}</h5>
                                {{-- <p class="card-text">{{!empty($library->description) ? $library->description : ''}}</p> --}}
                                </div>
                            </div>       
                        </a>
                    </div>  
                @elseif ($library->type_id==3)
                    <div class="col-lg-3 mt-2">
                        <a href="{{asset($library->file)}}" target="_blank">
                            <div class="card" style="width: 18rem;">
                                <div class="img-holder image-galary">
                                    <audio controls style="width: 270px;">
                                        <source src="{{ asset($library->file) }}" type="audio/ogg">
                                    </audio>
                                </div>
                                <div class="card-body">
                                <h5 class="card-title">{{ !empty($library->file_title) ? $library->file_title : ''}}</h5>
                                {{-- <p class="card-text">{{!empty($library->description) ? $library->description : ''}}</p> --}}
                                </div>
                            </div>       
                        </a>
                    </div>
                @elseif ($library->type_id==4)
                    <div class="col-lg-3 mt-2">
                        <a href="{{asset($library->file)}}" target="_blank">
                            <div class="card" style="width: 18rem;">
                                <div class="img-holder image-galary">
                                    <img src="{{!empty($result->img_thumb_nail)? asset($result->img_thumb_nail) : asset('images/thumbnails/books.png') }}" alt="image not found" class="img-fluid" />
                                </div>
                                <div class="card-body">
                                <h5 class="card-title">{{ !empty($library->file_title) ? $library->file_title : ''}}</h5>
                                {{-- <p class="card-text">{{!empty($library->description) ? $library->description : ''}}</p> --}}
                                </div>
                            </div>       
                        </a>
                    </div>
               @endif    
                @endforeach
            </div>
            <div class="mt-5 d-flex justify-content-center">
                {!! $libraries->links() !!}
            </div>
        </div>
    </div>
</div> 
@endsection	
