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
        'Register' => ['class' => 'Register', 'method' => 'handleRegister'],
        'CompleteRegister' => ['class' => 'Register', 'method' => 'handleCompleteRegistration'],
        'Home' => ['class' => 'Home', 'method' => 'getHTML'],
        'Overview' => ['class' => 'Overview', 'method' => 'getHTML'],
        'UserSettings' => ['class' => 'UserSettings', 'method' => 'getHTML'],
        'AnimalOverview' => ['class' => 'AnimalOverview', 'method' => 'getHTML'],
        'EditAnimal' => ['class' => 'EditAnimal', 'method' => 'getHTML'],
        'SaveAnimal' => ['class' => 'EditAnimal', 'method' => 'saveAnimal'],
        'RemoveAnimal' => ['class' => 'AnimalOverview', 'method' => 'removeAnimal'],
        'AnimalDonation' => ['class' => 'AnimalDonation', 'method' => 'getHTML']];
    /**
     * @var Template
     */
    private $template;

    /**
     * @var SessionHandler
     */
    private $sessionHandler;

    /**
     * @var bool
     */
    private $isAjax;

    /**
     * MainRouter constructor.
     * @param string|null $actionCode
     * @param mixed[] $parameters
     * @param Template $template
     * @param SessionHandler $sessionHandler
     * @param bool|false $isAjax
     */
    public function __construct($actionCode = null, $parameters = null, Template $template, SessionHandler $sessionHandler, $isAjax = false)
    {
        $this->actionCode = $actionCode;
        $this->parameters = $parameters;
        $this->template = $template;
        $this->sessionHandler = $sessionHandler;
        $this->isAjax = $isAjax;
    }

    public function route()
    {
        $user = $this->sessionHandler->getSessionUser();

        $this->template->includeBaseTemplate(!$this->isAjax);

        if (!empty($user)) {
            if (empty($this->actionCode)) {
                $this->actionCode = 'Overview';
            }
        } elseif (empty($this->actionCode) || ($this->actionCode != 'CompleteRegister' && $this->actionCode != 'LoginUser')) {
            $this->actionCode = 'Home';
        }

        if (isset($this->actionMethodMap[$this->actionCode])) {
            $className = "BeatHeat\\" . $this->actionMethodMap[$this->actionCode]['class'] . "\\" . $this->actionMethodMap[$this->actionCode]['class'];

            $actionClass = new $className($this->template, $this->sessionHandler, $this->parameters);
            $actionMethod = $this->actionMethodMap[$this->actionCode]['method'];

            $actionClass->$actionMethod();
        }

        return true;
    }
}