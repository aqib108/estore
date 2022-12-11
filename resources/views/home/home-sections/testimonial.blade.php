<section class="testimonials common-top-padding common-bottom-padding">
    <div class="container">
        <div class="d-flex flex-column justify-content-center align-items-center">
            <h5 class="text-yellow text-captilize green-heading">Testimonials</h5>
            <h2 class="center-image-heading orange-text-img">People love with us</h2>
        </div>
        <div class="testimonial-slider">
            <div id="owl-three" class="owl-carousel owl-theme">
                @foreach($Testimonials as $key => $Testimonial)
                <div class="testimonial-slider-item">
                    <div class="testimonial-human-content">
                        <p class="text-center">
                            "@php echo set_locale($Testimonial->message); @endphp"
                        </p>
                        <div class="testimonial-profile-">
                            <div class="d-flex justify-content-center align-items-center">
                                <div class="d-flex">
                                    <div class="client-image">
                                        <img src="{{ asset('testimonial-images/'.$Testimonial->image) }}" alt="image not found" class="img-fluid">
                                    </div>
                                </div>
                                <div class="d-flex flex-column">
                                    <h6 class="text-green">@php echo set_locale($Testimonial->name); @endphp</h6>
                                    <p class="opacity">Customer</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div> 
                @endforeach
                
               
                
            </div>
        </div>
    </div>
</section>