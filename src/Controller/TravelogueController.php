<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class TravelogueController extends AbstractController
{

    #[Route('/en', name: 'travelogue_en', options: ["sitemap" => true])]
    #[Route('/carnet-du-voyageur', name: 'travelogue', options: ["sitemap" => true])]
    public function travelogue(): Response
    {
        return $this->render('travelogue/travelogue.html.twig', [

        ]);
    }
}
