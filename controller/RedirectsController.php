<?php
namespace App\Controller;
use App\Config\RedirectConfig;

class RedirectsController extends BaseController {
    protected $hasNoModel = true;

    public function __construct() {
        parent::__construct("Redirects");
    }

    public function index(array $params) {
        $params = explode("/", $params[0]);
        if (empty($params[1])) {
            return header("Location: /");
        }

        $redirects = new RedirectConfig();
        if(!defined($redirects::class . "::" . strtoupper($params[1]))) return $this->redirect("/");
        return $this->redirect(constant($redirects::class . "::" . strtoupper($params[1])));
    }
}