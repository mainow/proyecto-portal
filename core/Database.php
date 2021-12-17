<?php

class DataBase {
    /**
     * Database
     * * Permite conectar y hacer queries a una base de datos
     */
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
        return !is_bool($q) && $q->num_rows == 0 ? 0 : $q;
    }
}