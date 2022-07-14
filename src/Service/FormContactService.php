<?php

namespace App\Service;


use App\Entity\Contact;
use App\Form\ContactFormType;
use Symfony\Bridge\Doctrine\ManagerRegistry;
use Symfony\Component\HttpFoundation\Request;

class FormContactService
{

    public function formContact(Request $request, ManagerRegistry $doctrine)
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

            return $form;
        }
        return $form;
    }

}