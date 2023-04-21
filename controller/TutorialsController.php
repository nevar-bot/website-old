<?php
namespace App\Controller;

class TutorialsController extends BaseController {
    public function __construct() {
        parent::__construct("Tutorials");
    }

    public function index(array $params): void {
        $tutorials = $this->model->getTutorials();
        $this->view->setVariable("title", "Nevar · Tutorials");
        $this->view->setVariable("tutorials", $tutorials);

        $this->view->render("tutorials");
    }
}