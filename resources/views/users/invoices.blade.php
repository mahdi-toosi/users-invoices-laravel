@extends('layouts.app')

@section('content')
    <x-page.header>
        <div>
            <h5>صورتحساب ها
                <a
                    class="link-secondary link-offset-2 link-underline-opacity-25 link-underline-opacity-100-hover"
                    href="{{route('users.edit',$user)}}"><small>| {{$user->full_name}}</small></a></h5>
        </div>
    </x-page.header>

    <div class="raw mt-4">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('users.invoices', $user->id) }}" method="GET" class="mt-3">
                        <div class="input-group">
                            <input type="text" class="form-control" name="keyword" placeholder="جستجو..."
                                   value="{{ $keyword }}">
                            <button class="btn btn-outline-secondary" type="submit">جستجو</button>
                        </div>
                    </form>
                    @include('invoices.table', ['invoices' => $invoices])
                </div>
            </div>
        </div>
    </div>

    <a href="{{ route('invoices.create') }}" class="btn btn-primary rounded-circle __float_add_data_btn">
        <span class="bi bi-plus-lg"></span>
    </a>
@endsection
