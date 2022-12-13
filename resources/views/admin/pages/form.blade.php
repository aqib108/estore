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
@endpush

@section('content')
	<!-- Content Wrapper. Contains page content -->
	<div class="content-wrapper">
		<!-- Content Header (Page header) -->
		<div class="content-header">
		  <div class="container-fluid">
		    <div class="row mb-2">
		      <div class="col-sm-6">
		        <h1 class="m-0">Create Page</h1>
		      </div><!-- /.col -->
		      <div class="col-sm-6">
		        <ol class="breadcrumb float-sm-right">
		          <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
		          <li class="breadcrumb-item"><a href="{{ URL('admin/pages') }}">Pages</a></li>
		          <li class="breadcrumb-item active">Create Page</li>
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
			                <h3 class="card-title">Page Form</h3>
			              </div>
						  @php
							$title = [];
							$author_name = [];
							$location = [];
							$content = []; 
							if(!empty($row)){
								$title = (array)json_decode($row->title);
								$short_description = (array)json_decode($row->short_description);
								$description = (array)json_decode($row->description);
							}
							@endphp
			              <!-- /.card-header -->
			              <div class="card-body">
			                <form id="page-form" class="form-horizontal label-left" action="{{ URL('admin/pages') }}" enctype="multipart/form-data" method="POST"> 
			                	{!! csrf_field() !!}
			                	<input type="hidden" name="action" value="{{$action}}">
			                	<input type="hidden" name="id" value="{{ isset($id) ? $id : '' }}">
			                	<div class="card-body">
									@foreach(getLanguages() as $lang)
										<div class="form-group row">
											<label class="col-sm-2 col-form-label">Title ({{ $lang->name }})</label>
											<div class="col-sm-6">
												<input type="text" class="form-control" placeholder="Enter Title in {{ $lang->name }}" name="title[{{ $lang->short_name }}]" value="{{ isset($title[$lang->short_name]) ? $title[$lang->short_name] : '' }}" required="">
											</div>
										</div>
									@endforeach

				                    <div class="form-group row">
				                        <label class="col-sm-2 col-form-label">URL</label>
				                        <div class="col-sm-6">
				                        	<input type="text" class="form-control" placeholder="Enter URL" name="url" value="{{ $row->url }}" required="">
				                        </div>
				                    </div>

									@foreach(getLanguages() as $lang)
										<div class="form-group row">
											<label class="col-sm-2 col-form-label">Short Description ({{ $lang->name }})</label>
											<div class="col-sm-6">
												<textarea class="form-control" name="short_description[{{ $lang->short_name }}]" placeholder="Enter Short Description in {{ $lang->name }}" required="">{{ isset($short_description[$lang->short_name]) ? $short_description[$lang->short_name] : '' }}</textarea>
											</div>
										</div>
									@endforeach
									@foreach(getLanguages() as $lang)
										<div class="form-group row">
											<label class="col-sm-2 col-form-label">Content ({{ $lang->name }})</label>
											<div class="col-sm-6">
												<textarea id="summernote" name="description[{{ $lang->short_name }}]">{{ isset($description[$lang->short_name]) ? $description[$lang->short_name] : '' }}</textarea>
											</div>
										</div>
									@endforeach
				                    <div class="form-group row">
				                        <label class="col-sm-2 col-form-label">Show In Header</label>
				                        <div class="col-sm-6">
			                        	    <select name="in_header" class="custom-select rounded-0" required="">
							                    <option value="1" {{($row->in_header==1)?'selected':''}} >Yes</option>
							                    <option value="0" {{($row->in_header==0)?'selected':''}}>No</option>
							                </select>
				                        </div>
				                    </div>

				                     <div class="form-group row">
				                        <label class="col-sm-2 col-form-label">Show In Footer</label>
				                        <div class="col-sm-6">
				                        	<select name="in_footer" class="custom-select rounded-0" required="">
							                    <option value="1" {{($row->in_footer==1)?'selected':''}}>Yes</option>
							                    <option value="0" {{($row->in_footer==0)?'selected':''}}>No</option>
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
				                        	<textarea class="form-control" name="meta_description" placeholder="Enter Description">{{$row->meta_description}}</textarea>
				                        </div>
				                    </div>

				                    <div class="form-group row">
				                        <label class="col-sm-2 col-form-label">Meta Keywords</label>
				                        <div class="col-sm-6">
				                        	<textarea class="form-control" name="meta_keywords" placeholder="Enter Meta Keywords">{{$row->meta_keywords}}</textarea>
				                        </div>
				                    </div>
				                    

				                  	<div class="form-group text-right">
				                  		<div class="col-sm-12">
				                  			<a href="{{ URL('admin/pages') }}" class="btn btn-info" style="margin-right:05px;"> Cancel </a>
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
	<!-- Page specific script -->
	<script>
	  $(function () {
		  	// Summernote
			  $("textarea[id^='summernote']").summernote({
	    		height: ($(window).height() - 300),
			    callbacks: {
			        onImageUpload: function(image) {
			            uploadImage(image[0]);
			        }
			    }
	    	})

		  	$('#page-form').validate({
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
		$.ajaxSetup({
		    headers: {
		        'X-CSRF-TOKEN': $('input[name="_token"]').val()
		    }
		});

		var toggler = document.getElementsByClassName("caret");
		var i;

		for (i = 0; i < toggler.length; i++) {
		  toggler[i].addEventListener("click", function() {
		    this.parentElement.querySelector(".nested").classList.toggle("active");
		    this.classList.toggle("caret-down");
		  });
		}

		function uploadImage(image) 
		{
			var data = new FormData();
		    data.append("image", image);
		    $.ajax({
		        url: "{{ route('admin.pages.uploadimage') }}",
		        cache: false,
		        contentType: false,
		        processData: false,
		        data: data,
		        type: "post",
		        success: function(url) {
		            var image = $('<img>').attr('src', url);
		            $('#summernote').summernote("insertNode", image[0]);
		        },
		        error: function(data) {
		        }
		    });
		 }
	</script>
@endpush