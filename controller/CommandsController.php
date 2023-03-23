<?php
/**
 * @author 1887jonas
 * @version 1.0
 * @copyright Nevar
 * @description CommandsController class for rendering commands page
 */

class CommandsController extends BaseController {
    public function __construct(){
        // construct base controller with controller name
        parent::__construct("Commands");
    }

    public function dispatch(array $params) {
        $this->view->setContent("title", "Nevar · Befehle");
        if($this->view->templateExists("commands")){
            $this->view->render("commands");
        }else{
            $this->view->setContent("title", "Nevar · Fehler 500");
            $this->view->render("errors/500");
        }
    }
}