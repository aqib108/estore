<section class="about-us common-top-padding common-bottom-padding">
    <div class="container-fluid container-width">
        <div class="row">
            <div class="col-lg-5">
               <?php
               if(isset($aims->file))
               $image = $aims->file;
               else
               $image='#';
               ?>
                <div class="image-container">
                    <img src="{{asset($image)}}" class="img-fluid">
                </div>
            </div>
            <div class="col-lg-7">
                <div class="our-aim-content">
                    <h5 class="text-yellow text-captilize green-heading">OUR MISSION</h5>
                    <h2 class="orange-text-img">{{ set_locale($aims->title) }}</h2>
                    @php echo set_locale($aims->content) @endphp
                    
                    <div class="buton-holder">
                        <button class="orange theme-button me-md-3">read more</button>
                        <a class="orange theme-button" href="@php echo \Config::get('constants.paypal_url'); @endphp">donate now</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>