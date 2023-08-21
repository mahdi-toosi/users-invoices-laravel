@extends('layouts.app')

@section('navbar-header')
    لیست محصولات
@endsection

@section('start-navbar-header')
    <x-search :route="route('products.index')" :keyword="$keyword" />
@endsection

@section('content')
    <div class="raw">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    @include('products.table', ['products' => $products])
                </div>
            </div>
        </div>
    </div>

    <a href="{{ route('products.create') }}" class="btn btn-primary rounded-circle __float_add_data_btn">
        <span class="bi bi-plus-lg"></span>
    </a>
@endsection
