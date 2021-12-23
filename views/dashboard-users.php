<style> 
    .dataTable thead tr th:nth-child(1), .dataTable tbody tr td:nth-child(1) {
        width: 5rem !important;
    }

    .dataTable thead tr th:last-child, .dataTable tbody tr td:last-child {
        width: 5rem;
    }
    
    .dataTable thead th:not(.dataTable thead th:nth-child(1), .dataTable thead th:last-child),
    .dataTable tbody td:not(.dataTable tbody td:nth-child(1), .dataTable tbody td:last-child)  {
        flex: 1
    }
</style>
<script>
    $(document).ready( function () {
        $.noConflict();
        $('#usersTable').dataTable({
            // ! cambiar idioma
        });
        <?php 
        if ($params["addUserValidator"]->hasInvalidFields()) {
        ?>
            $(document).ready(function() {
                $('#createUserModal').modal('show');
            });
        <?php
        }?>
    } );
</script>
<div class="container-sm py-3">
    <!-- Intro banner -->
    <div class="rounded container border d-flex justify-content-between align-items-center bg-white py-2 px-3 mb-3">
        <div class="">Cantidad de usuarios: 
        <?php 
        $users = new UserModel;
        echo $users->getUserCount();
        ?>
        </div>
        <?php echo new ButtonWidget("", "Crear Usuario", properties:"data-toggle='modal' data-target='#createUserModal'")?> 
    </div>
    <!-- /Intro banner -->

    <!-- Crear usuario modal -->
    <?php
    $options = [];
    foreach ($params["categories"] as $category) {
        $options[] = new OptionWidget($category[0], $category[1]);
    }
    echo new ModalWidget("createUserModal", "Crear Usuario", 
        new FormWidget("", "POST", $params["addUserValidator"], [
            [
                new InputWidget("text", "first-name", "Nombre/s", fAIcon:"fas fa-user", label:"Nombre"),
                new InputWidget("text", "last-name", "Apellido/s", fAIcon:"far fa-user", label:"Apellido")
            ],
            [ 
                new InputWidget("password", "pwd", "Contraseña", Validation::$PWD, "fas fa-key", "Contraseña"),
                new InputWidget("number", "id", "DN/LC/Pasaporte", Validation::$IDINUSE, "fas fa-id-card", "Numero de documento"),
                new InputWidget("date", "born-date", "", fAIcon:"fas fa-birthday-cake", label:"Fecha de nacimiento")
            ],
            [
                new InputWidget("email", "email", "Correo electronico", Validation::$EMAILINUSE, "fas fa-envelope", "Email"),
                new SelectWidget("category", $options, "Categoria"),
            ],
            new InputWidget("date", "entry-date", "", fAIcon:"fas fa-calendar-day", label:"Fecha de ingreso"),
        ], new ButtonWidget("submit-add-user", "Crear", cssClasses:"btn-block"), $params["fieldValues"])
    , "modal-lg");
    ?>
    <!-- /Crear usuario modal -->

    <!-- Usuarios datatable -->
    <table id="usersTable" class="table table-striped bg-white">
        <thead>
            <tr class="d-flex">
                <th>Ci</th>
                <th>Nombre</th>
                <th>Apellido</th>
                <th>Accion</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $users = $users->getAllUsers();
            foreach ($users as $userIndex=>$user) {
                $options = [];
                foreach ($params["categories"] as $category) {
                    $property = $category[0 ] == $user[6] ? "selected" : "";
                    $options[] = new OptionWidget($category[0], $category[1], properties:"$property");
                }
                $editUserModalId = "user".$user[2]."Edit";
                ?>
                <tr class="d-flex">
                    <td><?php echo $user[2] ?></td>
                    <td><?php echo $user[0] ?></td>
                    <td><?php echo $user[1] ?></td>
                    <td>
                    <!-- Editar usuario modal -->
                    <?php 
                        echo new ButtonWidget("", "<i class='fas fa-edit'></i> Editar", cssClasses:"btn-sm btn-success", properties:"data-toggle='modal' data-target='#$editUserModalId'");
                        echo new ModalWidget($editUserModalId, "Editar Usuario", 
                            new FormWidget("", "POST", $params["editUserValidators"][$userIndex], [
                                [
                                    new InputWidget("text", "first-name", "Nombre/s", value:$user[0],fAIcon:"fas fa-user", label:"Nombre"),
                                    new InputWidget("text", "last-name", "Apellido/s", value:$user[1],fAIcon:"far fa-user", label:"Apellido")
                                ],
                                [ 
                                    new InputWidget("number", "id", "DN/LC/Pasaporte", value:$user[2],fAIcon:"fas fa-id-card", label:"Numero de documento"),
                                    new InputWidget("date", "born-date", "", value:$user[4],fAIcon: "fas fa-birthday-cake", label:"Fecha de nacimiento")
                                ],
                                [
                                    new InputWidget("email", "email", "Correo electronico", value:$user[5],fAIcon:"fas fa-envelope", label:"Email"),
                                    new SelectWidget("category", $options, "Categoria"),
                                ],
                                new InputWidget("date", "entry-date", "", value:$user[7],fAIcon:"fas fa-calendar-day", label:"Fecha de ingreso"),
                                // para la validacion de id y email mas tarde
                                new InputWidget("hidden", "user-initial-id", "", fAIcon:"", value:$user[2]),
                                new InputWidget("hidden", "user-initial-email", "", fAIcon:"", value:$user[5]),
                                // cada formulario tiene un valor de submit unico con el numero de cedula del usuario
                            ], new ButtonWidget("submit-edit-user-".$user[2], "Guardar Cambios", cssClasses:"btn-block"))
                        , "modal-lg");
                    ?>
                    <!-- /Editar usuarios modal -->
                    </td>
                </tr>
                <?php
            }
            ?>
        </tbody>
    </table>   
    <!-- /Usuarios datatable -->  
</div>