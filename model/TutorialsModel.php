<?php
namespace App\Model;

class TutorialsModel extends BaseModel {
    public function __construct() {
        parent::__construct();
    }

    public function getTutorials(): array {
        return $this->db->query("SELECT * FROM tutorials;");
    }
}