<?php
namespace App\Controller;

class CommandsController extends BaseController {
    public function __construct() {
        parent::__construct("Commands");
    }

    public function index(array $params): void {
        $commands = $this->model->getCommands();
        $categories = array();

        foreach($commands as $command){
            if(!in_array($command->category, $categories) && $command->category !== "owner" && $command->category !== "staff"){
                $categories[] = $command->category;
            }
        }
        $this->view->setVariable("title", "Nevar · Befehle");
        $this->view->setVariable("commands", $commands);
        $this->view->setVariable("categories", $categories);
        $this->view->render("commands");
    }
}