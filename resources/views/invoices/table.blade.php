<table class="table mt-3">
    <thead>
    <tr>
        <th>#</th>
        <th>نام</th>
        <th>کاربر</th>
        <th>تاریخ</th>
        <th>فعالیت ها</th>
    </tr>
    </thead>
    <tbody>
    @foreach($invoices as $invoice)
        <tr style="vertical-align: baseline;">
            <td>{{ $loop->iteration }}</td>
            <td>{{ $invoice->name }}</td>
            <td>{{ $invoice->user->full_name }}</td>
            <td>{{ jdate($invoice->date)->format('Y/m/d') }}</td>
            <td>
                <a href="{{ route('invoices.products', $invoice->id) }}" class="btn btn-sm btn-info">محصولات</a>
                <a href="{{ route('invoices.edit', $invoice) }}" class="btn btn-sm btn-primary">ویرایش</a>
                <form action="{{ route('invoices.destroy', $invoice) }}" method="POST" style="display: inline-block;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-sm btn-danger">حذف</button>
                </form>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>

{{ $invoices->links() }}
