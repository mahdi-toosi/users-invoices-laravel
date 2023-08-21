<!--start top header-->
<header class="top-header">
    <nav class="navbar navbar-expand bg-white">

        <div class="me-auto d-flex align-items-center">
            <div class="mobile-toggle-icon fs-3 ps-3">
                <i class="bi bi-list"></i>
            </div>
            @yield('navbar-header')
        </div>


        <div class="ms-auto">
            @guest
            <a class="btn btn-primary" href="{{ route('register') }}" style="text-decoration: none">
                ثبت نام
            </a>
            <a class="btn btn-success" href="{{ route('login') }}" style="text-decoration: none">
                ورود
            </a>
            @endguest
            @yield('start-navbar-header')
        </div>

    </nav>
</header>
<!--end top header-->
