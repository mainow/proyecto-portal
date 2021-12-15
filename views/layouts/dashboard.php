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
        <li class="nav-item d-none d-sm-inline-block">
            <a href="#" class="nav-link">Contacto</a>
        </li>
    </ul>
    <ul class="navbar-nav ml-auto">
        <a href="<?php echo App::getBaseUrl()?>/logout">Cerrrar Sesion</a>
    </ul>
</nav>
<aside class="main-sidebar sidebar-dark-primary elevation-4">
	<!-- Brand Logo -->
    <a href="/" class="brand-link">
        <img src="<?php echo App::getBaseUrl()?>/dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">Portal</span>
    </a>
    <!-- Sidebar -->
    <div class="sidebar">
    <!-- Sidebar user (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="<?php echo App::getBaseUrl()?>/dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <a href="<?php echo App::getBaseUrl() ?>/dashboard/profile/edit" class="d-block"><?php echo App::getLoggedInUser() ?></a>
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
    <!-- /.sidebar-menu -->
    </div>
<!-- /.sidebar -->
</aside>
{{ content }}
</div>