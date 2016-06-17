<?php
namespace BeatHeat\Login;

use BeatHeat\SessionHandler;
use BeatHeat\Template;
use UsersQuery;

class Login
{
    /**
     * @var Template $template
     */
    private $template;
    const TEMPLATE_FILE = 'overview/overview.html.twig';
    /**
     * @var SessionHandler
     */
    private $sessionHandler;

    /**
     * Login constructor.
     * @param Template $template
     * @param SessionHandler $sessionHandler
     */
    public function __construct(Template $template, SessionHandler $sessionHandler)
    {
        $this->template = $template;
        $this->sessionHandler = $sessionHandler;
    }

    public function getHTML()
    {
        echo json_encode(['templateData' => $this->template->getHTMLAsString(self::TEMPLATE_FILE)]);
    }

    public function handleLogin()
    {
        if (!isset($_POST['loginName']) ||
            !isset($_POST['loginPassword'])
        ) {
            return false;
        }

        if ($this->login($_POST['loginName'], $_POST['loginPassword'])) {
            $this->getHTML();
        }
    }

    public function login($userName, $password)
    {
        $usersQuery = new UsersQuery();

        $user = $usersQuery->filterByName($userName)
            ->filterByPassword($password)
            ->findOne();

        if (!empty($user)) {
            $this->setUserAsSession($user);
            return $user;
        }

        return null;
    }

    public function setUserAsSession($user)
    {
        $this->sessionHandler->setSessionUser($user);
    }
}