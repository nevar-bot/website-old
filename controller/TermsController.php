<?php
namespace App\Controller;

class TermsController extends BaseController {

    public bool $hasNoModel = true;
    public function __construct() {
        parent::__construct("Terms");
    }

    public function index(array $params): void {
        $this->view->setVariable("title", "Nevar · Nutzungsbedingungen");
        $this->view->render("terms");
    }

}