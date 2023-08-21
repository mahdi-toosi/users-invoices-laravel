<aside class="sidebar-wrapper bg-white" data-simplebar="true">
    <div class="sidebar-header bg-white">
        <div class="d-flex justify-content-between align-items-center  position-relative ">
            @auth
            <x-avatar-container>
                <x-avatar />
            </x-avatar-container>
            @endauth
            <div class="toggle-icon ms-auto position-absolute top-0 end-0 pt-2 ps-2">
                <i class="bi bi-list"></i>
            </div>
        </div>
        @auth
        <div class="mt-3 d-flex flex-column user-details">
            <span class="fw-bold">{{ auth()->user()->full_name  }}</span>
            <span class="small-text" style="font-size: 10px">{{ auth()->user()->mobile_number }}</span>
        </div>
        @else
        @endauth

    </div>
    <ul class="metismenu" id="menu" style="margin-top: 5.6rem">
        @auth
        <li>
            <a href="{{ route('dashboard') }}">
                <div class="parent-icon"><i class="bi bi-house"></i>
                </div>
                <div class="menu-title">داشبورد</div>
            </a>
        </li>
        @can('is-admin')
            <li>
                <a href="{{ route('users.index') }}">
                    <div class="parent-icon"><i class="bi bi-people"></i>
                    </div>
                    <div class="menu-title">کاربران</div>
                </a>
            </li>
            <li>
                <a href="{{ route('invoices.index') }}">
                    <div class="parent-icon"><i class="bi bi-receipt"></i>
                    </div>
                    <div class="menu-title">صورتحساب ها</div>
                </a>
            </li>
            <li>
                <a href="{{ route('products.index') }}">
                    <div class="parent-icon"><i class="bi bi-bag"></i>
                    </div>
                    <div class="menu-title">محصولات</div>
                </a>
            </li>
        @endcan
        <hr>
        <li>
            <a href="{{ route('me.invoices') }}">
                <div class="parent-icon"><i class="bi bi-receipt"></i>
                </div>
                <div class="menu-title">صورتحساب های من</div>
            </a>
        </li>
        <li>
            <a href="{{ route('me.profile') }}">
                <div class="parent-icon"><i class="bi bi-gear"></i>
                </div>
                <div class="menu-title">اطلاعات کاربری من</div>
            </a>
        </li>
        <li onclick="event.preventDefault();document.getElementById('logout-form').submit();">
            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                @csrf
            </form>
            <a class="dropdown-item" href="/logout">
                <div class="d-flex align-items-center">
                    <div class="parent-icon"><i class="bi bi-box-arrow-right"></i></div>
                    <div class="menu-title"><span>خروج</span></div>
                </div>
            </a>
        </li>
        @endauth
    </ul>
</aside>
