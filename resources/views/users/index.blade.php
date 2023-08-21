@extends('layouts.app')

@section('navbar-header')
    لیست کاربران
@endsection

@section('start-navbar-header')
    <x-search :route="route('users.index')" :keyword="$keyword" />
@endsection


@section('content')
    <div class="card bg-white">
        <div class="card-body">
            @foreach($users as $user)
                <a href="{{ route('users.invoices', $user->id) }}" class="d-flex text-body pb-2 mb-3" style="gap: .5rem">
                    <div class="avatar avatar-small">
                        <img src="{{ $user->avatar ? asset('storage/'.$user->avatar) : asset('/img/user.png')}}"
                             alt="Avatar">
                    </div>

                    <div class="">
                        <h6 class="mb-0">{{ $user->first_name }} {{ $user->last_name }}</h6>
                        <small>{{$user->mobile_number}}</small>
                    </div>
                </a>

                <!-- <td>{{ $user->mobile_number }}</td>
            <td>
                <a href="{{ route('users.invoices', $user->id) }}" class="btn btn-sm btn-info">صورتحساب ها</a>
                <a href="{{ route('users.edit', $user) }}" class="btn btn-sm btn-primary">ویرایش</a>
                <form action="{{ route('users.destroy', $user) }}" method="POST" style="display: inline-block;">
                    @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-sm btn-danger">حذف</button>
            </form>
        </td> -->
            @endforeach

            {{ $users->links() }}
        </div>
    </div>

    <a href="{{ route('users.create') }}" class="btn btn-primary rounded-circle __float_add_data_btn">
        <span class="bi bi-plus-lg"></span>
    </a>
@endsection
