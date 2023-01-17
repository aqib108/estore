<section class="serving-humanity">
    <div class="container-fluid container-width">
        <div class="d-flex flex-column justify-content-center align-items-center">
            <h5 class="text-yellow text-captilize green-heading">{{__('app.departments')}}</h5>
            <h2 class="center-image-heading orange-text-img">{{__('app.serving_humenity')}}</h2>
        </div>
        <div class="serving-humanity-slider">
            <div id="owl-two" class="owl-carousel owl-theme">
                @foreach($departments as $key => $department)
                <div class="serve-slider-item">
                    <img src="{{asset('department-image/'.$department->file)}}" alt="image not found" class="img-fluid" />
                    <div class="serv-human-content">
                        <h6>@php echo set_locale($department->name); @endphp</h6>
                        <p class="text-opacity">@php echo set_locale($department->description) @endphp</p>
                        <div class="read-more-link d-flex justify-content-center align-items-center">
                            <a href="{{$department->url}}">{{__('app.learn_more')}} <span class="ms-3 next-mark-img"><img src="{{asset('assets/front/images/next-mark.svg')}}" alt=""></span></a>
                        </div>
                    </div>
                </div>   
                @endforeach
               
            </div>
        </div>
    </div>
</section>