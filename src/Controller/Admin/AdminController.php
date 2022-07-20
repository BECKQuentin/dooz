<?php

namespace App\Controller\Admin;

use App\Entity\CGV;
use App\Entity\Event;
use App\Entity\Partners;
use App\Entity\Room;
use App\Form\CGVFormType;
use App\Form\DoozFormType;
use App\Form\EventFormType;
use App\Form\PartnersFormType;
use App\Form\RoomFormType;
use App\Repository\BarRepository;
use App\Repository\CGVRepository;
use App\Repository\EventRepository;
use App\Repository\PartnersRepository;
use App\Repository\RoomRepository;
use App\Service\UploadService;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AdminController extends AbstractController
{
    #[Route('/a/admin', name: 'admin', options: ["sitemap" => false])]
    public function admin(RoomRepository $roomRepository, CGVRepository $cgvRepository, Request $request): Response
    {

        return $this->render('admin/admin.html.twig', [
            'isAdminPage'   => true,
        ]);
    }
    ////////ESCAPE///////////////////////////////////////////////////////////////////////////////////////////////
    //Affichage de room spécifique + modification
    #[Route('/a/room/{id}', name: 'admin_room', options: ["sitemap" => false])]
    public function adminRoom(Room $room, Request $request, UploadService $uploadService, ManagerRegistry $doctrine): Response
    {
        $form = $this->createForm(RoomFormType::class, $room);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $room->setUpdatedAt(new \DateTimeImmutable('now'));

            $thumbnail = $form->get('thumbnail')->getData();
            $banner = $form->get('banner')->getData();
            $clock = $form->get('clock_thumbnail')->getData();

            if ($thumbnail) {
                $fileName = $uploadService->uploadThumbnailRoom($thumbnail, $room);
                $room->setThumbnail($fileName);
            }
            if ($banner) {
                $fileName = $uploadService->uploadBannerRoom($banner, $room);
                $room->setBanner($fileName);
            }
            if ($clock) {
                $fileName = $uploadService->uploadClockRoom($clock, $room);
                $room->setClockThumbnail($fileName);
            }

            $em = $doctrine->getManager();
            $em->persist($room);
            $em->flush();

            $this->addFlash('success', "Les modifications ont bien été sauvegardées !");
        }

        return $this->render('admin/escape/room.html.twig', [
            'isAdminPage'   => true,
            'room'          => $room,
            'form'          => $form->createView()
        ]);
    }

    //Création d'une nouvelle room
    #[Route('/a/room-add', name: 'admin_room_add', options: ["sitemap" => false])]
    public function adminRoomCreate(Request $request, UploadService $uploadService, ManagerRegistry $doctrine): Response
    {
        $room = new Room();
        $form = $this->createForm(RoomFormType::class, $room);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $thumbnail = $form->get('thumbnail')->getData();
            $banner = $form->get('banner')->getData();
            $clock = $form->get('clock_thumbnail')->getData();

            if ($thumbnail) {
                $fileName = $uploadService->uploadThumbnailRoom($thumbnail, $room);
                $room->setThumbnail($fileName);
            }
            if ($banner) {
                $fileName = $uploadService->uploadBannerRoom($banner, $room);
                $room->setBanner($fileName);
            }
            if ($clock) {
                $fileName = $uploadService->uploadClockRoom($clock, $room);
                $room->setClockThumbnail($fileName);
            }

            $em = $doctrine->getManager();
            $em->persist($room);
            $em->flush();

            $this->addFlash('success', "Nouvelle Room crée Félicitations !");
            return $this->redirectToRoute('admin_room', ['id' => $room->getId()]);
        }

        return $this->render('admin/escape/room.html.twig', [
            'isAdminPage'   => true,
            'isAddingRoom'  => true,
            'room'          => $room,
            'form'          => $form->createView()
        ]);
    }

    //Suppression d'une Room
    #[Route('/a/room-delete/{id}', name: 'admin_room_delete', options: ["sitemap" => false])]
    public function adminRoomDelete(Room $room, Request $request, ManagerRegistry $doctrine): Response
    {
        $em = $doctrine->getManager();
        $em->remove($room);
        $em->flush();

        $this->addFlash('success', "Salle supprimé avec succès");

        return $this->redirectToRoute('admin', [
            'isAdminPage'   => true,
        ]);
    }

    ////////BARS//////////////////////////////////////////////////////////////////////////////////////////////

    ////////DESTROY ROOM////////////////////////////////////////////////////////////////////////////////////////




    //////EVENTS//////////////////////////////////////////////////////////////////////////////////////////////
    //Affichage des events + Ajout d'un nouvelle events
    #[Route('/a/events', name: 'admin_events', options: ["sitemap" => false])]
    public function adminEvents(EventRepository $eventRepository, Request $request, ManagerRegistry $doctrine): Response
    {
//        $events = $eventRepository->findAll();
//
//        $event = new Event();
//        $form = $this->createForm(EventFormType::class, $event);
//        $form->handleRequest($request);
//
//        if ($form->isSubmitted() && $form->isValid()) {
//
//            $em = $doctrine->getManager();
//            $em->persist($event);
//            $em->flush();
//
//            $this->addFlash('success', "Et hop un nouvel evenement !");
//            return $this->redirect($request->getUri());
//        }

        return $this->render('admin/event/event.html.twig', [
            'isAdminPage'   => true,
//            'events'        => $events,
//            'form'          => $form->createView()
        ]);
    }

    //Modification d'un Events
    #[Route('/a/event-update/{id}', name: 'admin_event_update', options: ["sitemap" => false])]
    public function adminEventUpdate(Event $event, EventRepository $eventRepository, Request $request, ManagerRegistry $doctrine): Response
    {

//        $events = $eventRepository->findAll();
//
//        $form = $this->createForm(EventFormType::class, $event);
//        $form->handleRequest($request);
//
//        if ($form->isSubmitted() && $form->isValid()) {
//
//            $em = $doctrine->getManager();
//            $em->persist($event);
//            $em->flush();
//
//            $this->addFlash('success', "Bien modifié");
//            return $this->redirect($request->getUri());
//        }

        return $this->render('admin/event/event.html.twig', [
            'isAdminPage'   => true,
//            'event'         => $event,
//            'events'        => $events,
//            'form'          => $form->createView(),
        ]);
    }
    //Suppression d'un event
    #[Route('/a/event-delete/{id}', name: 'admin_event_delete', options: ["sitemap" => false])]
    public function adminEventDelete(Event $event, Request $request, ManagerRegistry $doctrine): Response
    {
        $em = $doctrine->getManager();
        $em->remove($event);
        $em->flush();

        $this->addFlash('success', "Evenement supprimé avec succès");

        return $this->redirectToRoute('admin_events');
    }



    //////PARTENAIRES/////////////////////////////////////////////////////////////////////////////////
    //Affichage des partenaires + Ajout d'un nouveau partenaire
    #[Route('/a/partners', name: 'admin_partners', options: ["sitemap" => false])]
    public function adminParnters(PartnersRepository $partnersRepository, Request $request, UploadService $uploadService, ManagerRegistry $doctrine): Response
    {
        $partners = $partnersRepository->findAll();

        $partner = new Partners();
        $form = $this->createForm(PartnersFormType::class, $partner);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $thumbnail = $form->get('thumbnail')->getData();

            if ($thumbnail) {
                $fileName = $uploadService->uploadThumbnailPartner($thumbnail, $partner);
                $partner->setThumbnail($fileName);
            }

            $em = $doctrine->getManager();
            $em->persist($partner);
            $em->flush();

            $this->addFlash('success', "Super un nouveau partenaire !");
            return $this->redirect($request->getUri());
        }

        return $this->render('admin/partners.html.twig', [
            'isAdminPage'   => true,
            'partners'      => $partners,
            'form'          => $form->createView()
        ]);
    }

    //Modification d'un partenaire
    #[Route('/a/partner-update/{id}', name: 'admin_partner_update', options: ["sitemap" => false])]
    public function adminPartnerUpdate(Partners $partner, Request $request,UploadService $uploadService, ManagerRegistry $doctrine): Response
    {

        $form = $this->createForm(PartnersFormType::class, $partner);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $thumbnail = $form->get('thumbnail')->getData();

            if ($thumbnail) {
                $fileName = $uploadService->uploadThumbnailPartner($thumbnail, $partner);
                $partner->setThumbnail($fileName);
            }

            $em = $doctrine->getManager();
            $em->persist($partner);
            $em->flush();

            $this->addFlash('success', "Super un nouveau partenaire !");
            return $this->redirect($request->getUri());
        }

        return $this->render('admin/partners_update.html.twig', [
            'isAdminPage'   => true,
            'partner'      => $partner,
            'form'          => $form->createView()
        ]);
    }

    //Suppression d'un partenaire
    #[Route('/a/partner-delete/{id}', name: 'admin_partner_delete', options: ["sitemap" => false])]
    public function adminPartnerDelete(Partners $partners, Request $request, ManagerRegistry $doctrine): Response
    {
        $em = $doctrine->getManager();
        $em->remove($partners);
        $em->flush();

        $this->addFlash('success', "Partenaire supprimé avec succès");

        return $this->redirectToRoute('admin_partners');
    }










    //Modification des CGV existants
    #[Route('/a/CGV/{id}', name: 'admin_cgv', options: ["sitemap" => false])]
    public function adminCGV(CGV $cgv, CGVRepository $CGVRepository, Request $request, ManagerRegistry $doctrine): Response
    {
        $form = $this->createForm(CGVFormType::class, $cgv);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $cgv->setUpdatedAt(new \DateTimeImmutable('now'));
            $em = $doctrine->getManager();
            $em->persist($cgv);
            $em->flush();

            $this->addFlash('success', "CGV modifiées avec succès");
            return $this->redirectToRoute('admin_cgv', ['id' => $cgv->getId()]);
        }

        return $this->render('admin/cgv.html.twig', [
            'isAdminPage'   => true,
            'form'          => $form->createView(),
            'cgv'           => $cgv
        ]);
    }


    //Modification du profil Dooz
    #[Route('/a/dooz', name: 'admin_dooz', options: ["sitemap" => false])]
    public function adminDooz(Request $request, ManagerRegistry $doctrine): Response
    {

        $form = $this->createForm(DoozFormType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $em = $doctrine->getManager();
            $em->persist();
            $em->flush();

            $this->addFlash('success', "Profil bien modifié");
//            return $this->redirectToRoute('admin_dooz', ['id' => $dooz->getId()]);
        }

        return $this->render('admin/dooz/dooz.html.twig', [
            'isAdminPage'   => true,
            'form'          => $form->createView(),
        ]);
    }


}
