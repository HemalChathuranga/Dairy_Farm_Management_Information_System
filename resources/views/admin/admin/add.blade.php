@extends('layouts.app')

@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Add New Admin</h1>
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
                          <a href="{{ url('admin/admin/list') }}" class="btn btn-primary float-end"><i class="fas fa-backward"></i> Back</a>
                        </div>
                      </div>
                    </div>
                  </div>
              <form action="" method="post">
                @csrf
                <div class="card-body">
					<div class="row">
						<div class="form-group col-md-6">
							<label for="emp_id">Employee ID <span style="color: red">*</span></label>
							<input type="text" class="form-control" name="emp_id" id="emp_id" value="{{ old('emp_id') }}" placeholder="Enter Employee ID" required>
						</div>
            <div class="form-group col-md-6">
							<label for="status">Status <span style="color: red">*</span></label>
              <select class="form-control" name="status" id="status" value="{{ old('status') }}" required>
                <option value="Active">Active</option>
                <option value="Inactive">Inactive</option>
              </select>
						</div>
					</div>
					<div class="row">
						<div class="form-group col-md-6">
							<label for="first_name">First Name <span style="color: red">*</span></label>
							<input type="text" class="form-control" name="first_name" id="first_name" value="{{ old('first_name') }}" placeholder="Enter First Name" required>
						</div>
						<div class="form-group col-md-6">
							<label for="last_name">Last Name <span style="color: red">*</span></label>
							<input type="text" class="form-control" name="last_name" id="last_name" value="{{ old('last_name') }}" placeholder="Enter Last Name" required>
						</div>
					</div>
					<div class="row">
						<div class="form-group col-md-6">
							<label for="birth_date">Date of Birth <span style="color: red">*</span></label>
							<input type="date" class="form-control" name="birth_date" id="birth_date" value="{{ old('birth_date') }}">
						</div>
						<div class="form-group col-md-6">
							<label for="gender">Gender <span style="color: red">*</span></label>
              <select class="form-control" name="gender" id="gender" required>
                <option value="">Select Gender</option>
                <option {{ (old('gender') == 'Male') ? 'selected' : '' }} value="Male">Male</option>
                <option {{ (old('gender') == 'Female') ? 'selected' : '' }}value="Female">Female</option>
              </select>
						</div>
					</div>
          <div class="row">
						<div class="form-group col-md-6">
							<label for="joined_date">Joined Date <span style="color: red">*</span></label>
							<input type="date" class="form-control" name="joined_date" id="joined_date" value="{{ old('joined_date') }}">
						</div>
						<div class="form-group col-md-6">
							<label for="nic">NIC Number <span style="color: red">*</span></label>
              <input type="text" class="form-control" name="nic" id="nic" value="{{ old('nic') }}" placeholder="Enter NIC Number">
						</div>
					</div>
          <div class="row">
						<div class="form-group col-md-6">
							<label for="mobile_number">Mob Number <span style="color: red">*</span></label>
							<input type="text" class="form-control" name="mobile_number" id="mobile_number" value="{{ old('mobile_number') }}" placeholder="Enter Mobile Number">
                            
              <label for="email">E-Mail <span style="color: red">*</span></label>
              <input type="email" class="form-control" name="email" id="email" value="{{ old('email') }}" placeholder="Enter Email">
						</div>
						<div class="form-group col-md-6">
							<label for="address">Address</label>
              <textarea class="form-control" name="address" id="address" rows="4" value="{{ old('address') }}" placeholder="Enter Address"></textarea>
						</div>
					</div>
          <div class="row">
						<div class="form-group col-md-6">
							<label for="password">Password <span style="color: red">*</span></label>
							<input type="password" class="form-control" name="password" id="password" value="{{ old('password') }}" required>
						</div>
						<div class="form-group col-md-6">
							<label for="prof_pic">Profile Picture</label>
              <input type="file" class="form-control" name="prof_pic" id="prof_pic" value="{{ old('prof_pic') }}">
						</div>
					</div>
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Submit</button>
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