<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>AdminLTE 3 | Starter</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
  
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/admin-lte@3.1/dist/css/adminlte.min.css">
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
    <script src="https://kit.fontawesome.com/7adbf01c7f.js" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
  
  </head>
  <body class="hold-transition sidebar-mini">
    <div class="wrapper">

  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
      </li>
    </ul>
  </nav>

  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a class="brand-link">
      <span class="brand-text font-weight-light">Admin Dashboard</span>
    </a>

    <!-- Sidebar -->
    {{-- <div class="sidebar">
      <!-- Sidebar user (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block">Admin Name</a>
        </div>
      </div> --}}
    <div class="sidebar">
      <nav class="mt-2">
      <!-- Sidebar Menu -->
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <li class="nav-item">
            <a href="{{ route('dashboard') }}" class="nav-link">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Dashboard
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ route('admin.products.index') }}" class="nav-link">
              <i class="nav-icon fas fa-th"></i>
              <p>
                Product Management
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ route('admin.customers.index') }}" class="nav-link">
              <i class="nav-icon fas fa-users"></i>
              <p>
                Customer Management
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ route('admin.paymentindex') }}" class="nav-link">
              <i class="nav-icon fas fa-dollar-sign"></i>
              <p>
                Payment
              </p>
            </a>
          </li>
          <!-- In your HTML file -->
          <li class="nav-item">
            <a href="{{ route('admin.sales-report') }}" class="nav-link">
              <i class="nav-icon fas fa-chart-line"></i>
              <p>
                Sales Report
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ route('admin.manualorder') }}" class="nav-link">
                <i class="nav-icon fas fa-pencil-alt"></i>
                <p>
                    Manual Order
                </p>
            </a>
        </li>
        <li class="nav-item">
          <a href="{{ route('admin.warehouse') }}" class="nav-link">
              <i class="nav-icon fas fa-warehouse"></i>
              <p>
                  Warehouse
              </p>
          </a>
      </li>
        </ul>
      </nav>
           <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <section class="content">
      <div class="container-fluid">
        @yield('content')
      </div>
    </section>
  </div>


 
</div>
<!-- ./wrapper -->
<script src="{{ asset('js/bootstrap.bundle.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/admin-lte@3.1/dist/js/adminlte.min.js"></script>
</body>


</html>

