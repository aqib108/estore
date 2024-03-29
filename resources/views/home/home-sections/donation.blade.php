<section class="donations-us common-top-padding common-bottom-padding">
    <div class="container-fluid container-width">
        <div class="row">
            <div class="col-lg-5">
                <div class="our-aim-content">
                    <h5 class="text-yellow text-captilize green-heading">{{__('app.p_love')}}</h5>
                    <h2 class="orange-text-img">@php echo set_locale($donations->title) @endphp</h2>
                    <p class="para-1 text-opacity">
                        @php echo set_locale($donations->description) @endphp
                    </p>
                    <div class="buton-holder">
                        <form action="https://www.paypal.com/donate" method="post" target="_top"><input name="hosted_button_id" type="hidden" value="KA3Q4526LZZ7Q">
                            <button type="submit"  name="submit" class="orange theme-button" id="donate-now-btn">Donate Now</button>
                        </form>
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
                            <p class="text-center">{{ __('app.amount-recieved') }}</p>
                            <h4 class="text-center mt-3">{{ $donations->received_amount }}$</h4>
                        </div>
                        <div class="donation-calculation d-flex">
                            <p class="text-center">{{ __('app.targeted-recieved') }}</p>
                            <h4 class="text-center mt-3">{{ $donations->price }}$</h4>
                        </div>
                    </div>
                </div>
                <div class="latest-news">
                    <h5 class="text-yellow">{{__('app.last_news')}}</h5>
                    <ul class="news-list">
                        @foreach($news as $key => $n)
                        <a style="color: black" href="{{ route('home.news-events-detail', ['id' => $n->id]) }}">
                            <li class="d-flex align-items-center">
                                <span class="me-3">
                                    <img src="{{asset('assets/front/images/rectangle.svg')}}" class="img-fluid">
                                </span>
                                @php echo set_locale($n->title); @endphp
                            </li>
                        </a>
                        @endforeach


                    </ul>
                    <div class="read-more-link d-flex justify-content-end align-items-center">
                        <a href="{{ url('news-events') }}">{{__('app.view_more')}} <span class="ms-3 next-mark-img"><img src="{{asset('assets/front/images/next-mark.svg')}}" alt=""></span></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
