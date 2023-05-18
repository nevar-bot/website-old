<?php
namespace App\Controller;

class ImprintController extends BaseController {

    public bool $hasNoModel = true;
    public function __construct() {
        parent::__construct("Imprint");
    }

    public function index(array $params): void {
        $this->view->setVariable("title", "Nevar · Impressum");
        $this->view->render("imprint");
    }

}