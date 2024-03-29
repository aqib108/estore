<footer class="bg3 p-t-75 p-b-32">
    <div class="container">
        <div class="row">
            <div class="col-sm-6 col-lg-4 p-b-50">
                <h4 class="stext-301 cl0 p-b-30">
                    Categories
                </h4>

                <ul>

                    @foreach(getProductCategories() as $category)
                    <li class="p-b-10">
                        <a href="{{route('get.products',['category'=> $category?->id])}}" class="stext-107 cl7 hov-cl1 trans-04">
                            {{$category?->name}}
                        </a>
                    </li>
                    @endforeach



                </ul>
            </div>

            <div class="col-sm-6 col-lg-4 p-b-50">
                <h4 class="stext-301 cl0 p-b-30">
                    Help
                </h4>

                <ul>
                    <li class="p-b-10">
                        <a href="{{route('about_us')}}" class="stext-107 cl7 hov-cl1 trans-04">
                            About Us
                        </a>
                    </li>

                    <li class="p-b-10">
                        <a href="{{route('contact_us')}}" class="stext-107 cl7 hov-cl1 trans-04">
                            Contact Us
                        </a>
                    </li>

                    <li class="p-b-10">
                        <a href="{{route('offer.list')}}" class="stext-107 cl7 hov-cl1 trans-04">
                            Offers
                        </a>
                    </li>

                    <li class="p-b-10">
                        <a href="{{route('issue.booking.page')}}" class="stext-107 cl7 hov-cl1 trans-04">
                            Issue Booking
                        </a>
                    </li>
                </ul>
            </div>

            <div class="col-sm-6 col-lg-4 p-b-50">
                <h4 class="stext-301 cl0 p-b-30">
                    GET IN TOUCH
                </h4>

                <p class="stext-107 cl7 size-201">
                    Any questions? Let us know in store at {{getCompanyLocationName()}} or call us on {{getCompanyPhoneNo()}}
                </p>

                <div class="p-t-27">
                    <a href="{{ getSetting('facebook') }}" class="fs-18 cl7 hov-cl1 trans-04 m-r-16">
                        <i class="fa fa-facebook"></i>
                    </a>
                    <a href="{{ getSetting('whatsapp') }}" class="fs-18 cl7 hov-cl1 trans-04 m-r-16">
                        <i class="fa fa-whatsapp"></i>
                    </a>

                    <a href="{{ getSetting('instagram') }}" class="fs-18 cl7 hov-cl1 trans-04 m-r-16">
                        <i class="fa fa-instagram"></i>
                    </a>
                    <a href="{{ getSetting('linkedin') }}" class="fs-18 cl7 hov-cl1 trans-04 m-r-16">
                        <i class="fa fa-linkedin"></i>
                    </a>
                    <a href="{{ getSetting('twitter') }}" class="fs-18 cl7 hov-cl1 trans-04 m-r-16">
                        <i class="fa fa-twitter"></i>
                    </a>
                    <a href="{{ getSetting('youtube') }}" class="fs-18 cl7 hov-cl1 trans-04 m-r-16">
                        <i class="fa fa-youtube"></i>
                    </a>

                    <a href="{{ getSetting('pinterest') }}" class="fs-18 cl7 hov-cl1 trans-04 m-r-16">
                        <i class="fa fa-pinterest-p"></i>
                    </a>
                </div>
            </div>

            <div class="col-sm-6 col-lg-3 p-b-50 d-none">
                <h4 class="stext-301 cl0 p-b-30">
                    Newsletter
                </h4>

                <form>
                    <div class="wrap-input1 w-full p-b-4">
                        <input class="input1 bg-none plh1 stext-107 cl7" type="text" name="email" placeholder="email@example.com">
                        <div class="focus-input1 trans-04"></div>
                    </div>

                    <div class="p-t-18">
                        <button class="flex-c-m stext-101 cl0 size-103 bg1 bor1 hov-btn2 p-lr-15 trans-04">
                            Subscribe
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <div class="p-t-40">
            <div class="d-none flex-c-m flex-w p-b-18">
                <a href="#" class="m-all-1">
                    <img src="{{ asset('assets/store/images/icons/icon-pay-01.png') }}" alt="ICON-PAY">
                </a>

                <a href="#" class="m-all-1">
                    <img src="{{ asset('assets/store/images/icons/icon-pay-02.png') }}" alt="ICON-PAY">
                </a>

                <a href="#" class="m-all-1">
                    <img src="{{ asset('assets/store/images/icons/icon-pay-03.png') }}" alt="ICON-PAY">
                </a>

                <a href="#" class="m-all-1">
                    <img src="{{ asset('assets/store/images/icons/icon-pay-04.png') }}" alt="ICON-PAY">
                </a>

                <a href="#" class="m-all-1">
                    <img src="{{ asset('assets/store/images/icons/icon-pay-05.png') }}" alt="ICON-PAY">
                </a>
            </div>

            <p class="stext-107 cl6 txt-center">
                <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                Copyright &copy;<script>
                    document.write(new Date().getFullYear());

                </script> All rights reserved | Made with <i class="fa fa-heart-o" aria-hidden="true"></i> by <a href="/" target="_blank">{{getProductName()}}</a> &amp; distributed by <a href="/" target="_blank">{{getProductName()}}</a>
                <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->

            </p>
        </div>
    </div>
</footer>
