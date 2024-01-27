@extends('layouts.app')

@section('content')
<section class="bg-img1 txt-center p-lr-15 p-tb-92">
    <h2 class="ltext-105  txt-center">
        Register
    </h2>
</section>

<section class="bg0  p-b-116">
    <div class="container">
        <div class="flex-w flex-tr">
            <div class="size-210 bor10 p-lr-70 p-t-55 p-b-70 p-lr-15-lg w-full-md">
                <form method="POST" action="{{ route('register') }}">
                    @csrf

                    <div class="bor8 m-b-20 how-pos4-parent">
                        <input id="name" type="text" class="stext-111 cl2 plh3 size-116 p-l-62 p-r-30  @if ($errors->has('name')) is-invalid @endif" placeholder="Enter Your Name" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
                        <img class="how-pos4 pointer-none" src="{{ asset('assets/store/images/icons/icon-user.png') }}" alt="ICON">
                    </div>
                    @if ($errors->has('name'))
                    <span class="error text-danger">{{ $errors->first('name') }}</span>
                    @endif

                    <div class="bor8 m-b-20 how-pos4-parent">
                        <input class="stext-111 cl2 plh3 size-116 p-l-62 p-r-30  @if ($errors->has('email')) is-invalid @endif" type="email" required autocomplete="email" autofocus name="email" value="{{ old('email') }}" placeholder="Your Email Address">
                        <img class="how-pos4 pointer-none" src="{{ asset('assets/store/images/icons/icon-email.png') }}" alt="ICON">
                    </div>
                    @if ($errors->has('email'))
                    <span class="error text-danger">{{ $errors->first('email') }}</span>
                    @endif

                    <div class="bor8 m-b-20 how-pos4-parent">
                        <input id="password" type="password" class="stext-111 cl2 plh3 size-116 p-l-62 p-r-30 @if ($errors->has('password')) is-invalid @endif" placeholder="Enter Password" name="password" required autocomplete="new-password">
                        <img class="how-pos4 pointer-none" src="{{ asset('assets/store/images/icons/icon-password.png') }}" alt="ICON">

                    </div>
                    @if ($errors->has('password'))
                    <span class="error text-danger">{{ $errors->first('password') }}</span>
                    @endif
                    <div class="bor8 m-b-20 how-pos4-parent">
                        <input id="password-confirm" type="password" class="stext-111 cl2 plh3 size-116 p-l-62 p-r-30" name="password_confirmation" placeholder="Enter Confirm Password" required autocomplete="new-password">
                        <img class="how-pos4 pointer-none" src="{{ asset('assets/store/images/icons/icon-password.png') }}" alt="ICON">

                    </div>
                    <button class="flex-c-m stext-101 cl0 size-121 bg3 bor1 hov-btn3 p-lr-15 trans-04 pointer">
                        Register
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
<div class="container d-none">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Register') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="row mb-3">
                            <label for="name" class="col-md-4 col-form-label text-md-end">{{ __('Name') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('E-Mail Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password" class="col-md-4 col-form-label text-md-end">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-end">{{ __('Confirm Password') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Register') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
