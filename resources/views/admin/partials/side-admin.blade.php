<!-- ======= Sidebar ======= -->
<aside id="sidebar" class="sidebar">
  
  <ul class="sidebar-nav" id="sidebar-nav">
    <li class="nav-heading">Pages</li>
    <li class="nav-item">
      <a class="@if (Route::is('admin.index')) nav-link @else nav-link collapsed @endif" href="{{ route('admin.index') }}">
        <i class="bi bi-grid"></i>
        <span>Dashboard</span>
      </a>
    </li>
    <!-- End Dashboard Nav -->

    <li class="nav-heading">Menu</li>

    <li class="nav-item">
      <a class="@if (Route::is('admin-users.index')) nav-link @else nav-link collapsed @endif" href="{{ route('admin-users.index') }}">
        <i class="bi bi-buildings"></i>
        <span>Daftar User</span>
      </a>
    </li>
    <li class="nav-item">
      <a class="@if (Route::is('admin-pasien.index')) nav-link @else nav-link collapsed @endif" href="{{ route('admin-pasien.index') }}">
        <i class="bi bi-buildings"></i>
        <span>Daftar Pasien</span>
      </a>
    </li>
    <li class="nav-item">
      <a class="@if (Route::is('admin-product.index')) nav-link @else nav-link collapsed @endif" href="{{ route('admin-product.index') }}">
        <i class="bi bi-cassette"></i>
        <span>Daftar Product</span>
      </a>
    </li>
    <li class="nav-item">
      <a class="@if (Route::is('admin-jasa.index')) nav-link @else nav-link collapsed @endif" href="{{ route('admin-jasa.index') }}">
        <i class="bi bi-buildings"></i>
        <span>Daftar Jasa</span>
      </a>
    </li>
    <li class="nav-item">
      <a class="@if (Route::is('admin-appointment.index')) nav-link @else nav-link collapsed @endif" href="{{ route('admin-appointment.index') }}">
        <i class="bi bi-buildings"></i>
        <span>Appointment</span>
      </a>
    </li>
    <li class="nav-item">
      <a class="@if (Route::is('admin-appointment.all')) nav-link @else nav-link collapsed @endif" href="{{ route('admin-appointment.all') }}">
        <i class="bi bi-cassette"></i>
        <span>Semua Appointment</span>
      </a>
    </li>
    <li class="nav-item">
      <a class="@if (Route::is('admin-transaksi-jasa.index')) nav-link @else nav-link collapsed @endif" href="{{ route('admin-transaksi-jasa.index') }}">
        <i class="bi bi-briefcase"></i>
        <span>Berobat Selesai</span>
      </a>
    </li>
    <li class="nav-item">
      <a class="@if (Route::is('admin-transaksi-product.index')) nav-link @else nav-link collapsed @endif" href="{{ route('admin-transaksi-product.index') }}">
        <i class="bi bi-briefcase"></i>
        <span>Transaksi Pembelian</span>
      </a>
    </li>
    <!-- End Profile Page Nav -->

  </ul>

</aside>
<!-- End Sidebar-->