<?php

namespace App\Controller;

use App\Repository\BarRepository;
use App\Repository\PartnersRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class VanaheimController extends AbstractController
{

    #[Route('/vanaheim/', name: 'vanaheim', options: ["sitemap" => true])]
    public function vanaheim(PartnersRepository $partnersRepository): Response
    {

        return $this->render('bars/vanaheim.html.twig', [
            'metadata' => 'vanaheim',
            'partners' => $partnersRepository->findAll(),
        ]);
    }

    #[Route('/vanaheim/lancer-de-haches', name: 'vanaheim_axe', options: ["sitemap" => true])]
    public function vanaheimAxe(PartnersRepository $partnersRepository): Response
    {

        return $this->render('bars/vanaheim.html.twig', [
            'metadata' => 'vanaheim',
            'isAxePage' => true,
            'partners' => $partnersRepository->findAll(),
        ]);
    }


}
