<?php
namespace BeatHeat\MainRouter;

use BeatHeat\SessionHandler;
use BeatHeat\Template;

class MainRouter
{
    private $actionCode = null;
    private $parameters = [];
    private $actionMethodMap = ['Login' => ['class' => 'Login', 'method' => 'getHTML'],
                                'LoginUser' => ['class' => 'Login', 'method' => 'handleLogin'],
                                'LogoutUser' => ['class' => 'Logout', 'method' => 'handleLogout'],
                                'Home' => ['class' => 'Home', 'method' => 'getHTML'],
                                'Overview' => ['class' => 'Overview', 'method' => 'getHTML']];
    /**
     * @var Template
     */
    private $template;
    /**
     * @var SessionHandler
     */
    private $sessionHandler;

    /**
     * MainRouter constructor.
     * @param string|null $actionCode
     * @param mixed[] $parameters
     * @param Template $template
     * @param SessionHandler $sessionHandler
     */
    public function __construct($actionCode = null, $parameters = [], Template $template, SessionHandler $sessionHandler)
    {
        $this->actionCode = $actionCode;
        $this->parameters = $parameters;
        $this->template = $template;
        $this->sessionHandler = $sessionHandler;
    }

    public function route()
    {
        $user = $this->sessionHandler->getSessionUser();

        if (!empty($user)) {
            if (empty($this->actionCode)) {
                $this->actionCode = 'Overview';
            }
        } elseif (empty($this->actionCode)) {
            $this->actionCode = 'Home';
        }

        if (isset($this->actionMethodMap[$this->actionCode])) {
            $className = "BeatHeat\\" . $this->actionMethodMap[$this->actionCode]['class'] . "\\" . $this->actionMethodMap[$this->actionCode]['class'];

            $actionClass = new $className($this->template, $this->sessionHandler);
            $actionMethod = $this->actionMethodMap[$this->actionCode]['method'];

            $actionClass->$actionMethod();
        }

        return true;
    }
}