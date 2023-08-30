<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Apoteker - {{ $page }}</title>
  <meta content="" name="description">
  <meta content="" name="keywords">
  
  <!-- CSRF Token -->
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <!-- Google Fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
  <link href="https://cdn.datatables.net/v/bs5/jq-3.7.0/dt-1.13.5/fc-4.3.0/fh-3.4.0/r-2.5.0/datatables.min.css" rel="stylesheet"/>

  <!-- Template Main CSS File -->
  <link href="{{ asset('assets/css/style.css') }}" rel="stylesheet">
  @yield('css')
</head>

<body>
    <!-- ======= Header ======= -->
    <header id="header" class="header fixed-top d-flex align-items-center">
    
        <div class="d-flex align-items-center justify-content-between">
        <a href="{{ route('home') }}" class="logo d-flex align-items-center">
            <span class="d-none d-lg-block text-white">Dashboard</span>
        </a>
        <i class="bi bi-list toggle-sidebar-btn"></i>
        </div>
        <!-- End Logo -->
        @include('apoteker.partials.nav-apoteker')
    </header>
    <!-- End Header -->
  
    @include('apoteker.partials.side-apoteker')
  
    <main id="main" class="main">
  
      <div class="pagetitle">
        <h1>{{ $page }}</h1>
        <nav>
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
            <li class="breadcrumb-item active">{{ $page }}</li>
          </ol>
        </nav>
      </div>
      <!-- End Page Title -->
  
      <section class="section">
        @yield('body')
      </section>
  
    </main>
    <!-- End #main -->
  
    <!-- ======= Footer ======= -->
    @include('apoteker.partials.footer-apoteker')

    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

    <!-- Vendor JS Files -->
    <script src="https://code.jquery.com/jquery-3.7.0.min.js" integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=" crossorigin="anonymous"></script>
    <script src="https://cdn.datatables.net/v/bs5/jq-3.7.0/dt-1.13.5/fc-4.3.0/fh-3.4.0/r-2.5.0/datatables.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
    <!-- Template Main JS File -->
    @include('sweetalert::alert')
    <script src="{{ asset('assets/js/main.js') }}"></script>
    @yield('js')
    @stack('scripts')

</body>

</html>