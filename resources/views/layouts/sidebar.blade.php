<?php
// set collapsed class
function isCollapsed(array $controllerNameArray)
{
    $c_con_array = explode('.', Route::currentRouteName());
    $current_controller = $c_con_array[0];
    if (in_array($current_controller, $controllerNameArray)) {
        echo 'menu-open';
    }
}

// set active class in main menu
function isMenuActive(array $controllerNameArray)
{
    $c_con_array = explode('.', Route::currentRouteName());
    $current_controller = $c_con_array[0];
    if (in_array($current_controller, $controllerNameArray)) {
        echo 'active';
    }
}

// set active class
function isActive($routeName)
{
    if (Route::currentRouteName() == $routeName) {
        echo 'active';
    }
}
?>

<aside class="main-sidebar sidebar-dark-primary elevation-4">
  <!-- Brand Logo -->
  <a href="index3.html" class="brand-link">
    {{-- <img src="/assets/dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
      style="opacity: .8"> --}}
    <span class="brand-text font-weight-light">EmployeeManagement</span>
  </a>

  <!-- Sidebar -->
  <div class="sidebar">
    <!-- Sidebar user panel (optional) -->
    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
      <div class="image">
        <img src="/assets/dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
      </div>
      <div class="info">
        <a href="#" class="d-block">{{ auth()->user()->name }}</a>
      </div>
    </div>

    <!-- Sidebar Menu -->
    <nav class="mt-2">
      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <!-- Add icons to the links using the .nav-icon class
           with font-awesome or any other icon font library -->
        <li class="nav-item">
          <a href="/" class="nav-link {{ isActive('dashboard') }}">
            <i class="nav-icon fas fa-tachometer-alt"></i>
            <p>
              Dashboard
            </p>
          </a>
        </li>

        {{-- <li class="nav-header">EXAMPLES</li> --}}
        <li class="nav-item">
          <a href="{{ route('employee') }}" class="nav-link {{ isActive('employee') }}">
            <i class="fas fa-city nav-icon"></i>
            <p>Employees</p>
          </a>
        </li>
        <li class="nav-item {{ isCollapsed(['countries', 'states', 'cities', 'departments']) }}">
          <a href="#" class="nav-link  {{ isMenuActive(['countries', 'states', 'cities', 'departments']) }}">
            <i class="nav-icon fas fa-cogs"></i>
            <p>
              System Management
              <i class="fas fa-angle-left right"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="{{ route('countries.index') }}" class="nav-link {{ isActive('countries.index') }}">
                <i class="fas fa-globe nav-icon"></i>
                <p>Country</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{ route('states.index') }}" class="nav-link {{ isActive('states.index') }}">
                <i class="fas fa-flag-usa nav-icon"></i>
                <p>State</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{ route('cities.index') }}" class="nav-link {{ isActive('cities.index') }}">
                <i class="fas fa-city nav-icon"></i>
                <p>City</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{ route('departments.index') }}" class="nav-link {{ isActive('departments.index') }}">
                <i class="fas fa-list-alt nav-icon"></i>
                <p>Department</p>
              </a>
            </li>
          </ul>
        </li>
      </ul>
    </nav>
    <!-- /.sidebar-menu -->
  </div>
  <!-- /.sidebar -->
</aside>
