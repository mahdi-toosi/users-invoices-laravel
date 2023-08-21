@extends('layouts.app')

@section('navbar-header')
    لیست صورتحساب ها
@endsection

@section('start-navbar-header')
    <x-search :route="route('invoices.index')" :keyword="$keyword" />
@endsection

@section('content')
    <div class="raw">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    @include('invoices.table', ['invoices' => $invoices])
                </div>
            </div>
        </div>
    </div>

    <a href="{{ route('invoices.create') }}" class="btn btn-primary rounded-circle __float_add_data_btn">
        <span class="bi bi-plus-lg"></span>
    </a>
@endsection
