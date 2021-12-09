<?php

class Model {
    function __construct(DataBaseInfo $databaseInfo) {
        $this->db = new DataBase($databaseInfo);
    }
}