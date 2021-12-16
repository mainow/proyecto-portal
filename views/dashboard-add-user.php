<div class="container-sm">
    <h3>Datos Personales:</h3>
    <?php
    echo $params["feedback"];
    Form::create("", "POST", $params["addUserValidator"], [
        new Field("text", "first-name", "Nombre/s", fAIcon:"fas fa-user", label:"Nombre"),
        new Field("text", "last-name", "Apellido/s", fAIcon:"far fa-user", label:"Apellido"),
        new Field("password", "pwd", "Contraseña", Validation::$PWD, "fas fa-key", "Contraseña"),
        new Field("text", "id", "DN/LC/Pasaporte", fAIcon:"fas fa-envelope", label:"Numero de documento"),
        new Field("date", "born-date", "", fAIcon: "fas fa-phone", label:"Fecha de nacimiento"),
        new Field("email", "email", "Correo electronico", fAIcon:"fas fa-map-marker-alt", label:"Email"),
        new Field("text", "category", "Categoria", fAIcon:"fas fa-map-marked-alt", label:"Categoria"),
        new Field("date", "entry-date", "", fAIcon:"fas fa-map-marked-alt", label:"Fecha de ingreso"),
    ], "Guardar", $params["fieldValues"] ?? []);
    ?>
    
</div>