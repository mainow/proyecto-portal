<?php 
require "config.php";
?>
<div class="d-flex align-items-center flex-column">
    <h1 class="display-1">Inicio</h1>
    <?php
    if (isset($_SESSION["username"])) {
        ?>
        <h2>Hola <?php echo $_SESSION["username"] ?></h2>
        <?php
    }
    ?>
<?php
    if (isset($_SESSION["username"])) {
        ?>
        <a href="logout">Cerrar Session</a>
        <a href="<?php echo $ROUTES["dashboard"] ?>">Ir al Dashboard</a>
        <?php
    } else {
        ?>
        <a href="login">Iniciar Sesion</a>
        <?php
    }
    ?>
</div>
