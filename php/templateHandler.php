<?php
class templateHandler {
    private $inputFile = null;
    private static $templateHandler = null;
    private $twig = null;
    private $templateContents = [ ];
    public function templateHandler($templateFile, $templateRoot) {
        $loader = new Twig_Loader_Filesystem ( $templateRoot );
        $twig = new Twig_Environment ( $loader, array (
                'cache' => $templateRoot + '/' 
        ) );

        $this->twig = $twig->loadTemplate ( $templateFile );
    }
    public function addContent($key, $tContent) {
        $this->templateContents [$key] = $tContent;
    }
    public function getHTML() {
        return $this->twig->render ( $this->templateContents );
    }
    public function setTemplate($file) {
        $this->twig->loadTemplate ( $file );
    }
    public function loadSubTemplate($file) {
        $this->twig->loadSubTemplate ( $file );
    }
    public static function getTemplateHandler($templateFile, $templateRoot) {
        return new templateHandler ( $templateFile, $templateRoot );
    }
}