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
		        <h1 class="m-0">Create Customer</h1>
		      </div><!-- /.col -->
		      <div class="col-sm-6">
		        <ol class="breadcrumb float-sm-right">
		          <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
		          <li class="breadcrumb-item"><a href="{{ URL('admin/customers') }}">Customers</a></li>
		          <li class="breadcrumb-item active">Create Customer</li>
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
										@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
			                <form id="customer-form" action="{{ URL('admin/customers') }}" enctype="multipart/form-data" method="POST"> 
			                	{!! csrf_field() !!}
			                	<input type="hidden" name="action" value="{{$action}}">
			                	<input type="hidden" name="id" value="{{ isset($id) ? $id : '' }}">
			                  	<div class="row">
			                  		
				                    <div class="col-sm-6">
				                      <!-- text input -->
				                      <div class="form-group">
				                        <label>Name</label>
				                        <input type="text" class="form-control" placeholder="Enter Name" name="name" value="{{ $row->name }}">
				                      </div>
				                    </div>

				                    <div class="col-sm-6">
				                      <div class="form-group">
				                        <label>Email</label>
				                        <input type="email" class="form-control" placeholder="Enter Email" name="email" value="{{ $row->email }}">
				                      </div>
				                    </div>

			                  	</div>


			                  	<div class="row">
				                    <div class="col-sm-4">
				                      <!-- text input -->
				                      <div class="form-group">
				                        <label>Password</label>
				                        <input type="password" class="form-control" id="password" placeholder="Enter Password" name="password" value="{{ $row->origional_password }}" {{ $action=='edit'?'':'required' }}>
				                      </div>
				                    </div>
				                    <div class="col-sm-4">
				                      <div class="form-group">
				                        <label>Repeat Password</label>
				                        <input type="password" class="form-control" placeholder="Enter Password" name="repeat_password" value="{{ $row->origional_password }}" {{ $action=='edit'?'':'required' }}>
				                      </div>
				                    </div>

				                    <div class="col-sm-4">
				                      	<div class="form-group">
				                      		<label>Status</label>
					                        <br>
				                         	<div class="icheck-primary d-inline">
				                         		Active
						                        <input type="radio" name="status" id="active-radio" value="1" {{ ($row->status==1) ? 'checked' : '' }}>
						                        <label for="active-radio">
						                        </label>
					                      	</div>
					                      	<div class="icheck-primary d-inline">
					                      		In-Active
						                        <input type="radio" name="status" id="in-active-radio" value="0" {{ ($row->status==0) ? 'checked' : '' }}>
						                        <label for="in-active-radio">
					                        	</label>
					                      	</div>

					                    </div>
				                    </div>
			                  	</div>
			                  	<div class="row">
			                  		<div class="col-sm-12">
			                  			<a href="{{ URL('admin/admins') }}" class="btn btn-info"> Cancel </a>
			                  			<button type="submit" class="btn btn-primary float-right"> {{ ($action=='add') ? 'Save' : 'Update' }} </button>
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
		  $('#customer-form').validate({
		    rules: 
		    {
		      name: {
		        required: true,
		      },
		      email: {
		        required: true,
		        email: true,
		      },
		      password: {
		        minlength: 8
		      },
		      repeat_password: {
		        minlength: 8,
		        equalTo : "#password"
		      },
		      status: {
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