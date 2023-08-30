<!-- ======= Sidebar ======= -->
<aside id="sidebar" class="sidebar">
  
  <ul class="sidebar-nav" id="sidebar-nav">
    <li class="nav-heading">Pages</li>
    <li class="nav-item">
      <a class="@if (Route::is('doktor.index')) nav-link @else nav-link collapsed @endif" href="{{ route('doktor.index') }}">
        <i class="bi bi-grid"></i>
        <span>Dashboard</span>
      </a>
    </li>
    <!-- End Dashboard Nav -->

    <li class="nav-heading">Menu</li>

    {{-- <li class="nav-item">
      <a class="@if (Route::is('setting.index')) nav-link @else nav-link collapsed @endif" href="{{ route('setting.index') }}">
        <i class="bi bi-buildings"></i>
        <span>Setting Toko</span>
      </a>
    </li>
    <li class="nav-item">
      <a class="@if (Route::is('product.index')) nav-link @else nav-link collapsed @endif" href="{{ route('product.index') }}">
        <i class="bi bi-cassette"></i>
        <span>Daftar Product</span>
      </a>
    </li> --}}
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