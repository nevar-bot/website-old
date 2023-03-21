<?php
/**
 * @author 1887jonas
 * @version 1.0
 * @copyright Nevar
 * @description View class for rendering view files
 */

require_once(__DIR__ . "/../vendor/autoload.php");

use Twig\Environment;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Error\SyntaxError;
use Twig\Loader\FilesystemLoader;

class View {
    // define default variables
    private array $variables = array(
        "templateDir" => "/template/Nevar/",
        "metaDescription"=> "Nevar - Imagine a Bot",
        "metaKeywords" => "Discord, Bot, Discordbot, Discord-Bot, Nevar, Nevar-Bot, Nevar-Discord",
        "name" => "Nevar"
    );

    // define view engine (twig)
    private Environment $twig;

    public function __construct() {
        // set template directory
        $this->twig = new Environment(new FilesystemLoader($_SERVER["DOCUMENT_ROOT"] . $this->variables["templateDir"]));
    }

    // add variables to view (before rendering)
    public function setContent($var, $content): void {
         $this->variables[$var] = $content;
    }

    // render view
    public function render($template): void {
        try {
            $this->twig->display($template . ".html.twig", $this->variables);
        } catch (LoaderError|RuntimeError|SyntaxError $e) {
            echo $e->getMessage();
        }
    }

    // check if view file exists
    public function templateExists($template): bool {
        return $this->twig->getLoader()->exists($template . ".html.twig");
    }
}