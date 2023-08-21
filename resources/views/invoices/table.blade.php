<div class="__table_wrapper">
    <table class="table mt-3">
        <thead>
        <tr>
            <th>#</th>
            <th>نام</th>
            <th>سال</th>
            <th>ماه</th>
            <th>وضعیت</th>
            <th>فعالیت ها</th>
        </tr>
        </thead>
        <tbody>
        @foreach($invoices as $invoice)
            <tr style="vertical-align: baseline;">
                <td>{{ $loop->iteration }}</td>
                <td>
                    <a href="{{ route('invoices.products', $invoice->id) }}" class="text-black">{{ $invoice->name }}</a>
                </td>
                <td>@persianNumber($invoice->year)</td>
                <td>{{ get_month_name($invoice->month) }} </td>
                <td>{{ $invoice->is_cash ? 'نقدی': 'غیر نقدی' }}</td>

                <td>
                    <a href="{{ route('invoices.edit', $invoice) }}" class="text-primary pe-2 ps-2">
                        <i class="bi bi-pencil"></i>
                    </a>
                    <form action="{{ route('invoices.destroy', $invoice) }}" method="POST"
                          style="display: inline-block;">
                        @csrf
                        @method('DELETE')
                        <div type="submit" class="text-danger">
                            <i class="bi bi-trash"></i>
                        </div>
                    </form>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
{{ $invoices->links() }}
