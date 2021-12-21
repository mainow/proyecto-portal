<style>  
    table {
        border: 0 !important
    }

    tr button {
        visibility: hidden;
    }

    .modal button {
        visibility: visible;    
    }

    tr:hover button {
        visibility: visible;
    }

    thead th {
        padding: .7em !important;
        border: 0 !important;
    }

    thead tr {
        display: flex;
    }

    /* primera columna */
    thead tr th:nth-child(1), tbody tr td:nth-child(1) {
        width: 1.5rem;
    }
    /* segunda columna */
    thead tr th:nth-child(2), tbody tr td:nth-child(2) {
        flex: 1
    }
    /* tercera columna */
    thead tr th:nth-child(3), tbody tr td:nth-child(3) {
        min-width: 10rem;
        display: flex;
        gap: .5rem
    }

        /* creados despues por datatable */
    .paginate_button.current:hover {
        color: var(--blue) !important;
        background-color: red !important;
    }
</style>
<script>
    $(document).ready( function () {
        console.log("hola");
        $.noConflict();
        $('#categoriesTable').dataTable({
            // ! cambiar idioma
        });
    } );
</script> 
<div class="container px-4 pt-2">
    <?php 
    Form::create("", "POST", $params["addCategoryValidator"], 
    [
        new InputWidget("text", "category", "Categoria", Validation::$CATEGORYEXISTS, cssClasses:"mb-0 col-lg", properties:"autofocus='autofocus'")
    ], new ButtonWidget("submit-add-category", "Agregar", cssClasses:"col-sm-1", style:"height: min-content; width: 100%"), 
    cssClasses:"container row mb-0 mt-2");
    ?>
    <table id="categoriesTable" class="table table-striped bg-white">
        <thead>
            <tr class="d-flex">
                <th>Id</th>
                <th>Nombre</th>
                <th>Accion</th>
            </tr>
        </thead>
        <tbody>
            <?php 
            if ($params["categories"] != 0) {
                foreach ($params["categories"] as $category) {
                    ?>
                    <tr class="d-flex" style="position: relative">
                        <td><?php echo $category[0] ?></td>
                        <td><?php echo $category[1] ?></td>
                        <td>
                            <?php
                            $categoryEditBtnName = $category[1]."CategoryEditModal";
                            $categoryDeleteBtnName = $category[1]."DeleteEditModal";
                            echo new ButtonWidget("submit-edit-category", "<i class='fas fa-edit'></i> Editar", $category[0], "btn-sm btn-success", properties:"data-toggle='modal' data-target='#$categoryEditBtnName'");
                            echo new ButtonWidget("submit-remove-category", "<i class='fas fa-trash'></i> Eliminar", $category[0], "btn-sm btn-danger", properties:"data-toggle='modal' data-target='#$categoryDeleteBtnName'");
                            ?>
                            <!-- Edit category modal -->
                            <div class="modal fade" id="<?php echo $categoryEditBtnName ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Editar categoria "<?php echo $category[1] ?>"</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <?php 
                                            Form::create("", "POST", $params["editCategoryValidator"], [
                                                new InputWidget("text", "category-new-name", "ej: Plasticos", label:"Nuevo nombre", properties:"autofocus='autofocus'")
                                            ], new ButtonWidget("submit-edit-category", "Guardar", $category[0], cssClasses:"btn-block"));
                                            ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Delete category modal -->
                            <div class="modal fade" id="<?php echo $categoryDeleteBtnName ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Eliminar categoria "<?php echo $category[1] ?>"</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body" style="gap: 10px">
                                            <p>Una vez que eliminas la categoria no podras deshacer tus acciones, estas seguro/a?</p>
                                            <?php 
                                            // echo new ButtonWidget("a", "Cancelar", cssClasses:"", style:"height: min-content", properties:"data-dismiss='modal'");
                                            Form::create("", "POST", $params["removeCategoryValidator"], [
                                            ], new ButtonWidget("submit-remove-category", "<i class='fas fa-trash'></i> Si, estoy seguro/a", $category[0], "btn-danger btn-block"));
                                            ?>
                                        </div>
                                        <!-- <div class="modal-body d-flex justify-content-end" style="gap: 10px">
                                            <?php
                                            /* 
                                            echo new ButtonWidget("a", "Cancelar", cssClasses:"", style:"height: min-content", properties:"data-dismiss='modal'");
                                            Form::create("", "POST", $params["removeCategoryValidator"], [
                                            ], new ButtonWidget("submit-remove-category", "<i class='fas fa-trash'></i> Eliminar", $category[0], "btn-danger"));
                                            */
                                            ?>
                                        </div> -->
                                    </div>
                                </div>
                            </div>
                        </td>
                    </tr>
                    <?php
                }
            }
            ?>
        </tbody>
    </table> 
</div>