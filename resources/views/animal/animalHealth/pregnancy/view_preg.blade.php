@extends('layouts.app')

@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1><i class="nav-icon fas fa-file-medical"></i> View Pregnancy Details</h1>
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
                <div>
                  <a href="{{ url(((Auth::user()->role == 'Admin') ? 'admin' : 'medicalStaff').'/ani_health/preg_monitor') }}" class="btn btn-primary float-end"><i class="fas fa-backward"></i> Back</a>
                </div>
              </div>
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
              <form action="" method="post">
                <div class="card-body">
                  <div class="row mt-3">
                    <div class="form-group col-md-4">
                      <label for="animal_id">Animal ID<span style="color: red">*</span></label>
                      <input type="text" class="form-control" name="animal_id" id="animal_id" value="{{ old('animal_id') }}" readonly>
                      <div style="color: rgb(196, 3, 3)">{{ $errors->first('animal_id') }}</div>
                    </div>
                    <div class="form-group col-md-4">
                      <label for="preg_date">Date of Inspect <span style="color: red">*</span></label>
                      <input type="date" class="form-control" name="preg_date" id="preg_date" value="{{ old('preg_date') }}">
                      <div style="color: rgb(196, 3, 3)">{{ $errors->first('preg_date') }}</div>
                    </div>
                    <div class="form-group col-md-4">
                      <label for="estimated_delivery_date">Estimated Delivery Date <span style="color: red">*</span></label>
                      <input type="date" class="form-control" name="estimated_delivery_date" id="estimated_delivery_date" value="{{ old('estimated_delivery_date') }}">
                      <div style="color: rgb(196, 3, 3)">{{ $errors->first('estimated_delivery_date') }}</div>
                    </div>
                  </div>
                </div>
                <div class="card-footer">
                    {{-- <button type="submit" class="btn btn-success">Vaccinated</button> --}}
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