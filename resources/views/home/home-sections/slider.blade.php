<section class="main-banner">
    <div class="row justify-content-center align-items-center">
        <div class="col-12">
            <div class="main-banner-slider">
                <div id="owl-one" class="owl-carousel owl-theme">
                    @foreach($sliders as $key => $slide)
                    <div class="slider-item-1" style='background-image : url("{{'slider-images/'.$slide->image}}")'>
                        <div class="slider-centent">
                            <div class="baner-logo">
                                <img src="{{ asset($slide->slider_logo) }}" alt="image not found" class="img-fluid" />
                            </div>
                            @php echo set_locale($slide->content) @endphp
                        </div>
                    </div>  
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</section>  