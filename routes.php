<?php
use App\Router\Router;

$router = new Router();

$router
    ->addRoute("/^\s*$/", "IndexController", "index")
    ->addRoute("/^commands$/", "CommandsController", "index")
    ->addRoute("/^invite$/", "InviteController", "index")
    ->addRoute("/^support$/", "SupportController", "index")
    ->addRoute("/^contact-us$/", "ContactController", "index")
    ->addRoute("/^contact-us\/requested/", "ContactController", "requested")
    ->addRoute("/^terms-of-use$/", "TermsController", "index")
    ->addRoute("/^bot-privacy$/", "BotPrivacyController", "index")
    ->addRoute("/^privacy$/", "PrivacyController", "index")
    ->addRoute("/^imprint$/", "ImprintController", "index")
    ->addRoute("/^sitemap$/", "SitemapController", "index")
    ->addRoute("/^redirect\/(?!\s*$).+/", "RedirectsController", "index")
    ->addRoute("/^(?!\s*$).+/", "SubpagesController", "index");

$router->dispatch();