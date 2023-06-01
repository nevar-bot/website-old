<?php
namespace App\Router;

class Router {
    private array $routes = array();
    private bool $route_match = false;
    private string $url_path = "index";
    private array $url_params = array();

    public function addRoute(string $pattern, string $controller, string $method): self {
        $this->routes[$pattern] = array(
            "controller" => $controller,
            "method" => $method
        );
        return $this;
    }

    public function dispatch(): void {
        session_start();

        $this->extractUrlParams();

        foreach ($this->routes as $pattern => $action) {
            if (preg_match($pattern, $this->url_path, $matches)) {
                $this->url_params = array_merge($this->url_params, $matches);
                $this->route_match = true;
                break;
            }
        }

        if ($this->route_match) {
            $controller = "\\App\\Controller\\" . $action["controller"];
            $controllerName = str_replace("Controller", "", $action["controller"]);
            $controller = new $controller($controllerName);
            if ($controller) {
                $controller->{ $action["method"] }($this->url_params, $this);
            }
        }
    }

    private function extractUrlParams(): void {
        if (isset($_SERVER["REQUEST_URI"])) {
            $this->url_path = $_SERVER["REQUEST_URI"];
            if (str_ends_with($this->url_path, "/")) {
                $this->url_path = substr($this->url_path, 0, -1);
            }
            if (str_starts_with($this->url_path, "/")) {
                $this->url_path = substr($this->url_path, 1);
            }
            $this->url_path = strtok($this->url_path, "?");
        }
    }

    public function getRoutes(): array {
        return $this->routes;
    }
}