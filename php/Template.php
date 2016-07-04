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

    /**
     * Template constructor.
     * @param string $templatePath
     */
    public function __construct($templatePath)
    {
        $this->loader = new Twig_Loader_Filesystem($templatePath);
        $this->twig = new Twig_Environment($this->loader,  array('auto_reload' => true));
    }

    /**
     * @param string $templateFile
     * @param mixed[] $content
     * @return string
     */
    public function getHTMLAsString($templateFile, $content = [])
    {
        $_SERVER['DOCUMENT_ROOT'] = '/home/marcel/webProjects/animalHubNew/';

        return $this->twig->render($templateFile, $content);
    }
}