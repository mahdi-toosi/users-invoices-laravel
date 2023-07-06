@extends('layouts.app')

@section('content')
    <x-page.header>
        <h4 class="mb-0">لیست محصولات</h4>
        <a href="{{ route('products.create') }}" class="btn btn-primary">ایجاد محصول جدید</a>
    </x-page.header>

    <div class="raw mt-4">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('me.invoices.products', $invoice->id) }}" method="GET" class="mt-3">
                        <div class="input-group">
                            <input type="text" class="form-control" name="keyword" placeholder="جستجو..." value="{{ $keyword }}">
                            <button class="btn btn-outline-secondary" type="submit">جستجو</button>
                        </div>
                    </form>
                    <table class="table mt-3">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>نام محصول</th>
                            <th>صورتحساب</th>
                            <th>قیمت</th>
                            <th>توضیحات</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($products as $product)
                            <tr style="vertical-align: baseline;">
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $product->name }}</td>
                                <td>{{ $product->invoice->name }}</td>
                                <td>{{ $product->price }}</td>
                                <td>{{ \Illuminate\Support\Str::limit($product->description, 20)  }}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>

                    {{ $products->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection
