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
    public $DB_PROFILEIMG = "profile_img";
    public $DB_ACTIVE = "active";
    protected $DB_TABLENAME = "users";

    function __construct() {
        $USERS_DB = new DataBaseInfo("localhost", "root", "", "proyecto_portal");
        parent::__construct($USERS_DB);
    }

    function getUser(string $username) {
        $sql = "SELECT * FROM $this->DB_TABLENAME WHERE username='{$username}'";
        $query = $this->db->query($sql);
        return $query ? mysqli_fetch_assoc($query) : 0;
    }
    
    function getAllUsers() {
        $sql = "SELECT * FROM $this->DB_TABLENAME WHERE first_name!='admin'";
        $query = $this->db->query($sql);
        return $query ? mysqli_fetch_all($query) : [];
    }

    function getUserCount():int {
        $users = $this->getAllUsers();
        return $users == [] ? 0 : count($users);
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
    
    function editUser(int $userId, string $firstName, string $lastName, int $id, string $bornDate, string $email, string $category, string $entryDate) {
        $sql = "UPDATE $this->DB_TABLENAME
                SET 
                $this->DB_FIRSTNAME='$firstName',
                $this->DB_LASTNAME='$lastName',
                $this->DB_ID='$id',
                $this->DB_BORNDATE='$bornDate',
                $this->DB_EMAIL='$email',
                $this->DB_CATEGORY='$category',
                $this->DB_ENTRYDATE='$entryDate'
                WHERE id=$userId";
        $this->db->query($sql);
    }
    
    function setUserProfileImg(int $id, string $imgName) {
        $this->updateUserData($id, $this->DB_PROFILEIMG, "'$imgName'");
    }

    function disableUser(int $id) {
        $this->updateUserData($id, $this->DB_ACTIVE, 0);
    }

    function enableUser(int $id) {
        $this->updateUserData($id, $this->DB_ACTIVE, 1);
    }

    function valueExists(string $field, string $value):bool {
        $sql = "SELECT * FROM $this->DB_TABLENAME WHERE $field='$value'";
        $query = $this->db->query($sql);
        return $query ? true : false;
    }

    function accountExists(string $username, string $pwd):bool {
        // $passwordCorrect == password_verify()
        $sql = "SELECT pwd FROM $this->DB_TABLENAME WHERE id='{$username}'";
        $query = $this->db->query($sql);
        if (!$query) {
            return false;
        }
        $userData = mysqli_fetch_assoc($query);
        return password_verify($pwd, $userData["pwd"]);
    }

    function updateUserData(int $id, string $fieldName, $value):bool {
        $sql = "UPDATE $this->DB_TABLENAME SET $fieldName=$value WHERE id=$id";
        $query = $this->db->query($sql);
        return $query ? true : false;
    }

    function getUsersByData(string $label, $value) {
        $sql = "SELECT * FROM $this->DB_TABLENAME WHERE $label='$value'";
        $query = $this->db->query($sql);
        return $query ? mysqli_fetch_assoc($query) : 0;
    }
}