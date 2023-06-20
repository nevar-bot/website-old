<?php
namespace App\Controller;

class ImprintController extends BaseController {

    public bool $hasNoModel = true;
    public function __construct(string $controllerName) {
        parent::__construct($controllerName);
    }

    public function index(array $params): void {
        $this->view->setVariable("title", "Impressum");
        $this->view->setVariable("ogDescription", "Impressum gemäß Informationspflicht laut § 5 Telemediengesetz (TMG).");
        $this->view->render("imprint");
    }

}