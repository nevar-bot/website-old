<?php

class IndexController extends BaseController {
    public function __construct(){
        parent::__construct("Index");
    }

    public function index(array $params): void {
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
        $this->view->setContent("homepage", true);

        // render view
        $this->view->render("index");
    }
}