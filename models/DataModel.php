<?php

require_once "core/DbInfo.php"; // ! autoloader no funciona

class DataModel extends Model {
    public $DB_CATEGORY = "categories";
    function __construct() {
        $DATA_DB = new DataBaseInfo("localhost", "root", "", "proyecto_portal");
        parent::__construct($DATA_DB);
    }

    function getCategories() {
        $sql = "SELECT * FROM $this->DB_CATEGORY";
        $query = $this->db->query($sql);
        return $query ? mysqli_fetch_all($query) : 0; 
    }
    
    function removeCategory(int $id) {
        $sql = "DELETE FROM $this->DB_CATEGORY WHERE id=$id";
        $this->db->query($sql);
    }

    function addCategory(string $category) {
        $sql = "INSERT INTO $this->DB_CATEGORY (name) VALUES ('$category')";
        $this->db->query($sql);
    }
    
    function getCategory(string $name) {
        $sql = "SELECT name FROM $this->DB_CATEGORY WHERE name='$name'";
        $query = $this->db->query($sql);    
        return $query ? mysqli_fetch_all($query) : 0; 
    }
    
    function editCategory(int $id, string $newName) {
        $sql = "UPDATE $this->DB_CATEGORY SET name='$newName' WHERE id=$id";
        $this->db->query($sql);
    }

    function isCategoryInUse(int $id):bool {
        $userModel = new UserModel;
        $user = $userModel->getUsersByData("category", $id);
        return $user ? true : false;
    }
}