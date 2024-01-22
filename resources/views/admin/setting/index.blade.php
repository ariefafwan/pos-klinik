@extends('admin.partials.app')

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
<div class="form-create-gejala col-lg-12 shadow-lg p-3 rounded">
    <a href="{{ url('/dashboard') }}" class="btn btn-danger my-3">
        <i class="bi bi-skip-backward"></i></i>&nbspBack
    </a>
    <form class="col-lg-12" action="{{ route('setting.update') }}" method="post" enctype="multipart/form-data">
        @csrf
        <input type="hidden" class="form-control" id="id" name="id" value="{{ $toko->id }}">
        <div class="mb-3">
            <label for="name" class="form-label fw-bold">Nama Toko</label>
            <input type="text" class="form-control" id="name" name="name" value="{{ $toko->name }}"
                placeholder="Masukkan nama toko.....">
        </div>
        <div class="mb-3">
            <label for="exampleFormControlTextarea1" class="form-label fw-bold">Alamat Toko</label>
            <textarea class="form-control" name="alamat" id="exampleFormControlTextarea1" rows="4">{{ $toko->alamat }}</textarea>
        </div>
        <div class="mb-3">
            <label for="logo" class="form-label fw-bold">Logo</label>
            <input class="form-control" name="logo" type="file" id="logo">
            <div class="card mt-2" style="width: 18rem;">
                <img src="{{ asset('storage/Invoice/'.$toko->logo) }}" class="card-img-top" alt="...">
            </div>
        </div>
        <div class="button d-flex justify-content-center">
            <button type="submit" class="btn btn-success">
                <i class="bi bi-database-add"></i>&nbspSubmit
            </button>
        </div>
    </form>
</div>

@endsection