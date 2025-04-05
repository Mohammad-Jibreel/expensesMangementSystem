<aside class="menu-sidebar d-none d-lg-block">
    <div class="logo">
        <a href="#">
            <img width="40px" src="https://cdn-icons-png.flaticon.com/512/9307/9307284.png" alt="Cool Admin" />
            Spendiary
        </a>
    </div>
    <div class="menu-sidebar__content js-scrollbar1">
        <nav class="navbar-sidebar">
            <ul class="list-unstyled navbar__list">
                <li class="{{ request()->routeIs('dashboard.index') ? 'active' : '' }} has-sub">
                    <a class="js-arrow" href="{{ route('dashboard.index') }}">
                        <i class="fas fa-tachometer-alt"></i>Dashboard</a>
                </li>
                <li class="{{ request()->routeIs('expenses.index') ? 'active' : '' }}">
                    <a href="{{ route('expenses.index') }}">
                        <i class="fas fa-money-bill-wave"></i> Expenses </a>
                </li>
                <li class="{{ request()->routeIs('budgets.index') ? 'active' : '' }}">
                    <a href="{{ route('budgets.index') }}">
                        <i class="fas fa-wallet"></i> Budgets </a>
                </li>
                <li class="{{ request()->routeIs('category.index') ? 'active' : '' }}">
                    <a href="{{ route('category.index') }}">
                        <i class="fas fa-folder"></i> Category
                    </a>
                </li>
                <li class="{{ request()->routeIs('report.index') ? 'active' : '' }}">
                    <a href="{{ route('report.index') }}">
                        <i class="fas fa-chart-line"></i> Reports </a>
                </li>
                <li class="{{ request()->routeIs('savings.index') ? 'active' : '' }}">
                    <a href="{{ route('savings.index') }}">
                        <i class="fas fa-wallet"></i> Savings Wallet
                    </a>
                </li>
                <li class="{{ request()->routeIs('contact.create') ? 'active' : '' }}">
                    <a href="{{ route('contact.create') }}">
                        <i class="fas fa-headset"></i> Contact Support</a>
                </li>
            </ul>
        </nav>
    </div>
</aside>
