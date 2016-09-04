<?php
namespace BeatHeat\EditAnimal;

use Animals;
use AnimalsQuery;
use Colours;
use BeatHeat\SessionHandler;
use BeatHeat\Template;
use ColoursQuery;
use Exception;
use Genuses;
use GenusesQuery;
use Propel\Runtime\Collection\ObjectCollection;
use Races;
use RacesQuery;
use Sexes;
use SexesQuery;

class EditAnimal
{
    /**
     * @var Template $template
     */
    private $template;

    /**
     * @var Template $template
     */
    private $sessionHandler;

    const TEMPLATE_FILE = 'editAnimal/editAnimal.html.twig';

    /**
     * EditAnimal constructor.
     * @param Template $template
     * @param SessionHandler $sessionHandler
     */
    public function __construct (Template $template, SessionHandler $sessionHandler)
    {
        $this->template = $template;
        $this->sessionHandler = $sessionHandler;
    }

    public function getHTML ()
    {
        $response = $this->getHTMLResponse();

        echo $this->template->getHTMLAsString(self::TEMPLATE_FILE, $response);
    }

    /**
     * @return mixed[]
     */
    public function getHTMLResponse ()
    {
        $response = [];

        if (isset($_POST['animalId'])) {
            $response['animal'] = $this->convertAnimalObjectToHTML($this->getUserAnimal($_POST['animalId']));
            $response['colours'] = $this->convertColourObjectToHTML();
            $response['races'] = $this->convertRaceObjectToHTML();
            $response['genuses'] = $this->convertGenusObjectToHTML();
            $response['sexes'] = $this->convertSexesObjectToHTML();
        }

        return $response;
    }

    /**
     * @param int $userAnimal
     * @return Animals|ObjectCollection
     */
    public function getUserAnimal ($userAnimal)
    {
        $animalQuery = new AnimalsQuery();

        return $animalQuery->filterByAnimal($userAnimal)
                           ->filterByUser($this->sessionHandler->getSessionUser())
                           ->findOne();
    }

    /**
     * @param Animals $animal
     * @return array
     */
    public function convertAnimalObjectToHTML (Animals $animal) {
        return ['animal' => $animal->getAnimal(),
                'name' => $animal->getName(),
                'birthDay' => $animal->getBirthday('d.m.Y'),
                'furColour' => $animal->getFurcolour(),
                'eyeColour' => $animal->getEyecolour(),
                'genus' => $animal->getGenus(),
                'race' => $animal->getRace(),
                'sex' => $animal->getSex(),
                'specification' => $animal->getSpecification()];
    }

    /**
     * @return array
     */
    public function convertColourObjectToHTML () {
        $colourObjects = $this->getAllColours();
        $colours = [];

        foreach ($colourObjects as $colourObject) {
            $colours[$colourObject->getColour()] = $colourObject->getDescription();
        }

        return $colours;
    }

    /**
     * @return array
     */
    public function convertRaceObjectToHTML () {
        $racesObjects = $this->getAllRaces();
        $races = [];

        foreach ($racesObjects as $raceObject) {
            $races[$raceObject->getRace()] = $raceObject->getName();
        }

        return $races;
    }

    /**
     * @return array
     */
    public function convertGenusObjectToHTML () {
        $genusesObjects = $this->getAllGenuses();
        $genuses = [];

        foreach ($genusesObjects as $genusObject) {
            $genuses[$genusObject->getGenus()] = $genusObject->getDescription();
        }

        return $genuses;
    }

    /**
     * @return array
     */
    public function convertSexesObjectToHTML () {
        $sexesObjects = $this->getAllSexes();
        $sexes = [];

        foreach ($sexesObjects as $sexObject) {
            $sexes[$sexObject->getSex()] = $sexObject->getCode();
        }

        return $sexes;
    }


    /**
     * @return Colours[]|ObjectCollection
     */
    public function getAllColours () {
        $colourQuery = new ColoursQuery();

        return $colourQuery->find();
    }

    /**
     * @return Races[]|ObjectCollection
     */
    public function getAllRaces () {
        $racesQuery = new RacesQuery();

        return $racesQuery->find();
    }

    /**
     * @return Genuses[]|ObjectCollection
     */
    public function getAllGenuses () {
        $genusesQuery = new GenusesQuery();

        return $genusesQuery->find();
    }

    /**
     * @return Sexes[]|ObjectCollection
     */
    public function getAllSexes () {
        $sexesQuery = new SexesQuery();

        return $sexesQuery->find();
    }

    public function saveAnimal () {
        if (!isset($_POST['name'])) {
            return false;
        }

        try {
            if (isset($_POST['animal'])) {
                $animalQuery = new AnimalsQuery();
                $animalObject = $animalQuery->filterByUser($this->sessionHandler->getSessionUser())
                    ->findOneByAnimal($_POST['animal']);
            }

            if (empty($animalObject)) {
                $animalObject = new Animals();
            }

            $animalObject->setName($_POST['name'])
                        ->setBirthday($_POST['birthDay'])
                        ->setSex($_POST['sex'])
                        ->setFurcolour($_POST['furColour'])
                        ->setEyecolour($_POST['eyeColour'])
                        ->setGenus($_POST['genus'])
                        ->setRace($_POST['race'])
                        ->setSize(1)
                        ->setUser($this->sessionHandler->getSessionUser())
                        ->setSize($_POST['size'])
                        ->setSpecification($_POST['specification'])->save();
        } catch (Exception $e) {
            syslog(0, "hwodddrst");
            echo 'Exception abgefangen: ';
        }

        echo 'erfolgreich gespeichert.';
    }
}