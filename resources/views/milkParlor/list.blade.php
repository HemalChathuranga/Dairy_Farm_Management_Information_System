@extends('layouts.app')

@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1><i class="nav-icon fas fa-list"></i> Milking List</h1>
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
                <h3 class="card-title">Filter Records</h3>
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
                      <a href="{{ url(((Auth::user()->role == 'Admin') ? 'admin' : ((Auth::user()->role == 'Manager') ? 'manager' : 'fieldStaff')).'/milkParlor/milking_info') }}" class="btn btn-warning" style="margin-top: 32px">Reset</a>
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
                  {{-- <div class="input-group input-group-sm" style="width: 150px;">
                    <div>
                      <a href="{{ url(((Auth::user()->role == 'Admin') ? 'admin' : ((Auth::user()->role == 'Manager') ? 'manager' : 'fieldStaff')).'/milkParlor/milking_info') }}" class="btn btn-primary float-end"><i class="fas fa-plus"></i> New Animal</a>
                    </div>
                  </div> --}}
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body table-responsive p-0">
                <table class="table table-hover table-bordered" id="milking_table" name="milking_table" style="text-align: center">
                  <thead>

                    <tr style="text-align: center">
                      <th rowspan="2" >#</th>
                      <th rowspan="2">Date</th>
                      <th rowspan="2">Animal ID</th>
                      <th colspan="3" style="background-color: #e7e7f9">Morning</th>
                      <th colspan="3" style="background-color: #fadbdb">Evening</th>
                      <th rowspan="2" style="background-color: #c7f8ca">Daily Total</th>
                      <th rowspan="2">Action</th>
                    </tr>

                    <tr style="text-align: center">
                      <th style="background-color: #e7e7f9">Yield<br>(l)</th>
                      <th style="background-color: #e7e7f9">Added By<br>(UID)</th>
                      <th style="background-color: #e7e7f9">Updated By<br>(UID)</th>
                      <th style="background-color: #fadbdb">Yield<br>(l)</th>
                      <th style="background-color: #fadbdb">Added By<br>(UID)</th>
                      <th style="background-color: #fadbdb">Updated By<br>(UID)</th>
                    </tr>

                  </thead>
                  <tbody>

                      @foreach ($fetchedRecord as $item)
                        <tr>
                          <form action="{{ url(((Auth::user()->role == 'Admin') ? 'admin' : 'manager').'/milkParlor/milking_info/'.$item->id.'/save') }}" method="post">
                            @csrf
                            <td>{{ ($fetchedRecord->currentPage() == 1) ? $loop->iteration : ($loop->iteration + 10) }}</td>
                            <td>{{ $item->milking_date }}</td>
                            <td>{{ $item->animal_id }}</td>

                            {{-- Only Admins and Managers will be able to change the milking volume values --}}
                            @if ((Auth::user()->role == 'Admin') OR (Auth::user()->role == 'Manager'))
                              <td style="background-color: #e7e7f9"><input type="number" step="0.01" class="form-control" id="mor_milk_vol" name="mor_milk_vol" value="{{ $item->morning_vol }}" style="text-align: center; width: 90px; height: 30px"></td>
                            @else
                            <td style="background-color: #e7e7f9"><input type="number" step="0.01" class="form-control" id="mor_milk_vol" name="mor_milk_vol" value="{{ $item->morning_vol }}" style="text-align: center; width: 90px; height: 30px" readonly></td>
                            @endif
                            
                            <td style="background-color: #e7e7f9">{{ ($item->mor_added_by == "") ? '-' : $item->mor_added_by }}</td>
                            <td style="background-color: #e7e7f9">{{ ($item->mor_updated_by == "") ? '-' : $item->mor_updated_by }}</td>

                            {{-- Only Admins and Managers will be able to change the milking volume values --}}
                            @if ((Auth::user()->role == 'Admin') OR (Auth::user()->role == 'Manager'))
                              <td style="background-color: #fadbdb"><input type="number" step="0.01" class="form-control" id="eve_milk_vol" name="eve_milk_vol" value="{{ $item->evening_vol }}" style="text-align: center; width: 90px; height: 30px"></td>
                            @else
                              <td style="background-color: #fadbdb"><input type="number" step="0.01" class="form-control" id="eve_milk_vol" name="eve_milk_vol" value="{{ $item->evening_vol }}" style="text-align: center; width: 90px; height: 30px" readonly></td>
                            @endif
                            
                            <td style="background-color: #fadbdb">{{ ($item->eve_added_by == "") ? '-' : $item->eve_added_by }}</td>
                            <td style="background-color: #fadbdb">{{ ($item->eve_updated_by == "") ? '-' : $item->eve_updated_by }}</td>
                            <td>

                              @if (($item->morning_vol + $item->evening_vol) >= 25.00)
                                <i class="fas fa-thumbs-up text-success"></i>
                              @else
                                <i class="fas fa-thumbs-down text-danger"></i>
                              @endif
                                
                              <strong>{{ ($item->morning_vol + $item->evening_vol) }}</strong></td>
                            <td>
                              {{-- Only Admins and Managers will be able to click the save button --}}
                              @if ((Auth::user()->role == 'Admin') OR (Auth::user()->role == 'Manager'))
                                <button type="submit" class="btn btn-outline-success btn-sm"><i class="fas fa-floppy-disk"></i></button>
                              @else
                                <button type="submit" class="btn btn-outline-success btn-sm" disabled><i class="fas fa-floppy-disk"></i></button>
                              @endif

                              {{-- Only Admins will be able to see the delete button --}}
                              @if (Auth::user()->role == 'Admin')
                                <a href="{{ url('admin/milkParlor/milking_info/'.$item->id.'/delete') }}" type="button" class="btn btn-outline-danger btn-sm" onclick="return confirm('Are you sure you want to delete this Record?')"><i class="fas fa-trash"></i></a>
                              @endif
                              
                            </td>
                          </form>
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