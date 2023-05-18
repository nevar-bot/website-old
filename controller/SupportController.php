<?php
namespace App\Controller;

class SupportController extends BaseController {

    public bool $hasNoModel = true;
    public function __construct(){
        parent::__construct("Support");
    }

    public function index(array $params): void {
        $this->redirect("/redirect/support");
    }
}