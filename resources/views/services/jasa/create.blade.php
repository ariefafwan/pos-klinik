<div class="modal fade" id="modal-create" tabindex="-1" role="dialog" aria-labelledby="modal-create">
    <div class="modal-dialog modal-lg" role="document">
        <form action="" method="post" class="col-lg-12" enctype="multipart/form-data">
            @csrf
            @method('post')
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title"></h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="name" class="form-label fw-bold">Nama Jasa</label>
                        <div class="input-group has-validation">
                            <input type="text" class="form-control" id="name" name="name"
                                placeholder="Masukkan Nama Jasa..." required autofocus>
                            <div class="invalid-feedback">
                                Invalid Nama Jasa
                            </div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="biaya" class="form-label fw-bold">Biaya Jasa</label>
                        <div class="input-group has-validation">
                            <input type="number" min="0" class="form-control" id="biaya" name="biaya"
                                placeholder="Masukkan Biaya Jasa..." required autofocus>
                            <div class="invalid-feedback">
                                Invalid Biaya Jasa
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