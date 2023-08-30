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
                            <button onclick="addForm('{{ route('test.store') }}')"
                                class="btn btn-primary"><i class="bi bi-plus-circle"></i>&nbsp;Tambah</button>
                        </div>
                    </div>
                    <hr>
                    @include('admin.product.ctest')
                    <div class="row">
                        <div class="col-md-12">
                            <div class="col-md-2 mb-3">
                                <div class="form-group">
                                    <label>Pilih Tipe Produk</label>
                                    <select class="form-select tipe" name="">
                                        @foreach($type as $index)
                                            <option value="{{ $index->type }}">{{ $index->type }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="box-body table-responsive">
                                    <table class="table table-stiped table-bordered">
                                        <thead>
                                            <th width="5%">No</th>
                                            <th>Nama Produk</th>
                                            <th>Tipe</th>
                                            <th>Harga Beli</th>
                                            <th>Harga Jual</th>
                                            <th>Stock</th>
                                            <th>Diperbarui</th>
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

        function filterData() {
            $('.table').DataTable().search(
                $('.tipe').val()
            ).draw();
        }
        $('.tipe').on('change', function () {
            filterData();
        });

        $(function () {
            table = $('.table').DataTable({
                processing: true,
                autoWidth: false,
                ajax: {
                    url: '{{ route('test.data') }}',
                },
                columns: [{
                        data: 'DT_RowIndex',
                        searchable: false,
                        sortable: false
                    },
                    {
                        data: 'name'
                    },
                    {
                        data: 'type'
                    },
                    {
                        data: 'harga_beli'
                    },
                    {
                        data: 'harga_jual'
                    },
                    {
                        data: 'stock'
                    },
                    {
                        data: 'diperbarui'
                    },
                    {
                        data: 'aksi',
                        searchable: false,
                        sortable: false
                    },
                ]
            });

            $('#modal-form').validator().on('submit', function (e) {
                if (!e.preventDefault()) {
                    $.post($('#modal-form form').attr('action'), $('#modal-form form').serialize())
                        .done((response) => {
                            $('#modal-form').modal('hide');
                            table.ajax.reload();
                        })
                        .fail((errors) => {
                            alert('Tidak dapat menyimpan data');
                            return;
                        });
                }
            });
        });

        function addForm(url) {
            $('#modal-form').modal('show');
            $('#modal-form .modal-title').text('Tambah Kategori');

            $('#modal-form form')[0].reset();
            $('#modal-form form').attr('action', url);
            $('#modal-form [name=_method]').val('post');
            $('#modal-form [name=name]').focus();
        }

        function editForm(url) {
            $('#modal-form').modal('show');
            $('#modal-form .modal-title').text('Edit Kategori');

            $('#modal-form form')[0].reset();
            $('#modal-form form').attr('action', url);
            $('#modal-form [name=_method]').val('put');
            $('#modal-form [name=nama_kategori]').focus();

            $.get(url)
                .done((response) => {
                    $('#modal-form [name=nama_kategori]').val(response.nama_kategori);
                })
                .fail((errors) => {
                    alert('Tidak dapat menampilkan data');
                    return;
                });
        }

        function deleteData(url) {
            if (confirm('Yakin ingin menghapus data terpilih?')) {
                $.post(url, {
                        '_token': $('[name=csrf-token]').attr('content'),
                        '_method': 'delete'
                    })
                    .done((response) => {
                        table.ajax.reload();
                    })
                    .fail((errors) => {
                        alert('Tidak dapat menghapus data');
                        return;
                    });
            }
        }
    </script>
@endpush