@extends('layouts.app')
@section('content')
	<section class="bg0 p-t-23 p-b-140">
		<div class="container">
		<div class="p-b-10">
				<h3 class="ltext-103 cl5">
				Offers
				</h3>
			</div>


		 <div id="product-wrapper pt-5">
		 @include('store.pages.offer.offer-cart')
		 </div>

		</div>
	</section>
@endsection

