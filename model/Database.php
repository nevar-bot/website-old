<?php
/**
 * @author 1887jonas
 * @version 1.0
 * @copyright Nevar
 * @description Database class for connecting to the database
 */

require_once(__DIR__ . "/../config/config.php");

class Database {
    private PDO $db;
    private Config $config;

    public function __construct(){
        // connect to database
        $this->config = new Config();
        try {
            $this->db = new PDO("mysql:host=" . $this->config::DB_HOST . ";dbname=" . $this->config::DB_NAME, $this->config::DB_USER, $this->config::DB_PASS);
            $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }catch(PDOException $e){
            echo "Internal server error: Database connection failed: " . $e->getMessage();
            die();
        }
    }

    // function to execute sql statements
    public function query(string $query){
        $stmt = $this->db->query($query);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
