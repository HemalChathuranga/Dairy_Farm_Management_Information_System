@extends('layouts.app')

@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1><i class="nav-icon fas fa-hand-holding-heart"></i> Delivery Due List</h1>
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
                <h3 class="card-title">Search Records</h3>
              </div>
              <form action="" method="get">
                <div class="card-body">
                  <div class="row">
                    <div class="form-group col-md-3">
                      <label for="start_date">Start Date</label>
                      <input type="date" class="form-control" name="start_date" id="start_date" value="{{ Request::get('start_date') }}">
                    </div>
                    <div class="form-group col-md-3">
                      <label for="end_date">End Date</label>
                      <input type="date" class="form-control" name="end_date" id="end_date" value="{{ Request::get('end_date') }}">
                    </div>
                    <div class="form-group col-md-3">
                      <label for="animal_id">Animal ID</label>
                      <input type="text" class="form-control" name="animal_id" id="animal_id" value="{{ Request::get('animal_id') }}" placeholder="Animal. ID">
                    </div>
                    <div class="form-group col-md-3">
                      <button type="submit" class="btn btn-success" style="margin-top: 32px">Search</button>
                      <a href="{{ url(((Auth::user()->role == 'Admin') ? 'admin' : 'medicalStaff').'/ani_health/preg_monitor') }}" class="btn btn-warning" style="margin-top: 32px">Reset</a>
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
            <p><sub>(<i class="fa-solid fa-thumbtack text-danger"></i> - Mark the Due dates within current week)</sub></p>
            <div class="card">
              <div class="card-header">
                <div class="card-tools">
                  <div class="input-group input-group-sm" style="align-items: center; width: 300px">
                    <div class="row">
                      <div class="col-md-6">
                      <a href="{{ url(((Auth::user()->role == 'Admin') ? 'admin' : 'medicalStaff').'/ani_health/preg_monitor/add') }}" class="btn btn-primary"><i class="fas fa-plus"></i> New Pregnancy</a>
                      </div>
                      <div class="col-md-6">
                      <a href="{{ url(((Auth::user()->role == 'Admin') ? 'admin' : 'medicalStaff').'/ani_health/preg_monitor/full_list') }}" class="btn btn-secondary"><i class="fas fa-list-ul"></i> Full Pregnancy List</a>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body table-responsive p-0">
                <table class="table table-hover text-nowrap" style="text-align: center">
                  <thead>
                    <tr>
                      <th>#</th>
                      <th>Animal ID</th>
                      <th>Pregnancy Date</th>
                      <th>Pregnancy Occ.</th>
                      <th>Due Date</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($fetchedRecord as $item)
                      <tr>
                        <td>{{ ($fetchedRecord->currentPage() == 1) ? $loop->iteration : ($loop->iteration + 10) }}</td>
                        <td>{{ $item->animal_id }}</td>
                        <td>{{ $item->preg_date }}</td>
                        <td>{{ $item->pregnancy_occ }}</td>

                        <td>{{ $item->estimated_delivery_date }}  
                          @php
                            $dueDate = strtotime($item->estimated_delivery_date);
                            $today = strtotime(date('Y-m-d'));
                            $diff = floor(($dueDate - $today) / (60 * 60 * 24));

                            if ($diff <= 7 ) {
                              echo '<sup><i class="fa-solid fa-thumbtack text-danger"></i></sup>';
                            }
                          @endphp
                        </td>
                        <td>
                          <a href="{{ url(((Auth::user()->role == 'Admin') ? 'admin' : 'medicalStaff').'/ani_health/preg_monitor/'.$item->id.'/edit') }}" type="button" class="btn btn-outline-success btn-sm">Mark Delivery</a>
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