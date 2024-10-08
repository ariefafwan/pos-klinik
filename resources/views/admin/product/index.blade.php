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
                            <button onclick="addForm('{{ route('admin-product.store') }}')"
                                class="btn btn-primary"><i class="bi bi-plus-circle"></i>&nbsp;Tambah</button>
                        </div>
                    </div>
                    <hr>
                    @include('admin.product.create')
                    <div class="row">
                        <div class="col-md-12">
                            {{-- <div class="col-md-3 mb-3">
                                <div class="form-group">
                                    <label>Filter Kategori Produk</label>
                                    <select class="form-select tipe" name="">
                                        @foreach($type as $index)
                                            <option value="{{ $index->categori->name }}">{{ $index->categori->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div> --}}
                            <div class="col-md-12">
                                <div class="box-body table-responsive">
                                    <table class="table table-stiped table-bordered">
                                        <thead>
                                            <th width="5%">No</th>
                                            <th>Nama Produk</th>
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
                    @include('admin.product.edit')
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
        let table;

        // function filterData() {
        //     $('.table').DataTable().search(
        //         $('.tipe').val()
        //     ).draw();
        // }
        // $('.tipe').on('change', function () {
        //     filterData();
        // });

        $(function () {
            table = $('.table').DataTable({
                processing: true,
                autoWidth: false,
                ajax: {
                    url: '{{ route('admin-product.data') }}',
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
                        data: 'hargabeli'
                    },
                    {
                        data: 'hargajual'
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
        });

        function addForm(url) {
            $('#modal-create').modal('show');
            $('#modal-create .modal-title').text('Tambah Product');

            $('#modal-create form')[0].reset();
            $('#modal-create form').attr('action', url);
            $('#modal-create [name=_method]').val('post');
            $('#modal-create #nama_produk').focus();
        }

        Route::get('/services/diagnosapasien/{id}', [DoktorController::class, 'diagnosapasien'])->name('diagnosapasien');

        function editForm(url, id) {
            $('#modal-edit').modal('show');
            $('#modal-edit .modal-title').text('Edit Kategori');
            $('#modal-edit form')[0].reset();
            $('#modal-edit form').attr('action', url);
            $('#modal-edit #nama_produk').focus();
            let editid = id
            $.ajax({
                url: '/admin/product/edit/'+editid,
                type: "GET",
                dataType: "JSON",
                success: function(data)
                {
                    $('#editid').val(data.id);
                    $('#editnama_produk').val(data.name);
                    // $('#editcategori_id').val(data.categori_id);
                    $('#editharga_beli').val(data.harga_beli);
                    $('#editharga_jual').val(data.harga_jual);
                    $('#editstock').val(data.stock);
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