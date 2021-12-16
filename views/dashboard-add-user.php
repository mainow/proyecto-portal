<div class="container-sm">
    <h3>Datos Personales:</h3>
    <?php
    echo $params["feedback"];
    Form::create("", "POST", $params["addUserValidator"], [
        new Field("text", "first-name", "Nombre/s", fAIcon:"fas fa-user", label:"Nombre"),
        new Field("text", "last-name", "Apellido/s", fAIcon:"far fa-user", label:"Apellido"),
        new Field("password", "pwd", "Contraseña", Validation::$PWD, "fas fa-key", "Contraseña"),
        new Field("text", "id", "DN/LC/Pasaporte", fAIcon:"fas fa-id-card", label:"Numero de documento"),
        new Field("date", "born-date", "", fAIcon: "fas fa-birthday-cake", label:"Fecha de nacimiento"),
        new Field("email", "email", "Correo electronico", fAIcon:"fas fa-envelope", label:"Email"),
        new Field("text", "category", "Categoria", fAIcon:"fas fa-trophy", label:"Categoria"),
        new Field("date", "entry-date", "", fAIcon:"fas fa-calendar-day", label:"Fecha de ingreso"),
    ], "Guardar", $params["fieldValues"] ?? []);
    ?>
    
</div>