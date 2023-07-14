@extends('layouts.app')

@section('content')
    <x-page.header>
        <form action="{{ route('users.index') }}" method="GET" class="w-100">
            <div class="input-group">
                <input type="text" class="form-control" name="keyword" placeholder="جستجو..." value="{{ $keyword }}">
                <button class="btn btn-outline-secondary" type="submit">جستجو</button>
            </div>
        </form>
    </x-page.header>

    <div class="card bg-white">
        <div class="card-body">


            @foreach($users as $user)
                <a href="{{ route('users.invoices', $user->id) }}" class="d-flex text-body mb-3" style="gap: .5rem">
                    <div class="avatar avatar-small">
                        <img src="{{ $user->avatar ? asset('storage/'.$user->avatar) : asset('/img/user.png')}}"
                             alt="Avatar">
                    </div>

                    <div>
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
