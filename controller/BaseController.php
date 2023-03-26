<?php

class BaseController {
    protected View $view;
    protected mixed $model;

    public function __construct(string $controllerName) {
        // require view
        require_once(__DIR__ . "/../view/view.php");
        $this->view = new View();
        // require model
        require_once(__DIR__ . "/../model/" . $controllerName . "Model.php");
        $this->model = new ($controllerName . 'Model')();
    }
}