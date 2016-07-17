<?php
namespace BeatHeat\AnimalOverview;

use Animals;
use AnimalsQuery;
use BeatHeat\SessionHandler;
use BeatHeat\Template;
use Map\AnimalsTableMap;

class AnimalOverview
{
    /**
     * @var Template $template
     */
    private $template;

    /**
     * @var Template $template
     */
    private $sessionHandler;


    const TEMPLATE_FILE = 'animalOverview/animalOverview.html.twig';

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
        $userAnimals = $this->getAnimalsFromUser();

        $response = $this->getHTMLResponse($userAnimals);
        syslog(0, print_r($response, true));

        echo $this->template->getHTMLAsString(self::TEMPLATE_FILE, $response);
    }

    /**
     * @return Animals[]|\Propel\Runtime\Collection\ObjectCollection
     */
    public function getAnimalsFromUser () {
        $user = $this->sessionHandler->getSessionUser();

        $animalQuery = new AnimalsQuery();

        return $animalQuery->findByUser($user);
    }

    /**
     * @param $userAnimals Animals[]|\Propel\Runtime\Collection\ObjectCollection
     * @return mixed[]
     */
    public function getHTMLResponse ($userAnimals) {
        $response = [];

        foreach ($userAnimals as $userAnimal) {
            $response['animals'][] = ['name' => $userAnimal->getName()];
        }

        return $response;
    }
}