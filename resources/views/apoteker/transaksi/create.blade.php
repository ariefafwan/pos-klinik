@extends('apoteker.partials.app')
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
                        <div class="col-lg-12">
                            <div class="box">
                                <div class="box-body">
                                    <table class="table table-stiped table-bordered table-pembelian">
                                        <thead>
                                            <th width="5%">No</th>
                                            <th>Kode</th>
                                            <th>Nama</th>
                                            <th>Harga</th>
                                            <th width="15%">Jumlah</th>
                                            <th>Subtotal</th>
                                        </thead>
                                    </table>
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="row">
                                                <div class="col-lg-8">
                                                    <div class="tampil-bayar bg-primary text-white text-center">Rp.0</div>
                                                    <div class="tampil-terbilang">Rp. Rupiah</div>
                                                </div>
                                                <div class="col-lg-4">
                                                    <form action="" class="form-pembelian" method="post">
                                                        @csrf
                                                        {{-- <input type="hidden" name="id_pembelian" value="{{ $id_pembelian }}"> --}}
                                                        <input type="hidden" name="total" id="total">
                                                        <input type="hidden" name="total_item" id="total_item">
                                                        <input type="hidden" name="bayar" id="bayar">
                            
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
                                                                <input type="text" readonly class="form-control">
                                                            </div>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="d-flex justify-content-end">
                                <button type="submit" class="btn btn-primary btn-sm btn-flat btn-simpan"><i class="bi bi-file-earmark-plus"></i> Simpan Transaksi</button>
                            </div>
                        </div>
                    </div>
                    @include('apoteker.transaksi.modalproduk')
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@push('scripts')
    <script>
        function openModal() {
            $('#modal-produk').modal('show');
        }
    </script>
@endpush