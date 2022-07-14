<?php

namespace App\Controller;

use App\Repository\PartnersRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DestroyController extends AbstractController
{


    #[Route('/destroy-1-joueur', name: 'destroy1', options: ["sitemap" => true])]
    #[Route('/destroy-2-joueurs', name: 'destroy2', options: ["sitemap" => true])]
    #[Route('/destroy-3-joueurs', name: 'destroy3', options: ["sitemap" => true])]
    #[Route('/destroy-4-joueurs', name: 'destroy4', options: ["sitemap" => true])]
    #[Route('/reservation-destroy-room', name: 'destroy', options: ["sitemap" => true])]
    public function destroy(PartnersRepository $partnersRepository): Response
    {
        return $this->render('destroy/destroy.html.twig', [
            'metadata'  => 'destroy',
            'partners'  => $partnersRepository->findAll(),
        ]);
    }

    #[Route('/vanaheim/destroy-1-joueur', name: 'vanaheim_destroy1', options: ["sitemap" => true])]
    #[Route('/vanaheim/destroy-2-joueurs', name: 'vanaheim_destroy2', options: ["sitemap" => true])]
    #[Route('/vanaheim/destroy-3-joueurs', name: 'vanaheim_destroy3', options: ["sitemap" => true])]
    #[Route('/vanaheim/destroy-4-joueurs', name: 'vanaheim_destroy4', options: ["sitemap" => true])]
    #[Route('/vanaheim/reservation-destroy-room', name: 'vanaheim_destroy', options: ["sitemap" => true])]
    public function destroyVanaheim(PartnersRepository $partnersRepository): Response
    {
        return $this->render('destroy/destroy_vanaheim.html.twig', [
            'metadata'  => 'destroy',
            'partners'  => $partnersRepository->findAll(),
        ]);
    }
}
