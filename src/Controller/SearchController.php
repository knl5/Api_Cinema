<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Contracts\HttpClientInterface;
use Symfony\Component\HttpFoundation\RequestStack;

class SearchController extends AbstractController {

    #[Route('/', name: 'home')]
    public function homepage(RequestStack $requestStack, HttpClientInterface $client): Response
    {

        $session = $requestStack->getSession();


        $template = $this->render('cinema/index.html.twig', [

        ]);

        return $template;
    }


    #[Route('/search', name: 'search')]
    public function search(RequestStack $requestStack, HttpClientInterface $client): Response
    {
        $url = "https://api.themoviedb.org/3/search/";
        $type = $requestStack->getMainRequest()->query->get("type");
        $apiKey = "5ebe0843b2e373ffa159f5683b21b7de";
        $language = "en-US";
        $page = "1";
        $search = $requestStack->getMainRequest()->query->get("search");
        $newUrl = $baseurl.$type."?api!key=".$apiKey."&language=".$language."&query=".$search."&page=".$page;
        $response = $client->request(
            'GET',
            $newUrl
        );
        $response = json_decode($response->getContent(), true);

    }
}