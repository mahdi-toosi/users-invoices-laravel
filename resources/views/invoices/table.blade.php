<div class="__table_wrapper">
    <table class="table mt-3">
        <thead>

        <tr>
            <th>#</th>
            <th>نام</th>
            <th>کاربر</th>
            <th>وضعیت</th>
            <th>سال</th>
            <th>ماه</th>
            <th>فعالیت ها</th>
        </tr>
        </thead>
        <tbody>
        @foreach($invoices as $invoice)
            <tr style="vertical-align: baseline;">
                <td>{{ $loop->iteration }}</td>
                <td>{{ $invoice->name }}</td>
                <td>{{ $invoice->user->full_name }}</td>
                <td>{{ $invoice->is_cash ? 'نقدی': 'غیر نقدی' }}</td>
                <td>@persianNumber($invoice->year)</td>
                <td>{{ get_month_name($invoice->month) }} </td>

                <td>
                    <a href="{{ route('invoices.products', $invoice->id) }}" class="btn btn-sm btn-info">محصولات</a>
                    <a href="{{ route('invoices.edit', $invoice) }}" class="btn btn-sm btn-primary">ویرایش</a>
                    <form action="{{ route('invoices.destroy', $invoice) }}" method="POST"
                          style="display: inline-block;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-danger">حذف</button>
                    </form>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
{{ $invoices->links() }}
