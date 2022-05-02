        <nav class="sidebar sidebar-offcanvas" id="sidebar">
          <ul class="nav">
            <li class="nav-item nav-profile">
              <a href="#" class="nav-link">
                <div class="nav-profile-image">
                  <img src="{{ asset('assets/images/faces/face1.jpg') }}" alt="profile">
                  <span class="login-status online"></span>
                  <!--change to offline or busy as needed-->
                </div>
                <div class="nav-profile-text d-flex flex-column">
                  <span class="font-weight-bold mb-2">PayOneHub</span>
                  <span class="text-secondary text-small">Admin</span>
                </div>
                <i class="mdi mdi-bookmark-check text-success nav-profile-badge"></i>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="{{ url('admin/home') }}">
                <span class="menu-title">Dashboard</span>
                <i class="mdi mdi-home menu-icon"></i>
              </a>
            </li>
            @if(Auth::user()->role==1)
            <li class="nav-item">
              <a class="nav-link" href="{{ url('admin/list-staff') }}">
                <span class="menu-title">List Staff</span>
                <i class="mdi mdi-contacts menu-icon"></i>
              </a>
            </li>
            @endif
            <li class="nav-item">
              <a class="nav-link" href="{{ url('admin/list-customerdetails') }}">
                <span class="menu-title">Customer details</span>
                <i class="mdi mdi-contacts menu-icon"></i>
              </a>
            </li>
             <li class="nav-item">
              <a class="nav-link" href="{{ url('insurance/add-insurance') }}">
                <span class="menu-title">Create Insurance</span>
                <i class="mdi mdi-contacts menu-icon"></i>
              </a>
            </li>
          </ul>
        </nav>