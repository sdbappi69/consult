<aside class="menu-sidebar d-none d-lg-block">
    <div class="logo">
        <a href="#">
            <img src="{{asset('/')}}images/icon/logo.png" alt="Cool Admin" />
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
                    <a href="{{route('user.request_list')}}">
                        <i class="fas fa-hand-paper-o"></i>User Request List</a>
                </li>
                <li>
                    <a href="{{route('service.index')}}">
                        <i class="fas fa-cog"></i>Service List</a>
                </li>
                <li>
                    <a href="{{route('service.index')}}">
                        <i class="fas fa-calendar-times"></i>Manage Slots</a>
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