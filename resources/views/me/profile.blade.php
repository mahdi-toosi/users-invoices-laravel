@extends('layouts.app')

@section('content')

<div class="raw mt-4">
    <div class="col-md-8 mx-auto">
        <div class="card">
            <div class="card-body">
                <!-- Nav pills -->
                <ul class="nav nav-pills mb-2 border-bottom pb-3">
                    <li class="nav-item">
                        <a class="nav-link active" data-bs-toggle="pill" href="#user-details">اطلاعات حساب</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-bs-toggle="pill" href="#change-password">تغییر رمزعبور</a>
                    </li>
                </ul>

                <!-- Tab panes -->
                <div class="tab-content">
                    <div class="tab-pane container active" id="user-details">
                        <div class="card shadow-none">
                            <div class="card-body">
                                <form action="{{ route('me.profile.update') . '#user-details' }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="first-name" class="form-label">نام</label>
                                                <input type="text" id="first-name" name="first_name"
                                                       class="form-control @error('first_name') is-invalid @enderror"
                                                       value="{{ old('first_name', $user->first_name) }}">
                                                <x-form.form-error name="first_name"/>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="last_name" class="form-label">نام خانوادگی</label>
                                                <input type="text" id="last_name" name="last_name"
                                                       class="form-control @error('last_name') is-invalid @enderror"
                                                       value="{{  old('last_name', $user->last_name) }}">
                                                <x-form.form-error name="last_name"/>
                                            </div>
                                        </div>
                                    </div>


                                    <div class="mb-3">
                                        <label for="mobile_number" class="form-label">شماره موبایل</label>
                                        <input type="tel" id="mobile_number" name="mobile_number"
                                               class="form-control @error('mobile_number') is-invalid @enderror"
                                               value="{{ old('mobile_number', $user->mobile_number) }}">
                                        <x-form.form-error name="mobile_number"/>
                                    </div>
                                    <div class="mb-3">
                                        <x-form.form-error name="avatar"/>
                                        <label for="avatar" class="form-label">تصویر</label>
                                        <input type="file" id="avatar" name="avatar"
                                               class="form-control-file @error('avatar') is-invalid @enderror"
                                               onchange="previewImage(this, '#avatar-preview')"
                                               value="{{ old('avatar', $user->avatar) }}">
                                        <img id="avatar-preview" src="{{ asset('storage/'.$user->avatar) }}" alt="Preview"
                                             class="img-thumbnail mt-2">
                                    </div>
                                    <button type="submit" class="btn btn-primary">ذخیره</button>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane container fade" id="change-password">
                        <div class="card shadow-none">
                            <div class="card-body">
                                <form action="{{ route('me.profile.change-password') . '#change-password' }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="old_password" class="form-label">رمزعبور قدیمی</label>
                                                <input id="old_password" type="password" name="old_password"
                                                       class="form-control @error('old_password') is-invalid @enderror">
                                                <x-form.form-error name="old_password"/>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="new_password" class="form-label">رمزعبور جدید</label>
                                                <input id="new_password" type="password" name="new_password"
                                                       class="form-control @error('new_password') is-invalid @enderror">
                                                <x-form.form-error name="new_password"/>
                                            </div>
                                        </div>
                                    <button type="submit" class="btn btn-primary">ذخیره</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<script>
    function previewImage(input, previewId) {
        if (input.files && input.files[0]) {
            const reader = new FileReader();

            reader.onload = function (e) {
                $(previewId).attr('src', e.target.result);
                $(previewId).show();
            }

            reader.readAsDataURL(input.files[0]);
        }
    }

    $(document).ready(function() {
        // Get the hash from the URL
        var hash = window.location.hash;

        // Check if the hash is present
        if (hash) {
            // Cache jQuery selectors
            var $navLinks = $('.nav-link');
            var $tabPanes = $('.tab-pane');

            // Remove the 'active' class from all tab links and tab panes
            $navLinks.removeClass('active');
            $tabPanes.removeClass('active show');

            // Find the corresponding tab link
            var $targetNavLink = $('a[href="' + hash + '"]');

            // Check if the corresponding tab link exists
            if ($targetNavLink.length) {
                // Add the 'active' class to the corresponding tab link
                $targetNavLink.addClass('active');

                // Find the corresponding tab pane
                var $targetTabPane = $(hash);

                // Check if the corresponding tab pane exists
                if ($targetTabPane.length) {
                    // Add the 'active' and 'show' classes to the corresponding tab pane
                    $targetTabPane.addClass('active show');
                }
            }
        }
    });
</script>
@endsection
