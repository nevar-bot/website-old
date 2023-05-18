<?php
namespace App\Controller;

class PrivacyController extends BaseController {

    public bool $hasNoModel = true;
    public function __construct() {
        parent::__construct("Privacy");
    }

    public function index(array $params): void {
        $this->view->setVariable("title", "Nevar · Datenschutzerklärung");
        $this->view->render("privacy");
    }

}