<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <title>e-Library</title>

  <link rel="stylesheet" href="/css/app.css">

</head>
<body class="hold-transition sidebar-mini control-sidebar-open text-sm pr-0">
<div class="wrapper" id="app">

  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
        </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <!-- Notifications Dropdown Menu -->
      <li class="nav-item dropdown">
        <a href="javascript:void(0)" class="user-panel h-auto py-0 nav-link" data-toggle="dropdown">
            <img
                src="{{ auth()->user()->user_image == null ? '/images/profile/user.png' : '/images/profile/'.auth()->user()->user_image }}"
                class="img-circle elevation-2"
                id="user_profile_picture"
                alt="User Image"
            >
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
            <span class="dropdown-header">Sign in as <br> <b>{{ auth()->user()->firstname ." ". auth()->user()->lastname }}</b></span>
            <div class="dropdown-divider"></div>
            <router-link to="/settings" class="dropdown-item">
                <i class="fas fa-cog mr-1"></i> Settings
            </router-link>
            <a class="dropdown-item" href="{{ route('logout') }}"
                onclick="event.preventDefault();
                document.getElementById('logout-form').submit();"
            >
                <i class="fas fa-sign-out-alt mr-1"></i> {{ __('Logout') }}
            </a>

            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
      </li>
    </ul>
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="#" class="brand-link">
      <img src="{{ asset('images/book.png') }}" alt="e-Library Logo" class="brand-image img-circle elevation-3"
           style="opacity: .8">
      <span class="brand-text font-weight-light">e-Library</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
            <img
                src="{{ auth()->user()->user_image == null ? '/images/profile/user.png' : '/images/profile/'.auth()->user()->user_image }}"
                class="img-circle elevation-2"
                id="user_profile_picture"
                alt="User Image"
            >
        </div>
        <div class="info">
          <a href="#" class="d-block">{{ auth()->user()->firstname ." ". auth()->user()->lastname }}</a>
          <small class="text-white">{{ auth()->user()->userType->name }}</small>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
            @php
                $items = array(
                    // text        Link    Icon            Class
                    "Dashboard" => ["/", "tachometer-alt", "", ""],
                    "Attendance" => ["/attendance", "clipboard-list", "", ""],
                    "Book Entry" => ["/book-entry", "book", "", ""],
                    "Issued & Return" => ["/issued-return", "paste", "", ""],
                    "Borrowers" => ["/borrowers", "book-reader", "", ""],
                    "User Management" => ["/user-management", "users-cog", "", "can-view-user-list"],
                    "Audit Log" => ["/audit-log", "history", "", ""],
                    "Reports" => ["/reports", "file-download", "", ""],
                );
            @endphp

            @foreach ($items as $item => [$link, $icon, $class, $authorize])
                @if (strlen($authorize) > 0)
                    @can($authorize)
                        {{-- menu will not show --}}
                    @endcan
                @else
                    <li class="nav-item">
                        <router-link to="{{ $link }}" class="nav-link {{ $class }}">
                            <i class="nav-icon fas fa-{{ $icon }}"></i>
                            <p>{{ $item }}</p>
                        </router-link>
                    </li>
                @endif
            @endforeach
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Starter Page</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
        <router-view></router-view>
        <vue-progress-bar></vue-progress-bar>
    </div>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <!-- Main Footer -->
  <footer class="main-footer">
    <!-- To the right -->
    <div class="float-right d-none d-sm-inline">
      e-Library
    </div>
    <!-- Default to the left -->
    <strong>Copyright &copy; 2020.</strong> All rights reserved.
  </footer>
</div>

@auth
    <script>
        window.userRole = @json(auth()->user()->userType->short_name)
    </script>
@endauth

<!-- ./wrapper -->
<script src="{{ asset('js/app.js') }}"></script>
</body>
</html>

<script>
    localStorage.setItem('userId', {{ auth()->user()->id }})

    if (!localStorage.getItem('userId')) {
        console.log("Logout...")
    }
</script>
