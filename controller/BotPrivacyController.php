<?php
namespace App\Controller;

class BotPrivacyController extends BaseController {

    public bool $hasNoModel = true;
    public function __construct() {
        parent::__construct("BotPrivacy");
    }

    public function index(array $params): void {
        $this->view->setVariable("title", "Nevar · Bot-Datenschutz");
        $this->view->render("bot-privacy");
    }

}