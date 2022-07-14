<?php

namespace App\Controller;

use App\Entity\Room;
use App\Repository\PartnersRepository;
use App\Repository\RoomRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class EscapeController extends AbstractController
{
    #[Route('/qui-sommes-nous', name: 'rooms1', options: ["sitemap" => true])]
    #[Route('/faq',             name: 'rooms2', options: ["sitemap" => true])]
    #[Route('/cgv',             name: 'rooms3', options: ["sitemap" => false])]
    #[Route('/mentions-legales', name: 'rooms4', options: ["sitemap" => true])]
    #[Route('/contact',         name: 'rooms5', options: ["sitemap" => true])]
    #[Route('/escape-game',     name: 'rooms', options: ["sitemap" => true])]
    public function rooms(PartnersRepository $partnersRepository): Response
    {
        return $this->render('escape/rooms.html.twig', [
            'partners'  => $partnersRepository->findAll(),
        ]);
    }

    #[Route('/room/{slug}', name: 'room', options: ["sitemap" => false])]
    public function room(string $slug, RoomRepository $roomRepository): Response
    {
        $room = $roomRepository->findOneBy(["slug" => $slug]);

        if(!$room){
            return $this->redirectToRoute("rooms");
        }

        //Création de nombre aléatoire pour proposition autre rooms
        $maxRoom = $roomRepository->maxRoom();
        $rnd1 = rand(1, $maxRoom);
        do {
            $rnd1 = rand(1, $maxRoom);
        } while ($rnd1 == $room->getId());

        $rnd2 = rand(1, $maxRoom);
        do {
            $rnd2 = rand(1, $maxRoom);
        } while ($rnd2 == $rnd1 || $rnd2 == $room->getId());

        //Renvoi des rooms avec ces nombre aléatoires
        $arrRandRooms   = [];
        $arrRandRooms[] = $roomRepository->find($rnd1);
        $arrRandRooms[] = $roomRepository->find($rnd2);


        return $this->render('escape/room.html.twig', [
            'room' => $room,
            'arrRandRooms' => $arrRandRooms
        ]);
    }
}
