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
                    <p class="m-3">
                        @php echo set_locale($aims->content) @endphp
                    </p>
                    
                    <div class="buton-holder">
                        <div class="d-flex" >
                            <a class="orange theme-button me-3" href="/aims-&-object"> read more</a>
                            <form action="https://www.paypal.com/donate" method="post" target="_top"><input name="hosted_button_id" type="hidden" value="KA3Q4526LZZ7Q">
                                {{-- <button type="submit"  name="submit" class="orange theme-button">Donate Now</button> --}}
                                <button class="orange theme-button" type="submit"  name="submit" id="donate-now-btn">Donate Now</button>
                            </form>
                        </div>
                        {{-- <a class="orange theme-button" href="@php echo \Config::get('constants.paypal_url'); @endphp">donate now</a> --}}
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>