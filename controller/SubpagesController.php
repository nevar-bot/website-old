<?php
namespace App\Controller;

class SubpagesController extends BaseController {

    public bool $hasNoModel = true;
    public function __construct(string $controllerName) {
        parent::__construct($controllerName);
    }

    public function index(array $params): void {
        // Gucken ob angeforderte Datei/Ordner existiert
        if($this->view->exists($params[0])){
            // Datei/Ordner existiert, direkter Zugriff wird aber verhindert
            http_response_code(403);
            $this->view->setVariable("title", "Fehler 403");
            $this->view->setVariable("ogDescription", "Der Zugriff auf die angeforderte Datei/Ordner wurde verweigert.");
            $this->view->render("error/403");
        } else {
            // Existiert nicht, 404
            http_response_code(404);
            $this->view->setVariable("title", "Fehler 404");
            $this->view->setVariable("ogDescription", "Die angeforderte Datei/Ordner wurde nicht gefunden.");
            $this->view->render("error/404");
        }
    }
}