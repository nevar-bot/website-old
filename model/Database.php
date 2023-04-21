<?php
namespace App\Model;
use App\Config\Config;
use PDO;

class Database {
    private PDO $db;
    private Config $config;

    public function __construct() {
        $this->config = new Config();
        try {
            $this->db = new PDO("mysql:host=" . $this->config::DB_HOST . ";dbname=" . $this->config::DB_NAME, $this->config::DB_USER, $this->config::DB_PASS);
            $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            die("Internal server error: Database connection failed: " . $e->getMessage());
        }
    }

    public function query(string $query): array|bool {
        $stmt = $this->db->query($query);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
