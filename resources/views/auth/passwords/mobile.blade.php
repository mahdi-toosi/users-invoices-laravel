@extends('auth.base')

@section('content')
    <div class="container">
        <div class="row justify-content-center mt-5">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">بازنشانی رمز عبور</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('password.mobile.get-reset-code') }}">
                            @csrf
                            <div class="row mb-3">
                                <label for="mobile_number" class="col-md-4 col-form-label text-md-end">شماره موبایل</label>

                                <div class="col-md-6">
                                    <input id="mobile_number" type="tel"
                                           class="form-control @error('email') is-invalid @enderror" name="mobile_number"
                                           value="{{ $mobile_number ?? old('mobile_number') }}" autocomplete="mobile_number" autofocus>

                                    @error('email')
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
