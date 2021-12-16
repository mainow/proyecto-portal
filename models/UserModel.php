<?php

class UserModel extends Model {
    public $DB_FIRSTNAME = "first_name";
    public $DB_LASTNAME = "last_name";
    public $DB_ID = "id";
    public $DB_PASSWORD = "pwd";
    public $DB_BORNDATE = "born_date";
    public $DB_EMAIL = "email";
    public $DB_CATEGORY = "category";
    public $DB_ENTRYDATE = "entry_date";
    protected $DB_TABLENAME = "proyecto_portal";

    function __construct() {
        require "config.php";
        parent::__construct($USERS_DB);
    }

    function getUser(string $username) {
        $sql = "SELECT * FROM $this->DB_TABLENAME WHERE username='{$username}'";
        $query = $this->db->query($sql);
        return $query ? mysqli_fetch_assoc($query) : 0;
    }

    function addUser(string $firstName, string $lastName, int $id, string $password, string $bornDate, string $email, string $category, string $entryDate) {
        $fields = "$this->DB_FIRSTNAME, $this->DB_LASTNAME, $this->DB_ID, $this->DB_PASSWORD, $this->DB_BORNDATE, $this->DB_EMAIL, $this->DB_CATEGORY, $this->DB_ENTRYDATE";
        $values = "'$firstName', '$lastName', $id, '$password', '$bornDate', '$email', '$category', '$entryDate'";
        $sql = "INSERT INTO $this->DB_TABLENAME ($fields) VALUES ($values)";
        if ($this->valueExists("id", $id) || $this->valueExists("email", $email)) {
            return 0;
        }
        $query = $this->db->query($sql);
        return 1;
    }

    function valueExists(string $field, string $value) {
        $sql = "SELECT * FROM $this->DB_TABLENAME WHERE $field='$value'";
        $query = $this->db->query($sql);
        return $query ? true : false;
    }

    function accountExists(string $username, string $pwd):bool {
        $sql = "SELECT * FROM $this->DB_TABLENAME WHERE id='{$username}' AND pwd='{$pwd}'";
        $query = $this->db->query($sql);
        return $query ? true : false;
    }

    function setUserData(string $username, string $fieldName, $value):bool {
        $sql = "UPDATE $this->DB_TABLENAME SET $fieldName=$value WHERE username=$username";
        $query = $this->db->query($sql);
        return $query ? true : false;
    }
}