<?php

class HelpcenterController extends BaseController {
    public function __construct() {
        parent::__construct("Helpcenter");
    }

    public function index(array $params): void {
        $this->view->setContent("title", "Nevar · Hilfe");
        $this->view->render("helpcenter");
    }
}