<?php
namespace BeatHeat\Logout;

use BeatHeat\Home\Home;
use BeatHeat\SessionHandler;
use BeatHeat\Template;

class Logout
{
    /**
     * @var Template $template
     */
    private $template;

    /**
     * @var SessionHandler
     */
    private $sessionHandler;

    /**
     * Logout constructor.
     * @param Template $template
     * @param SessionHandler $sessionHandler
     */
    public function __construct(Template $template, SessionHandler $sessionHandler)
    {
        $this->template = $template;
        $this->sessionHandler = $sessionHandler;
    }

    public function handleLogout()
    {
        $this->sessionHandler->closeSession();

        echo $this->template->getHTMLAsString('home/home.html.twig');
    }
}