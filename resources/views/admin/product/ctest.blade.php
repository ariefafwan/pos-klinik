<div class="modal fade" id="modal-form" tabindex="-1" role="dialog" aria-labelledby="modal-form">
    <div class="modal-dialog modal-lg" role="document">
        <form action="" method="post" class="col-lg-12" enctype="multipart/form-data">
            @csrf
            @method('post')

            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    <h4 class="modal-title"></h4>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="nama_produk" class="form-label fw-bold">Nama Produk</label>
                        <div class="input-group has-validation">
                            <input type="text" class="form-control" id="nama_produk" name="name"
                                placeholder="Masukkan Nama Produk..." required autofocus>
                            <div class="invalid-feedback">
                                Invalid Nama Produk
                            </div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="type" class="form-label fw-bold">Tipe Produk</label>
                        <div class="input-group has-validation">
                            <select class="form-select" id="type" name="type" aria-label="Default select example">
                                <option selected>Pilih Tipe Produk</option>
                                <option value="Barang">Barang</option>
                                <option value="Service">Service</option>
                            </select>
                            <div class="invalid-feedback">
                                Invalid Select Tipe Produk
                            </div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="harga_jual" class="form-label fw-bold">Harga Jual</label>
                        <div class="input-group has-validation">
                            <input type="number" class="form-control" id="harga_jual" name="harga_jual"
                                placeholder="Masukkan Harga Produk...">
                            <div class="invalid-feedback">
                                Invalid Harga Jual Produk
                            </div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="harga_beli" class="form-label fw-bold">Harga Beli</label>
                        <div class="input-group has-validation">
                            <input type="number" class="form-control" id="harga_beli" name="harga_beli"
                                placeholder="Masukkan Harga Produk...">
                            <div class="invalid-feedback">
                                Invalid Harga Beli Produk
                            </div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="stock" class="form-label fw-bold">Stock</label>
                        <div class="input-group has-validation">
                            <input type="number" class="form-control" id="stock" name="stock"
                                placeholder="Masukkan Stock Produk...">
                            <div class="invalid-feedback">
                                Invalid Harga Beli Produk
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