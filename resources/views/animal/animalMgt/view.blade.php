@extends('layouts.app')

@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Animal Info.</h1>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="card-tools">
                      <div class="input-group input-group-sm" style="width: 150px;">
                        <div>
                          <a href="{{ url(((Auth::user()->role == 'Admin') ? 'admin' : ((Auth::user()->role == 'Manager') ? 'manager' : 'officeStaff')).'/animal/animalMgt/list') }}" class="btn btn-primary float-end"><i class="fas fa-backward"></i> Back</a>
                        </div>
                      </div>
                    </div>
                  </div>
                  <form action="">
                    @csrf
                    <div class="card-body">
                      <div class="row">
                        <h5><u>Animal Basic Information</u></h5>
                      </div>
                      <div class="row mt-3">
                        <div class="form-group col-8">
                          <div class="row">
                            <div class="form-group col-4">
                              <label for="animal_id">Animal ID</label>
                              <input type="text" class="form-control" name="animal_id" id="animal_id" value="{{ $fetchedRecord->animal_id }}" readonly>
                            </div>
                            <div class="form-group col-4">
                              <label for="status">Status</label>
                              <input type="text" class="form-control" name="status" id="status" value="{{ $fetchedRecord->status }}" readonly>
                            </div>
                            <div class="form-group col-4">
                              <label for="birth_date">Date of Birth</label>
                              <input type="date" class="form-control" name="birth_date" id="birth_date" value="{{ $fetchedRecord->birth_date }}" readonly>
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
                            <div class="form-group col-6">
                              <label for="weight_at_birth">Weight at Birth (KG)</label>
                              <input type="text" class="form-control" name="weight_at_birth" id="weight_at_birth" value="{{ ($fetchedRecord->weight_at_birth == 0.00) ? "N/A" : $fetchedRecord->weight_at_birth }}" readonly>
                            </div>
                            <div class="form-group col-6">
                              <label for="height_at_birth">Height at Birth (Inch)</label>
                              <input type="text" class="form-control" name="height_at_birth" id="height_at_birth" value="{{ ($fetchedRecord->height_at_birth == 0.00) ? "N/A" : $fetchedRecord->height_at_birth }}" readonly>
                            </div>
                          </div>
                          <div class="row">
                            <div class="form-group col-md-6">
                              <label for="buy_date">Buy Date</label>
                              <input type="date" class="form-control" name="buy_date" id="buy_date" value="{{ $fetchedRecord->buy_date }}" readonly>
                            </div>
                            <div class="form-group col-md-6">
                              <label for="buy_price">Buy Price</label>
                              <input type="number" class="form-control" name="buy_price" id="buy_price" value="{{ $fetchedRecord->buy_price }}" placeholder="Buy Price" readonly>
                            </div>
                          </div>
                        </div>
                        <div class="form-group col-4">
                          <label class="" for="last_name">QR Code</label>
                          <div class="card text-center">
                            <div class="card-body">
                              <div class="image">
                                <a href="">{{ QrCode::size(200)->generate($fetchedRecord->animal_id) }}</a><br>
                                <a type="button" class="btn btn-success btn-sm mt-3" data-bs-toggle="modal" data-bs-target="#ModalCreate">View Ear Tag</a>
                              </div>
                            </div>
                          </div>
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
    <!-- /.content -->
    
    @include('animal.animalMgt.ear-tag')

  </div>

@endsection