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
		        <h1 class="m-0">Create Category</h1>
		      </div><!-- /.col -->
		      <div class="col-sm-6">
		        <ol class="breadcrumb float-sm-right">
		          <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
		          <li class="breadcrumb-item"><a href="{{ URL('admin/categories') }}">Categories</a></li>
		          <li class="breadcrumb-item active">Create Category</li>
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
			                <h3 class="card-title">Category Form</h3>
			              </div>
			              <!-- /.card-header -->
			              <div class="card-body">
			                <form id="category-form" class="form-horizontal label-left" action="{{ URL('admin/categories') }}" enctype="multipart/form-data" method="POST"> 
			                	{!! csrf_field() !!}
			                	<input type="hidden" name="action" value="{{$action}}">
			                	<input type="hidden" name="id" value="{{ isset($id) ? $id : '' }}">
			                	<div class="card-body">
			                		<div class="form-group row">
				                        <label class="col-sm-2 col-form-label">Name</label>
				                        <div class="col-sm-6">
				                        	<input type="text" class="form-control" placeholder="Enter Name" name="name" value="{{ $row->name }}" required="">
				                        </div>
				                    </div>

				                    <div class="form-group row">
				                        <label class="col-sm-2 col-form-label">URL</label>
				                        <div class="col-sm-6">
				                        	<input type="text" class="form-control" placeholder="Enter URL" name="url" value="{{ $row->url }}" required="">
				                        </div>
				                    </div>

				                    <div class="form-group row">
				                        <label class="col-sm-2 col-form-label">Position</label>
				                        <div class="col-sm-6">
				                        	<input type="number" class="form-control" placeholder="Enter Position" name="position" value="{{ $row->position }}" required="">
				                        </div>
				                    </div>

				                    <div class="form-group row">
				                        <label class="col-sm-2 col-form-label">Description</label>
				                        <div class="col-sm-6">
				                        	<textarea class="form-control" name="description" placeholder="Enter Description" required="">{{$row->description}}</textarea>
				                        </div>
				                    </div>
				                    <hr>
				                     <div class="form-group row">
				                        <label class="col-sm-2 col-form-label">Show In Header</label>
				                        <div class="col-sm-6">
			                        	    <select name="in_header" class="custom-select rounded-0" required="">
							                    <option value="1">Yes</option>
							                    <option value="0">No</option>
							                </select>
				                        </div>
				                    </div>

				                     <div class="form-group row">
				                        <label class="col-sm-2 col-form-label">Show In Footer</label>
				                        <div class="col-sm-6">
				                        	<select name="in_footer" class="custom-select rounded-0" required="">
							                    <option value="1">Yes</option>
							                    <option value="0">No</option>
							                </select>
				                        </div>
				                    </div>

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

				                    <div class="form-group row">
				                        <label class="col-sm-2 col-form-label">Meta Title</label>
				                        <div class="col-sm-6">
				                        	<input type="text" class="form-control" placeholder="Enter Meta Title" name="meta_title" value="{{ $row->meta_title }}">
				                        </div>
				                    </div>	

				                    <div class="form-group row">
				                        <label class="col-sm-2 col-form-label">Meta Description</label>
				                        <div class="col-sm-6">
				                        	<textarea class="form-control" name="meta_description" placeholder="Enter Description">{{$row->description}}</textarea>
				                        </div>
				                    </div>

				                    <div class="form-group row">
				                        <label class="col-sm-2 col-form-label">Meta Keywords</label>
				                        <div class="col-sm-6">
				                        	<textarea class="form-control" name="meta_keywords" placeholder="Enter Meta Keywords">{{$row->description}}</textarea>
				                        </div>
				                    </div>
				                    
				                    <hr>

				                    <div class="form-group row">
				                        <label class="col-sm-2 col-form-label">Parent Category</label>
				                        <div class="col-sm-10">
				                        	<ul id="myUL">
												 @foreach($categories as $key=>$category)
												 	 @include('admin.categories.sub_category_list',['category' => $category,'row',$row])
												 @endforeach
											</ul>
				                        </div>
				                    </div>

				                  	<div class="form-group text-right">
				                  		<div class="col-sm-12">
				                  			<a href="{{ URL('admin/categories') }}" class="btn btn-info" style="margin-right:05px;"> Cancel </a>
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
		  $('#category-form').validate({
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
	<script>
		var toggler = document.getElementsByClassName("caret");
		var i;

		for (i = 0; i < toggler.length; i++) {
		  toggler[i].addEventListener("click", function() {
		    this.parentElement.querySelector(".nested").classList.toggle("active");
		    this.classList.toggle("caret-down");
		  });
		}
	</script>
@endpush