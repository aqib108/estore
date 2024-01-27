@extends('layouts.app')
@section('content')
<section class="bg-img1 txt-center p-lr-15 p-tb-92" >
		<h2 class="ltext-105  txt-center">
		  Issue Booking
		</h2>
    <small>If you encounter any problems, you can now book your issue via this form</small>
</section>	
<section class="bg0  p-b-116">
		<div class="container">
			<div class="flex-w flex-tr">
				<div class="size-210 bor10 p-lr-70 p-t-55 p-b-70 p-lr-15-lg w-full-md">
				@if(session('msg'))
     <div class="alert alert-success">
        {{ session('msg') }}
      </div>
      @endif
					<form method="POST" action="{{route('issue.booking.save')}}">
						@csrf
            <div class="bor8 m-b-20 how-pos4-parent">
							<input required class="stext-111 cl2 plh3 size-116 p-l-30 " type="text" name="name" placeholder="Your Name">
						</div>
             <div class="bor8 m-b-20 how-pos4-parent">
							<input required class="stext-111 cl2 plh3 size-116 p-l-30 " type="text" name="phone" placeholder="Your Phone Number">
						</div>
						<div class="bor8 m-b-20 how-pos4-parent">
							<input required class="stext-111 cl2 plh3 size-116 p-l-30 " type="text" name="location" placeholder="Your Location">
						</div>

						<div class="bor8 m-b-30">
							<textarea  class="stext-111 cl2 plh3 size-120 p-lr-28 p-tb-25" name="description" placeholder="Description"></textarea>
						</div>

						<button class="flex-c-m stext-101 cl0 size-121 bg3 bor1 hov-btn3 p-lr-15 trans-04 pointer">
							Send
						</button>
					</form>
				</div>

				<div class="size-210 bor10 flex-w flex-col-m p-lr-93 p-tb-30 p-lr-15-lg w-full-md">
					<div class="flex-w w-full p-b-42">
						<span class="fs-18 cl5 txt-center size-211">
							<span class="lnr lnr-map-marker"></span>
						</span>

						<div class="size-212 p-t-2">
							<span class="mtext-110 cl2">
								Address
							</span>

							<p class="stext-115 cl6 size-213 p-t-18">
								{{getCompanyLocationName()}}
							</p>
						</div>
					</div>

					<div class="flex-w w-full p-b-42">
						<span class="fs-18 cl5 txt-center size-211">
							<span class="lnr lnr-phone-handset"></span>
						</span>

						<div class="size-212 p-t-2">
							<span class="mtext-110 cl2">
								Lets Talk
							</span>

							<p class="stext-115 cl1 size-213 p-t-18">
								{{getCompanyPhoneNo()}}
							</p>
						</div>
					</div>

					<div class="flex-w w-full">
						<span class="fs-18 cl5 txt-center size-211">
							<span class="lnr lnr-envelope"></span>
						</span>

						<div class="size-212 p-t-2">
							<span class="mtext-110 cl2">
								Sale Support
							</span>

							<p class="stext-115 cl1 size-213 p-t-18">
								{{getCompanyEmail()}}
							</p>
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