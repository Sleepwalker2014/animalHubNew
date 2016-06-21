<?php
namespace BeatHeat\Register;

use BeatHeat\SessionHandler;
use BeatHeat\Template;
use Propel\Runtime\Exception\PropelException;
use Users;

class Register {
    /**
     * @var Template $template
     */
    private $template;

    /**
     * @var SessionHandler
     */
    private $sessionHandler;

    /**
     * Register constructor.
     *
     * @param Template       $template
     * @param SessionHandler $sessionHandler
     */
    public function __construct (Template $template, SessionHandler $sessionHandler) {
        $this->template = $template;
        $this->sessionHandler = $sessionHandler;
    }

    public function handleRegister()
    {
        if (!isset($_POST['registerName'],
                   $_POST['registerEmail'],
                   $_POST['registerPassword'])
        ) {

            return false;
        }

        try {
            $this->registerUser($_POST['registerName'], $_POST['registerEmail'], $_POST['registerPassword']);
        } catch (PropelException $e) {
            if ($e->getPrevious()->getCode() == 23000) {
                echo $this->getFailResponse();
            }
        }

        return true;
    }

    /**
     * @param string $userName
     * @param string $email
     * @param string $password
     *
     * @return true|Exception
     */
    public function registerUser ($userName, $email, $password) {
        $user = new Users();
        $user->setName($userName)
             ->setEmail($email)
             ->setPassword($password);

        $user->save();

        return true;
    }

    public function setUserAsSession ($user) {
        $this->sessionHandler->setSessionUser($user);
    }

    public function getFailResponse () {
        return json_encode(['success' => false, 'templateData' => 'Die E-Mail oder der Benutzername wird bereits verwendet.']);
    }
}