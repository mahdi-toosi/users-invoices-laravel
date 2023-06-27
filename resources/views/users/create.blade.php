@extends('layouts.app')

@section('content')

<div class="raw d-flex justify-content-center">
    <div class="col-md-4">
        <div class="card border">
            <div class="card-header pt-3">
                <h5>ایجاد کاربر جدید</h5>
            </div>
            <div class="card-body">
                <form action="{{ route('users.store') }}" method="POST" id="form" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label for="first_name" class="form-label">نام</label>
                        <input type="text" id="first_name" name="first_name" class="form-control @error('first_name') is-invalid @enderror" value="{{ old('first_name') }}">
                        <x-form.form-error name="first_name" />
                    </div>
                    <div class="mb-3">
                        <label for="last_name" class="form-label">نام خانوادگی</label>
                        <input type="text" id="last-name" name="last_name" class="form-control @error('last_name') is-invalid @enderror" value="{{ old('last_name') }}">
                        <x-form.form-error name="last_name" />
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">ایمیل</label>
                        <input type="email" id="email" name="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}">
                        <x-form.form-error name="email" />
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">رمزعبور</label>
                        <input  id="password" type="password" name="password" class="form-control @error('password') is-invalid @enderror">
                        <x-form.form-error name="password" />
                    </div>
                    <div class="mb-3">
                        <x-form.form-error name="avatar" />
                        <label for="avatar" class="form-label">تصویر</label>
                        <input type="file" id="avatar" name="avatar" class="form-control-file" onchange="previewImage(this, '#avatar-preview')" value="{{ old('avatar') }}">
                        <img id="avatar-preview" src="#" alt="Preview" class="img-thumbnail mt-2" style="display: none;">
                    </div>
                    <button type="submit" class="btn btn-primary">ایجاد کاربر جدید</button>
                </form>
            </div>
        </div>
    </div>
</div>
<script>
    function previewImage(input, previewId) {
        if (input.files && input.files[0]) {
            const reader = new FileReader();

            reader.onload = function(e) {
                $(previewId).attr('src', e.target.result);
                $(previewId).show();
            }

            reader.readAsDataURL(input.files[0]);
        }
    }
</script>

@endsection
