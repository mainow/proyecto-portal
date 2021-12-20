<?php

class Categories extends Controller {
    function __construct() {
        $data = new DataModel;
        $categories = $data->getCategories();
        $addCategoryValidator = new FormValidator(Actions::$ADDCATEGORY, $_POST, ["category"], "submit-add-category");
        $addCategoryValidator->validateFields();
        $removeCategoryValdidator = new FormValidator(Actions::$REMOVECATEGORY, $_POST, ["submit-remove-category"], "");
        // añadir categoria
        if (isset($_POST["submit-add-category"]) && !$addCategoryValidator->hasInvalidFields()) {
            $data->addCategory($addCategoryValidator->submittedFields["category"]);
            App::redirectUser("dashboard/categories");
        }
        // eliminar categoria
        if (isset($_POST["submit-remove-category"])) {
            $data->removeCategory($removeCategoryValdidator->submittedFields["submit-remove-category"]);
            App::redirectUser("dashboard/categories");
        }
        $this->renderView("dashboard-categories", [ "categories" => $categories, "addCategoryValidator" => $addCategoryValidator, "removeCategoryValidator" => $removeCategoryValdidator ]);
    }
}