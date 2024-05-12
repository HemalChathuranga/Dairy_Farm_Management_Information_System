@extends('layouts.app')

@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1><i class="nav-icon fas fa-list-ul"></i> Vaccination Full List</h1>
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
                <h3 class="card-title">Search Vaccination Records</h3>
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
                      <a href="{{ url(((Auth::user()->role == 'Admin') ? 'admin' : 'medicalStaff').'/ani_health/vaccin_monitor/full_list') }}" class="btn btn-warning" style="margin-top: 32px">Reset</a>
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
                  <div class="input-group input-group-sm" style="align-items: center; width: 100px">
                    <a href="{{ url(((Auth::user()->role == 'Admin') ? 'admin' : 'medicalStaff').'/ani_health/vaccin_monitor') }}" class="btn btn-primary float-end"><i class="fas fa-backward"></i> Back</a>
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
                      <th>Vaccine Name</th>
                      <th>Vaccined Date</th>
                      <th>Vaccined By</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($fetchedRecord as $item)
                      <tr>
                        <td>{{ ($fetchedRecord->currentPage() == 1) ? $loop->iteration : ($loop->iteration + 10) }}</td>
                        {{-- <td>1</td> --}}
                        <td>{{ $item->animal_id }}</td>
                        <td>{{ $item->vac_name }}</td>
                        <td>{{ $item->vac_date }}</td>
                        <td>{{ $item->vac_by }}</td>
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