<body class="hold-transition sidebar-mini layout-fixed">    
    <div class="wrapper">
        <nav class="main-header navbar navbar-expand navbar-white navbar-light">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
                </li>
                <li class="nav-item d-none d-sm-inline-block">
                    <a href="/" class="nav-link">Inicio</a>
                </li>
            </ul>
            <ul class="navbar-nav ml-auto mr-2">
                <a href="<?php echo App::getBaseUrl()?>/logout">Cerrar Sesion</a>
            </ul>
        </nav>
        <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <!-- Brand Logo -->
            <a href="/" class="brand-link">
                <img src="<?php echo App::getBaseUrl()?>/uploads/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
                <span class="brand-text font-weight-light">Portal</span>
            </a>
            <!-- Sidebar -->
            <div class="sidebar ">
            <!-- Sidebar user (optional) -->
                <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                    <div class="image">
                        <img src="<?php echo App::getBaseUrl()?>/uploads/user1.jpg" class="img-circle elevation-2" alt="User Image">
                    </div>
                    <div class="info">
                        <a href="<?php echo App::getBaseUrl() ?>/dashboard/profile" class="d-block"><?php echo App::getLoggedInUser() ?></a>
                    </div>
                </div>
                <!-- SidebarSearch Form -->
                <div class="form-inline">
                    <div class="input-group" data-widget="sidebar-search">
                        <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
                        <div class="input-group-append">
                            <button class="btn btn-sidebar">
                                <i class="fas fa-search fa-fw"></i>
                            </button>
                        </div>
                    </div>
                </div>
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                        <?php if (App::isAdminLoggedIn()) {?>
                        <li class="nav-item">
                            <a href="<?php echo App::getBaseUrl()?>/dashboard/add-user" class="nav-link">
                                <i class="nav-icon fas fa-user-plus"></i>
                                <p>
                                    Añadir Usuario
                                </p>
                            </a>
                        </li>
                        <?php }?>
                    </ul>
                </nav>
            </div>
            <!-- /.sidebar-menu -->
        <!-- /.sidebar -->
        </aside>
        <div class="content-wrapper">
            <section class="content">
                {{ content }}
            </section>
        </div>
        <!-- <footer class="main-footer">
            <div class="float-right d-none d-sm-block">
            <b>Portal</b> Multimedia
            </div>
            <strong>Copyright &copy; 2021 <a href="https://adminlte.io">Portal Multimedia</a>.</strong> All rights reserved.
        </footer> -->
    </div>
</body>
