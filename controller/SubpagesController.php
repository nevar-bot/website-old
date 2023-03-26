<?php

class SubpagesController extends BaseController {
    public function __construct() {
        parent::__construct("Subpages");
    }

    public function index(array $params): void {
        var_dump($params);
    }
}