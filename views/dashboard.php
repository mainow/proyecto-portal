<?php 
require_once "views/components/dashboardSidebar.php";
require_once "views/components/dashboardNavbar.php";
renderDashboardNavbar();
renderDashboardSidebar($_SESSION["username"]);