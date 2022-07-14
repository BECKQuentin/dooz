<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DefaultController extends AbstractController
{

    #[Route('/', name: 'app_default', options: ["sitemap" => true])]
    public function home(): Response
    {
        return $this->render('home/home.html.twig', [
            'isHomepage' => true,
        ]);
    }

}
