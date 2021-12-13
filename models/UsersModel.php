<?php

class UsersModel extends Model {
    function __construct() {
        require "config.php";
        parent::__construct($USERS_DB);
    }

    function getUser(string $username) {
        $sql = "SELECT * FROM login_system_usuarios WHERE username='{$username}'";
        $query = $this->db->query($sql);
        return $query ? mysqli_fetch_row($this->db->query($sql)) : 0;
    }

    function accountExists(string $username, string $pwd):bool {
        $sql = "SELECT * FROM login_system_usuarios WHERE username='{$username}' AND pwd='{$pwd}'";
        $query = $this->db->query($sql);
        return $query ? true : false;
    }
}