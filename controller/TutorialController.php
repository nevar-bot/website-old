<?php
/**
 * @author 1887jonas
 * @version 1.0
 * @copyright Nevar
 * @description TutorialController class for rendering tutorial page
 */

class TutorialController extends BaseController {
    public function __construct(){
        // construct base controller with controller name
        parent::__construct("Tutorial");
    }

    public function dispatch($params){
        $this->view->setContent("title", "Nevar · Tutorials");
        if($this->view->templateExists("tutorials")){
            $this->view->render("tutorials");
        }else{
            $this->view->setContent("title", "Nevar · Fehler 500");
            $this->view->render("errors/500");
        }
    }
}