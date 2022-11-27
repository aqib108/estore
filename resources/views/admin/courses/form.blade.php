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
  <!-- SummerNote -->
  <link rel="stylesheet" href="{{asset('assets/admin/summernote/summernote-bs4.min.css')}}">
   <!-- Select2 -->
  <link rel="stylesheet" href="{{asset('assets/admin/select2/css/select2.min.css')}}">
  <link rel="stylesheet" href="{{asset('assets/admin/select2-bootstrap4-theme/select2-bootstrap4.min.css')}}">

   <style>
		ul, #myUL {
		  list-style-type: none;
		}

		#myUL {
		  margin: 0;
		  padding: 0;
		}

		.caret {
		  cursor: pointer;
		  -webkit-user-select: none; /* Safari 3.1+ */
		  -moz-user-select: none; /* Firefox 2+ */
		  -ms-user-select: none; /* IE 10+ */
		  user-select: none;
		}

		.caret::before {
		  content: "\25B6";
		  color: black;
		  display: inline-block;
		  margin-right: 6px;
		}

		.caret-down::before {
		  -ms-transform: rotate(90deg); /* IE 9 */
		  -webkit-transform: rotate(90deg); /* Safari */'
		  transform: rotate(90deg);  
		}

		.nested {
		  display: none;
		}

		.active {
		  display: block;
		}
  </style>
@endpush

@section('content')
	<!-- Content Wrapper. Contains page content -->
	<div class="content-wrapper">
		<!-- Content Header (Page header) -->
		<div class="content-header">
		  <div class="container-fluid">
		    <div class="row mb-2">
		      <div class="col-sm-6">
		        <h1 class="m-0">Create Slider</h1>
		      </div><!-- /.col -->
		      <div class="col-sm-6">
		        <ol class="breadcrumb float-sm-right">
		          <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
		          <li class="breadcrumb-item"><a href="{{ URL('admin/sliders') }}">Sliders</a></li>
		          <li class="breadcrumb-item active">Create Slider</li>
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
			                <h3 class="card-title">Course Form</h3>
			              </div>
			              <!-- /.card-header -->
			              <div class="card-body">
			                <form id="slider-form" class="form-horizontal label-left" action="{{ URL('admin/courses') }}" enctype="multipart/form-data" method="POST"> 
			                	{!! csrf_field() !!}
			                	<input type="hidden" name="action" value="{{$action}}">
			                	<input type="hidden" name="id" value="{{ isset($id) ? $id : '' }}">
			                	<div class="card-body">
								@if($action=='edit')
								@php 
								$coursename = (array)json_decode($row->name);
								$courseContent = (array)json_decode($row->description);
								@endphp
								@endif
			                		@foreach($languages as $language)
									<div class="form-group row">
				                        <label class="col-sm-2 col-form-label">Name {{$language->name }}</label>
				                        <div class="col-sm-6">
				                        	<input type="text" class="form-control" placeholder="Enter Title {{$language->name }}" name="name[{{$language->short_name}}]" value="{{isset($coursename[$language->short_name])?$coursename[$language->short_name]:''}}" required="">
				                        </div>
				                    </div>
									@endforeach
									@foreach($languages as $language)
				                    <div class="form-group row">
				                        <label class="col-sm-2 col-form-label">Description {{$language->name}}</label>
				                        <div class="col-sm-6">
				                        	<textarea id="summernote" name="description[{{$language->short_name}}]" row="10" cols="65">{{isset($courseContent[$language->short_name])?$courseContent[$language->short_name]:''}}</textarea>
				                        </div>
				                    </div>
									@endforeach
				                    <div class="form-group row">
				                        <label class="col-sm-2 col-form-label">Status</label>
				                        <div class="col-sm-6">
				                        	<div class="icheck-primary d-inline">
				                         		Active
						                        <input type="radio" name="status" id="active-radio-status" value="1" {{ ($row->status==1) ? 'checked' : '' }}>
						                        <label for="active-radio-status">
						                        </label>
					                      	</div>
					                      	<div class="icheck-primary d-inline">
					                      		In-Active
						                        <input type="radio" name="status" id="in-active-radio-status" value="0" {{ ($row->status==0) ? 'checked' : '' }}>
						                        <label for="in-active-radio-status">
					                        	</label>
					                      	</div>
				                        </div>
				                    </div>

				                    <hr>

				                    <hr>
				                  	<div class="form-group text-right">
				                  		<div class="col-sm-12">
				                  			<a href="{{ URL('admin/sliders') }}" class="btn btn-info" style="margin-right:05px;"> Cancel </a>
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
	<!-- SummerNote -->
	<script src="{{asset('assets/admin/summernote/summernote-bs4.min.js')}}"></script>
	<!-- Select2 -->
	<script src="{{asset('assets/admin/select2/js/select2.full.min.js')}}"></script>
	<!-- Page specific script -->
	<script>
	  $(function () {
		  	// Summernote
		  	$('.select2bs4').select2({
		      theme: 'bootstrap4'
		    })


		  	$('#slider-form').validate({
			    rules: 
			    {},
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