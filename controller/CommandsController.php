<?php

class CommandsController extends BaseController {
    public function __construct() {
        parent::__construct("Commands");
    }

    public function index(array $params): void {
        $this->view->setContent("title", "Nevar · Befehle");
        $this->view->render("commands");
    }
}