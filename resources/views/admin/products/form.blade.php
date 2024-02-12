@extends('admin.layout.app')

<style>
    input[type="file"] {
        display: block;
    }

    .imageThumb {
        max-height: 75px;
        border: 2px solid;
        padding: 1px;
        cursor: pointer;
    }

    .pip {
        display: inline-block;
        margin: 10px 10px 0 0;
    }

    .remove {
        display: block;
        background: #444;
        border: 1px solid black;
        color: white;
        text-align: center;
        cursor: pointer;
    }

    .remove:hover {
        background: white;
        color: black;
    }

</style>

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
<link rel="stylesheet" href="{{asset('assets/admin/dropify/dist/css/dropify.min.css')}}">
@endpush

@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Create Product</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ URL('admin/products') }}">Products</a></li>
                        <li class="breadcrumb-item active">Create Product</li>
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
                            <h3 class="card-title">Product Form</h3>
                        </div>

                        <!-- /.card-header -->
                        <div class="card-body">
                            <form id="announcement-form" class="form-horizontal label-left" action="{{ URL('admin/products') }}" enctype="multipart/form-data" method="POST">
                                {!! csrf_field() !!}

                                <input type="hidden" name="action" value="{{$action}}">
                                <input type="hidden" name="id" value="{{ isset($id) ? $id : '' }}">
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">Category <span class="text-red">*</span></label>
                                    <div class="col-sm-6">
                                        <select name="category_id" class="custom-select rounded-0" required="">
                                            <option value="">--Select Category--</option>
                                            @foreach($categories as $category)
                                            <option value="{{ $category->id }}" {{($row->category_id==$category->id)?'selected':''}}>{{ $category->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">Product title <span class="text-red">*</span></label>
                                    <div class="col-sm-6">
                                        <input type="text" class="form-control" placeholder="Enter Name" name="title" value="{{$row->title}}" required="">
                                    </div>
                                </div>


                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">Product Description</label>
                                    <div class="col-sm-6">
                                        <textarea id="summernote" name="description">{{isset($row->description) ? $row->description : '' }}</textarea>
                                    </div>
                                </div>


                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">Price <span class="text-red">*</span></label>
                                    <div class="col-sm-6">
                                        <input type="number" class="form-control" placeholder="Enter Price" name="price" value="{{ $row->price }}" required="">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">Tax <span class="text-red">*</span></label>
                                    <div class="col-sm-6">
                                        <input type="number" class="form-control" placeholder="Enter Tax value" name="tax" value="{{ $row->tax }}" required="">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">Discount <span class="text-red">*</span></label>
                                    <div class="col-sm-6">
                                        <input type="number" class="form-control" placeholder="Enter Discount value" name="discount" value="{{ $row->tax }}" required="">
                                    </div>
                                </div>
 <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">Embed YouTube Vedio Url</label>
                                    <div class="col-sm-6">
                                        <input type="text" class="form-control" placeholder="Enter Youtube Embed Url" name="embed_url" value="{{ $row->embed_url }}" >
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
                                <div class="row">
                                    <div class="col-sm-7">
                                        @if(!empty($product_images))
                                        @foreach($product_images as $key=>$val)
                                        <div class="mt-2 mb-2 img_div" id="img_div_{{$loop->iteration}}">
                                            <img class="imageThumb" src="{{asset($val->file_name)}}" title="${f.name}" />
                                            <input type="hidden" name="old_image_id[]" value="{{$val->id}}" />
                                            <button id="" type="button" onclick="delete_imag('img_div_{{$loop->iteration}}')" style="height:40px" class="btn btn-danger ml-2" style="width: 2%">Remove</button>
                                            <i class="fas fa-arrows-h"></i>
                                        </div>

                                        @endforeach
                                        @endif
                                        <div id="newRow"></div>
                                        <button id="addRow" type="button" class="btn btn-primary">Add Product Image</button>
                                    </div>
                                </div>
                                <hr>
                                <div class="card-body">
                                    <div class="form-group text-right">
                                        <div class="col-sm-12">
                                            <a href="{{ URL('admin/products') }}" class="btn btn-info" style="margin-right:05px;"> Cancel </a>
                                            <button type="submit" class="btn btn-primary float-right"> {{ ($action == 'add') ? 'Save' : 'Update' }} </button>
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
<script src="{{asset('assets/admin/dropify/dist/js/dropify.min.js')}}"></script>
<!-- Page specific script -->
<script>
    $('textarea').summernote({
        height: ($(window).height() - 100)
        , callbacks: {
            onImageUpload: function(image) {
                uploadImage(image[0]);
            }
        }
    })
    $(function() {
        $('.dropify').dropify();

        $('#announcement-form').validate({
            ignore: false
            , rules: {}
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
            , invalidHandler: function(e, validator) {
                // loop through the errors:
                for (var i = 0; i < validator.errorList.length; i++) {
                    // "uncollapse" section containing invalid input/s:
                    $(validator.errorList[i].element).closest('.collapse').collapse('show');
                }
            }
        });
    });

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('input[name="_token"]').val()
        }
    });
    // imageinpt.onchange = evt => {
    //   const [file] = imageinpt.files
    //     console.log(file);
    //   if (file) {
    //     sample_image.src = URL.createObjectURL(file)
    //     $('#sample_image').parent().attr('href',URL.createObjectURL(file));
    //   }
    // }
    $('#clear_image').click(function() {
        event.preventDefault();
        $('#imageinpt').val('');
        $('#sample_image').parent().attr('href', 'https://www.freeiconspng.com/uploads/no-image-icon-6.png');
        $('#sample_image').attr('src', 'https://www.freeiconspng.com/uploads/no-image-icon-6.png');
    });

    $("#addRow").click(function() {
        var html = '';
        html += '<div id="inputFormRow">';
        html += '<div class="input-group" style="margin-bottom: 2%">';
        html += '<input id="files" type="file" name="image[]" class="form-control m-input multiImage">';
        html += '<div class="input-group-append">';
        html += '<button id="removeRow" type="button" style="height:40px" class="btn btn-danger dynamic_files">Remove</button>';
        html += '</div>';
        html += '</div>';

        $('#newRow').append(html);
    });

    $(document).on('click', '#removeRow', function() {
        $(this).closest('#inputFormRow').remove();
    });


    $("body").on("change", '.multiImage', function(e) {

        var files = e.target.files
            , filesLength = files.length;
        for (var i = 0; i < filesLength; i++) {
            var f = files[i]
            var fileReader = new FileReader();
            fileReader.onload = (function(e) {
                var file = e.target;
                $(`<div class="bar" style="margin-left:50px">
                        <div><img class="imageThumb" src="${e.target.result}" title="${f.name}"/></div>
                        <br/>
                        `).insertAfter($('.dynamic_files:last'));

            });
            fileReader.readAsDataURL(f);
        }
    });

    function delete_imag(id) {
        $('#' + id).remove();
    }

    file_input.onchange = evt => {
        const [file] = file_input.files
        console.log(file);
        if (file) {
            sample_file.src = URL.createObjectURL(file)
            $('#sample_file').parent().attr('href', URL.createObjectURL(file));
            $('#download_div').show();
        }
    }

</script>
@endpush
