	<div class="row isotope-grid">
			
    @forelse($offers as $offer)
    @php
    $offerImage = $offer?->offerImages()->first()?->file_name;
    @endphp
				<div class="col-sm-6 col-md-4 col-lg-3 p-b-35 isotope-item women">
					<!-- Block2 -->
					<div class="block2">
						<div class="block2-pic hov-img0">
							<img class="product_image img-fluid" src="{{$offerImage}}" alt="IMG-OFFER">

							<a href="{{route('get.offer.detail',['sku'=>$offer?->sku])}}" class="block2-btn flex-c-m stext-103 cl2 size-102 bg0 bor2 hov-btn1 p-lr-15 trans-04">
								Quick View
							</a>
						</div>

						<div class="block2-txt flex-w flex-t p-t-14">
							<div class="block2-txt-child1 flex-col-l ">
								<a href="product-detail.html" class="stext-104 cl4 hov-cl1 trans-04 js-name-b2 p-b-6">
									{{$offer?->title}}
								</a>

								<span class="stext-105 cl3">
									${{ findTheProductAmount($offer?->price,$offer?->tax,$offer?->discount) }}
								</span>
							</div>

							<div class="block2-txt-child2 flex-r p-t-3">
								<a href="#" class="btn-addwish-b2 dis-block pos-relative js-addwish-b2">
									<img class="icon-heart1 dis-block trans-04" src="{{ asset('assets/store/images/icons/icon-heart-01.png') }}" alt="ICON">
									<img class="icon-heart2 dis-block trans-04 ab-t-l" src="{{asset('assets/store/images/icons/icon-heart-02.png')}}" alt="ICON">
								</a>
							</div>
						</div>
					</div>
				</div>
       @empty
       <div>No Offer Found</div>
       @endforelse
			
			</div>