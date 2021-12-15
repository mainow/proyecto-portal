<?php

class UserFullData {
    function __construct(string $firstName, string $lastName, string $email, string $phoneNumber, string $address, string $city, string $password) {
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->email = $email;
        $this->phoneNumber = $phoneNumber;
        $this->address = $address;
        $this->city = $city;
        $this->password = $password;
    }
}

class UserModel extends Model {
    public $DB_FIRSTNAME = "first_name";
    public $DB_LASTNAME = "last_name";
    public $DB_EMAIL = "email";
    public $DB_PHONENUMBER = "phone_number";
    public $DB_ADDRESS = "address";
    public $DB_CITY = "city";
    public $DB_PASSWORD = "pwd";
    protected $DB_TABLENAME = "proyecto_portal";
    function __construct() {
        require "config.php";
        parent::__construct($USERS_DB);
    }

    function getUser(string $username) {
        $sql = "SELECT * FROM $this->DB_TABLENAME WHERE username='{$username}'";
        $query = $this->db->query($sql);
        return $query ? mysqli_fetch_assoc($this->db->query($sql)) : 0;
    }

    function accountExists(string $username, string $pwd):bool {
        $sql = "SELECT * FROM $this->DB_TABLENAME WHERE username='{$username}' AND pwd='{$pwd}'";
        $query = $this->db->query($sql);
        return $query ? true : false;
    }

    function setUserData(string $username, string $fieldName, $value):bool {
        $sql = "UPDATE $this->DB_TABLENAME SET $fieldName=$value WHERE username=$username";
        $query = $this->db->query($sql);
        return $query ? true : false;
    }
    
    function setAllUserData(string $username, $userData):bool {
        $values = "$this->DB_FIRSTNAME='$userData->firstName', $this->DB_LASTNAME='$userData->lastName', $this->DB_EMAIL='$userData->email', $this->DB_PHONENUMBER='$userData->phoneNumber', $this->DB_ADDRESS='$userData->address', $this->DB_CITY='$userData->city', $this->DB_PASSWORD='$userData->password'";
        $sql = "UPDATE $this->DB_TABLENAME SET $values WHERE username='$username'";
        $query = $this->db->query($sql);
        return $query ? true : false;
    }
}