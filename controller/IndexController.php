<?php
namespace App\Controller;

class IndexController extends BaseController {
    public function __construct(string $controllerName){
        parent::__construct($controllerName);
    }

    public function index(array $params): void {
        $this->view->setVariable("title", "Discord-Bot");

        $monthArray = array("Januar", "Februar", "März", "April", "Mai", "Juni", "Juli", "August", "September", "Oktober", "November", "Dezember");
        $this->view->setVariable("month", $monthArray[idate("m") - 1]);

        $client = $this->model->getStats();
        $this->view->setVariable("guild_count", $client->guild_count ?? 0);
        $this->view->setVariable("user_count", $client->user_count ?? 0);
        $this->view->setVariable("command_count", $client->command_count ?? 0);
        $this->view->setVariable("vote_count", $client->vote_count ?? 0);
        $this->view->setVariable("homepage", true);

        $staffs = $this->model->getStaffs();
        $this->view->setVariable("staffs", $staffs);
        $this->view->render("index");
    }
}