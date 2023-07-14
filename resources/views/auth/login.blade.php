@extends('auth.base')

@section('content')
    <div class="container">
        <div class="row justify-content-center mt-5">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">صفحه ورود به حساب کاربری</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('login') }}">
                            @csrf

                            <div class="row mb-3">
                                <label for="mobile_number" class="col-md-4 col-form-label text-md-end">شماره
                                    موبایل</label>

                                <div class="col-md-6">
                                    <input id="mobile_number" type="tel"
                                           class="form-control @error('mobile_number') is-invalid @enderror"
                                           name="mobile_number" value="{{ old('mobile_number') }}"
                                           autocomplete="off" autofocus>
                                    <x-form.form-error name="mobile_number"/>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="password" class="col-md-4 col-form-label text-md-end">رمزعبور</label>

                                <div class="col-md-6">
                                    <input id="password" type="password"
                                           class="form-control @error('password') is-invalid @enderror" name="password"
                                           autocomplete="current-password">
                                    <x-form.form-error name="password"/>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-md-6 offset-md-4">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="remember"
                                               id="remember" {{ old('remember') ? 'checked' : '' }}>

                                        <label class="form-check-label" for="remember">
                                            مرا به خاطر بسپار
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <div class="row mb-0">
                                <div class="col-md-8 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        ورود
                                    </button>
                                </div>
                            </div>
                            <div class="row mt-2">
                                @if (Route::has('register'))
                                    <div class="col-md-8 offset-md-4">
                                        حساب ندارید؟
                                        <a class="" href="{{ route('register') }}" style="text-decoration: none">
                                            ثبت نام کنید
                                        </a>
                                    </div>
                                @endif
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
