<section class="donations-us common-top-padding common-bottom-padding">
    <div class="container-fluid container-width">
        <div class="row">
            <div class="col-lg-5">
                <div class="our-aim-content">
                    <h5 class="text-yellow text-captilize green-heading">Help the Poor</h5>
                    <h2 class="orange-text-img">@php echo set_locale($donations->title) @endphp</h2>
                    <p class="para-1 text-opacity">
                        @php echo set_locale($donations->description) @endphp
                    </p>
                    <div class="buton-holder">
                        <button class="orange theme-button">Donate Now</button>
                    </div>
                </div>
            </div>
            <div class="col-lg-7 d-flex flex-lg-row flex-column justify-content-between">
              <div class="d-flex flex-column percentage-donation">
                <div class="donation-calculation d-flex">
                    <div class="percent">
                        <svg>
                        <circle cx="105" cy="105" r="100"></circle>
                        <circle cx="105" cy="105" r="100" style="--percent: {{ ($donations->received_amount/$donations->price)*100 }}"></circle>
                        </svg>
                        <div class="number">
                        <h3>{{ ($donations->received_amount/$donations->price)*100 }}<span>%</span></h3>
                        </div>
                    </div>
                    <!-- <div class="title">
                        <h2>CSS</h2>
                    </div> -->
                </div>
                <div class="d-flex justify-content-between mt-3">
                    <div class="donation-calculation d-flex">
                        <p class="text-center">Amount Recieved</p>
                        <h4 class="text-center mt-3">{{ $donations->received_amount }}$</h4>
                    </div>
                    <div class="donation-calculation d-flex">
                        <p class="text-center">Targeted Amount</p>
                        <h4 class="text-center mt-3">{{ $donations->price }}$</h4>
                    </div>
                </div>
              </div>
                <div class="latest-news">
                    <h5 class="text-yellow">Latest News & Updates</h5>
                    <ul class="news-list">
                        @foreach($news as $key => $n)
                        <li class="d-flex align-items-center">
                            <span class="me-3">
                                <img src="{{asset('assets/front/images/rectangle.svg')}}" class="img-fluid">
                            </span>
                            @php echo set_locale($n->title); @endphp
                        </li>     
                        @endforeach
                       
                        
                    </ul>
                    <div class="read-more-link d-flex justify-content-end align-items-center">
                        <a href="/">View More <span class="ms-3 next-mark-img"><img src="{{asset('assets/front/images/next-mark.svg')}}" alt=""></span></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>