<?php

require_once "autoloader.php";
class SetupModel extends Model {
    public $DB_TABLENAME = "users";
    function __construct() {
        $USERS_DB = new DataBaseInfo("localhost", "root", "", "proyecto_portal");
        parent::__construct($USERS_DB);
    }

    function setUpAdminAccount(int $id, string $pwd) {
        // crear admin
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        $_SESSION["admin-id"] = $id;
        $pwd = password_hash($pwd, PASSWORD_DEFAULT);
        $sql = "SELECT * FROM $this->DB_TABLENAME WHERE first_name='admin'";
        $q = $this->db->query($sql);
        if ($q) {
            $sql = "UPDATE $this->DB_TABLENAME 
                    SET id=$id,pwd='$pwd'
                    WHERE first_name='admin'";
            $this->db->query($sql);
            return;
        }
        $sql = "INSERT INTO $this->DB_TABLENAME (first_name, last_name, id, pwd) 
                VALUES ('admin', 'admin', $id, '$pwd')";
        $this->db->query($sql);
    }
}