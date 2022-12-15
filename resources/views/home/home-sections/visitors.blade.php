<section class="visitors-acount common-top-padding common-bottom-padding">
    <div class="container-fluid container-width">
        <div class="row">
            <div class="col-lg-5">
                {{-- http://commondatastorage.googleapis.com/gtv-videos-bucket/sample/BigBuckBunny.mp4 --}}
                <video controls width="100%" height="100%" poster="./images/vide-bg.png">
                    <source src="{{ asset(getSettingDataHelper('video')) }}"
                    type="video/mp4">
                </video>
            </div>
            <div class="col-lg-7">
                <div class="our-aim-content">
                    <h5 class="text-yellow text-captilize green-heading">Interdum maximus</h5>
                    <h2 class="orange-text-img">Visitors Count</h2>
                    <p class="para-1 text-opacity">
                        Donec dapibus mauris id odio ornare tempus. Duis sit amet accumsan justo, quis tempor ligula. Quisque quis pharetra felis. Ut quis consequat orci, at consequat felis. Suspendisse auctor laoreet placerat.
                    </p>
                    <div class="row">
                        <div class="col-lg-4">
                            <div class="visiter-states">
                                <div class="img-wrap-1">
                                    <img src="{{ asset('assets/front/images/visit-img-3.svg') }}" class="img-fluid">
                                </div>
                                <h3 class="text-center">45760</h3>
                                <p class="text-center">Website Visited</p>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="visiter-states">
                                <div class="img-wrap-1">
                                    <img src="{{ asset('assets/front/images/visit-img-1.svg') }}" class="img-fluid">
                                </div>
                                <h3 class="text-center">{{ $course_count }}</h3>
                                <p class="text-center" >Courses</p>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="visiter-states">
                                <div class="img-wrap-1">
                                    <img src="{{asset('assets/front/images/visit-img-2.svg')}}" class="img-fluid">
                                </div>
                                <h3 class="text-center">{{ $department_count }}</h3>
                                <p class="text-center">Departments</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>