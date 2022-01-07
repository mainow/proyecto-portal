<style> 
    
</style>
<script>
    $(document).ready( function () {
        $.noConflict();
        $('#usersTable').dataTable({
            // ! cambiar idioma
        });
    });
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
                new InputProfileImageWidget("profile-img", Validation::$VALIDUSERPROFILEPICTURE, "Imagen de perfil", cssClasses:"col-3"),
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
        ], new ButtonWidget("submit-add-user", "Crear", cssClasses:"btn-block"), $params["addUserFormfieldValues"])
    , "modal-lg", $params["addUserValidator"]->hasInvalidFields());
    ?>
    <!-- /Crear usuario modal -->

    <!-- Usuarios datatable -->
    <table id="usersTable" class="table table-striped bg-white">
        <thead>
            <tr>
                <th>Foto</th>
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

                $userProfileImg = $user[0];
                $userFirstName = $user[1];
                $userLastName = $user[2];
                $userId = $user[3];
                $userPwd = $user[4];
                $userBornDate = $user[5];
                $userEmail = $user[6];
                $userCategory = $user[7];
                $userEntryDate = $user[8];
                $userIdKey = $user[9];
                $userActive = $user[10];

                $options = [];
                foreach ($params["categories"] as $category) {
                    $property = $category[0] == $userCategory ? "selected" : "";
                    $options[] = new OptionWidget($category[0], $category[1], properties:"$property");
                }
                $editUserModalId = "user".$userId."Edit";
                $disableUserModalId = "user".$userId."Disable";
                $userInfoClass = $userActive == 0 ? "text-muted" : "";
                ?>
                <tr>
                    <td>
                        <?php 
                        $url = App::getBaseUrl();
                        $userImg = "$url/uploads/users/$userProfileImg";
                        echo <<<HTML
                            <img class="img-circle elevation-2" style="width: 2rem; height: 2rem; object-fit: cover" src="$userImg" alt="Imagen de perfil">
                        HTML; ?>
                    </td>
                    <?php
                    echo <<<HTML
                    <td class="$userInfoClass">$userId</td>
                    <td class="$userInfoClass">$userFirstName</td>
                    <td class="$userInfoClass">$userLastName</td>
                    HTML;
                    ?>
                    <td>
                    <!-- Editar usuario modal -->
                    <?php 
                        echo new ButtonWidget("", "<i class='fas fa-edit'></i> Editar", cssClasses:"btn-sm btn-success", properties:"data-toggle='modal' data-target='#$editUserModalId'");

                        if ($userActive == 0) {
                            // formulario habilitar usuario
                            echo new ButtonWidget("", "<i class='far fa-plus-square'></i> Habilitar", cssClasses:"btn-sm btn-info", properties:"data-toggle='modal' data-target='#$disableUserModalId'");
                            echo new ModalWidget($disableUserModalId, 'Habilitar Usuario "'.$userFirstName.'"', 
                                new FormWidget("", "POST", $params["enableUserValidators"][$userIndex], [
                                    new InputWidget("hidden", "user-id", "", value:$userId),
                                ], new ButtonWidget("submit-enable-user-$userId", "<i class='far fa-plus-square'></i> Si, estoy seguro/a", cssClasses:"btn-info btn-block"))
                            );
                        } else {
                            // formulario deshabilitar usuario
                            echo new ButtonWidget("", "<i class='far fa-minus-square'></i> Deshabilitar", cssClasses:"btn-sm btn-warning", properties:"data-toggle='modal' data-target='#$disableUserModalId'");
                            echo new ModalWidget($disableUserModalId, 'Deshabilitar Usuario "'.$userFirstName.'"', 
                                new FormWidget("", "POST", $params["disableUserValidators"][$userIndex], [
                                    new InputWidget("hidden", "user-id", "", value:$userId),
                                ], new ButtonWidget("submit-disable-user-$userId", "<i class='far fa-minus-square'></i> Si, estoy seguro/a", cssClasses:"btn-warning btn-block"))
                            );
                        }
                        
                        // formulario editar usuario
                        echo new ModalWidget($editUserModalId, "Editar Usuario", 
                            new FormWidget("", "POST", $params["editUserValidators"][$userIndex], [
                                [
                                    new InputProfileImageWidget("profile-img-$userIdKey", Validation::$VALIDUSERPROFILEPICTURE, label:"Imagen de perfil", defaultImage:$userImg, showText:false, cssClasses:"col-3"),    
                                    new InputWidget("text", "first-name", "Nombre/s", value:$userFirstName,fAIcon:"fas fa-user", label:"Nombre"),
                                    new InputWidget("text", "last-name", "Apellido/s", value:$userLastName,fAIcon:"far fa-user", label:"Apellido")
                                ],
                                [ 
                                    new InputWidget("number", "id", "DN/LC/Pasaporte", value:$userId,fAIcon:"fas fa-id-card", label:"Numero de documento"),
                                    new InputWidget("date", "born-date", "", value:$userBornDate,fAIcon: "fas fa-birthday-cake", label:"Fecha de nacimiento")
                                ],
                                [
                                    new InputWidget("email", "email", "Correo electronico", value:$userEmail, fAIcon:"fas fa-envelope", label:"Email"),
                                    new SelectWidget("category", $options, "Categoria"),
                                ],
                                new InputWidget("date", "entry-date", "", value:$userEntryDate, fAIcon:"fas fa-calendar-day", label:"Fecha de ingreso"),
                                // para la validacion de id y email mas tarde
                                new InputWidget("hidden", "user-initial-id", "", fAIcon:"", value:$userId),
                                new InputWidget("hidden", "user-initial-email", "", fAIcon:"", value:$userEmail),
                                // cada formulario tiene un valor de submit unico con el numero de cedula del usuario
                            ], new ButtonWidget("submit-edit-user-".$userId, "Guardar Cambios", cssClasses:"btn-block"))
                        , "modal-lg", $params["editUserValidators"][$userIndex]->hasInvalidFields())
                    ?>
                    <!-- /Editar usuario modal -->
                    </td>
                </tr>
                <?php
            }
            ?>
        </tbody>
    </table>   
    <!-- /Usuarios datatable -->  
</div>