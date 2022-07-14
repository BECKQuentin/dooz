<?php

namespace App\Controller;

use App\Repository\EventRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class EventsController extends AbstractController
{
    #[Route('/even-team', name: 'events1', options: ["sitemap" => true])]
    #[Route('/evenements', name: 'events', options: ["sitemap" => true])]
    public function index(EventRepository $eventRepository): Response
    {

        
//        /* PHP SDK v5.0.0 */
//        /* make the API call */
//        try {
//            // Returns a `Facebook\FacebookResponse` object
//            $response = $fb->get(
//                '/{event-id}',
//                '{access-token}'
//            );
//        } catch(Facebook\Exceptions\FacebookResponseException $e) {
//            echo 'Graph returned an error: ' . $e->getMessage();
//            exit;
//        } catch(Facebook\Exceptions\FacebookSDKException $e) {
//            echo 'Facebook SDK returned an error: ' . $e->getMessage();
//            exit;
//        }
//        $graphNode = $response->getGraphNode();
//        /* handle the result */


        $events = $eventRepository->findAll();
        return $this->render('events/events.html.twig', [
            'events' => $events,
        ]);
    }
}
