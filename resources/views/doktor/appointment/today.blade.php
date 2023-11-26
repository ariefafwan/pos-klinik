@extends('doktor.partials.app')
@section('body')

@if($errors->any())
    <div class="alert alert-danger d-flex align-items-center alert-dismissible fade show" role="alert">
        <i class="bi bi-exclamation-triangle"></i>&nbsp;
        <div>
            @foreach($errors->all() as $error)
                {{ $error }}
            @endforeach
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    </div>
@endif

<div class="row justify-content-center">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <div class="container mt-3">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="col-md-12 mb-3">
                                <h4 class="text-center">AppointMent Today</h4>
                                <div class="box-body table-responsive">
                                    <table id="table" class="table table-stiped table-bordered">
                                        <thead>
                                            <th>No Tiket</th>
                                            <th>Jam</th>
                                            <th>Pasien</th>
                                            <th>Keluhan</th>
                                            <th>Mulai Diagnosa</th>
                                        </thead>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<section>
    <div class="modal fade" id="showmodal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Daftar Diagnosa Pasien</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div id="keluhan" class="modal-body">
                
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal"><i class="bi bi-x-circle"></i>&nbspClose</button>
                <button class="btn btn-success"><i class="bi bi-file-earmark-plus"></i>&nbspSubmit</button>
            </div>
            </div>
        </div>
    </div>
</section>
@endsection
@push('scripts')
    <script>
        let table;

        $(function () {
            table = $('#table').DataTable({
                processing: true,
                autoWidth: false,
                ajax: {
                    url: '{{ route('data.today') }}',
                },
                columns: [{
                        data: 'tiket',
                        searchable: false,
                        sortable: false
                    },
                    {
                        data: 'jam'
                    },
                    {
                        data: 'pasien.nama_lengkap'
                    },
                    {
                        data: 'keluhan'
                    },
                    {
                        data: 'aksi',
                        searchable: false,
                        sortable: false
                    },
                ]
            });
        });

        function showUser(id_user) {
            $.ajax({
                url: '/doktor/diagnosapasien/'+id_user,
                type: "GET",
                dataType: "JSON",
                success: function(data)
                {
                    $('#showmodal').modal('show');
                    let showKeluhan = `<table class="table table-stiped table-bordered">
                                            <thead>
                                                <th style="width: 15%">Tanggal AppointMent</th>
                                                <th>Keluhan</th>
                                            </thead>
                                            <tbody>
                                                ${data.map((res) => {
                                                    return `<tr>
                                                                <td>${res.appointment.tanggal}</td>
                                                                <td>${res.hasil}</td>
                                                            </tr>`
                                                })}
                                            </tbody>
                                        </table>`
                }
            })
            $('#keluhan').append(showKeluhan);
        }
    </script>
@endpush