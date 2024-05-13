@extends('layouts.app')

@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1><i class="nav-icon fas fa-file-medical"></i> View Treatment Info.</h1>
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
                {{-- <h3 class="card-title">Animal Details</h3> --}}
                <div>
                  <a href="{{ url(((Auth::user()->role == 'Admin') ? 'admin' : 'medicalStaff').'/ani_health/treatment/full_list') }}" class="btn btn-primary float-end"><i class="fas fa-backward"></i> Back</a>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!-- /Search Filter-->


    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="card-tools">
                    </div>
                  </div>
              <form action="" method="">
                <div class="card-body">
                  <div class="row mt-3">
                    <div class="form-group col-md-6">
                      <label for="animal_id">Animal ID</label>
                      <input type="text" class="form-control" name="animal_id" id="animal_id" value="{{ old('animal_id', $fetchedRecord->animal_id) }}" readonly>
                    </div>
                    <div class="form-group col-md-6">
                      <label for="inspect_date">Date of Inspect</label>
                      <input type="date" class="form-control" name="inspect_date" id="inspect_date" value="{{ old('inspect_date', $fetchedRecord->inspect_date) }}" readonly>
                      <div style="color: rgb(196, 3, 3)">{{ $errors->first('inspect_date') }}</div>
                    </div>
                  </div>
                  <div class="row mt-3">
                    <div class="form-group col-md-12">
                      <label for="illness">Inspected Illness</label>
                      <input type="text" class="form-control" name="illness" id="illness" value="{{ old('illness', $fetchedRecord->illness) }}" readonly>
                      <div style="color: rgb(196, 3, 3)">{{ $errors->first('illness') }}</div>
                    </div>
                  </div>
                  <div class="row mt-3">
                    <div class="form-group col-md-12">
                      <label for="treatment">Treatment Details <span style="color: red">*</span></label>
                      <textarea class="form-control" name="treatment" id="treatment" rows="4" value="{{ old('treatment', $fetchedRecord->treatment) }}" placeholder="Enter Treatment Details" readonly>{{ $fetchedRecord->treatment }}</textarea>
                    </div>
                  </div>
                  <div class="row mt-3">
                    <div class="form-group col-md-4">
                      <label for="milking_status">Milking Status <span style="color: red">*</span></label>
                      <select class="form-control" name="milking_status" id="milking_status" @readonly(true)>
                        <option {{ (old('milking_status', $fetchedRecord->milking_status) == 'Non-Milking') ? 'selected' : '' }} value="Non-Milking">Non-Milking</option>
                        <option {{ (old('milking_status', $fetchedRecord->milking_status) == 'Milking') ? 'selected' : '' }} value="Milking">Milking</option>
                      </select>
                    </div>
                    <div class="form-group col-md-4">
                      <label for="treat_date">Treatment Date <span style="color: red">*</span></label>
                      <input type="date" class="form-control" name="treat_date" id="treat_date" value="{{ old('treat_date') }}" readonly>
                      <div style="color: rgb(196, 3, 3)">{{ $errors->first('treat_date', $fetchedRecord->treat_date) }}</div>
                    </div>
                    <div class="form-group col-md-4">
                      <label for="treatment_status">Treatment Status <span style="color: red">*</span></label>
                      <select class="form-control" name="treatment_status" id="treatment_status" @readonly(true)>
                        <option {{ (old('treatment_status', $fetchedRecord->treatment_status) == 'Pending') ? 'selected' : '' }} value="Pending">Pending</option>
                        <option {{ (old('treatment_status', $fetchedRecord->treatment_status) == 'Completed') ? 'selected' : '' }} value="Completed">Completed</option>
                      </select>
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
    <!-- /.content -->
  </div>

@endsection