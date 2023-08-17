@extends('layouts.guest-app')

@section('content')
    <div class="container">
        <div class="row mx-auto">
            <div class="col-md-8 mt-5">
                <div class="card shadow-lg">
                    <div class="card-body mx-auto">
                        <a class="btn btn-primary" href="{{ route('register') }}" style="text-decoration: none">
                            ثبت نام
                        </a>
                        <a class="btn btn-success" href="{{ route('login') }}" style="text-decoration: none">
                            ورود
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
