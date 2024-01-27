@extends('admin.layout.app')

@push('header-scripts')
<!-- Google Font: Source Sans Pro -->
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
<!-- Font Awesome -->
<link rel="stylesheet" href="{{asset('assets/admin/fontawesome-free/css/all.min.css')}}">
<!-- iCheck for checkboxes and radio inputs -->
<link rel="stylesheet" href="{{asset('assets/admin/icheck-bootstrap/icheck-bootstrap.min.css')}}">
<!-- Theme style -->
<link rel="stylesheet" href="{{asset('assets/admin/dist/css/adminlte.min.css')}}">
@endpush

@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Site Setting</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ URL('admin/site-setting') }}">Site Setting</a></li>
                        <li class="breadcrumb-item active">Update Site Setting</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <!-- general form elements -->
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Setting Form</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <form id="user-form" action="{{ URL('admin/site-setting') }}" enctype="multipart/form-data" method="POST">
                                {!! csrf_field() !!}

                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">Logo *</label>
                                    <div class="col-sm-6">
                                        <input type="file" class="form-control" placeholder="Select Logo" id="imageinpt" name="logo" value="">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label"> Title *</label>
                                    <div class="col-sm-6">
                                        <input type="text" class="form-control" placeholder="Enter First Name" name="title" value="{{isset($settings['title']) ? $settings['title'] : ''}}">
                                    </div>

                                </div>

                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label"> Email *</label>
                                    <div class="col-sm-6">
                                        <input type="email" class="form-control" placeholder="Enter Last Name" name="email" value="{{isset($settings['email']) ? $settings['email'] : ''}}">
                                    </div>

                                </div>

                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label"> Phone *</label>
                                    <div class="col-sm-6">
                                        <input type="text" class="form-control" placeholder="Enter Last Name" name="phone" value="{{isset($settings['phone']) ? $settings['phone'] : ''}}">
                                    </div>

                                </div>

                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label"> Whatsapp *</label>
                                    <div class="col-sm-6">
                                        <input type="text" class="form-control" placeholder="Enter First Name" name="whatsapp" value="{{isset($settings['whatsapp']) ? $settings['whatsapp'] : ''}}">
                                    </div>

                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label"> Location 1 *</label>
                                    <div class="col-sm-6">
                                        <input type="text" class="form-control" placeholder="Enter location 1" name="location_1" value="{{isset($settings['location_1']) ? $settings['location_1'] : ''}}">
                                    </div>

                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label"> Location 2 *</label>
                                    <div class="col-sm-6">
                                        <input type="text" class="form-control" placeholder="Enter location 2" name="location_2" value="{{isset($settings['location_2']) ? $settings['location_2'] : ''}}">
                                    </div>

                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label"> About us</label>
                                    <div class="col-sm-6">
                                        <input type="text" class="form-control" placeholder="About us" name="about" value="{{isset($settings['about']) ? $settings['about'] : ''}}">
                                    </div>

                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label"> Opening Time *</label>
                                    <div class="col-sm-6">
                                        <input type="time" class="form-control" placeholder="Enter First Name" name="opening_time" value="{{isset($settings['opening_time']) ? $settings['opening_time'] : ''}}">
                                    </div>

                                </div>

                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label"> Play Store Link</label>
                                    <div class="col-sm-6">
                                        <input type="url" class="form-control" placeholder="Play store Link" name="play_store" value="{{isset($settings['play_store']) ? $settings['play_store'] : ''}}">
                                    </div>

                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label"> App Store Link</label>
                                    <div class="col-sm-6">
                                        <input type="url" class="form-control" placeholder="App store Link" name="app_store" value="{{isset($settings['app_store']) ? $settings['app_store'] : ''}}"> 
                                    </div>

                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label"> FaceBook Link</label>
                                    <div class="col-sm-6">
                                        <input type="url" class="form-control" placeholder="facebook" name="facebook" value="{{isset($settings['facebook']) ? $settings['facebook'] : ''}}">
                                    </div>

                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label"> Linkedin Link</label>
                                    <div class="col-sm-6">
                                        <input type="url" class="form-control" placeholder="Linkedin" name="linkedin" value="{{isset($settings['linkedin']) ? $settings['linkedin'] : ''}}">
                                    </div>

                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label"> Pinterest Link</label>
                                    <div class="col-sm-6">
                                        <input type="url" class="form-control" placeholder="pinterest" name="pinterest" value="{{isset($settings['pinterest']) ? $settings['pinterest'] : ''}}">
                                    </div>

                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label"> Twitter Link</label>
                                    <div class="col-sm-6">
                                        <input type="url" class="form-control" placeholder="twitter" name="twitter" value="{{isset($settings['twitter']) ? $settings['twitter'] : ''}}">
                                    </div>

                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label"> Youtube Link</label>
                                    <div class="col-sm-6">
                                        <input type="url" class="form-control" placeholder="youtube" name="youtube" value="{{isset($settings['youtube']) ? $settings['youtube'] : ''}}">
                                    </div>

                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label"> Shipping Charges</label>
                                    <div class="col-sm-6">
                                        <input type="text" class="form-control" placeholder=" Enter shipping charges" name="shipping_charges" value="{{isset($settings['shipping_charges']) ? $settings['shipping_charges'] : ''}}">
                                    </div>

                                </div>
                                <div class="d-flex justify-content-end mb-3 mr-3">
                                    <a href="{{ URL('admin/dashboard') }}" class="btn btn-info mr-3"> Cancel </a>
                                    <button type="submit" class="btn btn-primary float-right"> Update Settings </button>
                                </div>
                            </form>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
            </div>
        </div>
    </section>
    <!-- Main content -->
