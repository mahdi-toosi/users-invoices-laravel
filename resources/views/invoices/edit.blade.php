@extends('layouts.app')

@section('content')

    <div class="raw ">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header pt-3">
                    <h5>ویرایش صورتحساب - {{$invoice->name}}</h5>
                </div>
                <div class="card-body">

                    <form action="{{ route('invoices.update', $invoice) }}" method="POST" id="form">
                        @csrf
                        @method('PUT')
                        <div class="mb-3">
                            <label for="user_id">کاربر:</label>
                            <select id="user_id" name="user_id"
                                    class="form-control @error('user_id') is-invalid @enderror">
                                <option value="{{ $invoice->user_id }}"
                                        selected>{{ $invoice->user->full_name }}</option>
                            </select>
                            <x-form.form-error name="user_id"/>
                        </div>
                        <div class="mb-3">
                            <label for="name" class="form-label">نام صورتحساب</label>
                            <input type="text" id="name" name="name"
                                   class="form-control @error('name') is-invalid @enderror"
                                   value="{{ old('name', $invoice->name) }}">
                            <x-form.form-error name="name"/>
                        </div>

                        <div class="mb-3">
                            <label for="status" class="form-label">وضعیت</label>

                            <select
                                id="status"
                                class="form-control @error('is_cash') is-invalid @enderror"
                                name="is_cash"
                            >
                                <option value="1" {{ old('is_cash') == '1' ? 'selected' : ''}}>
                                    نقدی
                                </option>

                                <option value="0" {{ old('is_cash') == '0' ? 'selected' : ''}}>
                                    غیر نقدی
                                </option>
                            </select>
                            <x-form.form-error name="month"/>
                        </div>

                        <div class="mb-3">
                            <label for="year" class="form-label">سال</label>
                            <select class="select2_column form-control @error('year') is-invalid @enderror"
                                    name="year" id="year">
                                @foreach(range((int) jdate()->format('Y') - 3,  (int) jdate()->format('Y') + 3) as $year)
                                    <option
                                        value="{{ $year }}" {{ old('year', $invoice->year) == $year ? 'selected' : ''}}>{{ $year }}</option>
                                @endforeach
                            </select>
                            <x-form.form-error name="year"/>
                        </div>

                        <div class="mb-3">
                            <label for="month" class="form-label">ماه</label>
                            <select class="select2_column form-control @error('month') is-invalid @enderror"
                                    name="month" id="month">
                                @foreach(get_months() as $key => $month)
                                    <option
                                        value="{{ $key }}" {{ old('month', $invoice->month) == $key ? 'selected' : ''}}>{{ $month }}</option>
                                @endforeach
                            </select>
                            <x-form.form-error name="month"/>
                        </div>
                        <button type="submit" class="btn btn-primary">ویرایش صورتحساب</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>

        $(document).ready(function () {
            $('#user_id').select2({
                ajax: {
                    url: '/users/search',
                    data: function (params) {
                        console.log(params)
                        return {
                            search: params.term,
                            type: 'public'
                        };
                    },
                    processResults: function (data) {
                        return {
                            results: $.map(data, function (item) {
                                return {
                                    id: item.id,
                                    text: item.full_name
                                }
                            })
                        };
                    },
                }
            });
        });
    </script>
@endsection
