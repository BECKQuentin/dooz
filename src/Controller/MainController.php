<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MainController extends AbstractController
{
    /**
     * Changer la langue du site
     * @Route("/change-locale/{locale}", name="change_locale")
     */
    public function changeLocale($locale, Request $request): Response
    {
        //On stocke la langue demandée dans la session
        $request->getSession()->set('_locale', $locale);

        // On reviens sur la page précedente
        return $this->redirect($request->headers->get('referer'));
    }
}
