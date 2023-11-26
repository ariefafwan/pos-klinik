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
                        <label for="tanggal" class="form-label fw-bold">Tanggal Appointment</label>
                        <div class="input-group has-validation">
                            <input type="date" class="form-control" id="tanggal" name="tanggal">
                            <div class="invalid-feedback">
                                Invalid Tanggal Appointment
                            </div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="jam" class="form-label fw-bold">Jam</label>
                        <div class="input-group has-validation">
                            <input type="time" class="form-control" id="jam" name="jam" min="09:00" max="18:00">
                            <div class="invalid-feedback">
                                Invalid Jam
                            </div>
                        </div>
                        <span class="text-muted">Office Hours 09:00 s/d 18:00</span>
                    </div>
                    <div class="mb-3">
                        <label for="pasien_id" class="form-label fw-bold">Pasien</label>
                        <div class="input-group has-validation">
                            <select class="form-select select2" id="pasien_id" name="pasien_id" aria-label="Default select example">
                                <option selected>Pilih Pasien</option>
                                @foreach ($pasien as $pas)
                                    <option value="{{ $pas->id }}">{{ $pas->nik }} - {{ $pas->nama_lengkap }}</option>
                                @endforeach
                            </select>
                            <div class="invalid-feedback">
                                Invalid Select Pasien
                            </div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="user_id" class="form-label fw-bold">Doktor</label>
                        <div class="input-group has-validation">
                            <select class="form-select select2" id="user_id" name="user_id" aria-label="Default select example">
                                <option selected>Pilih Doktor</option>
                                @foreach ($doktor as $dok)
                                    <option value="{{ $dok->id }}">{{ $dok->name }}</option>
                                @endforeach
                            </select>
                            <div class="invalid-feedback">
                                Invalid Select Doktor
                            </div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="keluhan" class="form-label fw-bold">Keluhan</label>
                        <textarea class="form-control has-validation" name="keluhan" id="keluhan" rows="3"></textarea>
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