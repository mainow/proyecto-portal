<style>  
    /* primera columna */
    thead tr th:nth-child(1), tbody tr td:nth-child(1) {
        width: 1.5rem;
    }
    /* segunda columna */
    thead tr th:nth-child(2), tbody tr td:nth-child(2) {
        flex: 1
    }
    /* tercera columna */
    thead tr th:last-child, tbody tr td:last-child {
        width: 11rem;
        display: flex;
    }
    tbody tr td:last-child {
        gap: .5rem;
        justify-content: flex-end;
    }
    
</style>
<script>
    $(document).ready( function () {
        $.noConflict();
        $('#categoriesTable').dataTable({
            // ! cambiar idioma
        });
    } );
</script> 
<div class="container pt-2">
    <!-- Form añadir categoria -->
    <?php 
    echo new FormWidget("", "POST", $params["addCategoryValidator"], 
    [
        new InputWidget("text", "category", "Categoria", Validation::$CATEGORYEXISTS, cssClasses:"mb-0 col-lg", properties:"autofocus='autofocus'")
    ], new ButtonWidget("submit-add-category", "Agregar", cssClasses:"col-sm-1", style:"height: min-content; width: 100%"), 
    cssClasses:"container row mb-0 mt-2");
    ?>
    <!-- /Form añadir categoria -->
    
    <!-- Categorias datatable -->
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
                foreach ($params["categories"] as $categoryIndex => $category) {
                    ?>
                    <tr class="d-flex" style="position: relative">
                        <td><?php echo $category[0] ?></td>
                        <td><?php echo $category[1] ?></td>
                        <td>
                            <?php
                            $categoryEditModal = $category[1]."CategoryEditModal";
                            $categoryDeleteModal = $category[1]."DeleteEditModal";
                            echo new ButtonWidget("submit-edit-category", "<i class='fas fa-edit'></i> Editar", $category[0], "btn-sm btn-success", properties:"data-toggle='modal' data-target='#$categoryEditModal'");
                            echo new ButtonWidget("submit-remove-category", "<i class='fas fa-trash'></i> Eliminar", $category[0], "btn-sm btn-danger", properties:"data-toggle='modal' data-target='#$categoryDeleteModal'");
                            ?>
                            <!-- Modal editar categoria -->
                            <?php 
                            echo new ModalWidget($categoryEditModal, 'Editar Categoria "'.$category[1].'"', 
                                new FormWidget("", "POST", $params["editCategoryValidators"][$categoryIndex], [
                                    new InputWidget("text", "category-new-name", "ej: Plasticos", Validation::$CATEGORYEXISTS, label:"Nuevo nombre", properties:"autofocus='autofocus'"),
                                    new InputWidget("hidden", "category-id", "", value:$category[0])
                                ], new ButtonWidget("submit-edit-category-".$category[1], "Guardar", cssClasses:"btn-block"), $params["editCategoryValidators"][$categoryIndex]->submittedFields),
                                showOnLoad:$params["editCategoryValidators"][$categoryIndex]->hasInvalidFields()
                            );
                            echo new ModalWidget($categoryDeleteModal, 'Remover Categoria "'.$category[1].'"', 
                                // echo new ButtonWidget("a", "Cancelar", cssClasses:"", style:"height: min-content", properties:"data-dismiss='modal'");
                                new FormWidget("", "POST", $params["removeCategoryValidator"], [
                                    new InputWidget("hidden", "category", "", value:$category[0]),
                                ], new ButtonWidget("submit-remove-category", "<i class='fas fa-trash'></i> Si, estoy seguro/a", cssClasses:"btn-danger btn-block"))
                            );
                            ?>
                            <!-- /Modal eliminar categoria -->
                        </td>
                    </tr>
                    <?php
                }
            }
            ?>
        </tbody>
    </table> 
    <!-- /Categorias datatable -->
</div>