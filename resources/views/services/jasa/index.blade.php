@extends('services.partials.app')
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
                            <button onclick="addForm('{{ route('jasa.store') }}')"
                                class="btn btn-primary"><i class="bi bi-plus-circle"></i>&nbsp;Tambah</button>
                        </div>
                    </div>
                    <hr>
                    @include('services.jasa.create')
                    <div class="row">
                        <div class="col-md-12">
                            <div class="box-body table-responsive">
                                <table class="table table-stiped table-bordered">
                                    <thead>
                                        <th width="5%">No</th>
                                        <th>Nama Jasa</th>
                                        <th>Biaya Jasa</th>
                                        <th>Aksi</th>
                                    </thead>
                                </table>
                            </div>
                        </div>
                    </div>
                    @include('services.jasa.edit')
                    <form id="jasa-delete"
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

        $(function () {
            table = $('.table').DataTable({
                processing: true,
                autoWidth: false,
                ajax: {
                    url: '{{ route('jasa.index') }}',
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
                        data: 'biaya'
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
            $('#modal-create .modal-title').text('Tambah Jasa');

            $('#modal-create form')[0].reset();
            $('#modal-create form').attr('action', url);
            $('#modal-create [name=_method]').val('post');
            $('#modal-create #name').focus();
        }

        function editForm(url, id) {
            console.log(id)
            $('#modal-edit').modal('show');
            $('#modal-edit .modal-title').text('Edit Jasa');
            $('#modal-edit form')[0].reset();
            $('#modal-edit form').attr('action', url);
            $('#modal-edit #editnama_jasa').focus();
            let editid = id
            $.ajax({
                url: '/services/jasa/edit/'+editid,
                type: "GET",
                dataType: "JSON",
                success: function(data)
                {
                    $('#editid').val(data.id);
                    $('#editnama_jasa').val(data.name);
                    $('#editbiaya').val(data.biaya);
                }
            })
        }

        function deleteData(url) {
            $('#jasa-delete').attr('action', url)
            event.preventDefault();
            $('#jasa-delete').submit();
        }
    </script>
@endpush