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
        <video controls src="{{ asset($result->file) }}" style="height: 200px; width: 270px;"></video>
        <div class="seacrh-btn">
            <span class="seach-hover"> <i class="fa fa-search" aria-hidden="true"></i></span>
        </div>
    </div>
</div>
@elseif($type == 3)
<div class="col-lg-3 col-md-6 col-sm-6  mb-3">
    <div class="image-galary">
        <audio controls style="width: 270px;">
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
            <img src="{{!empty($result->img_thumb_nail)? asset($result->img_thumb_nail) : asset('images/thumbnails/books.png') }}" alt="image not found" class="img-fluid" />
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