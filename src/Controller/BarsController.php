<?php

namespace App\Controller;

use App\Repository\BarRepository;
use App\Repository\PartnersRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class BarsController extends AbstractController
{

    #[Route('/bars-a-jeux', name: 'bars', options: ["sitemap" => true])]
    public function bars(PartnersRepository $partnersRepository): Response
    {
        return $this->render('bars/bars.html.twig', [
            'partners' => $partnersRepository->findAll(),
        ]);
    }

    #[Route('/bars-a-jeux/malleus-maleficarum/', name: 'malleus', options: ["sitemap" => true])]
    public function malleus(PartnersRepository $partnersRepository, BarRepository $barRepository): Response
    {
        //Renvoi le bar avec l'id 1 soit le Malleus
        $bar = $barRepository->find(1);

        return $this->render('bars/malleus.html.twig', [
            'metadata' => 'malleus',
            'partners' => $partnersRepository->findAll(),
            'bar'      => $bar,
        ]);
    }

    #[Route('/bars-a-jeux/episode-0/', name: 'episode0', options: ["sitemap" => true])]
    public function episode0(PartnersRepository $partnersRepository): Response
    {

        return $this->render('bars/episode0.html.twig', [
            'metadata' => 'episode0',
            'partners' => $partnersRepository->findAll(),
        ]);
    }

}
