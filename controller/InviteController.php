<?php
namespace App\Controller;

class InviteController extends BaseController {

    public bool $hasNoModel = true;
    public function __construct() {
        parent::__construct("Invite");
    }

    public function index(array $params): void {
        $this->redirect("/redirect/invite");
    }

}