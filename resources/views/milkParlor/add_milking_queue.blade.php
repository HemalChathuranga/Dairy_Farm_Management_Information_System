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
                <h3 class="card-title">Search Animal</h3>
              </div>
              <form action="" method="get">
                <div class="card-body"> 

                  <div class="row">
                    <div class="form-group col-md-5">
                      <label for="animal_id">Animal ID</label>
                      <input type="text" class="form-control" name="animal_id" id="animal_id" value="{{ Request::get('animal_id') }}" placeholder="Animal. ID">
                    </div>
                    <div class="form-group col-md-5">
                      <button type="submit" class="btn btn-success" style="margin-top: 32px">Search</button>
                      <a href="{{ url('animal/animalInfo/qr-scanner') }}" type="button" class="btn btn-primary" style="margin-top: 32px">Scan Ear Tag</a>
                      <a href="{{ url('animal/animalInfo/view') }}" class="btn btn-warning" style="margin-top: 32px">Reset</a>
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
    @if(!empty($fetchedRecord->animal_id))

    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="card-tools">
                      <div class="input-group input-group-sm" style="width: 150px;">
                        <div>
                          <a href="{{ url(((Auth::user()->role == 'Admin') ? 'admin' : ((Auth::user()->role == 'Manager') ? 'manager' : 'officeStaff')).'/animal/animalInfo/view') }}" class="btn btn-primary float-end"><i class="fas fa-backward"></i> Back</a>
                        </div>
                      </div>
                    </div>
                  </div>
                  <form action="">
                    <div class="card-body">
                      <div class="row">
                        <div class="col-4">
                          <h5><u>Animal Basic Information</u></h5>
                        </div>
                        <div class="col-4">
                        </div>
                        <div class="col-4">
                          <div class="row mt-2">
                            <div class="col-6">
                              <h5><b>Animal Status :</b></h5>
                            </div>
                            <div class="col-6">
                              <h5><b><span class="{{($fetchedRecord->status == "Active") ? "badge badge-success" : "badge badge-danger"}}">{{ $fetchedRecord->status }}</span></b></h5>
                              @if ($fetchedRecord->gender == 'Female')
                                <h5><span class="{{($fetchedRecord->milking_status == "Milking") ? "badge badge-info" : "badge badge-secondary"}}">{{ $fetchedRecord->milking_status }}</span></h5>
                                <h5><span class="{{($fetchedRecord->pregnant_status == "Yes") ? "badge badge-danger" : "badge badge-warning"}}">{{ ($fetchedRecord->pregnant_status == "Yes") ? 'Pregnant' : 'Not Pregnant' }}</span></h5>
                              @endif
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="row mt-5">
                        <div class="form-group col-4">
                          <label for="animal_id">Animal ID :</label>
                          <input type="text" class="form-control" name="animal_id" id="animal_id" value="{{ $fetchedRecord->animal_id }}" readonly>
                        </div>
                        <div class="form-group col-4">
                          <label for="birth_date">Date of Birth</label>
                          <input type="date" class="form-control" name="birth_date" id="birth_date" value="{{ $fetchedRecord->birth_date }}" readonly>
                        </div>
                        <div class="form-group col-4">
                          <label for="animal_age">Age :</label>
                          <input type="text" class="form-control" name="animal_age" id="animal_age" 
                            value="@php
                            $bday = new DateTime($fetchedRecord->birth_date);
                            $today = new DateTime(date('m.d.y'));

                            $diff = $today->diff($bday);
                            echo $diff->y.' Year(s) | '.$diff->m.' Month(s) | '.$diff->d.' Day(s)';
                            @endphp"
                            readonly>
                        </div>
                      </div>
                      <div class="row">
                        <div class="form-group col-4">
                          <label for="breed">Breed</label>
                          <input type="text" class="form-control" name="breed" id="breed" value="{{ $fetchedRecord->breed }}" readonly>
                        </div>
                        <div class="form-group col-4">
                          <label for="gender">Gender</label>
                          <input type="text" class="form-control" name="gender" id="gender" value="{{ $fetchedRecord->gender }}" readonly>
                        </div>
                        <div class="form-group col-4">
                          <label for="stall_number">Stall Number</label>
                          <input type="text" class="form-control" name="stall_number" id="stall_number" value="{{ $fetchedRecord->stall_number }}" placeholder="Stall Number" readonly>
                        </div>
                      </div>
                      <div class="row">
                        <div class="form-group col-4">
                          <label for="weight_at_birth">Weight at Birth (KG)</label>
                          <input type="text" class="form-control" name="weight_at_birth" id="weight_at_birth" value="{{ ($fetchedRecord->weight_at_birth == 0.00) ? "N/A" : $fetchedRecord->weight_at_birth }}" readonly>
                        </div>
                        <div class="form-group col-4">
                          <label for="height_at_birth">Height at Birth (Inch)</label>
                          <input type="text" class="form-control" name="height_at_birth" id="height_at_birth" value="{{ ($fetchedRecord->height_at_birth == 0.00) ? "N/A" : $fetchedRecord->height_at_birth }}" readonly>
                        </div>
                        <div class="form-group col-md-4">
                          <label for="buy_date">Buy Date</label>
                          <input type="date" class="form-control" name="buy_date" id="buy_date" value="{{ $fetchedRecord->buy_date }}" readonly>
                        </div>
                      </div>
                      <div class="row">
                        <div class="form-group col-md-12">
                          <label for="notes">Notes</label>
                          <textarea class="form-control" name="notes" id="notes" rows="4" value="{{ $fetchedRecord->notes }}" placeholder="Notes" readonly></textarea>
                        </div>
                      </div>
                      <div class="row mt-3">
                        <h5><u>Animal Parent Information</u></h5>
                      </div>
                      <div class="row mt-3">
                        <div class="form-group col-md-6">
                          <label for="father_id">Father ID</label>
                          <input type="text" class="form-control" name="father_id" id="father_id" value="{{ $fetchedRecord->father_id }}" placeholder="N/A" readonly>
                        </div>
                        <div class="form-group col-md-6">
                          <label for="mother_id">Mother ID</label>
                          <input type="text" class="form-control" name="mother_id" id="mother_id" value="{{ $fetchedRecord->mother_id }}" placeholder="N/A" readonly>
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