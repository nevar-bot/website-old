<?php
namespace App\Controller;
use App\Router\Router;

class SitemapController extends BaseController {
    public bool $hasNoModel = true;

    public function __construct(){
        parent::__construct("Sitemap");
    }

    public function index(array $params, Router $router) {
        $pages = array();
        $routes = $router->getRoutes();
        foreach($routes as $pattern => $route){
            $url = preg_replace("/[^A-Za-z0-9 \\\-]/", '', $pattern);
            if(!str_contains($url, "\\")) $pages[] = $url;
        }
        $this->view->setVariable("pages", $pages);
        $this->view->setVariable("title", "Nevar · Sitemap");
        $this->view->render("sitemap");
    }
}