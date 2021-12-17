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
</style>
<div class="container pt-2">
    <?php 
    Form::create("", "POST", $params["addCategoryValidator"], 
    [
        new InputWidget("text", "category", "Categoria", Validation::$CATEGORYEXISTS, cssClasses:"mb-0")
    ], new ButtonWidget("submit-add-category", "Agregar", style:"height: min-content"), 
    cssClasses:"d-flex mb-0 mt-2")
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
                    <tr class="d-flex">
                        <td class="counterCell"></td>
                        <td><?php echo $category[0] ?></td>
                    </tr>
                    <?php
                }
            }
            ?>
        </tbody>
    </table> 
</div>