</div>
@endsection

@push('footer-scripts')
<!-- jQuery -->
<script src="{{asset('assets/admin/jquery/jquery.min.js')}}"></script>
<!-- Bootstrap 4 -->
<script src="{{asset('assets/admin/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<!-- jquery-validation -->
<script src="{{asset('assets/admin/jquery-validation/jquery.validate.min.js')}}"></script>
<script src="{{asset('assets/admin/jquery-validation/additional-methods.min.js')}}"></script>
<!-- InputMask -->
<script src="{{asset('assets/admin/moment/moment.min.js')}}"></script>
<script src="{{asset('assets/admin/inputmask/jquery.inputmask.min.js')}}"></script>
<!-- bs-custom-file-input -->
<script src="{{asset('assets/admin/bs-custom-file-input/bs-custom-file-input.min.js')}}"></script>
<!-- AdminLTE App -->
<script src="{{asset('assets/admin/dist/js/adminlte.min.js')}}"></script>
<!-- AdminLTE for demo purposes -->
<script src="{{asset('assets/admin/dist/js/demo.js')}}"></script>
<!-- Page specific script -->
<script>
    $(function() {
        $('[data-mask]').inputmask();
        bsCustomFileInput.init();
        $('#user-form').validate({
            rules: {
                title: {
                    required: true
                , }
                , email: {
                    required: true
                , }
                , phone: {
                    required: true
                , }
            }
            , errorElement: 'span'
            , errorPlacement: function(error, element) {
                error.addClass('invalid-feedback');
                element.closest('.form-group').append(error);
            }
            , highlight: function(element, errorClass, validClass) {
                $(element).addClass('is-invalid');
            }
            , unhighlight: function(element, errorClass, validClass) {
                $(element).removeClass('is-invalid');
            }
        });
    });

</script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    Filevalidation = () => {
        const fi = document.getElementById('videoinpt');
        // Check if any file is selected.
        if (fi.files.length > 0) {
            const fsize = fi.files.item(0).size;
            const file = Math.round((fsize / 1024));
            // The size of the file.
            if (file >= 8192) {
                Swal.fire({
                    icon: 'error'
                    , title: 'Oops...'
                    , text: 'Please select a file less than 8mb'
                , })
                fi.value = '';
            } else {
                document.getElementById('size').innerHTML = '<b>' +
                    file + '</b> KB';
            }
        }
    }

</script>
@endpush
