@extends('admin.partials.app')
@section('css')
    <style>
        .tampil-bayar {
        font-size: 4em;
        text-align: center;
        height: 100px;
    }

    .tampil-terbilang {
        padding: 10px;
        background: #f0f0f0;
    }

    .table-pembelian tbody tr:last-child {
        display: none;
    }

    @media(max-width: 768px) {
        .tampil-bayar {
            font-size: 3em;
            height: 70px;
            padding-top: 5px;
        }
    }
    </style>
@endsection
@section('body')

@if($errors->any())
    <div class="alert alert-danger d-flex align-items-center alert-dismissible fade show" role="alert">
        <i class="bi bi-exclamation-triangle"></i>&nbsp;
        <div>
            @foreach($errors->all() as $error)
                {{ $error }}
            @endforeach
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
                            <button onclick="openModal()" class="btn btn-primary"><i class="bi bi-plus-circle"></i>&nbsp;Tambah Produk</button>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <form id="form-item" method="post">
                            @csrf
                            @method('POST')
                            <input type="hidden" name="id_produk" id="id_produk">
                            <input type="hidden" name="transaksi_id" id="id_transaksi" value="{{ $id_transaksi }}">
                            <input type="hidden" name="qty" id="qtyproduk">
                        </form>
                        <div class="col-lg-12">
                            <div class="box">
                                <div class="box-body">
                                    <table id="table" class="table table-stiped table-bordered">
                                        <thead>
                                            <th width="5%">No</th>
                                            <th>Nama</th>
                                            <th>Harga</th>
                                            <th width="15%">Jumlah</th>
                                            <th>Subtotal</th>
                                            <th>Aksi</th>
                                        </thead>
                                    </table>
                                    <div class="row mt-4">
                                        <div class="col-lg-12">
                                            <div class="row">
                                                <div class="col-lg-8">
                                                    <div class="tampil-bayar bg-primary text-white text-center"></div>
                                                    <div class="tampil-terbilang"></div>
                                                </div>
                                                <div class="col-lg-4">
                                                    <div class="mb-3 row">
                                                        <div class="col-lg-4">
                                                            <label for="totalrp" class="form-label">Total</label>
                                                        </div>
                                                        <div class="col-lg-8">
                                                            <input type="text" id="totalrp" class="form-control" readonly>
                                                        </div>
                                                    </div>
                                                    <div class="form-group row mb-3">
                                                        <div class="col-lg-4">
                                                            <label for="bayar" class="form-label">Bayar</label>
                                                        </div>
                                                        <div class="col-lg-8">
                                                            <input type="text" id="bayarrp" class="form-control">
                                                        </div>
                                                    </div>
                                                    <div class="form-group row mb-3">
                                                        <div class="col-lg-4">
                                                            <label for="bayar" class="form-label">Kembalian</label>
                                                        </div>
                                                        <div class="col-lg-8">
                                                            <input type="text" id="kembalian" readonly class="form-control">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <form action="{{ route('admin-transaksi-product.update') }}" method="post">
                            @csrf
                            <input type="hidden" name="idtransaksi" value="{{ $id_transaksi }}">
                            <input type="hidden" name="total_harga" id="total">
                            <input type="hidden" name="total_item" id="total_item">
                            <input type="hidden" name="pemasukan" id="pemasukan">
                            <div class="d-flex justify-content-end">
                                <button type="submit" class="btn btn-primary btn-sm btn-flat btn-simpan"><i class="bi bi-file-earmark-plus"></i> Simpan Transaksi</button>
                            </div>
                            </form>
                        </div>
                    </div>
                    @include('admin.transaksi-product.modalproduk')
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
            table = $('#table').DataTable({
                processing: true,
                autoWidth: false,
                ajax: {
                    url: '{{ route('admin-transaksiitem-product.data', $id_transaksi) }}',
                },
                columns: [{
                        data: 'DT_RowIndex',
                        searchable: false,
                        sortable: false
                    },
                    {
                        data: 'nama_produk'
                    },
                    {
                        data: 'harga'
                    },
                    {
                        data: 'jumlah'
                    },
                    {
                        data: 'subtotal'
                    },
                    {
                        data: 'aksi',
                        searchable: false,
                        sortable: false
                    },
                ],
                dom: 'Brt',
                bSort: false,
                paginate: false
            });
        });
        function openModal() {
            $('#modal-produk').modal('show');
        }
        function hideModal() {
            $('#modal-produk').modal('hide');
        }
        function tambahProduk() {
            let data = $('.form-item').serialize()
            $.post('{{ route('admin-transaksiitem-product.store') }}', $('#form-item').serialize())
                .done(response => {        
                    // console.log(response);
                    loadForm($('#id_transaksi').val())
                    table.ajax.reload();
                })
                .fail(errors => {
                    alert('Tidak dapat menyimpan data');
                    console.log(errors);
            });
        }
        function pilihProduk(id) {
            let qty = $(`#jumlahqty${id}`).val();
            $('#id_produk').val(id);
            $('#qtyproduk').val(qty);
            tambahProduk();
            hideModal();
        }
        function loadForm(id) {
            // $('#total').val($('.total').text());
            // $('#total_item').val($('.total_item').text());

            $.get(`{{ url('/admin/transaksi-pembelian/loadform') }}/${id}`)
                .done(response => {
                    $('#totalrp').val(response.total_harga);
                    $('#total_item').val(response.total_item);
                    $('#total').val(response.total);
                    $('#pemasukan').val(response.pemasukan);
                    $('.tampil-bayar').text(response.total_harga);
                    $('.tampil-terbilang').text(response.terbilang);
                    // console.log($('#pemasukan').val());
                })
                .fail(errors => {
                    alert('Tidak dapat menampilkan data');
                    return;
                })
        }
        $('#bayarrp').on('keyup', function() {
            let total = parseInt($('#total').val());
            // console.log(total);
            
            let bayar = $(this).val();
            let kem = $('#kembalian').val('Rp. '+ String(bayar - total));
        });

        function deleteData(url) {
            $('#data-delete').attr('action', url)
            event.preventDefault();
            $('#data-delete').submit();
        }
        
        loadForm($('#id_transaksi').val())
    </script>
@endpush