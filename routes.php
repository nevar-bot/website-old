<?php

$router = new Router();

$router->addRoute("/^\s*$/", "IndexController", "index");
$router->addRoute("/^commands$/", "CommandsController", "index");
$router->addRoute("/^tutorials$/", "TutorialsController", "index");
$router->addRoute("/^hc$/", "HelpcenterController", "index");
$router->addRoute("/^redirect\/(?!\s*$).+/", "RedirectsController", "index");
$router->addRoute("/^admin\/articles$/", "AdminController", "articlesIndex");
$router->addRoute("/^admin\/articles\/create$/", "AdminController", "articleCreateForm");
$router->addRoute("/^admin\/articles\/create\/submitted$/", "AdminController", "articleCreateSubmitted");
$router->addRoute("/^admin\/articles\/edit\/(?P<id>\d+)$/", "AdminController", "articleEditForm");
$router->addRoute("/^admin\/articles\/edit\/(?P<id>\d+)\/submitted$/", "AdminController", "articleEditSubmitted");
$router->addRoute("/^admin\/articles\/delete\/(?P<id>\d+)$/", "AdminController", "articleDelete");
$router->addRoute("/^admin\/tutorials$/", "AdminController", "tutorialsIndex");
$router->addRoute("/^admin\/tutorials\/create$/", "AdminController", "tutorialCreateForm");
$router->addRoute("/^admin\/tutorials\/create\/submitted$/", "AdminController", "tutorialCreateSubmitted");
$router->addRoute("/^admin\/tutorials\/edit\/(?P<id>\d+)$/", "AdminController", "tutorialEditForm");
$router->addRoute("/^admin\/tutorials\/edit\/(?P<id>\d+)\/submitted$/", "AdminController", "tutorialEditSubmitted");
$router->addRoute("/^admin\/tutorials\/delete\/(?P<id>\d+)$/", "AdminController", "tutorialDelete");
$router->addRoute("/^admin\/users$/", "AdminController", "usersIndex");
$router->addRoute("/^admin\/users\/create$/", "AdminController", "userCreateForm");
$router->addRoute("/^admin\/users\/create\/submitted$/", "AdminController", "userCreateSubmitted");
$router->addRoute("/^admin\/users\/edit\/(?P<id>\d+)$/", "AdminController", "userEditForm");
$router->addRoute("/^admin\/users\/edit\/(?P<id>\d+)\/submitted$/", "AdminController", "userEditSubmitted");
$router->addRoute("/^admin\/users\/delete\/(?P<id>\d+)$/", "AdminController", "userDelete");
$router->addRoute("/^admin\/login\/auth$/", "AdminController", "auth");
$router->addRoute("/^admin$/", "AdminController", "index");
$router->addRoute("/^(?!\s*$).+/", "SubpagesController", "index");

$router->dispatch();