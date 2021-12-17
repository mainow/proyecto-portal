<div class="container-sm py-3">
    <h3>Datos Personales:</h3>
    <?php
    echo $params["feedback"];
    $options = [];
    foreach ($params["categories"] as $category) {
        $options[] = new OptionWidget($category[0], $category[0]);
    }
    Form::create("", "POST", $params["addUserValidator"], [
        [
            new InputWidget("text", "first-name", "Nombre/s", fAIcon:"fas fa-user", label:"Nombre"),
            new InputWidget("text", "last-name", "Apellido/s", fAIcon:"far fa-user", label:"Apellido")
        ],
        [ 
            new InputWidget("password", "pwd", "Contraseña", Validation::$PWD, "fas fa-key", "Contraseña"),
            new InputWidget("text", "id", "DN/LC/Pasaporte", fAIcon:"fas fa-id-card", label:"Numero de documento"),
            new InputWidget("date", "born-date", "", fAIcon: "fas fa-birthday-cake", label:"Fecha de nacimiento")
        ],
        new InputWidget("email", "email", "Correo electronico", fAIcon:"fas fa-envelope", label:"Email"),
        // new InputWidget("text", "category", "Categoria", fAIcon:"fas fa-trophy", label:"Categoria"),
        new SelectWidget("category", $options, "Categoria"),
        new InputWidget("date", "entry-date", "", fAIcon:"fas fa-calendar-day", label:"Fecha de ingreso"),
    ], new ButtonWidget("submit-add-user", "Crear Usuario", "btn-block"), $params["fieldValues"]);
    ?>
    
</div>