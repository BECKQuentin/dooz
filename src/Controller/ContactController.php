<?php

namespace App\Controller;

use App\Entity\Contact;
use App\Form\ContactFormType;
use App\Repository\PartnersRepository;
use App\Service\EmailService;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ContactController extends AbstractController
{
//    #[Route('/contact', name: 'contact', options: ["sitemap" => true])]
//    public function contact(PartnersRepository $partnersRepository, EmailService $emailService, Request $request, ManagerRegistry $doctrine): Response
//    {
//        $contact = new Contact();
//        $form = $this->createForm(ContactFormType::class, $contact);
//        $form->handleRequest($request);
//
//        if ($form->isSubmitted() && $form->isValid()) {
//
//            //Vérifier ReCaptacha
//
//                //Email de contact
//                $emailService->send([
//                    'to'        => $form->getData()->getEmail(), //if empty => adminEmail
//                    'subject'   => $form->getData()->getSubject(),
//                    'template'  => 'email/contact/rep_contact.html.twig',
//    //                'context' => [
//    //                    'user' => $user,
//    //                ],
//                ]);
//
//
//                /*Ajouter message en BDD*/
//                $contact->setCreatedAt(new \DateTimeImmutable('now'));
//                $em = $doctrine->getManager();
//                $em->persist($contact);
//                $em->flush();
//
////                $this->addFlash('success', "Message envoyé avec succès");
//        }
//
//        return $this->render('contact/contact.html.twig', [
//            'form'      => $form->createView(),
//            'partners'  => $partnersRepository->findAll(),
//
//        ]);
//    }
}
