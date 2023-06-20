<?php
namespace App\View;
use Twig\Environment;
use Twig\Loader\FilesystemLoader;

class View {
    private Environment $twig;
    private array $defaultVariables = array(
        "templateDir" => "/public/Nevar/",
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

    public function getVariable(string $name): ?string {
        return $this->variables[$name] ?? $this->defaultVariables[$name] ?? null;
    }


    public function render(string $template): void {
        $variables = array_merge($this->defaultVariables, $this->variables);
        $this->twig->display($template . ".html.twig", $variables);
    }

    public function exists(string $template): bool {
        return $this->twig->getLoader()->exists($template . ".html.twig");
    }

    public function isDirOrFile(string $path): ?string {
        if(is_dir($_SERVER["DOCUMENT_ROOT"] . $this->defaultVariables["templateDir"] . $path)){
            return "dir";
        } else if(is_file($_SERVER["DOCUMENT_ROOT"] . $this->defaultVariables["templateDir"] . $path)){
            return "file";
        } else {
            return null;
        }
    }
}