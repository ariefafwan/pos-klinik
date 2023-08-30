@extends('apoteker.partials.app')

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
                            <button onclick="addForm('{{ route('categoriproduct.store') }}')"
                                class="btn btn-primary"><i class="bi bi-plus-circle"></i>&nbsp;Tambah</button>
                        </div>
                    </div>
                    <hr>
                    @include('apoteker.categori.create')
                    <div class="row">
                        <div class="col-md-12">
                            <div class="box-body table-responsive">
                                <table class="table table-stiped table-bordered">
                                    <thead>
                                        <th width="5%">No</th>
                                        <th>Nama Kategori Produk</th>
                                        <th>Aksi</th>
                                    </thead>
                                </table>
                            </div>
                        </div>
                    </div>
                    @include('apoteker.categori.edit')
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
                    url: '{{ route('categoriproduct.create') }}',
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
                        data: 'aksi',
                        searchable: false,
                        sortable: false
                    },
                ]
            });
        });

        function addForm(url) {
            $('#modal-create').modal('show');
            $('#modal-create .modal-title').text('Tambah Kategori Product');

            $('#modal-create form')[0].reset();
            $('#modal-create form').attr('action', url);
            $('#modal-create [name=_method]').val('post');
            $('#modal-create #nama_kategori').focus();
        }

        function editForm(url, id) {
            console.log(id)
            $('#modal-edit').modal('show');
            $('#modal-edit .modal-title').text('Edit Kategori');
            $('#modal-edit form')[0].reset();
            $('#modal-edit form').attr('action', url);
            $('#modal-edit #editnama_kategori').focus();
            let editid = id
            $.ajax({
                url: '/apoteker/categoriproduct/'+editid,
                type: "GET",
                dataType: "JSON",
                success: function(data)
                {
                    $('#editid').val(data.id);
                    $('#editnama_kategori').val(data.name);
                }
            })
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