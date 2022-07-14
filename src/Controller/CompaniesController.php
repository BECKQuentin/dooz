<?php

namespace App\Controller;

use App\Entity\Contact;
use App\Form\ContactFormType;
use App\Repository\PartnersRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CompaniesController extends AbstractController
{
    #[Route('/entreprises', name:'companies', options: ["sitemap" => true])]
    public function companies(PartnersRepository $partnersRepository): Response
    {


        return $this->render('companies/companies.html.twig', [
            'partners' => $partnersRepository->findAll()
        ]);
    }

    #[Route('/entreprises/c-e', name: 'companies_works', options: ["sitemap" => true])]
    public function companiesWorks(Request $request, ManagerRegistry $doctrine): Response
    {
        $contact = new Contact();
        $form = $this->createForm(ContactFormType::class, $contact);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $contact->setCreatedAt(new \DateTimeImmutable('now'));
            $em = $doctrine->getManager();
            $em->persist($contact);
            $em->flush();

            $this->addFlash('success', "Message envoyé avec succès");
        }

        return $this->render('companies/works.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    #[Route('/entreprises/team-building', name: 'companies_team', options: ["sitemap" => true])]
    public function companiesTeam(Request $request, ManagerRegistry $doctrine): Response
    {
        $contact = new Contact();
        $form = $this->createForm(ContactFormType::class, $contact);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $contact->setCreatedAt(new \DateTimeImmutable('now'));
            $em = $doctrine->getManager();
            $em->persist($contact);
            $em->flush();

            $this->addFlash('success', "Message envoyé avec succès");
        }

        return $this->render('companies/team.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
