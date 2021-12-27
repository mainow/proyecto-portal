<?php

class Categories extends Dashboard {
    function __construct() {
        $this->handleAdminVisit();
        $dataModel = new DataModel;
        $addCategoryValidator = new FormValidator(Actions::$ADDCATEGORY, $_POST, ["category"], "submit-add-category");
        $removeCategoryValidator = new FormValidator(Actions::$REMOVECATEGORY, $_POST, ["category"], "submit-remove-category");
        
        if ($addCategoryValidator->wasValidated() && !$addCategoryValidator->hasInvalidFields()) {
            $dataModel->addCategory($addCategoryValidator->submittedFields["category"]);
            App::redirectUser("dashboard/categories");
        }

        if ($removeCategoryValidator->wasValidated() && !$dataModel->isCategoryInUse($removeCategoryValidator->submittedFields["category"])) {
            $dataModel->removeCategory($removeCategoryValidator->submittedFields["category"]);
            App::redirectUser("dashboard/categories");
        } else if ($removeCategoryValidator->wasValidated()) {
            echo new AlertWidget("La categoria no se puede eliminar porque ya esta en uso");
        }

        $editCategoryValidators = [];
        foreach ($dataModel->getCategories() as $category) {
            $editCategoryValidators[] = new FormValidator(Actions::$EDITCATEGORY, $_POST, ["category-new-name", "category-id"], "submit-edit-category-".$category[1]);
        }

        foreach ($editCategoryValidators as $editCategoryValidator) {
            if ($editCategoryValidator->wasValidated() && !$editCategoryValidator->hasInvalidFields()) {
                $dataModel->editCategory($editCategoryValidator->submittedFields["category-id"], $editCategoryValidator->submittedFields["category-new-name"]);
            }
        }
        // pasar las categorias existentes como parametro a la vista
        $this->renderView("dashboard-categories", [ "categories" => $dataModel->getCategories(), "addCategoryValidator" => $addCategoryValidator, "removeCategoryValidator" => $removeCategoryValidator, "editCategoryValidators" => $editCategoryValidators]);
    }
}