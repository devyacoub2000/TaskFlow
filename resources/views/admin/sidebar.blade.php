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

        <!-- Divider -->
        <hr class="sidebar-divider my-0">

        <!-- Dashboard -->
        <li class="nav-item {{ request()->routeIs('admin.index') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('admin.index') }}">
                <i class="fas fa-chart-line"></i>
                <span>Dashboard</span>
            </a>
        </li>

        <hr class="sidebar-divider my-0">

        <!-- Reservations -->
        <li class="nav-item">
            <a class="nav-link" href="">
                <i class="fas fa-calendar-check"></i>
                <span>Teams</span>
            </a>
        </li>



        <hr class="sidebar-divider">

        <!-- Room Management -->
        <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse"
                data-target="#collapseroom"
                aria-expanded=""
                aria-controls="collapseroom">
                <i class="fas fa-bed"></i>
                <span>task</span>
            </a>
            <div id="collapseroom" class="collapse"
                data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <h6 class="collapse-header">Task Management:</h6>
                    <a class="collapse-item" href="">All Task</a>
                    <a class="collapse-item" href="">Add Task</a>
                </div>
            </div>
        </li>


        <hr class="sidebar-divider">


        <hr class="sidebar-divider d-none d-md-block">

        <!-- Sidebar Toggler -->
        <div class="text-center d-none d-md-inline">
            <button class="rounded-circle border-0" id="sidebarToggle"></button>
        </div>
    </ul>
</div>