@extends('layouts.app')

@section('content')
    <x-page.header>
        <h4 class="mb-0">محصولات
            <a
                href="{{route('invoices.edit', $invoice->id)}}"
                class="link-secondary link-offset-2 link-underline-opacity-25 link-underline-opacity-100-hover"
            >
                | {{$invoice->name}}
            </a>
        </h4>
    </x-page.header>

    <div class="raw mt-4">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('invoices.products', $invoice) }}" method="GET" class="mt-3">
                        <div class="input-group">
                            <input type="text" class="form-control" name="keyword" placeholder="جستجو..."
                                   value="{{ $keyword }}">
                            <button class="btn btn-outline-secondary" type="submit">جستجو</button>
                        </div>
                    </form>
                    @include('products.table', ['products' => $products])
                </div>
            </div>
        </div>
    </div>

    <a href="{{ route('products.create') }}" class="btn btn-primary rounded-circle __float_add_data_btn">
        <span class="bi bi-plus-lg"></span>
    </a>
@endsection
