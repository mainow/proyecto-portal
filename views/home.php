<div class="d-flex align-items-center flex-column">
    <h1 class="display-1">Inicio</h1>
    <?php
    if (App::isUserLoggedIn()) {
        ?>
        <h2>Hola <?php echo App::getLoggedInUser() ?></h2>
        <a href="logout">Cerrar Session</a>
        <a href="dashboard">Ir al Dashboard</a>
        <?php
    } else {
        ?>
        <a href="login">Iniciar Sesion</a>
        <?php
    }
    ?>
</div>
