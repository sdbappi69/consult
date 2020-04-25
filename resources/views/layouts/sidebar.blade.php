<aside class="menu-sidebar d-none d-lg-block">
    <div class="logo">
        <a href="#">
            <img src="{{asset('/')}}images/icon/logo.png" alt="Cool Admin" />
        </a>
    </div>
    <div class="menu-sidebar__content js-scrollbar1">
        <nav class="navbar-sidebar">
            <ul class="list-unstyled navbar__list">
                @can('dashboard')
                    <li>
                        <a href="{{route('home')}}">
                            <i class="fas fa-tachometer-alt"></i>Dashboard</a>
                    </li>
                @endcan
                @can('accept user request')
                    <li>
                        <a href="{{route('user.request_list')}}">
                            <i class="fas fa-hand-paper-o"></i>User Request List</a>
                    </li>
                @endcan
                @can('service list')
                    <li>
                        <a href="{{route('service.index')}}">
                            <i class="fas fa-cog"></i>Service List</a>
                    </li>
                @endcan
                @can('categpry list')
                    <li>
                        <a href="{{route('category.index')}}">
                            <i class="fas fa-list"></i>Category List</a>
                    </li>
                @endcan
                @can('provider category list')
                    <li>
                        <a href="{{route('category_provider.index')}}">
                            <i class="fas fa-refresh"></i>Provider's Category</a>
                    </li>
                @endcan
                @can('provider category request list')
                    <li>
                        <a href="{{route('category_provider.reqList')}}">
                            <i class="fas fa-universal-access"></i>Provider's Request List</a>
                    </li>
                @endcan
                @can('manage slot')
                    <li>
                        <a href="{{route('slot.index')}}">
                            <i class="fas fa-calendar-times"></i>Manage Slots</a>
                    </li>
                @endcan
                @can('appointment list')
                    <li>
                        <a href="{{route('appointment.index')}}">
                            <i class="fas fa-list-alt"></i>Appointment List</a>
                    </li>
                @endcan
                @canany('permission list','role list', 'user manage')
                    <li class="has-sub">
                        <a class="js-arrow" href="#">
                            <i class="fas fa-cogs"></i>User Role Management </a>
                        <ul class="list-unstyled navbar__sub-list js-sub-list">
                            @can('permission list')
                                <li>
                                    <a href="{{route('permission.index')}}"> <i class="fas fa-lock"></i> Permission Manage</a>
                                </li>
                            @endcan
                            @can('role list')
                                <li>
                                    <a href="{{route('role.index')}}"> <i class="fas fa-lock"></i> Role Manage</a>
                                </li>
                            @endcan
                            @can('user manage')
                                <li>
                                    <a href="{{route('user.index')}}"> <i class="fas fa-users"></i> User Manage</a>
                                </li>
                            @endcan
                        </ul>
                    </li>
                @endcanany
            </ul>
        </nav>
    </div>
</aside>