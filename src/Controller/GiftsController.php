<?php

namespace App\Controller;

use App\Repository\BarRepository;
use App\Repository\PartnersRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class GiftsController extends AbstractController
{
    #[Route('/bon-cadeau/', name: 'gifts', options: ["sitemap" => true])]
    public function gifts(): Response
    {

        return $this->render('gifts/gifts.html.twig', [

        ]);
    }
}
