<!-- Sidebar Menu -->
<nav class="mt-2">
    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <li class="nav-item">
            <a href="{{ route('dashboard.dashboard') }}"
                class="nav-link {{ request()->routeIs('dashboard.dashboard') ? 'active' : '' }}">
                <i class="nav-icon fas fa-tachometer-alt"></i>
                <p>Dashboard</p>
            </a>
        </li>

        @can('view', \App\Models\Category::class)
            <li class="nav-item">
                <a href="{{ route('dashboard.categories.index') }}"
                    class="nav-link {{ request()->routeIs('dashboard.categories.*') ? 'active' : '' }}">
                    <i class="far fa-circle nav-icon"></i>
                    <p>
                        Categories
                        <span class="right badge badge-danger">New</span>
                    </p>
                </a>
            </li>
        @endcan

        @can('view', \App\Models\Product::class)
            <li class="nav-item">
                <a href="{{ route('dashboard.products.index') }}"
                    class="nav-link {{ request()->routeIs('dashboard.products.*') ? 'active' : '' }}">
                    <i class="far fa-circle nav-icon"></i>
                    <p>
                        Products
                    </p>
                </a>
            </li>
        @endcan
        @can('view', \App\Models\Role::class)
            <li class="nav-item">
                <a href="{{ route('dashboard.orders.index') }}"
                    class="nav-link {{ request()->routeIs('dashboard.orders.*') ? 'active' : '' }}">
                    <i class="far fa-circle nav-icon"></i>
                    <p>
                        Orders
                    </p>
                </a>
            </li>
        @endcan
        @can('view', \App\Models\Role::class)
            <li class="nav-item">
                <a href="{{ route('dashboard.roles.index') }}"
                    class="nav-link {{ request()->routeIs('dashboard.roles.*') ? 'active' : '' }}">
                    <i class="far fa-circle nav-icon"></i>
                    <p>
                        Roles
                    </p>
                </a>
            </li>
        @endcan
        @can('view', \App\Models\Admin::class)
            <li class="nav-item">
                <a href="{{ route('dashboard.admins.index') }}"
                    class="nav-link {{ request()->routeIs('dashboard.admins.*') ? 'active' : '' }}">
                    <i class="far fa-circle nav-icon"></i>
                    <p>
                        Admins
                    </p>
                </a>
            </li>
        @endcan
        @can('view', \App\Models\User::class)
            <li class="nav-item">
                <a href="{{ route('dashboard.users.index') }}"
                    class="nav-link {{ request()->routeIs('dashboard.users.*') ? 'active' : '' }}">
                    <i class="far fa-circle nav-icon"></i>
                    <p>
                        Users
                    </p>
                </a>
            </li>
        @endcan
    </ul>
</nav>
<!-- /.sidebar-menu -->
