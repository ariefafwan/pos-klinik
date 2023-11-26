<!-- ======= Sidebar ======= -->
<aside id="sidebar" class="sidebar">
  
  <ul class="sidebar-nav" id="sidebar-nav">
    <li class="nav-heading">Pages</li>
    <li class="nav-item">
      <a class="@if (Route::is('services.index')) nav-link @else nav-link collapsed @endif" href="{{ route('services.index') }}">
        <i class="bi bi-grid"></i>
        <span>Dashboard</span>
      </a>
    </li>
    <!-- End Dashboard Nav -->

    <li class="nav-heading">Menu</li>

    <li class="nav-item">
      <a class="@if (Route::is('pasien.index')) nav-link @else nav-link collapsed @endif" href="{{ route('pasien.index') }}">
        <i class="bi bi-buildings"></i>
        <span>Daftar Pasien</span>
      </a>
    </li>
    <li class="nav-item">
      <a class="@if (Route::is('jasa.index')) nav-link @else nav-link collapsed @endif" href="{{ route('jasa.index') }}">
        <i class="bi bi-buildings"></i>
        <span>Daftar Jasa</span>
      </a>
    </li>
    <li class="nav-item">
      <a class="@if (Route::is('appointment.index')) nav-link @else nav-link collapsed @endif" href="{{ route('appointment.index') }}">
        <i class="bi bi-buildings"></i>
        <span>Appointment</span>
      </a>
    </li>
    <li class="nav-item">
      <a class="@if (Route::is('services.appointment_all')) nav-link @else nav-link collapsed @endif" href="{{ route('services.appointment_all') }}">
        <i class="bi bi-cassette"></i>
        <span>Semua Appointment</span>
      </a>
    </li>
    <li class="nav-item">
      <a class="@if (Route::is('services-transaksi.index')) nav-link @else nav-link collapsed @endif" href="{{ route('services-transaksi.index') }}">
        <i class="bi bi-briefcase"></i>
        <span>Berobat Selesai</span>
      </a>
    </li>
    {{-- <li class="nav-item">
      <a class="@if (Route::is('data.index')) nav-link @else nav-link collapsed @endif" href="{{ route('data.index') }}">
        <i class="bi bi-briefcase"></i>
        <span>Data Kasus</span>
      </a>
    </li> --}}
    <!-- End Profile Page Nav -->

  </ul>

</aside>
<!-- End Sidebar-->