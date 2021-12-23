<?php

class Categories extends Dashboard {
    function __construct() {
        $this->handleAdminVisit();
        $dataModel = new DataModel;
        $addCategoryValidator = new FormValidator(Actions::$ADDCATEGORY, $_POST, ["category"], "submit-add-category");
        $removeCategoryValidator = new FormValidator(Actions::$REMOVECATEGORY, $_POST, ["category"], "submit-remove-category");
        $editCategoryValidator = new FormValidator(Actions::$EDITCATEGORY, $_POST, ["category-new-name", "category-id"], "submit-edit-category");
        
        if ($addCategoryValidator->wasValidated() && !$addCategoryValidator->hasInvalidFields()) {
            $dataModel->addCategory($addCategoryValidator->submittedFields["category"]);
            App::redirectUser("dashboard/categories");
        }

        if ($removeCategoryValidator->wasValidated() && !$dataModel->isCategoryInUse($removeCategoryValidator->submittedFields["category"])) {
            $dataModel->removeCategory($removeCategoryValidator->submittedFields["category"]);
            App::redirectUser("dashboard/categories");
        } else if ($removeCategoryValidator->wasValidated()) {
            // echo "<script>alert('La categoria no se puede eliminar porque ya esta en uso')</script>";
            echo new AlertWidget("La categoria no se puede eliminar porque ya esta en uso");
        }

        if ($editCategoryValidator->wasValidated()) {
            $dataModel->editCategory($editCategoryValidator->submittedFields["category-id"], $editCategoryValidator->submittedFields["category-new-name"]);
            App::redirectUser("dashboard/categories");
        }
        // pasar las categorias existentes como parametro a la vista
        $formData = new DataModel;
        $categories = $formData->getCategories();
        $this->renderView("dashboard-categories", [ "categories" => $categories, "addCategoryValidator" => $addCategoryValidator, "removeCategoryValidator" => $removeCategoryValidator, "editCategoryValidator" => $editCategoryValidator]);
    }
}

// class Categories extends Dashboard {
//     function __construct() {
//         $this->handleAdminVisit();
//         $data = new DataModel;
//         $categories = $data->getCategories();
//         $addCategoryValidator = new FormValidator(Actions::$ADDCATEGORY, $_POST, ["category"], "submit-add-category");
//         $addCategoryValidator->validateFields();
//         $removeCategoryValdidator = new FormValidator(Actions::$REMOVECATEGORY, $_POST, ["submit-remove-category"], "");
//         $editCategoryValidator = new FormValidator(Actions::$EDITCATEGORY, $_POST, ["submit-edit-category", "category-new-name"], "");
//         // añadir categoria
//         if (isset($_POST["submit-add-category"]) && !$addCategoryValidator->hasInvalidFields()) {
//             $data->addCategory($addCategoryValidator->submittedFields["category"]);
//             App::redirectUser("dashboard/categories");
//         }
//         // eliminar categoria
//         if (isset($_POST["submit-remove-category"])) {
//             if (!$data->isCategoryInUse($removeCategoryValdidator->submittedFields["submit-remove-category"])) {
//                 $data->removeCategory($removeCategoryValdidator->submittedFields["submit-remove-category"]);
//                 App::redirectUser("dashboard/categories");
//             } 
//             echo "<script>alert('La categoria no se puede eliminar porque ya esta en uso')</script>";
//         }
//         // editar categoria
//         if (isset($_POST["submit-edit-category"])) {
//             $data->editCategory($editCategoryValidator->submittedFields["submit-edit-category"], $editCategoryValidator->submittedFields["category-new-name"]);
//             App::redirectUser("dashboard/categories");
//         }
//         $this->renderView("dashboard-categories", [ "categories" => $categories, "addCategoryValidator" => $addCategoryValidator, "removeCategoryValidator" => $removeCategoryValdidator, "editCategoryValidator" => $editCategoryValidator]);
//     }
// }