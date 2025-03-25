<aside class="menu-sidebar d-none d-lg-block">
    <div class="logo">
        <a href="#">
            <img width="40px" src="https://cdn-icons-png.flaticon.com/512/9307/9307284.png" alt="Cool Admin" />
       Expenses
        </a>
    </div>
    <div class="menu-sidebar__content js-scrollbar1">
        <nav class="navbar-sidebar">
            <ul class="list-unstyled navbar__list">
                <li class="active has-sub">
                    <a class="js-arrow" href="#">
                        <i class="fas fa-tachometer-alt"></i>Dashboard</a>

                </li>
                <li>
                    <a href="{{route('expenses.index')}}">
                        <i class="fas fa-money-bill-wave"></i>
                        Expenses </a>
                </li>
                <li>
                    <a href="{{route('budgets.index')}}">
                        <i class="fas fa-wallet"></i>
                        Budgets </a>
                </li>

                <li>
                    <a href="{{ route('category.index') }}">
                        <i class="fas fa-folder"></i>
                        Category
                    </a>
                </li>

                <li>
                    <a href="{{route('report.index')}}">
                        <i class="fas fa-chart-line"></i>Reports </a>
                </li>

                <li>
                    <a href="{{ route('groups.index') }}">
                        <i class="fas fa-users"></i> Groups
                    </a>
                </li>
                <li>
                    <a href="{{ route('group-expenses.index') }}">
                        <i class="fas fa-money-bill-wave"></i> Group Expenses
                    </a>
                </li>

                <li>
                    <a href="{{ route('rewards.index') }}">
                        <i class="fas fa-trophy"></i> Rewards
                    </a>
                </li>

                <li>
                    <a href="#">
                        <i class="fas fa-cog"></i>Settings </a>
                </li>
                <li>
                    <a href="map.html">
                        <i class="fas fa-headset"></i>Contact Support</a>
                </li>
                <li>
                    <a href="map.html">
                        <i class="fas fa-question-circle"></i>FAQ </a>
                </li>


            </ul>
        </nav>
    </div>
</aside>
