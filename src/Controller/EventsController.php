<?php

namespace App\Controller;

use Amp\Socket\ConnectException;
use App\Repository\EventRepository;
use App\Service\CallFacebookApiService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class EventsController extends AbstractController
{

    #[Route('/evenements', name: 'events', options: ["sitemap" => true])]
    public function events(CallFacebookApiService $callFacebookApiService, Request $request): Response
    {

        try {
            $arrDatasEvents = $callFacebookApiService->getAllEventsApiFacebook();
        } catch(ConnectException\Exception $e) {
            echo 'Connection API Impossible: ' . $e->getMessage();
            exit;
        }

        $arrEvents = [];
        $arrEventsEpisode0 = [];
        $arrEventsMalleus = [];
        $arrEventsVanaheim = [];

        if (isset($arrDatasEvents[0]['data'])) {
            foreach ($arrDatasEvents[0]['data'] as $event) {
                $arrEventsEpisode0[] = $event;
            }
        }
        if (isset($arrDatasEvents[1]['data'])) {
            foreach ($arrDatasEvents[1]['data'] as $event) {
                $arrEventsMalleus[] = $event;
            }
        }
        if (isset($arrDatasEvents[2]['data'])) {
            foreach ($arrDatasEvents[2]['data'] as $event) {
                $arrEventsVanaheim[] = $event;
            }
        }
        $arrEvents = array_merge_recursive($arrEventsEpisode0, $arrEventsMalleus, $arrEventsVanaheim);



        return $this->render('events/events.html.twig', [
            'events' => $arrEvents,
        ]);
    }
    #[Route('/evenements/episode0', name: 'events_episode0', options: ["sitemap" => true])]
    public function eventsEpisode0(CallFacebookApiService $callFacebookApiService, Request $request): Response
    {

        try {
            $arrDatasEvents = $callFacebookApiService->getEventsApiFacebookEpisode0();
        } catch(ConnectException\Exception $e) {
            echo 'Connection API Impossible: ' . $e->getMessage();
            exit;
        }
        $events = [];
        if (isset($arrDatasEvents['data'])) {
            $events = $arrDatasEvents['data'];
        }

        return $this->render('events/events.html.twig', [
            'events' => $events,
        ]);
    }
    #[Route('/evenements/malleus', name: 'events_malleus', options: ["sitemap" => true])]
    public function eventsMalleus(CallFacebookApiService $callFacebookApiService, Request $request): Response
    {
        try {
            $arrDatasEvents = $callFacebookApiService->getEventsApiFacebookMalleus();
        } catch(ConnectException\Exception $e) {
            echo 'Connection API Impossible: ' . $e->getMessage();
            exit;
        }
        $events = [];
        if (isset($arrDatasEvents['data'])) {
            $events = $arrDatasEvents['data'];
        }

        return $this->render('events/events.html.twig', [
            'events' => $events,
        ]);
    }
    #[Route('/evenements/vanaheim', name: 'events_vanaheim', options: ["sitemap" => true])]
    public function eventsVanaheim(CallFacebookApiService $callFacebookApiService, Request $request): Response
    {
        try {
            $arrDatasEvents = $callFacebookApiService->getEventsApiFacebookVanaheim();
        } catch(ConnectException\Exception $e) {
            echo 'Connection API Impossible: ' . $e->getMessage();
            exit;
        }
        $events = [];
        if (isset($arrDatasEvents['data'])) {
            $events = $arrDatasEvents['data'];
        }

        return $this->render('events/events.html.twig', [
            'events' => $events,
        ]);
    }

//    #[Route('/evenements/{id}', name: 'event', options: ["sitemap" => true])]
//    public function event(Event $event, CallFacebookApiService $callFacebookApiService, Request $request): Response
//    {
//
//        try {
//            $arrDatasEvents = $callFacebookApiService->getEventsApiFacebook($event->getIdApi());
//        } catch(ConnectException\Exception $e) {
//            echo 'Connection API Impossible: ' . $e->getMessage();
//            exit;
//        }
//
////        dd($arrDatasEvents);
//
//        return $this->render('event/event.html.twig', [
//            'events' => $arrDatasEvents,
//        ]);
//    }
//
//    #[Route('/agenda', name: 'events', options: ["sitemap" => true])]
//    public function agenda(): Response
//    {
//        return $this->render('events/agenda.html.twig', [
//        ]);
//    }


}
