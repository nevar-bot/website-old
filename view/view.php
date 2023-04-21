<?php
namespace App\View;
use Twig\Environment;
use Twig\Loader\FilesystemLoader;

class View {
    private Environment $twig;
    private array $defaultVariables = array(
        "templateDir" => "/template/Nevar/",
        "adminDir" => "/template/Nevar/admin/",
        "metaDescription" => "Nevar - Effizienz weitergedacht",
        "metaKeywords" => "Discord, Bot, Discordbot, Discord-Bot, Nevar, Nevar-Bot, Nevar-Discord",
        "name" => "Nevar"
    );
    private array $variables = [];


    public function __construct() {
        $this->twig = new Environment(new FilesystemLoader($_SERVER["DOCUMENT_ROOT"] . $this->defaultVariables["templateDir"]));
    }

    public function setVariable(string $name, $value): void {
        $this->variables[$name] = $value;
    }


    public function render(string $template): void {
        $variables = array_merge($this->defaultVariables, $this->variables);
        $this->twig->display($template . ".html.twig", $variables);
    }

    public function exists(string $template): bool {
        return $this->twig->getLoader()->exists($template . ".html.twig");
    }
}