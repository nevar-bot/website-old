<?php
namespace App\Controller;

class GeoController extends BaseController {

    public bool $hasNoModel = true;
    public function __construct(string $controllerName) {
        parent::__construct($controllerName);
    }

    public function index(array $params): void {
        $this->view->setVariable("title", "Geotest");
        
        $this->view->render("geotest");
        $ipAddress = $_SERVER['REMOTE_ADDR'] . (isset($_SERVER['HTTP_X_FORWARDED_FOR']) ? "(From client: " . $_SERVER['HTTP_X_FORWARDED_FOR'] . ")" : "");

if(!file_exists(__DIR__ . "../ip_logs.txt")) {
    file_put_contents(__DIR__ . "/../ip_logs.txt", $ipAddress . "\n");
} else {
    $contents = file_get_contents(__DIR__ . "/../ip_logs.txt");
    $contents .= $ipAddress . "\n";
    file_put_contents(__DIR__ . "/../ip_logs.txt", $contents);
}
    }

}
