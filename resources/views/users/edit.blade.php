@extends('layouts.app')

@section('content')

<div class="raw d-flex justify-content-center">
    <div class="col-md-4">
        <div class="card border">
            <div class="card-header pt-3">
                <h5>افزودن</h5>
            </div>
            <div class="card-body">
                <form action="{{ route('users.update', $user) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                        <div class="mb-3">
                            <label for="first-name" class="form-label">نام</label>
                            <input type="text" id="first-name" name="first_name" class="form-control @error('first_name') is-invalid @enderror" value="{{ old('first_name', $user->first_name) }}">
                            <x-form.form-error name="first_name" />
                        </div>
                        <div class="mb-3">
                            <label for="last_name" class="form-label">نام خانوادگی</label>
                            <input type="text" id="last_name" name="last_name" class="form-control @error('last_name') is-invalid @enderror" value="{{  old('last_name', $user->last_name) }}">
                            <x-form.form-error name="last_name" />
                        </div>
                        <div class="mb-3">
                            <label for="mobile_number" class="form-label">ایمیل</label>
                            <input type="tel" id="mobile_number" name="mobile_number" class="form-control @error('mobile_number') is-invalid @enderror" value="{{ old('mobile_number', $user->mobile_number) }}">
                            <x-form.form-error name="mobile_number" />
                        </div>
                        <div class="mb-3">
                            <x-form.form-error name="avatar" />
                            <label for="avatar" class="form-label">تصویر</label>
                            <input type="file" id="avatar" name="avatar" class="form-control-file @error('avatar') is-invalid @enderror" onchange="previewImage(this, '#avatar-preview')" value="{{ old('avatar', $user->avatar) }}">
                            <img id="avatar-preview" src="{{ asset('storage/'.$user->avatar) }}" alt="Preview" class="img-thumbnail mt-2">
                        </div>
                    <button type="submit" class="btn btn-primary">ویرایش کاربر</button>
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
