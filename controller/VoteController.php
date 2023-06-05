<?php
namespace App\Controller;
use App\Router\Router;

class VoteController extends BaseController {
    public bool $hasNoModel = true;

    public function __construct(string $controllerName) {
        parent::__construct($controllerName);
    }

    public function index(array $params, Router $router){
        $this->redirect("/redirect/vote");
    }
}