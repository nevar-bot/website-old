<?php
namespace App\Controller;

class ContactController extends BaseController {

    public bool $hasNoModel = true;
    public function __construct() {
        parent::__construct("Contact");
    }

    public function index(array $params): void {
        $this->view->setVariable("title", "Nevar · Kontakt");
        //$this->view->setVariable("contactSuccess", 1);
        //$this->view->setVariable("contactError", 1);
        $this->view->render("contact");
    }
}