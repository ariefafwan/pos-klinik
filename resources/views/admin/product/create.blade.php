<!-- Modal Untuk Tambah Data -->
<div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <form class="col-lg-12" action="{{ route('product.store' ) }}" method="post"
            enctype="multipart/form-data">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Tambah Data</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="nama_produk" class="form-label fw-bold">Nama Produk</label>
                        <input type="text" class="form-control" id="nama_produk" name="name"
                            placeholder="Masukkan Nama Produk...">
                    </div>
                    <div class="mb-3">
                        <label for="type" class="form-label fw-bold">Tipe Produk</label>
                        <select class="form-select" id="type" name="type" aria-label="Default select example">
                            <option selected>Pilih Tipe Produk</option>
                            <option value="Barang">Barang</option>
                            <option value="Service">Service</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="harga_beli" class="form-label fw-bold">Harga Beli</label>
                        <input type="number" class="form-control" id="harga_beli" name="harga_beli"
                            placeholder="Masukkan Harga Produk...">
                    </div>
                    <div class="mb-3">
                        <label for="harga_jual" class="form-label fw-bold">Harga Jual</label>
                        <input type="number" class="form-control" id="harga_jual" name="harga_jual"
                            placeholder="Masukkan Harga Produk...">
                    </div>
                    <div class="mb-3">
                        <label for="stock" class="form-label fw-bold">Stock</label>
                        <input type="number" class="form-control" id="stock" name="stock"
                            placeholder="Masukkan Stock Produk...">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal"><i
                            class="bi bi-x-circle"></i>&nbspClose</button>
                    <button type="submit" class="btn btn-success"><i
                            class="bi bi-file-earmark-plus"></i>&nbspSubmit</button>
                </div>
        </form>
    </div>
</div>
</div>