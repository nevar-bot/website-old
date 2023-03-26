<?php

class AdminController extends BaseController {
    public function __construct() {
        parent::__construct("admin");
    }

    public function index($params): void {
        if (!isset($_SESSION["user"])) {
            $this->view->setContent("title", "Nevar · Login");
            $this->view->render("admin/login");
        } else {
            $this->view->setContent("title", "Nevar · Admin-Dashboard");
            $this->view->render("admin/dashboard");
        }
    }

    public function auth(array $params): void {
        if(isset($_SESSION["user"])) header("Location: /admin");

        if($this->model->checkAuth($_POST["username"], $_POST["password"])) {
            $_SESSION["user"] = $_POST["username"];
            $_SESSION["userId"] = $this->model->getUserId($_POST["username"]);
            header("Location: /admin");
        }else{
            $this->view->setContent("title", "Nevar · Login");
            $this->view->setContent("message", "Benutzername oder Passwort falsch");
            $this->view->render("admin/login");
        }
    }

    public function articlesIndex(array $params): void {
        if(!isset($_SESSION["user"])) header("Location: /admin");
        $articles = $this->model->getArticles();
        $this->view->setContent("title", "Nevar · Artikel");
        $this->view->setContent("articles", $articles);
        $this->view->render("admin/articles/index");
    }

    public function articleCreateForm(array $params): void {
        if(!isset($_SESSION["user"])) header("Location: /admin");
        $this->view->setContent("title", "Nevar · Artikel erstellen");
        $this->view->setContent("user", $_SESSION["user"]);
        $this->view->render("admin/articles/create");
    }

    public function articleCreateSubmitted(array $params): void {
        if(!isset($_SESSION["user"])) header("Location: /admin");
        $this->model->createArticle($_POST["title"], $_POST["text"]);
        header("Location: /admin/articles");
    }

    public function articleEditForm(array $params): void {
        if(!isset($_SESSION["user"])) header("Location: /admin");
        $article = $this->model->getArticle((int)$params["id"]);
        if($article == null) header("Location: /admin/articles");

        $this->view->setContent("title", "Nevar · Artikel bearbeiten");
        $this->view->setContent("article", $article);
        $this->view->setContent("user", $_SESSION["user"]);
        $this->view->render("admin/articles/edit");
    }

    public function articleEditSubmitted(array $params): void {
        if(!isset($_SESSION["user"])) header("Location: /admin");
        $this->model->editArticle((int)$params["id"], $_POST["title"], $_POST["text"]);
        header("Location: /admin/articles");
    }

    public function articleDelete(array $params): void {
        if(!isset($_SESSION["user"])) header("Location: /admin");
        $this->model->deleteArticle((int)$params["id"]);
        header("Location: /admin/articles");
    }

    public function tutorialsIndex(array $params): void {
        if(!isset($_SESSION["user"])) header("Location: /admin");
        $tutorials = $this->model->getTutorials();
        $this->view->setContent("title", "Nevar · Tutorials");
        $this->view->setContent("tutorials", $tutorials);
        $this->view->render("admin/tutorials/index");
    }

    public function tutorialCreateForm(array $params): void {
        if(!isset($_SESSION["user"])) header("Location: /admin");
        $this->view->setContent("title", "Nevar · Tutorial erstellen");
        $this->view->setContent("user", $_SESSION["user"]);
        $this->view->render("admin/tutorials/create");
    }

    public function tutorialCreateSubmitted(array $params): void {
        if(!isset($_SESSION["user"])) header("Location: /admin");
        $this->model->createTutorial($_POST["title"], $_POST["text"]);
        header("Location: /admin/tutorials");
    }

    public function tutorialEditForm(array $params): void {
        if(!isset($_SESSION["user"])) header("Location: /admin");
        $tutorial = $this->model->getTutorial((int)$params["id"]);
        if($tutorial == null) header("Location: /admin/tutorials");

        $this->view->setContent("title", "Nevar · Tutorial bearbeiten");
        $this->view->setContent("tutorial", $tutorial);
        $this->view->setContent("user", $_SESSION["user"]);
        $this->view->render("admin/tutorials/edit");
    }

    public function tutorialEditSubmitted(array $params): void {
        if(!isset($_SESSION["user"])) header("Location: /admin");
        $this->model->editTutorial((int)$params["id"], $_POST["title"], $_POST["text"]);
        header("Location: /admin/tutorials");
    }

    public function tutorialDelete(array $params): void {
        if(!isset($_SESSION["user"])) header("Location: /admin");
        $this->model->deleteTutorial((int)$params["id"]);
        header("Location: /admin/tutorials");
    }

    public function usersIndex(array $params): void {
        if(!isset($_SESSION["user"])) header("Location: /admin");
        $users = $this->model->getUsers();
        $this->view->setContent("title", "Nevar · Nutzer");
        $this->view->setContent("users", $users);
        $this->view->render("admin/users/index");
    }

    public function userCreateForm(array $params): void {
        if(!isset($_SESSION["user"])) header("Location: /admin");
        $this->view->setContent("title", "Nevar · Nutzer erstellen");
        $this->view->render("admin/users/create");
    }

    public function userCreateSubmitted(array $params): void {
        if(!isset($_SESSION["user"])) header("Location: /admin");
        $this->model->createUser($_POST["name"], $_POST["password"]);
        header("Location: /admin/users");
    }

    public function userEditForm(array $params): void {
        if(!isset($_SESSION["user"])) header("Location: /admin");
        $user = $this->model->getUser((int)$params["id"]);
        if($user == null) header("Location: /admin/users");

        $this->view->setContent("title", "Nevar · Nutzer bearbeiten");
        $this->view->setContent("user", $user);
        $this->view->render("admin/users/edit");
    }

    public function userEditSubmitted(array $params): void {
        if(!isset($_SESSION["user"])) header("Location: /admin");
        $this->model->editUser((int)$params["id"], $_POST["name"], $_POST["password"]);
        header("Location: /admin/users");
    }

    public function userDelete(array $params): void {
        if(!isset($_SESSION["user"])) header("Location: /admin");
        $this->model->deleteUser((int)$params["id"]);
        header("Location: /admin/users");
    }
}