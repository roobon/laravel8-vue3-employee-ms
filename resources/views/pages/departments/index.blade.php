@extends('layouts.app')

@section('title', 'Departments')

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
            <h1>Department List</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
              <li class="breadcrumb-item active">Department List</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row justify-content-center">
          <div class="col-6">
            {{-- Bogi add form --}}
            <div class="card shadow my-3">
              <div class="card-header">
                <h3 class="text-center m-0 font-weight-bold text-primary">Department @isset($department)
                    Update
                  @else
                    Add
                  @endisset Form</h3>
              </div>
              <div class="card-body">
                @if (isset($department))
                  {{-- edit part --}}
                  <form action="{{ route('departments.update', $department->id) }}" method="post">
                    @method('put')
                  @else
                    {{-- add part --}}
                    <form action="{{ route('departments.store') }}" method="post">
                @endif
                @csrf
                <div class="row d-flex justify-content-between align-items-end">
                 
                  <div class="col-7">
                    <div class="form-group m-0">
                      <label for="_d_name"><strong>Department Name:</strong></label>
                      <input type="text" id="_d_name"
                        value="{{ isset($department) ? old('name', $department->name) : old('name') }}" name="name"
                        placeholder="Ex. Database, Backend etc." class="form-control @error('name') is-invalid @enderror">

                      @error('name')
                        <span class="invalid-feedback" role="alert">
                          <strong>{{ $message }}</strong>
                        </span>
                      @enderror
                    </div>
                  </div>

                  <div class="col-5">
                    <input type="submit"
                      value="@isset($department) Update Department @else Add Department @endisset"
                      class="btn btn-success">
                  </div>
                </div>
                </form>
              </div>
            </div>

            {{-- Bogi list --}}
            <div class="card shadow mb-4">
              <div class="card-header py-3">
                <h5 class="m-0 font-weight-bold text-primary">Department List</h5>

              </div>
              <div class="card-body">
                <div class="table-responsive">
                  <table id="example1" class="table table-bordered table-striped text-center">
                    <thead>
                      <tr>
                        <th>Department Name</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      @foreach ($departments as $item)
                        <tr>
                          <td>{{ $item->name }}</td>
                          <td>
                            <div class="dropdown">
                              <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Action
                              </button>
                              <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                <a class="dropdown-item" href="{{ route('departments.edit', $item->id) }}"><i
                                    class="fa fa-pen text-warning"></i> Edit</a>

                                <form action="{{ route('departments.destroy', $item->id) }}"
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
                        <th>Departments Name</th>
                        <th>Action</th>
                      </tr>
                    </tfoot>
                  </table>
                </div>
              </div>
            </div>
          </div>
        </div>


      </div>
      <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>

@endsection
