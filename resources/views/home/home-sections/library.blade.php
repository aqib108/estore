<section class="noor-libarary">
    <div class="container-fluid container-width">
        <div class="d-flex flex-column justify-content-center align-items-center library-content">
            <h5 class="text-yellow text-captilize text-center">{{__('app.assets')}}</h5>
            <h2 class="center-image-heading orange-text-img text-center">{{__('app.our_library')}}</h2>
            <p class="text-center para-3">{{ __('app.library-content') }}</p>
        </div>
        <div class="row library-tabs">
            <div class="col-12 d-flex justify-content-center align-items-center flex-column">
                <ul class="library-navs nav nav-pills mb-3 mt-3" id="pills-tab" role="tablist">
                    @foreach($libraryTypes as $key => $type)
                    <li class="nav-item" role="presentation">
                        <button class="nav-link {{  ($key == 0) ? 'active':'' }} lib-tab-headers lib-{{$type->id}}" data-cl="lib-{{$type->id}}" data-val="{{$type->id}}" aria-selected="true" onclick="getLibrarySections('{{$type->id}}','lib-{{$type->id}}')">@php echo set_locale($type->title) @endphp</button>
                    </li>
                    @endforeach
                    {{-- <li class="nav-item" role="presentation">
                        <button class="nav-link" id="#pills-Audio" data-bs-toggle="pill" data-bs-target="#pills-Audio" type="button" role="tab" aria-controls="pills-profile" aria-selected="false">Audio Gallery</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="pills-contact" data-bs-toggle="pill" data-bs-target="#pills-Books" type="button" role="tab" aria-controls="pills-contact" aria-selected="false">Books Gallery</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="pills-contact-tab" data-bs-toggle="pill" data-bs-target="#pills-Video" type="button" role="tab" aria-controls="pills-contact" aria-selected="false">Video Gallery</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="pills-contact-tab" data-bs-toggle="pill" data-bs-target="#pills-Document" type="button" role="tab" aria-controls="pills-contact" aria-selected="false">Document Gallery</button>
                    </li> --}}
                </ul>
                <div class="noor-libray-content tab-content" id="pills-tabContent">
                    <div class="tab-pane fade show active" id="pills-Image" role="tabpanel" aria-labelledby="pills-Image">
                        <div class="tab-info">
                            <div class="row home-lib-row" id="lib-tab-content">

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@push('footer-scripts')
@include('home.scripts.library-script')
@endpush
