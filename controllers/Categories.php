<?php

class Categories extends Controller {
    function __construct() {
        $data = new DataModel;
        $categories = $data->getCategories();
        $addCategoryValidator = new FormValidator(Actions::$ADDCATEGORY, $_POST, ["category"], "submit-add-category");
        $addCategoryValidator->validateFields();
        $removeCategoryValdidator = new FormValidator(Actions::$REMOVECATEGORY, $_POST, ["submit-remove-category"], "");
        $editCategoryValidator = new FormValidator(Actions::$EDITCATEGORY, $_POST, ["submit-edit-category", "category-new-name"], "");
        // añadir categoria
        if (isset($_POST["submit-add-category"]) && !$addCategoryValidator->hasInvalidFields()) {
            $data->addCategory($addCategoryValidator->submittedFields["category"]);
            App::redirectUser("dashboard/categories");
        }
        // eliminar categoria
        if (isset($_POST["submit-remove-category"])) {
            if (!$data->isCategoryInUse($removeCategoryValdidator->submittedFields["submit-remove-category"])) {
                $data->removeCategory($removeCategoryValdidator->submittedFields["submit-remove-category"]);
                App::redirectUser("dashboard/categories");
            } 
            echo "<script>alert('La categoria no se puede eliminar porque ya esta en uso')</script>";
        }
        // editar categoria
        if (isset($_POST["submit-edit-category"])) {
            $data->editCategory($editCategoryValidator->submittedFields["submit-edit-category"], $editCategoryValidator->submittedFields["category-new-name"]);
            App::redirectUser("dashboard/categories");
        }
        $this->renderView("dashboard-categories", [ "categories" => $categories, "addCategoryValidator" => $addCategoryValidator, "removeCategoryValidator" => $removeCategoryValdidator, "editCategoryValidator" => $editCategoryValidator]);
    }
}