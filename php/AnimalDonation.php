<?php
namespace BeatHeat\AnimalDonation;

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

class AnimalDonation
{
    /**
     * @var Template $template
     */
    private $template;

    /**
     * @var Template $template
     */
    private $sessionHandler;

    const TEMPLATE_FILE = 'animalDonation/animalDonation.html.twig';

    /**
     * AnimalDonation constructor.
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
        $response = [];
syslog(0, "hh");
        echo $this->template->getHTMLAsString(self::TEMPLATE_FILE, $response);
    }
}