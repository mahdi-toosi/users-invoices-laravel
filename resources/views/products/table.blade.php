<table class="table mt-3">
    <thead>
    <tr>
        <th>#</th>
        <th>نام محصول</th>
        <th>صورتحساب</th>
        <th>قیمت</th>
        <th>توضیحات</th>
        <th>فعالیت ها</th>
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
            <td>
                <a href="{{ route('products.edit', $product) }}" class="btn btn-sm btn-primary">ویرایش</a>
                <form action="{{ route('products.destroy', $product) }}" method="POST" style="display: inline-block;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-sm btn-danger">حذف</button>
                </form>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>

{{ $products->links() }}
