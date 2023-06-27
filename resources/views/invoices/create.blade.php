@extends('layouts.app')

@section('content')
<div class="raw d-flex justify-content-center">
    <div class="col-md-4">
        <div class="card border">
            <div class="card-header pt-3">
                <h5>ایجاد صورتحساب جدید</h5>
            </div>
            <div class="card-body">
                <form action="{{ route('invoices.store') }}" method="POST" id="form" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label for="user_id" class="form-label">کاربر:</label>
                        <select id="user_id" name="user_id" class="form-control @error('user_id') is-invalid @enderror">
                            <option value="0" selected>جستجو کاربر</option>
                        </select>
                        <x-form.form-error name="user_id" />
                    </div>
                    <div class="mb-3">
                        <label for="name" class="form-label">نام صورتحساب</label>
                        <input type="text" id="name" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}">
                        <x-form.form-error name="name" />
                    </div>
                    <div class="mb-3">
                        <label for="date" class="form-label">تاریخ</label>
                        <input type="text" id="date" name="date" class="form-control date @error('date') is-invalid @enderror" value="{{ old('date') }}" data-jdp>
                        <x-form.form-error name="date" />
                    </div>
                    <button type="submit" class="btn btn-primary">ایجاد صورتحساب جدید</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
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
                        results:  $.map(data, function (item) {
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
