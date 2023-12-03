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
                        <label for="email" class="form-label fw-bold">Email</label>
                        <div class="input-group has-validation">
                            <input type="text" class="form-control" id="email" name="email"
                                placeholder="Masukkan Email User..." required autofocus>
                            <div class="invalid-feedback">
                                Invalid Email User
                            </div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="name" class="form-label fw-bold">Nama User</label>
                        <div class="input-group has-validation">
                            <input type="text" class="form-control" id="name" name="name"
                                placeholder="Masukkan Nama User..." required autofocus>
                            <div class="invalid-feedback">
                                Invalid Nama User
                            </div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="role_id" class="form-label fw-bold">Roles</label>
                        <div class="input-group has-validation">
                            <select class="form-select" id="role_id" name="role_id" aria-label="Default select example">
                                <option selected>Pilih Roles</option>
                                @foreach ($roles as $item => $role)
                                    <option value="{{ $role->id }}">{{ $role->name }}</option>
                                @endforeach
                                <option value=""></option>
                            </select>
                            <div class="invalid-feedback">
                                Invalid Select Jenis Kelamin
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