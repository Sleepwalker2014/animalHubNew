<?php
/**
 * Created by PhpStorm.
 * User: marcel
 * Date: 25.04.16
 * Time: 21:14
 */
namespace BeatHeat;

use Twig_Environment;
use Twig_Loader_Filesystem;

require_once '../vendor/autoload.php';

class Template
{
    private $loader = null;
    private $twig = null;
    private $includeBaseTemplate = false;
    private $showNavBar = true;

    /**
     * Template constructor.
     * @param string $templatePath
     * @param bool|false $isAjaxCall
     */
    public function __construct($templatePath, $isAjaxCall = false)
    {
        $this->loader = new Twig_Loader_Filesystem($templatePath);
        $this->twig = new Twig_Environment($this->loader,  array('auto_reload' => true));
        $this->isAjaxCall = $isAjaxCall;
    }

    /**
     * @param string $templateFile
     * @param mixed[] $content
     * @return string
     */
    public function getHTMLAsString($templateFile, $content = [])
    {
        $content['webroot'] = '/webProjects/animalHubNew/';

        if ($this->includeBaseTemplate) {
            $content['includeFile'] = $templateFile;
            $templateFile = 'main/main.html.twig';
        }

        $content['showNavBar'] = $this->showNavBar;

        return $this->twig->render($templateFile, $content);
    }

    /**
     * @param bool $includeBaseTemplate
     */
    public function includeBaseTemplate ($includeBaseTemplate = true) {
        $this->includeBaseTemplate = $includeBaseTemplate;
    }

    /**
     * @param bool $showNavBar
     */
    public function showNavBar ($showNavBar = true) {
        $this->showNavBar = $showNavBar;
    }
}