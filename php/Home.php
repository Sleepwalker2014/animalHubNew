<?php
namespace BeatHeat\Home;

use BeatHeat\SessionHandler;
use BeatHeat\Template;

class Home
{
    /**
     * @var Template $template
     */
    private $template;

    const TEMPLATE_FILE = 'home/home.html.twig';

    /**
     * Login constructor.
     * @param Template $template
     * @param SessionHandler $sessionHandler
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