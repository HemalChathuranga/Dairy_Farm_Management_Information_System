@extends('layouts.app')

@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Office Staff List</h1>
          </div>
          <div class="col-sm-6">
            @include('message')
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Search Filter-->

    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Search Staff</h3>
              </div>
              <form action="" method="get">
                <div class="card-body">
                  <div class="row">
                    <div class="form-group col-md-2">
                      <label for="emp_id">Employee ID</label>
                      <input type="text" class="form-control" name="emp_id" id="emp_id" value="{{ Request::get('emp_id') }}" placeholder="Emp. ID">
                    </div>
                    <div class="form-group col-md-3">
                      <label for="name">Name</label>
                      <input type="text" class="form-control" name="name" id="name" value="{{ Request::get('name') }}" placeholder="Name">
                    </div>
                    <div class="form-group col-md-4">
                      <label for="email">Email</label>
                      <input type="text" class="form-control" name="email" id="email" value="{{ Request::get('email') }}" placeholder="E-mail">
                    </div>
                    <div class="form-group col-md-3">
                      <button type="submit" class="btn btn-success" style="margin-top: 32px">Search</button>
                      <a href="{{ url('admin/officeStaff/list') }}" class="btn btn-warning" style="margin-top: 32px">Reset</a>
                    </div>
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!-- /Search Filter-->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <!-- /.row -->
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <div class="card-tools">
                  <div class="input-group input-group-sm" style="width: 150px;">
                    <div>
                      <a href="{{ url('admin/officeStaff/add') }}" class="btn btn-primary float-end"><i class="fas fa-plus"></i> Add Staff</a>
                    </div>
                  </div>
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body table-responsive p-0">
                <table class="table table-hover text-nowrap">
                  <thead>
                    <tr>
                      <th>#</th>
                      <th>Employee ID</th>
                      <th>Name</th>
                      <th>E-Mail</th>
                      <th>Mob Number</th>
                      <th>Status</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>

                  @foreach ($fetchedRecord as $item)
                      <tr>
                        {{-- <td>{{ $loop->iteration }}</td> --}}
                        <td>{{ ($fetchedRecord->currentPage() == 1) ? $loop->iteration : ($loop->iteration + 5) }}</td>
                        <td>{{ $item->emp_id }}</td>
                        <td>{{ $item->first_name . ' ' . $item->last_name }}</td>
                        <td>{{ $item->email }}</td>
                        <td>{{ $item->mobile_number }}</td>
                        <td><span class="{{($item->status == "Active") ? "badge badge-success" : "badge badge-danger"}}">{{ $item->status }}</span></td>
                        <td>
                          <a href="{{ url('admin/officeStaff/'.$item->id.'/view') }}" type="button" class="btn btn-outline-info btn-sm"><i class="fas fa-eye"></i></a>
                          <a href="{{ url('admin/officeStaff/'.$item->id.'/edit') }}" type="button" class="btn btn-outline-warning btn-sm"><i class="fas fa-pen"></i></a>
                          <a href="{{ url('admin/officeStaff/'.$item->id.'/delete') }}" type="button" class="btn btn-outline-danger btn-sm" onclick="return confirm('Are you sure you want to delete this Record?')"><i class="fas fa-trash"></i></a>
                        </td>
                      </tr>
                  @endforeach
                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->

            <!-- Pagination -->
            <div>
              {{ $fetchedRecord->links('pagination::bootstrap-5') }}
            </div>

          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  
@endsection