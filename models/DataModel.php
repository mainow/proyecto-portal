<?php

require_once "core/DbInfo.php"; // ! autoloader no funciona

class DataModel extends Model {
    public $DB_TABLENAME = "data";
    function __construct() {
        $DATA_DB = new DataBaseInfo("localhost", "root", "", "proyecto_portal");
        parent::__construct($DATA_DB);
    }

    function getCategories() {
        $sql = "SELECT categories FROM $this->DB_TABLENAME";
        $query = $this->db->query($sql);    
        return $query ? mysqli_fetch_all($query) : 0; 
    }
    
    function addCategory(string $category) {
        $sql = "INSERT INTO data (categories) VALUES ('$category')";
        $this->db->query($sql);
    }
    
    function getCategory(string $category) {
        $sql = "SELECT categories FROM $this->DB_TABLENAME WHERE categories='$category'";
        $query = $this->db->query($sql);    
        return $query ? mysqli_fetch_all($query) : 0; 

    }
}