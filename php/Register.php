<?php
namespace BeatHeat\Register;

use BeatHeat\SessionHandler;
use BeatHeat\Template;
use Propel\Runtime\Exception\PropelException;
use RegistrationsQuery;
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
     * @var mixed[]
     */
    private $parameters;


    /**
     * Register constructor.
     *
     * @param Template $template
     * @param SessionHandler $sessionHandler
     * @param mixed[]|null $parameters
     */
    public function __construct (Template $template, SessionHandler $sessionHandler, $parameters = null) {
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
            return false;
        }

        if (!$this->sendRegisterMail('marcel.roa@gmx.de',
                                     'Registrierung erfolgreich',
                                     'Erfolgreich registiert man!',
                                     'support@animalHub.de')
        ) {
            //return false;
        }

        echo $this->getSuccessfulRegisterResponse();
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

    public function getSuccessfulRegisterResponse () {
        return json_encode(['success' => true, 'templateData' => $this->template->getHTMLAsString('register\registerMailSend.html.twig')]);
    }


    public function sendRegisterMail ($receiverAddress, $subject, $message, $senderAddress) {
        $header  = "MIME-Version: 1.0\r\n".
                   "Content-type: text/html; charset=iso-8859-1\r\n".
                   "From: $senderAddress\r\n".
                   "X-Mailer: PHP ". phpversion();

        return mail($receiverAddress, $subject, $message, $header);
    }

    public function handleCompleteRegistration () {
        if (!isset($this->parameters)) {
            echo $this->template->getHTMLAsString('register\registerFailed.html.twig');
            return false;
        }

        $registration = $this->findOpenRegistrationByCode($this->parameters);
        if (empty($registration)) {
            echo $this->template->getHTMLAsString('register\registerFailed.html.twig');
            return false;
        }

        $registration->delete();

        $registration->getUsers()
                     ->setActive(true)
                     ->save();

        return true;
    }

    public function findOpenRegistrationByCode ($registrationCode) {
        $registrationQuery = new RegistrationsQuery();

        return $registrationQuery->findOneByCode($registrationCode);
    }
}