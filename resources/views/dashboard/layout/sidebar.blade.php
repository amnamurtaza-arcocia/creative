<aside class="main-sidebar sidebar-dark-primary elevation-4 bg-info">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
        <img src="{{ asset('dashboard/dist/img/AdminLTELogo.png') }}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">Admin Dashboard</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column t" data-widget="treeview" role="menu" data-accordion="false">
                <li class="nav-item has-treeview ">
                    <a href="#" class="nav-link bg-dark ">
                        <i class="nav-icon fas fa-bullseye"></i>
                        <p>
                           Company
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{url('admin/company/create')  }}" class="nav-link ">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Add Company</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ url('admin/company/') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>View Company</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item has-treeview">
                    <a href="#" class="nav-link bg-dark">
                        <i class="nav-icon fas fa-bullseye"></i>
                        <p>
                           Employee
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ url('admin/employee/create') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Add Employee</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ url('admin/employee') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>View Employee</p>
                            </a>
                        </li>
                    </ul>
                </li>
                {{-- <li class="nav-item">
                    <a href="pages/widgets.html" class="nav-link">
                        <i class="nav-icon fas fa-bullseye"></i>
                        <p>
                            Widgets
                            <span class="right badge badge-danger">New</span>
                        </p>
                    </a>
                </li> --}}
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
