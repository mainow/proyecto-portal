<?php

class DataBaseInfo {
    /**
     * DataBaseInfo
     * * Provee una manera simple de inicializar los datos de una base de datos
     */
    function __construct(string $dbHost, string $dbUser, string $dbPwd, string $dbDatabase) {
        $this->host = $dbHost;
        $this->user = $dbUser;
        $this->pwd = $dbPwd;
        $this->database = $dbDatabase;
    }
}