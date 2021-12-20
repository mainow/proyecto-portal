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
    tr:hover button {
        display: block !important;
    }
</style>
<div class="container pt-2">
    <?php 
    Form::create("", "POST", $params["addCategoryValidator"], 
    [
        new InputWidget("text", "category", "Categoria", Validation::$CATEGORYEXISTS, cssClasses:"mb-0 col-lg")
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
                        <td><?php echo $category[0] ?></td>
                        <td>
                            <?php
                            Form::create("", "POST", $params["removeCategoryValidator"], [
                            ], new ButtonWidget("submit-remove-category", "<i class='fas fa-trash'></i> Eliminar", $category[0], "btn-sm btn-danger", "position: absolute; right: 1.2rem; transform: translateY(-25%);"));
                            ?>
                        </td>
                    </tr>
                    <?php
                }
            }
            ?>
        </tbody>
    </table> 
</div>