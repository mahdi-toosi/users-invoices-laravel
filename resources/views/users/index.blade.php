@extends('layouts.app')

@section('content')

    <x-page.header>
        <h4 class="mb-0">لیست کاربران</h4>
        <a href="{{ route('users.create') }}" class="btn btn-primary">ایجاد کاربر جدید</a>
    </x-page.header>

    <div class="raw mt-4">
        <div class="col-md-12">
            <div class="card bg-white">
                <div class="card-body">
                    <form action="{{ route('users.index') }}" method="GET" class="mt-3">
                        <div class="input-group">
                            <input type="text" class="form-control" name="keyword" placeholder="جستجو..." value="{{ $keyword }}">
                            <button class="btn btn-outline-secondary" type="submit">جستجو</button>
                        </div>
                    </form>

                    <table class="table table-striped mt-3">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>تصویر</th>
                            <th>نام و نام خانوادگی</th>
                            <th>ایمیل</th>
                            <th>فعالیت ها</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($users as $user)
                            <tr style="vertical-align: baseline;">
                                <td>{{ $loop->iteration }}</td>
                                <td>
                                    <div class="avatar avatar-small">
                                        <img src="{{ $user->avatar ? asset('storage/'.$user->avatar) : asset('/img/user.png')}}" alt="Avatar">
                                    </div>
                                </td>
                                <td>{{ $user->first_name }} {{ $user->last_name }}</td>
                                <td>{{ $user->email }}</td>
                                <td>
                                    <a href="{{ route('users.invoices', $user->id) }}" class="btn btn-sm btn-info">صورتحساب ها</a>
                                    <a href="{{ route('users.edit', $user) }}" class="btn btn-sm btn-primary">ویرایش</a>
                                    <form action="{{ route('users.destroy', $user) }}" method="POST" style="display: inline-block;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger">حذف</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>

                    {{ $users->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection
