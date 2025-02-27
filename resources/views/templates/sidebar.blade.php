<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <a href="{{ route('dashboard') }}" class="brand-link">
        <img src="{{ asset('dist/img/android-chrome-512x512.png') }}" alt="logo" class="brand-image elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light"><b>{{ env('APP_NAME') }}</b></span>
    </a>

    <div class="sidebar">
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

                <li class="nav-header font-weight-bold mt-2">Main</li>
                <li class="nav-item">
                    <a href="{{ route('dashboard') }}" class="nav-link {{ request()->segment(1) == 'dashboard' ? 'active' : '' }}">
                        <i class="nav-icon fa fa-tachometer"></i>
                        <p>Dashboard</p>
                    </a>
                </li>
                <li class="nav-header font-weight-bold mt-2">Account</li>
                <li class="nav-item">
                    <a href="{{ route('profile.index') }}" class="nav-link {{ request()->segment(1) == 'profile' ? 'active' : '' }}">
                        <i class="nav-icon fa fa-user"></i>
                        <p>Profile</p>
                    </a>
                </li>

                @role('Admin')
                <li class="nav-header font-weight-bold mt-2">Admin</li>
                <li class="nav-item">
                    <a href="{{ route('admin.transactions.index') }}" class="nav-link {{ request()->segment(2) == 'transactions' ? 'active' : '' }}">
                        <i class="fa fa-database nav-icon"></i>
                        <p>Transactions</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('admin.users.index') }}" class="nav-link {{ request()->segment(2) == 'users' ? 'active' : '' }}">
                        <i class="fa fa-users nav-icon"></i>
                        <p>User List</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('admin.logs.index') }}" class="nav-link {{ request()->segment(2) == 'logs' ? 'active' : '' }}">
                        <i class="fa fa-info nav-icon"></i>
                        <p>Logs</p>
                    </a>
                </li>
                @endrole

                @role('User')
                <li class="nav-item">
                    <a href="#" class="nav-link {{ request()->segment(1) == 'registrasi-garansi' ? 'active' : '' }}">
                        <i class="nav-icon fa fa-bar-chart"></i>
                        <p>
                            Your Forms
                            <i class="right fa fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('registrasi-garansi.forms') }}" class="nav-link {{ request()->segment(1) == 'registrasi-garansi' ? 'active' : '' }}">
                                <i class="fa fa-circle nav-icon"></i>
                                <p>Registrasi Garansi</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('claim-garansi.forms') }}" class="nav-link">
                                <i class="fa fa-circle nav-icon"></i>
                                <p>Claim Garansi</p>
                            </a>
                        </li>
                    </ul>
                </li>
                @endrole


                <li class="nav-item">
                    <a href="{{ route('logout') }}" class="nav-link">
                        <i class="nav-icon fa fa-sign-out"></i>
                        <p>Log Out</p>
                    </a>
                </li>

            </ul>
        </nav>
    </div>
</aside>