@extends('layouts.app')

@section('content')
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">{{ Auth::user()->role }} Dashboard</h1>
          </div>
        </div>
      </div>
    </div>
    <!-- /.content-header -->    
    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">

        {{-- User Management --}}
        <div class="row">
          <h5>User Management</h5>
          <div class="col-lg-2 col-6">
            <div class="small-box bg-info">
              <div class="inner">
                <h3>{{ $adminCount }}</h3>
                <p>Active Admins</p>
              </div>
              <div class="icon">
                <i class="fa-solid fa-user-shield"></i>
              </div>
              <a href="{{ url('admin/admin/list') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          
          <div class="col-lg-2 col-6">
            <div class="small-box bg-success">
              <div class="inner">
                <h3>{{ $managerCount }}</h3>
                <p>Active Managers</p>
              </div>
              <div class="icon">
                <i class="fa-solid fa-user-tie"></i>
              </div>
              <a href="{{ url('admin/manager/list') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
         
          <div class="col-lg-2 col-6">
            <div class="small-box bg-warning">
              <div class="inner">
                <h3>{{ $officeStaffCount }}</h3>
                <p>Active Office Staff</p>
              </div>
              <div class="icon">
                <i class="fa-solid fa-user-tie"></i>
              </div>
              <a href="{{ url('admin/officeStaff/list') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
        
          <div class="col-lg-2 col-6">
            <div class="small-box bg-danger">
              <div class="inner">
                <h3>{{ $medicalStaffCount }}</h3>
                <p>Active Medical Staff</p>
              </div>
              <div class="icon">
                <i class="fa-solid fa-user-nurse"></i>
              </div>
              <a href="{{ url('admin/medicalStaff/list') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>

          <div class="col-lg-2 col-6">
            <div class="small-box bg-secondary">
              <div class="inner">
                <h3>{{ $filedStaffCount }}</h3>
                <p>Active Field Staff</p>
              </div>
              <div class="icon">
                <i class="fa-solid fa-hat-cowboy"></i>
              </div>
              <a href="{{ url('admin/fieldStaff/list') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>

          <div class="col-lg-2 col-6">
            <div class="small-box bg-light">
              <div class="inner">
                <h3>{{ $storesStaffCount }}</h3>
                <p>Active Stores Staff</p>
              </div>
              <div class="icon">
                <i class="fa-solid fa-user-tie"></i>
              </div>
              <a href="{{ url('admin/storesStaff/list') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
        </div>
        {{-- User Management --}}

        <hr>

        {{-- Animal Info --}}

        <div class="row">
          <div class="col-4">
            <div class="row">
              <h5>Animal Information</h5>
    
              <div class="col-lg-12 col-6">
                <div class="small-box bg-dark">
                  <div class="inner">
                    <h3>{{ $stallCount }}</h3>
                    <p>Total Stalls</p>
                  </div>
                  <div class="icon">
                    <i class="fa-solid fa-house"></i>
                  </div>
                  <a href="{{ url('admin/animal/animalMgt/list') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                </div>
              </div>
  
            </div>

            <div class="row">
   
              <div class="col-lg-12 col-6">
                <div class="small-box bg-danger">
                  <div class="inner">
                    <h3>{{ $totalBullCount }}</h3>
                    <p>Total Bulls</p>
                  </div>
                  <div class="icon">
                    <i class="ion-male"></i>
                  </div>
                  <a href="{{ url('admin/animal/animalMgt/list') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                </div>
              </div>
            </div>

          </div>
          <div class="col-8">
            <div class="row">
              <h5 style="color: white">1</h5>
              <div class="col-lg-12 col-6">
                <div class="small-box bg-success">
                  <div class="inner">
                    <h3>{{ $totalCowCount }}</h3>
                    <p>Total Cows</p>
                  </div>
                  <div class="icon">
                    <i class="ion-female"></i>
                  </div>
                  <a href="{{ url('admin/animal/animalMgt/list') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                </div>
              </div>
            </div>

            <div class="row">
              <div class="col-lg-4 col-6">
                <div class="small-box bg-light">
                  <div class="inner">
                    <h3>{{ $totalMilkingCowCount }}</h3>
                    <p>Milking Cows</p>
                  </div>
                  <div class="icon">
                    <i class="fa-solid fa-cow text-primary"></i>
                  </div>
                  <a href="{{ url('admin/animal/animalMgt/list') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                </div>
              </div>

              <div class="col-lg-4 col-6">
                <div class="small-box bg-light">
                  <div class="inner">
                    <h3>{{ $totalNonMilkingCowCount }}</h3>
                    <p>Non-Milking Cows</p>
                  </div>
                  <div class="icon">
                    <i class="fa-solid fa-cow text-secondary"></i>
                  </div>
                  <a href="{{ url('admin/animal/animalMgt/list') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                </div>
              </div>

              <div class="col-lg-4 col-6">
                <div class="small-box bg-light">
                  <div class="inner">
                    <h3>{{ $totalPregCowCount }}</h3>
                    <p>Pregnant Cows</p>
                  </div>
                  <div class="icon">
                    <i class="fa-solid fa-cow text-danger"></i>
                  </div>
                  <a href="{{ url('admin/animal/animalMgt/list') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                </div>
              </div>
            </div>
          </div>
        </div>

        {{-- Animal Info --}}

        <hr>

        {{-- Milking Info. --}}

        <div class="row">

          <div class="col-md-6">
            <h5>Daiily Milking  Summary</h5>

            <a href="{{ url('admin/milkParlor/milking_info') }}">
              <div class="info-box mb-3 bg-info">
                <span class="info-box-icon"><i class="fa-solid fa-cloud-sun"></i></span>
                <div class="info-box-content">
                  <span class="info-box-text">Morning Yield(l) - (%)</span>
                  <span class="info-box-number">{{ $todayMorMilk }} l - ({{ (($todayMorMilk+$todayEveMilk) == 0) ? '0.00': number_format(($todayMorMilk/($todayMorMilk+$todayEveMilk)*100), 2) }} %)</span>
                </div>
              </div>
            </a>

            <a href="{{ url('admin/milkParlor/milking_info') }}">
              <div class="info-box mb-3 bg-warning">
                <span class="info-box-icon"><i class="fa-solid fa-cloud-moon"></i></span>
                <div class="info-box-content">
                  <span class="info-box-text">Evening Yield(l) - (%)</span>
                  <span class="info-box-number">{{ $todayEveMilk }} l - ({{ (($todayMorMilk+$todayEveMilk) == 0) ? '0.00': number_format(($todayEveMilk/($todayMorMilk+$todayEveMilk)*100), 2) }} %)</span>
                </div>
              </div>
            </a>

          </div>

          <div class="col-md-6">
            <h5>Weekly Milking Summary</h5>

            <a href="{{ url('admin/milkParlor/milking_info') }}">
              <div class="info-box mb-3 bg-success">
                <span class="info-box-icon"><i class="fa-solid fa-cloud-sun"></i></span>
                <div class="info-box-content">
                  <span class="info-box-text">Morning Yield(l) - (%)</span>
                  <span class="info-box-number">{{ $weekMorMilk }} l - ({{ (($weekMorMilk+$weekEveMilk) == 0) ? '0.00': number_format(($weekMorMilk/($weekMorMilk+$weekEveMilk)*100), 2) }} %)</span>
                </div>
              </div>
            </a>

            <a href="{{ url('admin/milkParlor/milking_info') }}">
              <div class="info-box mb-3 bg-danger">
                <span class="info-box-icon"><i class="fa-solid fa-cloud-moon"></i></span>
                <div class="info-box-content">
                  <span class="info-box-text">Evening Yield(l) - (%)</span>
                  <span class="info-box-number">{{ $weekEveMilk }} l - ({{ (($weekMorMilk+$weekEveMilk) == 0) ? '0.00': number_format(($weekEveMilk/($weekMorMilk+$weekEveMilk)*100), 2) }} %)</span>
                </div>
              </div>
            </a>
          </div>
        </div>

        {{-- Milking Info. --}}

        <hr>

        {{-- Health Info. --}}

        <div class="row">
          <h5>Medical Information Summary</h5>

          
            <div class="col-12 col-sm-6 col-md-3">
              <div class="info-box">
                <span class="info-box-icon bg-info elevation-1">
                  <a href="{{ url('admin/animal/animalMgt/list') }}">
                    <i class="fa-solid fa-cow"></i>
                  </a>
                </span>
                <div class="info-box-content">
                  <span class="info-box-text">New Birth this Week</span>
                  <span class="info-box-number">{{ $newBirthCount }}</span>
                </div>
              </div>
            </div>

          <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3">
              <span class="info-box-icon bg-danger elevation-1">
                <a href="{{ url('admin/ani_health/preg_monitor') }}">
                  <i class="ion-ios-pulse-strong"></i>
                </a>
              </span>
              <div class="info-box-content">
                <span class="info-box-text">Delivery due this Week</span>
                <span class="info-box-number">{{ $delDueCount }}</span>
              </div>
            </div>
          </div>

          <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3">
              <span class="info-box-icon bg-success elevation-1">
                <a href="{{ url('admin/ani_health/vaccin_monitor') }}">
                  <i class="fas fa-syringe"></i>
                </a>
              </span>
              <div class="info-box-content">
                <span class="info-box-text">Vaccination due this Week</span>
                <span class="info-box-number">{{ $vacDueCount }}</span>
              </div>
            </div>
          </div>

          <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3">
              <span class="info-box-icon bg-warning elevation-1">
                <a href="{{ url('admin/ani_health/treatment') }}">
                  <i class="fas fa-suitcase-medical"></i>
                </a>
              </span>
              <div class="info-box-content">
                <span class="info-box-text">Pending Treatments</span>
                <span class="info-box-number">{{ $pendingTreatmentCount }}</span>
              </div>
            </div>
          </div>
        </div>

        {{-- Health Info. --}}

        <hr>
        
        <!-- Main row -->
        <div class="row">
          <section class="col-lg-12 connectedSortable">

            <div class="card">
              <div class="card-header">
                <h3 class="card-title">
                  <i class="ion-arrow-graph-up-right"></i>
                  Daily Milk Production
                </h3>

              </div>
              <div class="card-body">
                <div>
                  <canvas id="myChart" style="width: 900px; height: 300px"></canvas>
                </div>
                
                
                <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
                <script>
                  const ctx = document.getElementById('myChart');

                  const labels = {!! json_encode($labels) !!};
                  const data = {!! json_encode($chartData) !!};
                
                  new Chart(ctx, {
                    type: 'line',
                    data: {
                      labels: labels,
                      datasets: [{
                        label: 'Milk Volume in (liter)',
                        data: data,
                        borderWidth: 1
                      }]
                    },
                    options: {
                      scales: {
                        y: {
                          beginAtZero: true
                        }
                      }
                    }
                  });
                </script>
                
              </div>
            </div>

          </section>

        </div>

      </div>
    </section>
  </div>
  
@endsection