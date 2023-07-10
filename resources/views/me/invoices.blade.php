@extends('layouts.app')

@section('content')
    <x-page.header>
        <h4 class="mb-0">لیست صورتحساب ها من</h4>
{{--        <a href="{{ route('invoices.create') }}" class="btn btn-primary">افزودن</a>--}}
    </x-page.header>

    <div class="raw mt-4">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('me.invoices') }}" method="GET" class="mt-3">
                        <div class="input-group">
                            <input type="text" class="form-control" name="keyword" placeholder="جستجو..." value="{{ $keyword }}">
                            <button class="btn btn-outline-secondary" type="submit">جستجو</button>
                        </div>
                    </form>

                    <div class="__table_wrapper">
                        <table class="table mt-3">
                            <thead>

                            <tr>
                                <th>#</th>
                                <th>نام</th>
                                <th>کاربر</th>
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
                                    <td>@persianNumber($invoice->year)</td>
                                    <td>{{ get_month_name($invoice->month) }} </td>

                                    <td>
                                        <a href="{{ route('me.invoices.products', $invoice->id) }}" class="btn btn-sm btn-info">محصولات</a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    {{ $invoices->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
