@extends('doktor.partials.app')
@section('body')

@if($errors->any())
    <div class="alert alert-danger d-flex align-items-center alert-dismissible fade show" role="alert">
        <i class="bi bi-exclamation-triangle"></i>&nbsp;
        <div>
            @foreach($errors->all() as $error)
                {{ $error }}
            @endforeach
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    </div>
@endif

<div class="row justify-content-center">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <div class="container mt-3">
                    <div class="row">
                        <div class="col-md-12">
                            <form action="{{ route('diagnosa.store') }}" method="post" class="col-lg-12" enctype="multipart/form-data">
                                @csrf
                                @method('post')
                                <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                                <div class="mb-3">
                                    <label for="appointment_id" class="form-label fw-bold">Tiket</label>
                                    <div class="input-group has-validation">
                                        <select class="form-select" id="appointment_id" name="appointment_id" aria-label="Default select example">
                                            <option value="{{ $appointment->id }}">{{ $appointment->tiket }}</option>
                                        </select>
                                        <div class="invalid-feedback">
                                            Invalid Tiket
                                        </div>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label for="pasien_id" class="form-label fw-bold">Pasien</label>
                                    <div class="input-group has-validation">
                                        <select class="form-select" id="pasien_id" name="pasien_id" aria-label="Default select example">
                                            <option value="{{ $appointment->pasien_id }}">{{ $appointment->pasien->nik }} - {{ $appointment->pasien->nama_lengkap }}</option>
                                        </select>
                                        <div class="invalid-feedback">
                                            Invalid Pasien
                                        </div>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label for="hasil" class="form-label fw-bold">Hasil Diagnosa</label>
                                    <textarea class="form-control has-validation" name="hasil" id="hasil" rows="3"></textarea>
                                </div>
                                <div class="mb-3">
                                    <label for="catatan" class="form-label fw-bold">Catatan Anda</label>
                                    <textarea class="form-control has-validation" name="catatan" id="catatan" rows="3"></textarea>
                                </div>
                                <button type="submit" class="btn btn-success"><i class="bi bi-file-earmark-plus"></i>&nbspSubmit</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@push('scripts')
    <script>
        
    </script>
@endpush