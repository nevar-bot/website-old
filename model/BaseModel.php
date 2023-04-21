<?php
namespace App\Model;

class BaseModel {
    protected Database $db;

    public function __construct(){
        $this->db = new Database();
    }
}