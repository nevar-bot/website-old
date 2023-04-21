<?php
namespace App\Controller;

class CommandsController extends BaseController {
    public function __construct() {
        parent::__construct("Commands");
    }

    public function index(array $params): void {
        $commands = $this->model->getCommands();

        $this->view->setVariable("title", "Nevar · Befehle");
        $this->view->setVariable("commands", $commands);
        $this->view->render("commands");
    }
}