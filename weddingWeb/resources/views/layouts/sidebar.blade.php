<aside class="app-sidebar bg-body-secondary shadow" data-bs-theme="dark">
    <!--begin::Sidebar Brand-->
    <div class="sidebar-brand">
        <!--begin::Brand Link-->
        <a href="{{route('home')}}" class="brand-link">
            <!--begin::Brand Image-->
            <img src="{{ asset( 'AdminLTE/dist/assets/img/AdminLTELogo.png')}}" alt="AdminLTE Logo"
                class="brand-image opacity-75 shadow" />
            <!--end::Brand Image-->
            <!--begin::Brand Text-->
            <span class="brand-text fw-light">AdminLTE 4</span>
            <!--end::Brand Text-->
        </a>
        <!--end::Brand Link-->
    </div>
    <!--end::Sidebar Brand-->
    <!--begin::Sidebar Wrapper-->
    <div class="sidebar-wrapper">
        <nav class="mt-2">
            <!--begin::Sidebar Menu-->
            <ul class="nav sidebar-menu flex-column" data-lte-toggle="treeview" role="menu" data-accordion="false">
            @auth
            @if(auth()->user()->role === 'admin')
                <li class="nav-item active">
                    <a href="{{ route('admin.dashboard.index') }}" class="nav-link {{ request()->routeIs('admin.dashboard.index') ? 'active' : '' }}">
                        <i class="nav-icon bi bi-speedometer"></i>
                        <p>
                            Dashboard
                        </p>
                    </a>
                </li>
                <li class="nav-item ">
                    <a href="{{ route('admin.catalogue.index') }}" class="nav-link {{ request()->routeIs('admin.catalogue.*') ? 'active' : '' }}">
                        <i class="nav-icon bi bi-box-seam-fill"></i>
                        <p>
                            Catalogue
                        </p>
                    </a>
                </li>
                <li class="nav-item ">
                    <a href="{{ route('admin.order.index') }}" class="nav-link {{ request()->routeIs('admin.order.*') ? 'active' : '' }}">
                        <i class="nav-icon bi bi-cart"></i>
                        <p>
                            Order
                        </p>
                    </a>
                </li>
                <li class="nav-item ">
                    <a href="{{ route('admin.report.index') }}" class="nav-link {{ request()->routeIs('admin.report.index') ? 'active' : '' }}">
                        <i class="nav-icon bi bi-clipboard-fill"></i>
                        <p>
                            Report
                        </p>
                    </a>
                </li>
                @elseif(auth()->user()->role === 'user')
                    <li class="nav-item">
                        <a href="{{ route('user.dashboard.index') }}" class="nav-link {{ request()->routeIs('user.dashboard.index') ? 'active' : '' }}">
                            <i class="nav-icon bi bi-speedometer"></i>
                            <p>
                                Dashboard
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('user.order.index') }}" class="nav-link {{ request()->routeIs('user.order.*') ? 'active' : '' }}">
                            <i class="nav-icon bi bi-cart"></i>
                            <p>
                                Order
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('user.profile.edit') }}" class="nav-link {{ request()->routeIs('user.profile.*') ? 'active' : '' }}">
                            <i class="nav-icon bi bi-person"></i>
                            <p>
                                Profile
                            </p>
                        </a>
                    </li>
                @endif
                @endauth
            </ul>
            <!--end::Sidebar Menu-->
        </nav>
    </div>
    <!--end::Sidebar Wrapper-->
</aside>
