@extends('layouts.app')

@section('navbar-header')
    <x-user-link :back="route('users.invoices', $invoice->user->id)" :user="$invoice->user" title="{{ $invoice->name . '-' . get_month_name($invoice->month) . ' ' . $invoice->year }}" />
@endsection

@section('start-navbar-header')
    <x-search :route="route('invoices.products', $invoice)" :keyword="$keyword" />
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

    <a href="{{ route('products.create', ['invoice_id' => $invoice->id]) }}" class="btn btn-primary rounded-circle __float_add_data_btn">
        <span class="bi bi-plus-lg"></span>
    </a>
@endsection
