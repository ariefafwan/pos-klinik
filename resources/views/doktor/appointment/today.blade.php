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
                                            <th>Aksi</th>
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

        // function addForm(url) {
        //     $('#modal-create').modal('show');
        //     $('#modal-create .modal-title').text('Tambah Data Appointment');

        //     $('#modal-create form')[0].reset();
        //     $('#modal-create form').attr('action', url);
        //     $('#modal-create [name=_method]').val('post');
        // }

        // function editForm(url, id) {
        //     console.log(url,id);
        //     $('#modal-edit').modal('show');
        //     $('#modal-edit .modal-title').text('Edit Data Appointment');
        //     $('#modal-edit form')[0].reset();
        //     $('#modal-edit form').attr('action', url);
        //     let editid = id
        //     $.ajax({
        //         url: '/services/appointment/'+editid,
        //         type: "GET",
        //         dataType: "JSON",
        //         success: function(data)
        //         {
        //             console.log(data);
        //             $('#editid').val(data.id);
        //             $('#editjam').val(data.jam);
        //             $('#editpasien_id').append('<option value="'+ data.pasien_id +'">'+ data.pasien.nik +' - '+ data.pasien.nama_lengkap +'</option>');
        //             $('#edituser_id').val(data.user_id);
        //             $('#editstatus').val(data.status);
        //             $('#edittanggal').val(data.tanggal);
        //             $('#editkeluhan').val(data.keluhan);
        //         }
        //     })
        // }

        // function redirect(id) {
        //     let editid = id;
            
        //     let url = '{{ route('diagnosa.create', "<script><?") }}';
            
        //     console.log(url)
        //     // $('#link').click();
        // }
    </script>
@endpush