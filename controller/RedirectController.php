<?php
/**
 * @author 1887jonas
 * @version 1.0
 * @copyright Nevar
 * @description RedirectController class for redirecting requests to the correct url
 */

require_once(__DIR__ . "/../config/redirectConfig.php");

class RedirectController extends BaseController {
    public function __construct(){
        // construct base controller with controller name
        parent::__construct("Redirect");
    }

    public function dispatch(array $params){
        // Check if a redirect was requested
        if(empty($params[0])){
            // No redirect requested, redirect to homepage
            return header("Location: /");
        }
        // check if requested redirect exists
        if(!defined((new RedirectConfig())::class . "::" . strtoupper($params[0]))) return header("Location: /");
        return header("Location: " . constant((new RedirectConfig())::class . "::" . strtoupper($params[0])));
    }
}