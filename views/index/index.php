<?php
    session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile</title>
    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
    <!-- icheck bootstrap -->
    <link rel="stylesheet" href="plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="dist/css/adminlte.min.css">
</head>
<body>
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
            <a href="profile">Ir al Dashboard</a>
            <?php
        } else {
            ?>
            <a href="login">Iniciar Sesion</a>
            <?php
        }
        ?>
    </div>
</body>
</html>