@extends('services.partials.app')

@section('body')
<section class="section dashboard">
  <div class="row">
    <div class="col-lg-12">
      <div class="row">
        <!-- Card -->
        <div class="col-xxl-4 col-md-4">
          <div class="card info-card sales-card">
            <div class="card-body">
              <h5 class="card-title">Total Appointment Hari Ini</h5>
  
              <div class="d-flex align-items-center">
                <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                  <i class="bi bi-buildings"></i>
                </div>
                <div class="ps-3">
                  <h6>{{ $appointment_today }}</h6>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- End Card -->
        <!-- Card -->
        <div class="col-xxl-4 col-md-4">
          <div class="card info-card sales-card">
            <div class="card-body">
              <h5 class="card-title">Total Appointment Bulan Ini</h5>

              <div class="d-flex align-items-center">
                <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                  <i class="bi bi-briefcase-fill"></i>
                </div>
                <div class="ps-3">
                  <h6>{{ $appointment_bulanan }}</h6>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- End Card -->
        <!-- Card -->
        <div class="col-xxl-4 col-md-4">
          <div class="card info-card sales-card">
            <div class="card-body">
              <h5 class="card-title">Total Pemasukan Jasa Bulan Ini</h5>
  
              <div class="d-flex align-items-center">
                <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                  <i class="bi bi-briefcase"></i>
                </div>
                <div class="ps-3">
                  <h6>{{ $total_bulanan }}</h6>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- End Card -->
      </div>
    </div> 
  </div>
</section>
@endsection
