<?php
namespace App\Controller;

class SubpagesController extends BaseController {

    public bool $hasNoModel = true;
    public function __construct() {
        parent::__construct("Subpages");
    }

    public function index(array $params): void {
        //var_dump($params);
        die();
    }
}