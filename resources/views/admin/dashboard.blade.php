@extends('admin.partials.app')

@section('body')
<section class="section dashboard">
  <div class="row">
    <div class="col-lg-12">
      <div class="row">
        <!-- Card -->
        <div class="col-xxl-4 col-md-4">
          <div class="card info-card sales-card">
            <div class="card-body">
              <h5 class="card-title">Appointment Today</h5>
  
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
              <h5 class="card-title">Total AppointMent</h5>

              <div class="d-flex align-items-center">
                <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                  <i class="bi bi-briefcase-fill"></i>
                </div>
                <div class="ps-3">
                  <h6>{{ $total_appointment }}</h6>
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
              <h5 class="card-title">Total Pemasukan Bulan Ini</h5>
  
              <div class="d-flex align-items-center">
                <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                  <i class="bi bi-briefcase"></i>
                </div>
                <div class="ps-3">
                  <h6>{{ $total_pemasukan }}</h6>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- End Card -->
      </div>
    </div> 
    <div class="container">
      <div class="col-lg-12 card p-4">
        <div>
          <h5 class="text-dark">Filter Transaksi</h5>
        </div>
        <div class="row mb-4">
          <div class="col-md-4">
            <label for="tanggal_mulai">Pilih Tanggal Mulai</label>
            <input class="form-control" type="date" name="tanggal_mulai" id="tanggal_mulai">
          </div>
          <div class="col-md-4">
            <label for="tanggal_selesai">Pilih Tanggal Akhir</label>
            <input class="form-control" type="date" name="tanggal_selesai" id="tanggal_selesai">
          </div>
          <div class="col-md-4">
            {{-- <label for="tanggal_selesai">Pilih Tanggal Akhir</label> --}}
            {{-- <input class="form-control" type="date" name="tanggal_selesai" id="tanggal_selesai"> --}}
            <button id="cari" type="button" class="btn btn-success mt-4">Cari</button>
          </div>
        </div>
        <div id="parent">
          
        </div>
      </div>
    </div>
  </div>
</section>
@endsection
@push('scripts')
    <script>
        $('#tanggal_selesai').prop('disabled', true);
        $('#cari').prop('disabled', true);
        // let table;

        $('#tanggal_mulai').on('change', function() {
          $('#tanggal_selesai').prop('disabled', false);
        })

        $('#tanggal_selesai').on('change', function() {
          $('#cari').prop('disabled', false);
        })

        function table() {
          let tanggal_mulai = $('#tanggal_mulai').val();
          let tanggal_selesai = $('#tanggal_selesai').val();
          $('.table').DataTable({
              processing: true,
              autoWidth: false,
              printable: true,
              exportable: true,
              destroy: true,
              ajax: {
                  url: '{{ route('admin.index') }}',
                  data: function ( d ) {
                      d.tanggal_mulai = tanggal_mulai
                      d.tanggal_selesai = tanggal_selesai;
                  }
              },
              columns: [{
                      data: 'DT_RowIndex',
                      searchable: false,
                      sortable: false
                  },
                  {
                      data: 'invoice'
                  },
                  {
                      data: 'tanggal'
                  },
                  {
                      data: 'type'
                  },
                  {
                      data: 'pemasukan'
                  },
              ]
          });
        }

        $('#cari').on('click', function() {
          let tanggal_mulai = $('#tanggal_mulai').val();
          let tanggal_selesai = $('#tanggal_selesai').val();
          $('#parent').empty();
          $.ajax({
                url: `{{ route('admin-pemasukan.total') }}`,
                data: {
                  tanggal_mulai: tanggal_mulai,
                  tanggal_selesai: tanggal_selesai
                    },
                type: "GET",
                dataType: "JSON",
                success: function(data)
                {
                  var form = `<div id="child" class="col-lg-12">
                                <div class="row">
                                  <div class="col-md-12">
                                      <div class="box-body table-responsive">
                                          <table class="table table-stiped table-bordered">
                                              <thead>
                                                  <th width="5%">No</th>
                                                  <th>Invoice</th>
                                                  <th>Tanggal</th>
                                                  <th>Type</th>
                                                  <th>Pemasukan</th>
                                              </thead>
                                          </table>
                                      </div>
                                  </div>
                                </div>
                              </div>
                              <div class="col-lg-12">
                                <div class="mb-3 row">
                                  <div class="col-lg-2">
                                      <label for="pemasukan" class="form-label">Total Pemasukan :</label>
                                  </div>
                                  <div class="col-lg-4">
                                      <input value="${data}" type="text" id="pemasukan" class="form-control" readonly>
                                  </div>
                                </div>
                              </div>`
                  $('#parent').append(form);
                  table()
                }
            });
        })
    </script>
@endpush
