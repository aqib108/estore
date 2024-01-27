<div class="wrap-header-mobile">
			<!-- Logo moblie -->		
			<div class="logo-mobile">
				<a href="/"><img src="{{ asset('assets/front/images/logo.png') }}" alt="IMG-LOGO"></a>
			</div>

			<!-- Icon header -->
			<div class="wrap-icon-header flex-w flex-r-m m-r-15">
			
				
<div class="d-none cart-url" data-url='{{route('cart.list')}}'></div>
				<div class="icon-header-item cl2 hov-cl1 trans-04 p-r-11 p-l-10 {{ !Cart::isEmpty() ? 'icon-header-noti' : '' }} js-show-cart e-cart-count" 
				 @if (!Cart::isEmpty())
         data-notify="{{ Cart::getTotalQuantity() }}"
        @endif
				>
					<i class="zmdi zmdi-shopping-cart"></i>
				</div>

			
			</div>

			<!-- Button show menu -->
			<div class="btn-show-menu-mobile hamburger hamburger--squeeze">
				<span class="hamburger-box">
					<span class="hamburger-inner"></span>
				</span>
			</div>
		</div>