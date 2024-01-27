@extends('layouts.app',['is_hide_slider'=>true])
@section('content')
<section class="bg-img1 txt-center p-lr-15 p-tb-92">
    <h2 class="ltext-105  txt-center">
        Place Order
    </h2>
    <h5 class="pt-3">COMPLETE YOU ORDER</h5>
</section>
<section class="bg0  p-b-116">
    <div class="container">
        <div class="flex-w flex-tr">
            <div class="size-210 bor10 p-lr-70 p-t-55 p-b-70 p-lr-15-lg w-full-md">
                <form method="POST" action="{{ route('save.order') }}">
                    @csrf
                    <div class="bor8 m-b-20 how-pos4-parent">
                        <input required class="stext-111 cl2 plh3 size-116 p-l-30 " type="text" value="{{ Auth::check() ? auth()->user()->name : '' }}" name="billing_user_name" placeholder="Your Name">
                    </div>
                    <div class="bor8 m-b-20 how-pos4-parent">
                        <input required class="stext-111 cl2 plh3 size-116 p-l-30 " type="email" name="billing_email" value="{{ Auth::check() ? auth()->user()->email : '' }}" placeholder="Your Email">
                    </div>
                    <div class="bor8 m-b-20 how-pos4-parent">
                        <input required class="stext-111 cl2 plh3 size-116 p-l-30 " type="text" name="billing_phone_number" placeholder="Your Phone Number">
                    </div>
                    <div class="bor8 m-b-20 how-pos4-parent">
                        <input required class="stext-111 cl2 plh3 size-116 p-l-30 " type="text" name="billing_city" placeholder="Your City">
                    </div>
                    <div class="bor8 m-b-20 how-pos4-parent">
                        <input required class="stext-111 cl2 plh3 size-116 p-l-30 " type="text" name="billing_address" placeholder="Your Address Location">
                    </div>
                    <div class="bor8 m-b-20 how-pos4-parent">
						<select class="stext-111 cl2 plh3 size-116 p-l-30 ">
							<option value="">Cash on Deliery</option>
						</select>
                    </div>

                    <div class="bor8 m-b-30">
                        <textarea class="stext-111 cl2 plh3 size-120 p-lr-28 p-tb-25" name="order_comment" placeholder="Order Comment"></textarea>
                    </div>

                    <button type="submit" class="flex-c-m stext-101 cl0 size-121 bg3 bor1 hov-btn3 p-lr-15 trans-04 pointer">
                        Submit Order
                    </button>
                </form>
            </div>

            <div class="size-210 bor10 flex-w flex-col-m ">
                <div class="bor10 p-lr-40 p-t-30 p-b-40 m-l-63 m-r-40 m-lr-0-xl p-lr-15-sm">
                    <h4 class="mtext-109 cl2 p-b-30">
                        Cart Totals
                    </h4>

                    <div class="flex-w flex-t bor12 p-b-13">
                        <div class="size-208">
                            <span class="stext-110 cl2">
                                Subtotal:
                            </span>
                        </div>

                        <div class="size-209">
                            <span class="mtext-110 cl2 sub-total">
                                $ {{Cart::getSubTotal()}}
                            </span>
                        </div>
                    </div>

                    <div class="flex-w flex-t p-t-27 p-b-33">
                        <div class="size-208">
                            <span class="mtext-101 cl2">
                                Total:
                            </span>
                        </div>

                        <div class="size-209 p-t-1">
                            <span class="mtext-110 cl2 total">
                                $ {{Cart::getTotal()}}
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>


<!-- Map -->
<div class="map">
    <div class="size-303" id="google_map" data-map-x="40.691446" data-map-y="-73.886787" data-pin="images/icons/pin.png" data-scrollwhell="0" data-draggable="1" data-zoom="11"></div>
</div>
@endsection
