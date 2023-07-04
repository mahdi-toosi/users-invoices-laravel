@extends('auth.base')

@section('content')
    <div class="container">
        <div class="row justify-content-center mt-5">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">شماره موبایل خود را تأیید کنید</div>

                    <div class="card-body">

                        <div class="mb-4 text-sm text-gray-600">
                            از ثبت نام شما سپاسگزاریم!
                        </div>

                        <div class="text-sm text-gray-600">
                            لطفاً کد ارسال شده به شماره موبایل {{ auth()->user()->mobile_number }} را وارد کنید
                        </div>

                        <div class="mt-4 flex items-center justify-between">
                            <form method="POST" action="{{ route('verification.verify-mobile') }}">
                                @csrf
                                <div>
                                    <label for="code" class="form-label d-none">کد</label>

                                    <div class="col-md-3">
                                        <input id="code" type="text" class="form-control @error('code') is-invalid @enderror" name="code" value="{{ old('code') }}" required autofocus>
                                        <x-form.form-error name="code" />
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-primary mt-3">تایید</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
