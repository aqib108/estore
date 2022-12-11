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
		        <h1 class="m-0">Create Role</h1>
		      </div><!-- /.col -->
		      <div class="col-sm-6">
		        <ol class="breadcrumb float-sm-right">
		          <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
		          <li class="breadcrumb-item"><a href="{{ URL('admin/roles') }}">Roles</a></li>
		          <li class="breadcrumb-item active">Create Role</li>
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
			                <h3 class="card-title">Role Form</h3>
			              </div>
			              <!-- /.card-header -->
			              <div class="card-body">
			                <form id="role-form" class="form-horizontal label-left" action="{{ URL('admin/roles') }}" enctype="multipart/form-data" method="POST"> 
			                	{!! csrf_field() !!}
			                	<input type="hidden" name="action" value="{{$action}}">
			                	<input type="hidden" name="id" value="{{ isset($id) ? $id : '' }}">
			                	<div class="card-body">
			                		<div class="form-group row">
				                        <label class="col-sm-2 col-form-label">Role Name</label>
				                        <div class="col-sm-6">
				                        	<input type="text" class="form-control" placeholder="Enter Role Name" name="name" value="{{ $row->name }}">
				                        </div>
				                    </div>

				                    <div class="form-group row">
				                        <label class="col-sm-2 col-form-label">Status</label>
				                        <div class="col-sm-6">
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

				                    @if($row->id != 1)
					                  	<hr>
										<h4 class="heading">To give permission on specific module.</h4><br>
										@foreach(rights() as $module => $rights)
											<div class="card card-success">
								              <div class="card-header">
								                <h3 class="card-title">{{$module}}</h3>
								              </div>
								              <div class="card-body row">
								              	@foreach($rights as $key => $right)
													<?php
					                                   	$checked = '';
					                                   	if(!empty($row->right_ids) && in_array($right->right_name,explode(',', $row->right_ids)))
					                                   	{
					                                       $checked = "checked";
					                                   	}
					                               	?>
					                               	 <div class="col-sm-3">
														<label class="fancy-checkbox custom-bgcolor-darkblue">
															<div class="form-group">
											                    <div class="custom-control custom-switch custom-switch-off-danger custom-switch-on-success">
											                      <input type="checkbox" name="right_ids[]" class="custom-control-input" id="{{$module}}-right-id-{{$key}}" <?php echo $checked;?>
																value="{{$right->right_name}}">
											                      <label class="custom-control-label" for="{{$module}}-right-id-{{$key}}">{{ ucwords(str_replace("-"," ",$right->right_name))}}</label>
											                    </div>
											                  </div>
														</label>
													</div>
												@endforeach
								              </div>
								            </div>
										@endforeach
									@endif

				                  	<div class="form-group text-right">
				                  		<div class="col-sm-12">
				                  			<a href="{{ URL('admin/roles') }}" class="btn btn-info" style="margin-right:05px;"> Cancel </a>
				                  			<button type="submit" class="btn btn-primary float-right"> {{ ($action=='add') ? 'Save' : 'Update' }} </button>
				                  		</div>
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
		  $('#role-form').validate({
		    rules: 
		    {
		      name: {
		        required: true,
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