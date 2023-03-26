<?php

require_once(__DIR__ . "/../config/redirectConfig.php");

class RedirectsController extends BaseController {
    public function __construct() {
        parent::__construct("Redirects");
    }

    public function index(array $params) {
        // Check if a redirect was requested
        $params = explode("/", $params[0]);
        if (empty($params[1])) {
            // No redirect requested, redirect to homepage
            return header("Location: /");
        }
        // check if requested redirect exists
        if (!defined((new RedirectConfig())::class . "::" . strtoupper($params[1]))) return header("Location: /");
        return header("Location: " . constant((new RedirectConfig())::class . "::" . strtoupper($params[1])));
    }
}