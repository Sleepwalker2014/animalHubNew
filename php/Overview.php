<?php
namespace BeatHeat\Overview;

use BeatHeat\SessionHandler;
use BeatHeat\Template;

class Overview
{
    /**
     * @var Template $template
     */
    private $template;

    const TEMPLATE_FILE = 'overview/overview.html.twig';

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