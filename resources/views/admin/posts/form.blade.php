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
		        <h1 class="m-0">Create Post</h1>
		      </div><!-- /.col -->
		      <div class="col-sm-6">
		        <ol class="breadcrumb float-sm-right">
		          <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
		          <li class="breadcrumb-item"><a href="{{ URL('admin/posts') }}">Posts</a></li>
		          <li class="breadcrumb-item active">Create Post</li>
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
			                <h3 class="card-title">Post Form</h3>
			              </div>
			              <!-- /.card-header -->
			              <div class="card-body">
			                <form id="post-form" class="form-horizontal label-left" action="{{ URL('admin/posts') }}" enctype="multipart/form-data" method="POST"> 
			                	{!! csrf_field() !!}
			                	<input type="hidden" name="action" value="{{$action}}">
			                	<input type="hidden" name="id" value="{{ isset($id) ? $id : '' }}">
			                	<div class="card-body">
			                			
		                			@if(isset($row->featureImage->image) && $action=='edit')
		                    			@php $fImage = asset('feature-images/'.$id.'/'.$row->featureImage->image); @endphp
		                    		@else
		                    			@php $fImage = '#'; @endphp
		                    		@endif

			                		<div class="form-group row">
				                        <label class="col-sm-2 col-form-label">Feature Image</label>
				                        <div class="col-sm-6">
				                        	<input type="file" class="form-control" name="feature_image" value="{{ $row->feature_image }}" {{ ($fImage == "#") ? 'required=""' : '' }} onchange="readURL(this)">
				                        </div>
				                    </div>

				                    <div class="form-group row">
				                    	<label class="col-sm-2 col-form-label"></label>
				                    	<div class="col-sm-6">
				                        	<img id="feature-image" src="{{$fImage}}" alt="your image" style="width: 100%;height: 100%;{{ ($fImage == '#') ? 'display: none;':''  }}" />
				                        </div>
				                    </div>

				                    @if(isset($row->themeImage->image) && $action=='edit')
		                    			@php $tImage = asset('theme-images/'.$id.'/'.$row->themeImage->image); @endphp
		                    		@else
		                    			@php $tImage = '#'; @endphp
		                    		@endif

			                		<div class="form-group row">
				                        <label class="col-sm-2 col-form-label">Theme Image</label>
				                        <div class="col-sm-6">
				                        	<input type="file" class="form-control" name="theme_image" value="{{ $row->theme_image }}" {{ ($tImage == "#") ? 'required=""' : '' }} onchange="readURL2(this)">
				                        </div>
				                    </div>

				                    <div class="form-group row">
				                    	<label class="col-sm-2 col-form-label"></label>
				                    	<div class="col-sm-6">
				                        	<img id="theme-image" src="{{$tImage}}" alt="your image" style="width: 100%;height: 100%;{{ ($tImage == '#') ? 'display: none;':''  }}" />
				                        </div>
				                    </div>


				                    <div class="form-group row">
				                        <label class="col-sm-2 col-form-label">Title</label>
				                        <div class="col-sm-6">
				                        	<input type="text" class="form-control" placeholder="Enter Title" name="title" value="{{ $row->title }}" required="">
				                        </div>
				                    </div>

				                    <div class="form-group row">
				                        <label class="col-sm-2 col-form-label">URL</label>
				                        <div class="col-sm-6">
				                        	<input type="text" class="form-control" placeholder="Enter URL" name="url" value="{{ $row->url }}" required="">
				                        </div>
				                    </div>

				                
				                    <div class="form-group row">
				                        <label class="col-sm-2 col-form-label">Short Description</label>
				                        <div class="col-sm-6">
				                        	<textarea class="form-control" name="short_description" placeholder="Enter Short Description" required="">{{$row->short_description}}</textarea>
				                        </div>
				                    </div>

				                    <div class="form-group row">
				                        <label class="col-sm-2 col-form-label">Content</label>
				                        <div class="col-sm-6">
				                        	<textarea id="summernote" name="description">{{$row->description}}</textarea>
				                        </div>
				                    </div>

				                    <div class="form-group row">
				                        <label class="col-sm-2 col-form-label">Slider Post</label>
				                        <div class="col-sm-6">
				                        	<select name="slider_post" class="custom-select rounded-0" required="">
							                    <option value="1" {{ ($row->slider_post == 1) ? 'selected':''}}>Yes</option>
							                    <option value="0" {{ ($row->slider_post == 0) ? 'selected':''}}>No</option>
							                </select>
				                        </div>
				                    </div>

				                    <div class="form-group row">
				                        <label class="col-sm-2 col-form-label">Feature Post</label>
				                        <div class="col-sm-6">
				                        	<select name="feature" class="custom-select rounded-0" required="">
							                    <option value="1" {{ ($row->feature == 1) ? 'selected':''}}>Yes</option>
							                    <option value="0" {{ ($row->feature == 0) ? 'selected':''}}>No</option>
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

				                    <hr>

			                    	<div class="form-group row">
			                        	<label class="col-sm-2 col-form-label">Tags</label>
			                        	<div class="col-sm-6">
			                        		<select class="select2bs4 form-control" multiple="" name="tags[]">
						                      @foreach($tags as $tag)
						                      	@php 
						                      		$selected = '';
						                      		if( $action == 'edit' && $row->tags->contains('id',$tag->id) )
						                      		{
						                      			$selected = 'selected';
						                      		}
						                      	@endphp
						                      	<option value="{{$tag->id}}" {{$selected}}>{{$tag->name}}</option>
						                      @endforeach
						                    </select>
			                        	</div>
				                    </div>

			                    	<div class="form-group row">
				                        <label class="col-sm-2 col-form-label">Category</label>
				                        <div class="col-sm-10">
				                        	<ul id="myUL">
												 @foreach($categories as $key=>$category)
												 	 @include('admin.posts.sub_category_list',['category' => $category,'row',$row])
												 @endforeach
											</ul>
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
	<!-- Select2 -->
	<script src="{{asset('assets/admin/select2/js/select2.full.min.js')}}"></script>
	<!-- Page specific script -->
	<script>
	  $(function () {
		  	// Summernote
		  	$('.select2bs4').select2({
		      theme: 'bootstrap4'
		    })
	    	$('#summernote').summernote({
	    		height: ($(window).height() - 300),
			    callbacks: {
			        onImageUpload: function(image) {
			            uploadImage(image[0]);
			        }
			    }
	    	})

		  	$('#post-form').validate({
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
		        url: "{{ route('admin.posts.uploadimage') }}",
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
		 function readURL(input) 
		 {
		  if (input.files && input.files[0]) 
		  {
		  	console.log(input.files[0]);
		    var reader = new FileReader();
		    reader.onload = function (e) 
		    {
			    $('#feature-image').css('display','block');
	 		    $('#feature-image').attr('src', e.target.result);
		    };
		    reader.readAsDataURL(input.files[0]);
		  }
		}
		function readURL2(input) 
		 {
		  if (input.files && input.files[0]) 
		  {
		  	console.log(input.files[0]);
		    var reader = new FileReader();
		    reader.onload = function (e) 
		    {
			    $('#theme-image').css('display','block');
	 		    $('#theme-image').attr('src', e.target.result);
		    };
		    reader.readAsDataURL(input.files[0]);
		  }
		}
	</script>
@endpush