@extends('layouts.app')

@section('title', 'Countries')

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
            <h1>Country List</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
              <li class="breadcrumb-item active">Country List</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row justify-content-center">
          <div class="col-8">
            {{-- Bogi add form --}}
            <div class="card shadow my-3">
              <div class="card-header">
                <h3 class="text-center m-0 font-weight-bold text-primary">Country @isset($country)
                    Update
                  @else
                    Add
                  @endisset Form</h3>
              </div>
              <div class="card-body">
                @if (isset($country))
                  {{-- edit part --}}
                  <form action="{{ route('countries.update', $country->id) }}" method="post">
                    @method('put')
                  @else
                    {{-- add part --}}
                    <form action="{{ route('countries.store') }}" method="post">
                @endif
                @csrf
                <div class="row d-flex justify-content-between align-items-end">
                  <div class="col-5">
                    <div class="form-group m-0">
                      <label for="_c_code"><strong>Country Code:</strong></label>
                      <input type="text" id="_c_code" name="country_code"
                        value="{{ isset($country) ? old('country_code', $country->country_code) : old('country_code') }}"
                        placeholder="Enter Country Code" class="form-control @error('country_code') is-invalid @enderror">

                      @error('country_code')
                        <span class="invalid-feedback" role="alert">
                          <strong>{{ $message }}</strong>
                        </span>
                      @enderror
                    </div>
                  </div>
                  <div class="col-5">
                    <div class="form-group m-0">
                      <label for="_c_name"><strong>Country Name:</strong></label>
                      <input type="text" id="_c_name"
                        value="{{ isset($country) ? old('name', $country->name) : old('name') }}" name="name"
                        placeholder="Ex. Bangladesh, India etc." class="form-control @error('name') is-invalid @enderror">

                      @error('name')
                        <span class="invalid-feedback" role="alert">
                          <strong>{{ $message }}</strong>
                        </span>
                      @enderror
                    </div>
                  </div>

                  <div class="col-2">
                    <input type="submit"
                      value="@isset($country) Update Country @else Add Country @endisset"
                      class="btn btn-success">
                  </div>
                </div>
                </form>
              </div>
            </div>

            {{-- Bogi list --}}
            <div class="card shadow mb-4">
              <div class="card-header py-3">
                <h5 class="m-0 font-weight-bold text-primary">Country List</h5>

              </div>
              <div class="card-body">
                <div class="table-responsive">
                  <table id="example1" class="table table-bordered table-striped text-center">
                    <thead>
                      <tr>
                        <th>Country Code</th>
                        <th>Country Name</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      @foreach ($countries as $item)
                        <tr>
                          <td>{{ $item->country_code }}</td>

                          <td>{{ $item->name }}</td>
                          <td>
                            <div class="dropdown">
                              <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Action
                              </button>
                              <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                <a class="dropdown-item" href="{{ route('countries.edit', $item->id) }}"><i
                                    class="fa fa-pen text-warning"></i> Edit</a>

                                <form action="{{ route('countries.destroy', $item->id) }}"
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
                        <th>Country Code</th>
                        <th>Country Name</th>
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
