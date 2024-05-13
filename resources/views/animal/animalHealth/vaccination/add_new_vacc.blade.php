@extends('layouts.app')

@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1><i class="nav-icon fas fa-syringe"></i> Add New Vaccination Record</h1>
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
                <h3 class="card-title">Animal Details</h3>
                <div>
                  <a href="{{ url(((Auth::user()->role == 'Admin') ? 'admin' : 'medicalStaff').'/ani_health/vaccin_monitor') }}" class="btn btn-primary float-end"><i class="fas fa-backward"></i> Back</a>
                </div>
              </div>
              <form action="" method="POST">
                @csrf
                <div class="card-body"> 
                  <div class="row">
                    
                    <div class="form-group col-md-3">
                      <label for="animal_id">Animal ID</label>
                      <input type="text" class="form-control" name="animal_id" id="animal_id" value="{{ old('animal_id') }}" placeholder="Animal. ID">
                    </div>

                    <div class="form-group col-md-5">
                      <button type="submit" class="btn btn-success" style="margin-top: 32px">New Vaccine Record</button>
                      <a href="{{ url(((Auth::user()->role == 'Admin') ? 'admin' : 'medicalStaff').'/ani_health/vaccin_monitor/qr-scanner') }}" type="button" class="btn btn-primary" style="margin-top: 32px">Scan Ear Tag</a>
                      <a href="{{ url(((Auth::user()->role == 'Admin') ? 'admin' : 'medicalStaff').'/ani_health/vaccin_monitor/add') }}" class="btn btn-warning" style="margin-top: 32px">Reset</a>
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
    @if(!empty($fetchedRecord))
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="card-tools">
                    </div>
                  </div>
              <form action="{{ ((Auth::user()->role == 'Admin') ? '/admin' : '/medicalStaff').'/ani_health/vaccin_monitor/add/save' }}" method="post">
                @csrf
                <div class="card-body">
                  <div class="row mt-3">
                    <div class="form-group col-md-4">
                      <label for="animal_id">Animal ID<span style="color: red">*</span></label>
                      <input type="text" class="form-control" name="animal_id" id="animal_id" value="{{ old('animal_id', $fetchedRecord) }}" readonly>
                      <div style="color: rgb(196, 3, 3)">{{ $errors->first('animal_id') }}</div>
                    </div>
                    <div class="form-group col-md-4">
                      <label for="vac_date">Date of Vaccined <span style="color: red">*</span></label>
                      <input type="date" class="form-control" name="vac_date" id="vac_date" value="{{ old('vac_date') }}">
                      <div style="color: rgb(196, 3, 3)">{{ $errors->first('vac_date') }}</div>
                    </div>
                    <div class="form-group col-md-4">
                      <label for="vac_name">Vaccination Name<span style="color: red">*</span></label>
                      <input type="text" class="form-control" name="vac_name" id="vac_name" value="{{ old('vac_name') }}">
                      <div style="color: rgb(196, 3, 3)">{{ $errors->first('vac_name') }}</div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="form-group col-md-6">
                      <label for="next_vac_name">Next Vaccination Name</label>
                      <input type="text" class="form-control" name="next_vac_name" id="next_vac_name" value="{{ old('next_vac_name') }}">
                      <div style="color: rgb(196, 3, 3)">{{ $errors->first('next_vac_name') }}</div>
                    </div>
                    <div class="form-group col-md-6">
                      <label for="next_vac_date">Date of Next Vaccination</label>
                      <input type="date" class="form-control" name="next_vac_date" id="next_vac_date" value="{{ old('next_vac_date') }}">
                      <div style="color: rgb(196, 3, 3)">{{ $errors->first('next_vac_date') }}</div>
                    </div>
                  </div>
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-success">Submit</button>
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