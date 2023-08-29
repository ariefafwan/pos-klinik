<!-- Modal Untuk Tambah Data -->
<div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Edit Data</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>
        <div class="modal-body">
            <form class="col-lg-12" action="{{ route('product.update' ) }}" method="post" enctype="multipart/form-data">
                @csrf
                <input type="hidden" class="form-control" id="editid" name="id">
                <div class="mb-3">
                    <label for="editname" class="form-label fw-bold">Nama Produk</label>
                    <input type="text" class="form-control" id="editname" name="name" placeholder="Masukkan Nama Produk...">
                </div>
                <div class="mb-3">
                    <label for="edittype" class="form-label fw-bold">Tipe Produk</label>
                    <select class="form-select" id="edittype" name="type" aria-label="Default select example">
                        <option selected>Pilih Tipe Produk</option>
                        <option value="Barang">Barang</option>
                        <option value="Service">Service</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="edithargabeli" class="form-label fw-bold">Harga</label>
                    <input type="number" class="form-control" id="edithargabeli" name="harga_beli" placeholder="Masukkan Harga Produk...">
                </div>
                <div class="mb-3">
                    <label for="edithargajual" class="form-label fw-bold">Harga</label>
                    <input type="number" class="form-control" id="edithargajual" name="harga_jual" placeholder="Masukkan Harga Produk...">
                </div>
                <div class="mb-3">
                    <label for="editstock" class="form-label fw-bold">Stock</label>
                    <input type="number" class="form-control" id="editstock" name="stock" placeholder="Masukkan Stock Produk...">
                </div>
        </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal"><i class="bi bi-x-circle"></i>&nbspClose</button>
                    <button type="submit" class="btn btn-success"><i class="bi bi-file-earmark-plus"></i>&nbspSubmit</button>
                </div>
            </form>
    </div>
    </div>
</div>