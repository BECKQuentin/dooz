<?php

namespace App\Twig;

use App\Entity\Bar;
use App\Entity\CGV;
use App\Entity\Room;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpKernel\Event\GetResponseEvent;
use Symfony\Component\HttpKernel\Event\RequestEvent;
use Symfony\Component\HttpKernel\KernelEvents;
use Twig\Environment;

//Renvoie en globals les noms pour afficher dans le header

class TwigGlobalSubscriber implements EventSubscriberInterface {

    /**
    * @var \Twig\Environment
    */
    private $twig;
    /**
    * @var \Doctrine\ORM\EntityManagerInterface
    */
    private $manager;

    public function __construct( Environment $twig, EntityManagerInterface $manager ) {
        $this->twig    = $twig;
        $this->manager = $manager;
    }

    public function onKernelRequest( RequestEvent $event)
    {

        $rooms = $this->manager->getRepository( Room::class )->findAll();
        $this->twig->addGlobal( 'rooms', $rooms );

        $bars = $this->manager->getRepository( Bar::class)->findAll();
        $this->twig->addGlobal( 'bars', $bars );

        $cgvs = $this->manager->getRepository( CGV::class )->findAll();
        $this->twig->addGlobal( 'cgvs', $cgvs );
    }

    public static function getSubscribedEvents()
    {
        return [
            // On doit définir une priorité élevée
            KernelEvents::REQUEST => [['onKernelRequest', 20]],
        ];
    }
}