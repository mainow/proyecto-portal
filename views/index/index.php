<?php
    session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio</title>
</head>
<body>
    Inicio
    <?php 
        if (isset($_SESSION["username"])) {
            ?>
            <h1>Hola <?php echo $_SESSION["username"] ?></h1>
            <?php
        }
    ?>
    <?php
        if (isset($_SESSION["username"])) {
            ?>
            <a href="logout">Cerrar Session</a>
            <?php
        } else {
            ?>
            <a href="login">Iniciar Sesion</a>
            <?php
        }
    ?>
</body>
</html>