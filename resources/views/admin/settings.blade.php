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
            <h1 class="m-0">Create Admin User</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
              <li class="breadcrumb-item"><a href="{{ URL('admin/admins') }}">Admin Users</a></li>
              <li class="breadcrumb-item active">Create Admin User</li>
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
                      <h3 class="card-title">User Form</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                      <form id="user-form" action="{{ URL('admin/site-setting') }}" enctype="multipart/form-data" method="POST"> 
                        {!! csrf_field() !!}
                          <div class="row">

                            <div class="col-sm-4">
                              <div class="form-group">
                                <label>Title</label>
                                <input type="text" class="form-control" placeholder="Enter First Name" name="title" value="{{isset($settings['title']) ? $settings['title'] : ''}}">
                              </div>
                            </div>

                            <div class="col-sm-4">
                              <div class="form-group">
                                <label>Email</label>
                                <input type="email" class="form-control" placeholder="Enter Last Name" name="email" value="{{isset($settings['email']) ? $settings['email'] : ''}}">
                              </div>
                            </div>

                            <div class="col-sm-4">
                              <div class="form-group">
                                <label>Phone</label>
                                <input type="text" class="form-control" placeholder="Enter Last Name" name="phone" data-inputmask='"mask": "(999) 999-9999"' data-mask value="{{isset($settings['phone']) ? $settings['phone'] : ''}}">
                              </div>
                            </div>

                          </div>

                          <div class="row">
                            <div class="col-sm-12">
                              <a href="{{ URL('admin/dashboard') }}" class="btn btn-info"> Cancel </a>
                              <button type="submit" class="btn btn-primary float-right"> Update Settings </button>
                            </div>
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
    $(function () {
      $('[data-mask]').inputmask();
      bsCustomFileInput.init();
      $('#user-form').validate({
        rules: 
        {
          title: {
            required: true,
          },
          email: {
            required: true,
          },
          phone:{
            required: true,
          }
        },
        errorElement: 'span',
        errorPlacement: function (error, element) {
          error.addClass('invalid-feedback');
          element.closest('.form-group').append(error);
        },
        highlight: function (element, errorClass, validClass) {
          $(element).addClass('is-invalid');
        },
        unhighlight: function (element, errorClass, validClass) {
          $(element).removeClass('is-invalid');
        }
      });
    });
  </script>
@endpush