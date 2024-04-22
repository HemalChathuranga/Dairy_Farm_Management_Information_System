@extends('layouts.app')

@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Add New Animal</h1>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    {{-- <div class="row">
      @if ($errors->any())
        <div>
          <ul class="alert alert-danger">
              @foreach ($errors->all() as $item)
                  <li>{{ $item }}</li>
              @endforeach
          </ul>
        </div>
          
      @endif
    </div> --}}

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
              <form action="" method="post">
                @csrf
                <div class="card-body">
                  <div class="row">
                    <h5><u>Animal Basic Information</u></h5>
                  </div>
                  <div class="row mt-3">
                    <div class="form-group col-md-3">
                      <label for="animal_id">Animal ID<span style="color: red">*</span></label>
                      <input type="text" class="form-control" name="animal_id" id="animal_id" value="{{ old('animal_id') }}">
                      <div style="color: rgb(196, 3, 3)">{{ $errors->first('animal_id') }}</div>
                    </div>
                    <div class="form-group col-md-3">
                      <label for="birth_date">Date of Birth <span style="color: red">*</span></label>
                      <input type="date" class="form-control" name="birth_date" id="birth_date" value="{{ old('birth_date') }}">
                      <div style="color: rgb(196, 3, 3)">{{ $errors->first('birth_date') }}</div>
                    </div>
                    <div class="form-group col-md-6">
                      <label for="breed">Breed <span style="color: red">*</span></label>
                      <select class="form-control" name="breed" id="breed">
                        <option value="">Select Breed</option>
                        <option {{ (old('breed') == 'Holstein') ? 'selected' : '' }} value="Holstein">Holstein</option>
                        <option {{ (old('breed') == 'Friesian') ? 'selected' : '' }} value="Friesian">Friesian</option>
                        <option {{ (old('breed') == 'Brahman') ? 'selected' : '' }} value="Brahman">Brahman</option>
                        <option {{ (old('breed') == 'Mundi') ? 'selected' : '' }} value="Mundi">Mundi</option>
                        <option {{ (old('breed') == 'Jersey') ? 'selected' : '' }} value="Jersey">Jersey</option>
                        <option {{ (old('breed') == 'Holstein Friesian') ? 'selected' : '' }} value="Holstein-Friesian">Holstein-Friesian</option>
                        <option {{ (old('breed') == 'Sindi') ? 'selected' : '' }} value="Sindi">Sindi</option>
                        <option {{ (old('breed') == 'Sahiwal') ? 'selected' : '' }} value="Sahiwal">Sahiwal</option>
                      </select>
                      <div style="color: rgb(196, 3, 3)">{{ $errors->first('breed') }}</div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="form-group col-md-6">
                      <label for="gender">Gender <span style="color: red">*</span></label>
                      <select class="form-control" name="gender" id="gender">
                        <option value="">Select Gender</option>
                        <option {{ (old('gender') == 'Male') ? 'selected' : '' }} value="Male">Male</option>
                        <option {{ (old('gender') == 'Female') ? 'selected' : '' }} value="Female">Female</option>
                      </select>
                      <div style="color: rgb(196, 3, 3)">{{ $errors->first('gender') }}</div>
                    </div>
                    <div class="form-group col-md-6">
                      <label for="stall_number">Stall Number  <span style="color: red">*</span></label>
                      <input type="text" class="form-control" name="stall_number" id="stall_number" value="{{ old('stall_number') }}" placeholder="Enter Stall Number">
                      <div style="color: rgb(196, 3, 3)">{{ $errors->first('stall_number') }}</div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="form-group col-md-6">
                      <label for="weight_at_birth">Weight at Birth (KG)</label>
                      <input type="number" class="form-control" name="weight_at_birth" id="weight_at_birth" value="{{ old('weight_at_birth') }}" placeholder="Weight at Birth (KG)">
                      <div style="color: rgb(196, 3, 3)">{{ $errors->first('weight_at_birth') }}</div>
                    </div>
                    <div class="form-group col-md-6">
                      <label for="height_at_birth">Height at Birth (Inch)</label>
                      <input type="number" class="form-control" name="height_at_birth" id="height_at_birth" value="{{ old('height_at_birth') }}" placeholder="Height at Birth (Inch)">
                      <div style="color: rgb(196, 3, 3)">{{ $errors->first('height_at_birth') }}</div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="form-group col-md-6">
                      <label for="buy_date">Buy Date</label>
                      <input type="date" class="form-control" name="buy_date" id="buy_date" value="{{ old('buy_date') }}">
                      <div style="color: rgb(196, 3, 3)">{{ $errors->first('buy_date') }}</div>
                    </div>
                    <div class="form-group col-md-6">
                      <label for="buy_price">Buy Price</label>
                      <input type="number" class="form-control" name="buy_price" id="buy_price" value="{{ old('buy_price') }}" placeholder="Buy Price">
                      <div style="color: rgb(196, 3, 3)">{{ $errors->first('buy_price') }}</div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="form-group col-md-12">
                      <label for="notes">Notes</label>
                      <textarea class="form-control" name="notes" id="notes" rows="4" value="{{ old('notes') }}" placeholder="Enter Notes"></textarea>
                    </div>
                  </div>

                  <div class="row mt-3">
                    <h5><u>Animal Parent Information</u></h5>
                  </div>

                  <div class="row mt-3">
                    <div class="form-group col-md-6">
                      <label for="father_id">Father ID</label>
                      <input type="text" class="form-control" name="father_id" id="father_id" value="{{ old('father_id') }}" placeholder="Enter Father ID">
                      <div style="color: rgb(196, 3, 3)">{{ $errors->first('father_id') }}</div>
                    </div>
                    <div class="form-group col-md-6">
                      <label for="mother_id">Mother ID</label>
                      <input type="text" class="form-control" name="mother_id" id="mother_id" value="{{ old('mother_id') }}" placeholder="Enter Mother ID">
                      <div style="color: rgb(196, 3, 3)">{{ $errors->first('mother_id') }}</div>
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