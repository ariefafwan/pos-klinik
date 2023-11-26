<div class="modal fade" id="modal-produk" tabindex="-1" role="dialog" aria-labelledby="modal-produk">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Pilih Produk</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12 mb-3">
                        <div class="box-body table-responsive">
                            <table class="table table-hover table-bordered">
                                <thead>
                                    <th>Nama Produk</th>
                                    <th>Harga Jual</th>
                                    <th width="15%">Jumlah</th>
                                    <th>Aksi</th>
                                </thead>
                                <tbody>
                                    @foreach ($produk as $p)
                                    <tr>
                                        <td>{{ $p->name }}</td>
                                        <td>{{ $p->HargaRupiah }}</td>
                                        {{-- <td><div id="#jumlahqty{{ $p->id }}">Tes</div></td> --}}
                                        <td><input id="jumlahqty{{ $p->id }}" name="qty" type="number" class="form-control input-sm quantity"></td>
                                        <td align="center" class="d-flex justify-content-evenly">
                                            <button onclick="pilihProduk({{ $p->id }})" class="btn btn-xs btn-info btn-flat"><i class="bi bi-plus-circle"></i></button>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>