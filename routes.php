<?php
use App\Router\Router;

$router = new Router();

$router
    ->addRoute("/^\s*$/", "IndexController", "index")
    ->addRoute("/^commands$/", "CommandsController", "index")
    ->addRoute("/^tutorials$/", "TutorialsController", "index")
    ->addRoute("/^hc$/", "HelpcenterController", "index")
    ->addRoute("/^redirect\/(?!\s*$).+/", "RedirectsController", "index")
    ->addRoute("/^admin\/articles$/", "AdminController", "articlesIndex")
    ->addRoute("/^admin\/articles\/create$/", "AdminController", "articleCreateForm")
    ->addRoute("/^admin\/articles\/create\/submitted$/", "AdminController", "articleCreateSubmitted")
    ->addRoute("/^admin\/articles\/edit\/(?P<id>\d+)$/", "AdminController", "articleEditForm")
    ->addRoute("/^admin\/articles\/edit\/(?P<id>\d+)\/submitted$/", "AdminController", "articleEditSubmitted")
    ->addRoute("/^admin\/articles\/delete\/(?P<id>\d+)$/", "AdminController", "articleDelete")
    ->addRoute("/^admin\/tutorials$/", "AdminController", "tutorialsIndex")
    ->addRoute("/^admin\/tutorials\/create$/", "AdminController", "tutorialCreateForm")
    ->addRoute("/^admin\/tutorials\/create\/submitted$/", "AdminController", "tutorialCreateSubmitted")
    ->addRoute("/^admin\/tutorials\/edit\/(?P<id>\d+)$/", "AdminController", "tutorialEditForm")
    ->addRoute("/^admin\/tutorials\/edit\/(?P<id>\d+)\/submitted$/", "AdminController", "tutorialEditSubmitted")
    ->addRoute("/^admin\/tutorials\/delete\/(?P<id>\d+)$/", "AdminController", "tutorialDelete")
    ->addRoute("/^admin\/users$/", "AdminController", "usersIndex")
    ->addRoute("/^admin\/users\/create$/", "AdminController", "userCreateForm")
    ->addRoute("/^admin\/users\/create\/submitted$/", "AdminController", "userCreateSubmitted")
    ->addRoute("/^admin\/users\/edit\/(?P<id>\d+)$/", "AdminController", "userEditForm")
    ->addRoute("/^admin\/users\/edit\/(?P<id>\d+)\/submitted$/", "AdminController", "userEditSubmitted")
    ->addRoute("/^admin\/users\/delete\/(?P<id>\d+)$/", "AdminController", "userDelete")
    ->addRoute("/^admin\/login\/auth$/", "AdminController", "auth")
    ->addRoute("/^admin$/", "AdminController", "index")
    ->addRoute("/^(?!\s*$).+/", "SubpagesController", "index");

$router->dispatch();