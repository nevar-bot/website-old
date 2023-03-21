<?php
/**
 * @author 1887jonas
 * @version 1.0
 * @copyright Nevar
 * @description HomepageController class for handling requests to the homepage
 */

class HomepageController extends BaseController {
    public function __construct(){
        // construct base controller with controller name
        parent::__construct("Homepage");
    }

    public function dispatch(array $params){
        // check if homepage view file exists
        if($this->view->templateExists("index")){
            // append title
            $this->view->setContent("title", "Nevar · Discord-Bot");

            // append month list
            $monthArray = array("Januar", "Februar", "März", "April", "Mai", "Juni", "Juli", "August", "September", "Oktober", "November", "Dezember");
            $this->view->setContent("month", $monthArray[idate("m") - 1]);

            // get bot stats from model and append to view
            $client = $this->model->getBotStats();
            $this->view->setContent("guild_count", $client->guild_count ?? 0);
            $this->view->setContent("user_count", $client->user_count ?? 0);
            $this->view->setContent("command_count", $client->command_count ?? 0);
            $this->view->setContent("vote_count", $client->vote_count ?? 0);

            // render view
            $this->view->render("index");
        }else{
            // if homepage view file does not exist - error 500
            $this->view->setContent("title", "Nevar · Fehler 500");
            $this->view->render("errors/500");
        }
    }
}
