<?php
namespace App\Controller;

class HelpcenterController extends BaseController {
    public function __construct() {
        parent::__construct("Helpcenter");
    }

    public function index(array $params): void {
        $this->view->setVariable("title", "Nevar · Hilfe");

        $this->view->render("helpcenter");
    }
}