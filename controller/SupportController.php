<?php
namespace App\Controller;

class SupportController extends BaseController {

    public bool $hasNoModel = true;
    public function __construct(string $controllerName){
        parent::__construct($controllerName);
    }

    public function index(array $params): void {
        $this->redirect("/redirect/support");
    }
}