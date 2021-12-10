<?php
require "config.php";
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>
<h1>Navbar</h1>
{{ content }}
<h2>Footer</h2>