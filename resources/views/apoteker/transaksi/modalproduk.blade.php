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
                                    <th>Kategori</th>
                                    <th>Harga Jual</th>
                                    <th>Aksi</th>
                                </thead>
                                <tbody>
                                    @foreach ($produk as $p)
                                    <td>{{ $p->name }}</td>
                                    <td>{{ $p->categori->name }}</td>
                                    <td>{{ $p->HargaRupiah }}</td>
                                    <td align="center" class="d-flex justify-content-evenly">
                                        <button class="btn btn-xs btn-info btn-flat"><i class="bi bi-pencil"></i></button>
                                    </td>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal"><i class="bi bi-x-circle"></i>&nbspClose</button>
                <button class="btn btn-success"><i class="bi bi-file-earmark-plus"></i>&nbspSubmit</button>
            </div>
        </div>
    </div>
</div>