<?php

require_once(__DIR__ . "/Database.php");

class BaseModel {
    protected Database $db;

    public function __construct(){
        $this->db = new Database();
    }
}