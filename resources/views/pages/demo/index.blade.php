@extends('layouts.app')

@section('title', 'Index');

@push('styles')
  <!-- DataTables -->
  <link rel="stylesheet" href="/assets/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="/assets/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <link rel="stylesheet" href="/assets/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="/assets/dist/css/adminlte.min.css">
@endpush

@push('scripts')
  <!-- DataTables  & Plugins -->
  <script src="/assets/plugins/datatables/jquery.dataTables.min.js"></script>
  <script src="/assets/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
  <script src="/assets/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
  <script src="/assets/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
  <script src="/assets/plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
  <script src="/assets/plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
  <script src="/assets/plugins/jszip/jszip.min.js"></script>
  <script src="/assets/plugins/pdfmake/pdfmake.min.js"></script>
  <script src="/assets/plugins/pdfmake/vfs_fonts.js"></script>
  <script src="/assets/plugins/datatables-buttons/js/buttons.html5.min.js"></script>
  <script src="/assets/plugins/datatables-buttons/js/buttons.print.min.js"></script>
  <script src="/assets/plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
  <!-- AdminLTE App -->
  <script src="/assets/dist/js/adminlte.min.js"></script>

  <!-- Page specific script -->
  <script>
    $(function() {
      $("#example1").DataTable({
        "responsive": true,
        "lengthChange": false,
        "autoWidth": false,
        'order': [],
        "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
      }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
    });
  </script>
  <!-- AdminLTE App -->
  <script src="/assets/dist/js/adminlte.js"></script>
@endpush

@section('content')
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Attendance List</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
              <li class="breadcrumb-item active">Attendance List</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Attendance list</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped text-center">
                  <thead>
                    <tr>
                      <th>Date</th>
                      <th>Entry Time (09:00 am)</th>
                      <th>Exit Time (05:00 pm)</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($attendances as $item)
                      <tr>
                        <td>dddd</td>

                        <td></td>
                        {{-- check early leave --}}
                        <td></td>
                        <td>
                          <div class="dropdown">
                            <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton"
                              data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                              Action
                            </button>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">

                              <a class="dropdown-item" href="{{ route('employees.show', $item->id) }}"><i
                                  class="fa fa-eye text-primary"></i> View</a>
                              <a class="dropdown-item" href="{{ route('employees.edit', $item->id) }}"><i
                                  class="fa fa-pen text-warning"></i> Edit</a>

                              <form action="{{ route('employees.destroy', $item->id) }}"
                                onsubmit="return confirm('Are you want to sure to delete?')" method="post">
                                @csrf
                                @method('delete')
                                <button class="dropdown-item"><i class="fa fa-trash text-danger"></i> Delete</button>
                              </form>

                            </div>
                          </div>
                        </td>
                      </tr>
                    @endforeach
                  </tbody>
                  <tfoot>
                    <tr>
                      <th>Date</th>
                      <th>Entry Time (09:00 am)</th>
                      <th>Exit Time (05:00 pm)</th>
                      <th>Action</th>
                    </tr>
                  </tfoot>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
@endsection
