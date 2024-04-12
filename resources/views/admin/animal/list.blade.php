@extends('layouts.app')

@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Animal List</h1>
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
                <h3 class="card-title">Search Animal</h3>
              </div>
              <form action="" method="get">
                <div class="card-body">
                  <div class="row">
                    <div class="form-group col-md-3">
                      <label for="animal_type">Animal Type</label>
                      <select class="form-control" name="animal_type" id="animal_type">
                        <option {{ (Request::get('animal_type') == '') ? 'selected' : '' }} value="">All</option>
                        <option {{ (Request::get('animal_type') == 'cow') ? 'selected' : '' }} value="cow">Cow</option>
                        <option {{ (Request::get('animal_type') == 'heifer') ? 'selected' : '' }} value="heifer">Heifer</option>
                        <option {{ (Request::get('animal_type') == 'bull') ? 'selected' : '' }} value="bull">Bull</option>
                        <option {{ (Request::get('animal_type') == 'bull_calf') ? 'selected' : '' }} value="bull_calf">Bull Calf</option>
                      </select>
                    </div>
                    <div class="form-group col-md-3">
                      <label for="animal_id">Animal ID</label>
                      <input type="text" class="form-control" name="animal_id" id="animal_id" value="{{ Request::get('animal_id') }}" placeholder="Animal. ID">
                    </div>
                    <div class="form-group col-md-3">
                      <label for="breed">Breed</label>
                      {{-- <input type="text" class="form-control" name="breed" id="breed" value="{{ Request::get('breed') }}" placeholder="Breed"> --}}

                      <select class="form-control" name="breed" id="breed">
                        <option {{ (Request::get('breed') == '') ? 'selected' : '' }} value="">All Breed</option>
                        <option {{ (Request::get('breed') == 'Holstein') ? 'selected' : '' }} value="Holstein">Holstein</option>
                        <option {{ (Request::get('breed') == 'Friesian') ? 'selected' : '' }} value="Friesian">Friesian</option>
                        <option {{ (Request::get('breed') == 'Brahman') ? 'selected' : '' }} value="Brahman">Brahman</option>
                        <option {{ (Request::get('breed') == 'Mundi') ? 'selected' : '' }} value="Mundi">Mundi</option>
                        <option {{ (Request::get('breed') == 'Jersey') ? 'selected' : '' }} value="Jersey">Jersey</option>
                        <option {{ (Request::get('breed') == 'Holstein Friesian') ? 'selected' : '' }} value="Holstein Friesian">Holstein Friesian</option>
                        <option {{ (Request::get('breed') == 'Sindi') ? 'selected' : '' }} value="Sindi">Sindi</option>
                        <option {{ (Request::get('breed') == 'Sahiwal') ? 'selected' : '' }} value="Sahiwal">Sahiwal</option>
                      </select>
                    </div>
                  </div> 

                  <div class="row">
                    <div class="form-group col-md-3">
                      <label for="pregnant_status">Pregnancy</label>
                      {{-- <input type="text" class="form-control" name="pregnant_status" id="pregnant_status" value="{{ Request::get('pregnant_status') }}" placeholder="Pregnancy Status"> --}}

                      <select class="form-control" name="pregnant_status" id="pregnant_status">
                        <option {{ (Request::get('pregnant_status') == '') ? 'selected' : '' }} value="">All</option>
                        <option {{ (Request::get('pregnant_status') == 'Yes') ? 'selected' : '' }} value="Yes">Pregnant</option>
                        <option {{ (Request::get('pregnant_status') == 'No') ? 'selected' : '' }} value="No">Not Pregnant</option>
                      </select>
                    </div>

                    <div class="form-group col-md-3">
                      <label for="milking_status">Yield</label>
                      {{-- <input type="text" class="form-control" name="milking_status" id="milking_status" value="{{ Request::get('milking_status') }}" placeholder="Milking Status"> --}}
                      <select class="form-control" name="milking_status" id="milking_status">
                        <option {{ (Request::get('milking_status') == '') ? 'selected' : '' }} value="">All Yield</option>
                        <option {{ (Request::get('milking_status') == 'Milking') ? 'selected' : '' }} value="Milking">Milking</option>
                        <option {{ (Request::get('milking_status') == 'Non-Milking') ? 'selected' : '' }} value="Non-Milking">Non-Milking</option>
                        <option {{ (Request::get('milking_status') == 'Dry-Period') ? 'selected' : '' }} value="Dry-Period">Dry-Period</option>
                      </select>
                    </div>

                    <div class="form-group col-md-3">
                      <label for="status">Status</label>
                      {{-- <input type="text" class="form-control" name="status" id="status" value="{{ Request::get('status') }}" placeholder="Status"> --}}
                      <select class="form-control" name="status" id="status">
                        <option {{ (Request::get('status') == '') ? 'selected' : '' }} value="">All</option>
                        <option {{ (Request::get('status') == 'Active') ? 'selected' : '' }} value="Active">Active</option>
                        <option {{ (Request::get('status') == 'Inactive') ? 'selected' : '' }} value="Inactive">Inactive</option>
                      </select>
                    </div>
                    <div class="form-group col-md-3">
                      <button type="submit" class="btn btn-success" style="margin-top: 32px">Search</button>
                      <a href="{{ url('admin/animal/list') }}" class="btn btn-warning" style="margin-top: 32px">Reset</a>
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
                  <div class="input-group input-group-sm" style="width: 150px;">
                    <div>
                      <a href="{{ url('admin/animal/add') }}" class="btn btn-primary float-end"><i class="fas fa-plus"></i> New Animal</a>
                    </div>
                  </div>
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body table-responsive p-0">
                <table class="table table-hover text-nowrap">
                  <thead>
                    <tr>
                      <th>#</th>
                      <th>Animal ID</th>
                      <th>Breed</th>
                      <th>Gender</th>
                      <th>Date of Birth</th>
                      <th>Age</th>
                      <th>Stall No</th>
                      <th>Pregnancy<br>Status</th>
                      <th>Preg.<br>Occ</th>
                      <th>Yield</th>
                      <th>Status</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                  
                  @if ($isCalf)
                    @foreach ($fetchedRecord as $item)
                      @if ($item->age < 2)
                        <tr>
                          {{-- <td>{{ $item->age }}</td> --}}
                          <td>{{ ($fetchedRecord->currentPage() == 1) ? $loop->iteration : ($loop->iteration + 5) }}</td>
                          <td>{{ $item->animal_id }}</td>
                          <td>{{ $item->breed }}</td>
                          <td>{{ $item->gender }}</td>
                          <td>{{ $item->birth_date }}</td>
                          <td>
                            @php
                                $bday = new DateTime($item->birth_date);
                                $today = new DateTime(date('m.d.y'));
    
                                $diff = $today->diff($bday);
                                echo $diff->y.' Y | '.$diff->m.' M | '.$diff->d.' D';
                            @endphp
                          </td>
                          <td>{{ $item->stall_number }}</td>
                          <td><span class="{{($item->pregnant_status == "Yes") ? "badge badge-success" : "badge badge-warning"}}">{{ ($item->pregnant_status == "Yes") ? 'Pregnant' : 'Not Pregnant' }}</span></td>
                          <td>N/A</td>
                          <td><span class="{{($item->milking_status == "Milking") ? "badge badge-info" : "badge badge-secondary"}}">{{ $item->milking_status }}</span></td>
                          <td><span class="{{($item->status == "Active") ? "badge badge-success" : "badge badge-danger"}}">{{ $item->status }}</span></td>
                          <td>
                            <a href="{{ url('admin/animal/'.$item->id.'/view') }}" type="button" class="btn btn-outline-info btn-sm"><i class="fas fa-eye"></i></a>
                            <a href="{{ url('admin/animal/'.$item->id.'/edit') }}" type="button" class="btn btn-outline-warning btn-sm"><i class="fas fa-pen"></i></a>
                            <a href="{{ url('admin/animal/'.$item->id.'/delete') }}" type="button" class="btn btn-outline-danger btn-sm" onclick="return confirm('Are you sure you want to delete this Record?')"><i class="fas fa-trash"></i></a>
                          </td>
                        </tr>
                      @endif
                    @endforeach

                  @else
                      @foreach ($fetchedRecord as $item)
                      <tr>
                        {{-- <td>{{ $item->age }}</td> --}}
                        <td>{{ ($fetchedRecord->currentPage() == 1) ? $loop->iteration : ($loop->iteration + 5) }}</td>
                        <td>{{ $item->animal_id }}</td>
                        <td>{{ $item->breed }}</td>
                        <td>{{ $item->gender }}</td>
                        <td>{{ $item->birth_date }}</td>
                        <td>
                          @php
                              $bday = new DateTime($item->birth_date);
                              $today = new DateTime(date('m.d.y'));

                              $diff = $today->diff($bday);
                              echo $diff->y.' Y | '.$diff->m.' M | '.$diff->d.' D';
                          @endphp
                        </td>
                        <td>{{ $item->stall_number }}</td>
                        <td><span class="{{(($item->pregnant_status == "Yes") ? "badge badge-danger" : "badge badge-warning")}}">{{ ($item->pregnant_status == "Yes") ? 'Pregnant' : 'Not Pregnant' }}</span></td>
                        <td>{{ ($item->gender == "Female") ? $item->pregnancy_occ : 'N/A' }}</td>
                        <td><span class="{{($item->milking_status == "Milking") ? "badge badge-info" : "badge badge-secondary"}}">{{ $item->milking_status }}</span></td>
                        <td><span class="{{($item->status == "Active") ? "badge badge-success" : "badge badge-danger"}}">{{ $item->status }}</span></td>
                        <td>
                          <a href="{{ url('admin/animal/'.$item->id.'/view') }}" type="button" class="btn btn-outline-info btn-sm"><i class="fas fa-eye"></i></a>
                          <a href="{{ url('admin/animal/'.$item->id.'/edit') }}" type="button" class="btn btn-outline-warning btn-sm"><i class="fas fa-pen"></i></a>
                          <a href="{{ url('admin/animal/'.$item->id.'/delete') }}" type="button" class="btn btn-outline-danger btn-sm" onclick="return confirm('Are you sure you want to delete this Record?')"><i class="fas fa-trash"></i></a>
                        </td>
                      </tr>                      
                    @endforeach
                  @endif


                  
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