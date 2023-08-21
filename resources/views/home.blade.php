@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row mx-auto justify-content-center">
            <div class="col-md-8 mt-5">
                <div class="card">
                    <div class="card-body">
                        <p class="card-text text-center font-20 py-4">
                            این صفحه اصلی است برای ورود اینجا <a href="{{ route('login') }}" class="text-danger">کلیک</a>
                            کنید</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
