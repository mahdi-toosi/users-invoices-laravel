<!--start top header-->
<header class="top-header">
    <nav class="navbar navbar-expand gap-3 bg-white">
        <div class="top-navbar-right">
            <ul class="navbar-nav align-items-center">
                @auth
                    <li class="nav-item dropdown dropdown-user-setting">
                        <a class="nav-link dropdown-toggle dropdown-toggle-nocaret border border-2 border-black radius-10"
                           href="#" data-bs-toggle="dropdown">
                            <div class="user-setting d-flex align-items-center">
                                <div class="avatar avatar-small">
                                    <img
                                        src="{{ auth()->user()->avatar ? asset('storage/'.auth()->user()->avatar) : asset('/img/user.png')}}"
                                        alt="Avatar">
                                </div>
                                <div class="user-name">
                                    {{ auth()->user()->full_name }}
                                </div>
                            </div>
                        </a>

                        <ul class="dropdown-menu dropdown-menu-start">
                            <li>
                                <a class="dropdown-item" href="{{ route('home') }}">
                                    <div class="d-flex align-items-center">
                                        <div class=""><i class="bi bi-speedometer"></i></div>
                                        <div class="ms-3"><span>داشبورد</span></div>
                                    </div>
                                </a>
                            </li>

                            <li>
                                <a class="dropdown-item" href="{{ route('users.edit', auth()->user()->id) }}">
                                    <div class="d-flex align-items-center">
                                        <div class=""><i class="bi bi-person-circle"></i></div>
                                        <div class="ms-3"><span>ویرایش حساب کاربری</span></div>
                                    </div>
                                </a>
                            </li>

                            <li>
                                <hr class="dropdown-divider">
                            </li>

                            <li onclick="event.preventDefault();
                                            document.getElementById('logout-form').submit();">
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                                <a class="dropdown-item" href="">
                                    <div class="d-flex align-items-center">
                                        <div class=""><i class="bi bi-lock-fill"></i></div>
                                        <div class="ms-3"><span>خروج</span></div>
                                    </div>
                                </a>
                            </li>
                        </ul>
                    </li>
                @endguest
            </ul>
        </div>

        <div class="mobile-toggle-icon fs-3 ms-auto">
            <i class="bi bi-list"></i>
        </div>
    </nav>
</header>
<!--end top header-->
