<?php
/**
 * @author 1887jonas
 * @version 1.0
 * @copyright Nevar
 * @description HelpcenterController class for handling helpcenter requests
 */

class HelpcenterController extends BaseController {
    public function __construct(){
        // construct base controller with controller name
        parent::__construct("Helpcenter");
    }

    public function dispatch($params){
        $this->view->setContent("title", "Nevar · Hilfe");
        if($this->view->templateExists("helpcenter")){
            $this->view->render("helpcenter");
        }else{
            $this->view->setContent("title", "Nevar · Fehler 500");
            $this->view->render("errors/500");
        }
    }


}