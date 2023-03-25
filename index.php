<?php
/**
 * @author 1887jonas
 * @version 1.0
 * @copyright Nevar
 * @description Router class for routing requests to the correct controller
 */

require_once(__DIR__ . "/vendor/autoload.php");

class Router {
    private array $routes = array(
        "/^\s*$/" => array("homepageController", "dispatch"),
        "/^commands/" => array("commandsController", "dispatch"),
        "/^tutorials/" => array("tutorialController", "dispatch"),
        "/^hc/" => array("helpcenterController", "dispatch"),
        "/^redirect/" => array("redirectController", "dispatch"),
        "/^(?!\s*$).+/" => array("SubpageController", "dispatch")
    );

    private function splitURI(): array {
        $uri = $_SERVER["REQUEST_URI"];
        return explode("/", $uri);
    }

    public function dispatch(): void {
        // split request uri
        $splittedRequestUri = $this->splitURI();

        // check if route exists
        foreach($this->routes as $url => $action){
            $matches = preg_match($url, $splittedRequestUri[1], $params);
            // route not found
            if($matches < 1) continue;

            // require requested controller
            $controller = new $action[0]();

            // call requested action
            $controller->{ $action[1] }(array_slice($this->splitURI(), 2));
            break;
        }
    }
}

$router = (new Router())->dispatch();