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
                            <button onclick="addForm('{{ route('admin-pasien.store') }}')"
                                class="btn btn-primary"><i class="bi bi-plus-circle"></i>&nbsp;Tambah Pasien</button>
                        </div>
                    </div>
                    <hr>
                    @include('admin.pasien.create')
                    <div class="row">
                        <div class="col-md-12">
                            <div class="box-body table-responsive">
                                <table class="table table-stiped table-bordered">
                                    <thead>
                                        <th width="5%">No</th>
                                        <th>Nama Lengkap</th>
                                        <th>NIK</th>
                                        <th>No HP</th>
                                        <th>Alamat</th>
                                        <th>Umur</th>
                                        <th>L/P</th>
                                        {{-- <th>Pekerjaan</th> --}}
                                        <th>Aksi</th>
                                    </thead>
                                </table>
                            </div>
                        </div>
                    </div>
                    @include('admin.pasien.edit')
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
<section>
    <div class="modal fade" id="showmodal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
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
            table = $('.table').DataTable({
                processing: true,
                autoWidth: false,
                ajax: {
                    url: '{{ route('admin-pasien.create') }}',
                },
                columns: [{
                        data: 'DT_RowIndex',
                        searchable: false,
                        sortable: false
                    },
                    {
                        data: 'nama_lengkap'
                    },
                    {
                        data: 'nik'
                    },
                    {
                        data: 'no_hp'
                    },
                    {
                        data: 'alamat'
                    },
                    {
                        data: 'umur'
                    },
                    {
                        data: 'gender'
                    },
                    // {
                    //     data: 'pekerjaan'
                    // },
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
            $('#modal-create .modal-title').text('Tambah Data Pasien');

            $('#modal-create form')[0].reset();
            $('#modal-create form').attr('action', url);
            $('#modal-create [name=_method]').val('post');
        }

        function showUser(id_user) {
            $.ajax({
                url: '/admin/diagnosapasien/'+id_user,
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

        function editForm(url, id) {
            $('#modal-edit').modal('show');
            $('#modal-edit .modal-title').text('Edit Data Pasien');
            $('#modal-edit form')[0].reset();
            $('#modal-edit form').attr('action', url);
            let editid = id
            $.ajax({
                url: '/admin/pasien/'+editid,
                type: "GET",
                dataType: "JSON",
                success: function(data)
                {
                    $('#editid').val(data.id);
                    $('#editnama_lengkap').val(data.nama_lengkap);
                    $('#editnik').val(data.nik);
                    $('#editno_hp').val(data.no_hp);
                    $('#editalamat').val(data.alamat);
                    $('#editjenis_kelamin').val(data.jenis_kelamin);
                    $('#editpekerjaan').val(data.pekerjaan);
                    $('#edittanggal_lahir').val(data.tanggal_lahir);
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