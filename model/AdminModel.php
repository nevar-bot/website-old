<?php
namespace App\Model;
use App\Config\Config;

class AdminModel extends BaseModel {
    private Config $config;

    public function __construct() {
        parent::__construct();
        $this->config = new Config();
    }

    public function checkAuth(string $name, $password): bool {
        $user = $this->db->query("SELECT * FROM users WHERE username = '$name';")[0];
        if($user == null) return false;
        $hashedPassword = $user["password"];
        if(password_verify($password . $this->config::DB_SALT, $hashedPassword)){
            return true;
        }else{
            return false;
        }
    }

    public function getUserId(string $name): int {
        return $this->db->query("SELECT id FROM users WHERE username = '$name';")[0]["id"];
    }

    public function getArticles(): bool|array {
        return $this->db->query("SELECT * FROM articles;");
    }

    public function createArticle(string $title, $text): void {
        $this->db->query("INSERT INTO articles (id, title, text) VALUES (NULL, '$title', '$text');");
    }

    public function getArticle(int $id): array {
        return $this->db->query("SELECT * FROM articles WHERE id = $id;")[0];
    }

    public function editArticle(int $id, string $title, $text): void {
        $this->db->query("UPDATE articles SET title = '$title', text = '$text' WHERE id = $id;");
    }

    public function deleteArticle(int $id): void {
        $this->db->query("DELETE FROM articles WHERE id = $id;");
    }

    public function getTutorials(): bool|array {
        return $this->db->query("SELECT * FROM tutorials;");
    }

    public function createTutorial(string $title, $text): void{
        $this->db->query("INSERT INTO tutorials (id, title, text) VALUES (NULL, '$title', '$text');");
    }

    public function getTutorial(int $id): array {
        return $this->db->query("SELECT * FROM tutorials WHERE id = $id;")[0];
    }

    public function editTutorial(int $id, string $title, $text): void {
        $this->db->query("UPDATE tutorials SET title = '$title', text = '$text' WHERE id = $id;");
    }

    public function deleteTutorial(int $id): void {
        $this->db->query("DELETE FROM tutorials WHERE id = $id;");
    }

    public function getUsers(): bool|array {
        return $this->db->query("SELECT * FROM users;");
    }

    public function createUser(string $name, $password): void {
        $hashedPassword = password_hash($password . $this->config::DB_SALT, PASSWORD_DEFAULT);
        $this->db->query("INSERT INTO users (id, username, password) VALUES (NULL, '$name', '$hashedPassword');");
    }

    public function getUser(int $id): array {
        return $this->db->query("SELECT * FROM users WHERE id = $id;")[0];
    }

    public function editUser(int $id, string $name, $password): void {
        $hashedPassword = password_hash($password . $this->config::DB_SALT, PASSWORD_DEFAULT);
        $this->db->query("UPDATE users SET username = '$name', password = '$hashedPassword' WHERE id = $id;");
    }

    public function deleteUser(int $id): void {
        $this->db->query("DELETE FROM users WHERE id = $id;");
    }
}
