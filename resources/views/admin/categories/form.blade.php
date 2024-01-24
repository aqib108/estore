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
                            <form id="department-form" action="{{ URL('admin/categories') }}" enctype="multipart/form-data" method="POST">
                                {!! csrf_field() !!}
                                <input type="hidden" name="action" value="{{$action}}">
                                <input type="hidden" name="id" value="{{ isset($id) ? $id : '' }}">
                                
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label"> Category Name</label>
                                    <div class="col-sm-6">
                                        <input type="text" class="form-control" placeholder="Enter Category Name" name="name" value="{{ isset($row->name) ? $row->name : '' }}">
                                    </div>
                                </div>
                                 

                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">Category Description</label>
                                    <div class="col-sm-6">
                                        <textarea id="summernote" name="description" >{{isset($row->description) ? $row->description : '' }}</textarea>
                                    </div>
                                </div>
                                
                                <div class="form-group row d-none">
                                    <label class="col-sm-2 col-form-label">Image</label>
                                    <div class="col-sm-6">
                                        <input class="form-control" type="file" name="image"></textarea>
                                    </div>
                                </div>
                                @if(isset($row->images) && $action=='edit')
                                @php $tImage = asset('room-images/'.$row->images); @endphp
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">Image</label>
                                    <div class="col-sm-6">
                                        <img src="{{ $tImage }}" />
                                    </div>
                                </div>
                                @endif

                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">Status</label>
                                    <div class="col-sm-6">
                                        <div class="icheck-primary d-inline">
                                            Active
                                            <input type="radio" name="status" id="active-radio-status" value="1" checked {{ ($row->status==1) ? 'checked' : '' }}>
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
                                <div class="form-group text-right">
                                    <div class="col-sm-12">
                                        <a href="{{ URL('admin/categories') }}" class="btn btn-info mr-2"> Cancel </a>
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
<!-- SummerNote -->
<script src="{{asset('assets/admin/summernote/summernote-bs4.min.js')}}"></script>
<!-- Page specific script -->
<script>
    $(function() {

        $('#department-form').validate({
            rules: {}
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
    $('textarea').summernote({
        height: ($(window).height() - 300)
        , callbacks: {
            onImageUpload: function(image) {
                uploadImage(image[0]);
            }
        }
    })

</script>
@endpush
