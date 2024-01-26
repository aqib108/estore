@extends('layouts.app')

@section('content')
<section class="bg-img1 txt-center p-lr-15 p-tb-92" >
		<h2 class="ltext-105  txt-center">
			Login
		</h2>
</section>	
<section class="bg0  p-b-116">
		<div class="container">
			<div class="flex-w flex-tr">
				<div class="size-210 bor10 p-lr-70 p-t-55 p-b-70 p-lr-15-lg w-full-md">
					<form method="POST" action="{{ route('login') }}">
                    @csrf
						

						<div class="bor8 m-b-20 how-pos4-parent">
							<input class="stext-111 cl2 plh3 size-116 p-l-62 p-r-30 @error('email') is-invalid @enderror" type="email"  required autocomplete="email" autofocus name="email" value="{{ old('email') }}" placeholder="Your Email Address">
							<img class="how-pos4 pointer-none" src="{{ asset('assets/store/images/icons/icon-email.png') }}" alt="ICON">
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
						</div>
                        
                        <div class="bor8 m-b-20 how-pos4-parent">
                          <input id="password" type="password" class="stext-111 cl2 plh3 size-116 p-l-62 p-r-30 @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
                         <img class="how-pos4 pointer-none" src="{{ asset('assets/store/images/icons/icon-password.png') }}" alt="ICON">
                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
						
                     </div>
						<button class="flex-c-m stext-101 cl0 size-121 bg3 bor1 hov-btn3 p-lr-15 trans-04 pointer">
							Login
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

@endsection
