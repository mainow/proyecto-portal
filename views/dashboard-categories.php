<style>
    table {
        counter-reset: tableCount;
    }

    .counterCell::before {
        content: counter(tableCount);
        counter-increment: tableCount;
    }

    .counterCell::after {
        content: "";
    }

    
    tr button {
        display: none !important
    }

    .modal button {
        display: block !important;
    }

    tr:hover button {
        display: block !important;
    }
</style>
<div class="container pt-2">
    <?php 
    Form::create("", "POST", $params["addCategoryValidator"], 
    [
        new InputWidget("text", "category", "Categoria", Validation::$CATEGORYEXISTS, cssClasses:"mb-0 col-lg", properties:"autofocus='autofocus'")
    ], new ButtonWidget("submit-add-category", "Agregar", cssClasses:"col-sm-1", style:"height: min-content; width: 100%"), 
    cssClasses:"container row mb-0 mt-2")
    ?>
    <table class="table table-striped bg-white">
        <thead>
            <tr class="d-flex">
                <th>#</th>
                <th style="flex: 1">Categorias</th>
            </tr>
        </thead>
        <tbody>
            <?php 
            if ($params["categories"] != 0) {
                foreach ($params["categories"] as $category) {
                    ?>
                    <tr class="d-flex" style="position: relative">
                        <td class="counterCell"></td>
                        <td><?php echo $category[1] ?></td>
                        <td>
                            <?php
                            $categoryEditBtnName = $category[1]."CategoryEditModal";
                            $categoryDeleteBtnName = $category[1]."DeleteEditModal";
                            echo new ButtonWidget("submit-remove-category", "<i class='fas fa-trash'></i> Eliminar", $category[0], "btn-sm btn-danger", "position: absolute; right: 1.2rem; transform: translateY(-25%);", properties:"data-toggle='modal' data-target='#$categoryDeleteBtnName'");
                            echo new ButtonWidget("submit-edit-category", "<i class='fas fa-edit'></i> Editar", $category[0], "btn-sm btn-success", "position: absolute; right: 7rem; transform: translateY(-25%);", properties:"data-toggle='modal' data-target='#$categoryEditBtnName'");
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
                                            <h5 class="modal-title" id="exampleModalLabel">Estas seguro que deseas eliminar la categoria "<?php echo $category[1] ?>"? Esta accion no se puede deshacer</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body d-flex justify-content-end" style="gap: 10px">
                                            <?php 
                                            echo new ButtonWidget("a", "Cancelar", cssClasses:"", style:"height: min-content", properties:"data-dismiss='modal'");
                                            Form::create("", "POST", $params["removeCategoryValidator"], [
                                            ], new ButtonWidget("submit-remove-category", "<i class='fas fa-trash'></i> Eliminar", $category[0], "btn-danger"));
                                            ?>
                                        </div>
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