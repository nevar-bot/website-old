<?php

class Router {
    private array $routes = array();

    public function addRoute(string $pattern, string $controller, string $method): void {
        $this->routes[$pattern] = array(
            "controller" => $controller,
            "method" => $method
        );
    }


    private function splitURI(): array {
        $uri = $_SERVER["REQUEST_URI"];
        return explode("/", $uri);
    }

    private bool $route_match = false;
    private string $url_path = "index";
    private array $url_params = array();
    public function dispatch(): void {
        session_start();

        if(isset($_SERVER["REQUEST_URI"])){
            $this->url_path = $_SERVER["REQUEST_URI"];
            if(str_ends_with($this->url_path, "/")){
                $this->url_path = substr($this->url_path, 0, -1);
            }
            if(str_starts_with($this->url_path, "/")){
                $this->url_path = substr($this->url_path, 1);
            }
            $this->url_path = strtok($this->url_path, "?");
        }
        foreach($this->routes as $pattern => $action){
            if(preg_match($pattern, $this->url_path, $matches)){
                $this->url_params = array_merge($this->url_params, $matches);
                $this->route_match = true;
                break;
            }
        }

        if($this->route_match){
            $controller = new $action["controller"]();
            $controller->{ $action["method"] }($this->url_params);
        }
    }
}
