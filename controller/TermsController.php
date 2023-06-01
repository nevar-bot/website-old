<?php
namespace App\Controller;

class TermsController extends BaseController {

    public bool $hasNoModel = true;
    public function __construct(string $controllerName) {
        parent::__construct($controllerName);
    }

    public function index(array $params): void {
        $this->view->setVariable("title", "Nutzungsbedingungen");
        $this->view->render("terms");
    }

}