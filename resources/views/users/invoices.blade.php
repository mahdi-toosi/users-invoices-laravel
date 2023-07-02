@extends('layouts.app')

@section('content')
    <x-page.header>
        <h4 class="mb-0">لیست صورتحساب ها</h4>
        <a href="{{ route('invoices.create') }}" class="btn btn-primary">افزودن</a>
    </x-page.header>

    <div class="raw mt-4">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('users.invoices', $user->id) }}" method="GET" class="mt-3">
                        <div class="input-group">
                            <input type="text" class="form-control" name="keyword" placeholder="جستجو..." value="{{ $keyword }}">
                            <button class="btn btn-outline-secondary" type="submit">جستجو</button>
                        </div>
                    </form>
                    @include('invoices.table', ['invoices' => $invoices])
                </div>
            </div>
        </div>
    </div>
@endsection
