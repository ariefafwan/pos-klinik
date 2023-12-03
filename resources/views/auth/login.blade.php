@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
            <form method="POST" action="{{ route('login') }}">
                @csrf
                <div class="container mt-5">
                    <div class="row d-flex justify-content-center">
                        <div class="col-md-6">
                            <div class="card px-5 py-5" id="form1">
                                <div class="form-data" >
                                    <div class="forms-inputs mb-4"> 
                                        <label for="email">{{ __('Email Address') }}</label> 
                                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                                        @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="forms-inputs mb-4"> 
                                        <label for="password">{{ __('Password') }}</label>
                                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                        @error('password')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <button type="submit" class="btn btn-dark w-100">Login</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
    </div>
</div>
@endsection
