<aside class="sidebar-wrapper bg-white" data-simplebar="true">
    <div class="sidebar-header bg-white">
        <i style="font-size: 24px" class="bi bi-slack"></i>
        <div class="toggle-icon ms-auto"><i class="bi bi-list"></i></div>
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
                <div class="menu-title">صورتحساب</div>
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
            <a href="{{ route('me.invoices') }}" class="bg-light-info">
                <div class="parent-icon"><i class="bi bi-receipt"></i>
                </div>
                <div class="menu-title">صورتحساب من</div>
            </a>
        </li>
    </ul>
</aside>
