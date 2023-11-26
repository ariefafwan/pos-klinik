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
                            <form action="{{ route('diagnosa.store') }}" method="post" class="col-lg-12" enctype="multipart/form-data">
                                @csrf
                                @method('post')
                                <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                                <div class="mb-3">
                                    <label for="appointment_id" class="form-label fw-bold">Tiket</label>
                                    <div class="input-group has-validation">
                                        <select class="form-select" id="appointment_id" name="appointment_id" aria-label="Default select example">
                                            <option value="{{ $appointment->id }}">{{ $appointment->tiket }}</option>
                                        </select>
                                        <div class="invalid-feedback">
                                            Invalid Tiket
                                        </div>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label for="pasien_id" class="form-label fw-bold">Pasien</label>
                                    <div class="input-group has-validation">
                                        <select class="form-select" id="pasien_id" name="pasien_id" aria-label="Default select example">
                                            <option value="{{ $appointment->pasien_id }}">{{ $appointment->pasien->nik }} - {{ $appointment->pasien->nama_lengkap }}</option>
                                        </select>
                                        <div class="invalid-feedback">
                                            Invalid Pasien
                                        </div>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label for="hasil" class="form-label fw-bold">Hasil Diagnosa</label>
                                    <textarea class="form-control has-validation" name="hasil" id="hasil" rows="3"></textarea>
                                </div>
                                <div  class="mb-3">
                                    <label for="catatan" class="form-label fw-bold">Catatan Anda</label>
                                    <textarea class="form-control has-validation" name="catatan" id="catatan" rows="3"></textarea>
                                </div>
                                <div id="parent" class="mb-3">
                                </div>
                                <div class="mb-3">
                                    <button onclick="tambahJasa()" type="button" class="btn btn-primary"><i class="bi bi-file-earmark-plus"></i>&nbspTambah Biaya Jasa</button>
                                    <button onclick="tambahProduk()" type="button" class="btn btn-warning"><i class="bi bi-file-earmark-plus"></i>&nbspTambah Produk</button>
                                </div>
                                {{-- <div class="mb-3">
                                    <label for="biaya_jasa" class="form-label fw-bold">Biaya Jasa</label>
                                    <input type="text" class="form-control" id="biaya_jasa" name="biaya_jasa"
                                        placeholder="Masukkan Biaya Jasa...">
                                </div> --}}
                                <button type="submit" class="btn btn-success"><i class="bi bi-file-earmark-plus"></i>&nbspSubmit</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<section>
    <div class="modal fade" id="modaltambah" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <h5 id="headermodal" class="modal-title" id="staticBackdropLabel"></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12 mb-3">
                        <div class="box-body table-responsive">
                            <table id="tambah" class="table table-hover table-bordered">       
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            </div>
        </div>
    </div>
</section>
@endsection
@push('scripts')
    <script>
        function tambahJasa() {
            $.ajax({
                url: '/pilihjasa',
                type: "GET",
                dataType: "JSON",
                success: function(data)
                {
                    $('.modal-title').text('Tambah Jasa');
                    $('#tambah').empty();
                    let listjasa =    `<thead>
                                            <th>Nama Jasa</th>
                                            <th>Biaya</th>
                                            <th>Aksi</th>
                                        </thead>
                                        <tbody>
                                            ${data.map((res) => {
                                                return `<tr>
                                                            <td>${res.name}</td>
                                                            <td>${res.biaya}</td>
                                                            <td align="center" class="d-flex justify-content-evenly">
                                                                <button onclick="addJasa('${res.name}', ${res.biaya}, ${res.id})" class="btn btn-xs btn-info btn-flat"><i class="bi bi-plus-circle"></i></button>
                                                            </td>
                                                        </tr>`
                                            })}
                                        </tbody>`
                    $('#tambah').append(listjasa);
                    $('#modaltambah').modal('show');
                }
            })
        }
        function tambahProduk() {
            $.ajax({
                url: '/pilihproduct',
                type: "GET",
                dataType: "JSON",
                success: function(data)
                {
                    $('.modal-title').text('Tambah Produk');
                    $('#tambah').empty();
                    let listjasa =    `<thead>
                                            <th style="width: 25%">Nama Produk</th>
                                            <th style="width: 25%">Harga Beli</th>
                                            <th style="width: 25%">Harga Jual</th>
                                            <th style="width: 15%">Stock</th>
                                            <th style="width: 10%">Aksi</th>
                                        </thead>
                                        <tbody>
                                            ${data.map((res) => {
                                                return `<tr>
                                                            <td>${res.name}</td>
                                                            <td>${res.harga_beli}</td>
                                                            <td>${res.harga_jual}</td>
                                                            <td>${res.stock}</td>
                                                            <td align="center" class="d-flex justify-content-evenly">
                                                                <button type="button" onclick="addProduk('${res.name}', ${res.harga_jual}, ${res.id})" class="btn btn-xs btn-info btn-flat"><i class="bi bi-plus-circle"></i></button>
                                                            </td>
                                                        </tr>`
                                            })}
                                        </tbody>`
                    $('#tambah').append(listjasa);
                    $('#modaltambah').modal('show');
                }
            })
        }
        function addJasa(name, biaya, id) {
            $('#parent').append(`<table class="table table-stiped table-bordered">
                                        <tbody>
                                            <td style="width: 45%">${name}</td>
                                            <td style="width: 45%">${biaya}<input type="hidden" name="jasa[]" value="${id}"></td>
                                            <td style="width: 10%"><button type="button" id="deleteList" class="btn btn-xs btn-danger btn-flat"><i class="bi bi-trash"></i></button></td>
                                        </tbody>
                                </table>`);
            $('#modaltambah').modal('hide'); 
        }
        function addProduk(name, harga_jual, id) {
            $('#parent').append(`<table class="table table-stiped table-bordered">
                                        <tbody>
                                            <td style="width: 45%">${name}</td>
                                            <td style="width: 45%">${harga_jual}<input type="hidden" name="product[]" value="${id}"></td>
                                            <td style="width: 10%"><button type="button" id="deleteList" class="btn btn-xs btn-danger btn-flat"><i class="bi bi-trash"></i></button></td>
                                        </tbody>
                                </table>`);
            $('#modaltambah').modal('hide'); 
        }
        $('body').on('click', '#deleteList', function() {
                $(this).closest('.table').remove();
            });
    </script>
@endpush