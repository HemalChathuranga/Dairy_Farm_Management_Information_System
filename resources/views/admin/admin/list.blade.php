@extends('layouts.app')

@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Admin List</h1>
          </div>
          <div class="col-sm-6">
            @include('message')
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

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
                      <a href="{{ url('admin/admin/add') }}" class="btn btn-primary float-end"><i class="fas fa-plus"></i> Add New Admin</a>
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
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $item->emp_id }}</td>
                        <td>{{ $item->first_name . ' ' . $item->last_name }}</td>
                        <td>{{ $item->email }}</td>
                        <td>{{ $item->mobile_number }}</td>
                        <td>{{ $item->status }}</td>
                        <td>
                          <a href="{{ url('admin/admin/'.$item->id.'/view') }}" type="button" class="btn btn-outline-info">View</a>
                          <a href="{{ url('admin/admin/'.$item->id.'/edit') }}" type="button" class="btn btn-outline-warning">Edit</a>
                          <a href="{{ url('admin/admin/'.$item->id.'/delete') }}" type="button" class="btn btn-outline-danger" onclick="return confirm('Are you sure you want to delete this Record?')">Delete</a>
                        </td>
                      </tr>
                  @endforeach



                    
                    
                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  
@endsection