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
                        <label for="editnik" class="form-label fw-bold">NIK</label>
                        <div class="input-group has-validation">
                            <input type="text" class="form-control" id="editnik" name="nik"
                                placeholder="Masukkan NIK..." required autofocus>
                            <div class="invalid-feedback">
                                Invalid NIK
                            </div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="editnama_lengkap" class="form-label fw-bold">Nama Lengkap</label>
                        <div class="input-group has-validation">
                            <input type="text" class="form-control" id="editnama_lengkap" name="nama_lengkap"
                                placeholder="Masukkan Nama Lengkap..." required autofocus>
                            <div class="invalid-feedback">
                                Invalid Nama Lengkap
                            </div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="editjenis_kelamin" class="form-label fw-bold">Jenis Kelamin</label>
                        <div class="input-group has-validation">
                            <select class="form-select" id="editjenis_kelamin" name="jenis_kelamin" aria-label="Default select example">
                                <option selected>Pilih Jenis Kelamin</option>
                                <option value="Laki - Laki">Laki - Laki</option>
                                <option value="Perempuan">Perempuan</option>
                            </select>
                            <div class="invalid-feedback">
                                Invalid Select Jenis Kelamin
                            </div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="editalamat" class="form-label fw-bold">Alamat</label>
                        <textarea class="form-control has-validation" name="alamat" id="editalamat" rows="3"></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="editpekerjaan" class="form-label fw-bold">Pekerjaan</label>
                        <div class="input-group has-validation">
                            <input type="text" class="form-control" id="editpekerjaan" name="pekerjaan"
                                placeholder="Pekerjaan...">
                            <div class="invalid-feedback">
                                Invalid pekerjaan
                            </div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="editno_hp" class="form-label fw-bold">NO HP</label>
                        <div class="input-group has-validation">
                            <input type="number" class="form-control" id="editno_hp" name="no_hp"
                                placeholder="Masukkan No HP...">
                            <div class="invalid-feedback">
                                Invalid No Hp
                            </div>
                        </div>
                        <span class="text-muted">*format acceptable = +628xxxxxxxxxx | 628xxxxxxxxxx | 08xxxxxxxxxx</span>
                    </div>
                    <div class="mb-3">
                        <label for="edittanggal_lahir" class="form-label fw-bold">Tanggal Lahir</label>
                        <div class="input-group has-validation">
                            <input type="date" class="form-control" id="edittanggal_lahir" name="tanggal_lahir">
                            <div class="invalid-feedback">
                                Invalid Tanggal Lahir
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