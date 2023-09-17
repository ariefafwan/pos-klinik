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
                            <form action="{{ route('transaksi.store') }}" method="POST">
                                @csrf
                                @method('post')
                                <button type="submit" class="btn btn-primary"><i class="bi bi-plus-circle"></i>&nbsp;Tambah Transaksi</button>
                            </form>
                            {{-- <a href="" class="btn btn-primary"><i class="bi bi-plus-circle"></i>&nbsp;Tambah Transaksi</a> --}}
                            {{-- <button onclick="addForm('{{ route('product.store') }}')"
                                class="btn btn-primary"><i class="bi bi-plus-circle"></i>&nbsp;Tambah</button> --}}
                        </div>
                    </div>
                    <hr>
                    {{-- @include('apoteker.product.create') --}}
                    <div class="row">
                        <div class="col-md-12">
                            <div class="col-md-12">
                                <div class="box-body table-responsive">
                                    <table class="table table-stiped table-bordered">
                                        <thead>
                                            <th width="5%">No</th>
                                            <th>Invoice</th>
                                            <th>Tanggal</th>
                                            <th>Total Item</th>
                                            <th>Total Harga</th>
                                            <th>Pemasukan</th>
                                            <th>Aksi</th>
                                        </thead>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
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

        $(function () {
            table = $('.table').DataTable({
                processing: true,
                autoWidth: false,
                ajax: {
                    url: '{{ route('transaksi.data') }}',
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
                        data: 'total_item'
                    },
                    {
                        data: 'total_harga'
                    },
                    {
                        data: 'pemasukan'
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
            location.href = url;
        }
    </script>
@endpush