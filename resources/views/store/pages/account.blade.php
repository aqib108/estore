@extends('layouts.app',['is_hide_slider'=>true])
@section('content')
	<section class="bg0 p-t-90 p-b-140">
		<div class="container">
			<div class="p-b-10">
				<h3 class="ltext-103 cl5">
					Account Setting
				</h3>
			</div>

			<!--category section -->
      <div class="flex-w flex-sb-m p-b-52">
				<div class="flex-w flex-l-m filter-tope-group m-tb-10">
					<button class="stext-106 cl6 hov1 bor3 trans-04 m-r-32 m-tb-5 how-active1"  id="load-profile" data-filter="*">
						Account Setting
					</button>
          <button class="stext-106 cl6 hov1 bor3 trans-04 m-r-32 m-tb-5 "  id="load-orders" data-filter="*">
						Orders
					</button>
				
				</div>

			</div>
      <!--end section-->

		 <div id="account-wrapper">
		 <div id="load-account-wrapper">
		 </div>
		 <div id="account-loader">
		 <div class="flex-c-m flex-w w-full p-t-45">
				<a href="#" class="flex-c-m stext-101 cl5 size-103 bg2 bor1 hov-btn1 p-lr-15 trans-04">
					Load More
				</a>
			</div>
		 </div>
		 
		 </div>

		</div>
	</section>
@endsection

