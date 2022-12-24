@if(count($results))
@foreach($results as $key => $result)
@if($type == 1)
    <div class="col-lg-3 col-md-6 col-sm-6  mb-3">
        <div class="image-galary">
            <img src="{{ asset($result->file) }}" alt="image not found" class="img-fluid" />
            <div class="seacrh-btn">
                <span class="seach-hover"> <i class="fa fa-search" aria-hidden="true"></i></span>
            </div>
        </div>
    </div>
@elseif($type == 2)
<div class="col-lg-3 col-md-6 col-sm-6  mb-3">
    <div class="image-galary">
        <video controls src="{{ asset($result->file) }}" style="height: 100%; width: 100%;"></video>
        <div class="seacrh-btn">
            <span class="seach-hover"> <i class="fa fa-search" aria-hidden="true"></i></span>
        </div>
    </div>
</div>
@elseif($type == 3)
<div class="col-lg-3 col-md-6 col-sm-6  mb-3">
    <div class="image-galary">
        <audio controls style="width: 100%;">
            <source src="{{ asset($result->file) }}" type="audio/ogg">
        </audio>
        <div class="seacrh-btn">
            <span class="seach-hover"> <i class="fa fa-search" aria-hidden="true"></i></span>
        </div>
    </div>
</div>
@elseif($type == 4)
    <div class="col-lg-3 col-md-6 col-sm-6  mb-3">
        <div class="image-galary">
            <a target="_blank" href="{{ asset($result->file) }}" frameborder="0" height="100%" width="100%">
                <img src="{{!empty($result->img_thumb_nail)? asset($result->img_thumb_nail) : asset('images/thumbnails/books.png') }}" alt="image not found" class="img-fluid" />
            </a>
            
            <div class="seacrh-btn">
                <span class="seach-hover"> <i class="fa fa-search" aria-hidden="true"></i></span>
            </div>
        </div>
    </div>
@endif
@endforeach
@else
    <div class="col-lg-3 col-md-6 col-sm-6  mb-3 mt-lg-3">
        <div class="">
            Not Available
        </div>
    </div>
@endif