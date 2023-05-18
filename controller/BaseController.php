<?php
namespace App\Controller;
use App\View\View;

class BaseController {
    protected View $view;
    protected mixed $model;

    public function __construct(string $controllerName) {
        $this->view = new View();

        if(isset($this->hasNoModel)) return;
        $modelClass = "\\App\\Model\\" . $controllerName . "Model";
        $this->model = new $modelClass();
    }

    public function redirect(string $url): void {
        header("Location: " . $url);
        exit();
    }
}