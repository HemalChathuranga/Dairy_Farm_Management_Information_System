  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <a href="" class="brand-link" style="text-align: center !important">
      <span class="brand-text font-weight-light">
        @php
            echo date("Y-M-d");
        @endphp
      </span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="{{ '\uploads\profile_img\\' . Auth::user()->prof_pic }}" style="width:30px; hight:30px;" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="{{ url('profile') }}" class="d-block">{{ Auth::user()->first_name . ' ' . Auth::user()->last_name }}</a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          
          <!-- Admin Sidebar Menu -->
          @if (Auth::user()->role == 'Admin')
              <li class="nav-item">
                <a href="{{ url('admin/dashboard') }}" class="nav-link @if(Request::segment(2) == 'dashboard') ? active @endif">
                  <i class="nav-icon fas fa-tachometer-alt"></i>
                  <p>
                    Dashboard
                  </p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ url('admin/admin/list') }}" class="nav-link @if(Request::segment(2) == 'admin') ? active @endif">
                  <i class="nav-icon fas fa-user-shield"></i>
                  <p>
                    Admin
                  </p>
                </a>
              </li>

              <li class="nav-item @if(Request::segment(2) == 'manager' OR Request::segment(2) == 'officeStaff' OR Request::segment(2) == 'medicalStaff' OR Request::segment(2) == 'fieldStaff' OR Request::segment(2) == 'storesStaff') ? menu-open @endif">
                <a href="" class="nav-link @if(Request::segment(2) == 'manager' OR Request::segment(2) == 'officeStaff' OR Request::segment(2) == 'medicalStaff' OR Request::segment(2) == 'fieldStaff' OR Request::segment(2) == 'storesStaff') ? active @endif">
                  <i class="nav-icon fas fa-user-tie"></i>
                  <p>
                    User Management
                    <i class="right fas fa-angle-left"></i>
                  </p>
                </a>
                <ul class="nav nav-treeview">


                  <li class="nav-item">
                    <a href="{{ url('admin/manager/list') }}" class="nav-link @if(Request::segment(2) == 'manager') ? active @endif">
                      <i class="nav-icon fas"></i>
                      <i class="nav-icon fas fa-user-tie"></i>
                      <p>
                        Manager
                      </p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="{{ url('admin/officeStaff/list') }}" class="nav-link @if(Request::segment(2) == 'officeStaff') ? active @endif">
                      <i class="nav-icon fas"></i>
                      <i class="nav-icon fas fa-user-tie"></i>
                      <p>
                        Office Staff
                      </p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="{{ url('admin/medicalStaff/list') }}" class="nav-link @if(Request::segment(2) == 'medicalStaff') ? active @endif">
                      <i class="nav-icon fas"></i>
                      <i class="nav-icon fas fa-user-nurse"></i>
                      <p>
                        Medical Staff
                      </p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="{{ url('admin/fieldStaff/list') }}" class="nav-link @if(Request::segment(2) == 'fieldStaff') ? active @endif">
                      <i class="nav-icon fas"></i>
                      <i class="nav-icon fas fa-hat-cowboy"></i>
                      <p>
                        Field Staff
                      </p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="{{ url('admin/storesStaff/list') }}" class="nav-link @if(Request::segment(2) == 'storesStaff') ? active @endif">
                      <i class="nav-icon fas"></i>
                      <i class="nav-icon fas fa-user-tie"></i>
                      <p>
                        Stores Staff
                      </p>
                    </a>
                  </li>

                </ul>
              </li>

              <li class="nav-item">
                <a href="{{ url('admin/animal/animalMgt/list') }}" class="nav-link @if(Request::segment(3) == 'animalMgt') ? active @endif">
                  <i class="nav-icon fas fa-paw"></i>
                  <p>
                    Animal Management
                  </p>
                </a>
              </li>

              <li class="nav-item">
                <a href="{{ url('animal/animalInfo/view') }}" class="nav-link @if(Request::segment(2) == 'animalInfo') ? active @endif">
                  <i class="nav-icon fas fa-paw"></i>
                  <p>
                    Animal Info.
                  </p>
                </a>
              </li>

              <li class="nav-item @if(Request::segment(2) == 'milkParlor') ? menu-open @endif">
                <a href="" class="nav-link @if(Request::segment(2) == 'milkParlor') ? active @endif">
                  <i class="nav-icon fas fa-cow"></i>
                  <p>
                    Milk Parlor
                    <i class="right fas fa-angle-left"></i>
                  </p>
                </a>
                <ul class="nav nav-treeview">
                  <li class="nav-item">
                    <a href="{{ url('admin/milkParlor/add_milking_queue') }}" class="nav-link @if(Request::segment(3) == 'add_milking_queue') ? active @endif">
                      <i class="nav-icon fas"></i>
                      <i class="nav-icon fas fa-cow"></i>
                      <p>
                        Daily Milking
                      </p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="{{ url('admin/milkParlor/milking_info') }}" class="nav-link @if(Request::segment(3) == 'milking_info') ? active @endif">
                      <i class="nav-icon fas"></i>
                      <i class="nav-icon fas fa-list"></i>
                      <p>
                        Milking Info.
                      </p>
                    </a>
                  </li>
                </ul> 
              </li>


              <li class="nav-item @if(Request::segment(2) == 'ani_health') ? menu-open @endif">
                <a href="" class="nav-link @if(Request::segment(2) == 'ani_health') ? active @endif">
                  <i class="nav-icon fas fa-house-medical"></i>
                  <p>
                    Animal Health
                    <i class="right fas fa-angle-left"></i>
                  </p>
                </a>
                <ul class="nav nav-treeview">
                  <li class="nav-item">
                    <a href="{{ url('admin/ani_health/vaccin_monitor') }}" class="nav-link @if(Request::segment(3) == 'vaccin_monitor') ? active @endif">
                      <i class="nav-icon fas"></i>
                      <i class="nav-icon fas fa-syringe"></i>
                      <p>
                        Vaccination Monitor
                      </p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="{{ url('admin/ani_health/preg_monitor') }}" class="nav-link @if(Request::segment(3) == 'preg_monitor') ? active @endif">
                      <i class="nav-icon fas"></i>
                      <i class="nav-icon fas fa-hand-holding-heart"></i>
                      <p>
                        Pregnancy Monitor
                      </p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="{{ url('admin/ani_health/health_rec') }}" class="nav-link @if(Request::segment(3) == 'health_rec') ? active @endif">
                      <i class="nav-icon fas"></i>
                      <i class="nav-icon fas fa-file-medical"></i>
                      <p>
                        Health Records
                      </p>
                    </a>
                  </li>
                </ul> 
              </li>

              <li class="nav-item">
                <a href="{{ url('profile') }}" class="nav-link @if(Request::segment(1) == 'profile') ? active @endif">
                  <i class="nav-icon fas fa-address-card"></i>
                  <p>
                    Profile
                  </p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ url('logout') }}" class="nav-link">
                  <i class="nav-icon fas fa-arrow-down"></i>
                  <p>
                    Logout
                  </p>
                </a>
              </li>
          
          <!-- Manager Sidebar Menu -->
          @elseif (Auth::user()->role == 'Manager')
              <li class="nav-item">
                <a href="{{ url('manager/dashboard') }}" class="nav-link @if(Request::segment(2) == 'dashboard') ? active @endif">
                  <i class="nav-icon fas fa-tachometer-alt"></i>
                  <p>
                    Dashboard
                  </p>
                </a>
              </li>

              <li class="nav-item @if(Request::segment(2) == 'manager' OR Request::segment(2) == 'officeStaff' OR Request::segment(2) == 'medicalStaff' OR Request::segment(2) == 'fieldStaff' OR Request::segment(2) == 'storesStaff') ? menu-open @endif">
                <a href="" class="nav-link @if(Request::segment(2) == 'manager' OR Request::segment(2) == 'officeStaff' OR Request::segment(2) == 'medicalStaff' OR Request::segment(2) == 'fieldStaff' OR Request::segment(2) == 'storesStaff') ? active @endif">
                  <i class="nav-icon fas fa-user-tie"></i>
                  <p>
                    User Management
                    <i class="right fas fa-angle-left"></i>
                  </p>
                </a>
                <ul class="nav nav-treeview">

                  <li class="nav-item">
                    <a href="{{ url('manager/officeStaff/list') }}" class="nav-link @if(Request::segment(2) == 'officeStaff') ? active @endif">
                      <i class="nav-icon fas"></i>
                      <i class="nav-icon fas fa-user-tie"></i>
                      <p>
                        Office Staff
                      </p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="{{ url('manager/medicalStaff/list') }}" class="nav-link @if(Request::segment(2) == 'medicalStaff') ? active @endif">
                      <i class="nav-icon fas"></i>
                      <i class="nav-icon fas fa-user-nurse"></i>
                      <p>
                        Medical Staff
                      </p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="{{ url('manager/fieldStaff/list') }}" class="nav-link @if(Request::segment(2) == 'fieldStaff') ? active @endif">
                      <i class="nav-icon fas"></i>
                      <i class="nav-icon fas fa-hat-cowboy"></i>
                      <p>
                        Field Staff
                      </p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="{{ url('manager/storesStaff/list') }}" class="nav-link @if(Request::segment(2) == 'storesStaff') ? active @endif">
                      <i class="nav-icon fas"></i>
                      <i class="nav-icon fas fa-user-tie"></i>
                      <p>
                        Stores Staff
                      </p>
                    </a>
                  </li>
                </ul>
              </li>

              <li class="nav-item">
                <a href="{{ url('manager/animal/animalMgt/list') }}" class="nav-link @if(Request::segment(3) == 'animalMgt') ? active @endif">
                  <i class="nav-icon fas fa-paw"></i>
                  <p>
                    Animal Management
                  </p>
                </a>
              </li>

              <li class="nav-item">
                <a href="{{ url('animal/animalInfo/view') }}" class="nav-link @if(Request::segment(2) == 'animalInfo') ? active @endif">
                  <i class="nav-icon fas fa-paw"></i>
                  <p>
                    Animal Info.
                  </p>
                </a>
              </li>

              <li class="nav-item @if(Request::segment(2) == 'milkParlor') ? menu-open @endif">
                <a href="" class="nav-link @if(Request::segment(2) == 'milkParlor') ? active @endif">
                  <i class="nav-icon fas fa-cow"></i>
                  <p>
                    Milk Parlor
                    <i class="right fas fa-angle-left"></i>
                  </p>
                </a>
                <ul class="nav nav-treeview">
                  <li class="nav-item">
                    <a href="{{ url('manager/milkParlor/milking_info') }}" class="nav-link @if(Request::segment(3) == 'milking_info') ? active @endif">
                      <i class="nav-icon fas"></i>
                      <i class="nav-icon fas fa-list"></i>
                      <p>
                        Milking Info.
                      </p>
                    </a>
                  </li>
                </ul> 
              </li>

              <li class="nav-item">
                <a href="{{ url('profile') }}" class="nav-link @if(Request::segment(1) == 'profile') ? active @endif">
                  <i class="nav-icon fas fa-address-card"></i>
                  <p>
                    Profile
                  </p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ url('logout') }}" class="nav-link">
                  <i class="nav-icon fas fa-arrow-down"></i>
                  <p>
                    Logout
                  </p>
                </a>
              </li>



          <!-- Office Staff Sidebar Menu -->
          @elseif (Auth::user()->role == 'Office Staff')
              <li class="nav-item">
                <a href="{{ url('officeStaff/dashboard') }}" class="nav-link @if(Request::segment(2) == 'dashboard') ? active @endif">
                  <i class="nav-icon fas fa-tachometer-alt"></i>
                  <p>
                    Dashboard
                  </p>
                </a>
              </li>

              <li class="nav-item">
                <a href="{{ url('officeStaff/animal/animalMgt/list') }}" class="nav-link @if(Request::segment(3) == 'animalMgt') ? active @endif">
                  <i class="nav-icon fas fa-paw"></i>
                  <p>
                    Animal Management
                  </p>
                </a>
              </li>

              <li class="nav-item">
                <a href="{{ url('animal/animalInfo/view') }}" class="nav-link @if(Request::segment(2) == 'animalInfo') ? active @endif">
                  <i class="nav-icon fas fa-paw"></i>
                  <p>
                    Animal Info.
                  </p>
                </a>
              </li>

              <li class="nav-item">
                <a href="{{ url('profile') }}" class="nav-link @if(Request::segment(1) == 'profile') ? active @endif">
                  <i class="nav-icon fas fa-address-card"></i>
                  <p>
                    Profile
                  </p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ url('logout') }}" class="nav-link">
                  <i class="nav-icon fas fa-arrow-down"></i>
                  <p>
                    Logout
                  </p>
                </a>
              </li>



          <!-- Medical Staff Sidebar Menu -->
          @elseif (Auth::user()->role == 'Medical Staff')
              <li class="nav-item">
                <a href="{{ url('medicalStaff/dashboard') }}" class="nav-link @if(Request::segment(2) == 'dashboard') ? active @endif">
                  <i class="nav-icon fas fa-tachometer-alt"></i>
                  <p>
                    Dashboard
                  </p>
                </a>
              </li>

              <li class="nav-item">
                <a href="{{ url('animal/animalInfo/view') }}" class="nav-link @if(Request::segment(2) == 'animalInfo') ? active @endif">
                  <i class="nav-icon fas fa-paw"></i>
                  <p>
                    Animal Info.
                  </p>
                </a>
              </li>

              <li class="nav-item @if(Request::segment(2) == 'ani_health') ? menu-open @endif">
                <a href="" class="nav-link @if(Request::segment(2) == 'ani_health') ? active @endif">
                  <i class="nav-icon fas fa-house-medical"></i>
                  <p>
                    Animal Health
                    <i class="right fas fa-angle-left"></i>
                  </p>
                </a>
                <ul class="nav nav-treeview">
                  <li class="nav-item">
                    <a href="{{ url('medicalStaff/ani_health/vaccin_monitor') }}" class="nav-link @if(Request::segment(3) == 'vaccin_monitor') ? active @endif">
                      <i class="nav-icon fas"></i>
                      <i class="nav-icon fas fa-syringe"></i>
                      <p>
                        Vaccination Monitor
                      </p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="{{ url('medicalStaff/ani_health/preg_monitor') }}" class="nav-link @if(Request::segment(3) == 'preg_monitor') ? active @endif">
                      <i class="nav-icon fas"></i>
                      <i class="nav-icon fas fa-hand-holding-heart"></i>
                      <p>
                        Pregnancy Monitor
                      </p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="{{ url('medicalStaff/ani_health/health_rec') }}" class="nav-link @if(Request::segment(3) == 'health_rec') ? active @endif">
                      <i class="nav-icon fas"></i>
                      <i class="nav-icon fas fa-file-medical"></i>
                      <p>
                        Health Records
                      </p>
                    </a>
                  </li>
                </ul> 
              </li>

              <li class="nav-item">
                <a href="{{ url('profile') }}" class="nav-link @if(Request::segment(1) == 'profile') ? active @endif">
                  <i class="nav-icon fas fa-address-card"></i>
                  <p>
                    Profile
                  </p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ url('logout') }}" class="nav-link">
                  <i class="nav-icon fas fa-arrow-down"></i>
                  <p>
                    Logout
                  </p>
                </a>
              </li>



          <!-- Field Staff Sidebar Menu -->
          @elseif (Auth::user()->role == 'Field Staff')
              <li class="nav-item">
                <a href="{{ url('fieldStaff/dashboard') }}" class="nav-link @if(Request::segment(2) == 'dashboard') ? active @endif">
                  <i class="nav-icon fas fa-tachometer-alt"></i>
                  <p>
                    Dashboard
                  </p>
                </a>
              </li>
              
              <li class="nav-item">
                <a href="{{ url('animal/animalInfo/view') }}" class="nav-link @if(Request::segment(2) == 'animalInfo') ? active @endif">
                  <i class="nav-icon fas fa-paw"></i>
                  <p>
                    Animal Info.
                  </p>
                </a>
              </li>

              <li class="nav-item @if(Request::segment(2) == 'milkParlor') ? menu-open @endif">
                <a href="" class="nav-link @if(Request::segment(2) == 'milkParlor') ? active @endif">
                  <i class="nav-icon fas fa-cow"></i>
                  <p>
                    Milk Parlor
                    <i class="right fas fa-angle-left"></i>
                  </p>
                </a>
                <ul class="nav nav-treeview">
                  <li class="nav-item">
                    <a href="{{ url('fieldStaff/milkParlor/add_milking_queue') }}" class="nav-link @if(Request::segment(3) == 'add_milking_queue') ? active @endif">
                      <i class="nav-icon fas"></i>
                      <i class="nav-icon fas fa-cow"></i>
                      <p>
                        Daily Milking
                      </p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="{{ url('fieldStaff/milkParlor/milking_info') }}" class="nav-link @if(Request::segment(3) == 'milking_info') ? active @endif">
                      <i class="nav-icon fas"></i>
                      <i class="nav-icon fas fa-list"></i>
                      <p>
                        Milking Info.
                      </p>
                    </a>
                  </li>
                </ul> 
              </li>


              <li class="nav-item">
                <a href="{{ url('profile') }}" class="nav-link @if(Request::segment(1) == 'profile') ? active @endif">
                  <i class="nav-icon fas fa-address-card"></i>
                  <p>
                    Profile
                  </p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ url('logout') }}" class="nav-link">
                  <i class="nav-icon fas fa-arrow-down"></i>
                  <p>
                    Logout
                  </p>
                </a>
              </li>

          <!-- Stores Staff Sidebar Menu -->
          @elseif (Auth::user()->role == 'Stores Staff')
              <li class="nav-item">
                <a href="{{ url('storesStaff/dashboard') }}" class="nav-link @if(Request::segment(2) == 'dashboard') ? active @endif">
                  <i class="nav-icon fas fa-tachometer-alt"></i>
                  <p>
                    Dashboard
                  </p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ url('profile') }}" class="nav-link @if(Request::segment(1) == 'profile') ? active @endif">
                  <i class="nav-icon fas fa-address-card"></i>
                  <p>
                    Profile
                  </p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ url('logout') }}" class="nav-link">
                  <i class="nav-icon fas fa-arrow-down"></i>
                  <p>
                    Logout
                  </p>
                </a>
              </li>
          @endif
          
          
          
          
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>