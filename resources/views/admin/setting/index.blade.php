@extends('admin.partials.app')

@section('body')

<div class="form-create-gejala col-lg-12 shadow-lg p-3 rounded">
    <a href="{{ url('/dashboard') }}" class="btn btn-danger my-3">
        <i class="bi bi-skip-backward"></i></i>&nbspBack
    </a>
    <form class="col-lg-12" action="{{ route('setting.update') }}" method="post">
        @csrf
        <input type="hidden" class="form-control" id="id" name="id" value="{{ $toko[0]->id }}">
        <div class="mb-3">
            <label for="name" class="form-label fw-bold">Nama Toko</label>
            <input type="text" class="form-control" id="name" name="name" value="{{ $toko[0]->name }}"
                placeholder="Masukkan nama toko....." autofocus>
        </div>
        <div class="mb-3">
            <label for="exampleFormControlTextarea1" class="form-label fw-bold">Alamat Toko</label>
            <textarea class="form-control" name="alamat" id="exampleFormControlTextarea1" rows="4">{{ $toko[0]->alamat }}</textarea>
        </div>
        <div class="button d-flex justify-content-center">
            <button type="submit" class="btn btn-success">
                <i class="bi bi-database-add"></i>&nbspSubmit
            </button>
        </div>
    </form>
</div>

@endsection