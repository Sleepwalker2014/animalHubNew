<?php
namespace BeatHeat\Main;

use BeatHeat\Template;

class Main
{
    /**
     * @var Template $template
     */
    private $template;
    const TEMPLATE_FILE = 'main/main.html.twig';

    /**
     * Login constructor.
     * @param Template $template
     */
    public function __construct(Template $template)
    {
        $this->template = $template;
    }

    public function getHTML()
    {
        echo $this->template->getHTMLAsString(self::TEMPLATE_FILE);
    }
}