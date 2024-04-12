@extends('layouts.app')

@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Field Staff User Info.</h1>
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
                          <a href="{{ url('admin/fieldStaff/list') }}" class="btn btn-primary float-end"><i class="fas fa-backward"></i> Back</a>
                        </div>
                      </div>
                    </div>
                  </div>
              <form>
                <div class="card-body">
                  <div class="row">
                    <div class="form-group col-md-8">
                      <label for="emp_id">Employee ID</label>
                      <input type="text" class="form-control" name="emp_id" id="emp_id" value="{{ $fetchedRecord->emp_id }}" placeholder="Enter Employee ID" readonly>

                      <label class="mt-2" for="status">Status</label>
                      <select class="form-control" name="status" id="status" readonly>
                        <option {{($fetchedRecord->status === 'Active') ? 'selected' : '' }} value="Active">Active</option>
                        <option {{($fetchedRecord->status === 'Inactive') ? 'selected' : '' }} value="Inactive">Inactive</option>
                      </select>

                      <label class="mt-2" for="first_name">First Name</label>
                      <input type="text" class="form-control" name="first_name" id="first_name" value="{{ $fetchedRecord->first_name }}" placeholder="Enter First Name" readonly>

                      <label class="mt-2" for="last_name">Last Name</label>
                      <input type="text" class="form-control" name="last_name" id="last_name" value="{{ $fetchedRecord->last_name }}" placeholder="Enter Last Name" readonly>

                    </div>
                    <div class="form-group col-md-4">
                      <label class="mt-2" for="last_name">Profile Picture</label>
                      <div class="card">
                        <div class="card-body">
                          <div class="image">
                            <img src="{{ '\uploads\profile_img\\' . $fetchedRecord->prof_pic }}" class="img-fluid d-block mx-auto" style="width:50%; hight:60%; align:center" alt="User Image">
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="form-group col-md-6">
                      <label for="birth_date">Date of Birth</label>
                      <input type="date" class="form-control" name="birth_date" id="birth_date" value="{{ $fetchedRecord->birth_date }}" readonly>
                    </div>
                    <div class="form-group col-md-6">
                      <label for="gender">Gender</label>
                      <select class="form-control" name="gender" id="gender" readonly>
                        <option value="">Select Gender</option>
                        <option {{ ($fetchedRecord->gender === 'Male') ? 'selected' : '' }} value="Male">Male</option>
                        <option {{ ($fetchedRecord->gender === 'Female') ? 'selected' : '' }} value="Female">Female</option>
                      </select>
                    </div>
                  </div>
                  <div class="row">
                    <div class="form-group col-md-6">
                      <label for="joined_date">Joined Date</label>
                      <input type="date" class="form-control" name="joined_date" id="joined_date" value="{{ $fetchedRecord->joined_date }}" readonly>
                    </div>
                    <div class="form-group col-md-6">
                      <label for="nic">NIC Number</label>
                      <input type="text" class="form-control" name="nic" id="nic" value="{{ $fetchedRecord->nic }}" placeholder="Enter NIC Number" readonly>
                    </div>
                  </div>
                  <div class="row">
                    <div class="form-group col-md-6">
                      <label for="mobile_number">Mob Number</label>
                      <input type="text" class="form-control" name="mobile_number" id="mobile_number" value="{{ $fetchedRecord->mobile_number }}" placeholder="Enter Mobile Number" readonly>
                                    
                      <label for="email">E-Mail</label>
                      <input type="email" class="form-control" name="email" id="email" value="{{ $fetchedRecord->email }}" placeholder="Enter Email" readonly>
                    </div>
                    <div class="form-group col-md-6">
                      <label for="address">Address</label>
                      <textarea class="form-control" name="address" id="address" rows="4" value="" placeholder="Enter Address" readonly>{{ $fetchedRecord->address }}</textarea>
                    </div>
                  </div>
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