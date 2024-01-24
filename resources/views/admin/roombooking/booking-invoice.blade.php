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
                    <h1 class="m-0">Booking Invoice</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ URL('admin/room-booking') }}">Rooms Booking</a></li>
                        <li class="breadcrumb-item active">Create  Booking</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="container">
  <div class="card">
<div class="card-header">
Invoice :
<strong>{{date('Y-m-d')}}</strong> 
  <span class="float-right"> <strong>Status:</strong> Complete</span>

</div>
<div class="card-body">
<div class="row mb-4">
<div class="col-sm-6">
<h6 class="mb-3">From:</h6>
<div>
<strong>Booking NO</strong>
</div>
<div>Customer Name</div>
<div>Mobile No</div>
<div>Addres</div>
<div>National Id</div>
</div>

<div class="col-sm-6">
<h6 class="mb-3">To:</h6>
<div>
<strong>{{$invoice?->booking_no}}</strong>
</div>
<div>{{$invoice?->name}}</div>
<div>{{$invoice?->mobile_no}}</div>
<div>{{$invoice?->address}}</div>
<div>{{$invoice?->nid}}</div>
</div>



</div>
@php
$start_date = new DateTime($invoice?->start_date);
$end_date = new DateTime($invoice?->end_date);
$interval = $start_date->diff($end_date);
$days = $interval->days;
$total_price = (float)$invoice?->price*$days;
@endphp
<div class="table-responsive-sm">
<table class="table table-striped">
<thead>
<tr>
<th class="center">#</th>
<th>Room No</th>
<th>Customer No</th>
<th class="right">Per Night</th>
<th class="center">start Date</th>
<th class="right">End Date</th>
</tr>
</thead>
<tbody>
<tr>
<td class="center">1</td>
<td class="left strong">{{$invoice?->room_number}}</td>
<td class="left">{{$invoice?->customer_number}}</td>

<td class="right">{{number_format((float)$invoice?->price, 2)}}</td>
  <td class="center">{{$invoice?->start_date}}</td>
<td class="right">{{$invoice?->end_date}}</td>
</tr>
</tbody>
</table>
</div>
<div class="row">
<div class="col-lg-4 col-sm-5">

</div>

<div class="col-lg-4 col-sm-5 ml-auto">
<table class="table table-clear">
<tbody>
<tr>
<td class="left">
<strong>Per Night</strong>
</td>
<td class="right">{{number_format((float)$invoice?->price, 2)}}</td>
</tr>
<tr>
<td class="left">
<strong>Days</strong>
</td>
<td class="right">{{$days}}</td>
</tr>
<tr>
<td class="left">
<strong>Total</strong>
</td>
<td class="right">
<strong>{{number_format((float)$total_price, 2)}}</strong>
</td>
</tr>
</tbody>
</table>

</div>

</div>

</div>
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
