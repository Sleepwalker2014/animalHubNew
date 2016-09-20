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
            $response['animals'][] = ['animal' => $userAnimal->getAnimal(),
                                      'name' => $userAnimal->getName(),
                                      'birthDay' => $userAnimal->getBirthday('d.m.Y'),
                                      'race' => $userAnimal->getGenuses()->getDescription(),
                                      'genus' => $userAnimal->getGenus(),
                                      'sex' => $userAnimal->getSexes()->getCode(),
                                      'eyeColour' => $userAnimal->getColoursRelatedByEyecolour()->getDescription(),
                                      'furColour' => $userAnimal->getColoursRelatedByFurcolour()->getDescription(),
                                      'specification' => $userAnimal->getSpecification()];
        }

        return $response;
    }

    /**
     * @internal param int $animalId
     */
    public function removeAnimal()
    {
        $animalId = $_POST['animalId'];
        $animalQuery = new AnimalsQuery();
        $animalQuery->filterByAnimal($animalId)
                    ->filterByUser($this->sessionHandler->getSessionUser())
                    ->delete();
    }
}