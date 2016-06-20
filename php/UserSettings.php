<?php
namespace BeatHeat\UserSettings;

use BeatHeat\SessionHandler;
use BeatHeat\Template;

class UserSettings
{
    /**
     * @var Template $template
     */
    private $template;

    const TEMPLATE_FILE = 'userSettings/userSettings.html.twig';

    /**
     * UserSettings constructor.
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