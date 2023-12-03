@extends('admin.partials.app')
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
                        <div class="col-md-8">
                            <button onclick="addForm('{{ route('admin-appointment.store') }}')"
                                class="btn btn-primary"><i class="bi bi-plus-circle"></i>&nbsp;Tambah Appointment</button>
                        </div>
                    </div>
                    <hr>
                    @include('admin.appointment.create')
                    <div class="row">
                        <div class="col-md-12">
                            <div class="col-md-12">
                                {{-- <h4 class="text-center">Semua AppointMent</h4> --}}
                                <div class="box-body table-responsive">
                                    <table id="table" class="table table-stiped table-bordered">
                                        <thead>
                                            <th>No Tiket</th>
                                            <th>Jam</th>
                                            <th>Pasien</th>
                                            <th>Doktor</th>
                                            <th>Status</th>
                                            <th>Aksi</th>
                                        </thead>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    @include('admin.appointment.edit')
                    <form id="data-delete"
                        action="" method="POST"
                        style="display: none;">
                        @csrf
                        @method('DELETE')
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@push('scripts')
    <script>
        $(document).ready(function() {
          $('.select2').select2({
            theme: 'bootstrap-5'
          });
        });
        let table;

        $(function () {
            table = $('#table').DataTable({
                processing: true,
                autoWidth: false,
                ajax: {
                    url: '{{ route('admin-appointment.all') }}',
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
                        data: 'pasien'
                    },
                    {
                        data: 'doktor'
                    },
                    {
                        data: 'status'
                    },
                    {
                        data: 'aksi',
                        searchable: false,
                        sortable: false
                    },
                ]
            });
        });

        function addForm(url) {
            $('#modal-create').modal('show');
            $('#modal-create .modal-title').text('Tambah Data Appointment');

            $('#modal-create form')[0].reset();
            $('#modal-create form').attr('action', url);
            $('#modal-create [name=_method]').val('post');
        }

        function editForm(url, id) {
            console.log(url,id);
            $('#modal-edit').modal('show');
            $('#modal-edit .modal-title').text('Edit Data Appointment');
            $('#modal-edit form')[0].reset();
            $('#modal-edit form').attr('action', url);
            let editid = id
            $.ajax({
                url: '/admin/appointment/'+editid,
                type: "GET",
                dataType: "JSON",
                success: function(data)
                {
                    console.log(data);
                    $('#editid').val(data.id);
                    $('#editjam').val(data.jam);
                    $('#editpasien_id').append('<option value="'+ data.pasien_id +'">'+ data.pasien.nik +' - '+ data.pasien.nama_lengkap +'</option>');
                    $('#edituser_id').val(data.user_id);
                    $('#editstatus').val(data.status);
                    $('#edittanggal').val(data.tanggal);
                    $('#editkeluhan').val(data.keluhan);
                }
            })
        }

        function deleteData(url) {
            $('#data-delete').attr('action', url)
            event.preventDefault();
            $('#data-delete').submit();
        }
    </script>
@endpush