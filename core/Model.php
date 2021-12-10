<?php

class Model {
    /**
     * Model
     * * Clase padre de todos los modelos
     */
    function __construct(DataBaseInfo $databaseInfo) {
        $this->db = new DataBase($databaseInfo);
    }
}