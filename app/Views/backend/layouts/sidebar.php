<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="<?= base_url('/') ?>">
                <div class="sidebar-brand-text mx-3">
                    MOBIL
                </div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">
            <!-- Nav Item - Dashboard -->
            <li class="nav-item active">
                <a class="nav-link" href="<?= base_url('admin') ?>">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Dashboard</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                MENU
            </div>

            <li class="nav-item">
                <a class="nav-link" href="<?= base_url('admin/brand') ?>">
                    <i class="fas fa-fw fa-tags"></i>
                    <span>Brand</span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="<?= base_url('admin/cars') ?>">
                    <i class="fas fa-fw fa-car"></i>
                    <span>Cars</span>
                </a>
            </li>

            <div class="sidebar-heading">
                Information
            </div>

            <li class="nav-item">
                <a class="nav-link" href="<?= base_url('admin/banner') ?>">
                    <i class="fas fa-fw fa-images"></i>
                    <span>Banners</span>
                </a>
            </li>

            <div class="sidebar-heading">
                Account
            </div>

            <li class="nav-item">
                <a class="nav-link" href="<?= base_url('admin/admin') ?>">
                    <i class="fas fa-fw fa-user-cog"></i>
                    <span>Admin</span>
                </a>
            </li>
        </ul>
        <!-- End of Sidebar -->