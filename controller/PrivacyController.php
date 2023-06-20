<?php
namespace App\Controller;

class PrivacyController extends BaseController {

    public bool $hasNoModel = true;
    public function __construct(string $controllerName) {
        parent::__construct($controllerName);
    }

    public function index(array $params): void {
        $this->view->setVariable("title", "Datenschutzerklärung");
        $this->view->setVariable("ogDescription", "Datenschutzerklärung gemäß der Datenschutz-Grundverordnung (DSGVO)");
        $this->view->render("privacy");
    }

}