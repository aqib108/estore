@php
    $posts = App\Models\Admin\Post::wherestatus(1)->join('post_feature_images','post_id','posts.id')->take(3)->orderBy('id', 'DESC')->get(['posts.title as title','post_feature_images.image as image','posts.created_at as date','posts.id as id']);
    $location=App\Models\Admin\Location::where(['status'=>1,'featured'=>1])->first();
@endphp
<footer class="footer">
    <div class="container-fluid container-width">
        <div class="top-footer common-card">
            <div class="row">
                <div class="col-lg-3 col-12 mb-lg-0 mb-md-5 mb-3">
                    <div class="footer-info">
                        <h5>{{__('app.about_us')}}</h5>
                        <p>{{getSettingDataHelper('about_'.app()->getLocale())}}</p>
                        <div class="footer-logo">
                            <a class="navbar-brand" href="index.html">
                                <img src="{{asset(getSettingDataHelper('logo'))}}" class="img-fluid" alt="" />
                            </a>
                        </div>
                        <div class="store-logos">
                            <a href="{{ $location->location_link }}" target="_blank"><span class="icon fa fa-map-marker text-yellow"></span>
                                <span class="graish-color"> @php echo set_locale($location->location_address) @endphp</span>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="footer-links">
                        <h5>{{__('app.l_blog')}}</h5>
                        <ul class="list-unstyled">
                           @foreach($posts as $key => $post)
                           <a style="color: black" href="{{ route('home.blog-detail', ['id' => $post->id]) }}">
                            <li class="d-flex">
                                <div class="imag-blog d-flex">
                                    <img style="height: 75px !important; width: 90px !important;" src="{{asset('feature-images/'.$post->image)}}" class="img-fluid">
                                </div>
                                <div class="d-flex flex-column blog-detail">
                                    @php echo set_locale($post->title) @endphp
                                    <p><span class="icon fa fa-calendar text-yellow me-3"></span>@php echo date('M, d Y', strtotime($post->date)); @endphp</p>
                                </div>
                            </li>
                          </a>
                           @endforeach
                            
                        </ul>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="footer-links">
                        <h5>{{__('app.con_info')}}</h5>
                        <ul class="list-unstyled contact-info">
                           
                            <li>
                                <a href="#"><span class="icon fa fa-envelope"></span><span> {{getSettingDataHelper('email')}}</span></a>
                            </li>
                            <li>
                                <a href="#"><span class="icon fa fa-phone"></span> <span>{{getSettingDataHelper('phone')}}</span></a>
                            </li>
                            <li>
                                <a href="{{ $location->location_link }}" target="_blank"><span class="icon fa fa-map-marker"></span><span>@php echo set_locale($location->location_address) @endphp</span></a>
                            </li>
                            <li>
                                <a href="#"><span class="icon fa fa-clock-o"></span> <span>{{getSettingDataHelper('opening_time')}}</span></a>
                            </li>
                        </ul>
                        <div class="follow-us">
                            <ul class="list-unstyled">
                                <li>
                                    <a href="{{getSettingDataHelper('facebook')}}" class="facebook">
                                        <span class="fa fa-facebook"></span>
                                    </a>
                                </li>
                                <li>
                                    <a href="{{getSettingDataHelper('linkedin')}}" class="linkedin">
                                        <span class="fa fa-linkedin"></span>
                                    </a>
                                </li>
                                <li>
                                    <a href="{{getSettingDataHelper('twitter')}}" class="twitter">
                                        <span class="fa fa-twitter"></span>
                                    </a>
                                </li>
                                <li>
                                    <a href="{{getSettingDataHelper('pinterest')}}" class="pinterest">
                                        <span class="fa fa-pinterest"></span>
                                    </a>
                                </li>
                                <li>
                                    <a href="{{getSettingDataHelper('youtube')}}" class="youtube">
                                        <span class="fa fa-youtube"></span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="footer-links">
                        <h5>{{__('app.q_con')}}</h5>
                        <form method="post" action="/contact_us">
                       @csrf
                            <div class="footer-contact-form">
                            <div class="form-floating mb-3">
                                <input type="email" required class="form-control" id="floatingInput" placeholder="name@example.com" name="email">
                                <label for="floatingInput">{{ __('app.email-address') }}</label>
                            </div>
                            <div class="form-floating mb-3">
                                <input type="text" required class="form-control" name="subject" id="floatingPassword" placeholder="subject">
                                <label for="floatingPassword">{{ __('app.subject') }}</label>
                            </div>
                            <div class="form-floating">
                                <textarea required class="form-control" placeholder="Leave a comment here" id="floatingTextarea2" style="height: 100px" name="message"></textarea>
                                <label for="floatingTextarea2">{{ __('app.comments') }}</label>
                              </div>
                              <div class="form-floating mt-3">
                                <button type="submit" class="btn btn-success">{{ __('app.submit') }}</button>
                                {{-- <input type="submit" class="btn btn-success"> --}}
                            </div>
                        </div>
                    </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="bottom-footer">
            <div class="row justify-content-center align-items-center">
                <div class="col-lg-6">
                    <div class="footer-newsletter">
                        <h6 class="text-center text-white">{{ __('app.subscribe-news') }}</h6>
                    <form action="/subscription" method="post">
                        @csrf
                        <div class="field-wrapper">
                            <input required class="form-control" name="email" type="email" placeholder="{{ __('app.enter-email') }}" />
                            <button type="submit" class="orange theme-button">{{ __('app.subscribe') }}</button>
                        </div>
                    </form>
                    </div>
                </div>
            </div>
            <div class="copyrights">
                <p>Halqa Noor Ul Iman @php echo date('Y'); @endphp - All Rights Reserved</p>
            </div>
        </div>
    </div>
</footer>
