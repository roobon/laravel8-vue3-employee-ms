@extends('layouts.app')

@push('styles')
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="/assets/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="/assets/dist/css/adminlte.min.css">

  <style>
    .fieldset {
      border: 1px solid #6c757d;
      border-radius: 5px;
      padding: 10px;
    }

    .fieldset legend {
      width: fit-content
    }

    .contact-body {
      position: relative;
    }

    .add-more-btn {
      position: absolute;
      top: -17px;
      right: 10px;
    }

    .contact {
      position: relative;
    }

    .contact .remove-btn {
      position: absolute;
      top: -17px;
      right: 7px;
      cursor: pointer;
    }

    .invalid-feedback {
      display: block
    }
  </style>
@endpush

@push('scripts')
  <!-- overlayScrollbars -->
  <script src="/assets/plugins/bs-custom-file-input/bs-custom-file-input.min.js"></script>
  <!-- AdminLTE App -->
  <script src="/assets/dist/js/adminlte.js"></script>
  <script>
    $(function() {
      bsCustomFileInput.init();
    });
  </script>
@endpush

@section('title', 'Add Employee')

@section('content')
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Add Employee</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">Home</a></li>
              <li class="breadcrumb-item"><a href="{{ route('employees.index') }}">Employees</a></li>
              <li class="breadcrumb-item active">Add Employee</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row justify-content-center">
          <div class="col-sm-12 col-md-6">
            <form action="{{ route('employees.store') }}" method="post" enctype="multipart/form-data">
              @csrf

              <div class="card card-info">
                <div class="card-header">
                  <h3 class="card-title">Employee Information</h3>
                </div>
                <div class="card-body">
                  <fieldset class="fieldset">
                    <legend><strong>Employee Info</strong></legend>

                    {{-- Name --}}
                    <div class="form-group">
                      <label for="_name"><strong>Employee Fullname</strong></label>
                      <div class="input-group mb-3">
                        <input type="text" name="name" id="_name"
                          class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}"
                          placeholder="Full Name">
                      </div>

                      @error('name')
                        <span class="invalid-feedback" role="alert">
                          <strong>{{ $message }}</strong>
                        </span>
                      @enderror
                    </div>

                    {{-- Email --}}
                    <div class="form-group">
                      <label for="_email"><strong>Email</strong></label>
                      <div class="input-group mb-3">
                        <input type="email" name="email" id="_email"
                          class="form-control  @error('email') is-invalid @enderror" value="{{ old('email') }}"
                          placeholder="Email">
                        <div class="input-group-append">
                          <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                        </div>
                      </div>

                      @error('email')
                        <span class="invalid-feedback" role="alert">
                          <strong>{{ $message }}</strong>
                        </span>
                      @enderror
                    </div>

                    <div class="row">
                      <div class="col-sm-12 col-md-6">
                        <div class="form-group">
                          <label for="_status"><strong>Select Status</strong></label>
                          <div class="input-group mb-3">
                            <select type="select" name="status" id="_status"
                              class="form-control @error('status') is-invalid @enderror">
                              <option value="" selected disabled>Select One</option>
                              <option value="0" {{ old('status') == '0' ? 'selected' : '' }}>Pending</option>
                              <option value="1" {{ old('status') == '1' ? 'selected' : '' }}>Confirmed</option>
                            </select>
                            <div class="input-group-append">
                              <span class="input-group-text"><i class="fas fa-check"></i></span>
                            </div>
                          </div>

                          @error('status')
                            <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                            </span>
                          @enderror
                        </div>
                      </div>
                      <div class="col-sm-12 col-md-6">
                        <div class="form-group">
                          <label for="_type"><strong>Select Type</strong></label>
                          <div class="input-group mb-3">
                            <select type="select" name="type" id="_type"
                              class="form-control @error('type') is-invalid @enderror">
                              <option value="" selected disabled>Select One</option>
                              <option value="0" {{ old('type') == '0' ? 'selected' : '' }}>Employee</option>
                              <option value="1" {{ old('type') == '1' ? 'selected' : '' }}>Admin</option>
                            </select>
                            <div class="input-group-append">
                              <span class="input-group-text"><i class="fas fa-user-shield"></i></span>
                            </div>
                          </div>

                          @error('type')
                            <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                            </span>
                          @enderror
                        </div>
                      </div>
                    </div>

                    <div class="form-group">
                      <label for="_pass"><strong>Password</strong></label>
                      <div class="input-group">
                        <input type="text" name="password" value="abcd1234" class="form-control" disabled>
                        <div class="input-group-append">
                          <span class="input-group-text">
                            <i class="fas fa-lock"></i>
                          </span>
                        </div>
                      </div>
                    </div>
                  </fieldset>

                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                  <a class="btn btn-primary" href="{{ route('employees.index') }}"><i class="fas fa-angle-left"></i>
                    Back</a>
                  <input type="submit" value="Add Employee" class="btn btn-success float-right">
                </div>
              </div>
            </form>
          </div>
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
@endsection
