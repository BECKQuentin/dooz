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

class GroupsController extends AbstractController
{
    #[Route('/groups', name:'groups', options: ["sitemap" => true])]
    public function groups(PartnersRepository $partnersRepository, Request $request, ManagerRegistry $doctrine): Response
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

        return $this->render('groups/groups.html.twig', [
            'form' => $form->createView(),
            'partners' => $partnersRepository->findAll(),
        ]);
    }

    #[Route('/evjh-evjf-mariage/', name: 'groups_edv', options: ["sitemap" => true])]
    #[Route('/evenements/edv-de-jeune-fille-homme', name: 'groups_edv_1', options: ["sitemap" => true])]
    public function groupsEdv(PartnersRepository $partnersRepository, Request $request, ManagerRegistry $doctrine): Response
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

        return $this->render('groups/groups_edv.html.twig', [
            'form' => $form->createView(),
            'partners' => $partnersRepository->findAll(),
        ]);
    }

    #[Route('/anniversaires', name: 'groups_birthday', options: ["sitemap" => true])]
    #[Route('/evenements/anniversaires', name: 'groups_birthday_1', options: ["sitemap" => true])]
    public function groupsBirthday(PartnersRepository $partnersRepository, Request $request, ManagerRegistry $doctrine): Response
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

        return $this->render('groups/groups_birthday.html.twig', [
            'partners'  => $partnersRepository->findAll(),
            'form'      => $form->createView(),
        ]);
    }
}
