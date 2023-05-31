<?php
namespace App\Controller;

class SubpagesController extends BaseController {

    public bool $hasNoModel = true;
    public function __construct() {
        parent::__construct("Subpages");
    }

    public function index(array $params): void {
        // Gucken ob angeforderte Datei/Ordner existiert
        if($this->view->exists($params[0])){
            // Datei/Ordner existiert, direkter Zugriff wird aber verhindert
            http_response_code(403);
            $this->view->setVariable("title", "Nevar · Fehler 403");
            $this->view->render("error/403");
        } else {
            // Existiert nicht, 404
            http_response_code(404);
            $this->view->setVariable("title", "Nevar · 404");
            $this->view->render("error/404");
        }
    }
}