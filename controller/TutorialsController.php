<?php

class TutorialsController extends BaseController {
    public function __construct() {
        parent::__construct("Tutorials");
    }

    public function index(array $params): void {
        $this->view->setContent("title", "Nevar · Tutorials");
        $this->view->render("tutorials");
    }
}