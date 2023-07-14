@extends('auth.base')

@section('content')
    <div class="container">
        <div class="row justify-content-center mt-5">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">صفحه ساخت حساب کاربر جدید</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('register') }}">
                            @csrf


                            <div class="row mb-3">
                                <label for="first_name" class="col-md-4 col-form-label text-md-end">نام</label>

                                <div class="col-md-6">
                                    <input id="first_name" type="text"
                                           class="form-control @error('first_name') is-invalid @enderror"
                                           name="first_name" value="{{ old('first_name') }}" required
                                           autocomplete="first_name" autofocus>
                                    <x-form.form-error name="first_name"/>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="last_name" class="col-md-4 col-form-label text-md-end">نام خانوادگی</label>

                                <div class="col-md-6">
                                    <input id="last_name" type="text"
                                           class="form-control @error('last_name') is-invalid @enderror"
                                           name="last_name" value="{{ old('last_name') }}" required
                                           autocomplete="last_name" autofocus>
                                    <x-form.form-error name="last_name"/>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="mobile_number" class="col-md-4 col-form-label text-md-end">موبایل</label>
                                <div class="col-md-6">
                                    <input id="mobile_number" type="tel"
                                           class="form-control @error('mobile_number') is-invalid @enderror"
                                           name="mobile_number" value="{{ old('mobile_number') }}" required
                                           autocomplete="mobile_number" autofocus>
                                    <x-form.form-error name="mobile_number"/>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="password" class="col-md-4 col-form-label text-md-end">کلمه عبور</label>

                                <div class="col-md-6">
                                    <input id="password" type="password"
                                           class="form-control @error('password') is-invalid @enderror" name="password"
                                           required autocomplete="new-password">

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
                                        ثبت نام
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
