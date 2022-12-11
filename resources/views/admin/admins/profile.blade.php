@extends('admin.layout.app')

@push('header-scripts')
   <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{asset('assets/admin/fontawesome-free/css/all.min.css')}}">
  <!-- DataTables -->
  <link rel="stylesheet" href="{{asset('assets/admin/datatables-bs4/css/dataTables.bootstrap4.min.css')}}">
  <link rel="stylesheet" href="{{asset('assets/admin/datatables-responsive/css/responsive.bootstrap4.min.css')}}">
  <link rel="stylesheet" href="{{asset('assets/admin/datatables-buttons/css/buttons.bootstrap4.min.css')}}">
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
            <h1 class="m-0">Admin Users</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
              <li class="breadcrumb-item active">Profile</li>
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
              <div class="col-md-3">

                <div class="card card-primary card-outline">
                  <div class="card-body box-profile">
                    <div class="text-center">
                      <img class="profile-user-img img-fluid img-circle"
                           src="{{ asset('assets/admin/dist/img/user2-160x160.jpg') }}"
                           alt="User profile picture">
                    </div>
                    <h3 class="profile-username text-center">{{ $first_name . ' ' . $last_name  }}</h3>
                    <p class="text-muted text-center">{{ Auth::user()->role->name }}</p>
                  </div>
                </div>

              </div>
              <!-- /.col -->
              <div class="col-md-9">
                <div class="card">
                  <div class="card-header p-2">
                    <ul class="nav nav-pills">
                      <li class="nav-item"><a class="nav-link active" href="#settings" data-toggle="tab">Settings</a></li>
                    </ul>
                  </div><!-- /.card-header -->
                  <div class="card-body">
                    <div class="tab-content">

                      <div class="tab-pane active" id="settings">
                        <form class="form-horizontal" action="{{ URL('admin/profile') }}" method="POST">
                           {!! csrf_field() !!}
                          <div class="form-group row">
                            <label for="inputName" class="col-sm-2 col-form-label">First Name</label>
                            <div class="col-sm-10">
                              <input type="text" class="form-control" id="first_name" placeholder="First Name" name="first_name" value="{{ $first_name }}">
                            </div>
                          </div>
                          <div class="form-group row">
                            <label for="inputEmail" class="col-sm-2 col-form-label">Last Name</label>
                            <div class="col-sm-10">
                              <input type="text" class="form-control" id="last_name" placeholder="Last Name" name="last_name" value="{{ $last_name }}">
                            </div>
                          </div>
                          <div class="form-group row">
                            <label for="inputName2" class="col-sm-2 col-form-label">Email</label>
                            <div class="col-sm-10">
                              <input type="email" class="form-control" id="email" placeholder="Email" name="email" value="{{ $email }}" readonly>
                            </div>
                          </div>
                        
                          <div class="form-group row">
                            <div class="offset-sm-2 col-sm-10">
                              <button type="submit" class="btn btn-primary">Update</button>
                            </div>
                          </div>
                        </form>
                      </div>
                      <!-- /.tab-pane -->
                    </div>
                    <!-- /.tab-content -->
                  </div><!-- /.card-body -->
                </div>
                <!-- /.card -->
              </div>
              <!-- /.col -->
            </div>
            <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
  </div>

@endsection

@push('footer-scripts')
  <!-- jQuery -->
  <script src="{{asset('assets/admin/jquery/jquery.min.js')}}"></script>
  <!-- Bootstrap 4 -->
  <script src="{{asset('assets/admin/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
  <!-- DataTables  & Plugins -->
  <script src="{{asset('assets/admin/datatables/jquery.dataTables.min.js')}}"></script>
  <script src="{{asset('assets/admin/datatables-bs4/js/dataTables.bootstrap4.min.js')}}"></script>
  <script src="{{asset('assets/admin/datatables-responsive/js/dataTables.responsive.min.js')}}"></script>
  <script src="{{asset('assets/admin/datatables-responsive/js/responsive.bootstrap4.min.js')}}"></script>
  <script src="{{asset('assets/admin/datatables-buttons/js/dataTables.buttons.min.js')}}"></script>
  <script src="{{asset('assets/admin/datatables-buttons/js/buttons.bootstrap4.min.js')}}"></script>
  <script src="{{asset('assets/admin/jszip/jszip.min.js')}}"></script>
  <script src="{{asset('assets/admin/pdfmake/pdfmake.min.js')}}"></script>
  <script src="{{asset('assets/admin/pdfmake/vfs_fonts.js')}}"></script>
  <script src="{{asset('assets/admin/datatables-buttons/js/buttons.html5.min.js')}}"></script>
  <script src="{{asset('assets/admin/datatables-buttons/js/buttons.print.min.js')}}"></script>
  <script src="{{asset('assets/admin/datatables-buttons/js/buttons.colVis.min.js')}}"></script>
  <!-- AdminLTE App -->
  <script src="{{asset('assets/admin/dist/js/adminlte.min.js')}}"></script>
  <!-- AdminLTE for demo purposes -->
  <script src="{{asset('assets/admin/dist/js/demo.js')}}"></script>
  <!-- Page specific script -->
  <script>
    $(function () {
      $('#admins-datatable').dataTable(
        {
          sort: false,
      pageLength: 50,
      scrollX: true,
      processing: false,
      language: { "processing": showOverlayLoader()},
      drawCallback : function( ) {
            hideOverlayLoader();
        },
      responsive: true,
      // dom: 'Bfrtip',
      lengthMenu: [[5, 10, 25, 50, 100, 200, -1], [5, 10, 25, 50, 100, 200, "All"]],
      serverSide: true,
      ajax: "{{ url('admin/admins') }}",
      columns: [
        {data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false},
        {data: 'role', name: 'role'},
        {data: 'name', name: 'name'},
        {data: 'email', name: 'email'},
        {data: 'dob', name: 'dob'},
        {data: 'status', name: 'status'},
        {data: 'action', name: 'action', orderable: false, searchable: false},
      ]
      }).on( 'length.dt', function () {
    }).on('page.dt', function () {
      }).on( 'order.dt', function () {
    }).on( 'search.dt', function () {
    });
    });
    function showOverlayLoader()
    {
    }
  </script>
@endpush