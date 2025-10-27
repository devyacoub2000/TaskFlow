<style>
    .nav-item.active>.nav-link {
        background-color: #4e73df;
        color: white;
        font-weight: bold;
    }

    .nav-item.active>.nav-link::after {
        content: " 🔴";
        font-size: 14px;
        margin-left: 5px;
    }

    .collapse-item.active {
        font-weight: bold;
        color: #4e73df !important;
    }

    .collapse-item.active::after {
        content: " ⚡";
        font-size: 12px;
        margin-left: 5px;
    }
</style>

<div id="sidebar_color">
    <ul class="navbar-nav sidebar sidebar-dark accordion" id="accordionSidebar">
        <!-- Sidebar - Brand -->
        <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ url('/') }}">
            <div class="sidebar-brand-icon">
                <i class="fas fa-store"></i>
            </div>
            <div class="sidebar-brand-text mx-3">{{ env('APP_NAME') }}</div>
        </a>

        <hr class="sidebar-divider my-0">

        <!-- Dashboard -->
        <li class="nav-item {{ request()->routeIs('admin.index') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('admin.index') }}">
                <i class="fas fa-chart-line"></i>
                <span>Dashboard</span>
            </a>
        </li>

        <hr class="sidebar-divider">

        <!-- Team Management -->
        @php
        $teamRoutes = ['admin.team.index', 'admin.team.create', 'admin.team.edit'];
        @endphp
        <li class="nav-item {{ request()->routeIs($teamRoutes) ? 'active' : '' }}">
            <a class="nav-link {{ request()->routeIs($teamRoutes) ? '' : 'collapsed' }}" href="#"
                data-toggle="collapse"
                data-target="#collapseteam"
                aria-expanded="{{ request()->routeIs($teamRoutes) ? 'true' : 'false' }}"
                aria-controls="collapseteam">
                <i class="fas fa-users"></i>
                <span>Team</span>
            </a>
            <div id="collapseteam" class="collapse {{ request()->routeIs($teamRoutes) ? 'show' : '' }}"
                data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <h6 class="collapse-header">Team Management:</h6>
                    <a class="collapse-item {{ request()->routeIs('admin.team.index') ? 'active' : '' }}"
                        href="{{ route('admin.team.index') }}">All Teams</a>
                    <a class="collapse-item {{ request()->routeIs('admin.team.create') ? 'active' : '' }}"
                        href="{{ route('admin.team.create') }}">Add Team</a>
                </div>
            </div>
        </li>

        <hr class="sidebar-divider my-0">

        <!-- Users Management -->
        <li class="nav-item {{ request()->routeIs('admin.users') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('admin.users') }}">
                <i class="fas fa-user"></i>
                <span>Users</span>
            </a>
        </li>

        <hr class="sidebar-divider my-0">

        <!-- Task Management -->
        @php
        $taskRoutes = ['admin.task.index', 'admin.task.create', 'admin.task.edit'];
        @endphp
        <li class="nav-item {{ request()->routeIs($taskRoutes) ? 'active' : '' }}">
            <a class="nav-link {{ request()->routeIs($taskRoutes) ? '' : 'collapsed' }}" href="#"
                data-toggle="collapse"
                data-target="#collapsetask"
                aria-expanded="{{ request()->routeIs($taskRoutes) ? 'true' : 'false' }}"
                aria-controls="collapsetask">
                <i class="fas fa-users"></i>
                <span>Task</span>
            </a>
            <div id="collapsetask" class="collapse {{ request()->routeIs($taskRoutes) ? 'show' : '' }}"
                data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <h6 class="collapse-header">task Management:</h6>
                    <a class="collapse-item {{ request()->routeIs('admin.task.index') ? 'active' : '' }}"
                        href="{{ route('admin.task.index') }}">All Tasks</a>
                    <a class="collapse-item {{ request()->routeIs('admin.task.create') ? 'active' : '' }}"
                        href="{{ route('admin.task.create') }}">Add Task</a>
                </div>
            </div>
        </li>

        <hr class="sidebar-divider my-0">

        <hr class="sidebar-divider d-none d-md-block">

        <!-- Sidebar Toggler -->
        <div class="text-center d-none d-md-inline">
            <button class="rounded-circle border-0" id="sidebarToggle"></button>
        </div>
    </ul>
</div>