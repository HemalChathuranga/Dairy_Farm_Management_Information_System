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
          <a href="#" class="d-block">{{ Auth::user()->first_name . ' ' . Auth::user()->last_name }}</a>
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
              <li class="nav-item">
                <a href="{{ url('admin/manager/list') }}" class="nav-link @if(Request::segment(2) == 'manager') ? active @endif">
                  <i class="nav-icon fas fa-user-tie"></i>
                  <p>
                    Manager
                  </p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ url('admin/officeStaff/list') }}" class="nav-link @if(Request::segment(2) == 'officeStaff') ? active @endif">
                  <i class="nav-icon fas fa-user-tie"></i>
                  <p>
                    Office Staff
                  </p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ url('admin/medicalStaff/list') }}" class="nav-link @if(Request::segment(2) == 'medicalStaff') ? active @endif">
                  <i class="nav-icon fas fa-user-nurse"></i>
                  <p>
                    Medical Staff
                  </p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ url('admin/fieldStaff/list') }}" class="nav-link @if(Request::segment(2) == 'fieldStaff') ? active @endif">
                  <i class="nav-icon fas fa-user-tie"></i>
                  <p>
                    Field Staff
                  </p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ url('admin/storesStaff/list') }}" class="nav-link @if(Request::segment(2) == 'storesStaff') ? active @endif">
                  <i class="nav-icon fas fa-user-tie"></i>
                  <p>
                    Stores Staff
                  </p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ url('admin/profile') }}" class="nav-link @if(Request::segment(2) == 'profile') ? active @endif">
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
              <li class="nav-item">
                <a href="{{ url('manager/profile') }}" class="nav-link @if(Request::segment(2) == 'profile') ? active @endif">
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
                <a href="{{ url('officeStaff/profile') }}" class="nav-link @if(Request::segment(2) == 'profile') ? active @endif">
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
                <a href="{{ url('medicalStaff/profile') }}" class="nav-link @if(Request::segment(2) == 'profile') ? active @endif">
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
                <a href="{{ url('fieldStaff/profile') }}" class="nav-link @if(Request::segment(2) == 'profile') ? active @endif">
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
                <a href="{{ url('storesStaff/profile') }}" class="nav-link @if(Request::segment(2) == 'profile') ? active @endif">
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