<aside class="sidebar-wrapper bg-white" data-simplebar="true">
    <div class="sidebar-header bg-white">
        <div class="d-flex justify-content-between align-items-center">
            <div class="avatar avatar-small">
                <x-avatar />
            </div>

            <div class="toggle-icon ms-auto">
                <i class="bi bi-list"></i>
            </div>
        </div>

        <div class="mt-3 d-flex flex-column user-details">
            <span class="fw-bold">{{ auth()->user()->full_name }}</span>
            <span class="small-text">{{ auth()->user()->mobile_number }}</span>
        </div>
    </div>

    <ul class="metismenu" id="menu">
        <li>
            <a href="{{ route('home') }}">
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
    </ul>
</aside>
