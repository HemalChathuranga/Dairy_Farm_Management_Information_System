@extends('layouts.app')

@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1><i class="nav-icon fas fa-cow"></i> Daily Milking</h1>
          </div>
          <div class="col-sm-6">
            {{-- session messages --}}
            @include('message')

            {{-- validation errors --}}
            @if ($errors->any())
                  <div class="row">
                    <div class="col-md-11">
                      <div class="row alert alert-danger">
                        <div class="col-md-11">
                          <ul>
                              @foreach ($errors->all() as $item)
                                  <li>{{ $item }}</li>
                              @endforeach
                          </ul>
                        </div>
                        <div class="col-md-1">
                          <a href="" class="btn btn-outline-light btn-sm"><strong></strong>X</a>
                        </div>
                      </div>
                    </div>
                  </div>
                  @endif

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
                <h3 class="card-title">Queue Details</h3>
              </div>
              <form action="" method="POST">
                @csrf
                <div class="card-body"> 
                  <div class="row">
                    <div class="form-group col-md-2">
                      <label for="milking_date">Milking Date</label>
                      <input type="date" class="form-control" name="milking_date" id="milking_date" value="{{ date('Y-m-d') }}" readonly>
                    </div>
                    <div class="form-group col-md-2">
                      <label for="milking_time">Milking Time</label>
                      <input type="text" class="form-control" name="milking_time" id="milking_time" 
                      value="@php
                      date_default_timezone_set('Asia/Colombo');
                      $time = date('A');
                        if ($time == 'AM') {
                          echo 'Morning';
                        } else {
                          echo 'Evening';
                        }
                      @endphp" readonly>
                    </div>
                    <div class="form-group col-md-2">
                      <label for="animal_id">Animal ID</label>
                      <input type="text" class="form-control" name="animal_id" id="animal_id" value="{{ session('qrValue') }}" placeholder="Animal. ID">
                    </div>

                    <div class="form-group col-md-5">
                      <button type="submit" class="btn btn-success" style="margin-top: 32px">Add to Queue</button>
                      <a href="{{ url('admin/milkParlor/qr-scanner') }}" type="button" class="btn btn-primary" style="margin-top: 32px">Scan Ear Tag</a>
                      <a href="{{ url('admin/milkParlor/add_milking_queue/reset') }}" class="btn btn-warning" style="margin-top: 32px" onclick="return confirm('Warning..! \nReseting the Milking Queue will wipe all the existing details in the current Queue.')">Reset</a>
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
    @if(count($fetchedRecord)>0)

    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-12">
            <div class="card">

                  <form action="" method="POST">
                    @csrf
                    <div class="card-body">
                      <div class="row">
                        <div class="col-md-8">
                          <table class="table table-hover table-bordered" id="milking_table" name="milking_table" style="text-align: center">
                            <thead>
                              <tr>
                                <th>#</th>
                                <th>Cow ID</th>
                                <th>Milk Volume (l)</th>
                                <th>Action</th>
                              </tr>
                            </thead>

                            <tbody>
                              @foreach ($fetchedRecord as $item)
                              
                                <tr>
                                  <td>{{ $loop->iteration }}</td>
                                  <td>{{  $item->animal_id }}</td>
                                  <td><input type="number" class="form-control" style="text-align: center" id="milk_vol" name="milk_vol" value="{{ old('milk_vol') }}"></td>
                                  <td><a href="{{ url('admin/milkParlor/add_milking_queue/'.$item->id.'/delete') }}" type="button" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to Remove this Animal form the Milking Queue?')"> Remove</a></td>
                                </tr>

                              @endforeach

                            </tbody>
                          </table>
                          <button type="submit" class="btn btn-success" style="margin-top: 32px"><i class="fa-solid fa-floppy-disk"></i> Save</button>
                        </div>
                      </div>
                    </div>
                    <div class="card-footer">
                    </div>
                  </form>
            </div>
          </div>
        </div>
      </div>
    </section>
    @endif
    <!-- /.content -->

  </div>

@endsection