@extends('layouts.app')

@section('content')
    <x-page.header>
        <h4 class="mb-0">محصولات</h4>
    </x-page.header>

    <div class="raw mt-4">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('products.index') }}" method="GET" class="mt-3">
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
