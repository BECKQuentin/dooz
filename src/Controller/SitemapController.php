<?php

namespace App\Controller;

use App\Entity\Room;
use App\Repository\RoomRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

class SitemapController extends AbstractController
{
    #[Route('/sitemap.xml', defaults:["_format" => "xml"], options: ["sitemap" => false])]
    public function index(RoomRepository $roomRepository, Request $request): Response
    {
        //On récupère le nom d'hôte depuis l'url
        $hostname = $request->getSchemeAndHttpHost();
        $router = $this->container->get('router');
        $routes = $router->getRouteCollection()->all();
        $urls = [];

        foreach ($routes as $route => $params){
            if($params->getOption("sitemap")){
                $urls[] = array(
                    "loc" => $this->generateUrl($route, [], UrlGeneratorInterface::ABSOLUTE_URL),
                    "lastmod" => date_format(new \DateTime(), "Y-m-d"),
                    "changefreq" => "daily",
                    "priority" => "1.0",
                    "image" => []
                );
            }
        }

        foreach ($roomRepository->findAll() as $room) {
            $image = [
                'loc'   => $hostname.'/upload'.$room->getThumbnailImageDirectory().'/'.$room->getThumbnail(),
                'title' => trim($room->getName()),
            ];

            $urls[] = [
                'loc'   => $this->generateUrl('room', [
                    'slug' => $room->getSlug(),
                ], UrlGeneratorInterface::ABSOLUTE_URL),
                'image'     => $image,
                'lastmod'   => date_format(new \DateTime(), "Y-m-d"),
                "changefreq" => "daily",
                "priority" => "1.0",
            ];
        }

        /*//On initialise un tableau pour lister les URLs
        $arrUrls = [];

        //On ajoute les URLs "statiques"
        $arrUrls[] = ['loc' => $this->generateUrl('home', [], UrlGeneratorInterface::ABSOLUTE_URL), 'lastmod' => date_format(new \DateTime(), "Y-m-d"), 'changefreq' => 'daily', 'priority' => '1.0', 'image' => []];
        $arrUrls[] = ['loc' => $this->generateUrl('bars', [], UrlGeneratorInterface::ABSOLUTE_URL), 'lastmod' => date_format(new \DateTime(), "Y-m-d"), 'changefreq' => 'daily', 'priority' => '1.0', 'image' => []];
        $arrUrls[] = ['loc' => $this->generateUrl('malleus', [], UrlGeneratorInterface::ABSOLUTE_URL), 'lastmod' => date_format(new \DateTime(), "Y-m-d"), 'changefreq' => 'daily', 'priority' => '1.0', 'image' => []];
        $arrUrls[] = ['loc' => $this->generateUrl('episode0', [], UrlGeneratorInterface::ABSOLUTE_URL), 'lastmod' => date_format(new \DateTime(), "Y-m-d"), 'changefreq' => 'daily', 'priority' => '1.0', 'image' => []];
        $arrUrls[] = ['loc' => $this->generateUrl('companies', [], UrlGeneratorInterface::ABSOLUTE_URL), 'lastmod' => date_format(new \DateTime(), "Y-m-d"), 'changefreq' => 'daily', 'priority' => '1.0', 'image' => []];
        $arrUrls[] = ['loc' => $this->generateUrl('companies_works', [], UrlGeneratorInterface::ABSOLUTE_URL), 'lastmod' => date_format(new \DateTime(), "Y-m-d"), 'changefreq' => 'daily', 'priority' => '1.0', 'image' => []];
        $arrUrls[] = ['loc' => $this->generateUrl('companies_team', [], UrlGeneratorInterface::ABSOLUTE_URL), 'lastmod' => date_format(new \DateTime(), "Y-m-d"), 'changefreq' => 'daily', 'priority' => '1.0', 'image' => []];
        $arrUrls[] = ['loc' => $this->generateUrl('destroy', [], UrlGeneratorInterface::ABSOLUTE_URL), 'lastmod' => date_format(new \DateTime(), "Y-m-d"), 'changefreq' => 'daily', 'priority' => '1.0', 'image' => []];
        $arrUrls[] = ['loc' => $this->generateUrl('rooms', [], UrlGeneratorInterface::ABSOLUTE_URL), 'lastmod' => date_format(new \DateTime(), "Y-m-d"), 'changefreq' => 'daily', 'priority' => '1.0', 'image' => []];
        $arrUrls[] = ['loc' => $this->generateUrl('events', [], UrlGeneratorInterface::ABSOLUTE_URL), 'lastmod' => date_format(new \DateTime(), "Y-m-d"), 'changefreq' => 'daily', 'priority' => '1.0', 'image' => []];
        $arrUrls[] = ['loc' => $this->generateUrl('gifts', [], UrlGeneratorInterface::ABSOLUTE_URL), 'lastmod' => date_format(new \DateTime(), "Y-m-d"), 'changefreq' => 'daily', 'priority' => '1.0', 'image' => []];
        $arrUrls[] = ['loc' => $this->generateUrl('groups', [], UrlGeneratorInterface::ABSOLUTE_URL), 'lastmod' => date_format(new \DateTime(), "Y-m-d"), 'changefreq' => 'daily', 'priority' => '1.0', 'image' => []];
        $arrUrls[] = ['loc' => $this->generateUrl('groups_edv', [], UrlGeneratorInterface::ABSOLUTE_URL), 'lastmod' => date_format(new \DateTime(), "Y-m-d"), 'changefreq' => 'daily', 'priority' => '1.0', 'image' => []];
        $arrUrls[] = ['loc' => $this->generateUrl('groups_birthday', [], UrlGeneratorInterface::ABSOLUTE_URL), 'lastmod' => date_format(new \DateTime(), "Y-m-d"), 'changefreq' => 'daily', 'priority' => '1.0', 'image' => []];
        $arrUrls[] = ['loc' => $this->generateUrl('reservation', [], UrlGeneratorInterface::ABSOLUTE_URL), 'lastmod' => date_format(new \DateTime(), "Y-m-d"), 'changefreq' => 'daily', 'priority' => '1.0', 'image' => []];
        $arrUrls[] = ['loc' => $this->generateUrl('vanaheim', [], UrlGeneratorInterface::ABSOLUTE_URL), 'lastmod' => date_format(new \DateTime(), "Y-m-d"), 'changefreq' => 'daily', 'priority' => '1.0', 'image' => []];
        $arrUrls[] = ['loc' => $this->generateUrl('vanaheim_axe', [], UrlGeneratorInterface::ABSOLUTE_URL), 'lastmod' => date_format(new \DateTime(), "Y-m-d"), 'changefreq' => 'daily', 'priority' => '1.0', 'image' => []];


        //On ajoute les URLs "dynamiques"
        foreach ($roomRepository->findAll() as $room) {
            $image = [
                'loc'   => $hostname.'/upload'.$room->getThumbnailImageDirectory().'/'.$room->getThumbnail(),
                'title' => trim($room->getName()),
            ];

            $arrUrls[] = [
                'loc'   => $this->generateUrl('room', [
                    'slug' => $room->getSlug(),
                ], UrlGeneratorInterface::ABSOLUTE_URL),
                'image'     => $image,
                'lastmod'   => date_format(new \DateTime(), "Y-m-d"),
                "changefreq" => "daily",
                "priority" => "1.0",
            ];
        }*/

        $response = new Response($this->renderView('sitemap/sitemap.html.twig', ['urls' => $urls]), 200);
        $response->headers->set('Content-Type', 'text/xml');

        return $response;
    }
}
