@extends('auth.base')

@section('content')
    <div class="container">
        <div class="row justify-content-center mt-5">
            <div class="col-md-5">
                <div class="card">
                    <div class="card-header">بازنشانی رمز عبور</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('password.update') }}">
                            @csrf

                            <div class="row mb-3">
                                <label for="mobile_number" class="col-md-4 col-form-label text-md-end">شماره موبایل</label>

                                <div class="col-md-6">
                                    <input id="mobile_number" type="text"
                                           class="form-control @error('mobile_number') is-invalid @enderror" name="mobile_number"
                                           value="{{ session('mobile_number') }}" required autocomplete="mobile_number" disabled>

                                    @error('mobile_number')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="code"
                                       class="col-md-4 col-form-label text-md-end">کد تایید</label>

                                <div class="col-md-6">
                                    <input id="code" type="text"
                                           class="form-control @error('code') is-invalid @enderror" name="code"
                                           required autocomplete="new-code">

                                    @error('code')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="password"
                                       class="col-md-4 col-form-label text-md-end">رمزعبور جدید</label>

                                <div class="col-md-6">
                                    <input id="password" type="password"
                                           class="form-control @error('password') is-invalid @enderror" name="password"
                                           required>

                                    @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        بازنشانی رمز عبور
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
