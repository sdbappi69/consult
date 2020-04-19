<aside class="menu-sidebar d-none d-lg-block">
    <div class="logo">
        <a href="#">
            <img src="images/icon/logo.png" alt="Cool Admin" />
        </a>
    </div>
    <div class="menu-sidebar__content js-scrollbar1">
        <nav class="navbar-sidebar">
            <ul class="list-unstyled navbar__list">
                <li>
                    <a href="{{route('home')}}">
                        <i class="fas fa-tachometer-alt"></i>Dashboard</a>
                </li>
                <li>
                    <a href="table.html">
                        <i class="fas fa-table"></i>Tables</a>
                </li>
                <li>
                    <a href="form.html">
                        <i class="far fa-check-square"></i>Forms</a>
                </li>
                <li>
                    <a href="#">
                        <i class="fas fa-calendar-alt"></i>Calendar</a>
                </li>
                <li>
                    <a href="map.html">
                        <i class="fas fa-map-marker-alt"></i>Maps</a>
                </li>
                <li class="has-sub">
                    <a class="js-arrow" href="#">
                        <i class="fas fa-copy"></i>Pages</a>
                    <ul class="list-unstyled navbar__sub-list js-sub-list">
                        <li>
                            <a href="login.html">Login</a>
                        </li>
                        <li>
                            <a href="register.html">Register</a>
                        </li>
                        <li>
                            <a href="forget-pass.html">Forget Password</a>
                        </li>
                    </ul>
                </li>
                <li class="has-sub">
                    <a class="js-arrow" href="#">
                        <i class="fas fa-cogs"></i>User Role Management </a>
                    <ul class="list-unstyled navbar__sub-list js-sub-list">
                        <li>
                            <a href="{{route('permission.index')}}"> <i class="fas fa-lock"></i> Permission Manage</a>
                        </li>
                        <li>
                            <a href="{{route('role.index')}}"> <i class="fas fa-lock"></i> Role Manage</a>
                        </li>
                        <li>
                            <a href="{{route('user.index')}}"> <i class="fas fa-users"></i> User Manage</a>
                        </li>
                    </ul>
                </li>
            </ul>
        </nav>
    </div>
</aside>