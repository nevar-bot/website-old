<?php
/**
 * @author 1887jonas
 * @version 1.0
 * @copyright Nevar
 * @description Base model class for connecting to database, needs to be extended by every model
 */

require_once(__DIR__ . "/Database.php");

class BaseModel {
    protected Database $db;

    public function __construct(){
        // construct database
        $this->db = new Database();
    }
}