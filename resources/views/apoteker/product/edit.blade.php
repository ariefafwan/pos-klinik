<div class="modal fade" id="modal-edit" tabindex="-1" role="dialog" aria-labelledby="modal-edit">
    <div class="modal-dialog modal-lg" role="document">
        <form action="" method="POST" class="col-lg-12" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title"></h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <input type="hidden" id="editid" name="id">
                    <div class="mb-3">
                        <label for="editnama_produk" class="form-label fw-bold">Nama Produk</label>
                        <div class="input-group has-validation">
                            <input type="text" class="form-control" id="editnama_produk" name="name"
                                placeholder="Masukkan Nama Produk..." required autofocus>
                            <div class="invalid-feedback">
                                Invalid Nama Produk
                            </div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="editcategori_id" class="form-label fw-bold">Tipe Produk</label>
                        <div class="input-group has-validation">
                            <select class="form-select" id="editcategori_id" name="categori_id" aria-label="Default select example">
                                <option selected>Pilih Kategori Produk</option>
                                @foreach ($categori as $kat)
                                    <option value="{{ $kat->id }}">{{ $kat->name }}</option>
                                @endforeach
                            </select>
                            <div class="invalid-feedback">
                                Invalid Select Tipe Produk
                            </div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="editharga_jual" class="form-label fw-bold">Harga Jual</label>
                        <div class="input-group has-validation">
                            <input type="number" class="form-control" id="editharga_jual" name="harga_jual"
                                placeholder="Masukkan Harga Produk...">
                            <div class="invalid-feedback">
                                Invalid Harga Jual Produk
                            </div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="editharga_beli" class="form-label fw-bold">Harga Beli</label>
                        <div class="input-group has-validation">
                            <input type="number" class="form-control" id="editharga_beli" name="harga_beli"
                                placeholder="Masukkan Harga Produk...">
                            <div class="invalid-feedback">
                                Invalid Harga Beli Produk
                            </div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="editstock" class="form-label fw-bold">Stock</label>
                        <div class="input-group has-validation">
                            <input type="number" class="form-control" id="editstock" name="stock"
                                placeholder="Masukkan Stock Produk...">
                            <div class="invalid-feedback">
                                Invalid Stock Produk
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal"><i
                            class="bi bi-x-circle"></i>&nbspClose</button>
                    <button class="btn btn-success"><i class="bi bi-file-earmark-plus"></i>&nbspSubmit</button>
                </div>
            </div>
        </form>
    </div>
</div>