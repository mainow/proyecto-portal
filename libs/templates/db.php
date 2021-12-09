<?php

class DataBaseInfo {
    function __construct(string $dbHost, string $dbUser, string $dbPwd, string $dbDatabase) {
        $this->host = $dbHost;
        $this->user = $dbUser;
        $this->pwd = $dbPwd;
        $this->database = $dbDatabase;
    }
}

class DataBase {

    function __construct(DataBaseInfo $databaseInfo) {
        $this->host = $databaseInfo->host;
        $this->user = $databaseInfo->user;
        $this->pwd = $databaseInfo->pwd;
        $this->database = $databaseInfo->database;
    }

    function connection() {
        return mysqli_connect($this->host, $this->user, $this->pwd, $this->database);
    }

    function query(string $sql) {
        $q = mysqli_query($this->connection(), $sql);
        if ($q->num_rows == 0) {
            return 0;
        }
        return $q;
    }
}